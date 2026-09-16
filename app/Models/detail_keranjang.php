<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_keranjang extends Model
{
    use HasFactory;

    protected $table = 'detail_keranjang';

    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function keranjang()
    {
        return $this->belongsTo(
            keranjang::class,
            'keranjang_id'
        );
    }

    public function produk()
    {
        return $this->belongsTo(produk::class,'produk_id');
    }
}