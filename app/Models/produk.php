<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = "produk";
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'rating',
        'stok',
        'berat',
        'gambar',
        'kategori_id',
        'toko_id',
        'is_active',
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function toko() {
        return $this->belongsTo(Toko::class);
    }

    public function foto() {
        return $this->hasMany(produk_foto::class, 'produk_id');
    }

    public function thumbnail() {
        return $this->hasOne(produk_foto::class, 'produk_id')->where('tipe', 'thumbnail');
    }

    public function preview() {
        return $this->hasMany(produk_foto::class, 'produk_id')->where('tipe', 'preview')->orderBy('urutan');
    }

    public function wishlist() {
        return $this->hasMany(Wishlist::class, 'produk_id');
    }
}
