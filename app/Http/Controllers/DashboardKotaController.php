<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;
use App\Models\Provinsi;

class DashboardKotaController extends Controller
{
    public function index ()
    {
        $kotas = Kota::paginate(5);
        return view('dashboard.kota.index', [
            'kotas' => $kotas ]);
    }

    public function create()
    {
        $kotas = Kota::all();
        $provinsis = Provinsi::all();
        return view('dashboard.kota.create', compact(
            'kotas',
            'provinsis'
    ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kota' => 'required|string',
            'provinsi_id' => 'required|string'
        ]);
        Kota::create($validatedData);

        return redirect('dashboard/kota')->with('successcreate', 'Create Successfull!');
    }

    public function edit($id)
    {
        $kotas = Kota::find($id);
        $provinsis = Provinsi::all();

        return view('dashboard.kota.edit', compact(
            'kotas','provinsis'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kota' => 'required|string'
        ]);
        Kota::where('id', $id)->update($validatedData);
        return redirect('dashboard/kota')->with('successupdate', 'Update Successfull!');
    }
    public function destroy($id)
    {
        $kota = Kota::find($id);
        $kota->delete();
        return redirect('dashboard/kota')->with('successdelete', 'Delete Successfull!');
    }
}
