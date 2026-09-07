@extends('layouts.auth-customer')

@section('title', 'Masuk - LokaMarket')

@section('content')
    <main class="mx-auto grid items-center gap-6 px-10 py-28 lg:grid-cols-[1fr_1fr] lg:gap-10 lg:px-20 lg:py-28">
        <section class="relative hidden overflow-hidden rounded-[22px] bg-[#FFE5C5] px-10 py-10 lg:block lg:h-full">
            <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-[#FFD98D] opacity-70 blur-2xl"></div>
            <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="relative h-12 w-auto">
            <div class="relative mt-9">
                <h1 class="text-[27px] font-extrabold leading-[1.12] text-[#3B2115]">
                    Selamat Datang<br>
                    Kembali di<br>
                    LokaMarket
                </h1>
                <p class="mt-4 text-xs leading-5 text-[#72594B]">
                    Masuk untuk melanjutkan belanja produk UMKM lokal favoritmu dan pantau pesananmu.
                </p>
                <ul class="mt-5 space-y-3 text-xs text-[#4E382C]">
                    <li class="flex items-center gap-2.5"><span class="flex h-4.5 w-4.5 items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Ribuan produk UMKM lokal pilihan</li>
                    <li class="flex items-center gap-2.5"><span class="flex h-4.5 w-4.5 items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Transaksi aman &amp; terpercaya</li>
                    <li class="flex items-center gap-2.5"><span class="flex h-4.5 w-4.5 items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Dukung ekonomi warga sekitarmu</li>
                </ul>
            </div>
        </section>

        {{-- Form Login --}}
        <section class="mx-auto w-full rounded-[18px] border border-slate-300 shadow-xl bg-white px-4 py-6 sm:rounded-[22px] sm:px-10 sm:py-9 lg:h-full lg:px-11">
            <div class="mb-10">
                <h2 class="text-2xl font-extrabold text-[#3B2115] sm:text-[25px]">Masuk ke Akun</h2>
                <p class="mt-0.5 text-xs text-[#72594B]">Senang bertemu lagi! Masukkan detail akunmu.</p>
            </div>
            @if (session('success'))
            <x-alert-success-relative></x-alert-success-relative>
            @endif
            @if (session('error'))
            <x-alert-error-relative></x-alert-error-relative>
            @endif
            <form action="{{ route('cust.loginCustomer') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label for="email" class="mb-3 block text-xs font-bold text-[#5A4032]">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-800 text-sm">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input id="email" 
                                name="email" 
                                type="email" 
                                autocomplete="email" 
                                placeholder="nama@email.com" 
                                class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500 focus-within:ring-2 focus-within:ring-[#FFD1AD]">
                    </div>
                </div>
                <div>
                    <label for="password" class="mb-1 block text-xs font-bold text-[#5A4032]">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-800 text-sm">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input id="password" 
                                name="password" 
                                type="password" 
                                autocomplete="current-password" 
                                placeholder="Masukkan kata sandi" 
                                class="w-full rounded-full border border-slate-300 py-2.5 pl-10 pr-10 text-xs text-[#3B2115] outline-none placeholder:text-[#A58C7D] focus:border-orange-500 focus:ring-2 focus:ring-[#FFD1AD] md:text-sm">
                        <button id="password-toggle" 
                                type="button" 
                                aria-label="Tampilkan kata sandi" 
                                onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-[#967C6C] transition hover:text-[#C1440E]">
                                <i class="fa-solid fa-eye text-slate-800"></i>
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-x-3 gap-y-2 pt-0.5 text-[10px]">
                    <label class="flex items-center gap-2 text-[#72594B]"><input type="checkbox" name="remember" class="h-3.5 w-3.5 accent-[#FF7900]">Ingat saya</label>
                    <a href="#" class="font-bold text-[#C1440E] hover:text-[#9E350B]">Lupa kata sandi?</a>
                </div>
                <button type="submit" class="h-10 w-full rounded-full bg-[#E95309] text-xs font-bold text-white shadow-sm transition hover:bg-[#C1440E] hover:shadow-md">Masuk</button>
            </form>
            <div class="my-5 flex items-center gap-3 text-xs text-[#A58C7D]">
                <span class="h-px flex-1 bg-[#F1DCC8]"></span>
                atau masuk dengan email
                <span class="h-px flex-1 bg-[#F1DCC8]"></span>
            </div>
            <button type="button" 
                    class="mt-3 py-3 md:py-5 flex w-full items-center justify-center gap-3 rounded-full border border-[#D34E0E] text-sm font-bold text-[#3B2115] transition hover:bg-[#FFF9F4] hover:-translate-y-0.5 sm:h-9">
                <i class="fa-brands fa-google text-xl text-[#D9490B]"></i>Google
            </button>
            <p class="mt-8 text-center text-[10px] text-[#72594B] sm:mt-16">
                Belum punya akun?
                <a href="{{ route('cust.register') }}" class="font-bold text-[#C1440E] hover:text-[#9E350B]">
                    Daftar sekarang
                </a>
            </p>
        </section>
    </main>
@endsection