<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('login.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return redirect('/login');
    }
}