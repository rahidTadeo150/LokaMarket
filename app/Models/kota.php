<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    protected $table = 'kota';

    public $incrementing = false;

    protected $fillable = [
        'nama'
    ] ;
    
    protected $keyType = 'string';

    public function provinsi() {
        return $this->belongsTo(provinsi::class, 'provinsi_id', 'id');
    }

    public function kecamatan() {
        return $this->hasMany(kecamatan::class, 'kota_id', 'id');
    }
}
