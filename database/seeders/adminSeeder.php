<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'lokamarketplatform@gmail.com',
            ],
            [
                'username' => 'admin',
                'nama' => 'admin',
                'email' => 'lokamarketplatform@gmail.com',
                'no_telp' => '81234567890',
                'password' => Hash::make('Admin@12345'),
                'role' => 'admin',
            ]
        );
    }
}