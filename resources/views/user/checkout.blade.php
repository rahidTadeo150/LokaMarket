@extends('layouts.customer')

@section('title', 'Checkout - LokaMarket')

@section('content')

@php

    $items = $produk->isNotEmpty() ? $produk : $fallbackItems;

    $shippingCost = 10000;

    $subtotal = $items->sum('harga');
@endphp


<main class="mx-auto max-w-6xl px-4 py-7 sm:px-8 sm:py-10">

      @include('components.checkout-progress', ['step' =>2 ])

          

  <div class="mx-auto w-full max-w-[1300px]">

    <div class="mb-5">
        <h1 class="text-2xl font-extrabold tracking-tight text-[#3d281e] sm:text-3xl">
            Checkout
        </h1>

        <p class="mt-1 text-[10px] text-[#806e64] sm:text-[11px]">
            Lengkapi detail pesananmu sebelum lanjut ke pembayaran.
        </p>
    </div>

    <form
        action="{{ route('cust.invoice') }}"
        method="GET"
        class="rounded-2xl border border-[#f0dfd1] bg-white px-8 py-6 shadow-[0_12px_35px_rgba(92,48,20,0.04)]"
    >
            {{-- ========================= --}}
            {{-- ALAMAT PENGIRIMAN --}}
            {{-- ========================= --}}
            <section class="border-b border-[#f3e8e0] pb-5">

                <div class="flex items-center justify-between">

                    <h2 class="text-[14px] font-extrabold">
                        Alamat Pengiriman
                    </h2>

                    <a
                        href="{{ route('cust.editProfile') }}"
                        class="text-[10px] font-bold text-[#d94d0b]"
                    >
                        Ubah
                    </a>
                </div>

                <div class="mt-4 flex gap-3 text-[11px]">

                    <i
                        class="fa-solid fa-location-dot mt-0.5 text-[#e9520d]"
                    ></i>

                    <div class="min-w-0">

                        <p class="text-base font-bold text-[#493329]">

                            {{ $user->username }}

                            <span class="font-normal text-[#a18d82]">
                                &middot;
                                {{ $user->no_telp ?: 'Nomor belum diisi' }}
                            </span>

                        </p>

                        <p class="mt-1 leading-5 text-[#806e64]">
                            {{ $user->alamat ?: 'Alamat belum diisi. Silakan lengkapi profil sebelum memesan.' }}
                        </p>

                    </div>

                </div>

            </section>


            {{-- ========================= --}}
            {{-- RINGKASAN PRODUK --}}
            {{-- ========================= --}}
            <section class="border-b border-[#f3e8e0] py-5">

                <h2 class="text-[12px] font-extrabold">
                    Ringkasan Produk
                </h2>


                <div class="mt-4 space-y-4">

                    @foreach ($items as $item)

                        <div class="flex items-center gap-3">

                            {{-- Gambar --}}
                            @if ($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->nama }}"
                                    class="h-14 w-14 shrink-0 rounded-xl object-cover"
                                >

                            @else

                                <div
                                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#fff0df] text-[#e9520d]"
                                >
                                    <i class="fa-solid fa-basket-shopping text-base"></i>
                                </div>

                            @endif


                            {{-- Informasi Produk --}}
                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate text-[11px] font-bold text-[#4b3429]"
                                >
                                    {{ $item->nama }}
                                </p>

                                <p class="text-[10px] text-[#9c877c]">
                                    {{ $item->toko->nama_toko ?? 'Penjual lokal' }}
                                    &middot; 1 pcs
                                </p>

                            </div>


                            {{-- Harga --}}
                            <p
                                class="text-[11px] font-extrabold text-[#c9470e]"
                            >
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>

                        </div>

                    @endforeach

                </div>


                {{-- Catatan --}}
                <div
                    class="mt-5 flex items-center gap-2 rounded-lg bg-[#fff8f1] px-3 py-3"
                >

                    <i class="fa-solid fa-pen text-[10px] text-[#da5a17]"></i>

                    <input
                        name="catatan"
                        type="text"
                        placeholder="Tambahkan catatan untuk penjual (opsional)"
                        class="min-w-0 flex-1 bg-transparent text-[10px] outline-none placeholder:text-[#a99487]"
                    >

                </div>

            </section>


            {{-- ========================= --}}
            {{-- METODE PENGIRIMAN --}}
            {{-- ========================= --}}
            <fieldset class="border-b border-[#f3e8e0] py-5">

                <legend class="text-[12px] font-extrabold">
                    Metode Pengiriman
                </legend>


                {{-- Reguler --}}
                <label
                    class="mt-4 flex cursor-pointer items-start gap-3 text-[11px]"
                >

                    <input
                        type="radio"
                        name="pengiriman"
                        value="reguler"
                        checked
                        class="mt-0.5 accent-[#e9520d]"
                    >

                    <span class="flex-1">

                        <strong class="block">
                            Reguler
                        </strong>

                        <small class="text-[10px] text-[#9c877c]">
                            Estimasi tiba 2-3 hari
                        </small>

                    </span>

                    <strong>
                        Rp 10.000
                    </strong>

                </label>


                {{-- Express --}}
                <label
                    class="mt-4 flex cursor-pointer items-start gap-3 text-[11px]"
                >

                    <input
                        type="radio"
                        name="pengiriman"
                        value="express"
                        class="mt-0.5 accent-[#e9520d]"
                    >

                    <span class="flex-1">

                        <strong class="block">
                            Express
                        </strong>

                        <small class="text-[10px] text-[#9c877c]">
                            Estimasi tiba besok
                        </small>

                    </span>

                    <strong>
                        Rp 20.000
                    </strong>

                </label>

            </fieldset>


            {{-- ========================= --}}
            {{-- METODE PEMBAYARAN --}}
            {{-- ========================= --}}
            <fieldset class="border-b border-[#f3e8e0] py-5">

                <legend class="text-[12px] font-extrabold">
                    Metode Pembayaran
                </legend>


                {{-- Transfer --}}
                <label
                    class="mt-4 flex cursor-pointer items-start gap-3 text-[11px]"
                >

                    <input
                        type="radio"
                        name="pembayaran"
                        value="transfer"
                        checked
                        class="mt-0.5 accent-[#e9520d]"
                    >

                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-md bg-[#fff1e7] text-[#e9520d]"
                    >
                        <i class="fa-regular fa-credit-card text-[10px]"></i>
                    </span>

                    <span>

                        <strong class="block">
                            Transfer Bank
                        </strong>

                        <small class="text-[10px] text-[#9c877c]">
                            BCA, BNI, Mandiri
                        </small>

                    </span>

                </label>


                {{-- E-Wallet --}}
                <label
                    class="mt-4 flex cursor-pointer items-start gap-3 text-[11px]"
                >

                    <input
                        type="radio"
                        name="pembayaran"
                        value="ewallet"
                        class="mt-0.5 accent-[#e9520d]"
                    >

                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-md bg-[#fff1e7] text-[#e9520d]"
                    >
                        <i class="fa-solid fa-wallet text-[10px]"></i>
                    </span>

                    <span>

                        <strong class="block">
                            E-Wallet
                        </strong>

                        <small class="text-[10px] text-[#9c877c]">
                            GoPay, OVO, Dana
                        </small>

                    </span>

                </label>


                {{-- COD --}}
                <label
                    class="mt-4 flex cursor-pointer items-start gap-3 text-[11px]"
                >

                    <input
                        type="radio"
                        name="pembayaran"
                        value="cod"
                        class="mt-0.5 accent-[#e9520d]"
                    >

                    <span
                        class="flex h-6 w-6 items-center justify-center rounded-md bg-[#fff1e7] text-[#e9520d]"
                    >
                        <i class="fa-solid fa-box text-[10px]"></i>
                    </span>

                    <span>

                        <strong class="block">
                            Bayar di Tempat (COD)
                        </strong>

                        <small class="text-[10px] text-[#9c877c]">
                            Bayar saat barang tiba
                        </small>

                    </span>

                </label>

            </fieldset>


            {{-- ========================= --}}
            {{-- RINGKASAN BELANJA --}}
            {{-- ========================= --}}
            <section class="pt-5">

                <h2 class="text-[12px] font-extrabold">
                    Ringkasan Belanja
                </h2>


                <dl class="mt-3 space-y-2 text-[10px] text-[#78655b]">

                    <div class="flex justify-between">

                        <dt>
                            Subtotal Produk
                        </dt>

                        <dd>
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </dd>

                    </div>


                    <div class="flex justify-between">

                        <dt>
                            Ongkos Kirim
                        </dt>

                        <dd>
                            Rp {{ number_format($shippingCost, 0, ',', '.') }}
                        </dd>

                    </div>


                    <div class="flex justify-between">

                        <dt>
                            Biaya Layanan
                        </dt>

                        <dd>
                            Rp 1.000
                        </dd>

                    </div>


                    <div class="flex justify-between">

                        <dt>
                            Diskon Voucher
                        </dt>

                        <dd>
                            -Rp 0
                        </dd>

                    </div>

                </dl>


                {{-- Voucher --}}
                <div
                    class="mt-4 flex items-center gap-2 rounded-lg bg-[#fff8f1] px-3 py-3"
                >

                    <i class="fa-solid fa-ticket text-[10px] text-[#da5a17]"></i>

                    <input
                        name="voucher"
                        type="text"
                        placeholder="Masukkan kode voucher"
                        class="min-w-0 flex-1 bg-transparent text-[10px] outline-none placeholder:text-[#a99487]"
                    >

                    <button
                        type="button"
                        class="text-[10px] font-bold text-[#d34c10]"
                    >
                        Pakai
                    </button>

                </div>


                {{-- Total --}}
                <div
                    class="mt-4 flex items-center justify-between border-t border-[#f3e8e0] pt-4"
                >

                    <span class="text-[12px] font-extrabold">
                        Total Pembayaran
                    </span>

                    <strong class="text-base font-extrabold text-[#d94d0b]">
                        Rp {{ number_format($subtotal + $shippingCost + 1000, 0, ',', '.') }}
                    </strong>

                </div>


                {{-- Tombol --}}
                <button
                    type="submit"
                    class="mt-5 flex h-11 w-full items-center justify-center rounded-full bg-[#e9520d] text-[11px] font-bold text-white shadow-sm transition hover:bg-[#cf4609]"
                >
                    Buat Pesanan
                </button>


                <p class="mt-3 text-center text-[9px] leading-4 text-[#a38e82]">

                    Dengan membuat pesanan, kamu menyetujui
                    <br>

                    <span class="font-bold text-[#d34c10]">
                        Syarat & Ketentuan LokaMarket
                    </span>

                </p>

            </section>

        </form>

    </div>

</main>

@endsection