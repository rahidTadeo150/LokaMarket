@extends('layouts.seller')

@section('title', 'Dashboard Toko - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#f8f4ef] text-slate-800">
    {{-- Header Dashboard --}}
    <section>
        <div class="mx-auto max-w-7xl px-5 py-6 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-[#FFF3E2] via-[#FFE7C7] to-[#FFD19A] px-5 py-6 shadow-sm md:px-7 md:py-7">
                {{-- Dekorasi --}}
                <div class="absolute -right-16 -top-20 h-52 w-52 rounded-full bg-white/30"></div>
                <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="relative shrink-0">
                            <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl border-4 border-white bg-white shadow-md md:h-20 md:w-20">
                                <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=200&q=80"
                                    alt="Geprek WW"
                                    class="h-full w-full object-cover">
                            </div>
                        </div>


                        {{-- Informasi --}}
                        <div>
                            <p class="text-xs font-medium text-[#8C5A38] md:text-sm">
                                Welcome Back
                            </p>
                            <div class="mt-0.5 flex flex-wrap items-center gap-2">
                                <h1 class="text-xl font-black tracking-tight text-[#3B2115] md:text-2xl">
                                    Geprek WW
                                </h1>
                            </div>
                            <p class="mt-1 text-[10px] text-[#795548] md:text-xs">
                                Pantau toko, kelola pesanan, dan tingkatkan penjualan Anda.
                            </p>
                            {{-- Info kecil --}}
                            <div class="mt-3 flex flex-wrap items-center gap-3 text-xs font-medium text-[#795548]">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-[#E85D04]"></i>
                                    Banyuwangi
                                </span>
                                <span class="h-1 w-1 rounded-full bg-orange-300"></span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-star text-[#F59E0B]"></i>
                                    4.8 Rating
                                </span>
                                <span class="h-1 w-1 rounded-full bg-orange-300"></span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-box text-[#E85D04]"></i>
                                    24 Produk
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/80 bg-white/80 px-4 py-2.5 text-xs font-bold text-[#6D4935] shadow-sm backdrop-blur transition hover:bg-white hover:text-[#E85D04]">
                            <i class="fa-solid fa-store text-[11px]"></i>
                            Lihat Toko
                        </a>
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-xl bg-[#E85D04] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-[#D94F00] hover:shadow-md">
                            <i class="fa-solid fa-gear text-[11px]"></i>
                            Kelola Toko
                        </a>
                    </div>
                </div>


                {{-- Quick Stats --}}
                <div class="relative mt-6 grid grid-cols-2 gap-2 border-t border-orange-200/60 pt-5 md:grid-cols-4 md:gap-3">
                    <div class="flex items-center gap-2.5 rounded-xl bg-white/60 px-3 py-5 backdrop-blur-sm">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-[#E85D04] shadow-sm">
                            <i class="fa-solid fa-chart-line text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-[#3B2115]">
                                Rp4,85jt
                            </p>

                            <p class="text-[9px] text-[#8C7467]">
                                Penjualan bulan ini
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 rounded-xl bg-white/60 px-3 py-5 backdrop-blur-sm">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-blue-600 shadow-sm">
                            <i class="fa-solid fa-cart-shopping text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-[#3B2115]">
                                128
                            </p>
                            <p class="text-[9px] text-[#8C7467]">
                                Pesanan bulan ini
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 rounded-xl bg-white/60 px-3 py-5 backdrop-blur-sm">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-green-600 shadow-sm">
                            <i class="fa-solid fa-box text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-[#3B2115]">
                                24
                            </p>
                            <p class="text-[9px] text-[#8C7467]">
                                Produk aktif
                            </p>
                        </div>
                    </div>


                    {{-- Rating --}}
                    <div class="flex items-center gap-2.5 rounded-xl bg-white/60 px-3 py-5 backdrop-blur-sm">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-yellow-500 shadow-sm">
                            <i class="fa-solid fa-star text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-[#3B2115]">
                                4.8
                            </p>
                            <p class="text-[9px] text-[#8C7467]">
                                Rating toko
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Isi Dashboard --}}
    <section class="mx-auto max-w-7xl px-5 py-6 lg:px-8">
        {{-- Pesanan Terbaru + Diagram Penjualan --}}
        <div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-2">


            {{-- Pesanan Terbaru --}}
            <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">

                <div class="mb-4 flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-bold text-[#3B2115]">
                            Pesanan Terbaru
                        </h2>

                        <p class="mt-0.5 text-[10px] text-[#A58C7D]">
                            Pesanan yang baru masuk
                        </p>
                    </div>

                    <a
                        href="#"
                        class="text-[10px] font-semibold text-[#E85D04] hover:underline">
                        Lihat Semua
                    </a>

                </div>


                <div class="divide-y divide-orange-50">

                    {{-- Pesanan 1 --}}
                    <div class="flex items-center justify-between gap-3 py-3 first:pt-0">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-[#E85D04]">
                                <i class="fa-solid fa-receipt text-xs"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold text-[#3B2115]">
                                    #ORD-1024
                                </p>

                                <p class="truncate text-[10px] text-[#A58C7D]">
                                    Ayam Geprek Pedas
                                </p>
                            </div>

                        </div>

                        <span class="shrink-0 rounded-full bg-orange-50 px-2 py-1 text-[9px] font-semibold text-[#E85D04]">
                            Diproses
                        </span>

                    </div>


                    {{-- Pesanan 2 --}}
                    <div class="flex items-center justify-between gap-3 py-3">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <i class="fa-solid fa-box text-xs"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold text-[#3B2115]">
                                    #ORD-1023
                                </p>

                                <p class="truncate text-[10px] text-[#A58C7D]">
                                    Nasi Goreng Spesial
                                </p>
                            </div>

                        </div>

                        <span class="shrink-0 rounded-full bg-blue-50 px-2 py-1 text-[9px] font-semibold text-blue-600">
                            Dikirim
                        </span>

                    </div>


                    {{-- Pesanan 3 --}}
                    <div class="flex items-center justify-between gap-3 py-3">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-50 text-green-600">
                                <i class="fa-solid fa-check text-xs"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold text-[#3B2115]">
                                    #ORD-1022
                                </p>

                                <p class="truncate text-[10px] text-[#A58C7D]">
                                    Es Teh Manis
                                </p>
                            </div>

                        </div>

                        <span class="shrink-0 rounded-full bg-green-50 px-2 py-1 text-[9px] font-semibold text-green-600">
                            Selesai
                        </span>

                    </div>


                    {{-- Pesanan 4 --}}
                    <div class="flex items-center justify-between gap-3 py-3 last:pb-0">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                                <i class="fa-solid fa-cart-shopping text-xs"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-bold text-[#3B2115]">
                                    #ORD-1021
                                </p>

                                <p class="truncate text-[10px] text-[#A58C7D]">
                                    Paket Hemat Geprek
                                </p>
                            </div>

                        </div>

                        <span class="shrink-0 rounded-full bg-purple-50 px-2 py-1 text-[9px] font-semibold text-purple-600">
                            Baru
                        </span>

                    </div>

                </div>

            </div>


            {{-- Diagram Penjualan --}}
            <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">

                <div class="mb-4 flex items-center justify-between">

                    <div>
                        <h2 class="text-sm font-bold text-[#3B2115]">
                            Diagram Penjualan
                        </h2>

                        <p class="mt-0.5 text-[10px] text-[#A58C7D]">
                            Performa penjualan 7 hari terakhir
                        </p>
                    </div>

                    <select
                        class="rounded-lg border border-orange-100 bg-[#FFF9F4] px-3 py-1.5 text-[10px] font-semibold text-[#72594B] outline-none focus:border-[#E85D04]">

                        <option>7 Hari</option>
                        <option>30 Hari</option>
                        <option>3 Bulan</option>

                    </select>

                </div>


                {{-- Grafik --}}
                <div class="relative h-48">

                    {{-- Garis Grafik --}}
                    <div class="absolute inset-0 flex flex-col justify-between">

                        <div class="border-t border-dashed border-orange-100"></div>
                        <div class="border-t border-dashed border-orange-100"></div>
                        <div class="border-t border-dashed border-orange-100"></div>
                        <div class="border-t border-dashed border-orange-100"></div>
                        <div class="border-t border-dashed border-orange-100"></div>

                    </div>


                    {{-- Nilai --}}
                    <div class="absolute inset-y-0 left-0 flex flex-col justify-between text-[9px] text-[#A58C7D]">

                        <span>Rp1jt</span>
                        <span>Rp750k</span>
                        <span>Rp500k</span>
                        <span>Rp250k</span>
                        <span>Rp0</span>

                    </div>


                    {{-- SVG Grafik --}}
                    <div class="absolute inset-0 ml-10">

                        <svg
                            viewBox="0 0 600 190"
                            class="h-full w-full overflow-visible"
                            preserveAspectRatio="none">

                            {{-- Area --}}
                            <path
                                d="M0 140
                                   L100 110
                                   L200 125
                                   L300 70
                                   L400 95
                                   L500 45
                                   L600 65
                                   L600 190
                                   L0 190 Z"
                                fill="#FFF3E5">
                            </path>

                            {{-- Garis --}}
                            <path
                                d="M0 140
                                   L100 110
                                   L200 125
                                   L300 70
                                   L400 95
                                   L500 45
                                   L600 65"
                                fill="none"
                                stroke="#E85D04"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>

                            {{-- Titik --}}
                            <circle cx="0" cy="140" r="4" fill="#E85D04"/>
                            <circle cx="100" cy="110" r="4" fill="#E85D04"/>
                            <circle cx="200" cy="125" r="4" fill="#E85D04"/>
                            <circle cx="300" cy="70" r="4" fill="#E85D04"/>
                            <circle cx="400" cy="95" r="4" fill="#E85D04"/>
                            <circle cx="500" cy="45" r="4" fill="#E85D04"/>
                            <circle cx="600" cy="65" r="4" fill="#E85D04"/>

                        </svg>


                        {{-- Hari --}}
                        <div class="absolute -bottom-5 left-0 right-0 flex justify-between text-[9px] text-[#A58C7D]">

                            <span>Sen</span>
                            <span>Sel</span>
                            <span>Rab</span>
                            <span>Kam</span>
                            <span>Jum</span>
                            <span>Sab</span>
                            <span>Min</span>

                        </div>

                    </div>

                </div>


                {{-- Ringkasan Penjualan --}}
                <div class="mt-8 flex items-center justify-between border-t border-orange-50 pt-4">

                    <div>
                        <p class="text-[10px] text-[#A58C7D]">
                            Total Penjualan
                        </p>

                        <p class="mt-1 text-lg font-black text-[#C1440E]">
                            Rp4.850.000
                        </p>
                    </div>


                    <div class="flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-1">

                        <i class="fa-solid fa-arrow-trend-up text-[9px] text-green-600"></i>

                        <span class="text-[9px] font-bold text-green-600">
                            +12,5%
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Ringkasan Tambahan --}}
        <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-3">
            <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="fa-solid fa-box text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#3B2115]">
                            Pesanan Baru Masuk
                        </p>
                        <p class="text-[10px] text-[#A58C7D]">
                            Notifikasi Pesanan Masuk
                        </p>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-black text-[#3B2115]">
                    24
                </p>
            </div>
            <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50 text-[#E85D04]">
                        <i class="fa-solid fa-clock text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#3B2115]">
                            Pesanan Diproses
                        </p>
                        <p class="text-[10px] text-[#A58C7D]">
                            Menunggu diselesaikan
                        </p>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-black text-[#3B2115]">
                    18
                </p>
            </div>
            <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-600">
                        <i class="fa-solid fa-circle-check text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#3B2115]">
                            Pesanan Selesai
                        </p>
                        <p class="text-[10px] text-[#A58C7D]">
                            Pesanan berhasil
                        </p>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-black text-[#3B2115]">
                    2.210
                </p>
            </div>
        </div>
    </section>
</main>
@endsection