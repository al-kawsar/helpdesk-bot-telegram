<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalRecords = 10_000;
        $batchSize = 5; // Adjust the batch size as needed

        $kategoriChunks = ceil($totalRecords / $batchSize);
        for ($i = 0; $i < $kategoriChunks; $i++) {
            Kategori::factory($batchSize)->create();
        }
    }
}
