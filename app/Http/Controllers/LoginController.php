<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($data)) {
            $request->session()->regenerate();

            if (auth()->user()->is_admin == 1) {
                return redirect('/dashboard');
            } else {
                return redirect('/profile');
            }
        }

        return back()->with('error', 'Email atau Password Salah!');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

            if ($finduser) {
                if (!$finduser->google_id) {
                    $finduser->update(['google_id' => $user->id]);
                }

                auth()->login($finduser);

                if (auth()->user()->is_admin == 1) {
                    return redirect('/dashboard');
                } else {
                    return redirect('/profile');
                }
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt(uniqid()) // Random password
                ]);

                auth()->login($newUser);
                return redirect('/profile');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google Gagal: ' . $e->getMessage());
        }
    }
}
