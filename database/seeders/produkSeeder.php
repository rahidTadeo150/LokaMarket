<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder {

    public function run(): void {

        $kategori = DB::table('kategori')->pluck('id', 'nama');

        $toko = DB::table('toko')->pluck('id', 'nama_toko');

        if ($kategori->isEmpty()) {
            $this->command->error(
                'Data kategori belum tersedia. Jalankan KategoriSeeder terlebih dahulu.'
            );

            return;
        }

        if ($toko->isEmpty()) {
            $this->command->error(
                'Data toko belum tersedia. Jalankan TokoSeeder terlebih dahulu.'
            );

            return;
        }

        $getKategori = function (string $nama) use ($kategori) {
            return $kategori[$nama] ?? $kategori->first();
        };

        $getToko = function (string $nama) use ($toko) {
            return $toko[$nama] ?? $toko->first();
        };

        $produk = [

            [
                'nama' => 'Kopi Robusta Banyuwangi',

                'deskripsi' =>
                    'Kopi robusta asli Banyuwangi dengan aroma kuat dan cita rasa khas pegunungan.',

                'harga' => 45000,

                'stok' => 35,

                'kategori' => 'Minuman',

                'toko' => 'Kopi Banyuwangi',

                'foto' => [
                    'thumbnail' => 'produk/kopi-robusta-banyuwangi.jpg',

                    'preview' => [
                        'produk/kopi-robusta-banyuwangi.jpg',
                        'produk/kopi-robusta-banyuwangi.jpg',
                        'produk/kopi-robusta-banyuwangi.jpg',
                        'produk/kopi-robusta-banyuwangi.jpg',
                    ],
                ],
            ],

            [
                'nama' => 'Kopi Arabika Ijen',

                'deskripsi' =>
                    'Kopi arabika pilihan dari kawasan Ijen dengan aroma harum dan rasa yang lembut.',

                'harga' => 65000,

                'stok' => 25,

                'kategori' => 'Minuman',

                'toko' => 'Kopi Banyuwangi',

                'foto' => [
                    'thumbnail' => 'produk/kopi-arabika-ijen.jpg',

                    'preview' => [
                        'produk/kopi-arabika-ijen.jpg',
                        'produk/kopi-arabika-ijen.jpg',
                        'produk/kopi-arabika-ijen.jpg',
                        'produk/kopi-arabika-ijen.jpg',
                    ],
                ],
            ],

            [
                'nama' => 'Batik Osing Motif Gajah Oling',

                'deskripsi' =>
                    'Batik khas Banyuwangi dengan motif Gajah Oling yang memiliki nilai budaya lokal.',

                'harga' => 175000,

                'stok' => 12,

                'kategori' => 'Fashion',

                'toko' => 'Batik Osing',

                'foto' => [
                    'thumbnail' => 'produk/batik-gajah-oling.jpg',

                    'preview' => [
                        'produk/batik-gajah-oling.jpg',
                        'produk/batik-gajah-oling.jpg',
                        'produk/batik-gajah-oling.jpg',
                        'produk/batik-gajah-oling.jpg',
                    ],
                ],
            ],
        ];

        foreach ($produk as $item) {

            $slug = Str::slug($item['nama']);

            $kategoriId = $getKategori(
                $item['kategori']
            );

            $tokoId = $getToko(
                $item['toko']
            );

            DB::table('produk')->updateOrInsert(
                [
                    'slug' => $slug,
                ],
                [
                    'nama' => $item['nama'],

                    'slug' => $slug,

                    'deskripsi' => $item['deskripsi'],

                    'harga' => $item['harga'],

                    'stok' => $item['stok'],

                    'kategori_id' => $kategoriId,

                    'toko_id' => $tokoId,

                    'is_active' => true,

                    'updated_at' => now(),

                    'created_at' => now(),
                ]
            );

            $produkId = DB::table('produk')->where('slug', $slug)->value('id');

            DB::table('produk_foto')->where('produk_id', $produkId)->delete();

            DB::table('produk_foto')->insert([
                'produk_id' => $produkId,
                'foto' => $item['foto']['thumbnail'],
                'tipe' => 'thumbnail',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($item['foto']['preview'] as $index => $foto) {

                DB::table('produk_foto')->insert([
                    'produk_id' => $produkId,
                    'foto' => $foto,
                    'tipe' => 'preview',
                    'urutan' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }

        $this->command->info(
            'Seeder produk dan foto produk berhasil dijalankan.'
        );

    }
}