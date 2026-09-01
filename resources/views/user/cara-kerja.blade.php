@extends('layouts.customer')

@section('title', 'Cara Kerja - LokaMarket')

@section('content')
    <main>
        
        {{-- Header Page --}}
        <section class="bg-orange-100 m-10 rounded-md">
            <div class="mx-auto flex min-h-65 max-w-7xl flex-col items-center justify-center px-4 text-center">
                <span class="mb-1.5 text-sm font-extrabold uppercase tracking-wider text-orange-600">
                    CARA KERJA
                </span>
                <p class="text-3xl font-bold text-gray-900 md:text-4xl">
                    Cara Kerja LokaMarket
                </p>
                <p class="mt-8 max-w-2xl text-sm font-thin leading-6 text-gray-700 md:text-base">
                    Belanja menjadi lebih mudah dan praktis bersama LokaMarket.
                    Temukan produk lokal berkualitas dengan proses yang sederhana.
                </p>
            </div>
        </section>
    
        {{-- Tata Cara Pembeli --}}
        <section class="bg-white py-16">
            <div class="mx-auto max-w-7xl px-4">
                <div class="mb-10 text-center">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-orange-600">
                        UNTUK PEMBELI
                    </span>
                    <p class="mt-1.5 text-2xl font-bold text-gray-900 md:text-3xl">
                        Belanja dalam 4 Langkah Mudah
                    </p>
                    <p class="mx-auto mt-3 max-w-xl text-sm text-gray-500">
                        Nikmati pengalaman berbelanja produk lokal dengan proses
                        yang cepat, aman, dan mudah.
                    </p>
                </div>
                <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    <div class="group relative rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                01
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Cari Produk
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Jelajahi ribuan produk UMKM lokal lewat kategori, pencarian, atau rekomendasi di sekitarmu.
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                    <div class="group relative rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                02
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Tambahkan ke Keranjang
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Pilih produk favorit, atur jumlah, lalu masukkan ke keranjang belanja.
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                    <div class="group relative rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
    
                        <div class="mb-5 flex items-center justify-between">
    
                            <span class="text-3xl font-bold text-orange-400">
                                03
                            </span>
    
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
    
                        </div>
    
                        <p class="text-base font-bold text-gray-900">
                            Checkout & Bayar
                        </p>
    
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Selesaikan pesanan dengan metode pembayaran aman dengan transfer e-wallet, atau COD.
                        </p>
    
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
    
                    </div>
    
    
                    {{-- Step 04 --}}
                    <div class="group relative rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                04
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-box"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Terima Pesanan
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Produk dikirim langsung dari penjual lokal, Menuju Alamat Anda
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="#"
                       class="inline-flex items-center gap-2 rounded-full bg-linear-to-r from-[#F2600C] to-[#FDB813] px-6 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                        Mulai Belanja
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </section>
        {{-- Tata Cara Penjual --}}
        <section class="bg-orange-50 py-16">
            <div class="mx-auto max-w-7xl px-4">
                <div class="mb-10 text-center">
                    <span class="text-xs font-bold uppercase tracking-wider text-orange-600">
                        UNTUK PENJUAL
                    </span>
                    <p class="mt-2 text-2xl font-bold text-gray-900 md:text-3xl">
                        Buka Toko dalam 4 Langkah
                    </p>
                    <p class="mx-auto mt-3 max-w-xl text-sm text-gray-500">
                        Mulai jual produkmu dan kembangkan bisnis bersama
                        LokaMarket dengan mudah.
                    </p>
                </div>
                <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    <div class="group rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                01
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-store"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Daftar Toko
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Buat akun penjual gratis, lengkapi profil toko & data usahamu dalam hitungan menit.
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                    <div class="group rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                02
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-box"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Unggah Produkmu
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Tambahkan foto, deskripsi, harga, dan stok produk yang ingin kamu jual.
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                    <div class="group rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                03
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-bell"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Terima Pesanan
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Dapat notifikasi tiap ada pesanan masuk, siapkan & kirim produk ke pembeli.
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                    <div class="group rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="text-3xl font-bold text-orange-400">
                                04
                            </span>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                        </div>
                        <p class="text-base font-bold text-gray-900">
                            Cairkan Dana
                        </p>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Pembayaran masuk otomatis ke saldo tokomu, cairkan kapan saja ke rekeningmu.
                        </p>
                        <div class="mt-5 h-1 w-12 rounded-full bg-orange-500 transition-all duration-300 group-hover:w-full"></div>
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="#"
                       class="inline-flex items-center gap-2 rounded-full bg-linear-to-r from-[#F2600C] to-[#FDB813] px-6 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                        Daftar Sebagai Penjual
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection