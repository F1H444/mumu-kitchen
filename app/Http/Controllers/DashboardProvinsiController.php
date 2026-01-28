<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use App\Models\Provinsi;

class DashboardProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsis = Provinsi::paginate(5);
        return view('dashboard.provinsi.index', [
            'provinsis' => $provinsis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        return view('dashboard.provinsi.create', compact(
            'provinsis'
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_provinsi' => 'required|string',
        ]);
        Provinsi::create($validatedData);

        return redirect('dashboard/provinsi')->with('successcreate', 'Create Successfull!');
    }

    public function edit($id)
    {
        $provinsis = Provinsi::find($id);

        return view('dashboard.provinsi.edit', compact(
            'provinsis'
        ));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_provinsi' => 'required|string'
        ]);
        Provinsi::where('id', $id)->update($validatedData);
        return redirect('dashboard/provinsi')->with('successupdate', 'Update Successfull!');
    }
    public function destroy($id)
    {
        $provinsi = Provinsi::find($id);
        $provinsi->delete();
        return redirect('dashboard/provinsi')->with('successdelete', 'Delete Successfull!');
    }

    public function kota($id)
    {
        $kotas = Kota::where('provinsi_id', $id)->get();
        return response()->json($kotas);
    }
}
