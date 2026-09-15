@extends('layouts.admin')

@section('title', 'Dashboard Admin - LokaMarket')

@section('page-heading', 'Dashboard')

@section('content')

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
            <p class="text-xs text-[#A58E81]">Total Pengguna</p>

            <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                1.248
            </h2>

            <p class="mt-2 text-xs font-semibold text-green-600">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                +12,5% bulan ini
            </p>
        </div>


        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <p class="text-xs text-[#A58E81]">Total Toko</p>

            <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                186
            </h2>

            <p class="mt-2 text-xs font-semibold text-green-600">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                +8 toko baru
            </p>
        </div>


        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <p class="text-xs text-[#A58E81]">Total Produk</p>

            <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                2.540
            </h2>

            <p class="mt-2 text-xs font-semibold text-green-600">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                +124 produk
            </p>
        </div>


        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <p class="text-xs text-[#A58E81]">Pengajuan Toko</p>

            <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                12
            </h2>

            <p class="mt-2 text-xs font-semibold text-orange-600">
                <i class="fa-solid fa-clock mr-1"></i>
                Perlu diperiksa
            </p>
        </div>

    </div>

@endsection