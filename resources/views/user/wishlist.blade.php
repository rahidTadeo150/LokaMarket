@extends('layouts.customer')

@section('title', 'Wishlist Kamu - LokaMarket')

@section('content')
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="mb-8">
            <h1 class="text-2xl font-extrabold text-[#3B2115] sm:text-3xl">Wishlist Kamu</h1>
            <p class="mt-2 text-sm text-[#72594B]">
                Produk pilihan dari UMKM favoritmu, tersimpan di sini biar gampang dibeli kapan saja.
            </p>
        </div>

        {{-- Summary Cards --}}
        <div class="mb-8 flex flex-wrap gap-4">
            <div class="flex min-w-[140px] flex-col justify-center rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <span class="text-xl font-extrabold text-[#3B2115]">9</span>
                <span class="text-[11px] text-gray-500">Produk disimpan</span>
            </div>
            <div class="flex min-w-[140px] flex-col justify-center rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <span class="text-xl font-extrabold text-[#3B2115]">2</span>
                <span class="text-[11px] text-gray-500">Turun harga</span>
            </div>
            <div class="flex min-w-[160px] flex-col justify-center rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <span class="text-xl font-extrabold text-[#3B2115]">Rp365.000</span>
                <span class="text-[11px] text-gray-500">Total perkiraan</span>
            </div>
        </div>

        {{-- Action & Filter Bar --}}
        <div class="mb-8 rounded-xl bg-[#FFF9F4] p-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                
                {{-- Checkbox Pilih Semua --}}
                <label class="flex cursor-pointer items-center gap-3 text-sm font-bold text-[#3B2115]">
                    <input type="checkbox" class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00]">
                    Pilih semua (9)
                </label>

                {{-- Dropdown Urutkan --}}
                <div class="relative">
                    <select class="appearance-none rounded-full border border-gray-200 bg-white py-2 pl-4 pr-10 text-xs font-bold text-[#3B2115] shadow-sm outline-none focus:border-[#FF6B00]">
                        <option>Urutkan: Baru ditambahkan</option>
                        <option>Urutkan: Harga Terendah</option>
                        <option>Urutkan: Harga Tertinggi</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-xs text-gray-500 pointer-events-none"></i>
                </div>
            </div>

            {{-- Category Pills --}}
            <div class="mt-4 flex flex-wrap gap-2">
                <button class="rounded-full bg-[#EA4F0C] px-5 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-[#D4460A]">
                    Semua
                </button>
                <button class="rounded-full border border-gray-200 bg-white px-5 py-2 text-xs font-bold text-[#72594B] transition hover:bg-gray-50">
                    Makanan & Minuman
                </button>
                <button class="rounded-full border border-gray-200 bg-white px-5 py-2 text-xs font-bold text-[#72594B] transition hover:bg-gray-50">
                    Kerajinan Tangan
                </button>
                <button class="rounded-full border border-gray-200 bg-white px-5 py-2 text-xs font-bold text-[#72594B] transition hover:bg-gray-50">
                    Fashion
                </button>
                <button class="rounded-full border border-gray-200 bg-white px-5 py-2 text-xs font-bold text-[#72594B] transition hover:bg-gray-50">
                    Kesehatan
                </button>
                <button class="rounded-full border border-gray-200 bg-white px-5 py-2 text-xs font-bold text-[#72594B] transition hover:bg-gray-50">
                    Rumah Tangga
                </button>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            
            {{-- Card 1 --}}
            <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="relative h-44 w-full bg-[#EA4F0C]">
                    {{-- Ganti tag div di atas dengan img saat sudah ada gambar asli: --}}
                    {{-- <img src="{{ asset('storage/gambar.jpg') }}" alt="Produk" class="h-full w-full object-cover"> --}}
                    
                    {{-- Checkbox --}}
                    <div class="absolute left-3 top-3">
                        <input type="checkbox" class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">
                    </div>

                    {{-- Heart Icon (Active) --}}
                    <button type="button" class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-sm transition hover:bg-gray-100">
                        <i class="fa-solid fa-heart text-[#EA4F0C]"></i>
                    </button>
                </div>

                <div class="flex flex-1 flex-col p-4">
                    <p class="text-[10px] font-bold text-[#EA4F0C]">Makanan & Minuman</p>
                    <h3 class="mt-1 line-clamp-2 text-sm font-bold text-[#3B2115]">Nasi Pecel Bu Sri</h3>
                    
                    <p class="mt-4 text-lg font-extrabold text-[#EA4F0C]">Rp12.000</p>
                    
                    <div class="mt-4 flex items-center justify-between border-t border-dashed border-gray-200 pt-3">
                        <span class="text-[10px] text-[#A08F85]">Disimpan 2 hari lalu</span>
                        <button type="button" class="flex h-7 w-7 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="relative h-44 w-full bg-[#493329]">
                    <div class="absolute left-3 top-3">
                        <input type="checkbox" class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">
                    </div>
                    <button type="button" class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-sm transition hover:bg-gray-100">
                        <i class="fa-solid fa-heart text-[#EA4F0C]"></i>
                    </button>
                </div>
                <div class="flex flex-1 flex-col p-4">
                    <p class="text-[10px] font-bold text-[#EA4F0C]">Makanan & Minuman</p>
                    <h3 class="mt-1 line-clamp-2 text-sm font-bold text-[#3B2115]">Kopi Tubruk Cak Man</h3>
                    <p class="mt-4 text-lg font-extrabold text-[#EA4F0C]">Rp8.000</p>
                    <div class="mt-4 flex items-center justify-between border-t border-dashed border-gray-200 pt-3">
                        <span class="text-[10px] text-[#A08F85]">Disimpan 5 hari lalu</span>
                        <button type="button" class="flex h-7 w-7 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="relative h-44 w-full bg-[#E59F30]">
                    <div class="absolute left-3 top-3">
                        <input type="checkbox" class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">
                    </div>
                    <button type="button" class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-sm transition hover:bg-gray-100">
                        <i class="fa-solid fa-heart text-[#EA4F0C]"></i>
                    </button>
                </div>
                <div class="flex flex-1 flex-col p-4">
                    <p class="text-[10px] font-bold text-[#EA4F0C]">Makanan & Minuman</p>
                    <h3 class="mt-1 line-clamp-2 text-sm font-bold text-[#3B2115]">Keripik Tempe Renyah</h3>
                    <p class="mt-4 text-lg font-extrabold text-[#EA4F0C]">Rp15.000</p>
                    <div class="mt-4 flex items-center justify-between border-t border-dashed border-gray-200 pt-3">
                        <span class="text-[10px] text-[#A08F85]">Disimpan 1 minggu lalu</span>
                        <button type="button" class="flex h-7 w-7 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 4 (Dengan Badge Stok Terbatas) --}}
            <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">
                <div class="relative h-44 w-full bg-[#5E7A5A]">
                    <div class="absolute left-3 top-3">
                        <input type="checkbox" class="h-5 w-5 cursor-pointer rounded border-gray-300 accent-[#FF6B00] shadow-sm">
                    </div>
                    <button type="button" class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-sm transition hover:bg-gray-100">
                        <i class="fa-solid fa-heart text-[#EA4F0C]"></i>
                    </button>
                    
                    {{-- Badge Stok Terbatas --}}
                    <span class="absolute bottom-3 left-3 rounded-full bg-[#FFF3E2] px-3 py-1 text-[9px] font-bold text-[#8D6B42]">
                        Stok terbatas
                    </span>
                </div>
                <div class="flex flex-1 flex-col p-4">
                    <p class="text-[10px] font-bold text-[#EA4F0C]">Kerajinan Tangan</p>
                    <h3 class="mt-1 line-clamp-2 text-sm font-bold text-[#3B2115]">Tas Anyaman Bambu</h3>
                    <p class="mt-4 text-lg font-extrabold text-[#EA4F0C]">Rp45.000</p>
                    <div class="mt-4 flex items-center justify-between border-t border-dashed border-gray-200 pt-3">
                        <span class="text-[10px] text-[#A08F85]">Disimpan 3 hari lalu</span>
                        <button type="button" class="flex h-7 w-7 items-center justify-center rounded-full bg-[#EA4F0C] text-white transition hover:bg-[#D4460A]">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection