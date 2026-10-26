<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'pesanan_id',
        'metode',
        'status',
        'transaction_id',
        'jumlah',
    ];

    public function pesanan()
    {

        return $this->belongsTo(Pesanan::class, 'pesanan_id');
        
    }
}
