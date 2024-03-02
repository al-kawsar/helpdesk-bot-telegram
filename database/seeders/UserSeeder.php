<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'name' => "ict helpdesk",
            'email' => "helpdeskict@unm.ac.id",
            'password' => Crypt::encrypt(env('PASSWORD_SALT') . '.123.' . env('PASSWORD_SALT')),
            'password_changed' => '1',
            'role_id' => '1'
        ]);
    }
}
