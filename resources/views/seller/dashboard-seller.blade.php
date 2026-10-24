@extends('layouts.seller')

@section('title', 'Dashboard Toko - LokaMarket')

@section('content')
@php
    $statistik = [
        [
            'label' => 'Penjualan Bulan Ini',
            'nilai' => 'Rp4.850.000',
            'tren' => '+12,5%',
            'icon' => 'fa-wallet',
            'warna' => 'orange',
            'keterangan' => 'Dari bulan sebelumnya',
        ],
        [
            'label' => 'Total Pesanan',
            'nilai' => '128',
            'tren' => '+8,2%',
            'icon' => 'fa-cart-shopping',
            'warna' => 'blue',
            'keterangan' => 'Pesanan bulan ini',
        ],
        [
            'label' => 'Produk Aktif',
            'nilai' => '24',
            'tren' => '80%',
            'icon' => 'fa-box-open',
            'warna' => 'green',
            'keterangan' => 'Katalog produk',
        ],
        [
            'label' => 'Rating Toko',
            'nilai' => '4,8',
            'tren' => '92 ulasan',
            'icon' => 'fa-star',
            'warna' => 'yellow',
            'keterangan' => 'Kepuasan pelanggan',
        ],
    ];

    $pesanan = [
        [
            'kode' => '#ORD-1024',
            'produk' => 'Ayam Geprek Pedas',
            'pelanggan' => 'Nadia Putri',
            'waktu' => '5 menit lalu',
            'total' => 'Rp25.000',
            'status' => 'Baru',
            'warna' => 'blue',
            'inisial' => 'NP',
        ],
        [
            'kode' => '#ORD-1023',
            'produk' => 'Nasi Goreng Spesial',
            'pelanggan' => 'Rizky Ramadhan',
            'waktu' => '18 menit lalu',
            'total' => 'Rp22.000',
            'status' => 'Diproses',
            'warna' => 'orange',
            'inisial' => 'RR',
        ],
        [
            'kode' => '#ORD-1022',
            'produk' => 'Es Teh Manis',
            'pelanggan' => 'Dewi Anggraini',
            'waktu' => '35 menit lalu',
            'total' => 'Rp8.000',
            'status' => 'Selesai',
            'warna' => 'green',
            'inisial' => 'DA',
        ],
        [
            'kode' => '#ORD-1021',
            'produk' => 'Paket Hemat Geprek',
            'pelanggan' => 'Andi Saputra',
            'waktu' => '1 jam lalu',
            'total' => 'Rp30.000',
            'status' => 'Dikirim',
            'warna' => 'purple',
            'inisial' => 'AS',
        ],
    ];

    $ringkasanPesanan = [
        [
            'label' => 'Pesanan Baru',
            'jumlah' => '24',
            'deskripsi' => 'Menunggu konfirmasi',
            'icon' => 'fa-bell',
            'warna' => 'blue',
        ],
        [
            'label' => 'Sedang Diproses',
            'jumlah' => '18',
            'deskripsi' => 'Sedang disiapkan',
            'icon' => 'fa-clock',
            'warna' => 'orange',
        ],
        [
            'label' => 'Pesanan Selesai',
            'jumlah' => '2.210',
            'deskripsi' => 'Berhasil diselesaikan',
            'icon' => 'fa-circle-check',
            'warna' => 'green',
        ],
    ];

    $hari = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

    $grafik = [
        ['x' => 0,   'y' => 126, 'nilai' => 'Rp420.000'],
        ['x' => 100, 'y' => 98,  'nilai' => 'Rp610.000'],
        ['x' => 200, 'y' => 114, 'nilai' => 'Rp530.000'],
        ['x' => 300, 'y' => 62,  'nilai' => 'Rp780.000'],
        ['x' => 400, 'y' => 86,  'nilai' => 'Rp650.000'],
        ['x' => 500, 'y' => 35,  'nilai' => 'Rp920.000'],
        ['x' => 600, 'y' => 53,  'nilai' => 'Rp840.000'],
    ];
@endphp

<main class="min-h-screen bg-[#FFF9F4] px-4 py-6 text-[#3B2115] sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl space-y-7">

        {{-- HEADER --}}
        <section class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="mb-2 flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#A17A61]">
                        Seller Center
                    </p>
                </div>

                <h1 class="text-2xl font-black tracking-tight sm:text-3xl">
                    Dashboard Toko
                </h1>

                <p class="mt-1 text-sm text-[#927B6D]">
                    Pantau performa dan aktivitas tokomu hari ini.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden items-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-4 py-3 text-xs font-semibold text-[#806B5D] sm:flex">
                    <i class="fa-regular fa-calendar text-[#E85D04]"></i>
                    {{ now()->translatedFormat('d F Y') }}
                </div>
            </div>
        </section>

        {{-- HERO TOKO --}}
        <section class="relative overflow-hidden rounded-[28px] bg-gradient-to-br from-[#FFEDD9] via-[#FFDAB3] to-[#FFAD62] p-5 shadow-sm sm:p-8">
            <div class="pointer-events-none absolute -right-12 -top-20 h-64 w-64 rounded-full bg-white/40 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 left-1/3 h-52 w-52 rounded-full bg-orange-300/40 blur-3xl"></div>

            <div class="relative flex flex-col justify-between gap-6 lg:flex-row lg:items-center">
                <div class="flex min-w-0 items-start gap-4">
                    <div class="relative flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl border-4 border-white bg-white text-2xl text-[#E85D04] shadow-lg sm:h-20 sm:w-20">
                        @if (!empty($toko->foto_profil))
                            <img src="{{ asset('storage/' . $toko->foto_profil) }}"
                                alt="{{ $toko->nama_toko }}"
                                class="absolute h-full w-full object-cover"
                                onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden')">
                            <i class="fa-solid fa-store hidden"></i>
                        @else
                            <i class="fa-solid fa-store"></i>
                        @endif
                    </div>

                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="text-sm font-semibold text-[#8C5A38]">
                                Selamat datang kembali,
                            </p>
                            <span class="inline-flex items-center gap-1 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">
                                <i class="fa-solid fa-circle-check"></i>
                                Toko Aktif
                            </span>
                        </div>

                        <h2 class="mt-1 break-words text-2xl font-black tracking-tight text-[#3B2115] sm:text-3xl">
                            {{ $toko->nama_toko ?? 'Toko Saya' }}
                        </h2>

                        <p class="mt-2 max-w-xl text-sm leading-6 text-[#795548]">
                            Kelola pesanan, pantau penjualan, dan kembangkan bisnismu bersama LokaMarket.
                        </p>

                        <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs font-semibold text-[#795548]">
                            <span class="inline-flex items-center gap-1.5">
                                <i class="fa-solid fa-location-dot text-[#E85D04]"></i>
                                {{ Str::title($toko->kecamatan->nama ?? '-') }},
                                {{ Str::title($toko->kota->nama ?? '-') }}
                            </span>

                            <span class="inline-flex items-center gap-1.5">
                                <i class="fa-solid fa-box text-[#E85D04]"></i>
                                {{ $totalProduk ?? 0 }} produk
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex shrink-0 flex-wrap gap-3">
                    <a href="{{ route('seller.produk') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/80 bg-white/80 px-4 py-3 text-sm font-bold text-[#6D4935] shadow-sm transition hover:bg-white">
                        <i class="fa-solid fa-store"></i>
                        Lihat katalog
                    </a>
                    <a href="{{ route('seller.formEditToko') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#E85D04] px-4 py-3 text-sm font-bold text-white shadow-md shadow-orange-700/20 transition hover:-translate-y-0.5 hover:bg-[#D94F00]">
                        <i class="fa-solid fa-gear"></i>
                        Kelola Toko
                    </a>
                </div>
            </div>

            {{-- MINI SUMMARY --}}
            <div class="relative mt-7 grid grid-cols-2 gap-3 border-t border-orange-200/80 pt-5 sm:grid-cols-4">
                @foreach ($statistik as $item)
                    <div class="rounded-2xl border border-white/60 bg-white/55 p-4 backdrop-blur-sm transition hover:bg-white/80">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[11px] font-semibold text-[#806B5D] sm:text-xs">
                                {{ $item['label'] }}
                            </span>

                            <i class="fa-solid {{ $item['icon'] }} text-sm text-[#E85D04]"></i>
                        </div>

                        <p class="mt-2 truncate text-xl font-black tracking-tight text-[#3B2115] sm:text-2xl">
                            {{ $item['nilai'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- SECTION TITLE --}}
        <section class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
            <div>
                <h2 class="text-xl font-black tracking-tight sm:text-2xl">
                    Ringkasan Performa
                </h2>
                <p class="mt-1 text-sm text-[#927B6D]">
                    Gambaran aktivitas dan perkembangan toko.
                </p>
            </div>

            <span class="inline-flex w-fit items-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-3.5 py-2.5 text-xs font-semibold text-[#806B5D] shadow-sm">
                <i class="fa-regular fa-calendar text-[#E85D04]"></i>
                Periode bulan ini
            </span>
        </section>

        {{-- KPI CARDS --}}
        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($statistik as $item)
                <div class="group rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-[0_4px_24px_rgba(111,67,34,0.04)] transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl
                            @if ($item['warna'] === 'orange') bg-orange-50 text-orange-600
                            @elseif ($item['warna'] === 'blue') bg-blue-50 text-blue-600
                            @elseif ($item['warna'] === 'green') bg-emerald-50 text-emerald-600
                            @else bg-amber-50 text-amber-600 @endif">
                            <i class="fa-solid {{ $item['icon'] }} text-lg"></i>
                        </div>

                        <span class="rounded-full px-2.5 py-1 text-[10px] font-bold
                            @if ($item['warna'] === 'orange') bg-emerald-50 text-emerald-700
                            @elseif ($item['warna'] === 'blue') bg-blue-50 text-blue-700
                            @elseif ($item['warna'] === 'green') bg-emerald-50 text-emerald-700
                            @else bg-amber-50 text-amber-700 @endif">
                            {{ $item['tren'] }}
                        </span>
                    </div>

                    <p class="mt-5 text-sm font-medium text-[#927B6D]">
                        {{ $item['label'] }}
                    </p>

                    <p class="mt-1 text-2xl font-black tracking-tight text-[#3B2115]">
                        {{ $item['nilai'] }}
                    </p>

                    <p class="mt-2 text-xs text-[#A18B7D]">
                        {{ $item['keterangan'] }}
                    </p>
                </div>
            @endforeach
        </section>

        {{-- CHART + RECENT ORDERS --}}
        <section class="grid grid-cols-1 gap-5 xl:grid-cols-5">

            {{-- SALES CHART --}}
            <div class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6 xl:col-span-3">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                    <div>
                        <div class="flex items-center gap-2">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#E85D04]">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold sm:text-lg">Grafik Penjualan</h3>
                                <p class="mt-0.5 text-xs text-[#A18B7D]">Performa penjualan tokomu</p>
                            </div>
                        </div>
                    </div>

                    <select id="periodeGrafik"
                        class="rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] px-3 py-2.5 text-xs font-semibold text-[#72594B] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                        <option value="7">7 hari terakhir</option>
                        <option value="30">30 hari terakhir</option>
                        <option value="90">3 bulan terakhir</option>
                    </select>
                </div>

                <div class="mt-6 rounded-2xl bg-[#FFFCF9] p-3 sm:p-4">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                        <div>
                            <p class="text-xs font-medium text-[#A18B7D]">Total penjualan</p>
                            <p class="mt-1 text-2xl font-black tracking-tight text-[#3B2115]">
                                Rp4.850.000
                            </p>
                        </div>

                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1.5 text-[10px] font-bold text-emerald-700">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                            12,5% dari periode sebelumnya
                        </span>
                    </div>

                    <div class="relative h-52 sm:h-60">
                        <div class="absolute inset-0 flex flex-col justify-between">
                            @foreach (['Rp1 jt', 'Rp750 rb', 'Rp500 rb', 'Rp250 rb', 'Rp0'] as $label)
                                <div class="flex h-0 items-center">
                                    <span class="w-12 shrink-0 text-[9px] text-[#A18B7D]">
                                        {{ $label }}
                                    </span>
                                    <div class="flex-1 border-t border-dashed border-[#F0E3D8]"></div>
                                </div>
                            @endforeach
                        </div>

                        <div class="absolute inset-y-0 left-12 right-1">
                            <svg viewBox="0 0 600 200"
                                class="h-full w-full overflow-visible"
                                preserveAspectRatio="none"
                                role="img"
                                aria-label="Grafik penjualan dummy selama tujuh hari">

                                <defs>
                                    <linearGradient id="salesFill" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#F97316" stop-opacity="0.24"/>
                                        <stop offset="100%" stop-color="#F97316" stop-opacity="0.01"/>
                                    </linearGradient>
                                </defs>

                                <path d="M0 126 L100 98 L200 114 L300 62 L400 86 L500 35 L600 53 L600 200 L0 200 Z"
                                    fill="url(#salesFill)"/>

                                <path d="M0 126 L100 98 L200 114 L300 62 L400 86 L500 35 L600 53"
                                    fill="none"
                                    stroke="#F97316"
                                    stroke-width="4"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    vector-effect="non-scaling-stroke"/>

                                @foreach ($grafik as $point)
                                    <circle
                                        cx="{{ $point['x'] }}"
                                        cy="{{ $point['y'] }}"
                                        r="5"
                                        fill="#FFFFFF"
                                        stroke="#F97316"
                                        stroke-width="3"
                                        vector-effect="non-scaling-stroke">
                                        <title>{{ $point['nilai'] }}</title>
                                    </circle>
                                @endforeach
                            </svg>
                        </div>
                    </div>

                    <div class="ml-12 mt-3 flex justify-between text-[10px] font-semibold text-[#A18B7D]">
                        @foreach ($hari as $namaHari)
                            <span>{{ $namaHari }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-2 text-xs text-[#927B6D]">
                        <span class="h-2.5 w-2.5 rounded-full bg-orange-500"></span>
                        Nilai penjualan
                    </div>

                    <a href="#"
                        class="text-xs font-bold text-[#E85D04] transition hover:text-[#B94300]">
                        Lihat laporan lengkap
                        <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            {{-- RECENT ORDERS --}}
            <div class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6 xl:col-span-2">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#E85D04]">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold sm:text-lg">Pesanan Terbaru</h3>
                                <p class="mt-0.5 text-xs text-[#A18B7D]">Aktivitas transaksi terbaru</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="shrink-0 text-xs font-bold text-[#E85D04] hover:underline">
                        Lihat semua
                    </a>
                </div>

                <div class="mt-5 divide-y divide-[#F5EAE1]">
                    @forelse ($pesanan as $item)
                        <div class="flex items-center gap-3 py-4 first:pt-0 last:pb-0">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl text-xs font-extrabold
                                @if ($item['warna'] === 'orange') bg-orange-50 text-orange-600
                                @elseif ($item['warna'] === 'blue') bg-blue-50 text-blue-600
                                @elseif ($item['warna'] === 'green') bg-emerald-50 text-emerald-600
                                @else bg-purple-50 text-purple-600 @endif">
                                {{ $item['inisial'] }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <p class="text-xs font-extrabold text-[#3B2115]">
                                        {{ $item['kode'] }}
                                    </p>

                                    <span class="rounded-full px-2 py-0.5 text-[9px] font-bold
                                        @if ($item['warna'] === 'orange') bg-orange-50 text-orange-700
                                        @elseif ($item['warna'] === 'blue') bg-blue-50 text-blue-700
                                        @elseif ($item['warna'] === 'green') bg-emerald-50 text-emerald-700
                                        @else bg-purple-50 text-purple-700 @endif">
                                        {{ $item['status'] }}
                                    </span>
                                </div>

                                <p class="mt-1 truncate text-xs font-semibold text-[#72594B]">
                                    {{ $item['produk'] }}
                                </p>

                                <p class="mt-1 truncate text-[10px] text-[#A18B7D]">
                                    {{ $item['pelanggan'] }} · {{ $item['waktu'] }}
                                </p>
                            </div>

                            <p class="shrink-0 text-xs font-extrabold text-[#3B2115]">
                                {{ $item['total'] }}
                            </p>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <i class="fa-solid fa-receipt text-3xl text-[#E7D4C5]"></i>
                            <p class="mt-3 text-sm font-bold text-[#72594B]">Belum ada pesanan</p>
                            <p class="mt-1 text-xs text-[#A18B7D]">Pesanan terbaru akan muncul di sini.</p>
                        </div>
                    @endforelse
                </div>

                <a href="#"
                    class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl border border-[#F1DCC8] bg-[#FFFCF9] px-4 py-3 text-xs font-bold text-[#B9571D] transition hover:border-orange-300 hover:bg-orange-50">
                    Kelola Pesanan
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </section>

        {{-- ORDER STATUS --}}
        <section>
            <div class="mb-4">
                <h3 class="text-lg font-extrabold sm:text-xl">Status Pesanan</h3>
                <p class="mt-1 text-xs text-[#A18B7D]">
                    Ringkasan pesanan berdasarkan status.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ($ringkasanPesanan as $item)
                    <div class="group rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl
                                @if ($item['warna'] === 'blue') bg-blue-50 text-blue-600
                                @elseif ($item['warna'] === 'orange') bg-orange-50 text-orange-600
                                @else bg-emerald-50 text-emerald-600 @endif">
                                <i class="fa-solid {{ $item['icon'] }} text-lg"></i>
                            </div>

                            <span class="rounded-full bg-[#FFFCF9] px-3 py-1 text-[10px] font-bold text-[#A18B7D]">
                                Ringkasan
                            </span>
                        </div>

                        <p class="mt-5 text-sm font-bold text-[#72594B]">
                            {{ $item['label'] }}
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-[#3B2115]">
                            {{ $item['jumlah'] }}
                        </p>

                        <p class="mt-2 text-xs text-[#A18B7D]">
                            {{ $item['deskripsi'] }}
                        </p>

                        <a href="#"
                            class="mt-5 inline-flex items-center gap-2 text-xs font-bold text-[#E85D04] transition group-hover:gap-3">
                            Lihat pesanan
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- QUICK ACTIONS --}}
        <section class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">
            <div>
                <h3 class="text-lg font-extrabold">Akses Cepat</h3>
                <p class="mt-1 text-xs text-[#A18B7D]">
                    Pintasan untuk aktivitas toko sehari-hari.
                </p>
            </div>

            <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
                <a href="#"
                    class="group rounded-2xl border border-[#F1DCC8] bg-[#FFFCF9] p-4 transition hover:border-orange-300 hover:bg-orange-50">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-100 text-[#E85D04] transition group-hover:bg-orange-500 group-hover:text-white">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <p class="mt-3 text-sm font-bold">Tambah Produk</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Masukkan produk baru</p>
                </a>

                <a href="#"
                    class="group rounded-2xl border border-[#F1DCC8] bg-[#FFFCF9] p-4 transition hover:border-blue-300 hover:bg-blue-50">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600 transition group-hover:bg-blue-500 group-hover:text-white">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <p class="mt-3 text-sm font-bold">Kelola Produk</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Atur katalog dan stok</p>
                </a>

                <a href="#"
                    class="group rounded-2xl border border-[#F1DCC8] bg-[#FFFCF9] p-4 transition hover:border-emerald-300 hover:bg-emerald-50">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 transition group-hover:bg-emerald-500 group-hover:text-white">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <p class="mt-3 text-sm font-bold">Kelola Pesanan</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Periksa transaksi masuk</p>
                </a>

                <a href="#"
                    class="group rounded-2xl border border-[#F1DCC8] bg-[#FFFCF9] p-4 transition hover:border-purple-300 hover:bg-purple-50">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-600 transition group-hover:bg-purple-500 group-hover:text-white">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <p class="mt-3 text-sm font-bold">Laporan Penjualan</p>
                    <p class="mt-1 text-[11px] text-[#A18B7D]">Tinjau performa toko</p>
                </a>
            </div>
        </section>

        {{-- DEMO NOTICE --}}
        <div class="flex items-start gap-3 rounded-2xl border border-orange-200 bg-[#FFF3E8] p-4">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-orange-600">
                <i class="fa-solid fa-circle-info"></i>
            </div>

            <div>
                <p class="text-sm font-bold text-[#7B3515]">Mode pratinjau</p>
                <p class="mt-1 text-xs leading-5 text-[#8A5A40]">
                    Statistik, grafik, dan daftar pesanan pada halaman ini menggunakan data dummy untuk pratinjau antarmuka. Tautan navigasi masih berupa placeholder dan dapat disesuaikan dengan route aplikasi.
                </p>
            </div>
        </div>

    </div>
</main>
@endsection