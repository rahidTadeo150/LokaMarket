<?php

namespace App\Services;

use App\Models\Pesanan;
use App\Models\SaldoPenjual;
use App\Models\TransaksiSaldo;
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

                $sudahDicatat = TransaksiSaldo::where(
                    'referensi',
                    $referensi
                )->exists();

                if ($sudahDicatat) {
                    continue;
                }

                $saldo = SaldoPenjual::where('toko_id', $toko->id)->lockForUpdate()->first();

                if (!$saldo) {

                    $saldo = SaldoPenjual::create([
                        'toko_id' => $toko->id,
                        'saldo_pending' => 0,
                        'saldo_tersedia' => 0,
                        'saldo_ditahan' => 0,
                    ]);

                    $saldo = SaldoPenjual::whereKey($saldo->id)->lockForUpdate()->firstOrFail();

                }

                TransaksiSaldo::create([
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

            $transaksiSaldo = TransaksiSaldo::where('pesanan_id', $pesanan->id)->where('status', 'pending')->lockForUpdate()->get();

            if ($transaksiSaldo->isEmpty()) {
                throw new RuntimeException(
                    'Ada kesalahan Teknis Hubungi Cust Services.'
                );
            }

            foreach ($transaksiSaldo as $transaksi) {

                $saldo = SaldoPenjual::where('toko_id', $transaksi->saldoPenjual->toko_id)->lockForUpdate()->firstOrFail();

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

            $transaksiSaldo = TransaksiSaldo::where('pesanan_id', $pesanan->id)->where('status', 'pending')->lockForUpdate()->get();

            if ($transaksiSaldo->isEmpty()) {
                return;
            }

            foreach ($transaksiSaldo as $transaksi) {

                $saldo = SaldoPenjual::where('id', $transaksi->saldo_penjual_id)->lockForUpdate()->firstOrFail();

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

}