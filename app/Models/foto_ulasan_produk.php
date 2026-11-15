<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class foto_ulasan_produk extends Model
{
    protected $table = 'foto_ulasan_produk';

    protected $fillable = [
        'ulasan_produk_id',
        'foto',
    ];

    public function ulasan(): BelongsTo
    {

        return $this->belongsTo(ulasan_produk::class, 'ulasan_produk_id');

    }
}
