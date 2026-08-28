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
                'nama' => 'Fashion',
                'jumlah' => 15,
                'icon' => 'fa-shirt',
                'deskripsi' => 'Batik, pakaian, dan produk fashion lokal',
            ],
            [
                'nama' => 'Kerajinan',
                'jumlah' => 12,
                'icon' => 'fa-palette',
                'deskripsi' => 'Kerajinan tangan khas UMKM lokal',
            ],
            [
                'nama' => 'Hasil Bumi',
                'jumlah' => 20,
                'icon' => 'fa-leaf',
                'deskripsi' => 'Buah, sayur, madu, dan hasil pertanian',
            ],
            [
                'nama' => 'Sembako',
                'jumlah' => 16,
                'icon' => 'fa-basket-shopping',
                'deskripsi' => 'Kebutuhan pokok sehari-hari',
            ],
            [
                'nama' => 'Kesehatan',
                'jumlah' => 10,
                'icon' => 'fa-heart-pulse',
                'deskripsi' => 'Produk kesehatan dan herbal lokal',
            ],
            [
                'nama' => 'Oleh-Oleh',
                'jumlah' => 14,
                'icon' => 'fa-gift',
                'deskripsi' => 'Oleh-oleh khas daerah dan produk lokal',
            ],
        ];

        $trending = [
            'Makanan',
            'Kopi',
            'Batik',
            'Keripik',
            'Madu',
            'Buah Lokal',
            'Tas Anyaman',
            'Sambal',
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
            'trending'
        ));
    }
}