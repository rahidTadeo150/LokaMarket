<?php

namespace App\Http\Controllers;

use App\Models\Rekening_penjual;
use App\Models\saldo_penjual;
use App\Models\transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function saldoSayaPage(Request $request)
    {

        $toko = Auth::user()->toko;

        abort_if(! $toko, 403, 'Akun ini belum memiliki toko.');

        $saldo = saldo_penjual::firstOrCreate(['toko_id' => $toko->id], [
            'saldo_pending' => 0,
            'saldo_tersedia' => 0,
            'saldo_ditahan' => 0,
        ]
        );

        $rekening = Rekening_penjual::where('toko_id', $toko->id)->orderByDesc('is_default')->latest()->get();

        $transaksi = transaksi_saldo::where('saldo_penjual_id', $saldo->id)->latest()->paginate(10);

        return view('seller.saldo-saya', compact(
            'saldo',
            'rekening',
            'transaksi'
        ));

    }
}
