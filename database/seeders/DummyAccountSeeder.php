<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DummyAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "kak sahirul",
            'email' => "kakaril@gmail.com",
            'password' => bcrypt('anjaygurinjay')
        ]);
    }
}
