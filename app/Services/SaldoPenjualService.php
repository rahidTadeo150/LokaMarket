<?php

namespace App\Services;

use App\Models\Pesanan;
use App\Models\saldo_penjual;
use App\Models\SaldoPenjual;
use App\Models\transaksi_saldo;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SaldoPenjualService
{

    public function catatPembayaran(Pesanan $pesanan): void
    {

        DB::transaction(function () use ($pesanan) {

            $pesanan = Pesanan::with('detail.produk.toko')->whereKey($pesanan->id)->lockForUpdate()->firstOrFail();

            foreach ($pesanan->detail as $detail) {

                $produk = $detail->produk;

                if (!$produk || !$produk->toko) {
                    throw new \RuntimeException(
                        "Produk atau toko tidak ditemukan untuk detail pesanan {$detail->id}."
                    );
                }

                $toko = $produk->toko;

                $subtotal = (int) $detail->subtotal;

                $komisi = (int) round($subtotal * 0.03);
                $pendapatanPenjual = $subtotal - $komisi;

                $referensi = "PAYMENT:{$pesanan->id}:DETAIL:{$detail->id}";

                $sudahDicatat = transaksi_saldo::where(
                    'referensi',
                    $referensi
                )->exists();

                if ($sudahDicatat) {
                    continue;
                }

                $saldo = saldo_penjual::where('toko_id', $toko->id)->lockForUpdate()->first();

                if (!$saldo) {

                    $saldo = saldo_penjual::create([
                        'toko_id' => $toko->id,
                        'saldo_pending' => 0,
                        'saldo_tersedia' => 0,
                        'saldo_ditahan' => 0,
                    ]);

                    $saldo = saldo_penjual::whereKey($saldo->id)->lockForUpdate()->firstOrFail();

                }

                transaksi_saldo::create([
                    'saldo_penjual_id' => $saldo->id,
                    'pesanan_id' => $pesanan->id,
                    'penarikan_saldo_id' => null,
                    'referensi' => $referensi,
                    'jenis' => 'pendapatan',
                    'status' => 'pending',
                    'jumlah' => $pendapatanPenjual,
                    'komisi' => $komisi,
                    'keterangan' => "Pendapatan pesanan {$pesanan->nomor_pesanan}",
                ]);

                $saldo->saldo_pending += $pendapatanPenjual;
                $saldo->save();

            }

        });

    }

    public function lepaskanSaldoPesanan(Pesanan $pesanan): void
    {

        DB::transaction(function () use ($pesanan) {

            $transaksiSaldo = transaksi_saldo::where('pesanan_id', $pesanan->id)->where('status', 'pending')->lockForUpdate()->get();

            if ($transaksiSaldo->isEmpty()) {
                throw new RuntimeException(
                    'Ada kesalahan Teknis Hubungi Cust Services.'
                );
            }

            foreach ($transaksiSaldo as $transaksi) {

                $saldo = transaksi_saldo::where('toko_id', $transaksi->saldoPenjual->toko_id)->lockForUpdate()->firstOrFail();

                $jumlah = (float) $transaksi->jumlah;

                if ($jumlah <= 0) {
                    throw new RuntimeException(
                        'Jumlah saldo yang akan dilepaskan tidak valid.'
                    );
                }

                if ((float) $saldo->saldo_pending < $jumlah) {
                    throw new RuntimeException(
                        'Saldo pending tidak mencukupi.'
                    );
                }

                $saldo->saldo_pending -= $jumlah;
                $saldo->saldo_tersedia += $jumlah;
                $saldo->save();

                $transaksi->status = 'tersedia';
                $transaksi->save();
            }
        }, 3);
    }

    public function tahanSaldoPesanan(Pesanan $pesanan): void
    {

        DB::transaction(function () use ($pesanan) {

            $transaksiSaldo = transaksi_saldo::where('pesanan_id', $pesanan->id)->where('status', 'pending')->lockForUpdate()->get();

            if ($transaksiSaldo->isEmpty()) {
                return;
            }

            foreach ($transaksiSaldo as $transaksi) {

                $saldo = saldo_penjual::where('id', $transaksi->saldo_penjual_id)->lockForUpdate()->firstOrFail();

                $jumlah = (float) $transaksi->jumlah;

                if ($jumlah <= 0) {
                    throw new RuntimeException(
                        'Jumlah transaksi saldo tidak valid.'
                    );
                }

                if ((float) $saldo->saldo_pending < $jumlah) {
                    throw new RuntimeException(
                        'Saldo pending tidak mencukupi untuk dipindahkan.'
                    );
                }

                $saldo->saldo_pending = (float) $saldo->saldo_pending - $jumlah;
                $saldo->saldo_ditahan = (float) $saldo->saldo_ditahan + $jumlah;

                $saldo->save();

                $transaksi->status = 'ditahan';
                $transaksi->save();

            }

        }, 3);

    }

    public function bekukanSaldoPesanan(Pesanan $pesanan): void
    {

        DB::transaction(function () use ($pesanan) {

            $transaksiSaldo = transaksi_saldo::where('pesanan_id', $pesanan->id)->lockForUpdate()->get();

            if ($transaksiSaldo->isEmpty()) {

                throw new RuntimeException(
                    'Transaksi saldo untuk pesanan ini tidak ditemukan.'
                );

            }

            foreach ($transaksiSaldo as $transaksi) {

                if ($transaksi->status === 'ditahan') {
                    continue;
                }

                if (!in_array($transaksi->status, ['pending', 'tersedia'], true)) {

                    throw new RuntimeException(
                        "Transaksi saldo {$transaksi->id} tidak dapat dibekukan karena statusnya tidak valid."
                    );

                }

                $saldo = saldo_penjual::whereKey($transaksi->saldo_penjual_id)->lockForUpdate()->firstOrFail();

                $jumlah = (float) $transaksi->jumlah;

                if ($jumlah <= 0) {

                    throw new RuntimeException(
                        'Jumlah transaksi saldo tidak valid.'
                    );

                }

                if ($transaksi->status === 'pending') {

                    if ((float) $saldo->saldo_pending < $jumlah) {

                        throw new RuntimeException(
                            'Saldo pending tidak mencukupi untuk dibekukan.'
                        );

                    }

                    $saldo->saldo_pending = (float) $saldo->saldo_pending - $jumlah;

                } elseif ($transaksi->status === 'tersedia') {

                    if ((float) $saldo->saldo_tersedia < $jumlah) {

                        throw new RuntimeException(
                            'Saldo tersedia tidak mencukupi untuk dibekukan.'
                        );

                    }

                    $saldo->saldo_tersedia = (float) $saldo->saldo_tersedia - $jumlah;

                }

                $saldo->saldo_ditahan = (float) $saldo->saldo_ditahan + $jumlah;

                $saldo->save();

                $transaksi->update([
                    'status' => 'ditahan',
                    'keterangan' => "Saldo dibekukan karena pengajuan return pesanan {$pesanan->nomor_pesanan}.",
                ]);

            }
        }, 3);
        
    }

    public function lepaskanSaldoBekuanReturn(Pesanan $pesanan): void
    {
        DB::transaction(function () use ($pesanan) {

            $transaksiSaldo = transaksi_saldo::where('pesanan_id', $pesanan->id)->where('status', 'ditahan')->lockForUpdate()->get();

            if ($transaksiSaldo->isEmpty()) {
                return;
            }

            foreach ($transaksiSaldo as $transaksi) {

                $saldo = saldo_penjual::whereKey($transaksi->saldo_penjual_id)->lockForUpdate()->firstOrFail();

                $jumlah = (float) $transaksi->jumlah;

                if ($jumlah <= 0) {

                    throw new RuntimeException(
                        'Jumlah saldo yang akan dilepaskan tidak valid.'
                    );

                }

                if ((float) $saldo->saldo_ditahan < $jumlah) {

                    throw new RuntimeException(
                        'Saldo ditahan tidak mencukupi untuk dilepaskan.'
                    );

                }

                $saldo->saldo_ditahan = (float) $saldo->saldo_ditahan - $jumlah;

                $saldo->saldo_tersedia = (float) $saldo->saldo_tersedia + $jumlah;

                $saldo->save();

                $transaksi->update([
                    'status' => 'tersedia',
                    'keterangan' => "Saldo tersedia kembali karena pengajuan return pesanan {$pesanan->nomor_pesanan} ditolak.",
                ]);

            }

        }, 3);

    }

}