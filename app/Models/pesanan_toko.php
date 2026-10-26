<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pesanan_toko extends Model
{
     protected $table = 'pesanan_toko';

    protected $fillable = [
        'pesanan_id',
        'toko_id',
        'subtotal',
        'ongkir',
        'komisi',
        'total_penjual',
        'status',
        'nomor_resi',
        'dikirim_at',
        'selesai_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'ongkir' => 'decimal:2',
            'komisi' => 'decimal:2',
            'total_penjual' => 'decimal:2',
            'dikirim_at' => 'datetime',
            'selesai_at' => 'datetime',
        ];
    }

    public function pesanan()
    {

        return $this->belongsTo(pesanan::class,'pesanan_id');

    }

    public function toko()
    {

        return $this->belongsTo(toko::class, 'toko_id');

    }

    public function detail()
    {

        return $this->hasMany(detail_pesanan::class, 'pesanan_toko_id');
        
    }
}
