@extends('layouts.seller')

@section('title', 'Edit Produk - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F4] px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl space-y-6">

        <section class="relative overflow-hidden rounded-3xl bg-linear-to-r from-[#FFF0DF] via-[#FFE4C7] to-[#FFD09B] p-6 sm:p-8">

            <div class="pointer-events-none absolute -right-10 -top-16 h-52 w-52 rounded-full bg-white/30 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-20 right-40 h-40 w-40 rounded-full bg-orange-300/20 blur-2xl"></div>

            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <span class="mb-3 inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/70 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-orange-700">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Manajemen Produk
                    </span>
                    <p class="text-2xl font-extrabold tracking-tight text-[#3B2115] sm:text-3xl">
                        Edit Produk
                    </p>
                    <p class="mt-2 max-w-xl text-xs leading-6 text-[#72594B] sm:text-sm">
                        Perbarui informasi produk yang kamu jual agar tetap akurat dan menarik bagi pelanggan.
                    </p>
                </div>

                <a href="{{ route('seller.produk') }}"
                   class="inline-flex w-fit items-center gap-2 rounded-xl border border-orange-200 bg-white px-4 py-3 text-xs font-bold text-[#72594B] shadow-sm transition hover:border-orange-400 hover:text-orange-600">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>

            </div>

        </section>

        <x-alert-session/>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4">
                <p class="font-bold text-red-700">
                    Validasi gagal. Periksa data berikut:
                </p>

                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="editProdukForm" 
            action="{{ route('seller.editProduk.update', ['slug' => $produk->slug]) }}" 
            method="POST" 
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-[minmax(0,1fr)_340px]">

                <div class="space-y-6">

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-7">

                        <div class="mb-6 flex items-center gap-3 border-b border-orange-50 pb-5">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                <i class="fa-solid fa-box-open text-lg"></i>
                            </div>

                            <div>
                                <p class="text-base font-bold text-[#3B2115]">
                                    Informasi Produk
                                </p>
                                <p class="mt-1 text-xs text-[#8A7568]">
                                    Informasi dasar produk yang dijual.
                                </p>
                            </div>
                            
                        </div>

                        <div class="space-y-5">

                            <div>

                                <label for="namaProduk" class="mb-2 block text-xs font-semibold text-[#3B2115]">
                                    Nama Produk <span class="text-red-500">*</span>
                                </label>

                                <input type="text"
                                    id="namaProduk"
                                    name="nama"
                                    value="{{ old('nama', $produk->nama) }}"
                                    required
                                    placeholder="Masukkan nama produk"
                                    class="w-full rounded-xl border border-[#F1DCC8] bg-white px-4 py-3 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B5A194] focus:border-orange-400 focus:ring-4 focus:ring-orange-100">

                                <p class="mt-2 text-[11px] text-[#9A8577]">
                                    Gunakan nama yang jelas dan mudah dipahami pelanggan.
                                </p>

                            </div>

                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                <div>

                                    <label for="kategori" class="mb-2 block text-xs font-semibold text-[#3B2115]">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>

                                    <select id="kategori"
                                            name="kategori_id"
                                            required
                                            class="w-full rounded-xl border border-[#F1DCC8] bg-white px-4 py-3 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                                        
                                        @foreach ($kategori as $item)
                                        <option
                                            value="{{ $item->id }}"
                                            @selected(old('kategori_id', $produk->kategori_id) == $item->id)>
                                            {{ $item->nama }}
                                        </option>
                                        @endforeach

                                    </select>

                                </div>

                                <div>
                                    
                                    <label for="harga" class="mb-2 block text-xs font-semibold text-[#3B2115]">
                                        Harga Produk <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-[#8A7568]">
                                            Rp
                                        </span>
                                        <input type="number"
                                            id="harga"
                                            name="harga"
                                            value="{{ old('harga', $produk->harga) }}"
                                            min="0"
                                            required
                                            class="w-full rounded-xl border border-[#F1DCC8] bg-white py-3 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                                    </div>

                                    <p id="hargaPreview" class="mt-2 text-[11px] font-medium text-orange-600">
                                        Rp25.000
                                    </p>

                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                
                                <div>

                                    <label for="stok" class="mb-2 block text-xs font-semibold text-[#3B2115]">
                                        Stok Produk <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">
                                        <input type="number"
                                            id="stok"
                                            name="stok"
                                            value="{{ old('stok', $produk->stok) }}"
                                            min="0"
                                            required
                                            class="w-full rounded-xl border border-[#F1DCC8] bg-white px-4 py-3 pr-16 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#8A7568]">
                                            Pcs
                                        </span>
                                    </div>

                                </div>

                                <div>

                                    <label class="mb-2 block text-xs font-semibold text-[#3B2115]">
                                        ID Produk
                                    </label>

                                    <div class="flex items-center justify-between rounded-xl border border-[#F1DCC8] bg-[#FFF9F4] px-4 py-3 text-sm text-[#8A7568]">
                                        <span>PRD-000124</span>
                                        <i class="fa-solid fa-lock text-[11px]"></i>
                                    </div>

                                </div>

                            </div>

                            <div>

                                <div class="mb-2 flex items-center justify-between gap-3">
                                    <label for="deskripsi" class="text-xs font-semibold text-[#3B2115]">
                                        Deskripsi Produk <span class="text-red-500">*</span>
                                    </label>
                                    <span id="jumlahKarakter" class="text-[10px] text-[#9A8577]">
                                        0/500
                                    </span>
                                </div>

                                <textarea id="deskripsi"
                                        name="deskripsi"
                                        rows="5"
                                        maxlength="500"
                                        required
                                        placeholder="Jelaskan detail produk..."
                                        class="w-full resize-y rounded-xl border border-[#F1DCC8] bg-white px-4 py-3 text-sm leading-6 text-[#3B2115] outline-none transition placeholder:text-[#B5A194] focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
                                >{{ old('deskripsi', $produk->deskripsi) }}</textarea>

                                <p class="mt-2 text-[11px] text-[#9A8577]">
                                    Jelaskan bahan, keunggulan, ukuran, atau informasi penting lainnya.
                                </p>
                                
                            </div>

                        </div>

                    </section>

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-7">

                        <div class="mb-6 flex items-center gap-3 border-b border-orange-50 pb-5">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                <i class="fa-solid fa-images text-lg"></i>
                            </div>

                            <div>
                                <p class="text-base font-bold text-[#3B2115]">
                                    Foto Produk
                                </p>
                                <p class="mt-1 text-xs text-[#8A7568]">
                                    Atur thumbnail utama dan foto preview produk.
                                </p>
                            </div>

                        </div>

                        <div class="space-y-6">

                            <div>
                                
                                <div class="mb-3 flex items-center justify-between gap-3">

                                    <div>
                                        <p class="text-sm font-bold text-[#3B2115]">
                                            Thumbnail Utama
                                        </p>
                                        <p class="mt-1 text-xs text-[#8A7568]">
                                            Foto utama yang mewakili produk.
                                        </p>
                                    </div>

                                    <span class="rounded-full bg-orange-50 px-3 py-1 text-[10px] font-bold text-orange-600">
                                        Utama
                                    </span>

                                </div>

                                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                                    <div class="relative h-48 w-full overflow-hidden rounded-2xl border border-orange-100 bg-[#FFF9F4] sm:h-44 sm:w-52 sm:shrink-0">

                                        <img
                                            id="previewThumbnail"
                                            src="{{ asset('storage/' . $produk->thumbnail?->foto) }}"
                                            alt="{{ $produk->nama }}"
                                            class="h-48 w-full rounded-xl object-cover">

                                        <span class="absolute left-3 top-3 rounded-lg bg-white/90 px-2.5 py-1.5 text-[10px] font-bold text-[#72594B] shadow-sm">
                                            <i class="fa-solid fa-star mr-1 text-orange-500"></i>
                                            Thumbnail
                                        </span>

                                        <button
                                            type="button"
                                            id="hapusThumbnail"
                                            class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-lg bg-white/95 text-red-500 shadow-sm transition hover:bg-red-50"
                                            title="Hapus thumbnail baru">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>

                                    </div>

                                    <div class="flex-1">

                                        <p class="text-sm font-bold text-[#3B2115]">
                                            Ganti thumbnail produk
                                        </p>

                                        <p class="mt-2 text-xs leading-6 text-[#8A7568]">
                                            Pilih gambar yang paling menarik karena gambar ini menjadi representasi utama produk.
                                        </p>

                                        <input type="file"
                                            id="inputThumbnail"
                                            name="thumbnail"
                                            accept="image/jpeg,image/png,image/webp"
                                            class="hidden">

                                        <button type="button"
                                                id="btnThumbnail"
                                                class="mt-4 inline-flex items-center gap-2 rounded-xl border border-orange-200 bg-white px-4 py-2.5 text-xs font-bold text-orange-600 transition hover:bg-orange-50">
                                            <i class="fa-solid fa-upload"></i>
                                            Pilih Thumbnail
                                        </button>

                                        <p class="mt-3 text-[10px] leading-5 text-[#9A8577]">
                                            JPG, PNG, atau WEBP. Maksimal 2 MB.
                                        </p>

                                        <p id="namaThumbnail"
                                        class="mt-1 break-all text-[11px] font-medium text-green-700"></p>

                                    </div>

                                </div>

                            </div>

                            <div class="border-t border-dashed border-orange-100"></div>

                            <div>

                                <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                                    <div>
                                        <p class="text-sm font-bold text-[#3B2115]">
                                            Foto Preview Produk
                                        </p>
                                        <p class="mt-1 text-xs text-[#8A7568]">
                                            Hapus foto lama atau tambahkan foto pengganti.
                                        </p>
                                    </div>

                                    <span id="jumlahFotoPreview"
                                        class="w-fit rounded-full bg-orange-50 px-3 py-1.5 text-[10px] font-bold text-orange-600">
                                        {{ $produk->preview->count() }}/4 foto
                                    </span>

                                </div>

                                <div id="gridFotoPreview"
                                    class="grid grid-cols-2 gap-4 sm:grid-cols-4">

                                    @foreach ($produk->preview as $foto)
                                    <div class="preview-item group relative aspect-square overflow-hidden rounded-xl border border-orange-100 bg-[#FFF9F4]"
                                        data-foto-id="{{ $foto->id }}">

                                        <img src="{{ asset('storage/' . $foto->foto) }}"
                                            alt="Foto preview {{ $produk->nama }}"
                                            class="preview-foto h-full w-full object-cover">

                                        <button type="button"
                                                class="hapus-foto absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white/95 text-red-500 shadow-sm hover:bg-red-50"
                                                title="Hapus foto preview"
                                                aria-label="Hapus foto preview">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>

                                        <span class="nomor-foto absolute bottom-2 left-2 rounded-md bg-black/60 px-2 py-1 text-[9px] font-bold text-white"></span>
                                        
                                    </div>
                                    @endforeach

                                    <button type="button"
                                            id="btnTambahFoto"
                                            class="flex aspect-square flex-col items-center justify-center rounded-xl border-2 border-dashed border-orange-200 bg-orange-50/50 text-orange-600 transition hover:border-orange-400 hover:bg-orange-50">
                                        <i class="fa-solid fa-plus text-xl"></i>
                                        <span class="mt-2 text-xs font-bold">Tambah Foto</span>
                                    </button>

                                </div>

                                <div id="fotoDihapusContainer"></div>

                                <input type="file"
                                    id="inputFotoPreview"
                                    name="foto_preview[]"
                                    accept="image/jpeg,image/png,image/webp"
                                    multiple
                                    class="hidden">

                                <p class="mt-4 text-[10px] leading-5 text-[#9A8577]">
                                    Format JPG, PNG, atau WEBP. Maksimal 2 MB per foto.
                                    Maksimal 4 foto preview setelah perubahan disimpan.
                                </p>

                                <p id="pesanFotoPreview"
                                class="mt-2 hidden text-xs font-medium text-red-500"></p>

                                @error('foto_preview')
                                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                @enderror

                                @error('foto_preview.*')
                                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>

                    </section>

                </div>

                <div class="space-y-6">

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">
                        
                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600">
                                <i class="fa-solid fa-toggle-on text-lg"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-[#3B2115]">
                                    Status Produk
                                </p>
                                <p class="mt-1 text-[11px] text-[#8A7568]">
                                    Atur visibilitas produk.
                                </p>
                            </div>

                        </div>

                        <div id="statusContainer" class="flex items-center justify-between rounded-xl border border-green-100 bg-green-50/70 p-4">

                            <div class="pr-3">
                                <p id="statusLabel" class="text-xs font-bold text-green-700">
                                    Produk Aktif
                                </p>
                                <p id="statusKeterangan" class="mt-1 text-[10px] leading-5 text-[#72594B]">
                                    Produk dapat dilihat pelanggan.
                                </p>
                            </div>

                            <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                                <input type="hidden" name="is_active" value="0">

                                <input id="statusAktif"
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    class="peer sr-only"
                                    @checked((bool) old('is_active', $produk->is_active))>

                                <span class="relative h-6 w-11 rounded-full bg-gray-200 transition peer-checked:bg-green-500">
                                    <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></span>
                                </span>

                            </label>

                        </div>
                        
                    </section>

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">

                        <p class="mb-5 text-sm font-bold text-[#3B2115]">
                            Ringkasan Produk
                        </p>

                        <div class="space-y-4">

                            <div class="flex items-start justify-between gap-3">
                                <span class="text-xs text-[#8A7568]">Nama Toko</span>
                                <span class="text-right text-xs font-semibold text-[#3B2115]">Dapur Bu Siti</span>
                            </div>

                            <div class="flex items-start justify-between gap-3">
                                <span class="text-xs text-[#8A7568]">Kategori</span>
                                <span id="ringkasanKategori" class="text-right text-xs font-semibold text-[#3B2115]">Makanan</span>
                            </div>

                            <div class="flex items-start justify-between gap-3">
                                <span class="text-xs text-[#8A7568]">Harga</span>
                                <span id="ringkasanHarga" class="text-right text-xs font-bold text-orange-600">Rp25.000</span>
                            </div>

                            <div class="flex items-start justify-between gap-3">
                                <span class="text-xs text-[#8A7568]">Stok</span>
                                <span id="ringkasanStok" class="text-right text-xs font-semibold text-[#3B2115]">45 Pcs</span>
                            </div>

                            <div class="border-t border-dashed border-orange-100 pt-4">
                                <p class="text-[10px] leading-5 text-[#9A8577]">
                                    Ringkasan akan diperbarui saat kamu mengubah informasi di formulir.
                                </p>
                            </div>

                        </div>

                    </section>

                    <section class="rounded-2xl border border-orange-100 bg-linear-to-br from-orange-50 to-[#FFF0DF] p-5">

                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white text-orange-600 shadow-sm">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>

                        <h3 class="text-sm font-bold text-[#3B2115]">
                            Tips Produk
                        </h3>

                        <ul class="mt-3 space-y-3 text-xs leading-5 text-[#72594B]">
                            <li class="flex gap-2">
                                <i class="fa-solid fa-circle-check mt-1 text-orange-500"></i>
                                Gunakan nama produk yang mudah dicari.
                            </li>
                            <li class="flex gap-2">
                                <i class="fa-solid fa-circle-check mt-1 text-orange-500"></i>
                                Pastikan harga dan stok selalu sesuai.
                            </li>
                            <li class="flex gap-2">
                                <i class="fa-solid fa-circle-check mt-1 text-orange-500"></i>
                                Tambahkan deskripsi yang informatif.
                            </li>
                        </ul>

                    </section>

                </div>

            </div>

            <div class="sticky bottom-0 z-20 mt-6 flex flex-col-reverse gap-3 rounded-2xl border border-[#F1DCC8] bg-white/95 p-4 shadow-lg backdrop-blur sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <p class="hidden text-xs text-[#8A7568] sm:block">
                    <i class="fa-solid fa-shield-halved mr-1 text-green-600"></i>
                    Periksa kembali informasi sebelum menyimpan.
                </p>

                <div class="flex flex-col-reverse gap-3 sm:flex-row">

                    <a href="{{ url()->previous() }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#E8D7C8] bg-white px-5 py-3 text-xs font-bold text-[#72594B] transition hover:bg-gray-50">
                        Batal
                    </a>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#E85D04] px-6 py-3 text-xs font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-[#D94F00] active:scale-[.98]">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </form>

    </div>

</main>

@endsection