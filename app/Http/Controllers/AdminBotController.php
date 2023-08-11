<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pertanyaan;
use App\Models\SubKategori;
use App\Models\SubSubKategori;
use Illuminate\Http\Request;

class AdminBotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('admin.va_dashboard', [
            'title' => "Admin Dashboard"
        ]);
    }

    public function user()
    {
        return view('admin.va_users', [
            'title' => "Admin User"
        ]);
    }

    public function kategori()
    {
        return view('admin.kategori.va_kategori', [
            'title' => "Admin Kategori",
            'teks' => "Kategori",
            'kategoris' => Kategori::with('subKategori')->latest()->paginate(8)
        ]);
    }

    public function subKategori()
    {
        return view('admin.sub-kategori.va_subkategori', [
            'title' => "Admin Sub Kategori",
            'teks' => "Sub-Kategori",
            'subKategoris' => SubKategori::with('kategori')->latest()->paginate(8)
        ]);
    }

    public function subSubKategori()
    {
        return view('admin.sub-sub-kategori.va_subsubkategori', [
            'title' => "Admin Sub Sub Kategori",
            'teks'=> "Sub-Sub-Kategori",
            'subSubKategoris' => SubSubKategori::with('subKategori')->latest()->paginate(8)
        ]);
    }

    public function pertanyaan()
    {
        return view('admin.pertanyaan.va_pertanyaan', [
            'title' => "Admin Pertanyaan",
            'teks' => "Pertanyaan",
            'pertanyaans' => Pertanyaan::with('subSubKategori')->latest()->paginate(8)
        ]);
    }
}
