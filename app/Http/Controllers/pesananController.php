<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\return_produk;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Midtrans\Transaction;
use App\Services\SaldoPenjualService;

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

    public function pesananSelesai(string $nomor_pesanan, SaldoPenjualService $saldoService)
    {

        try {

            DB::transaction(function () use ($nomor_pesanan, $saldoService) {

                $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', Auth::id())->lockForUpdate()->firstOrFail();

                if (!in_array($pesanan->status, ['diantar', 'dikirim'], true)) {
                    throw new \RuntimeException(
                        'Status pesanan tidak valid untuk diselesaikan.'
                    );
                }

                $pesanan->status = 'selesai';
                $pesanan->save();

                $saldoService->lepaskanSaldoPesanan($pesanan);
            }, 3);

            return back()->with(
                'success',
                'Pesanan selesai, jangan lupa belanja di lokamart lagi, Happy Shipping!.'
            );

        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function pengajuanReturn(Request $request, string $nomor_pesanan, SaldoPenjualService $saldoService)
    {

        $validated = $request->validate([
            'alasan_return' => 'required|string|in:produk_tidak_sesuai,produk_rusak,produk_tidak_diterima,produk_salah,lainnya',
            'keterangan_return' => 'nullable|string|max:1000',
        ], [
            'alasan_return.required' => 'Silakan pilih alasan return.',
            'alasan_return.in' => 'Alasan return tidak valid.',
            'keterangan_return.max' => 'Keterangan maksimal 1000 karakter.',
        ]);

        $userId = $request->user()->id;

        DB::transaction(function () use ($nomor_pesanan, $userId, $validated, $saldoService) {

            $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', $userId)->lockForUpdate()->firstOrFail();

            if ($pesanan->status !== 'dikirim') {
                throw ValidationException::withMessages([
                    'return' => 'return hanya dapat diajukan ketika pesanan berstatus diantar.',
                ]);
            }

            $sudahMengajukan = return_produk::where('pesanan_id', $pesanan->id)
                ->whereIn('status', [
                    'diajukan',
                    'diproses',
                    'disetujui',
                ])->exists();

            if ($sudahMengajukan) {
                throw ValidationException::withMessages([
                    'return' => 'Pesanan ini sudah memiliki pengajuan return.',
                ]);
            }

            return_produk::create([
                'pesanan_id' => $pesanan->id,
                'user_id' => $userId,
                'alasan' => $validated['alasan_return'],
                'keterangan' => $validated['keterangan_return'] ?? null,
                'status' => 'diajukan',
            ]);

            $saldoService->tahanSaldoPesanan($pesanan);

            $pesanan->status = 'pengajuan_return';
            $pesanan->save();
        });

        return redirect()->back()->with(
            'success',
            'Pengajuan return berhasil dikirim. Saldo penjual ditahan selama pemeriksaan.'
        );

    }

    public function cancelOrder(Request $request, string $nomor_pesanan)
    {

        $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', auth()->id())->firstOrFail();

        if ($pesanan->status !== 'menunggu_pembayaran') {

            return back()->with(
                'error',
                'Pesanan tidak dapat dibatalkan pada status saat ini.'
            );

        }

        try {

            $response = Transaction::cancel($pesanan->nomor_pesanan);

            Log::info('Permintaan pembatalan transaksi Midtrans berhasil dikirim.', [
                'nomor_pesanan' => $pesanan->nomor_pesanan,
                'midtrans_response' => $response,
            ]);

            return back()->with(
                'success',
                'Permintaan pembatalan dikirim ke Midtrans. Status pesanan akan diperbarui setelah notifikasi diterima.'
            );

        } catch (\Throwable $e) {
            Log::error('Gagal membatalkan transaksi Midtrans.', [
                'nomor_pesanan' => $pesanan->nomor_pesanan,
                'error' => $e->getMessage(),
            ]);

            return back()->with(
                'error',
                'Transaksi gagal dibatalkan di Midtrans. Silakan coba kembali.'
            );
        }

    }

}
