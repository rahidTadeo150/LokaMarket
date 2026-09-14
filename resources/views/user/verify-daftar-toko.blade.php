@extends('layouts.customer')

@section('title', 'Verifikasi Email - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F2] px-5 py-10 sm:px-6 lg:px-8">

    <div class="mx-auto flex min-h-[calc(100vh-140px)] max-w-3xl items-center justify-center">

        <section class="relative w-full overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-[0_20px_60px_rgba(107,55,20,0.08)]">

            <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-200/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-orange-100/50 blur-3xl"></div>

            <div class="relative px-6 py-10 text-center sm:px-12 sm:py-14">

                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-3xl bg-orange-50">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 shadow-lg shadow-orange-500/20">
                        <i class="fa-solid fa-envelope text-2xl text-white"></i>
                    </div>
                </div>

                <span class="mb-3 inline-flex items-center gap-2 rounded-full bg-orange-50 px-4 py-2 text-xs font-bold text-orange-600">
                    <i class="fa-solid fa-store"></i>
                    Pengajuan Buka Toko
                </span>
                <h1 class="text-2xl font-extrabold tracking-tight text-[#3B2115] sm:text-3xl">
                    Verifikasi Email Anda
                </h1>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-[#72594B] sm:text-base">
                    Kami telah mengirimkan email verifikasi ke alamat email yang Anda gunakan.
                    Silakan periksa inbox untuk melanjutkan proses pengajuan toko.
                </p>

                <div class="mx-auto mt-8 max-w-lg rounded-2xl border border-orange-100 bg-orange-50/60 p-4 sm:p-5">
                    <div class="flex items-center gap-4 text-left">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white shadow-sm">
                            <i class="fa-solid fa-at text-lg text-orange-500"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-medium text-[#8D776A]">
                                Email tujuan
                            </p>
                            <p class="mt-1 truncate text-sm font-bold text-[#3B2115] sm:text-base">
                                {{ $email }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="mx-auto mt-8 max-w-lg text-left">

                    <p class="mb-4 text-sm font-bold text-[#3B2115]">
                        Selanjutnya:
                    </p>

                    <div class="space-y-4">

                        <div class="flex gap-4">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100 text-xs font-extrabold text-orange-600">
                                1
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Buka email dari LokaMarket
                                </p>
                                <p class="mt-1 text-xs leading-5 text-[#8D776A]">
                                    Periksa inbox atau folder spam jika email belum terlihat.
                                </p>
                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100 text-xs font-extrabold text-orange-600">
                                2
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Klik tombol "Verifikasi Email"
                                </p>
                                <p class="mt-1 text-xs leading-5 text-[#8D776A]">
                                    Gunakan tombol verifikasi yang tersedia di dalam email.
                                </p>
                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100 text-xs font-extrabold text-orange-600">
                                3
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Tunggu pemeriksaan admin
                                </p>
                                <p class="mt-1 text-xs leading-5 text-[#8D776A]">
                                    Setelah email berhasil diverifikasi, pengajuan toko akan
                                    diperiksa oleh admin LokaMarket.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="mx-auto mt-8 flex max-w-lg items-start gap-3 rounded-2xl border border-amber-100 bg-amber-50 p-4 text-left">

                    <i class="fa-solid fa-clock mt-0.5 text-amber-500"></i>

                    <div>

                        <p class="text-xs font-bold text-amber-800">
                            Perhatikan
                        </p>
                        <p class="mt-1 text-xs leading-5 text-amber-700">
                            Link verifikasi hanya berlaku selama
                            <strong>30 menit</strong>.
                            Jika link sudah kedaluwarsa, Anda perlu meminta
                            email verifikasi baru.
                        </p>

                    </div>
                </div>

                <a href="{{ route('cust.landingPage') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-5 py-3 text-sm font-bold text-[#72594B] transition hover:border-orange-200 hover:bg-orange-50">
                    <i class="fa-solid fa-house"></i>
                    Kembali ke Beranda
                </a>

                <div class="mt-8 border-t border-[#F5E8DC] pt-6">

                    <p class="text-xs text-[#8D776A]">
                        Belum menerima email?
                    </p>
                    <p class="mt-1 text-xs text-[#8D776A]">
                        Pastikan alamat email sudah benar dan periksa folder
                        <span class="font-bold text-[#72594B]">Spam</span> atau
                        <span class="font-bold text-[#72594B]">Promosi</span>.
                    </p>

                </div>

            </div>

        </section>

    </div>

</main>

@endsection