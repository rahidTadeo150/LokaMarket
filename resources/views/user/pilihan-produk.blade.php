@extends('layouts.customer')

@section('title', 'Pilihan Produk - LokaMarket')

@section('content')
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
                <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <div class="relative">
                            <input 
                                type="text" 
                                id="searchInput"
                                placeholder="Cari produk pilihan..." 
                                class="w-full rounded-full border border-gray-300 bg-white px-6 py-3 pr-12 text-[#3B2115] placeholder-[#A58C7D] transition focus:border-[#FF6B00] focus:outline-none focus:ring-2 focus:ring-[#FFD1AD]">
                            <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-[#FF6B00] text-white transition hover:bg-[#E85D00]">
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" onclick="toggleFilter()" class="inline-flex items-center justify-center gap-2 rounded-full border border-[#F1DCC8] bg-white px-4 py-3 text-sm font-medium text-[#72594B] shadow-sm transition hover:border-[#FF6B00] hover:text-[#C1440E] md:hidden">
                        <i class="fa-solid fa-sliders"></i>
                        <span>Filter</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-[240px_minmax(0,1fr)]">
                    <aside id="filterSidebar" class="hidden md:block">
                        <div class="sticky top-24 rounded-2xl border border-[#F1DCC8] bg-[#FFF7F0] p-4 shadow-sm">
                            <x-product-filter :categories="$categories" :selected-categories="$selectedCategories" :sort="$sort" />
                        </div>
                    </aside>
                    <div>
                        @if (empty($products))
                            <div class="rounded-2xl border border-dashed border-[#F1DCC8] bg-white p-8 text-center text-[#72594B]">
                                Tidak ada produk yang sesuai dengan filter yang dipilih.
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                                @foreach($products as $product)
                                    <x-product-card :product="$product"></x-product-card>
                                @endforeach
                            </div>
                        @endif
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
                        <x-product-filter :categories="$categories" :selected-categories="$selectedCategories" :sort="$sort" />
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function toggleFilter() {
            const mobileFilter = document.getElementById('mobileFilter');
            const backdrop = document.getElementById('filterBackdrop');

            if (!mobileFilter || !backdrop) return;

            const isHidden = mobileFilter.classList.contains('hidden');
            mobileFilter.classList.toggle('hidden');
            backdrop.classList.toggle('hidden');

            if (isHidden) {
                mobileFilter.style.transform = 'translateY(0)';
                document.body.style.overflow = 'hidden';
            } else {
                mobileFilter.style.transform = 'translateY(100%)';
                document.body.style.overflow = 'auto';
            }
        }

        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.product-card');

                cards.forEach(card => {
                    const productName = card.querySelector('.product-name')?.textContent.toLowerCase() ?? '';
                    card.style.display = productName.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    </script>
@endsection
