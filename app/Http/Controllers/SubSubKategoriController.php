<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\SubSubKategori;

class SubSubKategoriController extends Controller
{

    public function index()
    {
        return view('admin.sub-sub-kategori.va_tambahsubsubkategori', [
            'title' => "Admin Sub Sub Kategori",
            'sub_kategori' => SubKategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub-sub-kategori' => 'required',
            'option' => 'required'
        ], [
            'sub-kategori.required' => "Sub Sub Kategori Wajib Di isi!!"
        ]);

        SubSubKategori::create([
            'sub_sub_kategori' => $validated['sub-sub-kategori'],
            'sub_kategori_id' => $validated['option']
        ]);
        return redirect('/admin/sub-sub-kategori');
    }
}
