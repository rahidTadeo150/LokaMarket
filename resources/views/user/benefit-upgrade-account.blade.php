@extends('layouts.customer')

@section('title', 'Buka Toko - LokaMarket')

@section('content')

<main class="min-h-screen scroll-smooth bg-[#FFF9F2]">

    {{-- =====================================================
        HERO
    ====================================================== --}}
    <section class="relative overflow-hidden bg-linear-to-r from-[#FFF9F2] to-[#FFF1DF]">

        {{-- Decorative --}}
        <div class="pointer-events-none absolute -right-32 -top-32 h-80 w-80 rounded-full bg-orange-200/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -left-32 bottom-0 h-72 w-72 rounded-full bg-orange-100/40 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-6 py-16 lg:grid-cols-2 lg:px-8 lg:py-20">

            {{-- LEFT --}}
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
                    Jadikan hobi, produk, atau usahamu lebih besar
                    dengan membuka toko di LokaMarket.
                    Kelola produk, jangkau lebih banyak pelanggan,
                    dan kembangkan bisnismu bersama kami.
                </p>

                <a href="#keuntungan"
                    id="btnKeuntungan"
                    class="mt-8 inline-flex items-center gap-3 rounded-xl bg-orange-500 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition duration-300 hover:-translate-y-0.5 hover:bg-orange-600 hover:shadow-xl">
                    Lihat Keuntungannya
                    <i class="fa-solid fa-arrow-down text-xs"></i>
                </a>

            </div>


            {{-- RIGHT --}}
            <div class="relative flex items-center justify-center">

                {{-- Background Circle --}}
                <div class="absolute h-[350px] w-[350px] rounded-full bg-orange-100/80 sm:h-[430px] sm:w-[430px]"></div>

                {{-- Store Illustration --}}
                <div class="relative w-full max-w-[500px]">

                    {{-- Chart --}}
                    <div class="absolute right-2 top-3 rotate-6 text-orange-400 sm:right-4">
                        <i class="fa-solid fa-chart-line text-5xl"></i>
                    </div>

                    {{-- Store --}}
                    <div class="relative mx-auto mt-10 w-[300px] sm:w-[380px]">

                        {{-- Store Sign --}}
                        <div class="relative z-20 mx-auto w-[190px] rounded-xl bg-orange-500 px-5 py-3 text-center shadow-lg sm:w-[230px]">
                            <span class="text-xl font-black text-white sm:text-2xl">
                                Toko Saya
                            </span>
                        </div>

                        {{-- Roof --}}
                        <div class="relative z-10 -mt-1 overflow-hidden rounded-t-2xl">

                            <div class="flex h-16">
                                <div class="w-1/6 bg-orange-500"></div>
                                <div class="w-1/6 bg-white"></div>
                                <div class="w-1/6 bg-orange-500"></div>
                                <div class="w-1/6 bg-white"></div>
                                <div class="w-1/6 bg-orange-500"></div>
                                <div class="w-1/6 bg-white"></div>
                            </div>

                        </div>

                        {{-- Building --}}
                        <div class="relative h-[190px] rounded-b-xl bg-[#F8E6D2] px-6 shadow-xl">

                            <div class="flex h-full items-end justify-center gap-5 pb-5">

                                {{-- Door --}}
                                <div class="h-[120px] w-[65px] rounded-t-lg bg-[#6D4938] p-2">
                                    <div class="h-full rounded bg-[#8A6048]"></div>
                                </div>

                                {{-- Window --}}
                                <div class="relative h-[100px] w-[100px] rounded-lg bg-[#72594B] p-2">
                                    <div class="flex h-full items-center justify-center rounded bg-[#BFE2F1]">
                                        <span class="rounded bg-orange-500 px-3 py-1 text-xs font-bold text-white">
                                            OPEN
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- Boxes --}}
                        <div class="absolute -bottom-5 -left-8 flex items-end">
                            <div class="h-12 w-14 rounded-sm bg-[#D99B52] shadow"></div>
                            <div class="-ml-2 h-14 w-16 rounded-sm bg-[#E8AE62] shadow"></div>
                        </div>

                        {{-- Plant --}}
                        <div class="absolute -bottom-4 -left-20 hidden sm:block">
                            <i class="fa-solid fa-seedling text-6xl text-green-600"></i>
                        </div>

                        <div class="absolute -bottom-4 -right-12 hidden sm:block">
                            <i class="fa-solid fa-seedling text-5xl text-green-600"></i>
                        </div>

                    </div>


                    {{-- Person --}}
                    <div class="absolute -bottom-4 right-0 flex flex-col items-center sm:right-[-20px]">

                        {{-- Head --}}
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#F4C29D]">
                            <i class="fa-solid fa-user text-4xl text-[#3B2115]"></i>
                        </div>

                        {{-- Body --}}
                        <div class="-mt-3 h-28 w-24 rounded-t-[45px] bg-orange-500">
                            <div class="mt-8 flex justify-center">
                                <i class="fa-solid fa-tablet-screen-button text-3xl text-white"></i>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =====================================================
        KEUNTUNGAN
    ====================================================== --}}
    <section class="bg-white py-16"
            id="keuntungan">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            {{-- Heading --}}
            <div class="mx-auto max-w-2xl text-center">

                <h2 class="text-3xl font-black text-[#3B2115] sm:text-4xl">
                    Keuntungan Menjadi Toko di LokaMarket
                </h2>

                <p class="mt-3 text-sm leading-6 text-[#72594B] sm:text-base">
                    Nikmati berbagai keuntungan dan kemudahan
                    untuk mengembangkan tokomu.
                </p>

            </div>


            {{-- Cards --}}
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">

                {{-- Card 1 --}}
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


                {{-- Card 2 --}}
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


                {{-- Card 3 --}}
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


                {{-- Card 4 --}}
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


                {{-- Card 5 --}}
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

    </section>

</main>

@endsection