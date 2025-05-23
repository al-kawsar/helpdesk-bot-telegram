<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{

    public function updateProfile(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255|required|email|unique:users,email,' . auth()->id(),
            'password' => ['required'],
        ], [
            'name.required' => "Nama wajib di isi",
            'email.unique' => 'Email sudah digunakan, coba yang lain!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Silakan masukkan email yang valid!',
            'password.required' => 'Password wajib diisi!',
        ]);

        $password = $request->get('password');
        $password_repl = preg_replace('/\s+/', '', $password);

        $user = auth()->user();

        $db_pass = Crypt::decrypt($user->password);
        $db_pass = explode('.', $db_pass)[1];
        $status_pass = $user->password_changed;
        $ps = !$status_pass && $db_pass == $password_repl ? '0' : '1';

        $url = "/admin/{$user->email}/profile";

        if (!$status_pass && $ps === '0') {
            return redirect($url)->with([
                'warning_message' => 'Anda Belum Mengganti Password!',
                'title' => "Peringatan",
                'in-valid' => true
            ]);
        }

        $password = $_ENV['PASSWORD_SALT'] . ".{$password}." . $_ENV['PASSWORD_SALT'];


        $user = User::find($user->id);
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Crypt::encrypt($password);
        $user->password_changed = $ps;
        $user->save();

        $url = "/admin/profile";

        return redirect($url)->with([
            'success_message' => "Profile Berhasil Diubah",
            'title' => 'Berhasil!'
        ]);
    }
}
