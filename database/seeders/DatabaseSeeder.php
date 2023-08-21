<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\SubSubKategori;
use App\Models\Pertanyaan;
use App\Models\Admin;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $totalRecords = 100;
        $batchSize = 50; // Adjust the batch size as needed

        $kategoriChunks = ceil($totalRecords / $batchSize);

        for ($i = 0; $i < $kategoriChunks; $i++) {
            // Kategori::factory($batchSize)->create();
            Kategori::factory($batchSize)->create();
        }

    }
}
