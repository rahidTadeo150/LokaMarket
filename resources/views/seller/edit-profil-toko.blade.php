@extends('layouts.seller')

@section('title', 'Edit Profil Toko - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#FFF9F2] px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-6xl">

        <div class="mb-7">

            <a href="{{ route('seller.editToko') }}"
                class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-[#8A7467] transition hover:text-[#E85D04]">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Kelola Toko
            </a>

            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                <div>

                    <span class="inline-flex items-center gap-2 rounded-full border border-orange-100 bg-white px-3 py-1.5 text-xs font-semibold text-[#E85D04]">
                        <i class="fa-solid fa-store"></i>
                        Pengaturan Toko
                    </span>

                    <p class="mt-3 text-2xl font-bold tracking-tight text-[#3B2115] sm:text-3xl">
                        Edit Profil Toko
                    </p>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#8A7467]">
                        Perbarui identitas dan informasi toko agar pelanggan lebih mudah mengenal usaha Anda.
                    </p>

                </div>

                <div class="flex items-center gap-2 rounded-2xl border border-orange-100 bg-white px-4 py-3 shadow-sm">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#E85D04]">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-[#3B2115]">Profil Toko</p>
                        <p class="mt-0.5 text-[11px] text-[#8A7467]">Kelola informasi bisnis Anda</p>
                    </div>
                </div>

            </div>

        </div>

        <x-alert-session/>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <div class="flex items-center gap-2 font-semibold">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Periksa kembali data yang Anda masukkan.
                </div>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.formEditToko.update') }}"
            id="form-edit-profil"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">

                <div class="space-y-6">

                    <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">
                        
                        <div class="border-b border-orange-50 px-5 py-5 sm:px-7">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-50 text-lg text-[#E85D04]">
                                    <i class="fa-solid fa-store"></i>
                                </div>
                                <div>
                                    <h2 class="font-bold text-[#3B2115]">Identitas Toko</h2>
                                    <p class="mt-1 text-xs text-[#8A7467]">Informasi utama yang dilihat pelanggan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5 p-5 sm:p-7">

                            <div>
                                
                                <label class="mb-3 block text-sm font-semibold text-[#3B2115]">
                                    Logo atau Foto Toko
                                </label>

                                <div class="flex flex-col gap-4 rounded-2xl border border-dashed border-orange-200 bg-[#FFFCF9] p-4 sm:flex-row sm:items-center">
                                    
                                    <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-orange-100 bg-orange-50">
                                        
                                        <img id="previewFotoToko"
                                            src="{{ $toko->foto_profil ? asset('storage/' . $toko->foto_profil) : '' }}"
                                            alt="Preview foto toko"
                                            class="{{ $toko->foto_profil ? 'block' : 'hidden' }} h-full w-full object-cover">

                                        <div id="placeholderFotoToko"
                                            class="{{ $toko->foto_profil ? 'hidden' : 'flex' }} h-full w-full flex-col items-center justify-center text-[#E85D04]">
                                            <i class="fa-solid fa-store text-2xl"></i>
                                            <span class="mt-1 text-[9px] font-semibold">Logo Toko</span>
                                        </div>

                                    </div>

                                    <div class="min-w-0 flex-1">
                                        
                                        <p class="text-sm font-semibold text-[#3B2115]">Gunakan foto terbaik untuk toko Anda</p>
                                        
                                        <p class="mt-1 text-xs leading-5 text-[#8A7467]">
                                            Format JPG, JPEG, atau PNG. Ukuran maksimal 2 MB.
                                        </p>

                                        <label for="foto_profil"
                                            class="mt-3 inline-flex cursor-pointer items-center gap-2 rounded-xl border border-orange-200 bg-white px-4 py-2.5 text-xs font-semibold text-[#E85D04] transition hover:bg-orange-50">
                                            <i class="fa-solid fa-upload"></i>
                                            Pilih Foto
                                        </label>

                                        <input type="file"
                                            id="foto_profil"
                                            name="foto_profil"
                                            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                            class="sr-only">

                                        <p id="namaFileFoto" class="mt-2 text-xs text-[#8A7467]">
                                            {{ $toko->foto_profil ? 'Foto toko saat ini digunakan.' : 'Belum ada foto baru dipilih.' }}
                                        </p>

                                        <p id="foto-profil-error" class="mt-2 hidden text-xs text-red-600"></p>

                                        @error('foto_profil')
                                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                        
                                    </div>

                                </div>

                            </div>

                            <div>

                                <label for="nama_toko" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                                    Nama Toko <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="nama_toko"
                                    name="nama_toko"
                                    value="{{ old('nama_toko', $toko->nama_toko) }}"
                                    required
                                    maxlength="100"
                                    placeholder="Contoh: Dapur Bu Siti"
                                    class="w-full rounded-xl border border-[#EAD8C8] bg-white px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B8A79B] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">

                                <p id="nama-toko-error" class="mt-2 hidden text-xs text-red-600"></p>

                            </div>

                            <div>

                                <label for="slug" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                                    URL Toko
                                </label>

                                <div class="flex overflow-hidden rounded-xl border border-[#EAD8C8] bg-gray-50">
                                    
                                    <span class="flex items-center border-r border-[#EAD8C8] bg-[#FFF9F4] px-3 text-xs text-[#8A7467] sm:px-4">
                                        /toko/
                                    </span>

                                    <input type="text"
                                        id="slug"
                                        value="{{ $toko->slug }}"
                                        disabled
                                        class="min-w-0 flex-1 cursor-not-allowed bg-gray-50 px-3 py-3 text-sm text-[#8A7467] opacity-80 outline-none sm:px-4"/>

                                </div>

                                <p class="mt-2 flex items-start gap-1.5 text-xs leading-5 text-[#A58C7D]">
                                    <i class="fa-solid fa-lock mt-0.5"></i>
                                    URL toko tidak dapat diubah untuk menjaga konsistensi tautan toko Anda.
                                </p>

                            </div>

                            <div>

                                <div class="mb-2 flex items-center justify-between gap-3">
                                    <label for="deskripsi" class="text-sm font-semibold text-[#3B2115]">
                                        Deskripsi Toko <span class="text-red-500">*</span>
                                    </label>
                                    <span id="jumlahDeskripsi" class="text-xs text-[#A58C7D]">0/500</span>
                                </div>

                                <textarea
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="5"
                                    maxlength="500"
                                    required
                                    placeholder="Ceritakan produk, keunggulan, dan layanan toko Anda..."
                                    class="w-full resize-y rounded-xl border border-[#EAD8C8] bg-white px-4 py-3 text-sm leading-6 text-[#3B2115] outline-none transition placeholder:text-[#B8A79B] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">{{ old('deskripsi', $toko->deskripsi) }}</textarea>

                                <p id="deskripsi-error" class="mt-2 hidden text-xs text-red-600"></p>

                            </div>
                        </div>

                    </section>

                    <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">
                        
                        <div class="border-b border-orange-50 px-5 py-5 sm:px-7">
                            
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-50 text-lg text-[#E85D04]">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <h2 class="font-bold text-[#3B2115]">Kontak dan Lokasi</h2>
                                    <p class="mt-1 text-xs text-[#8A7467]">Informasi agar pelanggan dapat menghubungi Anda.</p>
                                </div>
                            </div>

                        </div>

                        <div class="space-y-5 p-5 sm:p-7">

                            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4 sm:p-5">

                                <div class="mb-4 flex items-start justify-between gap-3">
                                    
                                    <div class="flex items-start gap-3">
                                        
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-orange-100 to-orange-50 text-lg text-[#E85D04]">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>

                                        <div>
                                            <p class="text-sm font-bold text-[#3B2115]">
                                                Nomor Telepon Toko
                                            </p>
                                            <p class="mt-1 text-xs leading-5 text-[#8A7467]">
                                                Nomor yang digunakan pelanggan untuk menghubungi toko Anda.
                                            </p>
                                        </div>

                                    </div>

                                    <span class="shrink-0 rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-[#C1440E]">
                                        Kontak
                                    </span>

                                </div>

                                <div id="teleponSaatIni"
                                    class="group flex items-center gap-3 rounded-xl border border-[#F1DCC8] bg-gradient-to-r from-[#FFF9F4] to-white p-3.5 transition duration-300 hover:border-orange-200">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-[#E85D04] shadow-sm ring-1 ring-orange-100">
                                        <i class="fa-solid fa-mobile-screen-button text-lg"></i>
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <p class="text-[10px] font-medium uppercase tracking-wider text-[#A58C7D]">
                                            Nomor saat ini
                                        </p>

                                        <p id="teksTeleponSaatIni"
                                            class="mt-1 break-all text-sm font-bold tracking-wide text-[#3B2115]">
                                            {{ $toko->no_telepon ?: 'Belum ada nomor telepon' }}
                                        </p>

                                    </div>

                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-50 text-green-600">
                                        <i class="fa-solid fa-check text-xs"></i>
                                    </div>

                                </div>

                                <button type="button"
                                        id="btnGantiTelepon"
                                        class="mt-3 flex w-full items-center justify-center gap-2 rounded-xl border border-orange-200 bg-white px-4 py-3 text-sm font-semibold text-[#E85D04] transition duration-200 hover:border-[#E85D04] hover:bg-orange-50 active:scale-[0.99]">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Ganti Nomor Telepon
                                    <i class="fa-solid fa-arrow-right ml-auto text-xs"></i>
                                </button>

                                <div id="formGantiTelepon"
                                    class="mt-4 hidden overflow-hidden rounded-xl border border-orange-100 bg-[#FFFCF9] p-4">

                                    <div class="mb-4 flex items-start gap-2.5">
                                        
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-orange-100 text-[#E85D04]">
                                            <i class="fa-solid fa-pen"></i>
                                        </div>

                                        <div>
                                            <p class="text-sm font-bold text-[#3B2115]">
                                                Perbarui Nomor Telepon
                                            </p>
                                            <p class="mt-1 text-xs leading-5 text-[#8A7467]">
                                                Masukkan nomor baru yang aktif dan dapat dihubungi.
                                            </p>
                                        </div>

                                    </div>

                                    <label for="no_telepon"
                                        class="mb-2 block text-xs font-semibold text-[#3B2115]">
                                        Nomor telepon baru
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="flex overflow-hidden rounded-xl border border-[#EAD8C8] bg-white transition focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-100">
                                        
                                        <div class="flex items-center gap-2 border-r border-[#EAD8C8] bg-[#FFF9F4] px-3 text-sm font-semibold text-[#72594B]">
                                            <i class="fa-solid fa-phone text-xs text-[#E85D04]"></i>
                                            +62
                                        </div>

                                        <input
                                            type="tel"
                                            id="no_telepon"
                                            name="no_telepon"
                                            value="{{ old('no_telepon', $toko->no_telepon) }}"
                                            maxlength="20"
                                            placeholder="81234567890"
                                            autocomplete="tel"
                                            class="min-w-0 flex-1 bg-transparent px-3 py-3 text-sm text-[#3B2115] outline-none placeholder:text-[#B8A79B]">
                                    
                                    </div>

                                    <p class="mt-2 flex items-start gap-1.5 text-[11px] leading-5 text-[#A58C7D]">
                                        <i class="fa-solid fa-circle-info mt-0.5"></i>
                                        <span>Gunakan nomor yang benar. Pastikan format nomor sesuai validasi aplikasi.</span>
                                    </p>

                                    <p id="no-telepon-error" class="mt-2 hidden text-xs text-red-600"></p>

                                    <div class="mt-4 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                        
                                        <button
                                            type="button"
                                            id="btnBatalGantiTelepon"
                                            class="rounded-xl border border-[#EAD8C8] bg-white px-4 py-2.5 text-xs font-semibold text-[#72594B] transition hover:bg-gray-50">
                                            Batal
                                        </button>

                                        <button
                                            type="button"
                                            id="btnSimpanTelepon"
                                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-linear-to-r from-[#F97316] to-[#E85D04] px-4 py-2.5 text-xs font-bold text-white shadow-sm shadow-orange-200 transition hover:shadow-md active:scale-[0.98]">
                                            <i class="fa-solid fa-check"></i>
                                            Gunakan Nomor Ini
                                        </button>

                                    </div>

                                </div>

                            </div>
                            
                            <x-dropdown-alamat :provinsi="$provinsi" :selectedProvinsi="$toko->provinsi_id" :selectedKota="$toko->kota_id" :selectedKecamatan="$toko->kecamatan_id"/>

                            <div>

                                <label for="alamat" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    id="alamat"
                                    name="alamat"
                                    rows="4"
                                    maxlength="500"
                                    required
                                    placeholder="Nama jalan, nomor rumah, desa/kelurahan, kecamatan, kota..."
                                    class="w-full resize-y rounded-xl border border-[#EAD8C8] px-4 py-3 text-sm leading-6 text-[#3B2115] outline-none transition placeholder:text-[#B8A79B] focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
                                >{{ old('alamat', $toko->alamat) }}</textarea>

                                <p id="alamat-error" class="mt-2 hidden text-xs text-red-600"></p>

                            </div>

                        </div>

                    </section>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('seller.editToko') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-[#EAD8C8] bg-white px-6 py-3 text-sm font-semibold text-[#72594B] transition hover:bg-orange-50">
                            Batal
                        </a>
                        <button type="submit"
                            id="submitBtn"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-linear-to-r from-[#F97316] to-[#E85D04] px-6 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200/60 transition hover:-translate-y-0.5 hover:shadow-orange-300/70">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>

                <aside class="space-y-5 lg:sticky lg:top-20 lg:self-start">

                    <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-[0_12px_35px_rgba(103,55,20,0.07)]">

                        <div class="relative overflow-hidden bg-linear-to-br from-[#FFF0DF] via-[#FFE5CB] to-[#FFD1A4] p-6">

                            <div class="pointer-events-none absolute -right-8 -top-10 h-36 w-36 rounded-full bg-white/30"></div>
                            <div class="pointer-events-none absolute right-5 top-24 h-16 w-16 rounded-full bg-orange-200/30"></div>

                            <div class="relative">

                                <div class="flex items-center justify-between gap-2">
                                    
                                    <span class="inline-flex items-center gap-2 rounded-full border border-white/70 bg-white/75 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-[#C1440E]">
                                        <i class="fa-solid fa-eye"></i>
                                        Preview Toko
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 rounded-full border border-green-200 bg-green-50 px-2.5 py-1.5 text-[10px] font-semibold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </span>
                                    
                                </div>

                                <div class="relative mt-6 flex h-20 w-20 items-center justify-center overflow-hidden rounded-2xl border-4 border-white bg-white text-3xl text-[#E85D04] shadow-lg">

                                    <img id="previewFotoSidebar"
                                        src="{{ $toko->foto_profil ? asset('storage/' . $toko->foto_profil) : '' }}"
                                        alt="Logo toko"
                                        class="{{ $toko->foto_profil ? 'block' : 'hidden' }} absolute h-full w-full object-cover">

                                    <i id="iconFotoSidebar"
                                        class="{{ $toko->foto_profil ? 'hidden' : 'block' }} fa-solid fa-store">
                                    </i>

                                </div>

                                <p id="previewNamaToko"
                                    class="mt-4 text-lg font-black text-[#3B2115]">
                                    {{ $toko->nama_toko }}
                                </p>

                                <p id="previewSlugToko"
                                    class="mt-1 break-all text-xs text-[#8A5A3C]">
                                    /toko/{{ $toko->slug }}
                                </p>

                                <div class="mt-4 flex flex-wrap gap-2">

                                    <span class="inline-flex items-center gap-1.5 rounded-lg border border-white/70 bg-white/70 px-2.5 py-1.5 text-[10px] font-semibold text-[#8A4A25]">
                                        <i class="fa-solid fa-store"></i>
                                        Toko Lokal
                                    </span>

                                    <span class="inline-flex items-center gap-1.5 rounded-lg border border-white/70 bg-white/70 px-2.5 py-1.5 text-[10px] font-semibold text-[#8A4A25]">
                                        <i class="fa-solid fa-shield-halved"></i>
                                        Profil Toko
                                    </span>

                                </div>

                            </div>

                        </div>

                        <div class="space-y-5 p-5">

                            <div>

                                <div class="mb-2 flex items-center gap-2">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-orange-50 text-xs text-[#E85D04]">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </span>
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-[#3B2115]">
                                        Tentang Toko
                                    </p>
                                </div>

                                <p id="previewDeskripsiToko"
                                    class="wrap-break-word whitespace-pre-line text-sm leading-6 text-[#72594B]">
                                    {{ $toko->deskripsi ?: 'Deskripsi toko akan ditampilkan di sini.' }}
                                </p>

                            </div>

                            <div class="border-t border-dashed border-[#F1DCC8]"></div>

                            <div>

                                <p class="mb-3 text-[10px] font-bold uppercase tracking-wider text-[#3B2115]">
                                    Informasi Kontak
                                </p>

                                <div class="space-y-3">

                                    <div class="flex items-start gap-3 rounded-xl bg-[#FFFCF9] p-3">

                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-sm text-[#E85D04]">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>

                                        <div class="min-w-0 flex-1">

                                            <p class="text-[10px] text-[#A58C7D]">
                                                Nomor Telepon
                                            </p>

                                            <p id="previewTeleponToko"
                                                class="mt-1 break-all text-xs font-semibold text-[#3B2115]">
                                                {{ $toko->no_telepon ?: 'Nomor telepon belum diisi' }}
                                            </p>

                                        </div>

                                    </div>

                                    <div class="flex items-start gap-3 rounded-xl bg-[#FFFCF9] p-3">
                                        
                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-sm text-[#E85D04]">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>

                                        <div class="min-w-0 flex-1">
                                            
                                            <p class="text-[10px] text-[#A58C7D]">
                                                Alamat Toko
                                            </p>

                                            <p
                                                id="previewAlamatToko"
                                                class="mt-1 wrap-break-word text-xs leading-5 text-[#3B2115]">
                                                {{ $toko->alamat ?: 'Alamat toko belum diisi' }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <p class="text-center text-[10px] leading-5 text-[#A58C7D]">
                                Informasi ini membantu pelanggan mengenal toko Anda.
                            </p>

                        </div>

                    </section>

                    <section class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

                        <div class="flex items-start gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#FFF0DF] text-[#E85D04]">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>

                            <div class="min-w-0">

                                <h3 class="text-sm font-bold text-[#3B2115]">
                                    Tips Profil Toko
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-[#8A7467]">
                                    Buat profil yang menarik agar pelanggan lebih mengenal usaha Anda.
                                </p>

                            </div>

                        </div>

                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start gap-2.5 text-xs leading-5 text-[#72594B]">
                                <i class="fa-solid fa-circle-check mt-0.5 text-green-600"></i>
                                Gunakan foto toko yang jelas dan menarik.
                            </li>
                            <li class="flex items-start gap-2.5 text-xs leading-5 text-[#72594B]">
                                <i class="fa-solid fa-circle-check mt-0.5 text-green-600"></i>
                                Tulis deskripsi yang informatif.
                            </li>
                            <li class="flex items-start gap-2.5 text-xs leading-5 text-[#72594B]">
                                <i class="fa-solid fa-circle-check mt-0.5 text-green-600"></i>
                                Pastikan nomor telepon dan alamat akurat.
                            </li>
                        </ul>

                    </section>

                </aside>

            </div>

        </form>

    </div>
    
</main>

@endsection