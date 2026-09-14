<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan_toko extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_toko';

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
        'email_verified_at',
        'status',
        'alasan_reject',
        'by_admin',
    ];

    protected $casts = [
        'token_expired_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function pemeriksa()
    {
        return $this->belongsTo(User::class, 'diperiksa_oleh');
    }
}
