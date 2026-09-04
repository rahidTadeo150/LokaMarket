<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = [
            [
                'nama' => 'Makanan',
                'icon' => 'fa-utensils',
                'deskripsi' => 'Makanan khas dan olahan UMKM lokal',
            ],
            [
                'nama' => 'Minuman',
                'icon' => 'fa-mug-hot',
                'deskripsi' => 'Minuman lokal, kopi, jamu, dan lainnya',
            ],
            [
                'nama' => 'Sembako',
                'icon' => 'fa-basket-shopping',
                'deskripsi' => 'Kebutuhan pokok sehari-hari',
            ],
            [
                'nama' => 'Hasil Bumi',
                'icon' => 'fa-leaf',
                'deskripsi' => 'Buah, sayur, rempah, madu, dan hasil pertanian',
            ],
            [
                'nama' => 'Fashion',
                'icon' => 'fa-shirt',
                'deskripsi' => 'Batik, pakaian, hijab, tas, dan produk fashion lokal',
            ],
            [
                'nama' => 'Kerajinan',
                'icon' => 'fa-palette',
                'deskripsi' => 'Kerajinan tangan dan karya kreatif UMKM lokal',
            ],
            [
                'nama' => 'Kecantikan',
                'icon' => 'fa-wand-magic-sparkles',
                'deskripsi' => 'Skincare, kosmetik, sabun, dan perawatan tubuh',
            ],
            [
                'nama' => 'Rumah Tangga',
                'icon' => 'fa-house',
                'deskripsi' => 'Peralatan dapur dan kebutuhan rumah tangga',
            ],
            [
                'nama' => 'Souvenir',
                'icon' => 'fa-gift',
                'deskripsi' => 'Oleh-oleh, hampers, buket, dan hadiah khas daerah',
            ],
            [
                'nama' => 'Pertanian',
                'icon' => 'fa-seedling',
                'deskripsi' => 'Bibit, tanaman, pupuk, dan kebutuhan pertanian',
            ],
            [
                'nama' => 'Peternakan & Perikanan',
                'icon' => 'fa-fish',
                'deskripsi' => 'Produk peternakan, perikanan, pakan, dan hasil olahan',
            ],
            [
                'nama' => 'Cemilan & Snack',
                'icon' => 'fa-cookie-bite',
                'deskripsi' => 'Cemilan, makanan ringan, dan snack dari UMKM lokal',
            ],
            [
                'nama' => 'Kebutuhan Anak',
                'icon' => 'fa-child',
                'deskripsi' => 'Mainan, pakaian, dan perlengkapan kebutuhan anak',
            ],
            [
                'nama' => 'Jasa & Layanan',
                'icon' => 'fa-handshake',
                'deskripsi' => 'Jasa desain, jahit, fotografi, servis, dan layanan lokal',
            ],
        ];

        foreach ($kategoriList as $kategori) {
            Kategori::create([
                'nama' => $kategori['nama'],
                'slug' => Str::slug($kategori['nama']),
                'icon' => $kategori['icon'],
                'deskripsi' => $kategori['deskripsi'],
            ]);
        }
    }
}