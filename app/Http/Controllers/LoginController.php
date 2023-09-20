<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function login()
    {
        return view('v_login', [
            'title' => "Login",
            'teks' => ""
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'email wajib di isi!',
            'email.email' => 'silahkan masukkan email valid!',
            'password.required' => 'password tidak valid'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }
        return redirect()->back()->with('failed_message', 'username dan password salah!');
    }

    public function logout()
    {

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('success_message', 'anda berhasil logout');
    }
}
