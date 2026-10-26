<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening_penjual extends Model
{

    protected $table = 'rekening_penjual';

    protected $fillable = [
        'toko_id',
        'metode',
        'nama_pemilik',
        'nama_bank',
        'nomor_rekening',
        'is_default',
    ];

    protected function casts(): array
    {

        return [
            'is_default' => 'boolean',
        ];

    }

    public function toko()  
    {

        return $this->belongsTo(Toko::class, 'toko_id');
        
    }
    
}
