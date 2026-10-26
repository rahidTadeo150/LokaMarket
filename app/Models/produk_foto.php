<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk_foto extends Model
{
    protected $table = 'produk_foto';

    protected $fillable = [
        'produk_id',
        'foto',
        'tipe',
        'urutan',
    ];

    public function produk() 
    {

        return $this->belongsTo(produk::class, 'produk_id');
        
    }
}
