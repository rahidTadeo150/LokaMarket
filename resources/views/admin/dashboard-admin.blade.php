@extends('layouts.admin')

@section('title', 'Dashboard Admin - LokaMarket')

@section('page-heading', 'Dashboard')

@section('content')

    {{-- HEADER DASHBOARD --}}
    <div class="mb-6">

        <h1 class="text-2xl font-extrabold text-[#3B2115]">
            Dashboard Admin
        </h1>
        <p class="mt-1 text-sm text-[#8D776A]">
            Pantau dan kelola aktivitas LokaMarket.
        </p>

    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-[#A58E81]">
                        Total Pengguna
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        1.248
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-green-600">
                        <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                        +12,5% bulan ini
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-users"></i>
                </div>

            </div>

        </div>

        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-[#A58E81]">
                        Total Toko
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        186
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-green-600">
                        <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                        +8 toko baru
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-store"></i>
                </div>

            </div>

        </div>

        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-[#A58E81]">
                        Total Produk
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        2.540
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-green-600">
                        <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                        +124 produk
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-box-open"></i>
                </div>

            </div>

        </div>

        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-[#A58E81]">
                        Pengajuan Toko
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        12
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-orange-600">
                        <i class="fa-solid fa-clock mr-1"></i>
                        Perlu diperiksa
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-file-circle-check"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- CONTENT UTAMA --}}
    <div class="mt-6 grid grid-cols-1 gap-5 xl:grid-cols-3">

        {{-- GRAFIK --}}
        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm xl:col-span-2">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-sm font-bold text-[#3B2115]">
                        Aktivitas LokaMarket
                    </h2>

                    <p class="mt-1 text-[11px] text-[#A58E81]">
                        Statistik aktivitas pengguna selama 6 bulan terakhir
                    </p>

                </div>

                <button type="button"
                        class="flex items-center gap-2 rounded-lg border border-orange-100 px-3 py-2 text-[10px] font-semibold text-[#72594B] hover:bg-orange-50">
                    2026
                    <i class="fa-solid fa-chevron-down text-[8px]"></i>
                </button>

            </div>

            <div class="mt-8 flex h-64 items-end gap-3 border-b border-orange-100 px-2">

                <div class="flex h-full flex-1 flex-col justify-end">
                    <div class="rounded-t-lg bg-orange-200 transition hover:bg-orange-300"
                        style="height: 35%;">
                    </div>
                    <p class="mt-2 text-center text-[9px] text-[#A58E81]">
                        Jan
                    </p>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end">
                    <div class="rounded-t-lg bg-orange-300 transition hover:bg-orange-400"
                        style="height: 48%;">
                    </div>
                    <p class="mt-2 text-center text-[9px] text-[#A58E81]">
                        Feb
                    </p>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end">
                    <div class="rounded-t-lg bg-orange-400 transition hover:bg-orange-500"
                        style="height: 42%;">
                    </div>
                    <p class="mt-2 text-center text-[9px] text-[#A58E81]">
                        Mar
                    </p>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end">
                    <div class="rounded-t-lg bg-orange-500 transition hover:bg-orange-600"
                        style="height: 60%;">
                    </div>
                    <p class="mt-2 text-center text-[9px] text-[#A58E81]">
                        Apr
                    </p>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end">
                    <div class="rounded-t-lg bg-orange-500 transition hover:bg-orange-600"
                        style="height: 75%;">
                    </div>
                    <p class="mt-2 text-center text-[9px] text-[#A58E81]">
                        Mei
                    </p>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end">
                    <div class="rounded-t-lg bg-orange-600 transition hover:bg-orange-700"
                        style="height: 88%;">
                    </div>
                    <p class="mt-2 text-center text-[9px] text-[#A58E81]">
                        Jun
                    </p>
                </div>

            </div>

            <div class="mt-5 flex items-center justify-between">

                <div>
                    <p class="text-[10px] text-[#A58E81]">
                        Pengguna aktif
                    </p>
                    <p class="mt-1 text-sm font-bold text-[#3B2115]">
                        1.084 pengguna
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-[10px] text-[#A58E81]">
                        Pertumbuhan
                    </p>
                    <p class="mt-1 text-sm font-bold text-green-600">
                        +18,4%
                    </p>
                </div>

            </div>

        </div>

        {{-- PENGAJUAN TOKO --}}
        <div class="flex h-full flex-col rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="text-sm font-bold text-[#3B2115]">
                        Pengajuan Toko
                    </h2>
                    <p class="mt-1 text-[11px] text-[#A58E81]">
                        Menunggu pemeriksaan
                    </p>
                </div>

                <a href="#"
                class="text-[10px] font-bold text-orange-500 hover:text-orange-600">
                    Lihat semua
                </a>

            </div>

            <div class="mt-5 flex-1 space-y-3">

                <div class="flex items-center gap-3 rounded-xl border border-orange-100 p-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-store text-sm"></i>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-xs font-bold text-[#3B2115]">
                            Geprek WW
                        </p>
                        <p class="mt-1 text-[10px] text-[#A58E81]">
                            Budi Santoso
                        </p>
                    </div>

                    <span class="rounded-full bg-yellow-100 px-2 py-1 text-[8px] font-bold text-yellow-700">
                        Pending
                    </span>

                </div>

            </div>

            <a href="#"
            class="mt-5 flex items-center justify-center gap-2 rounded-xl bg-orange-50 py-3 text-[10px] font-bold text-orange-600 transition hover:bg-orange-100">
                Periksa Pengajuan
                <i class="fa-solid fa-arrow-right text-[9px]"></i>
            </a>

        </div>

    </div>

    <div class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-2">

        <div class="rounded-2xl border border-orange-100 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-orange-100 px-5 py-4">

                <div>
                    <h2 class="text-sm font-bold text-[#3B2115]">
                        Pesanan Terbaru
                    </h2>
                    <p class="mt-1 text-[10px] text-[#A58E81]">
                        Aktivitas pesanan terbaru
                    </p>
                </div>

                <a href="#"
                class="text-[10px] font-bold text-orange-500 hover:text-orange-600">
                    Lihat semua
                </a>

            </div>

            <div class="divide-y divide-orange-50">

                <div class="flex items-center gap-3 px-5 py-4">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-bag-shopping text-xs"></i>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-[#3B2115]">
                            #LM-10245
                        </p>
                        <p class="mt-1 text-[9px] text-[#A58E81]">
                            Rina • Geprek WW
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs font-bold text-[#3B2115]">
                            Rp85.000
                        </p>
                        <span class="text-[9px] font-semibold text-green-600">
                            Selesai
                        </span>
                    </div>

                </div>

            </div>

        </div>

        <div class="rounded-2xl border border-orange-100 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-orange-100 px-5 py-4">

                <div>
                    <h2 class="text-sm font-bold text-[#3B2115]">
                        Toko Terbaru
                    </h2>
                    <p class="mt-1 text-[10px] text-[#A58E81]">
                        Toko yang baru bergabung
                    </p>
                </div>

                <a href="#"
                class="text-[10px] font-bold text-orange-500 hover:text-orange-600">
                    Lihat semua
                </a>

            </div>

            <div class="divide-y divide-orange-50">

                <div class="flex items-center gap-3 px-5 py-4">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-store text-xs"></i>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-[#3B2115]">
                            Geprek WW
                        </p>
                        <p class="mt-1 text-[9px] text-[#A58E81]">
                            Budi Santoso • 24 Produk
                        </p>
                    </div>

                    <span class="rounded-full bg-green-100 px-2 py-1 text-[8px] font-bold text-green-700">
                        Aktif
                    </span>

                </div>

            </div>

        </div>

    </div>

@endsection