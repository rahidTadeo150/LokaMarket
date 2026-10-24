<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alamat_pengguna extends Model
{
    use HasFactory;

    protected $table = 'alamat_pengguna';

    protected $fillable = [
        'user_id',
        'label',
        'nama_penerima',
        'no_telepon',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kode_pos',
        'alamat_lengkap',
        'catatan',
        'is_default',
    ];

    protected $casts = [
        'is_utama' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function provinsi() {
        return $this->belongsTo(provinsi::class, 'provinsi_id');
    }

    public function kota() {
        return $this->belongsTo(kota::class,'kota_id');
    }

    public function kecamatan() {
        return $this->belongsTo(kecamatan::class, 'kecamatan_id');
    }
}