<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    protected $table = 'kecamatan';
    
    protected $fillable = [
        'nama'
    ] ;

    public $incrementing = false;

    protected $keyType = 'string';

    public function kota() {
        return $this->belongsTo(kota::class, 'kota_id', 'id');
    }
}
