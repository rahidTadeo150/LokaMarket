<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pending_pengajuan_toko extends Model
{
    use HasFactory;

    protected $table = 'pending_pengajuan_toko';

    protected $fillable = [
        'user_id',
        'nama_toko',
        'slug',
        'deskripsi',
        'foto_profil',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kode_pos',
        'alamat_lengkap',
        'no_telepon',
        'foto_ktp',
        'token_verifikasi',
        'token_expired_at',
    ];

    protected $casts = [
        'token_expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}