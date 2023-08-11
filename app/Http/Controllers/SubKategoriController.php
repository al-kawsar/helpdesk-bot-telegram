<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    public function index()
    {
        return view('admin.sub-kategori.va_tambahsubkategori', [
            'title' => "Admin Sub Kategori",
            'teks' => "sub-kategori",
            'kategori' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub-kategori' => 'required',
            'option' => 'required'
        ], [
            'sub-kategori.required' => "Sub Kategori Wajib Di isi!!"
        ]);

        SubKategori::create([
            'sub_kategori' => $validated['sub-kategori'],
            'kategori_id' => $validated['option']
        ]);
        return redirect('/admin/sub-kategori');
    }
}
