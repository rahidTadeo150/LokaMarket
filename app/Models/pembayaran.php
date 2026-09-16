<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pesanan_id',
        'metode',
        'status',
        'transaction_id',
        'jumlah',
        'snap_token',
        'dibayar_at',
        'expired_at',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'dibayar_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function pesanan() {
        return $this->belongsTo(pesanan::class, 'pesanan_id');
    }
}