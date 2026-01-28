<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pengiriman;

use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date;
        $pembayaran = Pembayaran::where('status', 'pesananselesai')->whereHas('pengiriman')->when(isset($request->date) ?? false, function ($q) use ($date) {
            $q->whereDate('created_at', $date);
        })->paginate(4);
        // dd($pembayaran);
        return view("dashboard.laporanpenjualan.index", compact(
            'pembayaran'
        ));
    }
    public function cetak_pdf(Request $request)
    {

        $date = $request->date;
        $pembayaran = Pembayaran::with(['Pengiriman', 'Pesanan.Produk'])->whereDate('created_at', $date)->get();
        $totalPendapatan = Pembayaran::whereDate('created_at', $date)->sum('harga');
        $totalOngkir = Pengiriman::whereHas('Pembayaran', function ($q) use ($date) {

            $q->whereDate('created_at', $date);
        })->sum('harga_ongkir');
        $totalPendapatan = $totalPendapatan - $totalOngkir;


        foreach ($pembayaran as $psn) {
            $total_psn = 0;
            foreach ($psn->Pesanan as $psnnn) {
                $total_psn += $psnnn->sub_total;
            }
            $psn->total_psn = $total_psn;
        }

        $pdf = PDF::loadview('dashboard.laporanpenjualanpdf.index', compact('pembayaran', 'totalPendapatan', 'totalOngkir'));
        return $pdf->download('Laporan Penjual.pdf');
    }
}
