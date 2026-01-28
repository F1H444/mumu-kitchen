<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function pesananbaru(Request $request)
    {
        $keyword = $request->keyword;
        $pembayaran = Pembayaran::whereIn('status', ['pesananditerima', 'menunggupembayaran'])->with(['Pengiriman', 'Pesanan.Produk'])->where(function ($q) use ($keyword) {
            $q->where('no_pemesanan', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('no_invoice', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('harga', 'LIKE', '%' . $keyword . '%');
            $q->orWhereHas('pengiriman', function ($q) use ($keyword) {
                $q->where('alamat', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('nama_penerima', 'LIKE', '%' . $keyword . '%');
            });
        })->Paginate(5);

        return view('dashboard.pesanan_baru.index', compact(
            'pembayaran',
            'keyword'
        ));
    }

    public function showpesananbaru(Request $request)
    {
        $pembayaran = Pembayaran::with(['Pengiriman', 'Pesanan.Produk'])->paginate(4);
        $no_resi = $request->no_resi;

        return view('dashboard.pesanan.pesananbaru', compact(
            'pembayaran',
            'no_resi'
        ));
    }

    public function updateStatusbaru(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update(['status' => $request->status]);
        return redirect('/dashboard/pesananbaru')->with('diproses', 'Pesanan Di Proses!');
    }

    public function pesanandiproses(Request $request)
    {
        $keyword = $request->keyword;
        $pembayaran = Pembayaran::where('status', 'pesanandiproses')->with(['Pengiriman', 'Pesanan.Produk'])->where(function ($q) use ($keyword) {
            $q->where('no_pemesanan', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('no_invoice', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('harga', 'LIKE', '%' . $keyword . '%');
            $q->orWhereHas('pengiriman', function ($q) use ($keyword) {
                $q->where('alamat', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('nama_penerima', 'LIKE', '%' . $keyword . '%');
            });
        })->Paginate(4);

        return view('dashboard.pesanandiproses.index', compact(

            'pembayaran',
            'keyword'
        ));
    }

    public function showpesanandiproses(Request $request)
    {
        $pembayaran = Pembayaran::with(['Pengiriman', 'Pesanan.Produk'])->paginate(4);
        $no_resi = $request->no_resi;

        return view('dashboard.pesanan.pesanandiproses', compact(
            'pembayaran',
            'no_resi'
        ));
    }

    public function updateStatusproses(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update(['status' => $request->status]);
        return redirect('/dashboard/pesanandiproses')->with('diproses', 'Pesanan Di Proses!');
    }

    public function pesanandalampengiriman(Request $request)
    {
        $keyword = $request->keyword;
        $pembayaran = Pembayaran::where('status', 'pesanandikirim')->with(['Pengiriman', 'Pesanan.Produk'])->where(function ($q) use ($keyword) {
            $q->where('no_pemesanan', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('no_invoice', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('harga', 'LIKE', '%' . $keyword . '%');
            $q->orWhereHas('pengiriman', function ($q) use ($keyword) {
                $q->where('alamat', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('nama_penerima', 'LIKE', '%' . $keyword . '%');
            });
        })->Paginate(4);

        return view('dashboard.pesanandalampengiriman.index', compact(

            'pembayaran',
            'keyword'
        ));
    }

    public function showpesanandikirim(Request $request)
    {
        $pembayaran = Pembayaran::with(['Pengiriman', 'Pesanan.Produk.ProdukVariasi'])->paginate(4);
        $no_resi = $request->no_resi;

        return view('dashboard.pesanan.pesanandikirim', compact(
            'pembayaran',
            'no_resi'
        ));
    }

    public function updateStatusdikirim(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update(['status' => $request->status]);
        return redirect('/dashboard/pesanandalampengiriman')->with('diproses', 'Pesanan Di Proses!');
    }

    public function kembaliproses(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update(['status' => $request->status]);
        return redirect('/dashboard/pesanandalampengiriman')->with('diproses', 'Pesanan Di Proses!');
    }

    public function pesanandibatalkan(Request $request)
    {
        $keyword = $request->keyword;
        $pembayaran = Pembayaran::where('status', 'pesananbatal')->with(['Pengiriman', 'Pesanan.Produk'])->where(function ($q) use ($keyword) {
            $q->where('no_pemesanan', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('no_invoice', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('harga', 'LIKE', '%' . $keyword . '%');
            $q->orWhereHas('pengiriman', function ($q) use ($keyword) {
                $q->where('alamat', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('nama_penerima', 'LIKE', '%' . $keyword . '%');
            });
        })->Paginate(4);

        return view('dashboard.pesanandibatalkan.index', compact(

            'pembayaran',
            'keyword'
        ));
    }

    public function pesananselesai(Request $request)
    {
        $keyword = $request->keyword;
        $pembayaran = Pembayaran::where('status', 'pesananselesai')->with(['Pengiriman', 'Pesanan.Produk'])->where(function ($q) use ($keyword) {
            $q->where('no_pemesanan', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('no_invoice', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('harga', 'LIKE', '%' . $keyword . '%');
            $q->orWhereHas('pengiriman', function ($q) use ($keyword) {
                $q->where('alamat', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('nama_penerima', 'LIKE', '%' . $keyword . '%');
            });
        })->Paginate(4);

        return view('dashboard.pesananselesai.index', compact(

            'pembayaran',
            'keyword'
        ));
    }
}
