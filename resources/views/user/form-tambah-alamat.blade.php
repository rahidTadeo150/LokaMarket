@extends('layouts.customer')

@section('title', 'Tambah Alamat - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F4]">

        <section class="relative overflow-hidden bg-[#FFF4E8]">

            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -right-24 -top-28 h-80 w-80 rounded-full bg-orange-300/30 blur-3xl"></div>
                <div class="absolute -bottom-40 -left-24 h-80 w-80 rounded-full bg-orange-200/40 blur-3xl"></div>
                <div class="absolute right-[30%] top-20 h-2 w-2 rounded-full bg-orange-400/60"></div>
                <div class="absolute right-[25%] top-32 h-3 w-3 rounded-full bg-orange-300/50"></div>
                <div class="absolute bottom-20 left-[25%] h-2.5 w-2.5 rounded-full bg-orange-400/40"></div>
            </div>


            <div class="relative mx-auto max-w-5xl px-5 py-6 sm:px-6 sm:py-8">
                <div class="mt-8 grid items-center gap-8 md:grid-cols-[1fr_auto] md:gap-12">

                    <div>

                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/80 px-3 py-1.5 shadow-sm backdrop-blur-sm">
                            <span
                                class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-100 text-orange-500">
                                <i class="fa-solid fa-plus text-[9px]"></i>
                            </span>
                            <span class="text-[10px] font-bold uppercase tracking-[0.12em] text-orange-600 sm:text-[11px]">
                                Tambah Alamat
                            </span>
                        </div>


                        <P
                            class="mt-4 max-w-xl text-3xl font-extrabold leading-[1.15] tracking-tight text-[#3B2115] sm:text-4xl lg:text-[42px]">
                            Simpan alamat untuk
                            <span class="relative inline-block text-orange-500">
                                pengirimanmu
                                <span class="absolute -bottom-1 left-0 h-1 w-full rounded-full bg-orange-200"></span>
                            </span>
                        </P>


                        <p class="mt-4 max-w-lg text-sm leading-relaxed text-[#80695C] sm:text-[15px]">
                            Lengkapi informasi penerima dan alamat agar pesanan
                            dari UMKM lokal favoritmu dapat dikirim dengan mudah.
                        </p>

                        <div class="mt-6 flex flex-wrap items-center gap-x-5 gap-y-3">

                            <div class="flex items-center gap-2">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-green-50 text-green-500">
                                    <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                </span>
                                <span class="text-[10px] font-medium text-[#80695C] sm:text-xs">
                                    Data tersimpan aman
                                </span>
                            </div>

                            <div class="hidden h-4 w-px bg-orange-200 sm:block"></div>

                            <div class="flex items-center gap-2">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-orange-100 text-orange-500">
                                    <i class="fa-solid fa-truck-fast text-[10px]"></i>
                                </span>
                                <span class="text-[10px] font-medium text-[#80695C] sm:text-xs">
                                    Mempermudah pengiriman
                                </span>
                            </div>

                        </div>

                    </div>

                    <div class="relative hidden md:block">

                        <div
                            class="relative flex h-44 w-44 items-center justify-center rounded-4xl border border-orange-100 bg-white shadow-xl shadow-orange-100/60">

                            <div class="absolute h-28 w-28 rounded-full bg-orange-100/80 blur-2xl"></div>

                            <div
                                class="relative flex h-24 w-24 items-center justify-center rounded-[1.7rem] bg-linear-to-br from-orange-400 to-[#D9490B] text-white shadow-xl shadow-orange-200">
                                <i class="fa-solid fa-map-location-dot text-4xl"></i>
                            </div>

                            <div
                                class="absolute -bottom-4 -left-10 flex items-center gap-2.5 rounded-xl border border-orange-100 bg-white px-3 py-2.5 shadow-lg">

                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 text-green-500">
                                    <i class="fa-solid fa-check text-[11px]"></i>
                                </div>

                                <div>
                                    <p class="text-[9px] text-[#A58C7D]">
                                        Alamat
                                    </p>
                                    <p class="text-[10px] font-bold text-[#3B2115]">
                                        Siap digunakan
                                    </p>
                                </div>

                            </div>

                            <div
                                class="absolute -right-3 -top-3 flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-orange-500 shadow-lg">
                                <i class="fa-solid fa-location-dot text-sm"></i>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="mt-8 border-t border-orange-200/60 pt-5">

                    <div class="flex flex-wrap items-center justify-between gap-3">

                        <div class="flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-orange-100 text-orange-500">
                                <i class="fa-solid fa-circle-info text-[9px]"></i>
                            </span>
                            <span class="text-[10px] font-medium text-[#80695C] sm:text-xs">
                                Pastikan alamat sudah benar sebelum disimpan.
                            </span>
                        </div>

                        <div class="hidden items-center gap-2 sm:flex">
                            <span class="h-1.5 w-1.5 rounded-full bg-orange-400"></span>
                            <span class="text-[10px] font-semibold text-[#A58C7D]">
                                LokaMarket
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="mx-auto max-w-4xl px-5 py-6 sm:px-6 sm:py-10">

            <form id="addressForm" action="{{ route('cust.storeAlamat') }}" method="POST" class="space-y-5">

                @csrf

                <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

                    <div class="border-b border-orange-50 px-5 py-5 sm:px-6">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Informasi Penerima
                                </p>
                                <p class="mt-1 text-xs text-[#A58C7D]">
                                    Masukkan data orang yang akan menerima pesanan.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">

                        <div>
                            <label for="label" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                                Nama Alamat
                            </label>
                            <input type="text" 
                                id="label" 
                                name="label" 
                                value="{{ old('label') }}"
                                placeholder="Contoh: Rumah, Kantor, Kos" 
                                required maxlength="50"
                                autocomplete="off"
                                class="w-full rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A398] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                            <p id="label-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
                        </div>

                        <div>
                            <label for="nama_penerima" class="mb-2 block text-xs font-bold text-[#3B2115]">
                                Nama Penerima
                                <span class="text-orange-500">*</span>
                            </label>
                            <input type="text" 
                                id="nama_penerima" 
                                name="nama_penerima"
                                placeholder="Contoh: Budi Santoso"
                                autocomplete="off"
                                class="w-full rounded-xl border border-orange-100 bg-[#FFFCF9] px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#C8B5A8] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                            <p id="nama-penerima-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
                        </div>

                        <div>
                            <label for="no_telepon" class="mb-2 block text-xs font-bold text-[#3B2115]">
                                Nomor Telepon
                                <span class="text-orange-500">*</span>
                            </label>

                            <div class="flex">

                                <span
                                    class="flex items-center rounded-l-xl border border-r-0 border-orange-100 bg-orange-50 px-3 text-xs font-bold text-orange-600">
                                    +62
                                </span>

                                <input type="text" 
                                    id="no_telepon" 
                                    name="no_telepon" 
                                    value="{{ old('no_telepon', auth()->user()->no_telp ? preg_replace('/^0/', '', preg_replace('/^\+?62/', '', preg_replace('/\D/', '', auth()->user()->no_telp))) : '') }}"
                                    autocomplete="off"
                                    placeholder="8123456789" 
                                    inputmode="numeric"
                                    class="min-w-0 flex-1 rounded-r-xl border border-orange-100 bg-[#FFFCF9] px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#C8B5A8] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                            
                            </div>

                            <p id="no-telepon-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>

                        </div>

                    </div>

                </div>

                <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

                    <div class="border-b border-orange-50 px-5 py-5 sm:px-6">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-map-location-dot text-sm"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Lokasi
                                </p>
                                <p class="mt-1 text-xs text-[#A58C7D]">
                                    Tentukan wilayah alamat pengirimanmu.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="grid gap-5 p-5 sm:p-6">

                        <x-dropdown-alamat :provinsi="$provinsi" :selectedProvinsi="old('provinsi_id')" :selectedKota="old('kota_id')" :selectedKecamatan="old('kecamatan_id')" />

                        <div>

                            <label for="kode_pos" class="mb-2 block text-xs font-bold text-[#3B2115]">
                                Kode Pos
                                <span class="text-orange-500">*</span>
                            </label>

                            <input type="text" id="kode_pos" 
                                name="kode_pos" 
                                maxlength="5" 
                                inputmode="numeric" 
                                placeholder="Contoh: 68121"
                                autocomplete="off"
                                class="w-full max-w-xs rounded-xl border border-orange-100 bg-[#FFFCF9] px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#C8B5A8] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                            <p id="kode-pos-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>
                        </div>

                    </div>

                </div>

                <div class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

                    <div class="border-b border-orange-50 px-5 py-5 sm:px-6">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-road text-sm"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Detail Alamat
                                </p>
                                <p class="mt-1 text-xs text-[#A58C7D]">
                                    Tulis alamat secara lengkap agar kurir mudah
                                    menemukan lokasi.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="p-5 sm:p-6">

                        <label for="alamat_lengkap" class="mb-2 block text-xs font-bold text-[#3B2115]">
                            Alamat Lengkap
                            <span class="text-orange-500">*</span>
                        </label>

                        <textarea id="alamat_lengkap" name="alamat_lengkap" rows="4" maxlength="500"
                            placeholder="Contoh: Jl. Ahmad Yani No. 25, RT 02/RW 03, Dusun Krajan"
                            class="w-full resize-none rounded-xl border border-orange-100 bg-[#FFFCF9] px-4 py-3 text-sm leading-relaxed text-[#3B2115] outline-none transition placeholder:text-[#C8B5A8] focus:border-orange-400 focus:ring-4 focus:ring-orange-100"></textarea>

                        <div class="mt-2 flex justify-end">
                            <span class="text-[10px] text-[#A58C7D]">
                                Maksimal 500 karakter
                            </span>
                        </div>

                        <p id="alamat-lengkap-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>

                    </div>

                </div>

                <label
                    class="flex cursor-pointer items-start gap-3 rounded-2xl border border-orange-100 bg-white p-4 shadow-sm transition hover:border-orange-200">

                    <input type="checkbox" id="is_default" name="is_default" value="1" checked
                        class="mt-0.5 h-4 w-4 rounded border-orange-300 text-orange-500 focus:ring-orange-400">

                    <div class="min-w-0">
                        <p class="text-xs font-bold text-[#3B2115]">
                            Jadikan sebagai alamat utama
                        </p>
                        <p class="mt-1 text-[11px] leading-relaxed text-[#A58C7D]">
                            Alamat ini akan dipilih otomatis saat kamu melakukan
                            checkout berikutnya.
                        </p>
                    </div>

                </label>

                <div
                    class="sticky bottom-4 z-20 rounded-2xl border border-orange-100 bg-white/95 p-3 shadow-xl shadow-orange-100/40 backdrop-blur-md">

                    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">

                        <button onclick="{{ route('cust.pilihAlamat') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-orange-200 bg-white px-5 py-3 text-sm font-semibold text-[#72594B] transition hover:bg-orange-50 active:scale-[0.98]">
                            Batal
                        </button>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 active:scale-[0.98]">
                            <i class="fa-solid fa-check text-xs"></i>
                            Simpan Alamat
                        </button>

                    </div>

                </div>

            </form>

        </section>

    </main>

@endsection
