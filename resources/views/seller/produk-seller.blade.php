@extends('layouts.seller')

@section('title', 'Kelola Produk - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F4] px-4 py-6 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl space-y-6">

            <section class="relative overflow-hidden rounded-3xl bg-linear-to-r from-[#FFF0DF] via-[#FFE0BD] to-[#FFB56B] p-6 sm:p-8">

                <div class="pointer-events-none absolute -right-12 -top-16 h-56 w-56 rounded-full bg-white/30 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-20 right-1/3 h-48 w-48 rounded-full bg-orange-300/30 blur-3xl"></div>

                <div class="relative flex flex-col justify-between gap-6 sm:flex-row sm:items-center">

                    <div>
                        <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/70 px-3 py-1.5 text-xs font-semibold text-[#C1440E]">
                            <i class="fa-solid fa-store"></i>
                            Seller Center
                        </div>
                        <p class="text-2xl font-extrabold tracking-tight text-[#3B2115] sm:text-3xl">
                            Kelola Produk
                        </p>
                        <p class="mt-2 max-w-xl text-sm leading-6 text-[#72594B] sm:text-base">
                            Atur katalog produk, pantau stok, dan pastikan produk tokomu selalu siap dibeli pelanggan.
                        </p>
                    </div>

                    <a href="{{ route('seller.FormTambahProduk') }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-2xl bg-[#E85D04] px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-600/20 transition hover:-translate-y-0.5 hover:bg-[#D94F00]">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Produk
                    </a>

                </div>

            </section>

            <x-alert-session/>

            <section class="grid grid-cols-2 gap-4 xl:grid-cols-4">

                <div class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-3">

                        <div>
                            <p class="text-xs font-medium text-[#8A7568] sm:text-sm">Semua Produk</p>
                            <p class="mt-2 text-2xl font-extrabold text-[#3B2115]">{{ $jumlahSemua }}</p>
                            <p class="mt-1 text-xs text-[#9A8679]">Produk dalam katalog</p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-50 text-orange-600">
                            <i class="fa-solid fa-boxes-stacked text-lg"></i>
                        </div>

                    </div>
                </div>

                <div class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-3">

                        <div>
                            <p class="text-xs font-medium text-[#8A7568] sm:text-sm">Produk Aktif</p>
                            <p class="mt-2 text-2xl font-extrabold text-emerald-600">{{ $jumlahAktif }}</p>
                            <p class="mt-1 text-xs text-[#9A8679]">Siap ditampilkan</p>
                        </div>
                        
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-circle-check text-lg"></i>
                        </div>

                    </div>
                </div>

                <div class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-3">

                        <div>
                            <p class="text-xs font-medium text-[#8A7568] sm:text-sm">Stok Habis</p>
                            <p class="mt-2 text-2xl font-extrabold text-rose-600">{{ $jumlahHabis }}</p>
                            <p class="mt-1 text-xs text-[#9A8679]">Perlu restok</p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>

                    </div>
                </div>

                <div class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-3">

                        <div>
                            <p class="text-xs font-medium text-[#8A7568] sm:text-sm">Produk Nonaktif</p>
                            <p class="mt-2 text-2xl font-extrabold text-slate-600">{{ $jumlahNonaktif }}</p>
                            <p class="mt-1 text-xs text-[#9A8679]">Tidak ditampilkan</p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                            <i class="fa-solid fa-eye-slash text-lg"></i>
                        </div>

                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                <div class="border-b border-[#F3E5D9] p-5 sm:p-6">
                    <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">

                        <div>
                            <p class="text-lg font-extrabold text-[#3B2115] sm:text-xl">Daftar Produk</p>
                            <p class="mt-1 text-sm text-[#8A7568]">Kelola dan perbarui produk yang ada di tokomu.</p>
                        </div>

                            <form id="filterProdukForm" 
                                method="GET"
                                class="flex flex-col gap-3 sm:flex-row"
                                action="{{ route('seller.produk') }}">

                                <div class="relative">
                                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#A18B7D]"></i>
                                    <input id="searchProduk"
                                        name="search"
                                        type="text"
                                        placeholder="Cari nama produk..."
                                        class="w-full rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] py-3 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B5A398] focus:border-orange-400 focus:ring-4 focus:ring-orange-100 sm:w-64">
                                </div>

                                <select name="kategori"
                                        id="filterKategori"
                                        class="rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] px-4 py-3 text-sm text-[#72594B] outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                                        
                                    <option value="">Semua Kategori</option>

                                    @foreach ($kategori as $itemKategori)
                                        <option value="{{ $itemKategori->slug }}"
                                            @selected(request('kategori') === $itemKategori->slug)>
                                            {{ $itemKategori->nama }}
                                        </option>
                                    @endforeach

                                </select>

                                <input type="hidden"
                                    name="status"
                                    id="statusProduk"
                                    value="{{ request('status', 'semua') }}">

                            </form>

                    </div>

                    <div class="mt-6 flex gap-2 overflow-x-auto pb-1">

                        <button type="button" 
                                data-status="semua"
                                class="status-tab whitespace-nowrap rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-bold text-white">
                            Semua <span class="ml-1 rounded-lg bg-white/20 px-2 py-0.5">{{ $jumlahSemua }}</span>
                        </button>

                        <button type="button" 
                                data-status="aktif"
                                class="status-tab whitespace-nowrap rounded-xl px-4 py-2.5 text-sm font-semibold text-[#806B5D] transition hover:bg-orange-50">
                            Aktif <span class="ml-1 rounded-lg bg-white/20 px-2 py-0.5">{{ $jumlahAktif }}</span>
                        </button>

                        <button type="button" 
                                data-status="habis"
                                class="status-tab whitespace-nowrap rounded-xl px-4 py-2.5 text-sm font-semibold text-[#806B5D] transition hover:bg-orange-50">
                            Stok Habis <span class="ml-1 rounded-lg bg-white/20 px-2 py-0.5">{{ $jumlahHabis }}</span>
                        </button>

                        <button type="button" 
                                data-status="nonaktif"
                                class="status-tab whitespace-nowrap rounded-xl px-4 py-2.5 text-sm font-semibold text-[#806B5D] transition hover:bg-orange-50">
                            Nonaktif <span class="ml-1 rounded-lg bg-white/20 px-2 py-0.5">{{ $jumlahNonaktif }}</span>
                        </button>

                    </div>

                </div>

                <div class="hidden overflow-x-auto md:block">

                    <table class="w-full min-w-212 text-left">
                        
                        <thead class="bg-[#FFFAF6] text-xs uppercase tracking-wider text-[#9A8679]">

                            <tr>
                                <th class="px-6 py-4 font-bold">Produk</th>
                                <th class="px-5 py-4 font-bold">Kategori</th>
                                <th class="px-5 py-4 font-bold">Harga</th>
                                <th class="px-5 py-4 font-bold">Stock</th>
                                <th class="px-5 py-4 font-bold">Status</th>
                                <th class="px-6 py-4 text-right font-bold">Aksi</th>
                            </tr>

                        </thead>

                        <tbody id="produkTableBody" class="divide-y divide-[#F5EAE1]">

                            @forelse ($produk as $item)

                            <tr class="produk-row transition hover:bg-[#FFFCF9]"
                                data-nama="{{ strtolower($item->nama) }}"
                                data-kategori="{{ strtolower($item->kategori->nama ?? '') }}"
                                data-status="{{ $item->status_produk }}">

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-[#F1DCC8] bg-orange-50">
                                            <img src="{{ asset('storage/' . $item->thumbnail->foto) }}"
                                                alt="{{ $item->nama }}"
                                                class="h-full w-full object-cover"
                                                loading="lazy"
                                                onerror="this.onerror=null; this.src='{{ asset('images/default-product.jpg') }}'">
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-bold text-[#3B2115]">
                                                {{ $item->nama }}
                                            </p>
                                            <p class="mt-1 truncate text-xs text-[#A58E81]">
                                                {{ $item->slug }}
                                            </p>
                                        </div>

                                    </div>

                                </td>

                                <td class="px-5 py-4">

                                    <span class="text-sm font-bold text-[#3B2115]">
                                        Rp{{ number_format($item->harga, 0, ',', '.') }}
                                    </span>

                                </td>

                                <td class="px-5 py-4">

                                    <span class="text-sm font-semibold
                                        {{ $item->stok <= 0 ? 'text-rose-600' : 'text-[#72594B]' }}">
                                        {{ $item->stok }} unit
                                    </span>

                                </td>

                                <td class="px-5 py-4">

                                    <span class="inline-flex rounded-lg bg-[#FFF3E8] px-2.5 py-1 text-xs font-semibold text-[#B9571D]">
                                        {{ Str::title($item->kategori->nama ?? '-') }}
                                    </span>

                                </td>

                                <td class="px-5 py-4">

                                    @if ($item->stok === 0)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600">
                                        <i class="fa-solid fa-circle-xmark text-[10px]"></i>
                                        Stok Habis
                                    </span>
                                    @elseif ($item->is_active)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-600">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i>
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-600">
                                        <i class="fa-solid fa-circle-minus text-[10px]"></i>
                                        Nonaktif
                                    </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4 flex justify-end gap-3 items-center">

                                    <a href="{{ route('seller.editProduk', $item->slug) }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-[#F1DCC8] px-3 py-2 text-xs font-bold text-[#B9571D] transition hover:bg-orange-50">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Edit
                                    </a>

                                    <form id="hapusProdukForm{{ $item->id }}"
                                        action="{{ route('seller.deleteProduk', $item->slug) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            data-confirm
                                            data-form="hapusProdukForm{{ $item->id }}"
                                            data-theme="red"
                                            data-title="Hapus Produk?"
                                            data-message="Apakah kamu yakin ingin menghapus produk {{ $item->nama }}? Produk yang dihapus tidak dapat dikembalikan."
                                            data-confirm-text="Ya, Hapus"
                                            data-icon="fa-solid fa-trash-can"
                                            class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100">
                                            <i class="fa-solid fa-trash-can"></i>
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="px-5 py-12 text-center">

                                    <div class="flex flex-col items-center">
                                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-orange-400">
                                            <i class="fa-solid fa-box-open text-xl"></i>
                                        </div>
                                        <p class="mt-4 text-sm font-bold text-[#3B2115]">
                                            Belum Ada Produk
                                        </p>
                                        <p class="mt-1 text-xs text-[#A58E81]">
                                            Produk toko Anda akan tampil di sini.
                                        </p>
                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div id="produkMobileList" class="space-y-3 p-4 md:hidden">

                    @forelse ($produk as $item)

                    <article class="produk-row rounded-2xl border border-[#F1DCC8] bg-white p-4"
                            data-nama="{{ strtolower($item->nama) }}"
                            data-kategori="{{ strtolower($item->kategori->nama ?? '') }}"
                            data-status="{{ $item->status_produk }}">

                        <div class="flex gap-3">

                            <img src="{{ asset('storage/' . $item->thumbnail->foto) }}"
                                alt="{{ $item->nama }}"
                                class="h-20 w-20 shrink-0 rounded-xl border border-[#F1DCC8] object-cover"
                                onerror="this.src='{{ asset('images/default-product.jpg') }}'">

                            <div class="min-w-0 flex-1">

                                <p class="font-bold leading-5 text-[#3B2115]">
                                    {{ $item->nama }}
                                </p>

                                <p class="mt-1 text-xs text-[#A18B7D]">
                                    {{ $item->slug }}
                                </p>

                                <p class="mt-2 font-extrabold text-[#D9490B]">
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </p>

                                <div class="mt-2 flex flex-wrap items-center gap-2">

                                    <span class="rounded-lg bg-[#FFF3E8] px-2.5 py-1 text-[11px] font-semibold text-[#B9571D]">
                                        {{ Str::title($item->kategori->nama ?? '-') }}
                                    </span>

                                    @if ($item->status_produk === 'aktif')
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700">
                                        Aktif
                                    </span>
                                    @elseif ($item->status_produk === 'habis')
                                    <span class="rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-bold text-rose-700">
                                        Stok Habis
                                    </span>
                                    @else
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-bold text-slate-600">
                                        Nonaktif
                                    </span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="mt-4 flex items-center justify-between border-t border-[#F5EAE1] pt-3">

                            <p class="text-xs text-[#8A7568]">
                                Stok:
                                <span class="font-bold {{ $item->stok <= 0 ? 'text-rose-600' : 'text-[#3B2115]' }}">
                                    {{ $item->stok }} unit
                                </span>
                            </p>

                            <div class="flex items-center gap-2">

                                <a href="#"
                                class="rounded-xl border border-[#F1DCC8] px-3 py-2 text-xs font-bold text-[#B9571D] transition hover:bg-orange-50">
                                    <i class="fa-regular fa-pen-to-square mr-1"></i>
                                    Edit Produk
                                </a>
    
                                <form id="hapusProdukForm{{ $item->id }}"
                                    action="{{ route('seller.deleteProduk', $item->slug) }}"
                                    method="POST">
    
                                    @csrf
                                    @method('DELETE')
    
                                    <button
                                        type="button"
                                        data-confirm
                                        data-form="hapusProdukForm{{ $item->id }}"
                                        data-theme="red"
                                        data-title="Hapus Produk?"
                                        data-message="Apakah kamu yakin ingin menghapus produk {{ $item->nama }}? Produk yang dihapus tidak dapat dikembalikan."
                                        data-confirm-text="Ya, Hapus"
                                        data-icon="fa-solid fa-trash-can"
                                        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Hapus
                                    </button>
    
                                </form>

                            </div>

                        </div>

                    </article>

                    @empty

                    <div class="rounded-2xl border border-dashed border-[#E8D5C5] bg-white px-5 py-10 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-orange-400">
                            <i class="fa-solid fa-box-open text-xl"></i>
                        </div>

                        <p class="mt-4 text-sm font-bold text-[#3B2115]">
                            Belum Ada Produk
                        </p>

                        <p class="mt-1 text-xs leading-5 text-[#A18B7D]">
                            Produk toko Anda akan muncul di halaman ini.
                        </p>

                    </div>

                    @endforelse

                </div>

                <div class="border-t border-[#F3E5D9] bg-[#FFFCF9] px-5 py-4">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-[#8A7568]">
                            Menampilkan
                            <span class="font-bold text-[#3B2115]">
                                {{ $produk->firstItem() ?? 0 }}
                            </span>
                            -
                            <span class="font-bold text-[#3B2115]">
                                {{ $produk->lastItem() ?? 0 }}
                            </span>
                            dari
                            <span class="font-bold text-[#3B2115]">
                                {{ $produk->total() }}
                            </span>
                            produk
                        </p>

                        <div>
                            {{ $produk->onEachSide(1)->links() }}
                        </div>

                    </div>

                </div>

            </section>

            <section class="flex gap-4 rounded-2xl border border-orange-200 bg-[#FFF3E8] p-5">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-orange-600 shadow-sm">
                    <i class="fa-solid fa-lightbulb text-lg"></i>
                </div>
                <div>
                    <h3 class="font-bold text-[#7B3515]">Tips mengelola produk</h3>
                    <p class="mt-1 text-sm leading-6 text-[#8A5A40]">
                        Gunakan foto produk yang jelas, tuliskan deskripsi yang informatif, dan perbarui jumlah stok secara berkala agar pelanggan mendapatkan informasi yang tepat.
                    </p>
                </div>

            </section>
            
            <x-custom-alert-confirmation/>
            
        </div>

    </main>

@endsection