<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokoSeeder extends Seeder {

    public function run(): void
    {

        $users = DB::table('users')->where('role', 'pemilik_toko')->orderBy('id')->get();

        if ($users->isEmpty()) {
            $this->command->error(
                'User dengan role pemilik_toko belum tersedia.'
            );

            $this->command->info(
                'Jalankan UserSeeder terlebih dahulu.'
            );

            return;
        }

        $dataToko = [
            [
                'nama_toko' => 'Kopi Banyuwangi',
                'deskripsi' => 'Menyediakan berbagai jenis kopi lokal Banyuwangi dengan kualitas pilihan dari petani kopi daerah.',
                'alamat_lengkap' => 'Jl. Ijen No. 12, Banyuwangi',
                'no_telepon' => '081234567890',
                'foto_profil' => 'toko/kopi-banyuwangi.jpg',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kabupaten Banyuwangi',
                'kecamatan' => 'Banyuwangi',
            ],

            [
                'nama_toko' => 'Batik Osing',
                'deskripsi' => 'Toko batik khas Banyuwangi yang menyediakan berbagai motif batik tradisional dan modern.',
                'alamat_lengkap' => 'Jl. Ahmad Yani No. 25, Banyuwangi',
                'no_telepon' => '081234567891',
                'foto_profil' => 'toko/batik-osing.jpg',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kabupaten Banyuwangi',
                'kecamatan' => 'Giri',
            ],

            [
                'nama_toko' => 'Kerajinan Lokal',
                'deskripsi' => 'Menghadirkan berbagai kerajinan tangan buatan UMKM lokal dengan desain unik dan berkualitas.',
                'alamat_lengkap' => 'Jl. Diponegoro No. 18, Banyuwangi',
                'no_telepon' => '081234567892',
                'foto_profil' => 'toko/kerajinan-lokal.jpg',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kabupaten Banyuwangi',
                'kecamatan' => 'Glagah',
            ],

            [
                'nama_toko' => 'Dapur Bu Siti',
                'deskripsi' => 'Menyediakan makanan ringan, camilan, sambal, dan berbagai olahan makanan khas lokal.',
                'alamat_lengkap' => 'Jl. Kalibaru No. 8, Banyuwangi',
                'no_telepon' => '081234567893',
                'foto_profil' => 'toko/dapur-bu-siti.jpg',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kabupaten Banyuwangi',
                'kecamatan' => 'Kalibaru',
            ],

            [
                'nama_toko' => 'Tani Jaya',
                'deskripsi' => 'Menyediakan hasil pertanian dan peternakan lokal seperti beras, telur, madu, dan produk segar lainnya.',
                'alamat_lengkap' => 'Jl. Rogojampi No. 15, Banyuwangi',
                'no_telepon' => '081234567894',
                'foto_profil' => 'toko/tani-jaya.jpg',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kabupaten Banyuwangi',
                'kecamatan' => 'Rogojampi',
            ],

            [
                'nama_toko' => 'Laut Segar',
                'deskripsi' => 'Menyediakan berbagai hasil perikanan segar langsung dari nelayan dan pembudidaya lokal.',
                'alamat_lengkap' => 'Jl. Pantai Blimbingsari No. 7, Banyuwangi',
                'no_telepon' => '081234567895',
                'foto_profil' => 'toko/laut-segar.jpg',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Kabupaten Banyuwangi',
                'kecamatan' => 'Blimbingsari',
            ],
        ];

        foreach ($dataToko as $index => $toko) {

            $user = $users->get($index);

            if (!$user) {
                $user = $users->first();
            }

            $provinsi = DB::table('provinsi')->where('nama', $toko['provinsi'])->first();

            if (!$provinsi) {
                $this->command->error(
                    "Provinsi {$toko['provinsi']} tidak ditemukan."
                );

                continue;
            }


            $kota = DB::table('kota')->where('nama', $toko['kota'])->where('provinsi_id', $provinsi->id)->first();

            if (!$kota) {
                $this->command->error(
                    "Kota {$toko['kota']} tidak ditemukan."
                );

                continue;
            }

            $kecamatan = DB::table('kecamatan')->where('nama', $toko['kecamatan'])->where('kota_id', $kota->id)->first();

            if (!$kecamatan) {
                $this->command->error(
                    "Kecamatan {$toko['kecamatan']} tidak ditemukan."
                );

                continue;
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
                    'alamat_lengkap' => $toko['alamat_lengkap'],
                    'no_telepon' => $toko['no_telepon'],
                    'foto_profil' => $toko['foto_profil'],
                    'provinsi_id' => $provinsi->id,
                    'kota_id' => $kota->id,
                    'kecamatan_id' => $kecamatan->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info(
            'Data toko berhasil dibuat lengkap dengan data wilayah.'
        );
    }
}