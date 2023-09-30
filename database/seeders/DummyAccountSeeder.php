<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;


class DummyAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'name' => "sahirul",
            'email' => "sahirul@gmail.com",
            'password' => Crypt::encrypt($_ENV['PASSWORD_SALT'] . '.123.' . $_ENV['PASSWORD_SALT']),
            'password_changed' => '1',
            'role_id' => '1'
        ]);
    }
}
