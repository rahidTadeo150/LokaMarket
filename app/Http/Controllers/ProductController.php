<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function pilihanProduk(Request $request)
    {
        $categories = [
            'Makanan',
            'Minuman',
            'Fashion',
            'Kerajinan',
            'Hasil Bumi',
            'Sembako',
            'Kesehatan',
            'Oleh-Oleh',
        ];

        $products = [
            [
                'id' => 1,
                'name' => 'Ikan Pencil Bur Isi',
                'category' => 'Makanan',
                'price' => 12000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/FF6B35/FFFFFF?text=Ikan+Pencil',
                'rating' => 5,
                'reviewCount' => 341,
                'badge' => 'Populer',
            ],
            [
                'id' => 2,
                'name' => 'Kopi Tubruk Gak Man',
                'category' => 'Minuman',
                'price' => 8000,
                'originalPrice' => 15000,
                'image' => 'https://via.placeholder.com/300x300/8B5A3C/FFFFFF?text=Kopi+Tubruk',
                'rating' => 4,
                'reviewCount' => 567,
                'badge' => 'Diskon',
            ],
            [
                'id' => 3,
                'name' => 'Kripik Tempe Renyah',
                'category' => 'Makanan',
                'price' => 15000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/FFD700/FFFFFF?text=Kripik+Tempe',
                'rating' => 5,
                'reviewCount' => 432,
                'badge' => 'Pilihan',
            ],
            [
                'id' => 4,
                'name' => 'Nasi Anyaman Bambu',
                'category' => 'Kerajinan',
                'price' => 45000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/228B22/FFFFFF?text=Anyaman+Bambu',
                'rating' => 5,
                'reviewCount' => 289,
                'badge' => null,
            ],
            [
                'id' => 5,
                'name' => 'Batik Tuli Motif Perang',
                'category' => 'Fashion',
                'price' => 150000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/A0522D/FFFFFF?text=Batik+Tuli',
                'rating' => 5,
                'reviewCount' => 612,
                'badge' => 'Trending',
            ],
            [
                'id' => 6,
                'name' => 'Madu Hutan Asli',
                'category' => 'Hasil Bumi',
                'price' => 60000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/D2691E/FFFFFF?text=Madu+Hutan',
                'rating' => 4,
                'reviewCount' => 521,
                'badge' => null,
            ],
            [
                'id' => 7,
                'name' => 'Jambu Bersisi Karasen',
                'category' => 'Hasil Bumi',
                'price' => 18000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/FF8C00/FFFFFF?text=Jambu+Karasen',
                'rating' => 5,
                'reviewCount' => 498,
                'badge' => null,
            ],
            [
                'id' => 8,
                'name' => 'Jidisui Herbal Alami',
                'category' => 'Kesehatan',
                'price' => 22000,
                'originalPrice' => null,
                'image' => 'https://via.placeholder.com/300x300/4169E1/FFFFFF?text=Jidisui+Herbal',
                'rating' => 4,
                'reviewCount' => 356,
                'badge' => 'Baru',
            ],
        ];

        $selectedCategories = $request->input('category', []);
        $selectedCategories = is_array($selectedCategories) ? $selectedCategories : [$selectedCategories];
        $selectedCategories = array_values(array_filter(array_map('trim', $selectedCategories)));

        if (! empty($selectedCategories)) {
            $selectedCategory = $selectedCategories[0];
            $products = array_values(array_filter($products, function ($product) use ($selectedCategory) {
                return $product['category'] === $selectedCategory;
            }));
        }

        $sort = $request->input('sort', 'default');

        if ($sort === 'price_low') {
            usort($products, fn ($a, $b) => $a['price'] <=> $b['price']);
        } elseif ($sort === 'price_high') {
            usort($products, fn ($a, $b) => $b['price'] <=> $a['price']);
        }

        return view('user.pilihan-produk', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
            'sort' => $sort,
        ]);
    }
    public function detailProdukPage(Request $request)
    {
      return view('user.detail-produk');
    }
}
