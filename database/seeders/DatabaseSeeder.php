<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\SubSubKategori;
use App\Models\Pertanyaan;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Kategori::create([
            'kategori' => "Registrasi Ulang Camaba 2023"
        ]);
        SubKategori::create([
            'sub_kategori' => "Bagaimana Cara Registrasi Ulang?",
            'kategori_id' => 1
        ]);

        SubSubKategori::create([
            'sub_sub_kategori' => "Sub Sub Kategori CAMABA REGISTRASI ULANG",
            'sub_kategori_id' => 1
        ]);

        Pertanyaan::create([
            'pertanyaan' => "Apa Maksudnya Ini?",
            'jawaban' => "Maksudnya Adalah Begini",
            'sub_sub_kategori_id' => 1
        ]);
    }
}
