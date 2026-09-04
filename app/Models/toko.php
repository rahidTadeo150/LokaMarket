<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    protected $tab = "toko";
    protected $fillable = [
        'user_id',
        'nama_toko',
        'slug',
        'deskripsi',
        'alamat',
        'no_telepon',
        'foto_profil',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
