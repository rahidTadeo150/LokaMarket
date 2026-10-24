<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class saldo_penjual extends Model
{

    protected $table = 'saldo_penjual';

    protected $fillable = [
        'toko_id',
        'saldo_pending',
        'saldo_tersedia',
        'saldo_ditahan',
    ];

    protected function casts(): array
    {
        return [
            'saldo_pending' => 'integer',
            'saldo_tersedia' => 'integer',
            'saldo_ditahan' => 'integer',
        ];
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id');
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiSaldo::class, 'saldo_penjual_id');
    }

    public function penarikan()
    {
        return $this->hasMany(PenarikanSaldo::class, 'saldo_penjual_id');
    }

}
