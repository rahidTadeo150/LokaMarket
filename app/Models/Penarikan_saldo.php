<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan_saldo extends Model
{
    protected $table = 'penarikan_saldo';

    protected $fillable = [
        'saldo_penjual_id',
        'rekening_penjual_id',
        'diproses_oleh',
        'nomor_penarikan',
        'jumlah',
        'status',
        'referensi_transfer',
        'catatan_admin',
        'diproses_pada',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'diproses_pada' => 'datetime',
        ];
    }

    public function saldoPenjual()
    {
        return $this->belongsTo(SaldoPenjual::class, 'saldo_penjual_id');
    }

    public function rekening()
    {
        return $this->belongsTo(RekeningPenjual::class, 'rekening_penjual_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }
}
