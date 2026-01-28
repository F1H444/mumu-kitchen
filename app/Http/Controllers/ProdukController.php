<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;


class ProdukController extends Controller
{
    public function indexproduk(Request $request)
    {
        $keyword = $request->keyword;
        $produks = Produk::where(function ($q) use ($keyword) {
            $q->where('nama_produk', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('deskripsi', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('harga', 'LIKE', '%' . $keyword . '%');
            $q->orWhere('gambar', 'LIKE', '%' . $keyword . '%');


            $q->orWhereHas('kategori', function ($q) use ($keyword) {
                $q->where('nama_kategori', 'LIKE', '%' . $keyword . '%');
            });
        })->paginate(6);
        $kategori = Kategori::get();

        return view('front.produk.index', [
            'produks' => $produks,
            'kategori' => $kategori,


        ]);
    }

    public function indexprodukdetail($id)
    {
        // $produks = Produk::with('Kategori')->get();
        $kategori = Kategori::get();
        $produks = Produk::where('id', $id)->first();


        return view('front.produk.produkdetail', [
            'produks' => $produks,
            'kategori' => $kategori,


        ]);
    }

    public function getSizes($id)
    {
        $produk = Produk::with('ukuran')->find($id);

        if (!$produk) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Get all sizes with stock information
        $sizes = $produk->ukuran->map(function ($ukuran) {
            return [
                'id' => $ukuran->pivot->id,
                'ukuran' => [
                    'jenis_ukuran' => $ukuran->jenis_ukuran
                ],
                'stock' => $ukuran->pivot->stock
            ];
        });

        return response()->json($sizes);
    }
}
