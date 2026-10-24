<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class foto_return_produk extends Model
{
    protected $table = 'foto_return_produk';

    protected $fillable = [
        'return_produk_id',
        'foto_path',
    ];

    public function pengajuanReturn()
    {
        return $this->belongsTo(return_produk::class, 'return_produk_id');
    }
}
