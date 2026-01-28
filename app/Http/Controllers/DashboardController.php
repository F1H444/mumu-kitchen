<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('is_admin', '0')->get();
        $prds = Produk::get();
        $terjual = Pesanan::whereHas('pembayaran', function ($q) {
            $q->where('status', '!=', 'pesananbatal');
        })->sum('kuantitas');
        $totalPenjualan = Pembayaran::whereIn('payment_status', ['dibayar', 'sudahbayar'])->sum('harga');
        $pembayaran = Pembayaran::where('status', 'pesananditerima')->with(['Pengiriman', 'Pesanan.Produk'])->latest()->paginate(5);
        $pendapatan = Pembayaran::whereIn('payment_status', ['dibayar', 'sudahbayar'])->sum('harga');

        return view('dashboard.index', compact(
            'user',
            'prds',
            'terjual',
            'pembayaran',
            'totalPenjualan',
            'pendapatan'
        ));
    }
}
