<?php

namespace App\Http\Controllers;

use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKategoriController extends Controller
{

    public function store(Request $request)
    {
        $subKategoriData = $request->except('_token');


        if (!array_key_exists('option', $subKategoriData)) {
            return redirect()->action([AdminBotController::class, 'kategori'])->withErrors(['add-kategori' => 'Silahkan Isi Kategori Terlebih Dahulu!!']);
        }

        $kategoriOption = $subKategoriData['option'];

        $subKategoriData = array_reverse($subKategoriData);
        // * Menghapus Array sub-kategori | key -> option
        unset($subKategoriData['option']);

        foreach ($subKategoriData as $key => $subKategori) {
            $validator = Validator::make(
                ['tambah_sub-kategori' => $subKategori],
                ['tambah_sub-kategori' => 'required|string'],
                ['tambah_sub-kategori.required' => 'Sub Kategori Wajib Di isi!!']
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        // Jika semua validasi berhasil, lanjutkan untuk menyimpan data
        foreach ($subKategoriData as $key => $subKategori) {
            SubKategori::create([
                'sub_kategori' => $subKategori,
                'kategori_id' => $kategoriOption
            ]);
        }

        session()->flash('success_message', "Sub-Kategori Berhasil Ditambahkan!!");
        session()->flash('title', "Berhasil Ditambahkan!");

        return redirect('/admin/sub-kategori');
    }

    public function update(Request $request, SubKategori $subkategori)
    {

        $validated = $request->validate([
            'update_sub_kategori' => 'required|string',
            'option' => "required|integer",
        ], [
            'update_sub_kategori.required' => 'Sub Kategori Tidak Boleh Kosong!!'
        ]);

        SubKategori::where('id', $subkategori->id)->update([
            'sub_kategori' => $validated['update_sub_kategori'],
            'kategori_id' => $validated['option'],
        ]);

        session()->flash('success_message', "Sub-Kategori Berhasil Diubah!!");
        session()->flash('title', "Berhasil Diubah!");

        return redirect()->action([AdminBotController::class, 'subKategori']);
    }

    public function delete(SubKategori $subkategori)
    {

        SubKategori::destroy($subkategori->id);
        session()->flash('success_message', "Sub-Kategori {$subkategori->sub_kategori} telah dihapus");
        session()->flash('title', "Berhasil Dihapus!");
        return redirect()->back();
    }
}
