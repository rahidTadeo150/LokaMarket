<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class return_produk extends Model
{

    protected $table = "return_produk";
    
    protected $fillable = [
        'pesanan_id',
        'user_id',
        'alasan',
        'keterangan',
        'status',
        'catatan_admin',
    ];

    public function pesanan()
    {

        return $this->belongsTo(Pesanan::class, 'pesanan_id');
        
    }

    public function pengguna()
    {

        return $this->belongsTo(User::class, 'user_id');

    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
        
    }

    public function fotoReturn()
    {

        return $this->hasMany(foto_return_produk::class, 'return_produk_id');

    }

}
