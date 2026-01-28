<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Ukuran;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\UkuranProduk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->paginate(3);
        $kategori = Kategori::get();
        $ukuran = Ukuran::get();

        return view('dashboard.produk.index', [
            'produks' => $produks,
            'kategori' => $kategori,
            'ukurans' => $ukuran

        ]);
    }

    public function create()
    {
        $tambah = Produk::all();
        $kategori = Kategori::all();
        $ukuran = Ukuran::all();
        return view('dashboard.produk.create', compact(
            'tambah',
            'kategori',
            'ukuran'
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'kategori_id' => 'required|string',
            'gambar' => 'required|file|image|max:5048',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'stok' => 'required|numeric',
        ]);
        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('produk-image', 'public');
        }

        Produk::create($validatedData);
        // foreach ($request->ukuran as $index => $ukuran) {
        //     UkuranProduk::create([
        //         'produk_id' => $produkss->id,
        //         'ukuran_id' => $ukuran
        //     ]);
        // }

        return redirect('dashboard/produk')->with('successcreate', 'Create Successfull!');
    }

    public function edit($id)
    {

        $produk = Produk::find($id);
        $kategori = Kategori::all();
        $ukuran = Ukuran::all();

        return view('dashboard.produk.edit', compact(
            'produk',
            'kategori',
            'ukuran'

        ));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'string',
            'kategori_id' => 'string',
            'gambar' => 'file|image|max:5048',
            'harga' => 'numeric',
            'deskripsi' => 'string',
            'stok' => 'numeric',
        ]);

        if ($request->file('gambar')) {
            $produk = Produk::findOrFail($id);
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('produk-image', 'public');
        }

        Produk::where('id', $id)->update($validatedData);

        // UkuranProduk::where('produk_id', $id)->delete();

        // foreach ($request->ukuran as $index => $ukuran) {
        //     UkuranProduk::create([
        //         'produk_id' => $id,
        //         'ukuran_id' => $ukuran
        //     ]);
        // }


        return redirect('dashboard/produk')->with('successupdate', 'Update Successfull!');
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            // Detach related sizes (removes rows from ukuran_produks)
            // This is necessary because of the RESTRICT constraint in the database
            $produk->ukuran()->detach();

            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $produk->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil dihapus!'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for integrity constraint violation (e.g. products in orders)
            if ($e->getCode() == "23000") {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus: Produk ini sudah ada dalam pesanan dan tidak bisa dihapus.'
                ], 400); // 400 Bad Request
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem.'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ], 500);
        }
    }
}
