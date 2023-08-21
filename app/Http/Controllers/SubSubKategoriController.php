<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubSubKategori;
use Illuminate\Support\Facades\Validator;

class SubSubKategoriController extends Controller
{

    public function store(Request $request)
    {
        $subSubKategoriData = $request->except('_token');

        // Cek Jika Pilihan Sub Kategori Tidak Kosong
        if (!array_key_exists('option', $subSubKategoriData)) {
            return redirect()->action([AdminBotController::class, 'subKategori'])->withErrors(['tambah_sub-kategori' => 'Silahkan Isi Sub Kategori Terlebih Dahulu!!']);
        }

        $subKategoriOption = $subSubKategoriData['option'];

        $subSubKategoriData = array_reverse($subSubKategoriData);
        // * Menghapus Array sub-kategori option
        unset($subSubKategoriData['option']);

        foreach ($subSubKategoriData as $key => $subSubKategori) {
            $validator = Validator::make(
                ['tambah_subsub-kategori' => $subSubKategori],
                ['tambah_subsub-kategori' => 'required|string'],
                ['tambah_subsub-kategori.required' => 'Sub Sub Kategori Wajib Di isi!!']
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        // Jika semua validasi berhasil, lanjutkan untuk menyimpan data
        foreach ($subSubKategoriData as $key => $subSubKategori) {
            SubSubKategori::create([
                'sub_sub_kategori' => $subSubKategori,
                'sub_kategori_id' => $subKategoriOption
            ]);
        }

        session()->flash('success_message', "Sub-Sub-Kategori Berhasil Ditambahkan!!");
        session()->flash('title', "Berhasil Ditambahkan!");

        return redirect('/admin/sub-sub-kategori');
    }

    public function update(Request $request, SubSubKategori $subsubkategori)
    {


        $validated = $request->validate([
            'update_subsub-kategori' => 'required|integer',
            'option' => "required|integer",
        ], [
            'update_subsub-kategori.required' => 'Sub Sub Kategori Tidak Boleh Kosong!!'
        ]);

        SubSubKategori::where('id', $subsubkategori->id)->update([
            'sub_sub_kategori' => $validated['update_subsub-kategori'],
            'sub_kategori_id' => $validated['option'],
        ]);

        session()->flash('success_message', "Sub-Sub-Kategori Berhasil Diubah!!");
        session()->flash('title', "Berhasil Diubah!");

        return redirect()->back();
    }

    public function delete(SubSubKategori $subsubkategori)
    {

        SubSubKategori::destroy($subsubkategori->id);
        session()->flash('success_message', "Sub-Kategori {$subsubkategori->sub_kategori} telah dihapus");
        session()->flash('title', "Berhasil Dihapus!");
        return redirect()->back();
    }
}
