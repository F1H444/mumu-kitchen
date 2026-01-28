<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use App\Models\UkuranProduk;
use App\Models\Produk;

use Illuminate\Http\Request;

class UkuranProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($produk_id)
    {
        $ukurans = UkuranProduk::where('produk_id', $produk_id)->paginate();
        $produk = Produk::find($produk_id);

        return view('dashboard.produk.ukuran.index', [
            'ukurans' => $ukurans,
            'produk' => $produk,
            'produk_id' => $produk_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($produk_id)
    {
        $ukuran = Ukuran::all();
        $ukurans = UkuranProduk::where('produk_id', $produk_id)->get();
        $produk = Produk::find($produk_id);
        return view('dashboard.produk.ukuran.create', compact(
            'ukurans',
            'ukuran',
            'produk',
            'produk_id'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $produk_id)
    {
        $validatedData = $request->validate([
            'ukuran_id' => 'required|string',
            'stock' => 'required|string'

        ]);
        $validatedData['produk_id'] = $produk_id;
        UkuranProduk::create($validatedData);

        return redirect('dashboard/produk/' . $produk_id . '/ukurans')->with('successcreate', 'Create Successfull!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($produk_id, $id)
    {
        $ukuran = UkuranProduk::find($id);
        $ukurans = Ukuran::all();


        return view('dashboard.produk.ukuran.edit', compact(
            'ukuran',
            'ukurans'
        ));
    }

    public function update(Request $request, $produk_id, $id)
    {
        $validatedData = $request->validate([
            'ukuran_id' => 'required',
            'stock' => 'required'
        ]);
        UkuranProduk::where('id', $id)->update($validatedData);
        return redirect('dashboard/produk/'. $produk_id . '/ukurans')->with('successupdate', 'Update Successfull!');
    }


    public function destroy($produk_id, $id)
    {
        $ukuran = UkuranProduk::find($id);
        $ukuran->delete();
        return redirect('dashboard/produk/' . $produk_id . '/ukurans')->with('successupdate', 'Update Successfull!');
    }
}
