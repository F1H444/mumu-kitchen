<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Alamat;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use App\Models\Pesanan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $keranjang = Keranjang::with(['Produk'])->where('user_id', auth()->user()->id)->get();
        $alamat = Alamat::where('user_id', auth()->user()->id)->get();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $total = 0;
        foreach ($keranjang as $i) {
            $total += $i->subtotal;
        }



        return view('front.pesanan.index', compact('keranjang', 'alamat', 'total', 'kota', 'provinsi'));
    }

    public function pembayaran(Request $request)
    {
        // dd($request->all());
        $kategori = kategori::all();
        $keranjang = Keranjang::with(['produk'])->where('user_id', auth()->user()->id)->get();
        $alamat = Alamat::where('id', $request->alamat_id)->first();

        $total_pembayaran = 0;
        $total = 0;
        foreach ($keranjang as $i) {
            $total += $i->subtotal;
        }



        $ongkir = $request->ongkir;
        $courier = $request->courier;

        $service = $request->service;
        $catatan = $request->catatan;

        return view('front.pembayaran.index', compact(
            'keranjang',
            'alamat',
            'total',
            'ongkir',
            'courier',
            'service',
            'catatan'

        ));
    }



    public function getOngkir(Request $request)
    {
        $data = $request->validate([
            'alamat_id' => 'required',
            'courier' => 'required|in:gofood,maxim,grabfood'
        ]);

        $alamat = Alamat::find($request->alamat_id);

        $costs = [];
        $courierName = strtoupper($data['courier']);

        if ($data['courier'] == 'gofood') {
            $costs[] = [
                'service' => 'GoFood Instant',
                'description' => 'Pengiriman instan via GoFood',
                'cost' => 15000,
                'etd' => '1'
            ];
        } elseif ($data['courier'] == 'grabfood') {
            $costs[] = [
                'service' => 'GrabFood Instant',
                'description' => 'Pengiriman instan via GrabFood',
                'cost' => 15000,
                'etd' => '1'
            ];
        } elseif ($data['courier'] == 'maxim') {
            $costs[] = [
                'service' => 'Maxim Delivery',
                'description' => 'Pengiriman instan via Maxim',
                'cost' => 10000,
                'etd' => '1'
            ];
        }

        // Tambahkan Layanan Khusus Mumu Express jika sesama Surabaya (Origin: 444)
        if ($alamat->kota_id == 444) {
            array_unshift($costs, [
                'service' => 'Mumu Express',
                'description' => 'Kurir Internal Mumu Kitchen',
                'cost' => 10000,
                'etd' => '1'
            ]);
        }

        return response()->json($costs);
    }


    public function show(Pesanan $pesanan)
    {
        $snapToken = $pesanan->snap_token;
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($pesanan);
            $snapToken = $midtrans->getSnapToken();

            $pesanan->snap_token = $snapToken;
            $pesanan->save();
        }

        return view('pesanan.show', compact('pesanan', 'snapToken'));
    }

    public function charge(Request $request)
    {
        $keranjang = Keranjang::with(['produk'])->where('user_id', auth()->user()->id)->get();


        $pembayaran = Pembayaran::create([
            'user_id' => auth()->user()->id,
            'no_invoice' => 'INV' . rand(10000, 99999) . date('dmYhms') . auth()->user()->id,
            'no_pemesanan' => Str::substr((string) Str::uuid(), 0, 8) . auth()->user()->id,
            'catatan' => $request->catatan,
            'payment_status' => 'belumbayar',
            'status' => 'menunggupembayaran'
        ]);

        $harga = 0;
        foreach ($keranjang as $item) {
            $pesanan = Pesanan::create([
                'pembayaran_id' => $pembayaran->id,
                'kuantitas' => $item->kuantitas,
                'sub_total' => $item->produk->harga * $item->kuantitas,
                'produk_id' => $item->produk->id,
            ]);

            $item->produk->decrement('stok', $item->kuantitas);

            $harga += $pesanan->sub_total;
        }

        $harga += $request->ongkir;

        $alamat = Alamat::find($request->daftar_alamat_id);
        $pengiriman = Pengiriman::create([
            'alamat' => $alamat->detail_alamat,
            'kode_pos' => $alamat->kode_pos,
            'no_hp' => $alamat->phone,
            'nama_penerima' => $alamat->nama_penerima,
            'provinsi_id' => $alamat->provinsi_id,
            'kota_id' => $alamat->kota_id,
            'nama_ekspedisi' => $request->courier,
            'harga_ongkir' => $request->ongkir,
            'paket_layanan' => $request->service,
        ]);

        $pembayaran->update(['harga' => $harga, 'pengiriman_id' => $pengiriman->id]);
        $midtrans = new CreateSnapTokenService($pembayaran);
        $snapToken = $midtrans->getSnapToken();

        if ($pembayaran->update(['snap_token' => $snapToken])) {
            Keranjang::where('user_id', auth()->user()->id)->delete();
        }

        return response()->json([
            'snap_token' => $snapToken,
            'order_id' => $pembayaran->id,
            'order_number' => $pembayaran->no_pemesanan
        ]);
    }

    public function updatePaymentSuccess(Request $request)
    {
        $orderId = $request->order_id;

        // Find pembayaran by snap token or order ID
        $pembayaran = Pembayaran::where('id', $orderId)
            ->orWhere('no_pemesanan', $orderId)
            ->first();

        if (!$pembayaran) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        // Update status to selesai
        $pembayaran->update([
            'payment_status' => 'sudahbayar',
            'status' => 'pesananselesai'
        ]);

        // Send email invoice
        try {
            $pembayaranData = Pembayaran::with(['user', 'pengiriman.provinsi', 'pengiriman.kota', 'pesanan.produk'])
                ->find($pembayaran->id);

            if ($pembayaranData && $pembayaranData->user && $pembayaranData->user->email) {
                Mail::send('emails.invoice', ['pembayaran' => $pembayaranData], function ($message) use ($pembayaranData) {
                    $message->to($pembayaranData->user->email)
                        ->subject('Invoice Pembayaran #' . $pembayaranData->no_pemesanan . ' - Mumu Kitchen');
                });

                Log::info('Invoice email sent successfully to: ' . $pembayaranData->user->email);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated to completed',
            'order_number' => $pembayaran->no_pemesanan
        ]);
    }
}
