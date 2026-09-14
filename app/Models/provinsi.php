<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    protected $table = 'provinsi';
    
    protected $fillable = [
        'nama'
    ] ;

    public $incrementing = false;

    protected $keyType = 'string';

    public function kota() {
        return $this->belongsTo(kota::class, 'provinsi_id', 'id');
    }
}
