@extends('layouts.admin')

@section('title', 'Detail Pengajuan Toko - LokaMarket')

@section('content')

<div class="min-h-screen bg-[#FFF9F4]">

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <div class="mb-7">

            <button type="button"
                    id="backButton"
                    class="group mb-5 inline-flex items-center gap-2 text-xs font-semibold text-[#8D776A] transition hover:text-orange-600">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg border border-orange-100 bg-white shadow-sm transition group-hover:border-orange-200 group-hover:bg-orange-50">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                </span>
                Kembali ke Pengajuan
            </button>

            <x-alert-session/>

            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

                <div>

                    <div class="mb-2 flex items-center gap-2">
                        <span class="text-[10px] font-bold uppercase tracking-[0.18em] text-orange-500">
                            Admin
                        </span>
                        <span class="h-1 w-1 rounded-full bg-orange-300"></span>
                        <span class="text-[10px] font-medium text-[#A58E81]">
                            Pengajuan Toko
                        </span>
                    </div>

                    <p class="text-2xl font-black tracking-tight text-[#3B2115] sm:text-3xl">
                        Detail Pengajuan
                    </p>

                    <p class="mt-1.5 max-w-xl text-xs leading-5 text-[#8D776A] sm:text-sm">
                        Periksa informasi toko, data pemilik, dan dokumen identitas
                        sebelum memberikan keputusan.
                    </p>

                </div>

                <div class="w-fit">

                    @if ($toko->status === 'pending')
                    <div class="flex items-center gap-3 rounded-2xl border border-yellow-200/70 bg-yellow-50 px-4 py-3">

                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-yellow-100">
                            <span class="h-2.5 w-2.5 animate-pulse rounded-full bg-yellow-500"></span>
                        </div>

                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-wider text-yellow-600">
                                Status
                            </p>
                            <p class="mt-0.5 text-xs font-extrabold text-yellow-700">
                                Pending
                            </p>
                        </div>

                    </div>

                    @elseif ($toko->status === 'approved')

                    <div class="flex items-center gap-3 rounded-2xl border border-green-200/70 bg-green-50 px-4 py-3">

                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-green-100">
                            <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                        </div>

                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-wider text-green-600">
                                Status
                            </p>
                            <p class="mt-0.5 text-xs font-extrabold text-green-700">
                                Approved
                            </p>
                        </div>

                    </div>

                    @elseif ($toko->status === 'rejected')

                    <div class="flex items-center gap-3 rounded-2xl border border-red-200/70 bg-red-50 px-4 py-3">

                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-red-100">
                            <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                        </div>

                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-wider text-red-600">
                                Status
                            </p>
                            <p class="mt-0.5 text-xs font-extrabold text-red-700">
                                Rejected
                            </p>
                        </div>

                    </div>
                    
                    @endif

                </div>

            </div>

        </div>

        <div class="grid items-start gap-6 xl:grid-cols-[minmax(0,1fr)_350px]">

            <div class="space-y-6">

                <section class="relative overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-[0_10px_40px_rgba(93,54,27,0.05)]">

                    <div class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-orange-100/60 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-24 -left-20 h-48 w-48 rounded-full bg-amber-100/40 blur-3xl"></div>
                    <div class="relative p-5 sm:p-7">

                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                            <div class="relative shrink-0">

                                @if ($toko->foto_profil)
                                <div class="h-24 w-24 overflow-hidden rounded-[26px] shadow-lg shadow-orange-500/20 border-2 border-orange-300 sm:h-28 sm:w-28">
                                    <img src="{{ asset('storage/' . $toko->foto_profil) }}"
                                        alt="{{ $toko->nama_toko }}"
                                        class="h-full w-full object-cover">
                                </div>
                                @else
                                <div class="flex h-24 w-24 items-center justify-center rounded-[26px] bg-linear-to-br from-orange-500 to-[#D9490B] text-white shadow-lg shadow-orange-500/20 sm:h-28 sm:w-28">
                                    <i class="fa-solid fa-store text-4xl sm:text-5xl"></i>
                                </div>
                                @endif

                                <span class="absolute -bottom-2 -right-2 flex h-8 w-8 items-center justify-center rounded-xl border-4 border-white bg-green-500 text-white shadow-sm">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </span>

                            </div>

                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">
                                    <p class="text-2xl font-black tracking-tight text-[#3B2115]">
                                        {{ $toko->nama_toko }}
                                    </p>
                                </div>

                                <p class="mt-1 text-xs text-[#A58E81]">
                                    {{ '@' . $toko->slug }}
                                </p>

                                <div class="mt-4 flex flex-wrap gap-x-5 gap-y-2">

                                    <div class="flex items-center gap-2 text-xs text-[#72594B]">
                                        <i class="fa-solid fa-location-dot text-orange-500"></i>
                                        <span>
                                            {{ Str::title($toko->kota->nama ?? '-') }},
                                            {{ Str::title($toko->provinsi->nama ?? '-') }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2 text-xs text-[#72594B]">
                                        <i class="fa-solid fa-calendar text-orange-500"></i>
                                        <span>
                                            Diajukan
                                            {{ $toko->created_at
                                                ? $toko->created_at->translatedFormat('d M Y')
                                                : '-' }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="rounded-3xl border border-orange-100 bg-white shadow-[0_10px_40px_rgba(93,54,27,0.04)]">

                    <div class="flex items-center gap-3 border-b border-orange-50 px-5 py-5 sm:px-7">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                            <i class="fa-solid fa-store text-sm"></i>
                        </div>

                        <div>
                            <p class="text-sm font-extrabold text-[#3B2115]">
                                Informasi Toko
                            </p>
                            <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                Detail usaha yang diajukan
                            </p>
                        </div>
                    </div>


                    <div class="space-y-6 p-5 sm:p-7">

                        <div>
                            <p class="mb-2 text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                Tentang Toko
                            </p>
                            <div class="min-h-30 rounded-2xl bg-[#FFF9F4] p-4">
                                <p class="text-xs leading-6 text-[#72594B]">
                                    {{ $toko->deskripsi ?? 'Deskripsi toko belum tersedia.' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <p class="mb-2 text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                Alamat Toko
                            </p>
                            <div class="flex gap-3 rounded-2xl border border-orange-50 p-4">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-location-dot text-xs"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs mb-1 font-bold text-[#3B2115]">
                                        Lokasi Toko
                                    </p>
                                    <p class="text-xs text-[#3B2115]">
                                        {{ Str::title($toko->kecamatan->nama ?? '-') }},
                                        {{ Str::title($toko->kota->nama ?? '-') }},
                                        {{ Str::title($toko->provinsi->nama ?? '-') }},
                                        {{ $toko->kode_pos }}
                                    </p>
                                    <p class="text-xs text-[#3B2115]">
                                        {{ $toko->alamat_lengkap }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="mb-2 text-[9px] font-bold uppercase tracking-[0.15em] text-[#A58E81]">
                                Kontak Toko
                            </p>
                            <div class="flex gap-3 rounded-2xl border border-orange-50 p-4">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-phone text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-[#3B2115]">
                                        Nomor Telepon
                                    </p>
                                    <p class="mt-1 text-xs leading-5 text-[#8D776A]">
                                        @if ($toko->no_telepon)
                                        {{ $toko->no_telepon }}
                                        @else
                                        -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </section>

                <section class="rounded-3xl border border-orange-100 bg-white shadow-[0_10px_40px_rgba(93,54,27,0.04)]">

                    <div class="flex items-center gap-3 px-5 py-5 sm:px-7">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#C1440E]">
                            <i class="fa-solid fa-user text-sm"></i>
                        </div>

                        <div>
                            <p class="text-sm font-extrabold text-[#3B2115]">
                                Informasi Pemilik
                            </p>
                            <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                Data akun pemilik toko
                            </p>
                        </div>

                    </div>

                    <div class="p-5 sm:p-7">

                        <div class="grid overflow-hidden rounded-2xl border border-orange-50 sm:grid-cols-2">

                            <div class="border-b border-orange-50 p-4 sm:border-r">

                                <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                    Nama Pemilik
                                </p>

                                <p class="mt-1.5 text-xs font-bold text-[#3B2115]">
                                    {{ $toko->user->nama }}
                                </p>

                            </div>

                            <div class="border-b border-orange-50 p-4">
                                <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                    Username
                                </p>
                                <p class="mt-1.5 text-xs font-bold text-[#3B2115]">
                                    {{ $toko->user->username }}
                                </p>
                            </div>

                            <div class="border-b border-orange-50 p-4 sm:border-r">
                                <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                    Email
                                </p>
                                <p class="mt-1.5 break-all text-xs font-bold text-[#3B2115]">
                                    {{ $toko->user->email }}
                                </p>
                            </div>

                            <div class="border-b border-orange-50 p-4">
                                <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                    Nomor Telepon
                                </p>
                                <p class="mt-1.5 text-xs font-bold text-[#3B2115]">
                                    @if ($toko->user?->no_telp)
                                    {{ $toko->user->no_telp }}
                                    @else
                                    -
                                    @endif
                                </p>
                            </div>

                            <div class="border-b border-orange-50 p-4 sm:border-b-0 sm:border-r">
                                <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                    Jenis Kelamin
                                </p>
                                <p class="mt-1.5 text-xs font-bold text-[#3B2115]">
                                    @if ($toko->user?->jenis_kelamin)
                                    {{ ucfirst($toko->user->jenis_kelamin) }}
                                    @else
                                    -
                                    @endif
                                </p>
                            </div>

                            <div class="p-4">
                                <p class="text-[9px] font-bold uppercase tracking-wider text-[#A58E81]">
                                    Tanggal Lahir
                                </p>
                                <p class="mt-1.5 text-xs font-bold text-[#3B2115]">
                                    @if ($toko->user?->tanggal_lahir)
                                    {{ \Carbon\Carbon::parse($toko->user->tanggal_lahir)->translatedFormat('d F Y') }}
                                    @else
                                    -
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>

                </section>

                <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-[0_10px_40px_rgba(93,54,27,0.04)]">

                    <div class="flex items-center justify-between border-b border-orange-50 px-5 py-5 sm:px-7">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-id-card text-sm"></i>
                            </div>

                            <div>
                                <p class="text-sm font-extrabold text-[#3B2115]">
                                    Dokumen Identitas
                                </p>
                                <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                    Kartu Tanda Penduduk pemilik
                                </p>
                            </div>

                        </div>


                        @if ($toko->foto_ktp)

                        <span class="flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-[9px] font-bold text-green-600">
                            <i class="fa-solid fa-check"></i>
                            Tersedia
                        </span>

                        @else

                        <span class="flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-[9px] font-bold text-red-600">
                            <i class="fa-solid fa-xmark"></i>
                            Tidak Tersedia
                        </span>

                        @endif

                    </div>

                    <div class="p-5 sm:p-7">

                        @if ($toko->foto_ktp)

                        <div class="group relative overflow-hidden rounded-2xl bg-[#F5EBDD] p-3 sm:p-5">

                            <div class="relative mx-auto aspect-[1.586/1] max-w-2xl overflow-hidden rounded-xl bg-white shadow-xl">
                                <img src="{{ asset('storage/' . $toko->foto_ktp) }}"
                                    alt="KTP {{ $toko->user->username ?? 'Pemilik Toko' }}"
                                    class="h-full w-full object-contain">
                            </div>

                            <div class="absolute inset-0 flex items-center justify-center bg-[#3B2115]/0 opacity-0 transition duration-300 group-hover:bg-[#3B2115]/20 group-hover:opacity-100">
                                <a href="{{ asset('storage/' . $toko->foto_ktp) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-xs font-bold text-[#3B2115] shadow-xl">
                                    <i class="fa-solid fa-expand text-orange-500"></i>
                                    Lihat Dokumen
                                </a>
                            </div>

                        </div>

                        <div class="mt-4 flex items-center justify-between gap-4">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-file-image text-xs"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-xs font-bold text-[#3B2115]">
                                        {{ basename($toko->foto_ktp) }}
                                    </p>
                                    <p class="mt-0.5 text-[9px] text-[#A58E81]">
                                        Dokumen KTP
                                    </p>
                                </div>

                            </div>


                            <a href="{{ asset('storage/' . $toko->foto_ktp) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="shrink-0 rounded-xl border border-orange-100 px-3 py-2 text-[10px] font-bold text-orange-600 transition hover:bg-orange-50">
                                Buka
                            </a>

                        </div>

                        @else

                        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-red-200 bg-red-50 px-5 py-12 text-center">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-red-400 shadow-sm">
                                <i class="fa-solid fa-file-circle-xmark text-xl"></i>
                            </div>
                            <p class="mt-4 text-xs font-bold text-red-700">
                                Dokumen KTP belum tersedia
                            </p>
                            <p class="mt-1 max-w-sm text-[10px] leading-5 text-red-500">
                                Pemilik toko belum mengunggah dokumen identitas pada pengajuan ini.
                            </p>
                        </div>

                        @endif

                    </div>

                </section>

                @if ($toko->status === 'rejected' && $toko->alasan_penolakan)

                <section class="rounded-3xl border border-red-100 bg-red-50 shadow-sm">
                    <div class="p-5 sm:p-6">
                        <div class="flex gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-red-500 shadow-sm">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>

                            <div>
                                <p class="text-sm font-extrabold text-red-800">
                                    Alasan Penolakan
                                </p>
                                <p class="mt-2 text-xs leading-6 text-red-700">
                                    {{ $toko->alasan_penolakan }}
                                </p>
                            </div>

                        </div>
                    </div>
                </section>

                @endif

            </div>

            <aside class="space-y-5 xl:sticky xl:top-6">

                <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-[0_15px_50px_rgba(93,54,27,0.08)]">

                    <div class="bg-linear-to-br from-[#FF7A00] to-[#D9490B] p-6 text-white">

                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-[9px] font-bold uppercase tracking-[0.16em] text-orange-100">
                                    Review Pengajuan
                                </p>
                                <p class="mt-1 text-lg font-black">
                                    Ambil Keputusan
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 backdrop-blur">
                                <i class="fa-solid fa-gavel"></i>
                            </div>
                            
                        </div>

                    </div>


                    <div class="space-y-3 p-5">

                        @if ($toko->status === 'pending')

                            <form id="approveForm"
                                action="{{ route('admin.approvePengajuan', $toko->id) }}"
                                method="POST">
                                @csrf

                                <button type="button"
                                        data-confirm
                                        data-form="approveForm"
                                        data-theme="green"
                                        data-title="Setujui Pengajuan?"
                                        data-message="Apakah kamu yakin ingin menyetujui pengajuan toko ini?"
                                        data-confirm-text="Ya, Approve"
                                        data-icon="fa-solid fa-circle-check"
                                        class="group flex w-full items-center gap-3 rounded-2xl bg-green-500 p-4 text-left text-white shadow-lg shadow-green-500/15 transition hover:-translate-y-0.5 hover:bg-green-600">

                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15">
                                        <i class="fa-solid fa-check"></i>
                                    </span>

                                    <span class="flex-1">
                                        <span class="block text-xs font-extrabold">
                                            Setujui Pengajuan
                                        </span>
                                        <span class="mt-0.5 block text-[9px] text-green-100">
                                            Aktifkan toko pemilik
                                        </span>
                                    </span>

                                    <i class="fa-solid fa-arrow-right text-[10px] opacity-60 transition group-hover:translate-x-1"></i>

                                </button>

                            </form>

                            <div id="rejectContainer">

                                <button type="button"
                                        id="showRejectButton"
                                        class="group flex w-full items-center gap-3 rounded-2xl border border-red-300 bg-red-100 p-4 text-left text-red-600 transition hover:-translate-y-0.5 hover:bg-red-200">

                                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/50">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>

                                    <span class="flex-1">
                                        <span class="block text-xs font-extrabold">
                                            Tolak Pengajuan
                                        </span>
                                        <span class="mt-0.5 block text-[9px] text-red-400">
                                            Sertakan alasan penolakan
                                        </span>
                                    </span>

                                    <i class="fa-solid fa-arrow-right text-[10px] opacity-50 transition group-hover:translate-x-1"></i>

                                </button>

                                <form id="rejectForm"
                                    action="{{ route('admin.rejectPengajuan', $toko->id) }}"
                                    method="POST"
                                    class="hidden space-y-3">

                                    @csrf

                                    <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

                                        <div class="flex items-start gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-red-500 shadow-sm">
                                                <i class="fa-solid fa-circle-exclamation text-sm"></i>
                                            </div>

                                            <div>
                                                <p class="text-xs font-extrabold text-red-700">
                                                    Alasan Penolakan
                                                </p>
                                                <p class="mt-1 text-[9px] leading-4 text-red-500">
                                                    Jelaskan alasan mengapa pengajuan toko ini ditolak.
                                                </p>
                                            </div>

                                        </div>

                                    </div>

                                    <div>

                                        <label for="alasan_penolakan"
                                            class="mb-2 block text-[10px] font-bold text-[#72594B]">
                                            Alasan Penolakan
                                        </label>

                                        <textarea id="alasan_penolakan"
                                                name="alasan_penolakan"
                                                rows="4"
                                                minlength="10"
                                                maxlength="500"
                                                required
                                                placeholder="Contoh: Dokumen KTP tidak sesuai dengan data pemilik toko..."
                                                class="w-full resize-none rounded-2xl border border-red-200 bg-white px-4 py-3 text-xs leading-5 text-[#3B2115] outline-none transition placeholder:text-[#BDA99C] focus:border-red-400 focus:ring-2 focus:ring-red-100"
                                        >{{ old('alasan_penolakan') }}</textarea>

                                        @error('alasan_penolakan')
                                            <p class="mt-1 text-[10px] font-medium text-red-500">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                        <div class="mt-1 flex items-center justify-between">
                                            <p class="text-[9px] text-[#A58E81]">
                                                Minimal 10 karakter
                                            </p>
                                            <p id="rejectCharCount"
                                                class="text-[9px] text-[#A58E81]">
                                                0 / 500
                                            </p>
                                        </div>

                                    </div>

                                    <div class="flex gap-2">

                                        <button type="button"
                                                id="cancelRejectButton"
                                                class="flex-1 rounded-xl border border-orange-100 bg-white px-3 py-2.5 text-[10px] font-bold text-[#8D776A] transition hover:bg-orange-50">
                                            Batal
                                        </button>

                                        <button type="button"
                                                data-confirm
                                                data-form="rejectForm"
                                                data-theme="red"
                                                data-title="Reject Pengajuan?"
                                                data-message="Apakah kamu yakin ingin menolak pengajuan toko ini?"
                                                data-confirm-text="Ya, Reject"
                                                data-icon="fa-solid fa-file-circle-xmark"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm shadow-red-100 transition-all duration-200 hover:border-red-600 hover:bg-red-700 hover:shadow-md hover:shadow-red-200 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2">
                                            <i class="fa-solid fa-xmark mr-1"></i>
                                            Konfirmasi Penolakan
                                        </button>

                                    </div>

                                </form>

                            </div>

                        @elseif ($toko->status === 'approved')

                            <div class="rounded-2xl border border-green-200 bg-green-50 p-4">

                                <div class="flex gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-green-500 shadow-sm">
                                        <i class="fa-solid fa-check"></i>
                                    </div>

                                    <div>
                                        <p class="text-xs font-extrabold text-green-700">
                                            Pengajuan Disetujui
                                        </p>
                                        <p class="mt-1 text-[9px] leading-4 text-green-600">
                                            Pengajuan toko ini sudah disetujui dan akun pemilik telah diaktifkan.
                                        </p>
                                    </div>

                                </div>

                            </div>

                        @elseif ($toko->status === 'rejected')

                            <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

                                <div class="flex gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-red-500 shadow-sm">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>

                                    <div>
                                        <p class="text-xs font-extrabold text-red-700">
                                            Pengajuan Ditolak
                                        </p>
                                        <p class="mt-1 text-[9px] leading-4 text-red-600">
                                            Pengajuan toko ini sudah diproses dan ditolak.
                                        </p>
                                    </div>

                                </div>

                            </div>

                        @endif

                        <div class="flex items-start gap-2 border-t border-orange-50 pt-4">
                            <i class="fa-solid fa-shield-halved mt-0.5 text-[10px] text-orange-400"></i>
                            <p class="text-[9px] leading-4 text-[#A58E81]">
                                Pastikan seluruh informasi dan dokumen telah
                                diperiksa sebelum mengambil keputusan.
                            </p>
                        </div>

                    </div>

                </section>

                <section class="rounded-3xl border border-orange-100 bg-[#FFF9F4] p-5">

                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-orange-500 shadow-sm">
                            <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                        </div>

                        <div>
                            <p class="text-xs font-extrabold text-[#3B2115]">
                                Riwayat Pengajuan
                            </p>
                            <p class="mt-1 text-[10px] leading-5 text-[#8D776A]">
                                Pengajuan dibuat pada
                                <span class="font-bold text-[#3B2115]">
                                    {{ $toko->created_at ? $toko->created_at->translatedFormat('d F Y') : '-' }}
                                </span>
                                pukul
                                <span class="font-bold text-[#3B2115]">
                                    {{ $toko->created_at ? $toko->created_at->format('H:i') : '-' }}
                                    WIB
                                </span>.
                            </p>
                        </div>

                    </div>

                </section>

            </aside>

        </div>

    </div>

</div>

<x-custom-alert-confirmation/>

@endsection