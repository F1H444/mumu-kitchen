<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('user.index', compact('user'));
    }

    public function profile(Request $request)
    {
        $tambah = User::where('id', auth()->user()->id)->first();

        $user = $request->all();
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($tambah->avatar && file_exists(public_path('storage/avatar/' . $tambah->avatar))) {
                unlink(public_path('storage/avatar/' . $tambah->avatar));
            }

            $file = $request->file('avatar');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/avatar'), $nama_file);
            $user['avatar'] = $nama_file;
        }
        $tambah->update($user);

        return back();
    }
}
