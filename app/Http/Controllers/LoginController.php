<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Silakan masukkan email yang valid!',
            'password.required' => 'Password wajib diisi!',
        ]);

        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('failed_message', 'Username dan password salah!');
        }
        $pass = explode('.', Crypt::decrypt($user->password));
        if ($user && $pass[1] == $password) {
            // Autentikasi berhasil
            Auth::login($user);
            $request->session()->regenerate();
            $url = '/admin/' . $user->id . "/profile";
            if (!$user->password_changed) {
                return redirect()->intended($url)->withErrors(['password' => 'Anda wajib mengganti password', 'in-valid'])->withInput();
            }
            return redirect()->intended("/admin/dashboard");
        }

        return redirect()->back()->with('failed_message', 'Username dan password salah!');
    }



    public function logout()
    {

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('success_message', 'anda berhasil logout');
    }
}
