<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Provinsi;
use App\Models\Kota;

use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function index(Request $request)
    {
        $alamat = Alamat::where('user_id', auth()->user()->id)->get();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        return view('front.daftaralamat.index', compact(
            'alamat',
            'provinsi',
            'kota'
        ));
    }
    public function indextambahalamat(Request $request)
    {
        $alamat = Alamat::where('user_id', auth()->user()->id)->get();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        return view('front.daftaralamat.create', compact(
            'alamat',
            'provinsi',
            'kota'
        ));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'nama_penerima' => 'required|string',
            'kode_pos' => 'required|min:5|max:6',
            'detail_alamat' => 'required|string',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
        ]);


        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['provinsi_id'] = 11; // Jawa Timur
        $validatedData['kota_id'] = 444;   // Kota Surabaya

        Alamat::create($validatedData);

        if (isset($request->redirect)) return redirect($request->redirect);

        return redirect('/alamat')->with('successcreate', 'Berhasil Menambahkan Alamat!');
    }

    public function delete($id)
    {

        $alamat = Alamat::find($id);
        $alamat->delete();
        return redirect('/alamat')->with('successdelete', 'Delete Successfull!');
    }
}
