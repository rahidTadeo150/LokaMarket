@extends('layouts.auth-customer')

@section('title', 'Login Admin - LokaMarket')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-[#FFF9F2] px-4 pb-8 pt-24 sm:px-6 sm:pt-28">
            
        <div class="pointer-events-none fixed -left-32 -top-32 h-80 w-80 rounded-full bg-orange-200/30 blur-3xl"></div>
        <div class="pointer-events-none fixed -bottom-32 -right-32 h-80 w-80 rounded-full bg-orange-300/20 blur-3xl"></div>

        <div class="md:min-w-2xl relative z-10 w-full max-w-md overflow-hidden rounded-3xl border border-orange-100/80 bg-white shadow-xl shadow-orange-900/10">

            <div class="h-1.5 w-full bg-linear-to-r from-orange-400 via-orange-500 to-[#C1440E]"></div>

            <div class="px-6 py-8 sm:px-9 sm:py-9">
                <div class="mb-7 flex flex-col items-center text-center">
                    
                    <img src="{{ asset('storage/logo-lokamarket-horizontal.png') }}" 
                        alt="LokaMarket"
                        class="w-full md:w-2/3">

                    <div class="mt-2 inline-flex items-center gap-2 rounded-full border border-orange-100 bg-orange-50 px-3 py-1.5">
                        <i class="fa-solid fa-shield-halved text-xs text-orange-600"></i>
                        <span class="text-[10px] font-bold uppercase tracking-[0.16em] text-orange-700">
                            Admin Portal
                        </span>
                    </div>

                </div>

                <div class="mb-6 text-center">
                    <p class="text-2xl font-extrabold tracking-tight text-[#3B2115]">
                        Selamat Datang!
                    </p>
                    <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-[#8B7465]">
                        Masuk ke panel administrator untuk mengelola LokaMarket.
                    </p>
                </div>

                <x-alert-session/>

                <form action="{{ route('admin.loginAdmin') }}" 
                    method="POST" 
                    class="space-y-5">
                    
                    @csrf

                    <div>

                        <label for="email" class="mb-2 block text-sm font-bold text-[#533729]">
                            Email Administrator
                        </label>

                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#B49A89]">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                placeholder="admin@lokamarket.com"
                                autocomplete="username"
                                required
                                autofocus
                                class="w-full rounded-xl border border-[#F0DFD2] bg-[#FFFCF9] py-3 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#BDA99B] focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100 @error('email') border-red-400 @enderror">
                        </div>

                    </div>

                    <div>

                        <label for="password" class="mb-2 block text-sm font-bold text-[#533729]">
                            Password
                        </label>

                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#B49A89]">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password"
                                name="password"
                                id="password"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                                class="w-full rounded-xl border border-[#F0DFD2] bg-[#FFFCF9] py-3 pl-11 pr-12 text-sm text-[#3B2115] outline-none transition placeholder:text-[#BDA99B] focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100 @error('password') border-red-400 @enderror">
                            <button type="button"
                                    onclick="toggleAdminPassword()"
                                    id="togglePasswordButton"
                                    aria-label="Tampilkan password"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-[#A58B79] transition hover:text-orange-600">
                                <i class="fa-regular fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>

                    </div>

                    <button type="submit"
                            class="group flex w-full items-center justify-center gap-3 rounded-xl bg-linear-to-r from-orange-500 to-[#E65B0B] px-5 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-orange-500/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-orange-500/30 focus:outline-none focus:ring-4 focus:ring-orange-200 active:translate-y-0">
                        <span>Masuk ke Dashboard</span>
                        <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                    </button>

                </form>

                <div class="mt-6 rounded-xl border border-orange-100 bg-orange-50/70 p-3.5">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-shield-halved mt-0.5 text-sm text-orange-600"></i>
                        <p class="text-xs leading-5 text-[#8B6A54]">
                            Halaman ini khusus administrator. Gunakan akun admin yang memiliki hak akses valid.
                        </p>
                    </div>
                </div>

                <p class="mt-6 text-center text-[11px] text-[#A58B79]">
                    © {{ date('Y') }} LokaMarket. All rights reserved.
                </p>

            </div>
        </div>
    </div>

@endsection
