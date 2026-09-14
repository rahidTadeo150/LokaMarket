@extends('layouts.customer')

@section('title', 'Buka Toko - LokaMarket')

@section('content')

<main class="min-h-screen scroll-smooth bg-[#FFF9F2]">

    <section class="relative overflow-hidden bg-linear-to-r from-[#FFF9F2] to-[#FFF1DF]">

        <div class="pointer-events-none absolute -right-32 -top-32 h-80 w-80 rounded-full bg-orange-200/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -left-32 bottom-0 h-72 w-72 rounded-full bg-orange-100/40 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-6 py-16 lg:grid-cols-2 lg:px-8 lg:py-20">

            <div>
                <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-orange-100 px-5 py-2 text-sm font-bold text-orange-600">
                    <i class="fa-solid fa-store"></i>
                    Upgrade Akun
                </div>
                <h1 class="max-w-xl text-4xl font-black leading-tight text-[#3B2115] sm:text-5xl">
                    Buka Toko di
                    <span class="text-orange-500">
                        LokaMarket
                    </span>
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-[#72594B] sm:text-lg">
                    Jadikan hobi, produk, atau usahamu lebih besar dengan membuka toko di LokaMarket. Kelola produk, jangkau lebih banyak pelanggan, dan kembangkan bisnismu bersama kami.
                </p>
                <a href="#keuntungan"
                    id="btnKeuntungan"
                    class="mt-8 inline-flex items-center gap-3 rounded-xl bg-orange-500 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition duration-300 hover:-translate-y-0.5 hover:bg-orange-600 hover:shadow-xl">
                    Lihat Keuntungannya
                    <i class="fa-solid fa-arrow-down text-xs"></i>
                </a>
            </div>

            <div class="relative flex items-center justify-center">

                <img src="{{ asset('storage/header-toko-own.png') }}"
                    alt="Ilustrasi Membuka Toko di LokaMarket"
                    class="relative z-10 w-full object-contain">

            </div>

        </div>

    </section>

    <section class="bg-white py-16"
            id="keuntungan">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <h2 class="text-3xl font-black text-[#3B2115] sm:text-4xl">
                    Keuntungan Menjadi Toko di LokaMarket
                </h2>
                <p class="mt-3 text-sm leading-6 text-[#72594B] sm:text-base">
                    Nikmati berbagai keuntungan dan kemudahan
                    untuk mengembangkan tokomu.
                </p>

            </div>

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">

                <div class="group rounded-2xl border border-orange-100 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-orange-100">
                        <i class="fa-solid fa-store text-2xl text-orange-500"></i>
                    </div>
                    <h3 class="text-base font-black text-[#3B2115]">
                        Jangkauan Lebih Luas
                    </h3>
                    <p class="mt-3 text-sm leading-6 text-[#72594B]">
                        Produkmu bisa dilihat oleh jutaan pengguna
                        LokaMarket di seluruh Indonesia.
                    </p>

                </div>

                <div class="group rounded-2xl border border-orange-100 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-green-50">
                        <i class="fa-solid fa-shield-halved text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-base font-black text-[#3B2115]">
                        Aman & Terpercaya
                    </h3>
                    <p class="mt-3 text-sm leading-6 text-[#72594B]">
                        Transaksi aman dengan sistem pembayaran
                        terpercaya dan dukungan pelanggan.
                    </p>

                </div>

                <div class="group rounded-2xl border border-orange-100 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-indigo-50">
                        <i class="fa-solid fa-chart-column text-2xl text-indigo-500"></i>
                    </div>
                    <h3 class="text-base font-black text-[#3B2115]">
                        Mudah Mengelola Toko
                    </h3>
                    <p class="mt-3 text-sm leading-6 text-[#72594B]">
                        Kelola produk, pesanan, dan tokomu
                        melalui dashboard yang praktis.
                    </p>

                </div>

                <div class="group rounded-2xl border border-orange-100 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-red-50">
                        <i class="fa-solid fa-tag text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-base font-black text-[#3B2115]">
                        Biaya Terjangkau
                    </h3>
                    <p class="mt-3 text-sm leading-6 text-[#72594B]">
                        Nikmati biaya administrasi yang kompetitif
                        untuk mendukung perkembangan tokomu.
                    </p>

                </div>

                <div class="group rounded-2xl border border-orange-100 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-yellow-50">
                        <i class="fa-solid fa-star text-2xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-base font-black text-[#3B2115]">
                        Dukungan Penuh
                    </h3>
                    <p class="mt-3 text-sm leading-6 text-[#72594B]">
                        Dapatkan bantuan dan panduan dari tim
                        LokaMarket kapan saja.
                    </p>

                </div>

            </div>

        </div>

        <div class="mt-12 max-w-5xl mx-auto">

            <a href="{{ route('cust.formDaftarToko') }}"
            class="group w-full flex justify-center items-center gap-3 rounded-xl bg-orange-500 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition duration-300 hover:-translate-y-1 hover:bg-orange-600 hover:shadow-xl">

                <i class="fa-solid fa-store"></i>
                Buka Toko Sekarang
                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/20 transition duration-300 group-hover:translate-x-1">
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </span>

            </a>

        </div>

    </section>

    <section class="relative overflow-hidden bg-[#FFF4E6] py-16">

    <div class="pointer-events-none absolute -left-20 -top-20 h-48 w-48 rounded-full bg-orange-200/40 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-20 h-56 w-56 rounded-full bg-orange-300/30 blur-3xl"></div>

    <div class="pointer-events-none absolute left-[8%] top-12 h-10 w-10 rounded-full border-4 border-orange-300/40"></div>
    <div class="pointer-events-none absolute bottom-10 right-[10%] h-6 w-6 rounded-full bg-orange-300/50"></div>

    <div class="relative mx-auto max-w-5xl px-6">

        <div class="relative overflow-hidden rounded-3xl border border-orange-100 bg-white px-8 py-10 shadow-sm sm:px-12">

            <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-orange-100"></div>

            <div class="pointer-events-none absolute -bottom-20 -left-10 h-36 w-36 rounded-full bg-orange-50"></div>

            <div class="relative z-10 flex flex-col items-center justify-between gap-8 text-center md:flex-row md:text-left">

                <div class="flex items-center gap-5">

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-orange-100">
                        <i class="fa-solid fa-store text-2xl text-orange-500"></i>
                    </div>

                    <div>
                        <h2 class="text-xl font-black text-[#3B2115] sm:text-2xl">
                            Siap Mulai Berjualan?
                        </h2>
                        <p class="mt-1 max-w-lg text-sm leading-6 text-[#72594B]">
                            Bergabunglah dengan LokaMarket dan mulai kembangkan
                            usahamu bersama pelanggan dari seluruh Indonesia.
                        </p>
                    </div>

                </div>

                <a href="{{ route('cust.formDaftarToko') }}"
                class="group inline-flex shrink-0 items-center gap-3 rounded-xl bg-orange-500 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition duration-300 hover:-translate-y-1 hover:bg-orange-600 hover:shadow-xl">
                    Buka Toko
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/20 transition duration-300 group-hover:translate-x-1">
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </a>

            </div>

        </div>

    </div>

</section>

</main>

@endsection