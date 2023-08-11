<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\SubSubKategori;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{

    public function index()
    {
        return view('admin.pertanyaan.va_tambahpertanyaan', [
            'title' => 'Admin Pertnyaan',
            'sub_sub_kategori' => SubSubKategori::all()->sortBy('sub_sub_kategori')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'option' => 'required'
        ], [
            'pertanyaan.required' => "Pertanyaan Wajib Di isi!!",
            'jawaban.required' => "Jawaban Wajib Di isi!!",
        ]);

        Pertanyaan::create([
            'pertanyaan' => $validated['pertanyaan'],
            'jawaban' => $validated['jawaban'],
            'sub_sub_kategori_id' => $validated['option']
        ]);
        return redirect('/admin/pertanyaan');
    }
}
