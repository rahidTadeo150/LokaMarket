<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use App\Models\User;
use App\Notifications\notificationLokaMarket;
use App\Services\SaldoPenjualService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Transaction;

class pesananController extends Controller
{
    public function daftarPesananPage(Request $request)
    {

        $user = auth()->user();

        $toko = $user->toko;

        if (! $toko) {
            return redirect()->back()->with('error', 'Data toko tidak ditemukan.');
        }

        $statusValid = ['dibayar', 'diproses', 'dikirim'];

        $status = $request->query('status', 'dibayar');

        if (! in_array($status, $statusValid, true)) {
            $status = 'dibayar';
        }

        $query = pesanan::query()->where('status', $status)->whereHas('detail.produk', function ($q) use ($toko) {
            $q->where('toko_id', $toko->id);
        })->with([
            'user',
            'provinsi',
            'kota',
            'kecamatan',
            'detail.produk.thumbnail',
        ])->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;

            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('nomor_pesanan', 'like', "%{$search}%")
                    ->orWhere('nama_penerima', 'like', "%{$search}%");
            });
        })->latest();

        $pesanan = $query->paginate(10)->withQueryString();

        $jumlahDibayar = pesanan::where('status', 'dibayar')->whereHas('detail.produk', fn ($q) => $q->where('toko_id', $toko->id))->count();
        $jumlahDiproses = pesanan::where('status', 'diproses')->whereHas('detail.produk', fn ($q) => $q->where('toko_id', $toko->id))->count();
        $jumlahDikirim = pesanan::where('status', 'dikirim')->whereHas('detail.produk', fn ($q) => $q->where('toko_id', $toko->id))->count();

        return view('seller.daftar-pesanan', compact(
            'toko',
            'pesanan',
            'jumlahDibayar',
            'jumlahDiproses',
            'jumlahDikirim',
            'status'
        ));

    }

    public function prosesPesanan($nomor_pesanan)
    {

        $user = auth()->user();

        $toko = $user?->toko;

        if (! $toko) {

            return redirect()->back()
                ->with('error', 'Data toko tidak ditemukan.');

        }

        $pesanan = pesanan::where('nomor_pesanan', $nomor_pesanan)
            ->whereHas('detail.produk', function ($query) use ($toko) {

                $query->where('toko_id', $toko->id);

            })->first();

        if (! $pesanan) {

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

        $customer = User::find($pesanan->user_id);

        if ($customer) {

            $customer->notify(

                new notificationLokaMarket(
                    'Pesanan Sedang Diproses',
                    'Pesanan '.
                    $pesanan->nomor_pesanan.
                    ' telah mulai diproses oleh penjual. Silakan tunggu informasi pengiriman selanjutnya.',
                    route('cust.checkout.status', [
                        'nomor_pesanan' => $pesanan->nomor_pesanan,
                    ]),
                    'fa-box-open'
                )

            );

        }

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

        if (! $toko) {

            return back()->with('error', 'Data toko tidak ditemukan.');

        }

        $pesanan = pesanan::where('nomor_pesanan', $nomor_pesanan)
            ->whereHas('detail.produk', function ($query) use ($toko) {

                $query->where('toko_id', $toko->id);

            })->first();

        if (! $pesanan) {

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

        $customer = User::find($pesanan->user_id);

        if ($customer) {

            $customer->notify(

                new notificationLokaMarket(
                    'Pesanan Telah Dikirim',
                    'Pesanan '.
                    $pesanan->nomor_pesanan.
                    ' telah dikirim oleh penjual. Silakan pantau status pengiriman dan tunggu pesanan tiba di alamat tujuan.',
                    route('cust.checkout.status', [
                        'nomor_pesanan' => $pesanan->nomor_pesanan,
                    ]),
                    'fa-truck-fast'
                )

            );

        }

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

                $pesanan = pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', Auth::id())->lockForUpdate()->firstOrFail();

                if (! in_array($pesanan->status, ['diantar', 'dikirim'], true)) {
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

    public function cancelPesanan(Request $request, string $nomor_pesanan)
    {

        $pesanan = pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', auth()->id())->firstOrFail();

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
