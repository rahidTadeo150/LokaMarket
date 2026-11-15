<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ulasan_produk extends Model
{
    protected $table = 'ulasan_produk';

    protected $fillable = [
        'user_id',
        'produk_id',
        'detail_pesanan_id',
        'rating',
        'ulasan',
        'tag_ulasan',
    ];

    protected $casts = [
        'rating' => 'integer',
        'tag_ulasan' => 'array',
    ];

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');

    }

    public function produk()
    {

        return $this->belongsTo(produk::class, 'produk_id');

    }

    public function detailPesanan()
    {

        return $this->belongsTo(detail_pesanan::class, 'detail_pesanan_id');

    }

    public function foto()
    {

        return $this->hasMany(foto_ulasan_produk::class, 'ulasan_produk_id');

    }
}
