<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'nomor_pesanan',
        'nama_penerima',
        'no_telepon',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kode_pos',
        'alamat_lengkap',
        'catatan',
        'subtotal',
        'ongkir',
        'total_pembayaran',
        'status',
        'dibayar_at',
        'selesai_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'ongkir' => 'decimal:2',
        'total_pembayaran' => 'decimal:2',
        'dibayar_at' => 'datetime',
        'selesai_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detail() {
        return $this->hasMany(detail_pesanan::class, 'pesanan_id');
    }

    public function pembayaran() {
        return $this->hasOne(pembayaran::class, 'pesanan_id');
    }

    public function provinsi() {
        return $this->belongsTo(provinsi::class, 'provinsi_id');
    }

    public function kota() {
        return $this->belongsTo(kota::class, 'kota_id');
    }

    public function kecamatan() {
        return $this->belongsTo(kecamatan::class, 'kecamatan_id');
    }
}