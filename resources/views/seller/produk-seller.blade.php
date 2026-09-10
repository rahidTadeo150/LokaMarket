@extends('layouts.seller')

@section('title', 'Produk Toko - LokaMarket')

@section('content')

<div class="mx-auto max-w-7xl px-5 py-8 lg:px-8">

    {{-- Header Sederhana --}}
    <div class="mb-5 flex items-center justify-between">
        <span class="text-sm font-semibold text-[#72594B]">
            Semua (24)
        </span>

        <a href="#"
            class="inline-flex items-center gap-2 rounded-xl bg-[#FF6B00] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#E85D00]">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Produk</span>
        </a>
    </div>


    {{-- Tabel Produk --}}
    <div class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px]">

                {{-- Header Tabel --}}
                <thead>
                    <tr class="border-b border-orange-100 bg-[#FFF9F4]">

                        <th class="w-12 px-5 py-4">
                            <input type="checkbox"
                                class="h-4 w-4 rounded border-orange-200 text-[#FF6B00] focus:ring-[#FF6B00]">
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-[#72594B]">
                            Produk
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-[#72594B]">
                            Kategori
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-[#72594B]">
                            Harga
                        </th>

                        <th class="px-5 py-4 text-center text-[11px] font-bold uppercase tracking-wide text-[#72594B]">
                            Stok
                        </th>

                        <th class="px-5 py-4 text-center text-[11px] font-bold uppercase tracking-wide text-[#72594B]">
                            Terjual
                        </th>

                        <th class="px-5 py-4 text-center text-[11px] font-bold uppercase tracking-wide text-[#72594B]">
                            Aksi
                        </th>

                    </tr>
                </thead>


                {{-- Isi Produk --}}
                <tbody class="divide-y divide-orange-50">

                    @php
                    $produk = [
                    [
                    'nama' => 'Ayam Geprek',
                    'kategori' => 'Makanan',
                    'harga' => 'Rp18.000',
                    'stok' => 24,
                    'terjual' => 128,
                    'gambar' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=300&q=80',
                    ],
                    [
                    'nama' => 'Nasi Goreng',
                    'kategori' => 'Makanan',
                    'harga' => 'Rp15.000',
                    'stok' => 12,
                    'terjual' => 85,
                    'gambar' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=300&q=80',
                    ],
                    [
                    'nama' => 'Kopi Tubruk Gak Man',
                    'kategori' => 'Minuman',
                    'harga' => 'Rp12.000',
                    'stok' => 30,
                    'terjual' => 64,
                    'gambar' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=300&q=80',
                    ],
                    [
                    'nama' => 'Keripik Pisang',
                    'kategori' => 'Snack',
                    'harga' => 'Rp10.000',
                    'stok' => 18,
                    'terjual' => 47,
                    'gambar' => 'https://images.unsplash.com/photo-1621939514649-280e2aa6b8d8?auto=format&fit=crop&w=300&q=80',
                    ],
                    ];
                    @endphp


                    @foreach ($produk as $item)

                    <tr class="group transition hover:bg-[#FFF9F4]">

                        {{-- Checkbox --}}
                        <td class="px-5 py-5">
                            <input type="checkbox"
                                class="h-4 w-4 rounded border-orange-200 text-[#FF6B00] focus:ring-[#FF6B00]">
                        </td>


                        {{-- Produk --}}
                        <td class="px-5 py-5">
                            <div class="flex items-center gap-4">

                                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-orange-100 bg-orange-50">
                                    <img src="{{ $item['gambar'] }}"
                                        alt="{{ $item['nama'] }}"
                                        class="h-full w-full object-cover">
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-[#3B2115]">
                                        {{ $item['nama'] }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-[#A58C7D]">
                                        Produk LokaMarket
                                    </p>
                                </div>

                            </div>
                        </td>


                        {{-- Kategori --}}
                        <td class="px-5 py-5">
                            <span class="inline-flex rounded-lg bg-[#FFF3E5] px-3 py-1.5 text-xs font-semibold text-[#E85D04]">
                                {{ $item['kategori'] }}
                            </span>
                        </td>


                        {{-- Harga --}}
                        <td class="px-5 py-5">
                            <span class="text-sm font-bold text-[#3B2115]">
                                {{ $item['harga'] }}
                            </span>
                        </td>


                        {{-- Stok --}}
                        <td class="px-5 py-5 text-center">
                            <span class="text-sm font-semibold text-[#3B2115]">
                                {{ $item['stok'] }}
                            </span>
                        </td>


                        {{-- Terjual --}}
                        <td class="px-5 py-5 text-center">
                            <span class="text-sm font-semibold text-[#72594B]">
                                {{ $item['terjual'] }}
                            </span>
                        </td>


                        {{-- Aksi --}}
                        <td class="px-5 py-5">
                            <div class="flex items-center justify-center gap-2">

                                {{-- Edit --}}
                                <a href="#"
                                    class="inline-flex min-w-[72px] items-center justify-center gap-1.5 rounded-lg border border-orange-200 px-3 py-2 text-xs font-semibold text-[#E85D00] transition hover:bg-orange-50">

                                    <i class="fa-solid fa-pen-to-square text-[11px]"></i>

                                    Edit
                                </a>


                                {{-- Hapus --}}
                                <button type="button"
                                    class="inline-flex min-w-[72px] items-center justify-center gap-1.5 rounded-lg border border-red-100 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-50">

                                    <i class="fa-regular fa-trash-can text-[11px]"></i>

                                    Hapus
                                </button>

                            </div>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>


    {{-- Tips --}}
    <div class="mt-5 flex items-start gap-3 rounded-xl border border-orange-100 bg-[#FFF9F4] px-5 py-4">

        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-[#FFF3E5] text-[#FF6B00]">
            <i class="fa-solid fa-lightbulb text-xs"></i>
        </div>

        <div>
            <p class="text-xs font-bold text-[#3B2115]">
                Tips mengelola produk
            </p>

            <p class="mt-1 text-[11px] leading-relaxed text-[#72594B]">
                Pastikan harga, stok, dan informasi produk selalu diperbarui
                agar pelanggan mendapatkan informasi yang akurat.
            </p>
        </div>

    </div>

</div>

@endsection