@extends('layouts.customer')

@section('title', 'Buka Toko - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F2]">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

        <section class="relative overflow-hidden">

            <div class="relative mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
                <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-5 py-6 text-white shadow-lg shadow-orange-200/50 md:rounded-3xl sm:px-7 sm:py-7">

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-12 -left-8 h-28 w-28 rounded-full bg-orange-300/20"></div>
                    <div class="absolute right-16 top-8 h-20 w-20 rounded-full bg-white/10 blur-2xl"></div>

                    <div class="relative flex items-center justify-between gap-4">

                        <div class="flex min-w-0 items-center gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 shadow-inner ring-1 ring-white/20 backdrop-blur-sm">
                                <i class="fa-solid fa-store text-xl text-white"></i>
                            </div>

                            <div class="min-w-0">
                                <h1 class="text-xl font-bold tracking-tight sm:text-2xl">
                                    Buka Toko
                                </h1>
                                <p class="mt-1 text-sm text-orange-100">
                                    Lengkapi informasi untuk mulai berjualan
                                </p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </section>


        <section class="mb-8 rounded-3xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <div id="stepCircle1"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-500 text-sm font-bold text-white shadow-lg shadow-orange-200 transition-all duration-300">
                        <span id="stepNumber1">1</span>
                    </div>

                    <div class="hidden sm:block">

                        <p id="stepSmall1"
                        class="text-xs font-bold text-orange-500 transition-colors duration-300">
                            LANGKAH 01
                        </p>
                        <p id="stepLabel1"
                        class="text-sm font-bold text-[#3B2115] transition-colors duration-300">
                            Informasi Toko
                        </p>

                    </div>
                </div>

                <div id="stepLine1" class="mx-3 h-1 flex-1 rounded-full bg-orange-100 transition-all duration-500"></div>

                <div class="flex items-center gap-3">

                    <div id="stepCircle2"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border-2 border-orange-200 bg-orange-50 text-sm font-bold text-orange-400 transition-all duration-300">
                        <span id="stepNumber2">2</span>
                    </div>

                    <div class="hidden sm:block">

                        <p id="stepSmall2"
                        class="text-xs font-bold text-[#A89588] transition-colors duration-300">
                            LANGKAH 02
                        </p>
                        <p id="stepLabel2"
                        class="text-sm font-bold text-[#A89588] transition-colors duration-300">
                            Lokasi & Kontak
                        </p>

                    </div>

                </div>

                <div id="stepLine2" class="mx-3 h-1 flex-1 rounded-full bg-orange-100 transition-all duration-500"></div>

                <div class="flex items-center gap-3">

                    <div id="stepCircle3"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border-2 border-orange-200 bg-orange-50 text-sm font-bold text-orange-400 transition-all duration-300">
                        <span id="stepNumber3">3</span>
                    </div>

                    <div class="hidden sm:block">

                        <p id="stepSmall3"
                        class="text-xs font-bold text-[#A89588] transition-colors duration-300">
                            LANGKAH 03
                        </p>
                        <p id="stepLabel3"
                        class="text-sm font-bold text-[#A89588] transition-colors duration-300">
                            Identitas Diri
                        </p>

                    </div>

                </div>

            </div>

        </section>

        @if (session('success'))
            <div id="success-alert"
                class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="text-sm font-bold text-green-700">
                        Berhasil
                    </p>

                    <p class="mt-0.5 text-xs text-green-600">
                        {{ session('success') }}
                    </p>
                </div>

                <button type="button"
                    onclick="document.getElementById('success-alert').remove()"
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-green-500 transition hover:bg-green-100 hover:text-green-700">

                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div id="error-alert"
                class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">

                    <i class="fa-solid fa-circle-exclamation text-sm"></i>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="text-sm font-bold text-red-700">
                        Terjadi Kesalahan
                    </p>

                    <p class="mt-0.5 text-xs text-red-600">
                        {{ session('error') }}
                    </p>
                </div>

                <button type="button"
                    onclick="document.getElementById('error-alert').remove()"
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-red-500 transition hover:bg-red-100 hover:text-red-700">

                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        @endif

        <section>
            <form action="{{ route('cust.formDaftarToko.register') }}"
                method="POST"
                enctype="multipart/form-data"
                id="tokoForm">
    
                @csrf
    
                <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
    
                    <div>
                        <div id="form-step-1" class="form-step">
    
                            <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">
    
                                <div class="border-b border-orange-50 px-6 py-5 sm:px-8">
                                    <div class="flex items-center gap-4">
    
                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-orange-100">
                                            <i class="fa-solid fa-store text-lg text-orange-500"></i>
                                        </div>
    
                                        <div>
    
                                            <h2 class="font-black text-[#3B2115]">
                                                Informasi Toko
                                            </h2>
                                            <p class="mt-0.5 text-xs text-[#8D776A]">
                                                Ceritakan sedikit tentang tokomu.
                                            </p>
    
                                        </div>
    
                                    </div>
                                </div>
    
                                <div class="space-y-6 p-6 sm:p-8">
    
                                    <div>
    
                                        <label for="nama_toko"
                                            class="mb-2 block text-sm font-bold text-[#3B2115]">
                                            Nama Toko
                                            <span class="text-red-500">*</span>
                                        </label>
    
                                        <div class="relative">
    
                                            <i class="fa-solid fa-store absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>
                                            <input type="text"
                                                id="nama_toko"
                                                name="nama_toko"
                                                value="{{ old('nama_toko') }}"
                                                placeholder="Contoh: Dapur Bu Siti"
                                                class="w-full rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] py-3.5 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A69A] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
    
                                        </div>
    
                                        <p id="nama-toko-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                    </div>
    
                                    <div>
    
                                        <div class="mb-2 flex items-center justify-between">
    
                                            <label for="deskripsi"
                                                class="text-sm font-bold text-[#3B2115]">
                                                Deskripsi Toko
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <span class="text-[11px] text-[#B49D8E]">
                                                Maks. 500 karakter
                                            </span>
    
                                        </div>
    
                                        <textarea id="deskripsi"
                                                name="deskripsi"
                                                rows="5"
                                                maxlength="500"
                                                placeholder="Ceritakan produk atau usaha yang kamu jual..."
                                                class="w-full resize-none rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] px-4 py-3.5 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A69A] focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
                                                >{{ old('deskripsi') }}</textarea>
    
                                        <p id="deskripsi-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                    </div>
    
                                    <div>
    
                                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">
                                            Profil Toko
                                            <span class="text-red-500">*</span>
                                        </label>
    
                                        <label for="foto_profil"
                                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-orange-200 bg-orange-50/40 px-6 py-8 text-center transition hover:border-orange-400 hover:bg-orange-50">
    
                                            <div class="relative mb-4 flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-sm transition group-hover:scale-105">
                                                <i id="uploadStoreIcon" class="fa-solid fa-store text-2xl text-orange-500"></i>
                                                <img id="uploadStorePreview"
                                                    src=""
                                                    alt="Preview profil toko"
                                                    class="hidden absolute h-full w-full object-cover">
                                            </div>
    
                                            <p class="text-sm font-bold text-[#3B2115]">
                                                Upload foto profil toko
                                            </p>
                                            <p class="mt-1 text-xs text-[#8D776A]">
                                                JPG, JPEG, PNG • Maksimal 2MB
                                            </p>
    
                                            <span class="mt-4 rounded-lg bg-white px-4 py-2 text-xs font-bold text-orange-500 shadow-sm">
                                                Pilih Foto
                                            </span>
    
                                            <input type="file"
                                                id="foto_profil"
                                                name="foto_profil"
                                                accept=".jpg,.jpeg,.png"
                                                class="hidden">
    
                                        </label>
    
                                        <p id="foto-profil-name" class="mt-2 hidden text-xs font-medium text-green-600"></p>
    
                                        <p id="foto-profil-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                    </div>
    
    
                                    <div class="flex justify-end border-t border-orange-50 pt-6">
    
                                        <button type="button"
                                                id="nextStep1"
                                                class="group inline-flex items-center gap-3 rounded-xl bg-orange-500 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:-translate-y-0.5 hover:bg-orange-600">
    
                                            Lanjut
                                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/20 transition group-hover:translate-x-1">
                                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                            </span>
    
                                        </button>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                        </div>
    
    
                        <div id="form-step-2" class="form-step hidden">
    
                            <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">
    
                                <div class="border-b border-orange-50 px-6 py-5 sm:px-8">
                                    <div class="flex items-center gap-4">
    
                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50">
                                            <i class="fa-solid fa-location-dot text-lg text-blue-500"></i>
                                        </div>
    
                                        <div>
    
                                            <p class="font-black text-[#3B2115]">
                                                Lokasi & Kontak
                                            </p>
                                            <p class="mt-0.5 text-xs text-[#8D776A]">
                                                Masukkan lokasi dan kontak tokomu.
                                            </p>
    
                                        </div>
    
                                    </div>
                                </div>
    
    
                                <div class="space-y-6 p-6 sm:p-8">
    
                                    <x-dropdown-alamat :provinsi="$provinsi"/>
    
                                    <div>
    
                                        <label for="kode_pos" class="mb-2 block text-sm font-bold text-[#3B2115]">
                                            Kode Pos
                                            <span class="text-red-500">*</span> 
                                        </label>
    
                                        <div class="relative">
    
                                            <i class="fa-solid fa-envelopes-bulk absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>
                                            <input type="text"
                                                id="kode_pos"
                                                name="kode_pos"
                                                value="{{ old('kode_pos') }}"
                                                inputmode="numeric"
                                                maxlength="5"
                                                placeholder="Contoh: 68121"
                                                class="w-full rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] py-3.5 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A69A] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                                        </div>
                                    </div>
    
                                    <p class="mt-2 text-xs text-[#A89588]">
                                        Masukkan 5 digit kode pos lokasi toko.
                                    </p>
    
                                    <p id="kode-pos-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                     <div>
                                        <label for="alamat_lengkap"
                                            class="mb-2 block text-sm font-semibold text-[#3B2115]">
                                            Alamat Lengkap
                                        </label>
    
                                        <textarea id="alamat_lengkap"
                                                name="alamat_lengkap"
                                                rows="3"
                                                required
                                                placeholder="Contoh: Jl. Ahmad Yani No. 25, RT 02/RW 03, Dusun Krajan"
                                                class="w-full rounded-2xl border border-[#F1DCC8] bg-white px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A69A] focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10"
                                        >{{ old('alamat_lengkap') }}</textarea>
    
                                        <p id="alamat-lengkap-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                    </div>
    
                                    <div class="grid gap-5 sm:grid-cols-2">
    
                                        <div>
    
                                            <label for="no_telepon"
                                                class="mb-2 block text-sm font-bold text-[#3B2115]">
                                                Nomor Telepon
                                                <span class="text-red-500">*</span>
                                            </label>
    
                                            <div class="relative">
    
                                                <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>
                                                <input type="text"
                                                        id="no_telepon"
                                                        name="no_telepon"
                                                        value="{{ old('no_telepon') }}"
                                                        placeholder="08xxxxxxxxxx"
                                                        class="w-full rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] py-3.5 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A69A] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
    
                                            </div>
    
                                            <p id="no-telepon-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                        </div>
    
    
                                        <div>
    
                                            <label class="mb-2 block text-sm font-bold text-[#3B2115]">
                                                Email Akun
                                            </label>
    
                                            <div class="relative">
    
                                                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>
                                                <input type="email"
                                                        value="{{ auth()->user()->email }}"
                                                        disabled
                                                        class="w-full cursor-not-allowed rounded-xl border border-[#EEDDD0] bg-[#F8F3EF] py-3.5 pl-11 pr-4 text-sm text-[#8D776A]">
    
                                            </div>
    
                                        </div>
    
                                    </div>
    
                                    <div class="flex items-center justify-between border-t border-orange-50 pt-6">
    
                                        <button type="button"
                                                id="prevStep2"
                                                class="inline-flex items-center gap-2 rounded-xl border border-[#EEDDD0] bg-white px-6 py-3.5 text-sm font-bold text-[#72594B] transition hover:border-orange-200 hover:bg-orange-50 hover:text-orange-500">
                                            <i class="fa-solid fa-arrow-left text-xs"></i>
                                            Kembali
                                        </button>
    
                                        <button type="button"
                                                id="nextStep2"
                                                class="group inline-flex items-center gap-3 rounded-xl bg-orange-500 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:-translate-y-0.5 hover:bg-orange-600">
                                            Lanjut
                                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/20 transition group-hover:translate-x-1">
                                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                            </span>
                                        </button>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                        </div>
    
                        <div id="form-step-3" class="form-step hidden">
    
                            <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">
    
                                <div class="border-b border-orange-50 px-6 py-5 sm:px-8">
                                    <div class="flex items-center gap-4">
    
                                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green-50">
                                            <i class="fa-solid fa-id-card text-lg text-green-500"></i>
                                        </div>
    
                                        <div>
    
                                            <p class="font-black text-[#3B2115]">
                                                Verifikasi Identitas
                                            </p>
                                            <p class="mt-0.5 text-xs text-[#8D776A]">
                                                Upload identitas untuk proses verifikasi.
                                            </p>
    
                                        </div>
    
                                    </div>
                                </div>
    
                                <div class="space-y-6 p-6 sm:p-8">
    
                                    <div class="flex gap-3 rounded-2xl bg-blue-50 p-4">
    
                                        <i class="fa-solid fa-circle-info mt-0.5 text-sm text-blue-500"></i>
                                        <p class="text-xs leading-5 text-blue-700">
                                            Dokumen identitas digunakan untuk memastikan keamanan dan keaslian pemilik toko.
                                        </p>
    
                                    </div>
    
                                    <div>
    
                                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">
                                            Foto KTP
                                            <span class="text-red-500">*</span>
                                        </label>
    
                                        <label for="foto_ktp"
                                            class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-orange-200 bg-orange-50/40 px-6 py-12 text-center transition hover:border-orange-400 hover:bg-orange-50">
    
                                            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm transition group-hover:scale-105">
                                                <i class="fa-solid fa-id-card text-2xl text-orange-500"></i>
                                            </div>
                                            <p class="text-sm font-bold text-[#3B2115]">
                                                Upload foto KTP
                                            </p>
                                            <p class="mt-1 text-xs text-[#8D776A]">
                                                JPG, JPEG, PNG • Maksimal 2MB
                                            </p>
                                            <span class="mt-4 rounded-lg bg-white px-4 py-2 text-xs font-bold text-orange-500 shadow-sm">
                                                Pilih File
                                            </span>
    
                                            <input type="file"
                                                id="foto_ktp"
                                                name="foto_ktp"
                                                accept=".jpg,.jpeg,.png"
                                                class="hidden">
    
                                        </label>
    
                                        <p id="ktpFileName" class="mt-2 hidden text-xs font-medium text-green-600"></p>
    
                                        <p id="foto-ktp-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
    
                                    </div>
    
                                    <div class="rounded-2xl border border-orange-100 bg-orange-50/70 p-5">
    
                                        <label class="flex cursor-pointer gap-3">
    
                                            <input type="checkbox"
                                                name="persetujuan"
                                                value="1"
                                                class="mt-1 h-4 w-4 rounded border-orange-300 text-orange-500 focus:ring-orange-400">
                                            <span class="text-xs leading-6 text-[#72594B]">
                                                Saya menyatakan bahwa informasi yang saya berikan adalah benar dan bersedia mengikuti
                                                <span class="font-bold text-orange-500">
                                                    ketentuan menjadi penjual LokaMarket.
                                                </span>
                                            </span>
    
                                        </label>
    
                                        @error('persetujuan')
                                            <p class="mt-2 text-xs font-medium text-red-500">
                                                {{ $message }}
                                            </p>
                                        @enderror
    
                                    </div>
    
                                    <div class="flex items-center justify-between border-t border-orange-50 pt-6">
    
                                        <button type="button"
                                                id="prevStep3"
                                                class="inline-flex items-center gap-2 rounded-xl border border-[#EEDDD0] bg-white px-6 py-3.5 text-sm font-bold text-[#72594B] transition hover:border-orange-200 hover:bg-orange-50 hover:text-orange-500">
                                            <i class="fa-solid fa-arrow-left text-xs"></i>
                                            Kembali
                                        </button>
    
    
                                        <button type="submit"
                                                class="group inline-flex items-center gap-3 rounded-xl bg-orange-500 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:-translate-y-0.5 hover:bg-orange-600">
                                            Ajukan Pembukaan Toko
                                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-white/20 transition group-hover:translate-x-1">
                                                <i class="fa-solid fa-check text-[10px]"></i>
                                            </span>
                                        </button>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                        </div>
    
                    </div>
    
                    <div class="lg:sticky lg:top-24 lg:h-fit">
    
                        <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">
    
                            <div class="relative overflow-hidden bg-linear-to-br from-orange-400 to-orange-500 px-6 pb-16 pt-6">
    
                                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                                <div class="absolute -bottom-16 -left-10 h-32 w-32 rounded-full bg-white/10"></div>
    
                                <div class="relative">
    
                                    <p class="text-xs font-bold uppercase tracking-wider text-orange-100">
                                        Preview Toko
                                    </p>
                                    <p class="mt-1 text-xl font-black text-white">
                                        Tampilan tokomu
                                    </p>
    
                                </div>
    
                            </div>
    
    
                            <div class="-mt-10 px-5 pb-5">
    
                                <div class="relative rounded-2xl border border-orange-100 bg-white p-5 shadow-lg">
    
                                    <div class="flex items-center gap-4">
    
                                        <div class="relative">
    
                                            <div class="absolute -inset-1 rounded-full bg-linear-to-br from-orange-400 to-amber-300"></div>
    
                                            <div class="relative flex h-16 w-16 items-center justify-center overflow-hidden rounded-full border-4 border-white bg-orange-50 shadow-lg">
    
                                                <img id="previewImage"
                                                    src=""
                                                    class="hidden absolute h-full w-full object-cover"
                                                    alt="Preview">
                                                <i id="defaultStoreIcon" class="fa-solid fa-store text-2xl text-orange-500"></i>
    
                                            </div>
    
                                        </div>
    
                                        <div class="min-w-0">
    
                                            <p id="previewName"
                                            class="truncate font-black text-[#3B2115]">
                                                Nama Toko
                                            </p>
    
                                            <div class="mt-1 flex items-center gap-1 text-xs text-[#A89588]">
                                                <i class="fa-solid fa-location-dot text-orange-400"></i>
                                                <span>
                                                    Lokasi toko
                                                </span>
                                            </div>
    
                                        </div>
    
                                    </div>
    
    
                                    <div class="mt-5 border-t border-orange-50 pt-4">
    
                                        <p id="previewDescription"
                                        class="line-clamp-3 text-xs leading-5 text-[#72594B]">
                                            Deskripsi toko akan muncul di sini setelah kamu mengisinya.
                                        </p>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                        </div>
    
                        <div class="mt-5 rounded-2xl border border-orange-100 bg-white p-5">
    
                            <div class="flex gap-3">
    
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-yellow-50">
                                    <i class="fa-solid fa-lightbulb text-sm text-yellow-500"></i>
                                </div>
    
                                <div>
    
                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Tips membuat toko menarik
                                    </p>
                                    <ul class="mt-2 space-y-2 text-xs leading-5 text-[#72594B]">
    
                                        <li class="flex gap-2">
                                            <span class="text-orange-400">•</span>
                                            Gunakan nama toko yang mudah diingat.
                                        </li>
                                        <li class="flex gap-2">
                                            <span class="text-orange-400">•</span>
                                            Gunakan foto toko yang jelas.
                                        </li>
                                        <li class="flex gap-2">
                                            <span class="text-orange-400">•</span>
                                            Jelaskan produk yang kamu jual.
                                        </li>
    
                                    </ul>
    
                                </div>
    
                            </div>
    
                        </div>
    
                    </div>
    
                </div>
    
            </form>
        </section>

    </div>

</main>
@endsection