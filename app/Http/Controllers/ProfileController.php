<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function updateProfile(Request $request, User $user)
    {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => $request->email == $user->email ? 'required|max:255|email' : 'unique:users|max:255|required|email',
            'password' => ['required'],
        ], [
            'name.required' => "Nama wajib di isi",
            'email.unique' => 'Email sudah digunaka, coba yang lain!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Silakan masukkan email yang valid!',
            'password.required' => 'Password wajib diisi!',
        ]);

        $password = $_ENV['PASSWORD_SALT'] . ".{$request->get('password')}." . $_ENV['PASSWORD_SALT'];

        $user = User::find($user->id);
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Crypt::encrypt($password);
        $user->password_changed = true;
        $user->save();

    return redirect("/admin/{$user->id}/profile")->with([
            'success_message' => "Profile Berhasil Diubah",
            'title' => 'Berhasil!'
        ]);
    }
}
