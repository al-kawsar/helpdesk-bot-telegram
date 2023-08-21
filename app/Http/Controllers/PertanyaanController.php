<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\SubSubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PertanyaanController extends Controller
{

    public function store(Request $request)
    {
        $pertanyaanData = $request->except('_token');

        // Cek Jika Pilihan Sub Kategori Tidak Kosong
        if (!array_key_exists('option', $pertanyaanData)) {
            return redirect()->action([AdminBotController::class, 'subSubKategori'])->withErrors(['tambah_subsub-kategori' => 'Silahkan Isi Sub Sub Kategori Terlebih Dahulu!!']);
        }

        $validated = $request->validate([
            'tambah_pertanyaan' => 'required|string',
            'tambah_jawaban' => 'required|string',
            'option' => 'required|integer'
        ], [
            'tambah_pertanyaan.required' => "Pertanyaan Wajib Di Isi!!",
            'tambah_jawaban.required' => "Jawaban Wajib Di Isi!!"
        ]);

        Pertanyaan::create([
            'pertanyaan' => $validated['tambah_pertanyaan'],
            'jawaban' => $validated['tambah_jawaban'],
            'sub_sub_kategori_id' => $validated['option']
        ]);


        // Jika semua validasi berhasil, lanjutkan untuk menyimpan data


        session()->flash('success_message', "Pertanyaan Berhasil Ditambahkan!!");
        session()->flash('title', "Berhasil Ditambahkan!");

        return redirect('/admin/pertanyaan');
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $validated = $request->validate([
            'update_pertanyaan' => 'required|string',
            'jawaban' => "required|string",
            'option' => "required|integer",
        ], [
            'update_pertanyaan.required' => 'Pertanyaan Tidak Boleh Kosong!!',
            'jawaban.required' => 'Jawaban Tidak Boleh Kosong!!',
        ]);

        Pertanyaan::where('id', $pertanyaan->id)->update([
            'pertanyaan' => $validated['update_pertanyaan'],
            'jawaban' => $validated['jawaban'],
            'sub_sub_kategori_id' => $validated['option'],
        ]);

        session()->flash('success_message', "Pertanyaan Berhasil Diubah!!");
        session()->flash('title', "Berhasil Diubah!");

        return redirect()->back();
    }

    public function delete(Pertanyaan $pertanyaan)
    {

        Pertanyaan::destroy($pertanyaan->id);
        session()->flash('success_message', "Pertanyaan {$pertanyaan->pertanyaan} telah dihapus");
        session()->flash('title', "Berhasil Dihapus!");
        return redirect()->back();
    }
}
