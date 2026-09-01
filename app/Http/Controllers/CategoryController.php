<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = [
            [
                'nama' => 'Makanan',
                'jumlah' => 24,
                'icon' => 'fa-utensils',
                'deskripsi' => 'Makanan khas dan olahan UMKM lokal',
            ],

            [
                'nama' => 'Minuman',
                'jumlah' => 18,
                'icon' => 'fa-mug-hot',
                'deskripsi' => 'Minuman lokal, kopi, jamu, dan lainnya',
            ],

            [
                'nama' => 'Sembako',
                'jumlah' => 16,
                'icon' => 'fa-basket-shopping',
                'deskripsi' => 'Kebutuhan pokok sehari-hari',
            ],

            [
                'nama' => 'Hasil Bumi',
                'jumlah' => 20,
                'icon' => 'fa-leaf',
                'deskripsi' => 'Buah, sayur, rempah, madu, dan hasil pertanian',
            ],

            [
                'nama' => 'Fashion',
                'jumlah' => 15,
                'icon' => 'fa-shirt',
                'deskripsi' => 'Batik, pakaian, hijab, tas, dan produk fashion lokal',
            ],

            [
                'nama' => 'Kerajinan',
                'jumlah' => 12,
                'icon' => 'fa-palette',
                'deskripsi' => 'Kerajinan tangan dan karya kreatif UMKM lokal',
            ],

            [
                'nama' => 'Kecantikan',
                'jumlah' => 13,
                'icon' => 'fa-wand-magic-sparkles',
                'deskripsi' => 'Skincare, kosmetik, sabun, dan perawatan tubuh',
            ],

            [
                'nama' => 'Rumah Tangga',
                'jumlah' => 17,
                'icon' => 'fa-house',
                'deskripsi' => 'Peralatan dapur dan kebutuhan rumah tangga',
            ],

            [
                'nama' => 'Souvenir',
                'jumlah' => 14,
                'icon' => 'fa-gift',
                'deskripsi' => 'Oleh-oleh, hampers, buket, dan hadiah khas daerah',
            ],

            [
                'nama' => 'Pertanian',
                'jumlah' => 9,
                'icon' => 'fa-seedling',
                'deskripsi' => 'Bibit, tanaman, pupuk, dan kebutuhan pertanian',
            ],

            [
                'nama' => 'Peternakan & Perikanan',
                'jumlah' => 11,
                'icon' => 'fa-fish',
                'deskripsi' => 'Produk peternakan, perikanan, pakan, dan hasil olahan',
            ],

            [
                'nama' => 'Cemilan & Snack',
                'jumlah' => 8,
                'icon' => 'fa-cookie-bite',
                'deskripsi' => 'Elektronik kecil dan aksesoris dari UMKM lokal',
            ],

            [
                'nama' => 'Kebutuhan Anak',
                'jumlah' => 10,
                'icon' => 'fa-child',
                'deskripsi' => 'Mainan, pakaian, dan perlengkapan kebutuhan anak',
            ],

            [
                'nama' => 'Jasa & Layanan',
                'jumlah' => 7,
                'icon' => 'fa-handshake',
                'deskripsi' => 'Jasa desain, jahit, fotografi, servis, dan layanan lokal (SEGERA HADIR)',
            ],

        ];

        $query = $request->query('q');

        if ($query) {
            $kategoriList = collect($kategoriList)
                ->filter(function ($kategori) use ($query) {
                    return Str::contains(
                        strtolower($kategori['nama']),
                        strtolower($query)
                    );
                })
                ->values()
                ->all();
        }

        return view('user.kategori-produk', compact(
            'kategoriList',
        ));
    }
}