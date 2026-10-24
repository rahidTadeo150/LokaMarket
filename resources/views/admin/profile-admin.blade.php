@extends('layouts.admin')

@section('title', 'Profil Admin - LokaMarket')

@section('page-heading', 'Profil Admin')

@section('content')

<div class="min-h-screen bg-[#FFF9F4]">

    <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-8">

        <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <div class="mb-2 flex items-center gap-2">
                    <span class="text-[10px] font-bold uppercase tracking-[0.18em] text-orange-500">
                        Account
                    </span>
                    <span class="h-1 w-1 rounded-full bg-orange-300"></span>
                    <span class="text-[10px] text-[#A58E81]">
                        Administrator
                    </span>
                </div>

                <p class="text-2xl font-black tracking-tight text-[#3B2115] sm:text-3xl">
                    Profil Admin
                </p>

                <p class="mt-1.5 text-xs text-[#8D776A] sm:text-sm">
                    Kelola informasi akun, keamanan, dan aktivitas administrator.
                </p>

            </div>


            <div class="flex items-center gap-2">

                <span class="flex items-center gap-2 rounded-xl border border-green-100 bg-green-50 px-3 py-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                    <span class="text-[10px] font-bold text-green-600">
                        Akun Aktif
                    </span>
                </span>

            </div>

        </div>

        <section class="mb-6 overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-[0_8px_35px_rgba(59,33,21,0.05)]">

            <div class="h-2 bg-linear-to-r from-[#FF7A00] via-[#F56600] to-[#D9490B]"></div>

            <div class="p-5 sm:p-7">

                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                    <div class="flex items-center gap-4 sm:gap-5">

                        <div class="relative shrink-0">

                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-linear-to-br from-[#FF7A00] to-[#D9490B] text-2xl font-black text-white shadow-lg shadow-orange-500/15 sm:h-24 sm:w-24 sm:text-3xl">
                                A
                            </div>

                            <div class="absolute -bottom-1 -right-1 flex h-7 w-7 items-center justify-center rounded-lg border-[3px] border-white bg-green-500 text-white">
                                <i class="fa-solid fa-check text-[8px]"></i>
                            </div>

                        </div>

                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">
                                <p class="text-xl font-black tracking-tight text-[#3B2115] sm:text-2xl">
                                    Admin
                                </p>
                                <span class="rounded-full bg-orange-50 px-2.5 py-1 text-[9px] font-bold text-orange-600">
                                    Administrator
                                </span>

                            </div>

                            <p class="mt-1 text-xs text-[#8D776A]">
                                admin@lokamarket.test
                            </p>

                            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1.5">
                                <span class="flex items-center gap-1.5 text-[10px] text-[#8D776A]">
                                    <i class="fa-regular fa-calendar text-orange-500"></i>
                                    Bergabung September 2026
                                </span>
                                <span class="flex items-center gap-1.5 text-[10px] text-[#8D776A]">
                                    <i class="fa-solid fa-shield-halved text-orange-500"></i>
                                    Administrator
                                </span>
                            </div>

                        </div>

                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button"
                                class="inline-flex items-center gap-2 rounded-xl border border-orange-100 bg-white px-4 py-2.5 text-xs font-bold text-[#72594B] transition hover:border-orange-200 hover:bg-orange-50 hover:text-orange-600">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                            Edit Profil
                        </button>
                    </div>

                </div>

                <div class="mt-7 grid border-t border-orange-50 pt-6 sm:grid-cols-3">

                    <div class="flex items-center gap-3 border-b border-orange-50 pb-4 sm:border-b-0 sm:border-r sm:pb-0 sm:pr-5">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                            <i class="fa-regular fa-envelope text-xs"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                Email
                            </p>
                            <p class="mt-1 truncate text-xs font-bold text-[#3B2115]">
                                admin@lokamarket.test
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-3 border-b border-orange-50 py-4 sm:border-b-0 sm:border-r sm:px-5 sm:py-0">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </div>

                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                Nomor Telepon
                            </p>
                            <p class="mt-1 text-xs font-bold text-[#3B2115]">
                                +62 812-3456-7890
                            </p>
                        </div>

                    </div>


                    <div class="flex items-center gap-3 pt-4 sm:pl-5 sm:pt-0">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                            <i class="fa-solid fa-clock text-xs"></i>
                        </div>

                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                Login Terakhir
                            </p>
                            <p class="mt-1 text-xs font-bold text-[#3B2115]">
                                Hari ini, 10:24 WIB
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">

            <div class="space-y-6">

                <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-[0_8px_35px_rgba(59,33,21,0.04)]">

                    <div class="flex items-center justify-between border-b border-orange-50 px-5 py-5 sm:px-7">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                <i class="fa-regular fa-user text-xs"></i>
                            </div>

                            <div>
                                <p class="text-sm font-extrabold text-[#3B2115]">
                                    Informasi Akun
                                </p>
                                <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                    Informasi dasar akun administrator
                                </p>
                            </div>

                        </div>

                        <span class="hidden text-[9px] font-semibold text-[#A58E81] sm:block">
                            ACCOUNT INFORMATION
                        </span>

                    </div>

                    <div class="p-5 sm:p-7">

                        <div class="overflow-hidden rounded-2xl border border-orange-100">

                            <div class="grid sm:grid-cols-2">

                                <div class="border-b border-orange-100 p-4 sm:border-r">
                                    <p class="text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                        Username
                                    </p>
                                    <p class="mt-1.5 text-xs font-bold text-[#3B2115] sm:text-sm">
                                        admin
                                    </p>
                                </div>

                                <div class="border-b border-orange-100 p-4">

                                    <p class="text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                        Role
                                    </p>

                                    <div class="mt-1.5">
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-50 px-2.5 py-1 text-[9px] font-bold text-orange-600">
                                            <i class="fa-solid fa-shield-halved text-[8px]"></i>
                                            Administrator
                                        </span>
                                    </div>

                                </div>

                                <div class="border-b border-orange-100 p-4 sm:border-r">
                                    <p class="text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                        Email
                                    </p>
                                    <p class="mt-1.5 break-all text-xs font-bold text-[#3B2115] sm:text-sm">
                                        admin@lokamarket.test
                                    </p>
                                </div>

                                <div class="border-b border-orange-100 p-4">
                                    <p class="text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                        Nomor Telepon
                                    </p>
                                    <p class="mt-1.5 text-xs font-bold text-[#3B2115] sm:text-sm">
                                        +62 812-3456-7890
                                    </p>
                                </div>

                                <div class="p-4">
                                    <p class="text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                        Nama Lengkap
                                    </p>
                                    <p class="mt-1.5 text-xs font-bold text-[#3B2115] sm:text-sm">
                                        Administrator LokaMarket
                                    </p>
                                </div>

                                <div class="p-4">

                                    <p class="text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                        Status
                                    </p>

                                    <div class="mt-1.5 flex items-center gap-2">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        <span class="text-xs font-bold text-green-600 sm:text-sm">
                                            Aktif
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div>

            <aside class="space-y-5 lg:sticky lg:top-24">

                <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-[0_8px_35px_rgba(59,33,21,0.05)]">

                    <div class="border-b border-orange-50 px-5 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#3B2115] text-white">
                                <i class="fa-solid fa-shield-halved text-xs"></i>
                            </div>

                            <div>
                                <p class="text-sm font-extrabold text-[#3B2115]">
                                    Keamanan Akun
                                </p>
                                <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                    Lindungi akun administrator
                                </p>
                            </div>

                        </div>

                    </div>

                    <button type="button"
                            class="group flex w-full items-center gap-3 rounded-2xl p-3 text-left transition hover:bg-[#FFF9F4]">

                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500 transition group-hover:bg-white">
                            <i class="fa-solid fa-key text-xs"></i>
                        </span>

                        <span class="flex-1">
                            <span class="block text-xs font-bold text-[#3B2115]">
                                Ubah Password
                            </span>
                            <span class="mt-0.5 block text-[9px] text-[#A58E81]">
                                Perbarui password akun
                            </span>
                        </span>

                        <i class="fa-solid fa-chevron-right text-[8px] text-[#C7B5AA]"></i>

                    </button>

                </section>



                <section class="rounded-3xl border border-green-100 bg-green-50/60 p-5">

                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-green-500 shadow-sm">
                            <i class="fa-solid fa-check text-xs"></i>
                        </div>

                        <div>
                            <p class="text-xs font-extrabold text-green-700">
                                Keamanan Baik
                            </p>
                            <p class="mt-1 text-[10px] leading-5 text-green-600/80">
                                Tidak ada aktivitas keamanan yang
                                memerlukan perhatian.
                            </p>
                        </div>

                    </div>

                </section>

                <section class="rounded-3xl border border-red-100 bg-white p-5">

                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-500">
                            <i class="fa-solid fa-right-from-bracket text-xs"></i>
                        </div>

                        <div>
                            <p class="text-xs font-extrabold text-[#3B2115]">
                                Keluar dari Akun
                            </p>
                            <p class="mt-1 text-[10px] leading-5 text-[#A58E81]">
                                Akhiri sesi administrator pada perangkat ini.
                            </p>
                        </div>

                    </div>

                    <form action="{{ route('admin.logout') }}"
                        id="logoutForm"
                        method="POST"
                        class="mt-4">

                        @csrf

                        <button type="button"
                                id="openLogoutModal"
                                class="w-full rounded-xl border border-red-100 bg-red-50 px-4 py-2.5 text-xs font-bold text-red-600 transition hover:bg-red-100">
                            Keluar dari Akun
                        </button>

                    </form>

                    
                </section>

            </aside>

        </div>

    </div>

</div>

@endsection