@extends('layouts.customer')

@section('title', 'Cara Kerja - LokaMarket')

@section('content')
    {{-- Hero Page --}}
    <section class="bg-[#FCE8D0] overflow-hidden">
        <div class="px-6 lg:px-10">
            <div class="h-fit md:flex justify-between items-center gap-10">
                <div class="py-16 lg:py-20">
                    <span
                        class="inline-flex items-center rounded-full bg-white px-4 py-1.5 text-xs font-semibold text-orange-600 shadow-sm">
                        Tentang LokaMarket
                    </span>
                    <p class="mt-5 text-4xl max-w-6xl  font-extrabold tracking-tight text-[#2F1B12]">
                        Menghubungkan Seluruh Kebutuhanmu Dengan UMKM Lokal Dalam Satu Platform
                    </p>
                    <p class="mt-6 max-w-lg text-sm sm:text-base leading-7 text-[#795548]">
                        LokaMarket hadir untuk membantu produk dan usaha lokal di sekitar kita agar lebih mudah ditemukan, dikenal, dan dibeli oleh masyarakat melalui satu platform digital.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="#tentang"
                           class="inline-flex items-center justify-center rounded-full bg-orange-600 px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:bg-orange-700 hover:-translate-y-0.5">
                            Kenali LokaMarket
                        </a>
                        <a href="#perjuangan"
                           class="inline-flex items-center justify-center rounded-full border border-orange-300 bg-white/60 px-6 py-3 text-sm font-semibold text-orange-700 hover:bg-white">
                            Lihat Perjalanan
                        </a>
                    </div>
                </div>
                <div class="hidden md:block relative w-full">
                    <div class="absolute bottom-10 right-10 h-64 w-64 rounded-full bg-orange-300/30 blur-3xl">
                    </div>
                    <img src="{{ asset('storage/hero-about-us.png') }}"
                        alt="Ilustrasi Pembeli"
                        class="w-full object-cover drop-shadow-xl"
                    >
                </div>
            </div>
        </div>
    </section>
    <section id="tentang"
             class="bg-[#FFF9F2] py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="grid lg:grid-cols-2 items-center gap-14 lg:gap-24">
                <div class="flex justify-center">
                    <div class="overflow-hidden bg-linear-to-br from-[#FFDEA9] to-[#FFA95E] rounded-2xl">
                        <img
                            src="{{ asset('storage/content-about-us.png') }}"
                            alt="Pengguna LokaMarket"
                            class="relative z-10 w-full object-cover"
                        >
                    </div>
                </div>
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600">
                        Tentang Kami
                    </span>
                    <p class="mt-4 text-3xl sm:text-4xl font-extrabold tracking-tight text-[#2F1B12]">
                        Bermula dari Pasar Bagi di Kecil
                    </p>
                    <div class="mt-6 space-y-4 text-sm sm:text-base leading-7 text-[#795548]">
                        <p>
                            LokaMarket dibangun dari sebuah keresahan sederhana: banyak usaha kecil dan produk lokal yang memiliki kualitas baik, tetapi belum mudah ditemukan oleh masyarakat.
                        </p>
                        <p>
                            Kami percaya bahwa setiap desa, kampung, dan lingkungan memiliki cerita serta potensi ekonomi yang layak untuk dikenal lebih luas.
                        </p>
                        <p>
                            Karena itu, LokaMarket menjadi jembatan antara pelaku usaha lokal dengan pelanggan melalui pengalaman belanja yang mudah, dekat, dan terpercaya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
