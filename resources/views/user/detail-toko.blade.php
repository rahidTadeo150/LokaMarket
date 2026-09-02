@php
    $shop = [
        'name' => 'Geprek WW',
        'tagline' => 'Banyuwangi',
        'city' => 'Banyuwangi, Jawa Timur',
        'joined' => 'Bergabung 2022',
        'description' => 'Warung GEPREK WW menyajikan ayam geprek dengan rasa pedas, kriuk, dan bumbu khas Banyuwangi. Cocok untuk pecinta makanan pedas dengan cita rasa autentik.',
        'phone' => '0812-3456-7890',
        'address' => 'Jl. D. I. Panjaitan No. 45, Banyuwangi',
        'operational_hours' => '08.00 - 20.00 WIB',
        'hero_image' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=1200&q=80',
        'avatar' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=400&q=80',
    ];

    $products = [
        ['name' => 'Kulit Ayam Geprek', 'image' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=800&q=80', 'price' => 12000, 'label' => 'Paling Laris'],
        ['name' => 'Ayam Geprek', 'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=800&q=80', 'price' => 18000, 'label' => 'Best Seller'],
        ['name' => 'Es Pisang Ijo', 'image' => 'https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=800&q=80', 'price' => 8000, 'label' => 'Minuman'],
        ['name' => 'Tahu Walik', 'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=800&q=80', 'price' => 10000, 'label' => 'Cemilan'],
        ['name' => 'Ayam Geprek', 'image' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=800&q=80', 'price' => 18000, 'label' => 'Paling Laris'],
        ['name' => 'Kulit Ayam Geprek', 'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=800&q=80', 'price' => 12000, 'label' => 'Diskon'],
        ['name' => 'Es Pisang Ijo', 'image' => 'https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=800&q=80', 'price' => 8000, 'label' => 'Baru'],
        ['name' => 'Tahu Walik', 'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=800&q=80', 'price' => 10000, 'label' => 'Cemilan'],
    ];
@endphp

@extends('layouts.customer')

@section('title', 'Detail Toko - LokaMarket')

@section('content')
    <div class="min-h-screen bg-[#f8f4ef] text-slate-800">

        <section class="max-w-6xl mx-auto px-4 py-6">
            <div class="rounded-[28px] overflow-hidden bg-gradient-to-r from-[#f0bf77] via-[#f2b166] to-[#f0a14a] shadow-sm border border-orange-200/50">
                <div class="px-6 py-8 md:px-10">
                    <div class="flex items-center justify-between gap-4 flex-wrap">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-full border-4 border-white bg-white/40 overflow-hidden shadow-md">
                                <img src="{{ $shop['avatar'] }}" alt="{{ $shop['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-4xl font-black text-[#512b1a] tracking-tight">{{ $shop['name'] }}</h1>
                                <div class="flex items-center gap-2 mt-1 text-sm text-[#5d2f1d]">
                                    <span class="inline-flex items-center gap-1"><i class="fa-solid fa-location-dot text-xs"></i> {{ $shop['tagline'] }}</span>
                                    <span class="text-[#754830]">•</span>
                                    <span>{{ $shop['joined'] }}</span>
                                </div>
                            </div>
                        </div>
                        <button class="bg-white text-[#a85a1d] font-semibold px-5 py-2.5 rounded-full shadow-sm hover:bg-orange-50 transition">
                            Chat Toko
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto px-4 pb-8">
            <div class="rounded-[26px] bg-white border border-orange-100 shadow-sm p-5 md:p-7">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Tentang Toko</h2>
                    </div>
                    <button class="bg-[#f5a623] text-white text-sm font-semibold px-4 py-2 rounded-full hover:bg-[#e89b12] transition">
                        Chat Toko
                    </button>
                </div>

                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5 text-sm text-slate-600">
                    <p class="leading-7">
                        {{ $shop['description'] }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-clock"></i>
                                <span>Jam Operasional</span>
                            </div>
                            <p>{{ $shop['operational_hours'] }}</p>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-phone"></i>
                                <span>Kontak</span>
                            </div>
                            <p>{{ $shop['phone'] }}</p>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf4] p-4 sm:col-span-2">
                            <div class="flex items-center gap-2 text-[#7b3d1a] font-semibold mb-2">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Alamat</span>
                            </div>
                            <p>{{ $shop['address'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto px-4 pb-10">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-2xl font-bold text-slate-800">Semua Produk</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($products as $product)
                    <article class="group rounded-[22px] border border-orange-100 bg-white p-3 shadow-sm hover:shadow-md transition">
                        <div class="relative overflow-hidden rounded-[18px] bg-[#f8f4ef]">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-300">
                            <button class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 text-slate-500 shadow-sm hover:text-[#f5a623] transition">
                                <i class="fa-regular fa-heart text-xs"></i>
                            </button>
                        </div>
                        <div class="mt-3 space-y-2">
                            <div class="flex items-center justify-between gap-2">
                                <span class="inline-flex items-center rounded-full bg-orange-50 border border-orange-200 px-2 py-1 text-[10px] font-semibold text-orange-600">
                                    {{ $product['label'] }}
                                </span>
                                <button class="w-8 h-8 rounded-full bg-orange-50 text-orange-500 hover:bg-orange-100 transition">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                            <h3 class="font-bold text-lg text-slate-800 leading-tight">{{ $product['name'] }}</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[11px] text-slate-400">Harga</p>
                                    <p class="font-bold text-[#f5a623]">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center gap-1 text-[#f5a623] text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <span>4.8</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@endsection
