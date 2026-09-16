<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'nama_produk',
        'harga',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'quantity' => 'integer',
        'subtotal' => 'decimal:2',
    ];

    public function pesanan() {
        return $this->belongsTo(pesanan::class, 'pesanan_id');
    }

    public function produk() {
        return $this->belongsTo(produk::class, 'produk_id');
    }
}