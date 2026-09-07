<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil user pemilik toko
        |--------------------------------------------------------------------------
        |
        | Sesuaikan nilai role jika di database Anda menggunakan nama berbeda.
        |
        */

        $users = DB::table('users')
            ->where('role', 'pemilik_toko')
            ->orderBy('id')
            ->get();

        if ($users->isEmpty()) {
            $this->command->error(
                'User dengan role pemilik_toko belum tersedia.'
            );

            $this->command->info(
                'Jalankan UserSeeder terlebih dahulu.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Data Toko
        |--------------------------------------------------------------------------
        */

        $dataToko = [
            [
                'nama_toko' => 'Kopi Banyuwangi',
                'deskripsi' => 'Menyediakan berbagai jenis kopi lokal Banyuwangi dengan kualitas pilihan dari petani kopi daerah.',
                'alamat' => 'Jl. Ijen No. 12, Banyuwangi',
                'no_telepon' => '081234567890',
                'foto_profil' => 'toko/kopi-banyuwangi.jpg',
            ],

            [
                'nama_toko' => 'Batik Osing',
                'deskripsi' => 'Toko batik khas Banyuwangi yang menyediakan berbagai motif batik tradisional dan modern.',
                'alamat' => 'Jl. Ahmad Yani No. 25, Banyuwangi',
                'no_telepon' => '081234567891',
                'foto_profil' => 'toko/batik-osing.jpg',
            ],

            [
                'nama_toko' => 'Kerajinan Lokal',
                'deskripsi' => 'Menghadirkan berbagai kerajinan tangan buatan UMKM lokal dengan desain unik dan berkualitas.',
                'alamat' => 'Jl. Diponegoro No. 18, Banyuwangi',
                'no_telepon' => '081234567892',
                'foto_profil' => 'toko/kerajinan-lokal.jpg',
            ],

            [
                'nama_toko' => 'Dapur Bu Siti',
                'deskripsi' => 'Menyediakan makanan ringan, camilan, sambal, dan berbagai olahan makanan khas lokal.',
                'alamat' => 'Jl. Kalibaru No. 8, Banyuwangi',
                'no_telepon' => '081234567893',
                'foto_profil' => 'toko/dapur-bu-siti.jpg',
            ],

            [
                'nama_toko' => 'Tani Jaya',
                'deskripsi' => 'Menyediakan hasil pertanian dan peternakan lokal seperti beras, telur, madu, dan produk segar lainnya.',
                'alamat' => 'Jl. Rogojampi No. 15, Banyuwangi',
                'no_telepon' => '081234567894',
                'foto_profil' => 'toko/tani-jaya.jpg',
            ],

            [
                'nama_toko' => 'Laut Segar',
                'deskripsi' => 'Menyediakan berbagai hasil perikanan segar langsung dari nelayan dan pembudidaya lokal.',
                'alamat' => 'Jl. Pantai Blimbingsari No. 7, Banyuwangi',
                'no_telepon' => '081234567895',
                'foto_profil' => 'toko/laut-segar.jpg',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Masukkan Data Toko
        |--------------------------------------------------------------------------
        */

        foreach ($dataToko as $index => $toko) {

            // Ambil user berdasarkan urutan
            $user = $users->get($index);

            // Jika jumlah user lebih sedikit dari jumlah toko,
            // gunakan user pertama sebagai fallback.
            if (!$user) {
                $user = $users->first();
            }

            DB::table('toko')->updateOrInsert(
                [
                    'slug' => Str::slug($toko['nama_toko']),
                ],
                [
                    'user_id' => $user->id,
                    'nama_toko' => $toko['nama_toko'],
                    'slug' => Str::slug($toko['nama_toko']),
                    'deskripsi' => $toko['deskripsi'],
                    'alamat' => $toko['alamat'],
                    'no_telepon' => $toko['no_telepon'],
                    'foto_profil' => $toko['foto_profil'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info(
            'Data toko berhasil dibuat.'
        );
    }
}