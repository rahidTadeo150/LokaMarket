@extends('layouts.customer')

@section('title', 'Tahu Walik - LokaMarket')

@section('content')

    <div class="min-h-screen bg-[#FFF9F2]">
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
                            src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=900&q=80"
                            alt="Tahu Walik"
                            class="w-full aspect-square object-cover">
                        <button type="button"
                                class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white shadow-md flex items-center justify-center text-slate-600 hover:text-orange-500 hover:scale-105 transition">
                            <i class="fa-regular fa-heart text-lg"></i>
                        </button>

                        {{-- PREVIOUS --}}
                        <button type="button"
                                onclick="previousImage()"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-orange-500 hover:bg-orange-500 hover:text-white transition">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </button>

                        {{-- NEXT --}}
                        <button
                            type="button"
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
                    <span class="inline-flex items-center rounded-full bg-orange-50 border border-orange-100 px-3 py-1.5 text-xs font-semibold text-orange-600">
                        Makanan & Minuman
                    </span>
                    <P class="mt-3 text-3xl lg:text-4xl font-bold text-[#3A2115]">
                        Tahu Walik
                    </P>
                    <div class="flex flex-wrap items-center gap-3 mt-3">
                        <div class="flex items-center gap-0.5 text-orange-500">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star text-sm"></i>
                            @endfor
                        </div>
                        <span class="text-sm font-semibold text-orange-600">
                            4.8
                        </span>
                        <span class="text-sm text-slate-500">
                            (124 Ulasan)
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
                            Rp 12.000
                        </span>
                        <span class="text-sm text-slate-500">
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
                                    <p class="text-xs text-slate-400">
                                        Dijual oleh
                                    </p>
                                    <div class="flex items-center gap-1">
                                        <p class="font-bold text-slate-800">
                                            Dapur Bu Siti
                                        </p>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        Kota Malang, Jawa Timur
                                    </p>
                                </div>
                            </div>
                            <button class="shrink-0 rounded-full border border-orange-500 px-4 py-2 text-xs font-semibold text-orange-600 hover:bg-orange-500 hover:text-white transition">
                                Lihat Toko
                            </button>
                        </div>
                    </div>
                    <div class="mt-5">
                        <p class="text-sm font-semibold text-slate-800 mb-2">
                            Jumlah
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center overflow-hidden rounded-full border border-orange-100 bg-white">
                                <button onclick="decreaseQuantity()"
                                        class="w-10 h-9 text-orange-500 hover:bg-orange-50">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </button>
                                <input id="quantity"
                                        type="number"
                                        value="1"
                                        min="1"
                                        class="w-full h-9 border-x border-orange-50 text-center text-sm font-semibold focus:outline-none">
                                <button onclick="increaseQuantity()"
                                        class="w-10 h-9 text-orange-500 hover:bg-orange-50">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                            <span class="text-sm text-slate-500">
                                Item
                            </span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mt-5">
                        <button class="h-12 rounded-full border border-orange-500 bg-white text-orange-600 font-semibold text-sm hover:bg-orange-50 transition">
                            <i class="fa-solid fa-cart-shopping mr-2"></i>
                            Tambah ke Keranjang
                        </button>
                        <button class="h-12 rounded-full bg-orange-500 text-white font-semibold text-sm hover:bg-orange-600 transition">
                            Beli Sekarang
                        </button>
                    </div>

                    {{-- Other Detail Card --}}
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
                                    2–3 hari kerja
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

                    {{-- Tabs Deskripsi --}}
                    <div class="pt-6">
                        <p class="text-xl font-bold text-[#3A2115]">
                            Deskripsi Produk
                        </p>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            Tahu Walik adalah camilan khas Banyuwangi
                            yang renyah di luar dan kopong di dalam.
                            Cocok sebagai teman makan atau camilan
                            keluarga, maupun oleh-oleh khas daerah.
                        </p>
                    </div>
                </div>

                {{-- Detail Toko Card --}}
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
                                        Dapur Bu Siti
                                    </p>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">
                                    Kota Malang, Jawa Timur
                                </p>
                                <p class="text-xs text-slate-400 mt-1">
                                    Member sejak Jan 2023
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
                                    250+
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
            <div class="flex items-center justify-between mb-5">
                <p class="text-xl font-bold text-[#3A2115]">
                    Produk Lainnya dari Penjual
                </p>
                <a href="#"
                    class="text-sm font-semibold text-orange-600">
                    Lihat Semua
                    <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="group bg-white border border-orange-100 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1621939514649-280e2aaacb3b?auto=format&fit=crop&w=600&q=80"
                            class="w-full aspect-[1.05] object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 rounded-md bg-red-500 px-2 py-1 text-[10px] font-bold text-white">
                            Terlaris
                        </span>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold text-sm text-slate-800">
                            Ayam Suwir Pedas
                        </p>
                        <p class="mt-2 font-bold text-orange-600 text-sm">
                            Rp 18.000
                            <span class="font-normal text-xs text-slate-400">
                                / item
                            </span>
                        </p>
                        <div class="flex items-center gap-1 mt-3">
                            <i class="fa-solid fa-star text-orange-500 text-xs"></i>
                            <span class="text-xs text-slate-500">
                                4.9
                            </span>
                            <span class="text-xs text-slate-400">
                                (86)
                            </span>
                        </div>
                    </div>
                </div>
                <div class="group bg-white border border-orange-100 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1621939514649-280e2aaacb3b?auto=format&fit=crop&w=600&q=80"
                            class="w-full aspect-[1.05] object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 rounded-md bg-red-500 px-2 py-1 text-[10px] font-bold text-white">
                            Terlaris
                        </span>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold text-sm text-slate-800">
                            Ayam Suwir Pedas
                        </p>
                        <p class="mt-2 font-bold text-orange-600 text-sm">
                            Rp 18.000
                            <span class="font-normal text-xs text-slate-400">
                                / item
                            </span>
                        </p>
                        <div class="flex items-center gap-1 mt-3">
                            <i class="fa-solid fa-star text-orange-500 text-xs"></i>
                            <span class="text-xs text-slate-500">
                                4.9
                            </span>
                            <span class="text-xs text-slate-400">
                                (86)
                            </span>
                        </div>
                    </div>
                </div>
                <div class="group bg-white border border-orange-100 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1621939514649-280e2aaacb3b?auto=format&fit=crop&w=600&q=80"
                            class="w-full aspect-[1.05] object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 rounded-md bg-red-500 px-2 py-1 text-[10px] font-bold text-white">
                            Terlaris
                        </span>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold text-sm text-slate-800">
                            Ayam Suwir Pedas
                        </p>
                        <p class="mt-2 font-bold text-orange-600 text-sm">
                            Rp 18.000
                            <span class="font-normal text-xs text-slate-400">
                                / item
                            </span>
                        </p>
                        <div class="flex items-center gap-1 mt-3">
                            <i class="fa-solid fa-star text-orange-500 text-xs"></i>
                            <span class="text-xs text-slate-500">
                                4.9
                            </span>
                            <span class="text-xs text-slate-400">
                                (86)
                            </span>
                        </div>
                    </div>
                </div>
                <div class="group bg-white border border-orange-100 rounded-2xl overflow-hidden hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1621939514649-280e2aaacb3b?auto=format&fit=crop&w=600&q=80"
                            class="w-full aspect-[1.05] object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 rounded-md bg-red-500 px-2 py-1 text-[10px] font-bold text-white">
                            Terlaris
                        </span>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold text-sm text-slate-800">
                            Ayam Suwir Pedas
                        </p>
                        <p class="mt-2 font-bold text-orange-600 text-sm">
                            Rp 18.000
                            <span class="font-normal text-xs text-slate-400">
                                / item
                            </span>
                        </p>
                        <div class="flex items-center gap-1 mt-3">
                            <i class="fa-solid fa-star text-orange-500 text-xs"></i>
                            <span class="text-xs text-slate-500">
                                4.9
                            </span>
                            <span class="text-xs text-slate-400">
                                (86)
                            </span>
                        </div>
                    </div>
                </div>
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