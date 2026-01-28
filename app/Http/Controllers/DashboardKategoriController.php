<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategori = kategori::Paginate(2);
        $keyword = $request->keyword;
        return view('dashboard.kategori.index', compact(
            'kategori'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tambah = Kategori::all();
        return view('dashboard.kategori.create', compact(
            'tambah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string',
            'gambar' => 'required|file|max:1024'
        ]);
        if($request->file('gambar')){
           $validatedData['gambar'] = $request->file('gambar')->store('kategori-image','public');
        }
        Kategori::create($validatedData);
        return redirect('dashboard/kategori')->with('successcreate', 'Create Successfull!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $kategori = Kategori::find($id);

        return view('dashboard.kategori.edit', compact(
            'kategori',

        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $tambah = Kategori::find($id);
        $validatedData = $request->validate([
            'nama_kategori' => 'string',
            'gambar' => 'file|max:1024'

        ]);
        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('kategori-image', 'public');
        }
        Kategori::where('id', $id)->update($validatedData);
        return redirect('dashboard/kategori')->with('successupdate', 'Update Successfull!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect('dashboard/kategori')->with('successdelete', 'Delete Successfull!');
    }

}
