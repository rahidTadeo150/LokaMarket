<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class pesananController extends Controller
{

    public function prosesPesanan($nomor_pesanan)
    {

        $user = auth()->user();

        $toko = $user?->toko;

        if (!$toko) {
            return redirect()->back()
                ->with('error', 'Data toko tidak ditemukan.');
        }

        $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->whereHas('detail.produk', function ($query) use ($toko) {
                $query->where('toko_id', $toko->id);
            })
            ->first();

        if (!$pesanan) {
            return redirect()->back()
                ->with('error', 'Pesanan tidak ditemukan atau bukan milik tokomu.');
        }

        if ($pesanan->status !== 'dibayar') {
            return redirect()->back()
                ->with(
                    'error',
                    'Pesanan tidak dapat diproses karena statusnya bukan dibayar.'
                );
        }

        $pesanan->update([
            'status' => 'diproses',
        ]);

        return redirect()
            ->route('seller.pesanan', ['status' => 'dibayar'])
            ->with(
                'success',
                "Pesanan {$pesanan->nomor_pesanan} berhasil diproses."
            );

    }

    public function kirimPesanan(string $nomor_pesanan)
    {

        $toko = auth()->user()?->toko;

        if (!$toko) {
            return back()->with('error', 'Data toko tidak ditemukan.');
        }

        $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->whereHas('detail.produk', function ($query) use ($toko) {
                $query->where('toko_id', $toko->id);
            })->first();

        if (!$pesanan) {
            return back()->with(
                'error',
                'Pesanan tidak ditemukan atau bukan milik tokomu.'
            );
        }

        if ($pesanan->status !== 'diproses') {
            return back()->with(
                'error',
                'Hanya pesanan yang sedang diproses yang dapat dikirim.'
            );
        }

        $pesanan->update([
            'status' => 'dikirim',
        ]);

        return redirect()->route('seller.pesanan', ['status' => 'dikirim'])
            ->with(
                'success',
                "Pesanan {$pesanan->nomor_pesanan} berhasil ditandai sebagai dikirim."
            );

    }

    

}
