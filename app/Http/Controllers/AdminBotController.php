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

        return view('admin.va_dashboard', [
            'title' => "Admin Dashboard",
            'teks' => "",
            'users' => number_format($users, 0, ',', '.'),
            'kategoris' => number_format($kategoris, 0, ',', '.'),
            'sub_kategoris' => number_format($sub_kategoris, 0, ',', '.'),
            'sub_sub_kategoris' => number_format($sub_sub_kategoris, 0, ',', '.'),
            'pertanyaans' => number_format($pertanyaans, 0, ',', '.')
        ]);
    }

    public function user()
    {
        return view('admin.va_users', [
            'title' => "Admin User",
            'teks' => "Users",
            'users' => TelegramUser::paginate(20)
        ]);
    }

    public function grup(){
        return view('admin.va_grup',[
            'title' => "Admin Grup",
            'teks' => "Grup",
            'grups' => Group::paginate(20)
        ]);
    }

    public function inbox(){
        return view('admin.va_inbox',[
            'title' => "Admin Inbox",
            'teks' => "Inbox",
        ]);
    }

    public function kategori()
    {

        // PaginateKategoriJob::dispatch();

        return view('admin.kategori.va_kategori', [
            'title' => "Admin Kategori",
            'teks' => "Kategori",
            'kategoris' => Kategori::with('subKategori')->latest()->paginate(20)
        ]);
    }

    public function subKategori()
    {
        return view('admin.sub-kategori.va_subkategori', [
            'title' => "Admin Sub Kategori",
            'teks' => "Sub-Kategori",
            'kategori' => Kategori::paginate(50),
            'sub_kategoris' => SubKategori::with('kategori')->latest()->paginate(10)
        ]);
    }

    public function subSubKategori()
    {
        return view('admin.sub-sub-kategori.va_subsubkategori', [
            'title' => "Admin Sub Sub Kategori",
            'teks' => "Sub-Sub-Kategori",
            'sub_kategori' => SubKategori::paginate(50),
            'sub_sub_kategoris' => SubSubKategori::with(['subKategori'])->latest()->paginate(10)
        ]);
    }

    public function pertanyaan()
    {
        return view('admin.pertanyaan.va_pertanyaan', [
            'title' => "Admin Pertanyaan",
            'teks' => "Pertanyaan",
            'sub_sub_kategori' => SubSubKategori::paginate(50),
            'pertanyaans' => Pertanyaan::with('subSubKategori')->latest()->paginate(8)
        ]);
    }
}
