<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class toko extends Model
{

    protected $table = "toko";

    protected $fillable = [
        'user_id',
        'nama_toko',
        'slug',
        'deskripsi',
        'alamat_lengkap',
        'no_telepon',
        'foto_profil',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'rajaongkir_origin_id',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function produk()
    {

        return $this->hasMany(Produk::class);

    }

    public function provinsi()
    {

        return $this->belongsTo(provinsi::class, 'provinsi_id');

    }

    public function kota()
    {

        return $this->belongsTo(kota::class, 'kota_id');

    }

    public function kecamatan()
    {

        return $this->belongsTo(kecamatan::class, 'kecamatan_id');

    }

    public function saldoPenjual()
    {

        return $this->hasOne(SaldoPenjual::class, 'toko_id');

    }

    public function rekeningPenjual()
    {

        return $this->hasMany(RekeningPenjual::class, 'toko_id');

    }

}
