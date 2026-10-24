@extends('layouts.seller')

@section('title', 'Tambah Produk - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F4] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <section
                class="relative mb-7 overflow-hidden rounded-lg bg-linear-to-br from-[#FFF0DF] via-[#FFE2C5] to-[#FFC88C] p-6 sm:p-8 lg:p-10">

                <div class="pointer-events-none absolute -right-12 -top-20 h-64 w-64 rounded-full bg-white/50 blur-3xl">
                </div>
                <div
                    class="pointer-events-none absolute -bottom-24 right-1/3 h-56 w-56 rounded-full bg-orange-300/30 blur-3xl">
                </div>

                <div class="relative flex flex-col justify-between gap-6 lg:flex-row lg:items-center">
                    <div class="max-w-2xl">
                        <span
                            class="mb-4 inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white/75 px-3.5 py-2 text-xs font-extrabold tracking-wide text-orange-700 shadow-sm">
                            <i class="fa-solid fa-store"></i>
                            LOKAMARKET SELLER CENTER
                        </span>

                        <h1 class="text-3xl font-black tracking-tight text-[#3B2115] sm:text-4xl">
                            Tambahkan produk
                            <span class="text-orange-600">unggulanmu</span>
                        </h1>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-[#72594B] sm:text-base">
                            Buat halaman produk yang menarik dengan informasi lengkap dan
                            foto berkualitas agar pelanggan lebih mengenal produkmu.
                        </p>
                    </div>

                    <button onclick="history.back()"
                        class="inline-flex w-fit shrink-0 items-center gap-2 rounded-2xl border border-white/80 bg-white/80 px-5 py-3.5 text-sm font-bold text-[#654633] shadow-sm transition hover:-translate-y-0.5 hover:bg-white">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali ke Produk
                    </button>
                </div>

            </section>

            <x-alert-session />

            <form id="productForm" action="{{ route('seller.storeProduk') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 items-start gap-6 xl:grid-cols-[minmax(0,1fr)_350px]">

                @csrf

                <div class="space-y-6">

                    <section
                        class="overflow-hidden rounded-[26px] border border-[#F0DFD1] bg-white shadow-[0_8px_30px_rgba(100,55,25,0.04)]">

                        <div class="flex items-center gap-4 border-b border-[#F5EAE1] px-5 py-5 sm:px-7">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-extrabold text-[#3B2115]">Informasi produk</h2>
                                <p class="mt-1 text-sm text-[#94796A]">Masukkan detail produk yang akan dijual.</p>
                            </div>
                        </div>

                        <div class="space-y-5 p-5 sm:p-7">

                            <div>

                                <label for="nama" class="mb-2 block text-sm font-bold text-[#503626]">
                                    Nama produk <span class="text-orange-600">*</span>
                                </label>

                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                    autocomplete="off" minlength="3" maxlength="150"
                                    placeholder="Contoh: Keripik Pisang Cokelat"
                                    class="w-full rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] px-4 py-3.5 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B8A397] focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100">

                                <p id="nama-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                                <div class="mt-2 flex justify-between gap-3">
                                    <p class="text-xs text-[#A18A7B]">Gunakan nama yang jelas dan mudah diingat.</p>
                                    <span id="nameCounter" class="shrink-0 text-xs text-[#A18A7B]">0/150</span>
                                </div>

                            </div>

                            <div>

                                <label for="kategori_id" class="mb-2 block text-sm font-bold text-[#503626]">
                                    Kategori <span class="text-orange-600">*</span>
                                </label>

                                <div class="relative">

                                    <select id="kategori_id" name="kategori_id" required
                                        class="w-full appearance-none rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] px-4 py-3.5 pr-11 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100">

                                        <option value="">Pilih kategori produk</option>

                                        @forelse ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @empty
                                            <option value="" disabled>
                                                Belum ada kategori tersedia
                                            </option>
                                        @endforelse
                                    </select>

                                    <i
                                        class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#A18A7B]"></i>

                                </div>

                                <p id="kategori-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                            </div>

                            <div>

                                <div class="mb-2 flex items-center justify-between gap-3">
                                    <label for="deskripsi" class="block text-sm font-bold text-[#503626]">
                                        Deskripsi produk <span class="text-orange-600">*</span>
                                    </label>
                                    <span id="descriptionCounter" class="shrink-0 text-xs text-[#A18A7B]">0/1000</span>
                                </div>

                                <textarea id="deskripsi" name="deskripsi" rows="6" required minlength="10" maxlength="1000"
                                    placeholder="Ceritakan keunggulan, bahan, ukuran, rasa, cara penggunaan, atau informasi penting lainnya..."
                                    class="w-full resize-y rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] px-4 py-3.5 text-sm leading-6 text-[#3B2115] outline-none transition placeholder:text-[#B8A397] focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100">{{ old('deskripsi') }}</textarea>

                                <p id="deskripsi-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                                <p class="mt-2 text-xs text-[#A18A7B]">Minimal 10 dan maksimal 1.000 karakter.</p>

                            </div>

                        </div>

                    </section>

                    <section
                        class="overflow-hidden rounded-[26px] border border-[#F0DFD1] bg-white shadow-[0_8px_30px_rgba(100,55,25,0.04)]">

                        <div class="flex items-center gap-4 border-b border-[#F5EAE1] px-5 py-5 sm:px-7">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                                <i class="fa-solid fa-images text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-extrabold text-[#3B2115]">Foto produk</h2>
                                <p class="mt-1 text-sm text-[#94796A]">Unggah 1 thumbnail dan maksimal 4 foto preview.</p>
                            </div>
                        </div>

                        <div class="space-y-7 p-5 sm:p-7">

                            <div>
                                <div class="mb-3">
                                    <p class="text-sm font-extrabold text-[#503626]">
                                        Thumbnail utama <span class="text-orange-600">*</span>
                                    </p>
                                    <p class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Foto utama yang akan ditampilkan pada kartu produk.
                                    </p>
                                </div>

                                <label for="thumbnail"
                                    class="group flex min-h-47 cursor-pointer flex-col items-center justify-center rounded-[22px] border-2 border-dashed border-[#E9D5C4] bg-[#FFFAF5] p-5 text-center transition hover:border-orange-400 hover:bg-orange-50/60">

                                    <img id="thumbnailPreview"
                                        class="mb-4 hidden h-40 w-40 rounded-2xl border border-[#F0DFD1] object-cover shadow-sm"
                                        alt="Pratinjau thumbnail">

                                    <div id="thumbnailPlaceholder" class="flex flex-col items-center">
                                        <span
                                            class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                                            <i class="fa-solid fa-image text-2xl"></i>
                                        </span>
                                        <p class="font-extrabold text-[#503626]">Pilih foto thumbnail</p>
                                        <p class="mt-1 text-xs text-[#94796A]">Klik untuk memilih satu foto</p>
                                    </div>

                                    <span
                                        class="mt-4 rounded-full bg-white px-4 py-2 text-xs font-bold text-orange-700 shadow-sm">
                                        JPG, JPEG, PNG, WEBP · Maks. 2 MB
                                    </span>

                                </label>

                                <input type="file" id="thumbnail" name="thumbnail"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="sr-only"
                                    required>

                                <p id="thumbnailError" class="mt-2 hidden text-sm font-semibold text-red-600"></p>

                            </div>

                            <div class="border-t border-[#F5EAE1]"></div>

                            <div>

                                <div class="mb-3 flex flex-col justify-between gap-2 sm:flex-row sm:items-end">
                                    <div>
                                        <p class="text-sm font-extrabold text-[#503626]">
                                            Foto preview
                                        </p>
                                        <p class="mt-1 text-xs leading-5 text-[#94796A]">
                                            Tambahkan foto dari sudut atau detail produk yang berbeda.
                                        </p>
                                    </div>
                                    <span id="previewPhotoCount"
                                        class="inline-flex w-fit items-center rounded-full bg-orange-50 px-3.5 py-2 text-xs font-extrabold text-orange-700">
                                        0 / 4 foto
                                    </span>
                                </div>

                                <label for="preview_photos" id="previewUploadArea"
                                    class="group flex min-h-40 cursor-pointer flex-col items-center justify-center rounded-[22px] border-2 border-dashed border-[#E9D5C4] bg-[#FFFAF5] p-5 text-center transition hover:border-orange-400 hover:bg-orange-50/60">

                                    <span
                                        class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                                        <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                                    </span>

                                    <p class="font-extrabold text-[#503626]">Pilih foto preview</p>

                                    <p class="mt-1 text-xs text-[#94796A]">Bisa memilih beberapa foto sekaligus</p>

                                    <span
                                        class="mt-4 rounded-full bg-white px-4 py-2 text-xs font-bold text-orange-700 shadow-sm">
                                        Maksimal 4 foto · 2 MB per foto
                                    </span>

                                </label>

                                <input type="file" id="preview_photos" name="preview_photos[]"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" multiple
                                    class="sr-only">

                                <p id="previewPhotosError" class="mt-2 hidden text-sm font-semibold text-red-600"></p>

                                <div id="previewGallery" class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4"></div>

                            </div>

                            <div class="flex items-start gap-3 rounded-2xl border border-blue-100 bg-blue-50/80 p-4">
                                <i class="fa-solid fa-lightbulb mt-0.5 text-blue-600"></i>
                                <div>
                                    <p class="text-sm font-bold text-blue-900">
                                        Tips foto produk
                                    </p>
                                    <p class="mt-1 text-xs leading-5 text-blue-800">
                                        Gunakan foto yang terang dan tidak buram. Thumbnail sebaiknya menampilkan
                                        produk secara jelas, sedangkan foto preview dapat memperlihatkan detailnya.
                                    </p>
                                </div>
                            </div>

                        </div>

                    </section>

                    <section
                        class="overflow-hidden rounded-[26px] border border-[#F0DFD1] bg-white shadow-[0_8px_30px_rgba(100,55,25,0.04)]">

                        <div class="flex items-center gap-4 border-b border-[#F5EAE1] px-5 py-5 sm:px-7">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                                <i class="fa-solid fa-wallet text-lg"></i>
                            </div>

                            <div>
                                <p class="text-lg font-extrabold text-[#3B2115]">
                                    Harga & persediaan
                                </p>
                                <p class="mt-1 text-sm text-[#94796A]">
                                    Tentukan harga jual dan jumlah stok.
                                </p>
                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-7">

                            <div>

                                <label for="harga" class="mb-2 block text-sm font-bold text-[#503626]">
                                    Harga jual (Rp) <span class="text-orange-600">*</span>
                                </label>

                                <div
                                    class="flex overflow-hidden rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] transition focus-within:border-orange-400 focus-within:bg-white focus-within:ring-4 focus-within:ring-orange-100">
                                    <span
                                        class="flex items-center border-r border-[#EEDDD0] bg-orange-50 px-4 text-sm font-extrabold text-orange-700">Rp</span>
                                    <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                                        required min="1" step="1" placeholder="25000"
                                        class="min-w-0 w-full bg-transparent px-4 py-3.5 text-sm text-[#3B2115] outline-none placeholder:text-[#B8A397]">
                                </div>

                                <p id="harga-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                                <p class="mt-2 text-xs text-[#A18A7B]">
                                    Masukkan nominal tanpa titik atau koma.
                                </p>

                            </div>

                            <div>

                                <label for="stok" class="mb-2 block text-sm font-bold text-[#503626]">
                                    Stok tersedia <span class="text-orange-600">*</span>
                                </label>

                                <div
                                    class="flex overflow-hidden rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] transition focus-within:border-orange-400 focus-within:bg-white focus-within:ring-4 focus-within:ring-orange-100">
                                    <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}"
                                        required min="0" step="1" placeholder="50"
                                        class="min-w-0 w-full bg-transparent px-4 py-3.5 text-sm text-[#3B2115] outline-none placeholder:text-[#B8A397]">
                                    <span
                                        class="flex items-center border-l border-[#EEDDD0] bg-orange-50 px-4 text-sm font-bold text-[#94796A]">Unit</span>
                                </div>

                                <p id="stok-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                                <p class="mt-2 text-xs text-[#A18A7B]">Isi 0 jika produk belum tersedia.</p>

                            </div>

                            <div>

                                <label for="berat_input" class="mb-2 block text-sm font-bold text-[#503626]">
                                    Berat produk <span class="text-orange-600">*</span>
                                </label>

                                <div
                                    class="flex overflow-hidden rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] transition focus-within:border-orange-400 focus-within:bg-white focus-within:ring-4 focus-within:ring-orange-100">

                                    <input type="number" id="berat_input" name="berat_input"
                                        value="{{ old('berat_input') }}" required min="1" step="1"
                                        inputmode="decimal" placeholder="500"
                                        class="min-w-0 w-full bg-transparent px-4 py-3.5 text-sm text-[#3B2115] outline-none placeholder:text-[#B8A397]">

                                    <select id="berat_satuan" name="berat_satuan"
                                        class="border-l border-[#EEDDD0] bg-orange-50 px-3 text-sm font-bold text-[#72594B] outline-none">
                                        <option value="gram"
                                            {{ old('berat_satuan', 'gram') === 'gram' ? 'selected' : '' }}>
                                            Gram
                                        </option>
                                        <option value="kg" {{ old('berat_satuan') === 'kg' ? 'selected' : '' }}>
                                            Kg
                                        </option>
                                    </select>

                                </div>

                                <input type="hidden" id="berat" name="berat" value="{{ old('berat') }}">

                                <p id="berat-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                                <p id="berat-hint" class="mt-2 text-xs text-[#A18A7B]">
                                    Berat satu produk, termasuk kemasan jika diperlukan.
                                </p>

                                <p class="mt-1 text-xs font-semibold text-orange-700">
                                    Berat untuk ongkir: <span id="berat-konversi">—</span>
                                </p>
                            </div>


                        </div>

                    </section>

                </div>

                <aside class="space-y-6 xl:sticky xl:top-6">

                    <section
                        class="overflow-hidden rounded-[26px] border border-[#F0DFD1] bg-white shadow-[0_8px_30px_rgba(100,55,25,0.05)]">

                        <div class="flex items-center justify-between border-b border-[#F5EAE1] px-5 py-4">
                            <div>
                                <p class="font-extrabold text-[#3B2115]">
                                    Pratinjau produk
                                </p>
                                <p class="mt-1 text-xs text-[#94796A]">
                                    Gambaran kartu produkmu
                                </p>
                            </div>
                            <span
                                class="rounded-full bg-orange-50 px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-wide text-orange-700">
                                Preview
                            </span>
                        </div>

                        <div class="p-4">
                            <div class="overflow-hidden rounded-2xl border border-[#F1E4D9] bg-[#FFFCF9]">

                                <div
                                    class="relative flex aspect-square items-center justify-center overflow-hidden bg-[#FFF3E8]">
                                    <div id="previewPlaceholder" class="flex flex-col items-center text-orange-300">
                                        <i class="fa-solid fa-image text-5xl"></i>
                                        <p class="mt-3 text-xs font-semibold text-[#B49A88]">
                                            Foto produk akan tampil di sini
                                        </p>
                                    </div>
                                    <img id="mainProductPreview" src="" alt="Thumbnail produk"
                                        class="absolute inset-0 hidden h-full w-full object-cover">
                                    <span
                                        class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1.5 text-[10px] font-extrabold text-orange-700 shadow-sm">
                                        PRODUK LOKAL
                                    </span>
                                </div>

                                <div class="p-4">

                                    <p id="previewCategory"
                                        class="text-[10px] font-extrabold uppercase tracking-wider text-orange-600">
                                        Kategori produk
                                    </p>

                                    <p id="previewName"
                                        class="mt-2 line-clamp-2 min-h-10 text-base font-extrabold text-[#3B2115]">
                                        Nama produkmu
                                    </p>

                                    <p id="previewDescription"
                                        class="mt-2 line-clamp-2 min-h-10 text-xs leading-5 text-[#94796A]">
                                        Deskripsi singkat produk akan terlihat di bagian ini.
                                    </p>

                                    <div
                                        class="mt-4 flex items-center justify-between gap-2 border-t border-[#F1E4D9] pt-4">
                                        <p id="previewPrice" class="text-lg font-black text-orange-600">Rp0</p>
                                        <span class="rounded-xl bg-orange-500 px-3 py-2 text-xs font-bold text-white">
                                            <i class="fa-solid fa-bag-shopping mr-1"></i> Beli
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <p class="mt-3 text-center text-[11px] leading-5 text-[#A18A7B]">
                                Ini hanya pratinjau visual, bukan tampilan final halaman produk.
                            </p>

                        </div>

                    </section>

                    <section
                        class="rounded-[26px] border border-[#F0DFD1] bg-white p-5 shadow-[0_8px_30px_rgba(100,55,25,0.04)] sm:p-6">

                        <div class="mb-5 flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                                <i class="fa-solid fa-sliders"></i>
                            </div>

                            <div>
                                <h2 class="font-extrabold text-[#3B2115]">Publikasi produk</h2>
                                <p class="mt-1 text-xs text-[#94796A]">Atur visibilitas etalase.</p>
                            </div>

                        </div>

                        <label for="is_active" class="mb-2 block text-sm font-bold text-[#503626]">Status produk</label>

                        <div class="relative">

                            <select id="is_active" name="is_active"
                                class="w-full appearance-none rounded-2xl border border-[#EEDDD0] bg-[#FFFCF9] px-4 py-3.5 pr-11 text-sm font-semibold text-[#3B2115] outline-none transition focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100">
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Tidak Aktif
                                </option>
                            </select>

                            <i
                                class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#A18A7B]"></i>

                        </div>

                        <p id="status-error" class="mt-2 hidden text-sm font-medium text-red-600"></p>

                        <p class="mt-3 text-xs leading-5 text-[#94796A]">
                            Produk aktif dapat ditampilkan kepada pelanggan. Produk tidak aktif disembunyikan dari etalase.
                        </p>

                    </section>

                    <section
                        class="rounded-[26px] border border-[#F0DFD1] bg-white p-5 shadow-[0_8px_30px_rgba(100,55,25,0.04)] sm:p-6">

                        <div class="mb-5 flex items-center justify-between gap-3">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>

                                <div>
                                    <p class="font-extrabold text-[#3B2115]">
                                        Checklist produk
                                    </p>
                                    <p class="mt-1 text-xs text-[#94796A]">
                                        Pastikan semua persyaratan terpenuhi.
                                    </p>
                                </div>
                            </div>

                            <span id="checklistProgress"
                                class="shrink-0 rounded-full bg-orange-50 px-3 py-1.5 text-xs font-extrabold text-orange-700">
                                0/6
                            </span>

                        </div>

                        <div class="mb-5 h-2 overflow-hidden rounded-full bg-[#F5EAE1]">
                            <div id="checklistProgressBar"
                                class="h-full w-0 rounded-full bg-orange-500 transition-all duration-300"></div>
                        </div>

                        <ul class="space-y-4">

                            <li class="flex items-start gap-3">

                                <span id="check-name-icon"
                                    class="checklist-icon flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p id="check-name-title" class="text-sm font-bold text-[#503626]">
                                        Nama produk
                                    </p>
                                    <p id="check-name-desc" class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Isi nama produk minimal 3 karakter.
                                    </p>
                                </div>

                            </li>

                            <li class="flex items-start gap-3">

                                <span id="check-category-icon"
                                    class="checklist-icon flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p id="check-category-title" class="text-sm font-bold text-[#503626]">
                                        Kategori produk
                                    </p>
                                    <p id="check-category-desc" class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Pilih kategori yang sesuai.
                                    </p>
                                </div>

                            </li>

                            <li class="flex items-start gap-3">

                                <span id="check-description-icon"
                                    class="checklist-icon flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p id="check-description-title" class="text-sm font-bold text-[#503626]">
                                        Deskripsi produk
                                    </p>
                                    <p id="check-description-desc" class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Isi deskripsi minimal 10 karakter.
                                    </p>
                                </div>

                            </li>

                            <li class="flex items-start gap-3">

                                <span id="check-gallery-icon"
                                    class="checklist-icon flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p id="check-gallery-title" class="text-sm font-bold text-[#503626]">
                                        Foto preview
                                    </p>
                                    <p id="check-gallery-desc" class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Unggah minimal 1 dan maksimal 4 foto.
                                    </p>
                                </div>

                            </li>

                            <li class="flex items-start gap-3">

                                <span id="check-thumbnail-icon"
                                    class="checklist-icon flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p id="check-thumbnail-title" class="text-sm font-bold text-[#503626]">
                                        Thumbnail utama
                                    </p>
                                    <p id="check-thumbnail-desc" class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Pilih gambar yang valid, maksimal 2 MB.
                                    </p>
                                </div>

                            </li>

                            <li class="flex items-start gap-3">

                                <span id="check-inventory-icon"
                                    class="checklist-icon flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p id="check-inventory-title" class="text-sm font-bold text-[#503626]">
                                        Harga, stok, dan berat
                                    </p>
                                    <p id="check-inventory-desc" class="mt-1 text-xs leading-5 text-[#94796A]">
                                        Masukkan harga, jumlah stok, dan berat produk yang valid.
                                    </p>
                                </div>

                            </li>

                        </ul>

                        <div id="checklistComplete"
                            class="mt-5 hidden rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-circle-check mt-0.5 text-emerald-600"></i>

                                <div>
                                    <p class="text-sm font-extrabold text-emerald-800">
                                        Produk siap disimpan!
                                    </p>
                                    <p class="mt-1 text-xs leading-5 text-emerald-700">
                                        Semua persyaratan checklist sudah terpenuhi.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </section>

                    <section
                        class="rounded-[26px] border border-[#F0DFD1] bg-white p-5 shadow-[0_8px_30px_rgba(100,55,25,0.04)] sm:p-6">

                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-linear-to-r from-orange-500 to-[#D9490B] px-5 py-4 text-sm font-extrabold text-white shadow-lg shadow-orange-200/70 transition hover:-translate-y-0.5 hover:shadow-orange-300/80 active:translate-y-0">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            Simpan Produk
                        </button>

                        <a href="{{ route('seller.produk') }}"
                            class="mt-3 flex w-full items-center justify-center gap-2 rounded-2xl border border-[#EEDDD0] bg-white px-5 py-3.5 text-sm font-bold text-[#72594B] transition hover:bg-[#FFF7EF]">
                            <i class="fa-solid fa-xmark"></i>
                            Batal
                        </a>

                        <p class="mt-4 text-center text-xs leading-5 text-[#A18A7B]">
                            Pastikan seluruh informasi produk sudah benar sebelum disimpan.
                        </p>

                    </section>

                </aside>

            </form>

        </div>
    </main>

@endsection
