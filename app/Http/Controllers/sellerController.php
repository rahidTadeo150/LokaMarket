<?php

namespace App\Http\Controllers;

use App\Models\detail_pesanan;
use App\Models\pesanan;
use App\Models\pesanan_toko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class sellerController extends Controller
{
    public function dashboardSeller()
    {

        $user = Auth::user();
        $toko = $user->toko;

        abort_unless($toko, 404, 'Data toko tidak ditemukan.');

        $tokoId = $toko->id;
        $sekarang = now();

        $awalBulan = $sekarang->copy()->startOfMonth();
        $awalBulanLalu = $sekarang->copy()->subMonth()->startOfMonth();
        $akhirBulanLalu = $sekarang->copy()->subMonth()->endOfMonth();

        $pesananToko = pesanan_toko::query()->where('toko_id', $tokoId);

        $statusPenjualan = [
            'dibayar',
            'diproses',
            'dikirim',
            'selesai',
        ];

        $totalPenjualan = (clone $pesananToko)->whereIn('status', $statusPenjualan)
            ->whereBetween('created_at', [
                $awalBulan,
                $sekarang,
            ])->sum('total_penjual');

        $penjualanBulanLalu = (clone $pesananToko)->whereIn('status', $statusPenjualan)
            ->whereBetween('created_at', [
                $awalBulanLalu,
                $akhirBulanLalu,
            ])->sum('total_penjual');

        if ($penjualanBulanLalu > 0) {

            $trenGrafik = (
                ($totalPenjualan - $penjualanBulanLalu)
                / $penjualanBulanLalu
            ) * 100;

        } else {

            $trenGrafik = $totalPenjualan > 0 ? 100 : 0;

        }

        $trenGrafik = round($trenGrafik, 2);

        $totalPesanan = (clone $pesananToko)->whereIn('status', $statusPenjualan)
            ->whereBetween('created_at', [
                $awalBulan,
                $sekarang,
            ])->count();

        $pesananSelesai = (clone $pesananToko)->where('status', 'selesai')->count();

        $totalProduk = DB::table('produk')->where('toko_id', $tokoId)->count();

        $produkAktif = DB::table('produk')->where('toko_id', $tokoId)->where('is_active', true)->count();

        $statistik = [
            'total_penjualan' => $totalPenjualan,
            'total_pesanan' => $totalPesanan,
            'total_produk' => $totalProduk,
            'produk_aktif' => $produkAktif,
            'pesanan_selesai' => $pesananSelesai,
        ];

        $ringkasanPesanan = [
            [
                'label' => 'Menunggu Pembayaran',
                'jumlah' => (clone $pesananToko)
                    ->where('status', 'menunggu_pembayaran')
                    ->count(),
                'warna' => 'orange',
                'icon' => 'fa-clock',
                'deskripsi' => 'Pesanan menunggu pembayaran',
            ],
            [
                'label' => 'Perlu Diproses',
                'jumlah' => (clone $pesananToko)
                    ->where('status', 'dibayar')
                    ->count(),
                'warna' => 'blue',
                'icon' => 'fa-box-open',
                'deskripsi' => 'Pesanan sudah dibayar',
            ],
            [
                'label' => 'Dalam Pengiriman',
                'jumlah' => (clone $pesananToko)
                    ->where('status', 'dikirim')
                    ->count(),
                'warna' => 'emerald',
                'icon' => 'fa-truck',
                'deskripsi' => 'Pesanan sedang dikirim',
            ],
        ];

        $dataPesanan = (clone $pesananToko)->orderByDesc('created_at')->limit(4)->get();

        $labelStatus = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'dibayar' => 'Pesanan Baru',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $pesanan = $dataPesanan->map(function ($item) use ($labelStatus) {

            $item->kode = '#PESANAN-'.$item->pesanan_id;

            $item->total = $item->total_penjual;

            $item->status_label = $labelStatus[$item->status]
                ?? ucfirst(str_replace('_', ' ', $item->status));

            $item->waktu = $item->created_at->diffForHumans();

            $item->warna = match ($item->status) {
                'menunggu_pembayaran' => 'orange',
                'dibayar' => 'blue',
                'diproses' => 'orange',
                'dikirim' => 'purple',
                'selesai' => 'green',
                'dibatalkan' => 'red',
                default => 'gray',
            };

            return $item;

        });

        $grafik = [];
        $hari = [];

        for ($i = 6; $i >= 0; $i--) {

            $tanggal = $sekarang->copy()->subDays($i);

            $penjualanHarian = (clone $pesananToko)->whereIn('status', $statusPenjualan)->whereDate('created_at', $tanggal->toDateString())->sum('total_penjual');

            $grafik[] = $penjualanHarian;

            $hari[] = $tanggal->translatedFormat('D');
        }

        $totalPenjualanGrafik = array_sum($grafik);

        $nilaiMaksimum = max($grafik) ?: 1;

        $lebarGrafik = 600;
        $tinggiGrafik = 200;

        $jarak = $lebarGrafik / 6;

        $titikGrafik = [];
        $grafikPoint = [];

        foreach ($grafik as $index => $nilai) {

            $x = round($index * $jarak, 2);

            $y = round(
                $tinggiGrafik - (($nilai / $nilaiMaksimum) * 180),
                2
            );

            $titikGrafik[] = $x.','.$y;

            $grafikPoint[] = [
                'x' => $x,
                'y' => $y,
                'nilai' => 'Rp'.number_format(
                    $nilai,
                    0,
                    ',',
                    '.'
                ),
            ];
        }

        $grafikLinePath = 'M '.implode(' L ', $titikGrafik);

        $grafikAreaPath = $grafikLinePath.' L 600,200 L 0,200 Z';

        $grafik = $grafikPoint;

        $labelGrafik = $hari;

        return view('seller.dashboard-seller', compact(
            'toko',
            'totalProduk',
            'statistik',
            'pesanan',
            'ringkasanPesanan',
            'grafik',
            'hari',
            'grafikLinePath',
            'grafikAreaPath',
            'labelGrafik',
            'totalPenjualanGrafik',
            'trenGrafik'
        ));
    }

    public function laporanToko()
    {

        $toko = auth()->user()->toko;

        abort_unless($toko, 404);

        $statusPenjualan = [
            'dibayar',
            'diproses',
            'dikirim',
            'selesai',
        ];

        $pesananToko = pesanan_toko::where('toko_id', $toko->id);

        $awalBulanIni = now()->startOfMonth();
        $akhirBulanIni = now()->endOfMonth();

        $awalBulanLalu = now()->subMonthNoOverflow()->startOfMonth();
        $akhirBulanLalu = now()->subMonthNoOverflow()->endOfMonth();

        $pendapatanBulanIni = (clone $pesananToko)->whereIn('status', $statusPenjualan)->whereBetween('created_at', [$awalBulanIni, now()])->sum('total_penjual');

        $pendapatanBulanLalu = (clone $pesananToko)->whereIn('status', $statusPenjualan)->whereBetween('created_at', [$awalBulanLalu, $akhirBulanLalu])->sum('total_penjual');

        $pertumbuhan = $pendapatanBulanLalu > 0 ? (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100 : ($pendapatanBulanIni > 0 ? 100 : 0);

        $totalPesanan = (clone $pesananToko)->count();

        $totalPelanggan = pesanan::whereHas('pesananToko', function ($query) use ($toko) {

            $query->where('toko_id', $toko->id);

        })->distinct('user_id')->count('user_id');

        $grafikPendapatan = collect();

        for ($i = 5; $i >= 0; $i--) {

            $tanggal = now()->subMonthsNoOverflow($i);

            $awal = $tanggal->copy()->startOfMonth();
            $akhir = $tanggal->copy()->endOfMonth();

            $pendapatan = (clone $pesananToko)->whereIn('status', $statusPenjualan)->whereBetween('created_at', [$awal, $akhir])->sum('total_penjual');

            $grafikPendapatan->push([
                'bulan' => $tanggal->translatedFormat('M'),
                'total' => $pendapatan,
            ]);

        }

        $maksPendapatan = max(
            $grafikPendapatan->pluck('total')->all() ?: [1]
        );

        $maksPendapatan = max($maksPendapatan, 1);

        $grafikPendapatan = $grafikPendapatan->map(function ($item) use ($maksPendapatan) {
            return [
                'bulan' => $item['bulan'],
                'total' => $item['total'],
                'label' => $item['total'] >= 1000000
                    ? number_format($item['total'] / 1000000, 1, ',', '.').'jt'
                    : ($item['total'] >= 1000
                        ? number_format($item['total'] / 1000, 0, ',', '.').'rb'
                        : number_format($item['total'], 0, ',', '.')),
                'tinggi' => $item['total'] > 0
                    ? max(5, round(($item['total'] / $maksPendapatan) * 100))
                    : 0,
            ];
        });

        $produkTerlaris = detail_pesanan::query()->selectRaw('produk_id, SUM(quantity) as total_terjual')->whereIn('pesanan_toko_id', (clone $pesananToko)->select('id'))
            ->whereHas('pesananToko', function ($query) use ($statusPenjualan) {
                $query->whereIn('status', $statusPenjualan);
            })->with('produk')->groupBy('produk_id')->orderByDesc('total_terjual')->take(5)->get();

        $jumlahTerjualMaksimum = max(
            $produkTerlaris->pluck('total_terjual')->all() ?: [1]
        );

        foreach ($produkTerlaris as $produk) {

            $produk->persentase = round(
                ($produk->total_terjual / $jumlahTerjualMaksimum) * 100
            );

        }

        $pesananTerbaru = (clone $pesananToko)
            ->with(['pesanan.user'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('seller.laporan-seller', compact(
            'toko',
            'pendapatanBulanIni',
            'totalPesanan',
            'pertumbuhan',
            'totalPelanggan',
            'grafikPendapatan',
            'produkTerlaris',
            'pesananTerbaru'
        ));
    }
}
