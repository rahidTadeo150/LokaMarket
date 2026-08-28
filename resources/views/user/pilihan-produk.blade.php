@extends('layouts.customer')

@section('title', 'Pilihan Produk - LokaMarket')

@section('content')
    {{-- Main Content --}}
    <main class="min-h-screen bg-[#FFF9F4]">
        {{-- Hero Section --}}
        <section class="overflow-hidden bg-linear-to-br from-[#FFF3E2] to-[#FBAD51] px-4 py-12 sm:px-6 sm:py-16 md:py-20">
            <div class="mx-auto max-w-7xl">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-[#3B2115] sm:text-4xl md:text-5xl">
                        Produk Pilihan Minggu Ini
                    </h1>
                    <p class="mt-4 text-base text-[#72594B] sm:text-lg">
                        Produk terbaik UMKM terpilih yang tepat tinggalkan dari kami
                    </p>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <section class="bg-[#FFF9F4] px-4 py-12 sm:px-6 md:py-16">
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
                                       text-[#3B2115] placeholder-[#A58C7D] transition focus:border-[#FF6B00] 
                                       focus:outline-none focus:ring-2 focus:ring-[#FFD1AD]"
                            >
                            <button class="absolute right-2 top-1/2 -translate-y-1/2 flex h-8 w-8 
                                         items-center justify-center rounded-full bg-[#FF6B00] 
                                         text-white transition hover:bg-[#E85D00]">
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="flex items-center gap-2 rounded-full border border-gray-300 
                                     bg-white px-4 py-3 text-sm font-medium text-[#72594B] 
                                     transition hover:border-[#FF6B00] hover:text-[#C1440E]"
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
                            <button class="rounded-full border-2 border-[#FF6B00] px-8 py-3 
                                         font-semibold text-[#C1440E] transition hover:bg-[#FFF0E5]">
                                Lihat Semua Produk
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Floating Filter Button (Mobile) --}}
                <div id="filterBackdrop" class="fixed inset-0 z-40 hidden bg-[#3B2115]/40" 
                     onclick="toggleFilter()"></div>
                <div id="mobileFilter" class="fixed bottom-0 left-0 right-0 z-50 hidden max-h-[70vh] 
                     transform rounded-t-2xl bg-[#FFF9F4] transition-transform duration-300">
                    <div class="sticky top-0 border-b border-[#F1DCC8] bg-[#FFF9F4] px-4 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-[#3B2115]">Filter Produk</h3>
                            <button onclick="toggleFilter()" class="text-[#72594B] hover:text-[#C1440E]">
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
