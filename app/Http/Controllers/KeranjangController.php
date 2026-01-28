<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Ukuran;
use App\Models\Kategori;
use App\Models\UkuranProduk;

class KeranjangController extends Controller
{
    public function index(Request $request)
    {

        $keranjangs = Keranjang::with(['produk'])->where('user_id', auth()->user()->id)->get();
        $total = 0;
        foreach ($keranjangs as $i) {
            $total += $i->subtotal;
        }

        return view('front.keranjang.index', compact(
            'keranjangs',
            'total'
        ));
    }

    public function store(Request $request)
    {
        // Convert empty string to null for ukuran_produk_id
        if ($request->ukuran_produk_id === '' || $request->ukuran_produk_id === 'null') {
            $request->merge(['ukuran_produk_id' => null]);
        }

        // dd($request->all());
        $validatedData = $request->validate([
            'produk_id' => 'required',
            'ukuran_produk_id' => 'nullable', // Changed from required to nullable
            'kuantitas' => 'required'
        ]);


        if ($cek = Keranjang::where('produk_id', $request->produk_id)->where('ukuran_produk_id', $request->ukuran_produk_id)->where('user_id', auth()->user()->id)->first()) {
            $kuantitas = $cek->kuantitas + $validatedData['kuantitas'];

            // Check stock based on size existence
            if ($request->ukuran_produk_id) {
                $ukuranproduk = UkuranProduk::find($request->ukuran_produk_id);
                if ($kuantitas > $ukuranproduk->stock) {
                    $kuantitas = $ukuranproduk->stock;
                }
            } else {
                // If no size, check main product stock
                $produk = \App\Models\Produk::find($request->produk_id);
                if ($kuantitas > $produk->stok) {
                    $kuantitas = $produk->stok;
                }
            }

            $cek->update([
                'kuantitas' => $kuantitas
            ]);
        } else {
            $validatedData['user_id'] = auth()->user()->id;
            Keranjang::create($validatedData);
        }


        if ($request->ajax()) {
            $cartCount = Keranjang::where('user_id', auth()->user()->id)->distinct('produk_id')->count('produk_id');
            return response()->json([
                'success' => true,
                'message' => 'Berhasil ditambahkan ke keranjang',
                'cart_count' => $cartCount
            ]);
        }

        return redirect('/keranjang')->with('successkeranjang', 'Berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request,  $id)
    {
        $tambah = Keranjang::find($id);

        if (!$tambah) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found',
                ], 404);
            }
            return redirect('/keranjang')->with('error', 'Item not found');
        }

        $validatedData = $request->validate([
            'kuantitas' => 'required|integer|min:0',
        ]);

        $tambah->update($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Update Successful',
                'subtotal' => $tambah->subtotal, // Assuming there's a subtotal attribute or calculation
            ]);
        }

        return redirect('/keranjang')->with('successupdate', 'Update Successfull!');
    }

    public function delete($id)
    {
        $tambah = Keranjang::find($id);
        if (!$tambah) {
            return redirect('/keranjang')->with('error', 'Item not found');
        }
        $tambah->delete();
        return redirect('/keranjang')->with('successdelete', 'Delete Successfull!');
    }
}
