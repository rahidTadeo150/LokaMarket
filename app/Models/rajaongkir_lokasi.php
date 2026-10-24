<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rajaongkir_lokasi extends Model
{
    
    protected $table = 'rajaongkir_lokasi';

    protected $fillable = [
        'kecamatan_id',
        'provider_destination_id',
        'province_name',
        'city_name',
        'district_name',
        'subdistrict_name',
        'postal_code',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

}
