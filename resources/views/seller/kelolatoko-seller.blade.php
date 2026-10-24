@extends('layouts.seller')

@section('title', 'Kelola Toko - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#FFF9F4] text-[#3B2115]">
    <div class="mx-auto max-w-7xl space-y-7 px-4 py-6 sm:px-6 lg:px-8 lg:py-9">

        <section class="relative overflow-hidden rounded-3xl border border-orange-100 bg-white p-5 shadow-sm sm:p-7">
            <div class="pointer-events-none absolute -right-12 -top-16 h-48 w-48 rounded-full bg-orange-100/70 blur-3xl"></div>
            <div class="relative flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

                <div>
                    <div class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.18em] text-orange-600">
                        <i class="fa-solid fa-store"></i>
                        <span>Dashboard Penjual</span>
                        <i class="fa-solid fa-chevron-right text-[9px] text-orange-300"></i>
                        <span class="text-[#A58C7D]">Toko Saya</span>
                    </div>

                    <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">
                        Kelola Toko
                    </h1>

                    <p class="mt-2 max-w-xl text-sm leading-relaxed text-[#8C7467]">
                        Kelola informasi toko, pantau aktivitas, dan kembangkan usaha lokalmu bersama LokaMarket.
                    </p>
                </div>

                <a href="{{ route('seller.formEditToko') }}"
                   class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[#E85D04] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200/60 transition hover:-translate-y-0.5 hover:bg-[#C94B12]">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Informasi
                </a>

            </div>
        </section>

        <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

            <div class="relative h-36 overflow-hidden bg-linear-to-br from-[#FFB347] via-[#F87516] to-[#C1440E] sm:h-48">

                <div class="absolute -right-10 -top-24 h-72 w-72 rounded-full border-35 border-white/10"></div>
                <div class="absolute right-28 top-12 h-24 w-24 rounded-full bg-white/10 blur-sm"></div>
                <div class="absolute -bottom-16 left-1/3 h-40 w-40 rounded-full bg-[#FFDAA8]/20 blur-2xl"></div>

                <div class="relative flex h-full flex-col justify-between p-5 sm:p-7">

                    <div class="flex items-start justify-between gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/15 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-md sm:text-xs">
                            <i class="fa-solid fa-shop"></i>
                            Profil Toko
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-white/30 bg-white/15 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-md">
                            <i class="fa-solid fa-circle-check"></i>
                            Terverifikasi
                        </span>
                    </div>

                    <div class="hidden items-center gap-2 self-end text-xs font-semibold text-white/80 sm:flex">
                        <i class="fa-solid fa-sparkles"></i>
                        Tumbuh bersama UMKM lokal
                    </div>

                </div>

            </div>

            <div class="px-5 pb-6 sm:px-8 sm:pb-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                    <div class="flex min-w-0 flex-col gap-4 sm:flex-row sm:items-end">

                        <div class="relative -mt-11 flex h-24 w-24 shrink-0 items-center justify-center rounded-3xl border-4 border-white bg-linear-to-br from-orange-400 to-orange-600 text-3xl font-extrabold text-white shadow-lg shadow-orange-200/50 sm:-mt-14 sm:h-28 sm:w-28">
                            WS
                        </div>

                        <div class="mt-5 min-w-0 sm:pb-1">
							
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="wrap-words text-xl font-extrabold sm:text-2xl">
                                    Warung Bu Sri
                                </p>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-[10px] font-bold text-green-700 ring-1 ring-inset ring-green-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Toko Aktif
                                </span>
                            </div>

                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-[#8C7467] sm:text-sm">
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-orange-500"></i>
                                    Kediri, Jawa Timur
                                </span>
                                <span class="inline-flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-orange-500"></i>
                                    Bergabung Januari 2022
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 sm:shrink-0 sm:pb-1">
                        <a href="{{ route('seller.formEditToko') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-orange-200 px-4 py-2.5 text-xs font-bold text-orange-700 transition hover:border-orange-300 hover:bg-orange-50">
                            <i class="fa-solid fa-pen"></i>
                            Edit Profil
                        </a>
                        <a href="#statistik-toko"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#FFF1E5] px-4 py-2.5 text-xs font-bold text-orange-700 transition hover:bg-orange-100">
                            <i class="fa-solid fa-chart-column"></i>
                            Statistik
                        </a>
                    </div>

                </div>

                <div class="mt-7 grid grid-cols-1 gap-3 border-t border-orange-100 pt-6 sm:grid-cols-3">

                    <div class="flex items-center gap-3 rounded-2xl bg-[#FFF9F4] p-4 transition hover:bg-[#FFF3E8]">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-lg text-orange-500 shadow-sm">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-[#A58C7D]">Kategori Toko</p>
                            <p class="mt-1 wrap-words text-sm font-bold">Makanan & Minuman</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl bg-[#FFF9F4] p-4 transition hover:bg-[#FFF3E8]">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-lg text-orange-500 shadow-sm">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-[#A58C7D]">Jam Operasional</p>
                            <p class="mt-1 text-sm font-bold">08.00 – 20.00 WIB</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl bg-[#FFF9F4] p-4 transition hover:bg-[#FFF3E8]">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-lg text-orange-500 shadow-sm">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-[#A58C7D]">Kontak Toko</p>
                            <p class="mt-1 wrap-words text-sm font-bold">0812-3456-7890</p>
                        </div>
                    </div>

                </div>

            </div>

        </section>

        <section id="statistik-toko">

            <div class="mb-4 flex flex-wrap items-end justify-between gap-3">

                <div>
                    <div class="mb-1 flex items-center gap-2">
                        <span class="h-5 w-1 rounded-full bg-orange-500"></span>
                        <h2 class="text-lg font-extrabold sm:text-xl">Ringkasan Toko</h2>
                    </div>
                    <p class="text-xs text-[#8C7467]">
                        Gambaran singkat kondisi tokomu saat ini.
                    </p>
                </div>

                <span class="inline-flex items-center gap-1.5 rounded-full border border-orange-100 bg-white px-3 py-1.5 text-xs font-medium text-[#8C7467]">
                    <i class="fa-regular fa-calendar text-orange-500"></i>
                    Data dummy
                </span>

            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

                <div class="group relative overflow-hidden rounded-2xl border border-orange-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-100/60">

                    <div class="absolute -right-7 -top-7 h-28 w-28 rounded-full bg-orange-50 transition group-hover:scale-125"></div>

                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-[#8C7467]">Total Produk</p>
                            <h3 class="mt-3 text-3xl font-extrabold tracking-tight">86</h3>
                            <p class="mt-2 text-xs text-[#A58C7D]">Produk terdaftar di toko</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-xl text-orange-500 transition group-hover:bg-orange-500 group-hover:text-white">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                    </div>

                    <div class="relative mt-5 flex items-center gap-2">
                        <div class="h-2 flex-1 overflow-hidden rounded-full bg-orange-50">
                            <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-orange-400 to-orange-600"></div>
                        </div>
                        <span class="text-[10px] font-bold text-orange-600">75%</span>
                    </div>

                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-orange-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-100/60">

                    <div class="absolute -right-7 -top-7 h-28 w-28 rounded-full bg-amber-50 transition group-hover:scale-125"></div>

                    <div class="relative flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-[#8C7467]">Rating Toko</p>
                            <div class="mt-3 flex items-center gap-2">
                                <h3 class="text-3xl font-extrabold tracking-tight">4.9</h3>
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-700">
                                    <i class="fa-solid fa-star mr-1"></i>
                                    Rating
                                </span>
                            </div>
                            <p class="mt-2 text-xs text-[#A58C7D]">Penilaian dari pelanggan</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-xl text-amber-500 transition group-hover:bg-amber-500 group-hover:text-white">
                            <i class="fa-solid fa-star"></i>
                        </div>

                    </div>

                    <div class="relative mt-5 flex items-center gap-1 text-sm text-amber-400">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                        <span class="ml-2 text-xs text-[#A58C7D]">Sangat baik</span>
                    </div>

                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-orange-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-100/60 sm:col-span-2 xl:col-span-1">
					
                    <div class="absolute -right-7 -top-7 h-28 w-28 rounded-full bg-green-50 transition group-hover:scale-125"></div>

                    <div class="relative flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-[#8C7467]">Status Toko</p>
                            <p class="mt-3 text-2xl font-extrabold text-green-700">Aktif</p>
                            <p class="mt-2 text-xs text-[#A58C7D]">Toko dapat dilihat pelanggan</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 text-xl text-green-600 transition group-hover:bg-green-600 group-hover:text-white">
                            <i class="fa-solid fa-shop"></i>
                        </div>
                    </div>

                    <div class="relative mt-5 inline-flex items-center gap-2 rounded-full bg-green-50 px-3 py-2 text-xs font-semibold text-green-700">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-50"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                        </span>
                        Toko sedang beroperasi
                    </div>

                </div>

            </div>

        </section>

        <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">
			
            <section id="informasi-toko" class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm lg:col-span-2">
                <div class="flex items-center justify-between border-b border-orange-100 px-5 py-5 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-lg text-orange-600">
                            <i class="fa-solid fa-store"></i>
                        </div>

                        <div>
                            <h2 class="font-extrabold">Informasi Toko</h2>
                            <p class="mt-1 text-xs text-[#A58C7D]">Informasi dasar usaha Anda</p>
                        </div>
                    </div>

                    <button type="button"
                            class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-bold text-orange-600 transition hover:bg-orange-50">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </button>
                </div>

                @php
                    $details = [
                        ['Nama Toko', 'Warung Bu Sri', 'fa-store'],
                        ['Kategori Utama', 'Makanan & Minuman', 'fa-tags'],
                        ['No. Telepon', '0812-3456-7890', 'fa-phone'],
                        ['Email Toko', 'warungbusri@email.com', 'fa-envelope'],
                        ['Alamat', 'Jl. Dhoho No. 45, Kediri', 'fa-location-dot'],
                        ['Jam Operasional', '08.00 – 20.00 WIB', 'fa-clock'],
                    ];
                @endphp

                <div class="grid grid-cols-1 gap-x-8 px-5 py-2 sm:grid-cols-2 sm:px-6">
                    @foreach ($details as $detail)
                        <div class="flex min-w-0 gap-3 border-b border-orange-50 py-4 last:border-b-0 sm:[&:nth-last-child(-n+2)]:border-b-0">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FFF7F0] text-orange-500">
                                <i class="fa-solid {{ $detail[2] }}"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-medium text-[#A58C7D]">{{ $detail[0] }}</p>
                                <p class="mt-1 break-words text-sm font-bold text-[#3B2115]">{{ $detail[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mx-5 mb-5 flex items-start gap-3 rounded-xl border border-orange-100 bg-[#FFF9F4] p-4 sm:mx-6">
                    <i class="fa-solid fa-circle-info mt-0.5 text-orange-500"></i>
                    <p class="text-xs leading-relaxed text-[#8C7467]">
                        Pastikan informasi toko selalu diperbarui agar pelanggan dapat menghubungi dan menemukan tokomu dengan mudah.
                    </p>
                </div>
            </section>

            {{-- PANEL SAMPING --}}
            <div class="space-y-6">

                {{-- DESKRIPSI TOKO --}}
                <section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">
                    <div class="flex items-center justify-between border-b border-orange-100 px-5 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                <i class="fa-solid fa-align-left"></i>
                            </div>

                            <div>
                                <h2 class="font-extrabold">Deskripsi Toko</h2>
                                <p class="mt-1 text-xs text-[#A58C7D]">Cerita singkat usaha Anda</p>
                            </div>
                        </div>

                        <button type="button"
                                aria-label="Edit deskripsi toko"
                                class="flex h-9 w-9 items-center justify-center rounded-lg text-orange-600 transition hover:bg-orange-50">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>

                    <div class="p-5">
                        <p class="text-sm leading-7 text-[#72594B]">
                            Warung Bu Sri telah melayani pelanggan sejak 2022, menyajikan masakan khas Kediri dengan resep turun-temurun. Semua produk dibuat fresh setiap hari tanpa bahan pengawet.
                        </p>

                        <div class="mt-5 flex items-start gap-3 rounded-xl bg-[#FFF8F1] p-4">
                            <i class="fa-solid fa-heart mt-0.5 text-orange-500"></i>
                            <p class="text-xs leading-relaxed text-[#8C7467]">
                                Sajian rumahan dengan cita rasa lokal, dibuat dengan perhatian untuk setiap pelanggan.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- PINTASAN TOKO --}}
                <section class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
                    <div class="mb-5">
                        <div class="mb-1 flex items-center gap-2">
                            <span class="h-5 w-1 rounded-full bg-orange-500"></span>
                            <h2 class="font-extrabold">Pintasan Toko</h2>
                        </div>
                        <p class="text-xs text-[#A58C7D]">Akses cepat pengelolaan toko</p>
                    </div>

                    <div class="space-y-3">
                        <a href="#"
                           class="group flex items-center justify-between gap-3 rounded-xl border border-orange-100 p-3.5 transition hover:border-orange-200 hover:bg-[#FFF8F1]">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600 transition group-hover:bg-orange-500 group-hover:text-white">
                                    <i class="fa-solid fa-box"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-bold">Kelola Produk</p>
                                    <p class="mt-1 text-xs text-[#A58C7D]">Atur produk dan stok</p>
                                </div>
                            </div>

                            <i class="fa-solid fa-chevron-right shrink-0 text-xs text-[#C6A999] transition group-hover:translate-x-1 group-hover:text-orange-500"></i>
                        </a>

                        <a href="#"
                           class="group flex items-center justify-between gap-3 rounded-xl border border-orange-100 p-3.5 transition hover:border-orange-200 hover:bg-[#FFF8F1]">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600 transition group-hover:bg-orange-500 group-hover:text-white">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-bold">Kelola Pesanan</p>
                                    <p class="mt-1 text-xs text-[#A58C7D]">Periksa pesanan pelanggan</p>
                                </div>
                            </div>

                            <i class="fa-solid fa-chevron-right shrink-0 text-xs text-[#C6A999] transition group-hover:translate-x-1 group-hover:text-orange-500"></i>
                        </a>

                        <a href="#statistik-toko"
                           class="group flex items-center justify-between gap-3 rounded-xl border border-orange-100 p-3.5 transition hover:border-orange-200 hover:bg-[#FFF8F1]">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600 transition group-hover:bg-orange-500 group-hover:text-white">
                                    <i class="fa-solid fa-chart-line"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-bold">Dashboard Penjual</p>
                                    <p class="mt-1 text-xs text-[#A58C7D]">Ringkasan aktivitas toko</p>
                                </div>
                            </div>

                            <i class="fa-solid fa-chevron-right shrink-0 text-xs text-[#C6A999] transition group-hover:translate-x-1 group-hover:text-orange-500"></i>
                        </a>
                    </div>
                </section>
            </div>
        </div>

        {{-- TIPS TOKO --}}
        <section class="relative overflow-hidden rounded-2xl border border-orange-100 bg-gradient-to-r from-[#FFF1E5] to-[#FFF9F4] p-5 sm:p-6">
            <div class="pointer-events-none absolute -right-8 -top-12 h-36 w-36 rounded-full bg-orange-200/30 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-16 right-1/3 h-32 w-32 rounded-full bg-orange-100/50 blur-2xl"></div>

            <div class="relative flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-xl text-orange-500 shadow-sm">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>

                <div>
                    <h3 class="text-sm font-extrabold text-[#6E3B20]">
                        Tips untuk toko Anda
                    </h3>

                    <p class="mt-1.5 max-w-3xl text-xs leading-relaxed text-[#8C7467] sm:text-sm">
                        Gunakan foto toko yang jelas, tuliskan deskripsi yang informatif, dan perbarui informasi kontak agar pelanggan semakin mudah mengenal usaha Anda.
                    </p>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="flex flex-col items-center justify-between gap-2 border-t border-orange-100 pt-5 text-center text-xs text-[#A58C7D] sm:flex-row sm:text-left">
            <p>
                <i class="fa-solid fa-store mr-1 text-orange-500"></i>
                Kelola tokomu dengan mudah bersama LokaMarket.
            </p>

            <p>Warung Bu Sri · Data dummy statis</p>
        </footer>

    </div>
</main>
@endsection