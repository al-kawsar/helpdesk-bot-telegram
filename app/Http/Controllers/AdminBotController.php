<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Group;
use App\Models\Kategori;
use App\Models\Pertanyaan;
use App\Models\SubKategori;
use App\Models\SubSubKategori;
use App\Models\TelegramUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminBotController extends Controller
{
    public function dashboard()
    {

        $kategoris = Kategori::count();
        $sub_kategoris = SubKategori::count();
        $sub_sub_kategoris = SubSubKategori::count();
        $pertanyaans = Pertanyaan::count();
        $users = TelegramUser::count();
        $grups = Group::count();

        return view('admin.va_dashboard', [
            'title' => "Admin Dashboard",
            'teks' => "",
            'users' => number_format($users, 0, ',', '.'),
            'kategoris' => number_format($kategoris, 0, ',', '.'),
            'sub_kategoris' => number_format($sub_kategoris, 0, ',', '.'),
            'sub_sub_kategoris' => number_format($sub_sub_kategoris, 0, ',', '.'),
            'pertanyaans' => number_format($pertanyaans, 0, ',', '.'),
            'grups' => number_format($grups, 0, ',', '.')
        ]);
    }

    public function admins()
    {
        $title = 'Admin Tables';
        $teks = 'Admin';
        // $admins = User::where('role_id', '0')->paginate(20);
        $admins = User::where('role_id', '0')->latest()->paginate(20);
        return view('admin.va_admins', compact('title', 'teks', 'admins'));
    }

    public function user()
    {
        return view('admin.va_users', [
            'title' => "Admin User",
            'teks' => "Users",
            'users' => TelegramUser::paginate(20)
        ]);
    }

    public function grup()
    {
        return view('admin.va_grup', [
            'title' => "Admin Grup",
            'teks' => "Grup",
            'grups' => Group::paginate(20)
        ]);
    }

    // public function inbox()
    // {
    //     return view('admin.va_inbox', [
    //         'title' => "Admin Inbox",
    //         'teks' => "Inbox",
    //     ]);
    // }

    public function kategori()
    {
        $query = request()->input('search'); // Ambil query pencarian dari request

        $kategoriQuery = Kategori::with('subKategori')->latest();

        if ($query !== null) {
            $kategoriQuery->where('kategori', 'like', '%' . $query . '%');
        }

        $kategoris = $kategoriQuery->paginate(20);

        return view('admin.kategori.va_kategori', [
            'title' => "Admin Kategori",
            'teks' => "Kategori",
            'kategoris' => $kategoris,
        ]);
    }

    public function profilePage(User $user)
    {
        if ($user->id != auth()->user()->id){
            return redirect()->back()->with('warning_message','Anda tidak punya akses!');
        }
            $title = 'Admin Profile ' . $user->name;
        $teks = '';
        return view('admin.va_profile-admin', compact('title', 'teks', 'user'));
    }


    public function subKategori()
    {

        $query = request()->input('search'); // Ambil query pencarian dari request
        $sub_kategorisQuery = SubKategori::with('kategori')->latest();

        if ($query !== null) {
            $sub_kategorisQuery
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('sub_kategori', 'like', '%' . $query . '%');
                })
                ->orWhereHas('kategori', function ($queryBuilder) use ($query) {
                    $queryBuilder->where('kategori', 'like', '%' . $query . '%');
                });
        }

        $sub_kategoris = $sub_kategorisQuery->paginate(20);

        return view('admin.sub-kategori.va_subkategori', [
            'title' => "Admin Sub Kategori",
            'teks' => "Sub-Kategori",
            'kategori' => Kategori::paginate(50),
            'sub_kategoris' => $sub_kategoris
        ]);
    }

    public function subSubKategori()
    {
        return view('admin.sub-sub-kategori.va_subsubkategori', [
            'title' => "Admin Sub Sub Kategori",
            'teks' => "Sub-Sub-Kategori",
            'sub_kategori' => SubKategori::paginate(50),
            'sub_sub_kategoris' => SubSubKategori::with(['subKategori'])->latest()->paginate(20)
        ]);
    }

    public function pertanyaan()
    {
        return view('admin.pertanyaan.va_pertanyaan', [
            'title' => "Admin Pertanyaan",
            'teks' => "Pertanyaan",
            'sub_sub_kategori' => SubSubKategori::paginate(50),
            'pertanyaans' => Pertanyaan::with('subSubKategori')->latest()->paginate(20)
        ]);
    }
}
