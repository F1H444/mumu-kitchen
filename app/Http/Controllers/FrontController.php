<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;



class FrontController extends Controller
{
    public function index()
    {

        $kategori = Kategori::get();
        $produk = Produk::with(['kategori'])->paginate(4);
        $produkk = Produk::with(['kategori'])->take(8)->get();

        return view('front.index', [
            'produk' => $produk,
            'produkk' => $produkk,

            'kategori' => $kategori

        ]);
    }
}
