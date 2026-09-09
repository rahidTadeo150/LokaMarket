<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => 'Andi Setiawan',
                'nama' => 'Andi Setiawan',
                'email' => 'andi@lokamarket.test',
                'no_telp' => '081234567890',
                'password' => Hash::make('password'),
                'role' => 'pemilik_toko',
            ],

            [
                'username' => 'Siti Aminah',
                'nama' => 'Siti Aminah',
                'email' => 'siti@lokamarket.test',
                'no_telp' => '081234567891',
                'password' => Hash::make('password'),
                'role' => 'pemilik_toko',
            ],

            [
                'username' => 'Budi Santoso',
                'nama' => 'Budi Santoso',
                'email' => 'budi@lokamarket.test',
                'no_telp' => '081234567892',
                'password' => Hash::make('password'),
                'role' => 'pemilik_toko',
            ],

            [
                'username' => 'Rina Wulandari',
                'nama' => 'Rina Wulandari',
                'email' => 'rina@lokamarket.test',
                'no_telp' => '081234567893',
                'password' => Hash::make('password'),
                'role' => 'pemilik_toko',
            ],

            [
                'username' => 'Agus Pratama',
                'nama' => 'Agus Pratama',
                'email' => 'agus@lokamarket.test',
                'no_telp' => '081234567894',
                'password' => Hash::make('password'),
                'role' => 'pemilik_toko',
            ],

            [
                'username' => 'Dewi Lestari',
                'nama' => 'Dewi Lestari',
                'email' => 'dewi@lokamarket.test',
                'no_telp' => '081234567895',
                'password' => Hash::make('password'),
                'role' => 'pemilik_toko',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                [
                    'email' => $user['email'],
                ],
                [
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'no_telp' => $user['no_telp'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('UserSeeder berhasil dijalankan.');
    }
}