@extends('layouts.customer')

@section('title', 'Tahu Walik - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F2]">

        <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-6">

            <button type="button"
                    onclick="history.back()"
                    class="group inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-orange-600 transition">
                <span class="flex items-center justify-center w-9 h-9 rounded-full bg-white border border-orange-100 shadow-sm group-hover:bg-orange-50 group-hover:border-orange-200 transition">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </span>
                <span>
                    Kembali
                </span>
            </button>

        </div>

        <section class="max-w-7xl mx-auto px-5 lg:px-8 pt-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">

                <div>

                    <div class="relative overflow-hidden rounded-2xl bg-white border border-orange-100">

                        <img id="mainProductImage"
                            src="{{ asset('storage/' . $produk->gambar) }}"
                            alt="Tahu Walik"
                            class="w-full aspect-square object-cover">

                        <button type="button"
                                class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white shadow-md flex items-center justify-center text-slate-600 hover:text-orange-500 hover:scale-105 transition">
                            <i class="fa-regular fa-heart text-lg"></i>
                        </button>

                        <button type="button"
                                onclick="previousImage()"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-orange-500 hover:bg-orange-500 hover:text-white transition">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </button>

                        <button type="button"
                                onclick="nextImage()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-orange-500 hover:bg-orange-500 hover:text-white transition">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </button>

                    </div>

                    <div class="grid grid-cols-4 gap-3 mt-3">

                        <button onclick="changeImage(0)"
                            class="product-thumbnail border-orange-500 ring-1 ring-orange-500 overflow-hidden rounded-xl border-2">
                            <img src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=400&q=80"
                                class="w-full aspect-square object-cover">
                        </button>

                        <button onclick="changeImage(1)"
                                class="product-thumbnail border-transparent overflow-hidden rounded-xl border-2">
                            <img src="https://images.unsplash.com/photo-1626804475297-41608ea09aeb?auto=format&fit=crop&w=400&q=80"
                                class="w-full aspect-square object-cover">
                        </button>

                        <button onclick="changeImage(2)"
                            class="product-thumbnail border-transparent overflow-hidden rounded-xl border-2">
                            <img src="https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&w=400&q=80"
                                class="w-full aspect-square object-cover">
                        </button>

                        <button onclick="changeImage(3)"
                                class="product-thumbnail border-transparent overflow-hidden rounded-xl border-2">
                            <img src="https://images.unsplash.com/photo-1621939514649-280e2aaacb3b?auto=format&fit=crop&w=400&q=80"
                                class="w-full aspect-square object-cover">
                        </button>

                    </div>
                    
                </div>

                <div>
                    
                    <span class="inline-flex items-center rounded-full bg-orange-50 border border-orange-400 px-3 py-1.5 text-xs font-semibold text-orange-600">
                       {{ $produk->kategori->nama }}
                    </span>

                    <P class="mt-3 text-3xl lg:text-4xl font-bold text-[#3A2115]">
                        {{ $produk->nama }}
                    </P>

                    <div class="flex flex-wrap items-center gap-3 mt-3">

                        <div class="flex items-center gap-0.5 text-orange-500">
                            @for ($i = 1; $i <= 5; $i++)

                                @if ($produk->rating >= $i)
                                    <i class="fa-solid fa-star"></i>

                                @elseif ($produk->rating >= ($i - 0.5))
                                    <i class="fa-solid fa-star-half-stroke"></i>

                                @else
                                    <i class="fa-regular fa-star text-gray-300"></i>

                                @endif

                            @endfor
                        </div>

                        <span class="text-sm font-semibold text-orange-600">
                            {{ number_format($produk->rating ?? 0, 1) }}
                        </span>

                        <span class="text-slate-300">
                            |
                        </span>

                        <span class="text-sm text-slate-500">
                            Terjual 250+
                        </span>

                    </div>

                    <div class="flex items-baseline gap-2 mt-5">

                        <span class="text-3xl lg:text-4xl font-bold text-orange-600">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </span>

                        <span class="text-sm text-black">
                            / Item
                        </span>

                    </div>

                    <div class="mt-6 rounded-2xl border border-orange-100 bg-white p-4">
                        <div class="flex items-center justify-between gap-4">

                            <div class="flex items-center gap-3">

                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                    <i class="fa-solid fa-store text-lg"></i>
                                </div>

                                <div>
                                    <div class="flex items-center gap-1">
                                        <p class="font-bold text-slate-800">
                                            {{ $produk->toko->nama_toko }}
                                        </p>
                                    </div>
                                    <p class="text-xs text-slate-600 mt-0.5">
                                        {{ $produk->toko->alamat }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('cust.detailToko', ['toko' => $produk->toko->slug]) }}" class="shrink-0 inline-flex items-center justify-center rounded-full border border-orange-500 px-4 py-2 text-xs font-semibold text-orange-600 hover:bg-orange-500 hover:text-white transition">
                                Lihat Toko
                            </a>

                        </div>
                    </div>

                    <div class="mt-5 rounded-2xl border border-orange-100 bg-orange-50/40 p-4">
                        <div class="grid grid-cols-3 divide-x divide-orange-100">

                            <div class="flex flex-col items-center px-2 text-center">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-orange-500 shadow-sm">
                                    <i class="fa-solid fa-store text-sm"></i>
                                </div>
                                <p class="mt-2 text-[11px] font-bold text-[#3A2115]">
                                    Produk Lokal
                                </p>
                                <p class="mt-0.5 text-[10px] leading-4 text-slate-500">
                                    Dari UMKM
                                </p>

                            </div>

                            <div class="flex flex-col items-center px-2 text-center">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-orange-500 shadow-sm">
                                    <i class="fa-solid fa-shield-halved text-sm"></i>
                                </div>
                                <p class="mt-2 text-[11px] font-bold text-[#3A2115]">
                                    Belanja Aman
                                </p>
                                <p class="mt-0.5 text-[10px] leading-4 text-slate-500">
                                    Transaksi terpercaya
                                </p>

                            </div>

                            <div class="flex flex-col items-center px-2 text-center">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-orange-500 shadow-sm">
                                    <i class="fa-solid fa-circle-check text-sm"></i>
                                </div>
                                <p class="mt-2 text-[11px] font-bold text-[#3A2115]">
                                    Produk Pilihan
                                </p>
                                <p class="mt-0.5 text-[10px] leading-4 text-slate-500">
                                    Berkualitas
                                </p>

                            </div>

                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-5">

                        <button type="button"
                                onclick="openOrderSheet('cart')"
                                class="h-12 rounded-full border border-orange-500 bg-white text-orange-600 font-semibold text-sm hover:bg-orange-50 transition">
                            <i class="fa-solid fa-cart-shopping mr-2"></i>
                            Tambah ke Keranjang
                        </button>

                        <button type="button" 
                                onclick="openOrderSheet('buy')"
                                class="h-12 rounded-full bg-orange-500 text-white font-semibold text-sm hover:bg-orange-600 transition">
                            Beli Sekarang
                        </button>

                    </div>

                    <div class="grid grid-cols-2 mt-5 rounded-2xl border border-orange-100 bg-white overflow-hidden">

                        <div class="flex items-center gap-3 p-4">

                            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                                <i class="fa-solid fa-truck text-sm"></i>
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-slate-700">
                                    Pengiriman
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    2-3 hari kerja
                                </p>
                            </div>

                        </div>

                        <div class="flex items-center gap-3 p-4 border-l border-orange-100">

                            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                                <i class="fa-solid fa-box text-sm"></i>
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-slate-700">
                                    Kemasan
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Food Grade
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

        {{-- Deskripsi Produk--}}
        <section class="max-w-7xl mx-auto px-5 lg:px-8 mt-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">

                    {{-- Tab --}}
                    <div class="flex items-center gap-8 border-b border-orange-100">
                        <button class="relative pb-4 text-sm font-semibold text-orange-600">
                            Deskripsi
                            <span class="absolute left-0 right-0 -bottom-px h-0.5 bg-orange-500"></span>
                        </button>
                        <button class="pb-4 text-sm text-slate-500 hover:text-orange-500">
                            Ulasan (124)
                        </button>
                        <button class="pb-4 text-sm text-slate-500 hover:text-orange-500">
                            Penjual
                        </button>
                    </div>

                    <div class="pt-6">
                        <p class="text-xl font-bold text-[#3A2115]">
                            Deskripsi Produk
                        </p>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
                </div>

                <aside>
                    <div class="rounded-2xl border border-orange-100 bg-white p-5">
                        <p class="text-lg font-bold text-[#3A2115]">
                            Tentang Penjual
                        </p>
                        <div class="flex items-center gap-3 mt-5">
                            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                <i class="fa-solid fa-store text-xl"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-slate-800">
                                        {{ $produk->toko->nama_toko }}
                                    </p>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $produk->toko->alamat }}
                                </p>
                                <p class="text-xs text-slate-400 mt-1">
                                    Member sejak {{ $produk->toko->created_at->translatedFormat('F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 border-y border-orange-100 py-5 mt-5 text-center">
                            <div>
                                <p class="font-bold text-slate-800">
                                    98%
                                </p>
                                <p class="text-[10px] text-slate-400 mt-1">
                                    Penilaian Positif
                                </p>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">
                                    {{ $jumlahProduk }}
                                </p>
                                <p class="text-[10px] text-slate-400 mt-1">
                                    Produk Terjual
                                </p>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">
                                    1 Jam
                                </p>
                                <p class="text-[10px] text-slate-400 mt-1">
                                    Respon
                                </p>
                            </div>
                        </div>
                        <button class="mt-5 flex items-center justify-center w-full h-11 rounded-full border border-orange-500 text-sm font-semibold text-orange-600 hover:bg-orange-500 hover:text-white transition">
                            Kunjungi Profil Toko
                        </button>
                    </div>
                </aside>
            </div>
        </section>


        {{-- Produk Lainnya Card --}}
        <section class="max-w-7xl mx-auto px-5 lg:px-8 mt-12">
                <p class="text-xl font-bold text-[#3A2115] mb-5">
                    Produk Lainnya dari Penjual
                </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @forelse ($anotherProduk as $item)
                <x-card-produk :produk="$item"/>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <i class="fa-regular fa-face-frown text-4xl text-orange-300"></i>

                        <h3 class="mt-4 text-lg font-bold text-[#3B2115]">
                            Produk belum tersedia
                        </h3>

                        <p class="mt-1 text-sm text-[#72594B]">
                            Belum ada produk yang tersedia saat ini.
                        </p>
                    </div>
                @endforelse

            </div>
        </section>


        {{-- Banner LokaMart --}}
        <section class="max-w-7xl mx-auto px-5 lg:px-8 my-12">
            <div class="rounded-2xl bg-linear-to-r from-orange-600 to-orange-500 px-7 py-8 lg:px-10">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-5">
                        <div class="hidden sm:flex w-16 h-16 rounded-2xl bg-white/15 items-center justify-center text-white">
                            <i class="fa-solid fa-store text-3xl"></i>
                        </div>
                        <div class="text-center sm:text-left">
                            <p class="text-xl lg:text-2xl font-bold text-white">
                                Dukung Produk UMKM Lokal
                            </p>
                            <p class="text-sm text-orange-50 mt-1">
                                Belanja produk berkualitas langsung
                                dari pelaku UMKM di sekitarmu.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('cust.pilihanProduk') }}" 
                        class="shrink-0 px-6 py-3 rounded-full bg-white text-orange-600 text-sm font-semibold hover:bg-orange-50 transition">
                        Jelajahi Produk UMKM
                    </a>
                </div>
            </div>
        </section>
    </main>

    {{-- =========================================================
        ORDER BOTTOM SHEET
    ========================================================= --}}

    <div
        id="orderSheet"
        data-product-id="{{ $produk->id }}"
        data-product-price="{{ $produk->harga }}"
        data-product-stock="{{ $produk->stok }}"
        class="fixed inset-0 z-[100] invisible"
        aria-hidden="true">

        {{-- =====================================================
            BACKDROP
        ====================================================== --}}
        <div
            id="orderBackdrop"
            onclick="closeOrderSheet()"
            class="absolute inset-0 bg-black/40 opacity-0 backdrop-blur-[2px] transition-opacity duration-300">
        </div>


        {{-- =====================================================
            BOTTOM SHEET
        ====================================================== --}}
        <div
            id="orderPanel"
            class="absolute bottom-0 left-0 right-0 translate-y-full transform transition-transform duration-300 ease-out">

            <div class="mx-auto w-full max-w-2xl">

                <div
                    class="overflow-hidden rounded-t-3xl bg-white shadow-2xl">


                    {{-- =================================================
                        HEADER
                    ================================================== --}}
                    <div
                        class="flex items-center justify-between border-b border-orange-100 px-5 py-4">

                        <div>

                            <p class="text-base font-bold text-[#3A2115]">
                                Pilih Pesanan
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Atur jumlah produk yang ingin kamu pesan
                            </p>

                        </div>


                        <button
                            type="button"
                            onclick="closeOrderSheet()"
                            aria-label="Tutup"
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-50 text-orange-500 transition hover:bg-orange-100">

                            <i class="fa-solid fa-xmark"></i>

                        </button>

                    </div>


                    {{-- =================================================
                        PRODUCT
                    ================================================== --}}
                    <div class="px-5 pt-5">

                        <div class="flex gap-4">

                            {{-- Product Image --}}
                            <div
                                class="h-24 w-24 shrink-0 overflow-hidden rounded-2xl border border-orange-100 bg-[#FFF3E5]">

                                @if ($produk->gambar)

                                    <img
                                        id="orderProductImage"
                                        src="{{ asset('storage/' . $produk->gambar) }}"
                                        alt="{{ $produk->nama }}"
                                        class="h-full w-full object-cover">

                                @else

                                    <div
                                        class="flex h-full w-full items-center justify-center">

                                        <i
                                            class="fa-regular fa-image text-2xl text-orange-300">
                                        </i>

                                    </div>

                                @endif

                            </div>


                            {{-- Product Information --}}
                            <div class="min-w-0 flex-1">

                                <h3
                                    class="line-clamp-2 text-sm font-bold leading-5 text-[#3A2115]">

                                    {{ $produk->nama }}

                                </h3>


                                <p
                                    class="mt-2 text-lg font-black text-orange-600">

                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}

                                </p>


                                <p class="mt-1 text-xs text-slate-500">

                                    Stok tersedia:

                                    <span
                                        id="orderStock"
                                        class="font-semibold text-slate-700">

                                        {{ $produk->stok }}

                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        QUANTITY
                    ================================================== --}}
                    <div
                        class="mt-5 border-t border-orange-100 px-5 pt-5">

                        <div
                            class="flex items-center justify-between gap-4">

                            <div>

                                <p
                                    class="text-sm font-bold text-[#3A2115]">

                                    Jumlah

                                </p>

                                <p
                                    class="mt-1 text-xs text-slate-500">

                                    Maksimal
                                    {{ $produk->stok }}
                                    item

                                </p>

                            </div>


                            {{-- Quantity Control --}}
                            <div
                                class="flex shrink-0 items-center overflow-hidden rounded-full border border-orange-200 bg-white">

                                <button
                                    type="button"
                                    onclick="orderDecreaseQuantity()"
                                    aria-label="Kurangi jumlah"
                                    class="flex h-10 w-10 items-center justify-center text-orange-500 transition hover:bg-orange-50">

                                    <i class="fa-solid fa-minus text-xs"></i>

                                </button>


                                <input
                                    id="orderQuantity"
                                    type="number"
                                    value="1"
                                    min="1"
                                    max="{{ $produk->stok }}"
                                    inputmode="numeric"
                                    class="h-10 w-14 border-x border-orange-100 text-center text-sm font-bold text-[#3A2115] focus:outline-none"
                                    oninput="validateOrderQuantity()">


                                <button
                                    type="button"
                                    onclick="orderIncreaseQuantity()"
                                    aria-label="Tambah jumlah"
                                    class="flex h-10 w-10 items-center justify-center text-orange-500 transition hover:bg-orange-50">

                                    <i class="fa-solid fa-plus text-xs"></i>

                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        TOTAL
                    ================================================== --}}
                    <div
                        class="mt-5 border-t border-orange-100 bg-[#FFF9F2] px-5 py-4">

                        <div
                            class="flex items-center justify-between gap-4">

                            <div>

                                <p class="text-xs text-slate-500">
                                    Total Pesanan
                                </p>

                                <p
                                    id="orderTotal"
                                    class="mt-1 text-xl font-black text-orange-600">

                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}

                                </p>

                            </div>


                            <div
                                class="flex shrink-0 items-center gap-2 text-xs text-slate-500">

                                <i
                                    class="fa-solid fa-box text-orange-500">
                                </i>

                                <span id="orderSummary">
                                    1 item
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        ACTION
                    ================================================== --}}
                    <div
                        class="border-t border-orange-100 bg-white px-5 pb-5 pt-4">

                        <div class="flex gap-3">

                            {{-- Batal --}}
                            <button
                                type="button"
                                onclick="closeOrderSheet()"
                                class="h-12 flex-1 rounded-full border border-orange-200 bg-white text-sm font-semibold text-slate-600 transition hover:bg-orange-50">

                                Batal

                            </button>


                            {{-- Submit --}}
                            <button
                                id="orderSubmitButton"
                                type="button"
                                onclick="submitOrder()"
                                class="h-12 flex-[2] rounded-full bg-orange-500 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-600 active:scale-[0.98]">

                                <i
                                    id="orderSubmitIcon"
                                    class="fa-solid fa-cart-shopping mr-2">
                                </i>

                                <span id="orderSubmitText">
                                    Tambah ke Keranjang
                                </span>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        const productImages = [

            "https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=900&q=80",

            "https://images.unsplash.com/photo-1626804475297-41608ea09aeb?auto=format&fit=crop&w=900&q=80",

            "https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&w=900&q=80",

            "https://images.unsplash.com/photo-1621939514649-280e2aaacb3b?auto=format&fit=crop&w=900&q=80"

        ];
        let currentImage = 0;
        function changeImage(index) {
            currentImage = index;
            document.getElementById('mainProductImage').src = productImages[index];
            document.querySelectorAll('.product-thumbnail').forEach((thumbnail, i) => {

                    thumbnail.classList.remove(
                        'border-orange-500',
                        'ring-1',
                        'ring-orange-500'
                    );

                    thumbnail.classList.add(
                        'border-transparent'
                    );


                    if (i === index) {

                        thumbnail.classList.remove(
                            'border-transparent'
                        );

                        thumbnail.classList.add(
                            'border-orange-500',
                            'ring-1',
                            'ring-orange-500'
                        );

                    }

                });

        }


        function nextImage() {

            currentImage =
                (currentImage + 1) %
                productImages.length;

            changeImage(currentImage);

        }


        function previousImage() {

            currentImage =
                (currentImage - 1 + productImages.length) %
                productImages.length;

            changeImage(currentImage);

        }


        function increaseQuantity() {

            const input =
                document.getElementById('quantity');

            input.value =
                parseInt(input.value || 1) + 1;

        }


        function decreaseQuantity() {

            const input =
                document.getElementById('quantity');

            const current =
                parseInt(input.value || 1);

            if (current > 1) {

                input.value = current - 1;

            }

        }

    </script>
@endsection