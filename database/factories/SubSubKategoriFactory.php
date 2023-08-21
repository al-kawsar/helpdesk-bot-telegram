<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubSubKategori>
 */
class SubSubKategoriFactory extends Factory
{
   
    public function definition(): array
    {
        return [
            'sub_sub_kategori' => $this->faker->lastName(),
            'sub_kategori_id' => mt_rand(1,500)
        ];
    }
}
