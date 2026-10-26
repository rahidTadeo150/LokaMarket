<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi_saldo extends Model
{
    protected $table = 'transaksi_saldo';

    protected $fillable = [
        'saldo_penjual_id',
        'pesanan_id',
        'pesanan_toko_id',
        'penarikan_saldo_id',
        'referensi',
        'jenis',
        'status',
        'jumlah',
        'komisi',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'komisi' => 'integer',
        ];
    }

    public function saldoPenjual()
    {

        return $this->belongsTo(saldo_penjual::class, 'saldo_penjual_id');

    }

    public function pesanan()
    {

        return $this->belongsTo(pesanan::class, 'pesanan_id');

    }

    public function pesananToko()
    {

        return $this->belongsTo(pesanan_toko::class, 'pesanan_toko_id');

    }

    public function penarikanSaldo()
    {

        return $this->belongsTo(Penarikan_saldo::class, 'penarikan_saldo_id');

    }
}
