@extends('layouts.customer')

@section('title', 'Pilihan Produk - LokaMarket')

@section('content')
    {{-- Main Content --}}
    <main class="min-h-screen bg-gray-50">
        {{-- Hero Section --}}
        <section class="bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-12 sm:px-6 sm:py-16 md:py-20">
            <div class="mx-auto max-w-7xl">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl">
                        Produk Pilihan Minggu Ini
                    </h1>
                    <p class="mt-4 text-base text-orange-100 sm:text-lg">
                        Produk terbaik UMKM terpilih yang tepat tinggalkan dari kami
                    </p>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <section class="px-4 py-12 sm:px-6 md:py-16">
            <div class="mx-auto max-w-7xl">
                {{-- Filter & Search Bar --}}
                <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <div class="relative">
                            <input 
                                type="text" 
                                id="searchInput"
                                placeholder="Cari produk pilihan..." 
                                class="w-full rounded-full border border-gray-300 bg-white px-6 py-3 
                                       text-gray-700 placeholder-gray-500 transition focus:border-orange-500 
                                       focus:outline-none focus:ring-2 focus:ring-orange-200"
                            >
                            <button class="absolute right-2 top-1/2 -translate-y-1/2 flex h-8 w-8 
                                         items-center justify-center rounded-full bg-orange-500 
                                         text-white transition hover:bg-orange-600">
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="flex items-center gap-2 rounded-full border border-gray-300 
                                     bg-white px-4 py-3 text-sm font-medium text-gray-700 
                                     transition hover:border-orange-500 hover:text-orange-500"
                                onclick="toggleFilter()">
                            <i class="fa-solid fa-sliders"></i>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-5">
                    {{-- Filter Sidebar --}}
                    <aside id="filterSidebar" class="md:col-span-1 hidden md:block">
                        <x-product-filter></x-product-filter>
                    </aside>

                    {{-- Products Grid --}}
                    <div class="md:col-span-4">
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach($products as $product)
                                <x-product-card :product="$product"></x-product-card>
                            @endforeach
                        </div>

                        {{-- Load More Button --}}
                        <div class="mt-12 flex justify-center">
                            <button class="rounded-full border-2 border-orange-500 px-8 py-3 
                                         font-semibold text-orange-500 transition hover:bg-orange-50">
                                Lihat Semua Produk
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Floating Filter Button (Mobile) --}}
                <div id="filterBackdrop" class="fixed inset-0 z-40 hidden bg-black/40" 
                     onclick="toggleFilter()"></div>
                <div id="mobileFilter" class="fixed bottom-0 left-0 right-0 z-50 hidden max-h-[70vh] 
                     transform rounded-t-2xl bg-white transition-transform duration-300">
                    <div class="sticky top-0 border-b border-gray-200 bg-white px-4 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800">Filter Produk</h3>
                            <button onclick="toggleFilter()" class="text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-xmark text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-y-auto p-4">
                        <x-product-filter></x-product-filter>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Filter Toggle Script --}}
    <script>
        function toggleFilter() {
            const mobileFilter = document.getElementById('mobileFilter');
            const backdrop = document.getElementById('filterBackdrop');
            const filterSidebar = document.getElementById('filterSidebar');
            
            mobileFilter.classList.toggle('hidden');
            backdrop.classList.toggle('hidden');
            
            if (!mobileFilter.classList.contains('hidden')) {
                mobileFilter.style.transform = 'translateY(0)';
                document.body.style.overflow = 'hidden';
            } else {
                mobileFilter.style.transform = 'translateY(100%)';
                document.body.style.overflow = 'auto';
            }
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.product-card');
            
            cards.forEach(card => {
                const productName = card.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection
