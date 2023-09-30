<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function createAdmin(Request $request)
    {
        // Validasi input email
        $credential = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255|min:15|unique:users|regex:/(.+)@(.+)\.(.+)/i'
            ],
            [
                'email.required' => 'Email wajib diisi!',
                'email.email' => 'Email tidak valid!',
                'email.max' => 'Email maksimal 255 karakter',
                'email.unique' => 'Email sudah digunakan, coba yang lain!'
            ]
        );

        if ($credential->fails()) {
            return redirect()->back()->withErrors($credential)->withInput();
        }
        $email = $request->get('email');
        $name = preg_replace("/[0-9, ]/", "", explode('@', $email)[0]);

        $jmlhData = User::where('role_id', '0')->count('id');
        $jmlhDataString = $jmlhData < 10 ? "0" . ($jmlhData + 1) : $jmlhData + 1;
        $password = "adm" . '-' . $jmlhDataString;

        $admin = new User();
        $admin->id = Str::uuid();
        $admin->name = $name;
        $admin->email = $email;
        $admin->password = Crypt::encrypt($_ENV['PASSWORD_SALT'] . '.' . $password . '.' . $_ENV['PASSWORD_SALT']);
        $admin->role_id = "0";
        $admin->save();

        return redirect()->route('bot.admins')->with('success_message', 'Admin Berhasil Ditambahkan');
    }

    public function updateAdmin(Request $request, User $user)
    {


        $credential = Validator::make(
            $request->all(),
            ['email' => 'min:15|max:255|email:rfc,dns|required|regex:/(.+)@(.+)\.(.+)/i', 'name' => 'required|max:255'],
            ['name.required' => "Nama wajib di isi!", 'name.max' => 'nama maksimal 255 karakter', 'email.required' => "Email wajib di isi!", 'email.email' => "Email tidak valid", 'email.max' => "Email maksimal 255 karakter", 'email.unique' => 'Email sudah digunakan, coba yang lain!']
        );

        if ($credential->fails()) {
            return redirect()->back()->withErrors($credential)->withInput();
        }

        $name = $request->input('name');
        $name = preg_replace("/[0-9, ]/", "", $name);

        User::where('id', $user->id)->update(
            [
                'name' => $name,
                'email' => $request->input('email'),
            ]
        );
        // $url = "/admin/{$user->id}/profile";
        $url = "/admin/admins";
        return redirect($url)->with([
            'success_message' => 'Admin Berhasil Diubah!'
        ]);
    }

    public function deleteAdmin(User $user)
    {
        User::destroy($user->id);
        return redirect('admin/admins')->with(['success_message' => "Admin {$user->name} telah dihapus", 'title' => "Berhasil"]);
    }
}
