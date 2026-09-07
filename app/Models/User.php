<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'no_telp',
        'password',
        'role',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_lahir' => 'date',
            'password' => 'hashed',
        ];
    }

     public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isPemilikToko(): bool
    {
        return $this->role === 'pemilik_toko';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function store()
    {
        return $this->hasOne(toko::class);
    }
}
