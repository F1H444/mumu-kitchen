<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class RiwayatController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['pengiriman'])
            ->where('user_id', auth()->user()->id)
            ->whereHas('pengiriman')
            ->latest()
            ->paginate(6);
        // dd($pembayaran);
        return view("user.riwayat.index", compact(
            'pembayaran'
        ));
    }


    public function detail($id)
    {
        $pembayaran = Pembayaran::with(['pengiriman'])->where('id', $id)->first();
        // dd($pembayaran);
        return view('user.riwayat.detail', ['pembayaran' => $pembayaran]);
    }

    public function BatalPesanan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'payment_status' => 'required',

        ]);

        $pembayaran = Pembayaran::find($id);

        foreach ($pembayaran->Pesanan as $psn) {
            if ($psn->ukuran_produk_id) {
                $pv = UkuranProduk::find($psn->ukuran_produk_id);
                if ($pv) {
                    $pv->update(['stock' => $pv->stock + $psn->kuantitas]);
                }
            } else {
                $psn->produk->increment('stok', $psn->kuantitas);
            }
        }

        $pembayaran->update(['status' => $request->status, 'payment_status' => $request->payment_status]);




        return redirect('/riwayat');
    }

    public function SelesaiPesanan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update(['status' => $request->status]);
        return redirect('/riwayat')->with('selesai', 'Pesanan Selesai!');
    }
}
