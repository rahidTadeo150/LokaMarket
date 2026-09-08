@extends('layouts.customer')

@section('title', 'Checkout - LokaMarket')

@section('content')

@php
    $items = $produk->isNotEmpty() ? $produk : $fallbackItems;

    $shippingCost = 10000;
    $serviceFee = 1000;
    $subtotal = $items->sum('harga');

    $totalPayment = $subtotal + $shippingCost + $serviceFee;
@endphp

<div class="mx-auto max-w-7xl px-4 py-7 sm:px-8 sm:py-10">

    {{-- Progress Checkout --}}
    @include('components.checkout-progress', ['step' => 2])

    <div class="mx-auto w-full max-w-[1300px]">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold tracking-tight text-[#3d281e]">
                Checkout
            </h1>

            <p class="mt-2 text-[12px] text-[#806e64]">
                Lengkapi detail pesananmu sebelum lanjut ke pembayaran.
            </p>
        </div>


        {{-- CARD CHECKOUT --}}
        <form
            action="{{ route('cust.invoice') }}"
            method="GET"
         {{-- ===================================================== --}}
{{-- ALAMAT PENGIRIMAN --}}
{{-- ===================================================== --}}
<section class="border-b border-[#f3e8e0] pb-7">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <h2 class="text-[16px] font-extrabold text-[#3d281e]">
            Alamat Pengiriman
        </h2>

        <a
            href="{{ route('cust.editProfile') }}"
            class="rounded-lg px-3 py-2 text-[12px] font-bold text-[#d94d0b] transition hover:bg-[#fff5ef] hover:text-[#b83d08]"
        >
            Ubah
        </a>

    </div>


    {{-- Informasi Alamat --}}
    <div class="mt-6 flex gap-5">

        {{-- Icon Lokasi --}}
        <div
            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#fff1e7]"
        >
            <i class="fa-solid fa-location-dot text-[18px] text-[#e9520d]"></i>
        </div>


        {{-- Detail User --}}
        <div class="min-w-0 flex-1">

            {{-- Nama + Nomor Telepon --}}
            <div class="flex flex-wrap items-center gap-x-3 gap-y-1">

                <p class="text-[15px] font-extrabold text-[#493329]">
                    {{ $user->username }}
                </p>

                <span class="text-[13px] text-[#a18d82]">
                    {{ $user->no_telp ?: 'Nomor belum diisi' }}
                </span>

            </div>


            {{-- Alamat --}}
            <p class="mt-2 max-w-4xl text-[13px] leading-6 text-[#806e64]">
                {{ $user->alamat ?: 'Alamat belum diisi. Silakan lengkapi profil sebelum memesan.' }}
            </p>

        </div>

    </div>

</section>



          {{-- ===================================================== --}}
{{-- RINGKASAN PRODUK --}}
{{-- ===================================================== --}}
<section class="border-b border-[#f3e8e0] py-7">

    {{-- Judul --}}
    <div class="flex items-center justify-between">
        <h2 class="text-[16px] font-extrabold text-[#3d281e]">
            Ringkasan Produk
        </h2>

        <span class="text-[11px] text-[#9c877c]">
            {{ $items->count() }} Produk
        </span>
    </div>


    {{-- Daftar Produk --}}
    <div class="mt-6 divide-y divide-[#f5e9e1]">

        @foreach ($items as $item)

            <div class="flex items-center gap-5 py-5 first:pt-0 last:pb-0">

                {{-- ========================= --}}
                {{-- GAMBAR PRODUK --}}
                {{-- ========================= --}}
                @if ($item->gambar)

                    <img
                        src="{{ asset('storage/' . $item->gambar) }}"
                        alt="{{ $item->nama }}"
                        class="h-20 w-20 shrink-0 rounded-2xl object-cover"
                    >

                @else

                    <div
                        class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#fff0df] text-[#e9520d]"
                    >
                        <i class="fa-solid fa-basket-shopping text-xl"></i>
                    </div>

                @endif


                {{-- ========================= --}}
                {{-- INFORMASI PRODUK --}}
                {{-- ========================= --}}
                <div class="min-w-0 flex-1">

                    <p class="text-[14px] font-bold leading-5 text-[#493329]">
                        {{ $item->nama }}
                    </p>

                    <p class="mt-2 text-[12px] text-[#9c877c]">
                        {{ $item->toko->nama_toko ?? 'Penjual lokal' }}
                    </p>

                    <div class="mt-2 flex items-center gap-2">

                        <span class="rounded-md bg-[#fff4ec] px-2 py-1 text-[10px] font-medium text-[#d95a17]">
                            Produk Lokal
                        </span>

                        <span class="text-[11px] text-[#a18d82]">
                            1 pcs
                        </span>

                    </div>

                </div>


                {{-- ========================= --}}
                {{-- HARGA --}}
                {{-- ========================= --}}
                <div class="shrink-0 text-right">

                    <p class="text-[15px] font-extrabold text-[#c9470e]">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>

                    <p class="mt-1 text-[10px] text-[#a18d82]">
                        Harga produk
                    </p>

                </div>

            </div>

        @endforeach

    </div>


    {{-- ========================= --}}
    {{-- CATATAN UNTUK PENJUAL --}}
    {{-- ========================= --}}
    <div
        class="mt-7 flex min-h-[50px] items-center gap-3 rounded-xl border border-[#f3e5dc] bg-[#fffaf6] px-4 py-3"
    >

        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#fff0e5]">
            <i class="fa-solid fa-pen text-[11px] text-[#da5a17]"></i>
        </div>

        <input
            name="catatan"
            type="text"
            placeholder="Tambahkan catatan untuk penjual (opsional)"
            class="min-w-0 flex-1 bg-transparent text-[12px] text-[#493329] outline-none placeholder:text-[#a99487]"
        >

    </div>

</section>



            {{-- ===================================================== --}}
            {{-- METODE PENGIRIMAN --}}
            {{-- ===================================================== --}}
            <fieldset class="border-b border-[#f3e8e0] py-6">

                <legend class="text-[15px] font-extrabold text-[#3d281e]">
                    Metode Pengiriman
                </legend>


                {{-- Reguler --}}
                <label
                    class="mt-5 flex cursor-pointer items-center gap-4 rounded-xl border border-[#f3e8e0] px-4 py-4 transition hover:border-[#f1b28a] hover:bg-[#fffaf6]"
                >

                    <input
                        type="radio"
                        name="pengiriman"
                        value="reguler"
                        checked
                        class="h-4 w-4 accent-[#e9520d]"
                    >

                    <div class="flex-1">

                        <strong class="block text-[12px] text-[#493329]">
                            Reguler
                        </strong>

                        <small class="mt-1 block text-[11px] text-[#9c877c]">
                            Estimasi tiba 2-3 hari
                        </small>

                    </div>

                    <strong class="text-[12px] text-[#493329]">
                        Rp 10.000
                    </strong>

                </label>


                {{-- Express --}}
                <label
                    class="mt-3 flex cursor-pointer items-center gap-4 rounded-xl border border-[#f3e8e0] px-4 py-4 transition hover:border-[#f1b28a] hover:bg-[#fffaf6]"
                >

                    <input
                        type="radio"
                        name="pengiriman"
                        value="express"
                        class="h-4 w-4 accent-[#e9520d]"
                    >

                    <div class="flex-1">

                        <strong class="block text-[12px] text-[#493329]">
                            Express
                        </strong>

                        <small class="mt-1 block text-[11px] text-[#9c877c]">
                            Estimasi tiba besok
                        </small>

                    </div>

                    <strong class="text-[12px] text-[#493329]">
                        Rp 20.000
                    </strong>

                </label>

            </fieldset>



            {{-- ===================================================== --}}
            {{-- METODE PEMBAYARAN --}}
            {{-- ===================================================== --}}
            <fieldset class="border-b border-[#f3e8e0] py-6">

                <legend class="text-[15px] font-extrabold text-[#3d281e]">
                    Metode Pembayaran
                </legend>


                {{-- Transfer --}}
                <label
                    class="mt-5 flex cursor-pointer items-center gap-4 rounded-xl border border-[#f3e8e0] px-4 py-4 transition hover:border-[#f1b28a] hover:bg-[#fffaf6]"
                >

                    <input
                        type="radio"
                        name="pembayaran"
                        value="transfer"
                        checked
                        class="h-4 w-4 accent-[#e9520d]"
                    >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#fff1e7] text-[#e9520d]"
                    >
                        <i class="fa-regular fa-credit-card text-sm"></i>
                    </span>

                    <span>

                        <strong class="block text-[12px] text-[#493329]">
                            Transfer Bank
                        </strong>

                        <small class="mt-1 block text-[11px] text-[#9c877c]">
                            BCA, BNI, Mandiri
                        </small>

                    </span>

                </label>


                {{-- E-Wallet --}}
                <label
                    class="mt-3 flex cursor-pointer items-center gap-4 rounded-xl border border-[#f3e8e0] px-4 py-4 transition hover:border-[#f1b28a] hover:bg-[#fffaf6]"
                >

                    <input
                        type="radio"
                        name="pembayaran"
                        value="ewallet"
                        class="h-4 w-4 accent-[#e9520d]"
                    >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#fff1e7] text-[#e9520d]"
                    >
                        <i class="fa-solid fa-wallet text-sm"></i>
                    </span>

                    <span>

                        <strong class="block text-[12px] text-[#493329]">
                            E-Wallet
                        </strong>

                        <small class="mt-1 block text-[11px] text-[#9c877c]">
                            GoPay, OVO, Dana
                        </small>

                    </span>

                </label>


                {{-- COD --}}
                <label
                    class="mt-3 flex cursor-pointer items-center gap-4 rounded-xl border border-[#f3e8e0] px-4 py-4 transition hover:border-[#f1b28a] hover:bg-[#fffaf6]"
                >

                    <input
                        type="radio"
                        name="pembayaran"
                        value="cod"
                        class="h-4 w-4 accent-[#e9520d]"
                    >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#fff1e7] text-[#e9520d]"
                    >
                        <i class="fa-solid fa-box text-sm"></i>
                    </span>

                    <span>

                        <strong class="block text-[12px] text-[#493329]">
                            Bayar di Tempat (COD)
                        </strong>

                        <small class="mt-1 block text-[11px] text-[#9c877c]">
                            Bayar saat barang tiba
                        </small>

                    </span>

                </label>

            </fieldset>



            {{-- ===================================================== --}}
            {{-- RINGKASAN BELANJA --}}
            {{-- ===================================================== --}}
            <section class="pt-6">

                <h2 class="text-[15px] font-extrabold text-[#3d281e]">
                    Ringkasan Belanja
                </h2>


                <dl class="mt-4 space-y-3 text-[12px] text-[#78655b]">

                    <div class="flex justify-between">

                        <dt>
                            Subtotal Produk
                        </dt>

                        <dd class="font-medium">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </dd>

                    </div>


                    <div class="flex justify-between">

                        <dt>
                            Ongkos Kirim
                        </dt>

                        <dd class="font-medium">
                            Rp {{ number_format($shippingCost, 0, ',', '.') }}
                        </dd>

                    </div>


                    <div class="flex justify-between">

                        <dt>
                            Biaya Layanan
                        </dt>

                        <dd class="font-medium">
                            Rp {{ number_format($serviceFee, 0, ',', '.') }}
                        </dd>

                    </div>


                    <div class="flex justify-between">

                        <dt>
                            Diskon Voucher
                        </dt>

                        <dd class="font-medium">
                            -Rp 0
                        </dd>

                    </div>

                </dl>


                {{-- Voucher --}}
                <div
                    class="mt-5 flex min-h-[44px] items-center gap-3 rounded-xl bg-[#fff8f1] px-4 py-3"
                >

                    <i class="fa-solid fa-ticket text-[12px] text-[#da5a17]"></i>

                    <input
                        name="voucher"
                        type="text"
                        placeholder="Masukkan kode voucher"
                        class="min-w-0 flex-1 bg-transparent text-[11px] outline-none placeholder:text-[#a99487]"
                    >

                    <button
                        type="button"
                        class="text-[11px] font-bold text-[#d34c10] hover:text-[#b83d08]"
                    >
                        Pakai
                    </button>

                </div>


                {{-- Total --}}
                <div
                    class="mt-6 flex items-center justify-between border-t border-[#f3e8e0] pt-5"
                >

                    <span class="text-[14px] font-extrabold text-[#3d281e]">
                        Total Pembayaran
                    </span>

                    <strong class="text-lg font-extrabold text-[#d94d0b]">
                        Rp {{ number_format($totalPayment, 0, ',', '.') }}
                    </strong>

                </div>


                {{-- Tombol --}}
                <button
                    type="submit"
                    class="mt-6 flex h-12 w-full items-center justify-center rounded-full bg-[#e9520d] text-[12px] font-bold text-white shadow-sm transition hover:bg-[#cf4609]"
                >
                    Buat Pesanan
                </button>


                <p class="mt-4 text-center text-[10px] leading-5 text-[#a38e82]">

                    Dengan membuat pesanan, kamu menyetujui
                    <br>

                    <span class="font-bold text-[#d34c10]">
                        Syarat & Ketentuan LokaMarket
                    </span>

                </p>

            </section>

        </form>

    </div>

</div>

@endsection