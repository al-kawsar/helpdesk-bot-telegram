<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Controllers\AdminBotController;
use Illuminate\Support\Facades\Validator;
use App\Jobs\InsertData;

class KategoriController extends Controller
{


    public function store(Request $request)
    {

        $kategoriData = $request->except('_token');

        $kategoriData = array_reverse($kategoriData);
        foreach ($kategoriData as $key => $kategori) {
            $validator = Validator::make(
                ['add-kategori' => $kategori],
                ['add-kategori' => 'required|string'],
                ['add-kategori.required' => 'Kategori Wajib Di isi!!']
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        // Jika semua validasi berhasil, lanjutkan untuk menyimpan data
        foreach ($kategoriData as $key => $kategori) {
            Kategori::create([
                'kategori' => $kategori,
                ]);
        }

        session()->flash('success_message', "Kategori Berhasil Ditambahkan!!");
        session()->flash('title', "Berhasil Ditambahkan!");

        return redirect()->action([AdminBotController::class, 'kategori']);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'update-kategori' => 'required|string'
        ], [
            'update-kategori.required' => 'Kategori Tidak Boleh Kosong!!'
        ]);

        Kategori::where('id', $kategori->id)->update(['kategori' => $validated['update-kategori']]);

        session()->flash('success_message', "Kategori Berhasil Diubah!!");
        session()->flash('title', "Berhasil Diubah!");

        return redirect()->back();
    }

    public function delete(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);
        session()->flash('success_message', "Kategori {$kategori->kategori} telah dihapus");
        session()->flash('title', "Berhasil Dihapus!");
        return redirect()->back();
    }
}
