@extends('layouts.customer')

@section('title', 'Pilih Alamat - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F4]">

        <section class="relative overflow-hidden bg-[#FFF4E8]">

            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-orange-300/30 blur-3xl"></div>
                <div class="absolute -bottom-32 left-10 h-64 w-64 rounded-full bg-orange-200/40 blur-3xl"></div>
                <div class="absolute right-[18%] top-16 h-3 w-3 rounded-full bg-orange-300/60"></div>
                <div class="absolute right-[12%] top-32 h-2 w-2 rounded-full bg-orange-400/50"></div>
                <div class="absolute bottom-16 left-[18%] h-2.5 w-2.5 rounded-full bg-orange-300/50"></div>
            </div>

            <div class="relative mx-auto max-w-5xl px-5 py-6 sm:px-6 sm:py-8">

                <div class="flex items-center justify-between">

                    <a href="{{ route('cust.myProfile') }}"
                        class="group inline-flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-[#72594B] shadow-sm transition-all duration-200 hover:-translate-x-0.5 hover:border-orange-200 hover:bg-orange-50 hover:text-orange-600">
                        <i
                            class="fa-solid fa-arrow-left text-xs transition-transform duration-200 group-hover:-translate-x-0.5"></i>
                    </a>

                    <div class="flex items-center gap-2">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-500 text-white shadow-lg shadow-orange-200">
                            <i class="fa-solid fa-location-dot text-sm"></i>
                        </div>

                        <span class="hidden text-sm font-extrabold tracking-tight text-[#3B2115] sm:block">
                            Loka<span class="text-orange-500">Market</span>
                        </span>

                    </div>

                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-orange-100 bg-white/80 px-3 py-1.5 shadow-sm backdrop-blur-sm">
                        <span
                            class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-[9px] font-bold text-white">
                            1
                        </span>
                        <span class="text-[10px] font-semibold text-[#72594B] sm:text-xs">
                            Pilih Alamat
                        </span>
                    </div>

                </div>

                <div class="mt-8 grid items-center gap-8 sm:mt-10 md:grid-cols-[1fr_auto]">

                    <div>

                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-orange-200/70 bg-white/80 px-3 py-1.5 shadow-sm backdrop-blur-sm">
                            <span
                                class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-100 text-orange-500">
                                <i class="fa-solid fa-location-crosshairs text-[9px]"></i>
                            </span>
                            <span class="text-[10px] font-bold uppercase tracking-[0.12em] text-orange-600 sm:text-[11px]">
                                Alamat Pengiriman
                            </span>
                        </div>

                        <p
                            class="mt-4 max-w-xl text-3xl font-extrabold leading-tight tracking-tight text-[#3B2115] sm:text-4xl">
                            Mau dikirim ke
                            <span class="relative inline-block text-orange-500">
                                mana?
                                <span class="absolute -bottom-1 left-0 h-1 w-full rounded-full bg-orange-200"></span>
                            </span>
                        </p>

                        <p class="mt-4 max-w-lg text-sm leading-relaxed text-[#80695C] sm:text-[15px]">
                            Pilih alamat yang ingin kamu gunakan untuk menerima pesanan dari UMKM lokal favoritmu.
                        </p>

                    </div>

                    <div class="hidden md:block">

                        <div
                            class="relative flex h-36 w-36 items-center justify-center rounded-4xl border border-orange-100 bg-white shadow-xl shadow-orange-100/60">

                            <div class="absolute h-24 w-24 rounded-full bg-orange-100/70 blur-xl"></div>

                            <div
                                class="relative flex h-20 w-20 items-center justify-center rounded-3xl bg-linear-to-br from-orange-400 to-[#D9490B] text-white shadow-xl shadow-orange-200">
                                <i class="fa-solid fa-location-dot text-3xl"></i>
                            </div>

                            <div
                                class="absolute -bottom-3 -left-8 flex items-center gap-2 rounded-xl border border-orange-100 bg-white px-3 py-2 shadow-lg">

                                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-green-50 text-green-500">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </div>

                                <div>
                                    <p class="text-[9px] text-[#A58C7D]">
                                        Alamat
                                    </p>
                                    <p class="text-[10px] font-bold text-[#3B2115]">
                                        Siap dikirim
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="mt-8 flex flex-wrap items-center gap-x-5 gap-y-2 border-t border-orange-200/60 pt-5">

                    <div class="flex items-center gap-2">
                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-orange-100 text-orange-500">
                            <i class="fa-solid fa-shield-halved text-[9px]"></i>
                        </span>
                        <span class="text-[10px] font-medium text-[#80695C] sm:text-xs">
                            Alamat tersimpan dengan aman
                        </span>
                    </div>

                    <div class="hidden h-4 w-px bg-orange-200 sm:block"></div>

                    <div class="flex items-center gap-2">

                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-green-50 text-green-500">
                            <i class="fa-solid fa-truck-fast text-[9px]"></i>
                        </span>

                        <span class="text-[10px] font-medium text-[#80695C] sm:text-xs">
                            Memudahkan proses pengiriman
                        </span>

                    </div>

                </div>

            </div>

        </section>

        <section class="mx-auto max-w-5xl px-5 py-6 sm:px-6 sm:py-8">

            <div id="addressAlert"
                class="mb-5 hidden items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="text-sm font-bold text-green-700">
                        Alamat dipilih
                    </p>
                    <p class="mt-0.5 text-xs text-green-600">
                        Alamat ini akan digunakan untuk pengiriman pesanan.
                    </p>
                </div>

            </div>

            <div class="mb-5 flex items-center justify-between gap-4">

                <div>
                    <p class="text-base font-bold text-[#3B2115]">
                        Alamat Tersimpan
                    </p>
                    <p class="mt-1 text-xs text-[#A58C7D]">
                        {{ $alamat->count() }} alamat tersimpan
                    </p>
                </div>

                <a href="{{ route('cust.formTambahAlamat') }}" id="addAddressButton"
                    class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-orange-200 bg-white px-4 py-2.5 text-xs font-bold text-orange-600 shadow-sm transition hover:bg-orange-50 active:scale-[0.98]">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    Tambah Alamat
                </a>

            </div>

            <x-alert-session />

            <div class="space-y-4">

                @forelse ($alamat as $item)
                    <label
                        class="address-card group block cursor-pointer rounded-3xl border border-orange-100 bg-white p-5 shadow-sm transition-all duration-200 hover:border-orange-300 hover:shadow-md"
                        data-address="{{ $item->label }}">

                        <input type="radio" type="radio" name="address" value="{{ $item->id }}"
                            class="address-radio peer sr-only" data-address="{{ $item->label }}"
                            @checked($item->is_default)>

                        <div class="flex gap-4">

                            <div class="shrink-0 pt-0.5">
                                <div
                                    class="radio-circle flex h-5 w-5 items-center justify-center rounded-full border-2 {{ $item->is_utama ? 'border-orange-500 bg-orange-500' : 'border-[#DCCBC0]' }} transition">
                                    <div class="h-2 w-2 rounded-full bg-white {{ $item->is_utama ? '' : 'hidden' }}"></div>
                                </div>
                            </div>

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-orange-50 text-orange-500">

                                @if (strtolower($item->label) === 'rumah')
                                    <i class="fa-solid fa-house text-sm"></i>
                                @elseif (strtolower($item->label) === 'kantor')
                                    <i class="fa-solid fa-building text-sm"></i>
                                @elseif (strtolower($item->label) === 'kos')
                                    <i class="fa-solid fa-door-open text-sm"></i>
                                @else
                                    <i class="fa-solid fa-location-dot text-sm"></i>
                                @endif

                            </div>

                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <p class="text-sm font-bold text-[#3B2115]">
                                        {{ $item->label }}
                                    </p>

                                    @if ($item->is_default)
                                        <span
                                            class="rounded-full bg-orange-100 px-2.5 py-1 text-[9px] font-bold uppercase tracking-wide text-orange-600">
                                            Utama
                                        </span>
                                    @endif

                                </div>

                                <div class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1">

                                    <p class="text-sm font-semibold text-[#3B2115]">
                                        {{ $item->nama_penerima }}
                                    </p>
                                    <span class="text-xs text-[#D2BFB2]">
                                        •
                                    </span>
                                    <p class="text-xs text-[#72594B]">
                                        {{ $item->no_telepon }}
                                    </p>

                                </div>

                                <p class="mt-2 text-xs leading-relaxed text-[#72594B] sm:text-sm">
                                    {{ $item->kecamatan->nama ?? '-' }},
                                    {{ $item->kota->nama ?? '-' }},
                                    {{ $item->provinsi->nama ?? '-' }}
                                </p>

                                <div class="mt-2 w-fit px-3 py-1 rounded-lg bg-orange-500 flex items-center">
                                    <p class="text-[11px] text-[#ffffff]">
                                        Kode Pos : {{ $item->kode_pos }}
                                    </p>
                                </div>

                            </div>

                            <a href="{{ route('cust.formEditAlamat', $item->id) }}"
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-[#A58C7D] transition hover:bg-orange-100 hover:text-orange-500"
                                title="Edit alamat">
                                <i class="fa-solid fa-pen text-[10px]"></i>
                            </a>

                            <form action="{{ route('cust.formEditAlamat', $item->id) }}" 
                                id="deleteAlamatForm" 
                                method="POST" 
                                class="shrink-0">

                                @csrf
                                @method('DELETE')

                                <button type="button" 
                                        data-confirm 
                                        data-form="deleteAlamatForm" 
                                        data-theme="red"
                                        data-title="Hapus Alamat ini?"
                                        data-message="Apakah kamu yakin ingin menghapus alamat ini?"
                                        data-confirm-text="Hapus Alamat"
                                        data-icon="fa-solid fa-map-location-dot"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg text-[#A58C7D] transition hover:bg-red-100 hover:text-red-500"
                                        title="Hapus alamat">
                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                </button>
                            </form>

                        </div>

                    </label>

                @empty

                    <div class="rounded-3xl border border-dashed border-orange-200 bg-white px-6 py-12 text-center">

                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-orange-400">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                        </div>

                        <h3 class="mt-5 text-base font-bold text-[#3B2115]">
                            Belum Ada Alamat
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-[#80695C]">
                            Kamu belum memiliki alamat pengiriman.
                            Tambahkan alamat terlebih dahulu agar pesanan dapat
                            dikirim ke lokasi yang kamu inginkan.
                        </p>

                        <a href="{{ route('cust.formTambahAlamat') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-xs font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 active:scale-[0.98]">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            Tambah Alamat
                        </a>

                    </div>
                @endforelse

            </div>


            <div
                class="sticky bottom-4 z-20 mt-6 rounded-2xl border border-orange-100 bg-white/95 p-3 shadow-xl shadow-orange-100/40 backdrop-blur-md">

                <div class="flex items-center justify-between gap-4">

                    <div class="hidden min-w-0 sm:block">

                        <p class="text-[10px] uppercase tracking-wide text-[#A58C7D]">
                            Alamat dipilih
                        </p>

                        <p id="selectedAddressName" class="mt-0.5 truncate text-sm font-bold text-[#3B2115]">
                            {{ $alamat->firstWhere('is_utama', true)?->label ?? 'Belum ada alamat' }}
                        </p>

                    </div>


                    <button type="button" id="useAddressButton"
                        class="ml-auto inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 active:scale-[0.98] sm:w-auto">
                        <i class="fa-solid fa-check text-xs"></i>
                        Gunakan Alamat Ini
                    </button>

                </div>

            </div>

        </section>

        <x-custom-alert-confirmation/>

    </main>
@endsection
