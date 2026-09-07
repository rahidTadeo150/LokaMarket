<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kategori
        $kategori = DB::table('kategori')
            ->pluck('id', 'nama');

        // Ambil semua toko
        $toko = DB::table('toko')
            ->pluck('id', 'nama_toko');

        // Pastikan kategori tersedia
        if ($kategori->isEmpty()) {
            $this->command->error(
                'Data kategori belum tersedia. Jalankan KategoriSeeder terlebih dahulu.'
            );

            return;
        }

        // Pastikan toko tersedia
        if ($toko->isEmpty()) {
            $this->command->error(
                'Data toko belum tersedia. Jalankan TokoSeeder terlebih dahulu.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Helper kategori
        |--------------------------------------------------------------------------
        |
        | Jika nama kategori tidak ditemukan, gunakan kategori pertama.
        |
        */
        $getKategori = function (string $nama) use ($kategori) {
            return $kategori[$nama] ?? $kategori->first();
        };

        /*
        |--------------------------------------------------------------------------
        | Helper toko
        |--------------------------------------------------------------------------
        */
        $getToko = function (string $nama) use ($toko) {
            return $toko[$nama] ?? $toko->first();
        };

        $produk = [
            [
                'nama' => 'Kopi Robusta Banyuwangi',
                'deskripsi' => 'Kopi robusta asli Banyuwangi dengan aroma kuat dan cita rasa khas pegunungan.',
                'harga' => 45000,
                'stok' => 35,
                'gambar' => 'produk/kopi-robusta-banyuwangi.jpg',
                'kategori' => 'Minuman',
                'toko' => 'Kopi Banyuwangi',
            ],

            [
                'nama' => 'Kopi Arabika Ijen',
                'deskripsi' => 'Kopi arabika pilihan dari kawasan Ijen dengan aroma harum dan rasa yang lembut.',
                'harga' => 65000,
                'stok' => 25,
                'gambar' => 'produk/kopi-arabika-ijen.jpg',
                'kategori' => 'Minuman',
                'toko' => 'Kopi Banyuwangi',
            ],

            [
                'nama' => 'Batik Osing Motif Gajah Oling',
                'deskripsi' => 'Batik khas Banyuwangi dengan motif Gajah Oling yang memiliki nilai budaya lokal.',
                'harga' => 175000,
                'stok' => 12,
                'gambar' => 'produk/batik-gajah-oling.jpg',
                'kategori' => 'Fashion',
                'toko' => 'Batik Osing',
            ],
        ];

        foreach ($produk as $item) {

            DB::table('produk')->updateOrInsert(
                [
                    'slug' => Str::slug($item['nama']),
                ],
                [
                    'nama' => $item['nama'],
                    'slug' => Str::slug($item['nama']),
                    'deskripsi' => $item['deskripsi'],
                    'harga' => $item['harga'],
                    'stok' => $item['stok'],
                    'gambar' => $item['gambar'],

                    'kategori_id' => $getKategori($item['kategori']),
                    'toko_id' => $getToko($item['toko']),

                    'is_active' => true,

                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info(
            'Seeder produk berhasil dijalankan.'
        );
    }
}