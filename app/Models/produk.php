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
        'stok',
        'gambar',
        'kategori_id',
        'toko_id',
        'is_active',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
