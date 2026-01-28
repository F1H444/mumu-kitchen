<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{

    public function cetak_pdf($id)
    {
        $pembayaran = Pembayaran::with(['pengiriman', 'pesanan.produk'])->find($id);


        $pdf = PDF::loadview('dashboard.laporanpdf.index', compact('pembayaran'));
        return $pdf->download('Pesanan Baru.pdf');
    }
}
