<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanUserController extends Controller
{
    public function laporanpdf($id)
    {
        $pembayaran = Pembayaran::with(['pengiriman', 'pesanan.produk'])->find($id);


        $pdf = PDF::loadview('front.riwayat.laporanpdf', compact('pembayaran'));
        return $pdf->download('Pesanan selesai.pdf');
    }
}
