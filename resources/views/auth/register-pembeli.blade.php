@extends('layouts.auth-customer')

@section('title', 'Masuk - LokaMarket')

@section('content')
    <main class="px-10 md:px-20 py-28">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <!-- Banner Kiri -->
            <section class="relative hidden overflow-hidden rounded-[22px] bg-[#FFE5C5] px-10 py-10 lg:col-span-5 lg:block lg:h-full">
                <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-[#FFD98D] opacity-70 blur-2xl"></div>
                <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="relative h-12 w-auto">
                <div class="relative mt-9">
                    <h1 class="text-[27px] font-extrabold leading-[1.12] text-[#3B2115]">
                        Selamat Datang<br>
                        Ke Platform Produk UMKM<br>
                        LokaMarket
                    </h1>
                    <p class="mt-4 text-xs leading-5 text-[#72594B]">
                        Masuk untuk melanjutkan belanja produk UMKM lokal favoritmu dan pantau pesananmu.
                    </p>
                    <ul class="mt-5 space-y-3 text-xs text-[#4E382C]">
                        <li class="flex items-center gap-2.5"><span class="flex h-fit w-fit p-1 items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Ribuan produk UMKM lokal pilihan</li>
                        <li class="flex items-center gap-2.5"><span class="flex h-fit w-fit p-1 items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Transaksi aman &amp; terpercaya</li>
                        <li class="flex items-center gap-2.5"><span class="flex h-fit w-fit p-1 items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Dukung ekonomi warga sekitarmu</li>
                    </ul>
                </div>
            </section>

            <!-- Form Register -->
            <div class="lg:col-span-7 rounded-3xl border border-slate-300 bg-white p-8 shadow-xl md:p-12">
                <div class="mb-6">
                    <h3 class="text-2xl md:text-3xl font-bold text-slate-900">Buat Akun Baru</h3>
                    <p class="text-xs text-slate-500 mt-1">Isi data dirimu untuk mulai bergabung.</p>
                </div>
                <form action="/register" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="pembeli">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-regular fa-user"></i></span>
                                <input type="text" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        placeholder="Nama kamu" required
                                        class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">No. Telepon</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-solid fa-mobile-screen"></i></span>
                                <input type="tel" 
                                        name="phone" 
                                        value="{{ old('phone') }}" 
                                        placeholder="08xx-xxxx-xxxx" required
                                        class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1.5">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-regular fa-envelope"></i></span>
                            <input type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="nama@email.com" required
                                    class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">Kata Sandi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Buat kata sandi" 
                                        required
                                        class="w-full pl-10 pr-10 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                                <button type="button" onclick="toggleVisibility('password', 'eye1')" class="absolute inset-y-0 right-0 pr-4 text-slate-400"><i id="eye1" class="fa-regular fa-eye"></i></button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">Konfirmasi Sandi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        placeholder="Ulangi kata sandi" 
                                        required
                                        class="w-full pl-10 pr-10 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                                <button type="button" 
                                        onclick="toggleVisibility('password_confirmation', 'eye2')" 
                                        class="absolute inset-y-0 right-0 pr-4 text-slate-400"><i id="eye2" class="fa-regular fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" 
                                id="terms" 
                                name="terms" 
                                required 
                                class="w-4 h-4 text-orange-600 rounded border-slate-300 accent-orange-600">
                        <label for="terms" class="text-xs text-slate-600">Saya menyetujui <a href="#" class="text-[#D34E0E] font-bold hover:underline">Syarat & Ketentuan</a> serta Kebijakan Privasi</label>
                    </div>
                    <button type="submit" 
                            class="w-full py-3 bg-[#D34E0E] hover:bg-[#b8430a] text-white font-bold rounded-full transition text-sm shadow-md mt-2">Daftar Sekarang</button>
                </form>
                <div class="relative flex py-4 items-center mt-2">
                    <div class="grow border-t border-slate-200"></div>
                    <span class="shrink mx-4 text-xs text-slate-400">atau daftar dengan</span>
                    <div class="grow border-t border-slate-200"></div>
                </div>
                <button type="button" class="w-full py-2.5 border border-slate-200 rounded-full flex items-center justify-center gap-2 text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-brands fa-google text-red-500"></i> Google</button>
                <div class="mt-6 text-center">
                    <p class="text-xs text-slate-500">Sudah punya akun? <a href="{{ route('cust.login') }}"  class="text-[#D34E0E] font-bold hover:underline">Masuk di sini</a></p>
                </div>
            </div>

        </div>
    </main>
@endsection