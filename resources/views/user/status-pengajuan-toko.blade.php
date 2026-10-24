@extends('layouts.customer')

@section('title', 'Status Pengajuan Toko - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F2]">

    <section class="relative overflow-hidden bg-linear-to-r from-orange-500 via-orange-500 to-[#D9490B]">

        <div class="pointer-events-none absolute -right-20 -top-24 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -left-16 h-64 w-64 rounded-full bg-orange-300/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-10 sm:px-6 lg:px-8">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm">
                    <i class="fa-solid fa-store text-2xl text-white"></i>
                </div>

                <div>
                    <p class="text-sm font-semibold text-orange-100">
                        LokaMarket
                    </p>
                    <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                        Status Pengajuan Toko
                    </h1>
                    <p class="mt-1 text-sm text-orange-100">
                        Pantau proses pengajuan toko Anda di sini.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <div class="mx-auto max-w-5xl px-5 py-8 sm:px-6 lg:px-8">

        <x-alert-session/>

        @if (!$pengajuan)

        <div class="rounded-3xl border border-[#F1DCC8] bg-white p-8 text-center shadow-sm sm:p-12">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-orange-50">
                <i class="fa-solid fa-store text-3xl text-orange-500"></i>
            </div>
            <h2 class="mt-6 text-xl font-extrabold text-[#3B2115]">
                Belum Ada Pengajuan Toko
            </h2>
            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#72594B]">
                Anda belum memiliki pengajuan untuk membuka toko.
                Lengkapi informasi toko Anda untuk mulai berjualan di LokaMarket.
            </p>
            <a href="{{ route('cust.formDaftarToko') }}"
            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">
                <i class="fa-solid fa-store"></i>
                Buka Toko
            </a>
        </div>

        @else

        @if ($pengajuan->status === 'pending')

        <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

            <div class="bg-orange-50 p-6 sm:p-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                            <i class="fa-solid fa-clock text-xl"></i>
                        </div>

                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-orange-600">
                                Status Pengajuan
                            </p>
                            <P class="mt-1 text-xl font-extrabold text-[#3B2115]">
                                Menunggu Pemeriksaan
                            </P>
                        </div>

                    </div>

                    <div class="sm:text-right">
                        <p class="text-[10px] font-medium uppercase tracking-wide text-[#A58E81]">
                            Diajukan pada
                        </p>
                        <p class="mt-1 text-sm font-bold text-[#3B2115]">
                            {{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}
                            WIB
                        </p>
                    </div>

                </div>

            </div>

            <div class="p-6 sm:p-8">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>

                    <div>
                        <P class="text-sm font-extrabold text-orange-700">
                            Pengajuan sedang diperiksa
                        </P>
                        <p class="mt-1.5 text-xs leading-5 text-[#72594B]">
                            Data toko Anda sedang diperiksa oleh admin.
                            Mohon menunggu hingga proses verifikasi selesai.
                        </p>
                    </div>

                </div>

            </div>

        </section>

        @elseif ($pengajuan->status === 'approved')

        <section class="overflow-hidden rounded-3xl border border-green-100 bg-white shadow-sm">

            <div class="bg-green-50 p-6 sm:p-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-green-100 text-green-600">
                            <i class="fa-solid fa-circle-check text-xl"></i>
                        </div>

                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-green-600">
                                Status Pengajuan
                            </p>
                            <P class="mt-1 text-xl font-extrabold text-[#3B2115]">
                                Disetujui
                            </P>
                        </div>

                    </div>

                    <div class="sm:text-right">
                        <p class="text-[10px] font-medium uppercase tracking-wide text-[#A58E81]">
                            Diajukan pada
                        </p>
                        <p class="mt-1 text-sm font-bold text-[#3B2115]">
                            {{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}
                            WIB
                        </p>
                    </div>

                </div>

            </div>

            <div class="p-6 sm:p-8">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-100 text-green-600">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div>
                        <P class="text-sm font-extrabold text-green-700">
                            Pengajuan toko berhasil disetujui
                        </P>
                        <p class="mt-1.5 text-xs leading-5 text-[#72594B]">
                            Selamat! Data toko Anda telah diperiksa dan disetujui
                            oleh admin. Toko Anda sekarang dapat digunakan untuk
                            mulai berjualan di LokaMarket.
                        </p>
                    </div>

                </div>

            </div>

        </section>

        @elseif ($pengajuan->status === 'rejected')

        <section class="overflow-hidden rounded-3xl border border-red-100 bg-white shadow-sm">

            <div class="bg-red-50 p-6 sm:p-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                            <i class="fa-solid fa-circle-xmark text-xl"></i>
                        </div>

                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-red-600">
                                Status Pengajuan
                            </p>

                            <h2 class="mt-1 text-xl font-extrabold text-[#3B2115]">
                                Ditolak
                            </h2>
                        </div>

                    </div>

                    <div class="sm:text-right">

                        <p class="text-[10px] font-medium uppercase tracking-wide text-[#A58E81]">
                            Diajukan pada
                        </p>

                        <p class="mt-1 text-sm font-bold text-[#3B2115]">
                            {{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}
                            WIB
                        </p>

                    </div>

                </div>

            </div>

            <div class="p-6 sm:p-8">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <i class="fa-solid fa-xmark"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <P class="text-sm font-extrabold text-red-700">
                            Pengajuan toko belum dapat disetujui
                        </P>
                        <p class="mt-1.5 text-xs leading-5 text-[#72594B]">
                            Pengajuan toko Anda belum dapat disetujui
                            berdasarkan hasil pemeriksaan admin.
                        </p>

                        <div class="mt-4 rounded-2xl border border-red-100 bg-red-50 p-4">
                            <p class="text-[10px] font-extrabold uppercase tracking-wider text-red-600">
                                Alasan Penolakan
                            </p>
                            <p class="mt-2 text-xs leading-5 text-red-700">
                                {{ $pengajuan->alasan_reject }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        @endif

        <section class="mt-6 rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

            <div class="border-b border-[#F1DCC8] px-6 py-5 sm:px-8">
                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-store"></i>
                    </div>

                    <div>
                        <p class="text-base font-extrabold text-[#3B2115]">
                            Informasi Toko
                        </p>
                        <p class="mt-0.5 text-xs text-[#8D776A]">
                            Data yang Anda ajukan
                        </p>
                    </div>

                </div>
            </div>

            <div class="grid items-center gap-10 p-6 sm:p-8 lg:grid-cols-[320px_1fr]">

                <div>
                    <div class="flex aspect-square w-full items-center justify-center overflow-hidden rounded-3xl bg-orange-50">
                        @if ($pengajuan->foto_profil)
                        <img src="{{ asset('storage/' . $pengajuan->foto_profil) }}"
                            alt="{{ $pengajuan->nama_toko }}"
                            class="h-full w-full object-cover">
                        @else
                        <i class="fa-solid fa-store text-4xl text-orange-400"></i>
                        @endif
                    </div>
                </div>

                <div>

                    <p class="text-xl font-extrabold text-[#3B2115]">
                        {{ $pengajuan->nama_toko }}
                    </p>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">

                        <div class="rounded-2xl bg-[#FFF9F2] p-4">
                            <div class="flex items-center gap-2 text-orange-500">
                                <i class="fa-solid fa-phone text-sm"></i>
                                <span class="text-xs font-bold">
                                    Nomor Telepon
                                </span>
                            </div>
                            <p class="mt-2 text-sm font-semibold text-[#3B2115]">
                                {{ $pengajuan->no_telepon }}
                            </p>
                        </div>


                        <div class="rounded-2xl bg-[#FFF9F2] p-4">
                            <div class="flex items-center gap-2 text-orange-500">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                                <span class="text-xs font-bold">
                                    Alamat Email
                                </span>
                            </div>

                            <p class="mt-2 text-sm font-semibold text-[#3B2115]">
                                {{ $pengajuan->user->email }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">

                        <div class="rounded-2xl bg-[#FFF9F2] p-4">
                            <div class="flex items-center gap-2 text-orange-500">
                                <i class="fa-solid fa-map-location-dot text-sm"></i>
                                <span class="text-xs font-bold">
                                    Alamat Toko
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-[#3B2115]">
                                {{ Str::title($pengajuan->kecamatan->nama ?? '-') }},
                                {{ Str::title($pengajuan->kota->nama ?? '-') }},
                                {{ Str::title($pengajuan->provinsi->nama ?? '-') }}
                            </p>
                        </div>


                        <div class="rounded-2xl bg-[#FFF9F2] p-4">
                            <div class="flex items-center gap-2 text-orange-500">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                                <span class="text-xs font-bold">
                                    Kode Pos
                                </span>
                            </div>

                            <p class="mt-2 text-sm text-[#3B2115]">
                                {{ $pengajuan->kode_pos }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-4 rounded-2xl bg-[#FFF9F2] p-4">
                        <div class="flex items-center gap-2 text-orange-500">
                            <i class="fa-solid fa-note-sticky text-sm"></i>
                            <span class="text-xs font-bold">
                                Detail Alamat Lengkap
                            </span>
                        </div>
                        <p class="mt-2 text-sm leading-6 text-[#3B2115]">
                            {{ $pengajuan->alamat_lengkap }}
                        </p>
                    </div>

                </div>

            </div>

        </section>


        {{-- TIMELINE --}}
        <section class="mt-6 rounded-3xl border border-[#F1DCC8] bg-white p-6 shadow-sm sm:p-8">

            <div class="mb-8">

                <h2 class="text-base font-extrabold text-[#3B2115]">
                    Proses Pengajuan
                </h2>

                <p class="mt-1 text-xs text-[#8D776A]">
                    Perkembangan pengajuan toko Anda
                </p>

            </div>


            <div class="relative">

                {{-- LINE --}}
                <div class="absolute left-5 top-2 bottom-2 w-px bg-[#F1DCC8]"></div>


                {{-- STEP 1 --}}
                <div class="relative flex gap-4 pb-8">

                    <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600 ring-8 ring-white">
                        <i class="fa-solid fa-check text-sm"></i>
                    </div>

                    <div class="pt-1">

                        <p class="text-sm font-bold text-[#3B2115]">
                            Pengajuan Dikirim
                        </p>

                        <p class="mt-1 text-xs leading-5 text-[#8D776A]">
                            Data toko berhasil dikirim ke LokaMarket.
                        </p>

                    </div>

                </div>


                {{-- STEP 2 --}}
                <div class="relative flex gap-4 pb-8">

                    <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600 ring-8 ring-white">
                        <i class="fa-solid fa-check text-sm"></i>
                    </div>

                    <div class="pt-1">

                        <p class="text-sm font-bold text-[#3B2115]">
                            Email Terverifikasi
                        </p>

                        <p class="mt-1 text-xs leading-5 text-[#8D776A]">
                            Alamat email berhasil diverifikasi.
                        </p>

                    </div>

                </div>


                {{-- STEP 3 --}}
                <div class="relative flex gap-4">

                    @if ($pengajuan->status === 'approved')

                        <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600 ring-8 ring-white">
                            <i class="fa-solid fa-check text-sm"></i>
                        </div>

                        <div class="pt-1">

                            <p class="text-sm font-bold text-green-700">
                                Pengajuan Disetujui
                            </p>

                            <p class="mt-1 text-xs leading-5 text-green-600">
                                Toko Anda telah disetujui dan siap digunakan.
                            </p>

                        </div>

                    @elseif ($pengajuan->status === 'rejected')

                        <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600 ring-8 ring-white">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </div>

                        <div class="pt-1">

                            <p class="text-sm font-bold text-red-700">
                                Pengajuan Ditolak
                            </p>

                            <p class="mt-1 text-xs leading-5 text-red-600">
                                Silakan periksa alasan penolakan pada informasi di atas.
                            </p>

                        </div>

                    @else

                        <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-100 text-orange-600 ring-8 ring-white">
                            <i class="fa-solid fa-clock text-sm"></i>
                        </div>

                        <div class="pt-1">
                            <p class="text-sm font-bold text-orange-700">
                                Menunggu Pemeriksaan Admin
                            </p>
                            <p class="mt-1 text-xs leading-5 text-orange-600">
                                Admin sedang memeriksa data dan dokumen pengajuan Anda.
                            </p>
                        </div>

                    @endif

                </div>

            </div>

        </section>


        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">

            <a href="{{ route('cust.landingPage') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-5 py-3 text-sm font-bold text-[#72594B] transition hover:border-orange-300 hover:text-orange-500">
                <i class="fa-solid fa-house text-xs"></i>
                Kembali ke Beranda
            </a>

            @if ($pengajuan->status === 'approved')

            <a href="{{ route('seller.dashboard') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">
                <i class="fa-solid fa-store text-xs"></i>
                Buka Dashboard Toko
            </a>

            @elseif ($pengajuan->status === 'rejected')

                @if ($bisaAjukanKembali)
                <a href="{{ route('cust.pengajuanUlang') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">
                    <i class="fa-solid fa-rotate-right text-xs"></i>
                    Ajukan Kembali
                </a>
                @else
                <div class="w-full rounded-2xl border border-orange-100 bg-orange-50 p-4 sm:max-w-md">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-500">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-extrabold text-orange-700">
                                Belum dapat mengajukan kembali hingga
                            </p>
                            @if ($cooldownSelesai)
                            <p id="cooldown"
                            data-end="{{ $cooldownSelesai->timestamp }}"
                            class="mt-1 text-sm font-extrabold tracking-wide text-orange-700">
                                Menghitung waktu...
                            </p>
                            @endif
                        </div>

                    </div>
                    
                </div>
                @endif

            @endif

            @endif

        </div>

    </div>

</main>

@endsection
