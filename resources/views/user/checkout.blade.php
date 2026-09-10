@extends('layouts.customer')

@section('title', 'Checkout - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F4]">

    {{-- HEADER --}}
    <section class="relative overflow-hidden">

        <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-200/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -left-24 top-32 h-52 w-52 rounded-full bg-orange-100/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-5 py-5 lg:px-1">

            <a href=""
            class="group mb-5 pl-5 md:inline-flex hidden items-center gap-2 text-sm font-medium text-[#72594B] transition hover:text-orange-500">

                <i class="fa-solid fa-arrow-left text-xs transition-transform duration-300 group-hover:-translate-x-1"></i>
                Lanjut Belanja

            </a>

            <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-5 py-6 text-white shadow-lg shadow-orange-200/50 md:rounded-3xl">

                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-12 -left-8 h-28 w-28 rounded-full bg-orange-300/20"></div>
                <div class="absolute right-16 top-8 h-20 w-20 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative flex items-center justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 shadow-inner ring-1 ring-white/20 backdrop-blur-sm">
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

            <form action="#" method="POST">
                @csrf

                <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_380px]">

                    {{-- LEFT --}}
                    <div class="space-y-6">

                        {{-- ALAMAT PENGIRIMAN --}}
                        <div class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                            <div class="border-b border-[#F1DCC8] px-5 py-4 sm:px-6">
                                <div class="flex items-center justify-between gap-3">

                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
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

                                    <button type="button"
                                        class="text-xs font-semibold text-[#FF6B00] hover:text-[#C1440E]">
                                        Ubah
                                    </button>

                                </div>
                            </div>

                            <div class="p-5 sm:p-6">

                                <div class="rounded-2xl border border-[#FFD5B8] bg-[#FFF9F4] p-4">

                                    <div class="flex items-start justify-between gap-4">

                                        <div>
                                            <div class="flex items-center gap-2">
                                                <p class="text-sm font-bold text-[#3B2115]">
                                                    Budi Santoso
                                                </p>

                                                <span class="rounded-full bg-[#FFE0CA] px-2 py-0.5 text-[10px] font-semibold text-[#C1440E]">
                                                    Utama
                                                </span>
                                            </div>

                                            <p class="mt-1 text-xs leading-5 text-[#72594B]">
                                                0812-3456-7890
                                            </p>

                                            <p class="mt-2 text-sm leading-6 text-[#72594B]">
                                                Jl. Contoh No. 123, Kelurahan Sumbersari,
                                                Kecamatan Sumbersari, Kabupaten Jember,
                                                Jawa Timur 68121
                                            </p>
                                        </div>

                                        <i class="fa-solid fa-circle-check shrink-0 text-[#FF6B00]"></i>

                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- PRODUK --}}
                        <div class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                            <div class="border-b border-[#F1DCC8] px-5 py-4 sm:px-6">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
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

                                {{-- PRODUK 1 --}}
                                <div class="flex gap-4 p-5 sm:p-6">

                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-2xl bg-[#FFF1E5] sm:h-24 sm:w-24">
                                        <img
                                            src="{{ asset('images/default-product.jpg') }}"
                                            alt="Produk"
                                            class="h-full w-full object-cover">
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-start justify-between gap-3">

                                            <div>
                                                <p class="text-sm font-semibold text-[#3B2115]">
                                                    Ayam Geprek Sambal Matah
                                                </p>

                                                <p class="mt-1 text-xs text-[#A58C7D]">
                                                    Dapur Bu Siti
                                                </p>
                                            </div>

                                            <p class="shrink-0 text-sm font-bold text-[#C1440E]">
                                                Rp25.000
                                            </p>

                                        </div>

                                        <div class="mt-4 flex items-center justify-between">

                                            <p class="text-xs text-[#72594B]">
                                                1 produk
                                            </p>

                                            <p class="text-xs font-medium text-[#72594B]">
                                                Qty: 1
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- PRODUK 2 --}}
                                <div class="flex gap-4 p-5 sm:p-6">

                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-2xl bg-[#FFF1E5] sm:h-24 sm:w-24">
                                        <img
                                            src="{{ asset('images/default-product.jpg') }}"
                                            alt="Produk"
                                            class="h-full w-full object-cover">
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-start justify-between gap-3">

                                            <div>
                                                <p class="text-sm font-semibold text-[#3B2115]">
                                                    Keripik Pisang Coklat
                                                </p>

                                                <p class="mt-1 text-xs text-[#A58C7D]">
                                                    UMKM Lokal Jember
                                                </p>
                                            </div>

                                            <p class="shrink-0 text-sm font-bold text-[#C1440E]">
                                                Rp18.000
                                            </p>

                                        </div>

                                        <div class="mt-4 flex items-center justify-between">

                                            <p class="text-xs text-[#72594B]">
                                                1 produk
                                            </p>

                                            <p class="text-xs font-medium text-[#72594B]">
                                                Qty: 2
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- CATATAN --}}
                        <div class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
                                    <i class="fa-regular fa-note-sticky"></i>
                                </div>

                                <div>
                                    <h2 class="text-base font-bold text-[#3B2115]">
                                        Catatan Pesanan
                                    </h2>

                                    <p class="text-xs text-[#A58C7D]">
                                        Tambahkan catatan untuk penjual
                                    </p>
                                </div>
                            </div>

                            <textarea
                                name="catatan"
                                rows="3"
                                placeholder="Contoh: Tolong jangan terlalu pedas..."
                                class="mt-4 w-full resize-none rounded-2xl border border-[#E9D7C9] bg-[#FFF9F4] px-4 py-3 text-sm text-[#3B2115] placeholder-[#A58C7D] outline-none transition focus:border-[#FF6B00] focus:ring-2 focus:ring-[#FFD1AD]"></textarea>

                        </div>


                        {{-- PEMBAYARAN --}}
                        <div class="rounded-3xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#FF6B00]">
                                    <i class="fa-solid fa-wallet"></i>
                                </div>

                                <div>
                                    <h2 class="text-base font-bold text-[#3B2115]">
                                        Metode Pembayaran
                                    </h2>

                                    <p class="text-xs text-[#A58C7D]">
                                        Pilih metode pembayaran
                                    </p>
                                </div>

                            </div>


                            <div class="mt-5 space-y-3">

                                <label class="relative block cursor-pointer">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="cod"
                                        class="peer sr-only"
                                        checked>

                                    <span class="flex items-center justify-between rounded-2xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FFD5B8] peer-checked:bg-[#FFF1E5]">

                                        <span class="flex items-center gap-3">

                                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF7F0] text-[#FF6B00]">
                                                <i class="fa-solid fa-money-bill-wave"></i>
                                            </span>

                                            <span>
                                                <span class="block text-sm font-semibold text-[#3B2115]">
                                                    Cash On Delivery
                                                </span>

                                                <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                                    Bayar saat pesanan diterima
                                                </span>
                                            </span>

                                        </span>

                                        <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] bg-white text-transparent transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                            <i class="fa-solid fa-check text-[8px]"></i>
                                        </span>

                                    </span>
                                </label>


                                <label class="relative block cursor-pointer">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="bank_transfer"
                                        class="peer sr-only">

                                    <span class="flex items-center justify-between rounded-2xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FFD5B8] peer-checked:bg-[#FFF1E5]">

                                        <span class="flex items-center gap-3">

                                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF7F0] text-[#FF6B00]">
                                                <i class="fa-solid fa-building-columns"></i>
                                            </span>

                                            <span>
                                                <span class="block text-sm font-semibold text-[#3B2115]">
                                                    Transfer Bank
                                                </span>

                                                <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                                    Transfer melalui rekening bank
                                                </span>
                                            </span>

                                        </span>

                                        <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] bg-white text-transparent transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                            <i class="fa-solid fa-check text-[8px]"></i>
                                        </span>

                                    </span>
                                </label>


                                <label class="relative block cursor-pointer">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="ewallet"
                                        class="peer sr-only">

                                    <span class="flex items-center justify-between rounded-2xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FFD5B8] peer-checked:bg-[#FFF1E5]">

                                        <span class="flex items-center gap-3">

                                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF7F0] text-[#FF6B00]">
                                                <i class="fa-solid fa-mobile-screen-button"></i>
                                            </span>

                                            <span>
                                                <span class="block text-sm font-semibold text-[#3B2115]">
                                                    E-Wallet
                                                </span>

                                                <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                                    DANA, OVO, GoPay, dan lainnya
                                                </span>
                                            </span>

                                        </span>

                                        <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] bg-white text-transparent transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                            <i class="fa-solid fa-check text-[8px]"></i>
                                        </span>

                                    </span>
                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- RIGHT : RINGKASAN --}}
                    <aside class="lg:sticky lg:top-24">

                        <div class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                            {{-- HEADER --}}
                            <div class="relative overflow-hidden bg-gradient-to-br from-orange-400 to-orange-600 px-5 py-5 text-white">

                                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-white/10"></div>
                                <div class="absolute -bottom-8 -left-5 h-16 w-16 rounded-full bg-orange-300/20"></div>

                                <div class="relative flex items-center gap-3">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm ring-1 ring-white/20">
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


                            {{-- SUMMARY --}}
                            <div class="p-5 sm:p-6">

                                <div class="space-y-3">

                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-[#72594B]">
                                            Total Produk
                                        </span>

                                        <span class="font-medium text-[#3B2115]">
                                            Rp61.000
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-[#72594B]">
                                            Ongkos Kirim
                                        </span>

                                        <span class="font-medium text-[#3B2115]">
                                            Rp10.000
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
                                            Rp71.000
                                        </p>
                                    </div>

                                    <span class="rounded-full bg-[#FFF1E5] px-3 py-1 text-[10px] font-semibold text-[#C1440E]">
                                        3 Produk
                                    </span>

                                </div>


                                <button
                                    type="submit"
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

@endsection