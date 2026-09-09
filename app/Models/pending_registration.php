<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pending_registration extends Model
{
    protected $table = "pending_registration";
    protected $fillable = [
        'username',
        'nama',
        'email',
        'no_telp',
        'password',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
