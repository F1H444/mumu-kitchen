<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ukuran;

class DashboardUkuranController extends Controller
{
    public function index()
    {
        $ukurans = Ukuran::paginate(4);
        return view('dashboard.ukuran.index', [
            'ukurans' => $ukurans,
        ]);
    }

    public function create()
    {
        $ukurans = Ukuran::all();
        return view('dashboard.ukuran.create', compact(
            'ukurans'
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_ukuran' => 'required|string',
        ]);
        Ukuran::create($validatedData);

        return redirect('dashboard/ukuran')->with('successcreate', 'Create Successfull!');
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


    public function edit($id)
    {
        $ukurans = Ukuran::find($id);

        return view('dashboard.ukuran.edit', compact(
            'ukurans'
        ));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jenis_ukuran' => 'required|string'
        ]);
        Ukuran::where('id', $id)->update($validatedData);
        return redirect('dashboard/ukuran')->with('successupdate', 'Update Successfull!');
    }
    public function destroy($id)
    {
        $ukuran = Ukuran::find($id);
        $ukuran->delete();
        return redirect('dashboard/ukuran')->with('successdelete', 'Delete Successfull!');
    }
}
