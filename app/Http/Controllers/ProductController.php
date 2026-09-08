<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function pilihanProduk(Request $request)
    {
        $kategori = kategori::orderBy('nama', 'asc')->get();
        $produk = produk::with('kategori');

        if ($request->filled('kategori')) {
            $produk->where('slug', $request->kategori);
        }

        switch ($request->input('sort', 'default')) {

            case 'price_low':
                $produk->orderBy('harga', 'asc');
                break;

            case 'price_high':
                $produk->orderBy('harga', 'desc');
                break;


            default:
                $produk->orderBy('created_at', 'asc');
                break;
        }

        return view('user.pilihan-produk', [
            'produk' => $produk->get(),
            'kategori' => $kategori,
            'selectedKategori' => $request->category,
            'sort' => $request->input('sort', 'default'),
        ]);
    }
    
    public function detailProdukPage(Request $request)
    {
        $produk = produk::with('kategori', 'toko')->where('slug', $request->produk)->firstOrFail();

        $toko = $produk->toko;

        $anotherProduk = produk::with('kategori')->inRandomOrder()->take(4);


        $jumlahProduk = $toko->produk()->count();

    return view('user.detail-produk', [
        'produk' => $produk,
        'jumlahProduk' => $jumlahProduk,
        'anotherProduk' => $anotherProduk->get()
    ]);
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
