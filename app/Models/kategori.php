<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategori";
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
