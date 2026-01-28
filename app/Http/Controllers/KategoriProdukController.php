<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class KategoriProdukController extends Controller
{
    public function kategoriproduk($id)
    {
        $kategori = Kategori::where('id', $id)->first();
        $produks = Produk::whereHas('Kategori', function ($q) use ($id) {
            $q->where('id', $id);
        })->first();
        $produk = Produk::whereHas('Kategori', function ($q) use ($id) {
            $q->where('id', $id);
        })->paginate(6);
        $kategoris = Kategori::get();
        return view('front.kategoriproduk.index', compact('produk', 'kategori', 'produks', 'kategoris'));
    }

    public function katalogproduk($id)
    {
        $kategori = Kategori::where('id', $id)->first();
        $produk = Produk::whereHas('Kategori', function ($q) use ($id) {
            $q->where('id', $id);
        })->paginate(6); // Increased pagination to 6 to match index
        $kategoris = Kategori::get();
        return view('front.produk.katalog', compact('produk', 'kategori', 'kategoris'));
    }
}
