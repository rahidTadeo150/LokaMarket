@extends('layouts.seller')

@section('title', 'Pesanan Masuk - LokaMarket')

@section('content')

    @php
        $jumlahPesanan = $pesanan->total();
        $jumlahDiHalaman = $pesanan->count();
    @endphp

    <main class="min-h-screen bg-[#FFF9F4] px-4 py-6 text-[#3B2115] sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl space-y-7">

            <section
                class="relative overflow-hidden rounded-3xl bg-linear-to-r from-[#FFF0DF] via-[#FFE0BD] to-[#FFB56B] p-6 sm:p-8">

                <div class="pointer-events-none absolute -right-12 -top-16 h-56 w-56 rounded-full bg-white/30 blur-3xl">
                </div>
                <div
                    class="pointer-events-none absolute -bottom-20 right-1/3 h-48 w-48 rounded-full bg-orange-300/30 blur-3xl">
                </div>

                <div class="relative flex flex-col justify-between gap-6 sm:flex-row sm:items-center">

                    <div>

                        <div
                            class="mb-3 inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/70 px-3 py-1.5 text-xs font-semibold text-[#C1440E]">
                            <i class="fa-solid fa-store"></i>
                            Seller Center
                        </div>

                        <p class="text-2xl font-extrabold tracking-tight text-[#3B2115] sm:text-3xl">
                            Daftar Pesanan Masuk
                        </p>

                        <p class="mt-2 max-w-xl text-sm leading-6 text-[#72594B] sm:text-base">
                            Halo, {{ $toko->nama_toko }}. Kelola pesanan yang telah dibayar dan berisi produk dari tokomu.
                        </p>

                    </div>

                    <div class="flex shrink-0 flex-wrap items-center gap-3">

                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/70 bg-white/70 px-4 py-3 shadow-sm backdrop-blur-sm">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-[#E85D04]">
                                <i class="fa-regular fa-calendar text-lg"></i>
                            </div>

                            <div>
                                <p class="text-xs text-[#927B6D]">Tanggal hari ini</p>
                                <p class="mt-1 text-sm font-bold text-[#3B2115]">
                                    {{ now()->locale('id')->translatedFormat('d M Y') }}
                                </p>
                            </div>

                        </div>

                        <a href="{{ route('seller.pesanan', request()->query()) }}" aria-label="Muat ulang pesanan"
                            class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-white/70 bg-white/70 text-[#B9571D] shadow-sm transition hover:-translate-y-0.5 hover:bg-white">
                            <i class="fa-solid fa-rotate-right text-lg"></i>
                        </a>

                    </div>

                </div>

            </section>

            <div class="flex gap-2 overflow-x-auto rounded-2xl border border-[#F1DCC8] bg-white p-2">
                
                <a href="{{ route('seller.pesanan', ['status' => 'dibayar']) }}"
                class="shrink-0 rounded-xl px-4 py-3 text-sm font-bold transition {{ $status === 'dibayar' ? 'bg-orange-500 text-white' : 'text-[#72594B] hover:bg-orange-50' }}">
                    <i class="fa-solid fa-bell mr-1"></i>
                    Pesanan Baru
                    <span class="ml-1">{{ $jumlahDibayar }}</span>
                </a>

                <a href="{{ route('seller.pesanan', ['status' => 'diproses']) }}"
                class="shrink-0 rounded-xl px-4 py-3 text-sm font-bold transition {{ $status === 'diproses' ? 'bg-orange-500 text-white' : 'text-[#72594B] hover:bg-orange-50' }}">
                    <i class="fa-solid fa-box mr-1"></i>
                    Belum Dikirim
                    <span class="ml-1">{{ $jumlahDiproses }}</span>
                </a>

                <a href="{{ route('seller.pesanan', ['status' => 'dikirim']) }}"
                class="shrink-0 rounded-xl px-4 py-3 text-sm font-bold transition {{ $status === 'dikirim' ? 'bg-orange-500 text-white' : 'text-[#72594B] hover:bg-orange-50' }}">
                    <i class="fa-solid fa-truck-fast mr-1"></i>
                    Dalam Pengiriman
                    <span class="ml-1">{{ $jumlahDikirim }}</span>
                </a>

            </div>

            <x-alert-session />

            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">

                <div class="rounded-2xl border border-blue-100 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <p class="mt-4 text-xs font-medium text-[#927B6D]">Pesanan Menunggu Diproses</p>
                    <p class="mt-1 text-2xl font-black">{{ $jumlahPesanan }}</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Pesanan berstatus sudah dibayar</p>
                </div>

                <div class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <p class="mt-4 text-xs font-medium text-[#927B6D]">Toko</p>
                    <p class="mt-1 truncate text-lg font-black">{{ $toko->nama_toko }}</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Pesanan untuk tokomu</p>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <p class="mt-4 text-xs font-medium text-[#927B6D]">Ditampilkan</p>
                    <p class="mt-1 text-2xl font-black">{{ $jumlahDiHalaman }}</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Pesanan pada halaman ini</p>
                </div>

            </section>

            <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                <div class="border-b border-[#F5EAE1] p-4 sm:p-6">

                    <div class="flex flex-col justify-between gap-2 lg:flex-row lg:items-center">

                        <div>
                            <p class="text-lg font-extrabold">Daftar Transaksi</p>
                            <p class="mt-1 text-xs text-[#A18B7D]">
                                Ditemukan {{ $jumlahPesanan }} pesanan yang sudah dibayar.
                            </p>
                        </div>

                        <form action="{{ route('seller.pesanan') }}" method="GET"
                            class="flex flex-col gap-3 sm:flex-row">

                            <div class="relative">
                                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-sm text-[#B69A87]"></i>
                                <input name="search" type="search" value="{{ request('search') }}"
                                    placeholder="Cari nomor atau pelanggan..."
                                    class="w-full rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] py-3 pl-10 pr-4 text-sm outline-none transition placeholder:text-[#B69A87] focus:border-orange-400 focus:ring-4 focus:ring-orange-100 sm:w-72">
                            </div>

                            <button type="submit"
                                class="rounded-xl bg-[#E85D04] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#D94F00]">
                                Cari Pesanan
                            </button>

                            @if (request()->filled('search'))
                                <a href="{{ route('seller.pesanan') }}"
                                    class="rounded-xl border border-[#F1DCC8] px-5 py-3 text-center text-sm font-bold text-[#72594B] transition hover:bg-orange-50">
                                    Reset
                                </a>
                            @endif

                        </form>

                    </div>

                </div>

                <div id="daftarPesanan" class="divide-y divide-[#F5EAE1]">

                    @forelse ($pesanan as $item)
                        <article class="p-4 transition hover:bg-[#FFFCF9] sm:p-6">

                            <div class="flex flex-col gap-5 lg:flex-row lg:items-start">

                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-wrap items-center gap-4">

                                        <span class="text-sm font-black text-[#3B2115]">
                                            #{{ $item->nomor_pesanan ?? $item->id }}
                                        </span>

                                        @php
                                            $konfigurasiStatus = [
                                                'dibayar' => [
                                                    'label' => 'Belum Diproses',
                                                    'class' => 'bg-red-50 text-red-700 ring-red-200',
                                                    'icon' => 'fa-solid fa-clock',
                                                ],
                                                'diproses' => [
                                                    'label' => 'Sedang Diproses',
                                                    'class' => 'bg-yellow-50 text-yellow-700 ring-yellow-200',
                                                    'icon' => 'fa-solid fa-box',
                                                ],
                                                'dikirim' => [
                                                    'label' => 'Dalam Pengiriman',
                                                    'class' => 'bg-green-50 text-green-700 ring-green-200',
                                                    'icon' => 'fa-solid fa-truck-fast',
                                                ],
                                            ];

                                            $statusPesanan = $konfigurasiStatus[$item->status] ?? [
                                                'label' => ucfirst(str_replace('_', ' ', $item->status ?? 'Tidak diketahui')),
                                                'class' => 'bg-gray-50 text-gray-600 ring-gray-200',
                                                'icon' => 'fa-solid fa-circle-info',
                                            ];
                                        @endphp

                                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold ring-1 {{ $statusPesanan['class'] }}">
                                            <i class="{{ $statusPesanan['icon'] }}"></i>
                                            {{ $statusPesanan['label'] }}
                                        </span>

                                    </div>

                                    <div class="mt-3 flex items-center gap-3">

                                        @if ($item->user && $item->user->foto_profil)
                                            <img src="{{ asset('storage/' . $item->user->foto_profil) }}"
                                                alt="Foto {{ $item->nama_penerima }}"
                                                class="h-10 w-10 rounded-full border border-orange-100 object-cover">
                                        @else
                                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 text-sm font-bold text-orange-600">
                                                {{ mb_substr($item->nama_penerima ?? 'P', 0, 1) }}
                                            </div>
                                        @endif

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-bold">
                                                {{ $item->nama_penerima ?? 'Pelanggan' }}
                                            </p>
                                            <p class="mt-1 text-xs text-[#A18B7D]">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                {{ $item->created_at?->locale('id')->translatedFormat('d M Y, H:i') ?? '-' }}
                                            </p>
                                        </div>

                                    </div>

                                    <div class="mt-4 space-y-3">

                                        @forelse ($item->detail as $detail)
                                            <div
                                                class="flex flex-wrap items-center justify-between gap-3 rounded-xl bg-[#FFFAF6] p-3">

                                                <div class="flex min-w-0 items-center gap-3">

                                                    @if ($detail->produk->thumbnail->foto)
                                                        <img src="{{ asset('storage/' . $detail->produk->thumbnail->foto) }}"
                                                            class="h-14 w-14 shrink-0 rounded-xl border border-orange-100 object-cover">
                                                    @else
                                                        <div
                                                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-400">
                                                            <i class="fa-solid fa-box-open text-xl"></i>
                                                        </div>
                                                    @endif

                                                    <div class="min-w-0">
                                                        <p class="text-sm font-semibold text-[#3B2115]">
                                                            {{ $detail->nama_produk ?? ($detail->produk?->nama ?? 'Produk') }}
                                                        </p>
                                                        <p class="mt-1 text-xs text-[#A18B7D]">
                                                            {{ $detail->quantity }} ×
                                                            Rp{{ number_format((float) $detail->harga, 0, ',', '.') }}
                                                        </p>
                                                    </div>

                                                </div>

                                                <p class="shrink-0 text-sm font-bold text-[#72594B]">
                                                    Rp{{ number_format((float) $detail->subtotal, 0, ',', '.') }}
                                                </p>

                                            </div>
                                        @empty
                                            <p class="rounded-xl bg-orange-50 p-3 text-sm text-[#72594B]">
                                                Tidak ada detail produk untuk toko ini.
                                            </p>
                                        @endforelse

                                    </div>

                                </div>

                                <aside class="flex w-full flex-col gap-4 border-t border-[#F5EAE1] pt-4 lg:w-[30%] lg:shrink-0 lg:border-l lg:border-t-0 lg:pl-6 lg:pt-0">

                                    <div>

                                        <p class="text-[11px] text-[#A18B7D]">Nomor telepon</p>

                                        <p class="mt-1 text-sm font-bold text-[#72594B]">
                                            {{ $item->no_telepon ?? '-' }}
                                        </p>

                                        <p class="mt-4 text-[11px] text-[#A18B7D]">Alamat pengiriman</p>

                                        <p class="mt-1 text-xs leading-5 text-[#72594B]">
                                            {{ $item->alamat_lengkap ?? '-' }}
                                            @if ($item->kecamatan)
                                                , {{ $item->kecamatan->nama }}
                                            @endif
                                            @if ($item->kota)
                                                , {{ $item->kota->nama }}
                                            @endif
                                            @if ($item->provinsi)
                                                , {{ $item->provinsi->nama }}
                                            @endif
                                            @if ($item->kode_pos)
                                                {{ $item->kode_pos }}
                                            @endif
                                        </p>

                                        @if ($item->catatan)
                                            <p class="mt-3 text-[11px] text-[#A18B7D]">Catatan pelanggan</p>
                                            <p class="mt-1 text-xs leading-5 text-[#72594B]">{{ $item->catatan }}</p>
                                        @endif

                                        <p class="mt-4 text-[11px] text-[#A18B7D]">Subtotal produk toko</p>

                                        <p class="mt-1 text-xl font-black text-[#3B2115]">
                                            Rp{{ number_format((float) $item->detail->sum('subtotal'), 0, ',', '.') }}
                                        </p>

                                    </div>

                                    <div class="flex flex-wrap gap-2">

                                        <button type="button"
                                                class="btn-detail inline-flex flex-1 items-center justify-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-3 py-2.5 text-xs font-bold text-[#72594B] transition hover:bg-orange-50"
                                                data-detail="{{ $item->id }}">
                                            <i class="fa-regular fa-eye"></i>
                                            Detail
                                        </button>

                                        @if ($item->status === 'dibayar')

                                            <form action="{{ route('seller.pesanan.proses', ['nomor_pesanan' => $item->nomor_pesanan]) }}"
                                                method="POST"
                                                class="flex-1">

                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-3 py-2.5 text-xs font-bold text-white transition hover:bg-orange-600">

                                                    <i class="fa-solid fa-box"></i>
                                                    Proses
                                                </button>

                                            </form>

                                        @elseif ($item->status === 'diproses')

                                            <form action="{{ route('seller.pesanan.kirim', ['nomor_pesanan' => $item->nomor_pesanan]) }}"
                                                method="POST"
                                                class="flex-1"dd>
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-3 py-2.5 text-xs font-bold text-white transition hover:bg-green-700">
                                                    <i class="fa-solid fa-truck-fast"></i>
                                                    Kirim Pesanan
                                                </button>

                                            </form>

                                        @elseif ($item->status === 'dikirim')

                                            <span class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-green-50 px-3 py-2.5 text-xs font-bold text-green-700">
                                                <i class="fa-solid fa-check-circle"></i>
                                                Sudah Dikirim
                                            </span>

                                        @endif

                                    </div>

                                </aside>

                            </div>

                        </article>
                    @empty
                        <div class="px-5 py-16 text-center">
                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-2xl text-orange-400">
                                <i class="fa-solid fa-box-open"></i>
                            </div>
                            <p class="mt-4 text-base font-extrabold">Belum Ada Data Pesanan</p>
                            <p class="mx-auto mt-2 max-w-md text-sm text-[#927B6D]">
                                Pesanan yang sudah dibayar dan berisi produk dari tokomu akan tampil di sini.
                            </p>
                        </div>
                    @endforelse

                </div>

                @if ($pesanan->hasPages())
                    <div class="border-t border-[#F5EAE1] p-4 sm:p-6">
                        {{ $pesanan->links() }}
                    </div>
                @endif

            </section>

            <div class="flex items-start gap-3 rounded-2xl border border-orange-200 bg-[#FFF3E8] p-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-orange-600">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-[#7B3515]">Informasi pesanan</p>
                    <p class="mt-1 text-xs leading-5 text-[#8A5A40]">
                        Halaman ini menampilkan pesanan berstatus <strong>dibayar</strong> sesuai query controller.
                        Setelah tombol Proses digunakan, status pesanan akan berubah menjadi <strong>diproses</strong>
                        dan pesanan tersebut tidak lagi muncul di daftar ini.
                    </p>
                </div>
            </div>

        </div>

    </main>

    <div id="modalDetail"
        class="fixed inset-0 z-100 hidden items-center justify-center bg-[#2D1A10]/50 p-4 backdrop-blur-sm">

        <div class="w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl">

            <div class="flex items-center justify-between border-b border-[#F5EAE1] px-5 py-4">

                <div>
                    <p class="text-xs font-semibold text-[#A18B7D]">Informasi transaksi</p>
                    <p id="detailJudul" class="mt-1 text-lg font-black">Detail Pesanan</p>
                </div>

                <button id="tutupDetail" type="button"
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#FFF4EA] text-[#8A5A40] hover:bg-orange-100">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

            <div id="detailIsi" class="max-h-[65vh] space-y-4 overflow-y-auto p-5"></div>

            <div class="border-t border-[#F5EAE1] p-5">
                <button id="tutupDetailBawah" type="button"
                    class="w-full rounded-xl bg-[#E85D04] px-4 py-3 text-sm font-bold text-white hover:bg-[#D94F00]">
                    Tutup
                </button>
            </div>

        </div>

    </div>

    @php
        $dataPesananJson = $pesanan->getCollection()
            ->map(function ($order) {

                return [
                    'id' => $order->id,
                    'nomor' => $order->nomor_pesanan ?? $order->id,
                    'pelanggan' => $order->nama_penerima ?? 'Pelanggan',

                    'tanggal' => $order->created_at
                        ? $order->created_at->locale('id')->translatedFormat('d M Y, H:i')
                        : '-',

                    'telepon' => $order->no_telepon ?? '-',

                    'alamat' => trim(
                        ($order->alamat_lengkap ?? '') .
                            ($order->kecamatan ? ', ' . $order->kecamatan->nama : '') .
                            ($order->kota ? ', ' . $order->kota->nama : '') .
                            ($order->provinsi ? ', ' . $order->provinsi->nama : '') .
                            ($order->kode_pos ? ' ' . $order->kode_pos : ''),
                    ),

                    'catatan' => $order->catatan ?? '',
                    'status' => $order->status,

                    'subtotal' => (float) $order->detail->sum('subtotal'),

                    'produk' => $order->detail->map(function ($detail) {
                            return [
                                'nama' => $detail->nama_produk ?? ($detail->produk?->nama ?? 'Produk'),

                                'jumlah' => (int) $detail->quantity,
                                'harga' => (float) $detail->harga,
                                'subtotal' => (float) $detail->subtotal,
                            ];
                        })->values(),
                ];

            })->values();
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            'use strict';

            const modal = document.getElementById('modalDetail');
            const detailJudul = document.getElementById('detailJudul');
            const detailIsi = document.getElementById('detailIsi');
            const tombolTutup = document.getElementById('tutupDetail');
            const tombolTutupBawah = document.getElementById('tutupDetailBawah');

            const dataPesanan = {{ Illuminate\Support\Js::from($dataPesananJson) }};

            if (!modal || !detailJudul || !detailIsi) {
                console.error('Elemen modal detail pesanan tidak ditemukan.');
                return;
            }

            function escapeHtml(value) 
            {

                return String(value ?? '').replace(/[&<>"']/g, function(character) {
                    const entities = {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    };

                    return entities[character];
                });

            }

            function formatRupiah(value) 
            {

                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(Number(value) || 0);

            }

            function formatStatus(status) {

                const daftarStatus = {
                    menunggu_pembayaran: 'Menunggu Pembayaran',
                    dibayar: 'Sudah Dibayar',
                    diproses: 'Sedang Diproses',
                    dikirim: 'Sedang Dikirim',
                    selesai: 'Selesai',
                    dibatalkan: 'Dibatalkan',
                    gagal: 'Gagal'
                };

                return daftarStatus[status] || String(status || '-').replaceAll('_', ' ')
                    .replace(/\b\w/g, function(huruf) {
                        return huruf.toUpperCase();
                    });

            }

            function bukaDetail(id) 
            {
                
                const item = dataPesanan.find(function(pesanan) {
                    return String(pesanan.id) === String(id);
                });

                if (!item) {
                    console.warn('Data pesanan tidak ditemukan:', id);
                    return;
                }

                detailJudul.textContent = 'Pesanan #' + item.nomor;

                const daftarProduk = (item.produk || []).map(function(produk) {

                    return `
                        <div class="flex items-start justify-between gap-3 border-b border-[#F5EAE1] py-3 last:border-b-0">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-[#3B2115]">
                                    ${escapeHtml(produk.nama)}
                                </p>
                                <p class="mt-1 text-xs text-[#A18B7D]">
                                    ${produk.jumlah} × ${formatRupiah(produk.harga)}
                                </p>
                            </div>

                            <span class="shrink-0 text-sm font-bold text-[#3B2115]">
                                ${formatRupiah(produk.subtotal)}
                            </span>
                        </div>
                    `;

                }).join('');

                detailIsi.innerHTML = `
                    <div class="space-y-4">

                        <div class="rounded-2xl border border-orange-100 bg-[#FFFCF9] p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs text-[#A18B7D]">Pelanggan</p>
                                    <p class="mt-1 font-bold text-[#3B2115]">
                                        ${escapeHtml(item.pelanggan)}
                                    </p>
                                </div>

                                <span class="shrink-0 rounded-full bg-orange-50 px-3 py-1 text-xs font-bold text-orange-700">
                                    ${escapeHtml(formatStatus(item.status))}
                                </span>
                            </div>

                            <div class="mt-4">
                                <p class="text-xs text-[#A18B7D]">Nomor pesanan</p>
                                <p class="mt-1 text-sm font-semibold text-[#3B2115]">
                                    #${escapeHtml(item.nomor)}
                                </p>
                            </div>

                            <div class="mt-4">
                                <p class="text-xs text-[#A18B7D]">Waktu pesanan</p>
                                <p class="mt-1 text-sm font-semibold text-[#3B2115]">
                                    ${escapeHtml(item.tanggal)}
                                </p>
                            </div>

                            <div class="mt-4">
                                <p class="text-xs text-[#A18B7D]">Nomor telepon</p>
                                <p class="mt-1 text-sm font-semibold text-[#3B2115]">
                                    ${escapeHtml(item.telepon)}
                                </p>
                            </div>

                            <div class="mt-4">
                                <p class="text-xs text-[#A18B7D]">Alamat pengiriman</p>
                                <p class="mt-1 text-sm leading-6 text-[#3B2115]">
                                    ${escapeHtml(item.alamat || '-')}
                                </p>
                            </div>

                            ${item.catatan ? `
                                    <div class="mt-4 border-t border-orange-100 pt-3">
                                        <p class="text-xs text-[#A18B7D]">Catatan pelanggan</p>
                                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-[#3B2115]">
                                            ${escapeHtml(item.catatan)}
                                        </p>
                                    </div>
                                ` : ''}
                        </div>

                        <div class="rounded-2xl border border-orange-100 bg-white p-4">
                            <h4 class="mb-2 text-sm font-extrabold text-[#3B2115]">
                                Produk dari tokomu
                            </h4>

                            ${daftarProduk || `
                                    <p class="py-3 text-sm text-[#72594B]">
                                        Tidak ada detail produk untuk toko ini.
                                    </p>
                                `}

                            <div class="mt-3 flex items-center justify-between gap-3 border-t border-[#F5EAE1] pt-4">
                                <span class="text-sm font-bold text-[#3B2115]">
                                    Subtotal produk toko
                                </span>

                                <span class="text-lg font-black text-[#E85D04]">
                                    ${formatRupiah(item.subtotal)}
                                </span>
                            </div>
                        </div>

                    </div>
                `;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

            }

            function tutupModal() 
            {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            document.querySelectorAll('[data-detail]').forEach(function(button) {

                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    bukaDetail(button.dataset.detail);
                });

            });

            if (tombolTutup) {
                tombolTutup.addEventListener('click', tutupModal);
            }

            if (tombolTutupBawah) {
                tombolTutupBawah.addEventListener('click', tutupModal);
            }

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    tutupModal();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    tutupModal();
                }
            });

        });
    </script>
@endsection
