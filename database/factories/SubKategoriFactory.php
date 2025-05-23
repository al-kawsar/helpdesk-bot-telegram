<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubKategori>
 */
class SubKategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  
     public function definition(): array
     {
         return [
             'sub_kategori' => $this->faker->firstNameFemale(),
             'kategori_id' => mt_rand(1,50_000)
         ];
     }
}
