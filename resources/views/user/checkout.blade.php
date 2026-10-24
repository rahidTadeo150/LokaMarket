@extends('layouts.customer')

@section('title', 'Checkout - LokaMarket')

@section('content')

    @php
        $checkoutLangsung = session('checkout_langsung');

        $isCheckoutLangsung = !empty($checkoutLangsung);

        $produkLangsung = null;
        $quantityLangsung = 0;

        if ($isCheckoutLangsung) {
            $produkLangsung = \App\Models\produk::with(['thumbnail', 'kategori', 'toko'])->find(
                $checkoutLangsung['produk_id'],
            );

            $quantityLangsung = (int) ($checkoutLangsung['quantity'] ?? 0);
        }
    @endphp

    <main class="min-h-screen bg-[#FFF9F4]">

        <section class="relative overflow-hidden">

            <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-200/30 blur-3xl">
            </div>
            <div class="pointer-events-none absolute -left-24 top-32 h-52 w-52 rounded-full bg-orange-100/40 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-5 py-5 lg:px-1">

                <a href=""
                    class="group mb-5 pl-5 md:inline-flex hidden items-center gap-2 text-sm font-medium text-[#72594B] transition hover:text-orange-500">

                    <i
                        class="fa-solid fa-arrow-left text-xs transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Lanjut Belanja

                </a>

                <div
                    class="relative overflow-hidden rounded-2xl bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-5 py-6 text-white shadow-lg shadow-orange-200/50 md:rounded-3xl">

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-12 -left-8 h-28 w-28 rounded-full bg-orange-300/20"></div>
                    <div class="absolute right-16 top-8 h-20 w-20 rounded-full bg-white/10 blur-2xl"></div>

                    <div class="relative flex items-center justify-between gap-4">

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 shadow-inner ring-1 ring-white/20 backdrop-blur-sm">
                                <i class="fa-solid fa-receipt text-xl text-white"></i>
                            </div>

                            <div>

                                <h2 class="mt-0.5 text-xl font-bold tracking-normal md:tracking-wide sm:text-2xl">
                                    Checkout Pesanan
                                </h2>
                                <p class="mt-1 text-xs md:text-sm text-orange-100">
                                    Periksa pesananmu sebelum menyelesaikan pembelian.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <section class="px-4 py-8 sm:px-6 md:py-12">
            <div class="mx-auto max-w-7xl">

                <form action="{{ route('cust.checkout.pay') }}" 
                    method="POST" 
                    id="checkoutForm"
                    data-payment-url="{{ route('cust.checkout.pay') }}" 
                    data-has-address="{{ $alamat ? 'true' : 'false' }}">

                    @csrf

                    <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_380px]">

                        <div class="space-y-6">

                            <div class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                                <div class="border-b border-[#F1DCC8] px-5 py-4 sm:px-6">
                                    <div class="flex items-center justify-between gap-3">

                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>

                                            <div>
                                                <h2 class="text-base font-bold text-[#3B2115]">
                                                    Alamat Pengiriman
                                                </h2>

                                                <p class="text-xs text-[#A58C7D]">
                                                    Pastikan alamat tujuan sudah benar
                                                </p>
                                            </div>
                                        </div>

                                        <a href="{{ route('cust.pilihAlamat') }}"
                                            class="text-xs font-semibold text-[#FF6B00] hover:text-[#C1440E]">
                                            Ubah
                                        </a>

                                    </div>
                                </div>

                                <div class="p-5 sm:p-6">

                                    @if ($alamat && $alamat->count() > 0)

                                        <div class="rounded-2xl border border-[#FFD5B8] bg-[#FFF9F4] p-4">

                                            <div class="flex items-start justify-between gap-4">

                                                <div class="min-w-0">

                                                    <div class="flex flex-wrap items-center gap-2">

                                                        <p class="text-sm font-bold text-[#3B2115]">
                                                            {{ $alamat->nama_penerima }}
                                                        </p>

                                                        @if ($alamat->label)
                                                            <span
                                                                class="rounded-full bg-[#FFE0CA] px-2 py-0.5 text-[10px] font-semibold text-[#C1440E]">
                                                                {{ $alamat->label }}
                                                            </span>
                                                        @endif

                                                        @if ($alamat->is_default)
                                                            <span
                                                                class="rounded-full bg-orange-100 px-2 py-0.5 text-[10px] font-semibold text-orange-600">
                                                                Utama
                                                            </span>
                                                        @endif

                                                    </div>

                                                    <p class="mt-1 text-xs leading-5 text-[#72594B]">
                                                        {{ $alamat->no_telepon }}
                                                    </p>

                                                    <p class="mt-2 text-sm leading-6 text-[#72594B]">
                                                        {{ Str::title($alamat->alamat_lengkap) }},
                                                        {{ Str::title($alamat->kecamatan->nama) }},
                                                        {{ Str::title($alamat->kota->nama) }},
                                                        {{ Str::title($alamat->provinsi->nama) }}
                                                        {{ $alamat->kode_pos }}
                                                    </p>

                                                </div>

                                                <i class="fa-solid fa-circle-check shrink-0 text-[#FF6B00]"></i>

                                            </div>

                                        </div>
                                    @else
                                        <div class="w-full flex justify-center items-center py-5">
                                            <p class="text-sm text-gray-500">
                                                Alamat Pengiriman Tidak Ada
                                            </p>
                                        </div>

                                        <div id="addressAlertModal"
                                            class="fixed inset-0 z-9999 hidden items-center justify-center bg-[#3B2115]/40 px-5 backdrop-blur-sm">

                                            <div id="addressAlertContent"
                                                class="w-full max-w-md scale-95 rounded-3xl bg-white p-6 opacity-0 shadow-2xl transition-all duration-200">

                                                <div class="text-center">

                                                    <div
                                                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-[#FF6B00]">
                                                        <i class="fa-solid fa-location-dot text-2xl"></i>
                                                    </div>
                                                    <p class="mt-5 text-lg font-bold text-[#3B2115]">
                                                        Alamat Pengiriman Belum Ada
                                                    </p>
                                                    <p class="mt-2 text-sm leading-6 text-[#72594B]">
                                                        Silakan tambahkan alamat pengiriman terlebih dahulu
                                                        sebelum membuat pesanan.
                                                    </p>

                                                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">

                                                        <button type="button" id="closeAddressAlert"
                                                            class="flex-1 rounded-xl border border-[#E9D7C9] bg-white px-4 py-3 text-sm font-bold text-[#72594B] transition hover:bg-[#FFF9F4]">
                                                            Batal
                                                        </button>

                                                        <a href="{{ route('cust.pilihAlamat') }}"
                                                            class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#E85D00]">
                                                            <i class="fa-solid fa-plus text-xs"></i>
                                                            Tambah Alamat
                                                        </a>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    @endif

                                </div>
                            </div>

                            <div class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                                <div class="border-b border-[#F1DCC8] px-5 py-4 sm:px-6">
                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                        </div>

                                        <div>
                                            <h2 class="text-base font-bold text-[#3B2115]">
                                                Produk Pesanan
                                            </h2>

                                            <p class="text-xs text-[#A58C7D]">
                                                Periksa produk yang akan dibeli
                                            </p>
                                        </div>

                                    </div>
                                </div>

                                <div class="divide-y divide-[#F1DCC8]">

                                    <div class="space-y-4">

                                        @if ($isCheckoutLangsung && $produkLangsung && $quantityLangsung > 0)
                                            <div class="group overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

                                                <div class="flex gap-4 p-4 sm:gap-5 sm:p-5">

                                                    <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-2xl bg-[#FFF1E5] sm:h-28 sm:w-28">

                                                        @if ($produkLangsung->thumbnail)
                                                            <img src="{{ asset('storage/' . $produkLangsung->thumbnail->foto) }}"
                                                                alt="{{ $produkLangsung->nama }}"
                                                                class="h-full w-full object-cover">
                                                        @endif

                                                        <div class="absolute bottom-2 left-2 rounded-lg bg-[#3B2115]/90 px-2 py-1 text-[10px] font-bold text-white">
                                                            {{ $quantityLangsung }}x
                                                        </div>

                                                    </div>

                                                    <div class="min-w-0 flex-1">

                                                        <div class="flex items-start justify-between gap-3">

                                                            <div class="min-w-0">

                                                                @if ($produkLangsung->kategori)
                                                                    <span class="inline-flex rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-orange-600">
                                                                        {{ $produkLangsung->kategori->nama }}
                                                                    </span>
                                                                @endif

                                                                <p class="mt-2 line-clamp-2 text-sm font-bold text-[#3B2115] sm:text-base">
                                                                    {{ $produkLangsung->nama }}
                                                                </p>

                                                                @if ($produkLangsung->toko)
                                                                    <p class="mt-1.5 text-xs text-[#A58C7D]">
                                                                        <i class="fa-solid fa-store"></i>
                                                                        {{ $produkLangsung->toko->nama_toko }}
                                                                    </p>
                                                                @endif

                                                            </div>

                                                            <div class="shrink-0 text-right">
                                                                <p class="text-xs text-[#A58C7D]">Harga</p>
                                                                <p class="mt-0.5 text-sm font-bold text-[#C1440E]">
                                                                    Rp{{ number_format($produkLangsung->harga, 0, ',', '.') }}
                                                                </p>
                                                            </div>

                                                        </div>

                                                        <div class="my-4 border-t border-orange-50"></div>

                                                        <div class="flex items-center justify-between gap-3">
                                                            <span class="text-xs text-[#A58C7D]">Jumlah</span>

                                                            <div class="text-right">
                                                                <p
                                                                    class="text-[10px] uppercase tracking-wide text-[#A58C7D]">
                                                                    Subtotal
                                                                </p>
                                                                <p
                                                                    class="text-sm font-extrabold text-[#3B2115] sm:text-base">
                                                                    Rp{{ number_format($produkLangsung->harga * $quantityLangsung, 0, ',', '.') }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @elseif (!$isCheckoutLangsung)
                                            @forelse ($keranjang?->detail ?? [] as $detail)
                                                <div class="group overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-orange-100/50">

                                                    <div class="flex gap-4 p-4 sm:gap-5 sm:p-5">

                                                        <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-2xl bg-[#FFF1E5] sm:h-28 sm:w-28">

                                                            <img src="{{ asset('storage/' . $detail->produk->thumbnail->foto) }}"
                                                                alt="{{ $detail->produk->nama }}"
                                                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                                                            <div class="absolute bottom-2 left-2 flex items-center gap-1 rounded-lg bg-[#3B2115]/90 px-2 py-1 text-[10px] font-bold text-white backdrop-blur-sm">
                                                                <i class="fa-solid fa-box text-[9px]"></i>
                                                                {{ $detail->quantity }}x
                                                            </div>

                                                        </div>

                                                        <div class="min-w-0 flex-1">

                                                            <div class="flex items-start justify-between gap-3">

                                                                <div class="min-w-0">

                                                                    @if ($detail->produk->kategori)
                                                                        <span
                                                                            class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-orange-600">
                                                                            <i class="fa-solid fa-tag text-[9px]"></i>
                                                                            {{ $detail->produk->kategori->nama }}
                                                                        </span>
                                                                    @endif

                                                                    <p
                                                                        class="mt-2 line-clamp-2 text-sm font-bold leading-snug text-[#3B2115] sm:text-base">
                                                                        {{ $detail->produk->nama }}
                                                                    </p>

                                                                    @if ($detail->produk->toko)
                                                                        <p
                                                                            class="mt-1.5 flex items-center gap-1.5 text-xs text-[#A58C7D]">
                                                                            <i class="fa-solid fa-store text-[10px]"></i>
                                                                            {{ $detail->produk->toko->nama_toko }}
                                                                        </p>
                                                                    @endif

                                                                </div>

                                                                <div class="shrink-0 text-right">

                                                                    <p class="text-xs text-[#A58C7D]">
                                                                        Harga
                                                                    </p>
                                                                    <p
                                                                        class="mt-0.5 text-sm font-bold text-[#C1440E] sm:text-base">
                                                                        Rp{{ number_format($detail->produk->harga, 0, ',', '.') }}
                                                                    </p>

                                                                </div>

                                                            </div>

                                                            <div class="my-4 border-t border-orange-50"></div>

                                                            <div class="flex items-center justify-between gap-3">

                                                                <div class="flex items-center gap-2">

                                                                    <span class="text-xs text-[#A58C7D]">
                                                                        Jumlah
                                                                    </span>

                                                                    <span
                                                                        class="inline-flex min-w-8 items-center justify-center rounded-lg bg-[#FFF7F0] px-2 py-1 text-xs font-bold text-[#72594B]">
                                                                        {{ $detail->quantity }}
                                                                    </span>

                                                                </div>

                                                                <div class="text-right">

                                                                    <p
                                                                        class="text-[10px] uppercase tracking-wide text-[#A58C7D]">
                                                                        Subtotal
                                                                    </p>

                                                                    <p
                                                                        class="mt-0.5 text-sm font-extrabold text-[#3B2115] sm:text-base">
                                                                        Rp{{ number_format($subtotal, 0, ',', '.') }}
                                                                    </p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            @empty
                                                <div class="rounded-3xl border border-dashed border-orange-200 bg-white px-6 py-12 text-center">
                                                    <i class="fa-solid fa-cart-shopping text-2xl text-orange-400"></i>
                                                    <h3 class="mt-4 text-base font-bold text-[#3B2115]">
                                                        Keranjang masih kosong
                                                    </h3>
                                                    <p class="mt-1 text-xs text-[#A58C7D]">
                                                        Belum ada produk yang bisa diproses ke halaman checkout.
                                                    </p>
                                                </div>
                                            @endforelse

                                        @else
                                            <p class="p-5 text-center text-sm text-red-500">
                                                Produk checkout langsung tidak ditemukan. Silakan pilih produk kembali.
                                            </p>
                                        @endif

                                    </div>

                                </div>

                            </div>


                            <div class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
                                        <i class="fa-regular fa-note-sticky"></i>
                                    </div>

                                    <div>
                                        <p class="text-base font-bold text-[#3B2115]">
                                            Catatan Pesanan
                                        </p>
                                        <p class="text-xs text-[#A58C7D]">
                                            Tambahkan catatan untuk penjual
                                        </p>
                                    </div>

                                </div>

                                <textarea name="catatan" rows="5" placeholder="Contoh: Tolong jangan terlalu pedas..."
                                    class="mt-4 w-full resize-none rounded-2xl border border-[#E9D7C9] bg-[#FFF9F4] px-4 py-3 text-sm text-[#3B2115] placeholder-[#A58C7D] outline-none transition focus:border-[#FF6B00] focus:ring-2 focus:ring-[#FFD1AD]"></textarea>

                            </div>

                            <div class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>

                                    <div>

                                        <h2 class="text-base font-bold text-[#3B2115]">
                                            Metode Pembayaran
                                        </h2>
                                        <p class="text-xs text-[#A58C7D]">
                                            Pilih metode pembayaran yang paling nyaman untukmu.
                                        </p>

                                    </div>

                                </div>

                                <div class="mt-5 space-y-4">

                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Pilih Metode Pembayaran
                                    </p>

                                    <label
                                        class="payment-option group relative flex cursor-pointer items-center gap-3 rounded-2xl border border-orange-100 bg-white p-4 transition-all duration-200 hover:border-orange-300 hover:shadow-sm">

                                        <input type="radio" name="payment_method" value="other_qris"
                                            class="payment-radio peer sr-only" @checked(old('payment_method', 'other_qris') === 'other_qris')>

                                        <span
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition peer-checked:bg-purple-100">
                                            <i class="fa-solid fa-qrcode text-xl"></i>
                                        </span>

                                        <span class="min-w-0 flex-1">
                                            <span class="block text-sm font-bold text-[#3B2115]">QRIS</span>
                                            <span class="mt-1 block text-xs leading-relaxed text-[#8B7466]">
                                                Bayar dengan memindai kode QR. dengan Shopeepay, Gopay, Dana, dll
                                            </span>
                                        </span>

                                        <span
                                            class="custom-radio flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-[#DCCBC0] transition-all duration-200">
                                            <span
                                                class="radio-dot h-2.5 w-2.5 scale-0 rounded-full bg-white transition-transform duration-200"></span>
                                        </span>

                                    </label>

                                    <label
                                        class="payment-option group relative flex cursor-pointer items-center gap-3 rounded-2xl border border-orange-100 bg-white p-4 transition-all duration-200 hover:border-orange-300 hover:shadow-sm">

                                        <input type="radio" name="payment_method" value="ovo_va"
                                            class="payment-radio peer sr-only" @checked(old('payment_method') === 'ovo_va')>

                                        <span
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-50">
                                            <span class="text-lg font-black italic text-purple-700">OVO</span>
                                        </span>

                                        <span class="min-w-0 flex-1">
                                            <span class="block text-sm font-bold text-[#3B2115]">OVO Virtual Account</span>
                                            <span class="mt-1 block text-xs leading-relaxed text-[#8B7466]">
                                                Pembayaran melalui VA jika tersedia.
                                            </span>
                                        </span>

                                        <span
                                            class="custom-radio flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-[#DCCBC0] transition-all duration-200">
                                            <span
                                                class="radio-dot h-2.5 w-2.5 scale-0 rounded-full bg-white transition-transform duration-200"></span>
                                        </span>

                                    </label>

                                    <label
                                        class="payment-option group relative flex cursor-pointer items-center gap-3 rounded-2xl border border-orange-100 bg-white p-4 transition-all duration-200 hover:border-orange-300 hover:shadow-sm">

                                        <input type="radio" name="payment_method" value="bank_transfer"
                                            class="payment-radio peer sr-only" @checked(old('payment_method') === 'bank_transfer')>

                                        <span
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                            <i class="fa-solid fa-building-columns text-xl"></i>
                                        </span>

                                        <span class="min-w-0 flex-1">
                                            <span class="block text-sm font-bold text-[#3B2115]">Transfer Bank</span>
                                            <span class="mt-1 block text-xs leading-relaxed text-[#8B7466]">
                                                Pilih bank untuk mendapatkan nomor VA.
                                            </span>
                                        </span>

                                        <span
                                            class="custom-radio flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-[#DCCBC0] transition-all duration-200">
                                            <span
                                                class="radio-dot h-2.5 w-2.5 scale-0 rounded-full bg-white transition-transform duration-200"></span>
                                        </span>

                                    </label>

                                    <div id="bankOptions"
                                        class="hidden rounded-2xl border border-orange-100 bg-[#FFFCF9] p-4 sm:p-5">

                                        <div class="mb-4">
                                            <p class="text-sm font-extrabold text-[#3B2115]">
                                                Pilih Bank Tujuan
                                            </p>
                                            <p class="mt-1 text-xs text-[#8B7466]">
                                                Pilih bank untuk pembayaran Virtual Account.
                                            </p>
                                        </div>

                                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">

                                            @php
                                                $banks = [
                                                    'bca_va' => [
                                                        'name' => 'BCA',
                                                        'description' => 'Virtual Account',
                                                        'icon' => 'fa-building-columns',
                                                        'color' => 'blue',
                                                    ],
                                                    'bni_va' => [
                                                        'name' => 'BNI',
                                                        'description' => 'Virtual Account',
                                                        'icon' => 'fa-building-columns',
                                                        'color' => 'orange',
                                                    ],
                                                    'bri_va' => [
                                                        'name' => 'BRI',
                                                        'description' => 'Virtual Account',
                                                        'icon' => 'fa-building-columns',
                                                        'color' => 'blue',
                                                    ],
                                                    'permata_va' => [
                                                        'name' => 'Permata',
                                                        'description' => 'Virtual Account',
                                                        'icon' => 'fa-building-columns',
                                                        'color' => 'purple',
                                                    ],
                                                    'seabank_va' => [
                                                        'name' => 'SeaBank',
                                                        'description' => 'Jika didukung',
                                                        'icon' => 'fa-building-columns',
                                                        'color' => 'red',
                                                    ],
                                                ];
                                            @endphp

                                            @foreach ($banks as $code => $bank)
                                                <label class="bank-option group relative flex min-h-28 cursor-pointer flex-col justify-between rounded-2xl border border-[#F1DCC8] bg-white p-3 transition-all duration-200 hover:-translate-y-0.5 hover:border-orange-300 hover:shadow-md sm:p-4">

                                                    <input type="radio" 
                                                        name="bank_code" 
                                                        value="{{ $code }}"
                                                        class="bank-radio peer sr-only" @checked(old('bank_code', 'bca_va') === $code)>

                                                    <div class="flex items-start justify-between gap-2">

                                                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600 transition-all duration-200 group-hover:bg-orange-100">
                                                            <i class="fa-solid {{ $bank['icon'] }} text-base"></i>
                                                        </span>

                                                        <span class="bank-check flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-[#DCCBC0] bg-white transition-all duration-200">
                                                            <i class="fa-solid fa-check scale-0 text-[9px] text-white transition-transform duration-200"></i>
                                                        </span>

                                                    </div>

                                                    <div class="mt-3">

                                                        <span class="block text-sm font-extrabold text-[#3B2115]">
                                                            {{ $bank['name'] }}
                                                        </span>

                                                        <span class="mt-0.5 block text-[10px] text-[#A58E81]">
                                                            {{ $bank['description'] }}
                                                        </span>

                                                    </div>

                                                </label>
                                            @endforeach

                                        </div>

                                        <div class="mt-4 flex items-start gap-2 rounded-xl bg-orange-50/80 p-3">
                                            <i class="fa-solid fa-circle-info mt-0.5 text-xs text-orange-500"></i>
                                            <p class="text-[11px] leading-relaxed text-[#72594B]">
                                                Ketersediaan bank mengikuti channel Virtual Account yang aktif
                                                pada akun Midtrans kamu.
                                            </p>
                                        </div>

                                    </div>

                                    @error('payment_method')
                                        <p class="text-xs font-medium text-red-500">{{ $message }}</p>
                                    @enderror

                                    @error('bank_code')
                                        <p class="text-xs font-medium text-red-500">{{ $message }}</p>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        <aside class="lg:sticky lg:top-24">

                            <div class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                                <div
                                    class="relative overflow-hidden bg-linear-to-br from-orange-400 to-orange-600 px-5 py-5 text-white">

                                    <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-white/10"></div>
                                    <div class="absolute -bottom-8 -left-5 h-16 w-16 rounded-full bg-orange-300/20"></div>

                                    <div class="relative flex items-center gap-3">

                                        <div
                                            class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm ring-1 ring-white/20">
                                            <i class="fa-solid fa-receipt text-lg"></i>
                                        </div>

                                        <div>
                                            <p class="text-[11px] font-medium uppercase tracking-wider text-orange-100">
                                                LokaMarket
                                            </p>

                                            <h2 class="text-lg font-bold">
                                                Ringkasan Pesanan
                                            </h2>
                                        </div>

                                    </div>

                                </div>

                                <div class="p-5 sm:p-6">

                                    <div class="space-y-3">

                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-[#72594B]">
                                                Total Produk
                                            </span>
                                            <span class="font-medium text-[#3B2115]">
                                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-[#72594B]">
                                                Ongkos Kirim
                                            </span>

                                            <span class="font-medium text-[#3B2115]">
                                                Rp{{ number_format($ongkir, 0, ',', '.') }}
                                            </span>
                                        </div>

                                    </div>


                                    <div class="my-5 border-t border-dashed border-[#E9D7C9]"></div>


                                    <div class="flex items-end justify-between gap-4">

                                        <div>
                                            <p class="text-xs text-[#A58C7D]">
                                                Total Pembayaran
                                            </p>

                                            <p class="mt-1 text-xl font-bold text-[#C1440E]">
                                                Rp{{ number_format($totalPembayaran, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <span
                                            class="rounded-full bg-[#FFF1E5] px-3 py-1 text-[10px] font-semibold text-[#C1440E]">
                                            {{ $totalItem }} Produk
                                        </span>

                                    </div>

                                    <button type="submit" id="checkoutButton"
                                        class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl bg-[#FF6B00] px-5 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#E85D00] active:scale-[0.98]">
                                        <i class="fa-solid fa-lock text-xs"></i>
                                        Buat Pesanan
                                    </button>

                                    <p class="mt-4 text-center text-[11px] leading-5 text-[#A58C7D]">
                                        Dengan membuat pesanan, Anda menyetujui
                                        ketentuan dan kebijakan LokaMarket.
                                    </p>

                                </div>

                            </div>

                        </aside>

                    </div>

                </form>

            </div>
        </section>

    </main>

    @push('scripts')
        <script src="{{ config('services.midtrans.is_production')
                ? 'https://app.midtrans.com/snap/snap.js'
                : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    @endpush

@endsection
