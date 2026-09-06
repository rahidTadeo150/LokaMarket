<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function pilihanProduk(Request $request)
    {
       $produk = produk::with(['kategori', 'toko'])
        ->where('is_active', true)
        ->where('stok', '>', 0)
        ->latest()
        ->get();

        return view('user.pilihan-produk', compact('produk'));
    }
    
    public function detailProdukPage(Request $request)
    {
      return view('user.detail-produk');
    }

    public function detailTokoPage(Request $request)
    {
        return view('user.detail-toko');
    }

    public function kategoriPage(Request $request)
    {
        $kategoriList = kategori::withCount('produks')->orderBy('nama', 'asc')->get();
        return view('user.kategori-produk', compact('kategoriList'));
    }                         
}
