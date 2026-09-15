@extends('layouts.customer')

@section('title', 'Status Pengajuan Toko - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F2]">

{{-- HEADER --}}
<section class="relative overflow-hidden bg-linear-to-r from-orange-500 via-orange-500 to-[#D9490B]">

    {{-- Decorative --}}
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

    {{-- ALERT --}}
    @if (session('success'))
        <div
            class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">
                <i class="fa-solid fa-check"></i>
            </div>

            <div>
                <p class="text-sm font-bold text-green-700">
                    Berhasil
                </p>

                <p class="mt-1 text-sm text-green-600">
                    {{ session('success') }}
                </p>
            </div>

        </div>
    @endif


    {{-- JIKA BELUM ADA PENGAJUAN --}}
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

            <a
                href="{{ route('cust.formDaftarToko') }}"
                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">
                <i class="fa-solid fa-store"></i>
                Buka Toko
            </a>

        </div>

    @else

        @php
            $status = $pengajuan->status;

            $statusConfig = match ($status) {
                'approved' => [
                    'label' => 'Disetujui',
                    'icon' => 'fa-circle-check',
                    'bg' => 'bg-green-50',
                    'iconBg' => 'bg-green-100',
                    'text' => 'text-green-600',
                    'border' => 'border-green-200',
                ],
                'rejected' => [
                    'label' => 'Ditolak',
                    'icon' => 'fa-circle-xmark',
                    'bg' => 'bg-red-50',
                    'iconBg' => 'bg-red-100',
                    'text' => 'text-red-600',
                    'border' => 'border-red-200',
                ],
                default => [
                    'label' => 'Menunggu Pemeriksaan',
                    'icon' => 'fa-clock',
                    'bg' => 'bg-orange-50',
                    'iconBg' => 'bg-orange-100',
                    'text' => 'text-orange-600',
                    'border' => 'border-orange-200',
                ],
            };
        @endphp


        {{-- STATUS UTAMA --}}
        <section
            class="overflow-hidden rounded-3xl border {{ $statusConfig['border'] }} {{ $statusConfig['bg'] }} shadow-sm">

            <div class="p-6 sm:p-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl {{ $statusConfig['iconBg'] }} {{ $statusConfig['text'] }}">
                            <i class="fa-solid {{ $statusConfig['icon'] }} text-2xl"></i>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider {{ $statusConfig['text'] }}">
                                Status Pengajuan
                            </p>

                            <h2 class="mt-1 text-xl font-extrabold text-[#3B2115]">
                                {{ $statusConfig['label'] }}
                            </h2>
                        </div>

                    </div>

                    <div class="text-left sm:text-right">
                        <p class="text-xs text-[#8D776A]">
                            Diajukan pada
                        </p>

                        <p class="mt-1 text-sm font-bold text-[#3B2115]">
                            {{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                </div>


                {{-- PESAN STATUS --}}
                <div class="mt-6 rounded-2xl border border-white/80 bg-white/70 p-4">

                    @if ($status === 'approved')

                        <p class="text-sm font-semibold text-green-700">
                            🎉 Selamat! Pengajuan toko Anda telah disetujui.
                        </p>

                        <p class="mt-1 text-xs leading-5 text-green-600">
                            Toko Anda sudah dapat digunakan untuk mulai berjualan di LokaMarket.
                        </p>

                    @elseif ($status === 'rejected')

                        <p class="text-sm font-semibold text-red-700">
                            Pengajuan toko Anda belum dapat disetujui.
                        </p>

                        @if ($pengajuan->alasan_penolakan)
                            <p class="mt-2 text-xs leading-5 text-red-600">
                                <span class="font-bold">Alasan:</span>
                                {{ $pengajuan->alasan_penolakan }}
                            </p>
                        @endif

                    @else

                        <p class="text-sm font-semibold text-orange-700">
                            Pengajuan Anda sedang diperiksa oleh admin.
                        </p>

                        <p class="mt-1 text-xs leading-5 text-orange-600">
                            Mohon tunggu. Kami akan memproses pengajuan Anda setelah data diperiksa.
                        </p>

                    @endif

                </div>

            </div>

        </section>


        {{-- INFORMASI TOKO --}}
        <section class="mt-6 rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

            <div class="border-b border-[#F1DCC8] px-6 py-5 sm:px-8">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        <i class="fa-solid fa-store"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-extrabold text-[#3B2115]">
                            Informasi Toko
                        </h2>

                        <p class="mt-0.5 text-xs text-[#8D776A]">
                            Data yang Anda ajukan
                        </p>
                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[180px_1fr]">

                {{-- FOTO TOKO --}}
                <div>

                    <div class="flex aspect-square w-full items-center justify-center overflow-hidden rounded-3xl bg-orange-50">

                        @if ($pengajuan->foto_profil)

                            <img
                                src="{{ asset('storage/' . $pengajuan->foto_profil) }}"
                                alt="{{ $pengajuan->nama_toko }}"
                                class="h-full w-full object-cover">

                        @else

                            <i class="fa-solid fa-store text-4xl text-orange-400"></i>

                        @endif

                    </div>

                </div>


                {{-- DETAIL --}}
                <div>

                    <h3 class="text-xl font-extrabold text-[#3B2115]">
                        {{ $pengajuan->nama_toko }}
                    </h3>

                    @if ($pengajuan->deskripsi)
                        <p class="mt-2 text-sm leading-6 text-[#72594B]">
                            {{ $pengajuan->deskripsi }}
                        </p>
                    @endif


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
                                    Kode Pos
                                </span>
                            </div>

                            <p class="mt-2 text-sm font-semibold text-[#3B2115]">
                                {{ $pengajuan->kode_pos }}
                            </p>
                        </div>

                    </div>


                    <div class="mt-4 rounded-2xl bg-[#FFF9F2] p-4">

                        <div class="flex items-center gap-2 text-orange-500">
                            <i class="fa-solid fa-map-location-dot text-sm"></i>

                            <span class="text-xs font-bold">
                                Alamat Toko
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

                    @if ($status === 'approved')

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

                    @elseif ($status === 'rejected')

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


        {{-- ACTION --}}
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('cust.landingPage') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-5 py-3 text-sm font-bold text-[#72594B] transition hover:border-orange-300 hover:text-orange-500">

                <i class="fa-solid fa-house text-xs"></i>
                Kembali ke Beranda

            </a>


            @if ($status === 'approved')

                <a
                    href="{{ route('seller.dashboard') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">

                    <i class="fa-solid fa-store text-xs"></i>
                    Buka Dashboard Toko

                </a>

            @elseif ($status === 'rejected')

                <a
                    href="{{ route('cust.formDaftarToko') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-orange-600">

                    <i class="fa-solid fa-rotate-right text-xs"></i>
                    Ajukan Kembali

                </a>

            @endif

        </div>

    @endif

</div>

</main>

@endsection
