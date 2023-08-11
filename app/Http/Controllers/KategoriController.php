<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.kategori.va_tambahkategori', [
            'title' => "Admin Kategori",
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required'
        ], [
            'kategori.required' => 'Kategori Wajib Di isi!!'
        ]);

        Kategori::create($validated);
        return redirect()->action([AdminBotController::class, 'kategori'])->with('success', 'Kategori Berhasil Ditambahkan!!');;
    }
}
