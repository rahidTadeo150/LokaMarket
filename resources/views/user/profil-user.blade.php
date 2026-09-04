@extends('layouts.customer')

@section('title', 'Profil Saya - LokaMarket')

@section('content')
    <section class="bg-[#FFF9F2] px-8 md:px-10 lg:px-20 py-8">
        <div class="mx-auto">
            {{-- Header --}}
            <div class="mb-10">
                <p class="text-2xl font-bold text-[rgb(61,36,24)]">
                    Profil Saya
                </p>
                <p class="text-sm font-light text-gray-500">
                    Kelola informasi profile lokamarket Saya
                </p>
                <div class="mt-6 h-0.5 w-full rounded-full bg-orange-500"></div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                {{-- PROFILE CARD --}}
                <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                    <div class="flex flex-col items-center text-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-orange-500 text-lg font-bold text-white shadow-sm">
                            {{ strtoupper(substr($user->username, 0, 1)) }}
                        </div>
                        <h2 class="mt-3 font-bold text-[#3D2418]">
                            {{ $user->username }}
                        </h2>
                        <p class="mt-1 text-xs font-light text-gray-400">
                            Member sejak {{ $user->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    {{-- Menu --}}
                    <div class="mt-6 space-y-1">
                        <a href="#"
                            class="flex items-center gap-3 rounded-lg bg-orange-50 px-3 py-2.5 text-sm font-semibold text-orange-600">
                            <i class="fa-solid fa-user"></i>
                            <span>
                                Pesanan Saya    
                            </span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                            <i class="fa-solid fa-receipt"></i>
                            <span>
                                Riwayat Pesanan
                            </span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                            <i class="fa-solid fa-heart"></i>
                            <span>
                                Wishlist
                            </span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>
                                Alamat
                            </span>
                        </a>
                        <div class="my-3 border-t border-gray-100"></div>
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-red-500 transition hover:bg-red-50">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>
                                    Keluar
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Informasi Akun Card --}}
                <div class="space-y-5 col-span-2">
                    <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <div>
                                <h2 class="text-xl font-bold text-[#3D2418]">
                                    Informasi Akun
                                </h2>
                                <p class="mt-1 text-xs text-gray-400">
                                    Informasi pribadi akun Anda
                                </p>
                            </div>
                            <a href="#"
                            class="rounded-md bg-orange-500 px-5 py-1.5 text-xs font-semibold text-white transition hover:bg-orange-600">
                                Edit Profil
                            </a>
                        </div>
                        <div class="grid grid-cols-1 gap-x-8 sm:grid-cols-2">
                            <div class="border-b border-gray-100 py-3">
                                <p class="text-[10px] text-gray-400">
                                    Nama Lengkap
                                </p>
                                <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                    {{ $user->username }}
                                </p>
                            </div>
                            <div class="border-b border-gray-100 py-3">
                                <p class="text-[10px] text-gray-400">
                                    Email
                                </p>
                                <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <div class="border-b border-gray-100 py-3">
                                <p class="text-[10px] text-gray-400">
                                    No. Telepon
                                </p>
                                <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                    {{ $user->no_telp }}
                                </p>
                            </div>
                            <div class="border-b border-gray-100 py-3">
                                <p class="text-[10px] text-gray-400">
                                    Jenis Kelamin
                                </p>
                                <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                    {{ $user->jenis_kelamin ?? 'Tidak Ingin Memberi tahukan' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Statistik Card --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-[#3D2418]">
                                        24
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Total Pesanan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-check text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-[#3D2418]">
                                        20
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Pesanan Selesai
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-heart text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-[#3D2418]">
                                        12
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Produk Wishlist
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat Card --}}
                    <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-[#3D2418]">
                                    Alamat Utama
                                </h2>
                                <div class="mt-3 flex gap-3">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100 text-orange-500">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <p class=" font-semibold text-[#3D2418]">
                                            Rino Amelia
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-gray-500">
                                            Jl. Merdeka No. 123, RT 02/RW 05, Desa Sukamaju, Kecamatan Banyuwangi, Kabupaten Banyuwangi, Jawa Timur.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <span class="rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-bold uppercase text-orange-600">
                                Utama
                            </span>
                        </div>
                        <div class="mt-4 flex justify-end border-t border-gray-100 pt-3">
                            <a href="#"
                            class="text-sm font-semibold text-orange-500 hover:text-orange-600">
                                Ubah Alamat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection