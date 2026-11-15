
@extends('layouts.customer')

@section('title', 'Beri Penilaian Produk - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#FFF9F2] py-10">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8">

            <a href="{{ route('cust.pesananSaya') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-[#72594B] transition hover:text-[#FF6B00]">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke pesanan
            </a>

            <div class="mt-5 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

                <div>

                    <span class="inline-flex items-center gap-2 rounded-full bg-orange-100 px-3 py-1.5 text-xs font-semibold text-[#D9490B]">
                        <i class="fa-solid fa-star"></i>
                        Penilaian Produk
                    </span>

                    <h1 class="mt-4 text-2xl font-bold text-[#3B2115] sm:text-3xl">
                        Bagikan Pengalamanmu
                    </h1>

                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#72594B]">
                        Berikan penilaian jujur untuk produk yang kamu terima.
                        Ulasanmu membantu pembeli lain dan mendukung UMKM lokal.
                    </p>

                </div>

                <div class="flex items-center gap-3 rounded-2xl border border-[#F1DCC8] bg-white px-4 py-3">
                    
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#FF6B00]">
                        <i class="fa-solid fa-shield-heart text-lg"></i>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-[#3B2115]">Ulasan Terpercaya</p>
                        <p class="mt-1 text-[11px] text-[#72594B]">Dari pembeli terverifikasi</p>
                    </div>

                </div>

            </div>

        </div>

        <x-alert-session />

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-2 font-bold">Penilaian gagal dikirim:</p>
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cust.ratingPesanan.send', $pesanan->nomor_pesanan) }}"
            method="POST"
            enctype="multipart/form-data"
            id="reviewForm">

            @csrf

            <div class="grid gap-6 lg:grid-cols-[1fr_300px]">

                <div class="space-y-6">

                    @forelse ($pesanan->detail as $detail)

                        <section class="review-card overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm"
                                data-review-card
                                data-detail-id="{{ $detail->id }}">

                            <div class="border-b border-[#F3E5D9] px-6 py-5 sm:px-7">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#FF6B00]">
                                        <i class="fa-solid fa-star"></i>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <h2 class="font-bold text-[#3B2115]">
                                            Penilaian Produk
                                        </h2>
                                        <p class="mt-1 text-xs text-[#72594B]">
                                            Produk #{{ $loop->iteration }}
                                        </p>
                                    </div>

                                    @if ($detail->ulasan)
                                        <span class="inline-flex shrink-0 items-center gap-1 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Sudah Dinilai
                                        </span>
                                    @else
                                        <span class="rounded-full bg-orange-50 px-3 py-1.5 text-xs font-semibold text-[#D9490B]">
                                            Belum Dinilai
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="p-6 sm:p-7">

                                <div class="flex gap-4">
                                    
                                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-2xl border border-[#F3E5D9] bg-[#FFF3E5] sm:h-28 sm:w-28">

                                        @if ($detail->produk?->thumbnail?->foto)
                                            <img src="{{ asset('storage/' . $detail->produk->thumbnail->foto) }}"
                                                alt="{{ $detail->nama_produk }}"
                                                class="h-full w-full object-cover"
                                                onerror="this.style.display='none'">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-3xl text-[#FF6B00]">
                                                <i class="fa-solid fa-box"></i>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <h3 class="font-bold text-[#3B2115]">
                                            {{ $detail->nama_produk }}
                                        </h3>

                                        <p class="mt-1 text-xs text-[#72594B]">
                                            <i class="fa-solid fa-store mr-1 text-[#FF6B00]"></i>
                                            {{ $detail->nama_toko ?? $detail->produk?->toko?->nama_toko ?? 'Toko UMKM' }}
                                        </p>

                                        <p class="mt-3 text-xs text-[#72594B]">
                                            {{ $detail->quantity }} ×
                                            Rp{{ number_format($detail->harga, 0, ',', '.') }}
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-[#FF6B00]">
                                            Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>

                                @if ($detail->ulasan)
                                    <div class="mt-6 rounded-2xl border border-green-100 bg-green-50 p-4">
                                        
                                        <div class="flex items-center justify-between gap-3">

                                            <p class="text-sm font-bold text-green-800">
                                                Penilaian kamu
                                            </p>

                                            <div class="flex gap-1 text-[#FFB21C]">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $detail->ulasan->rating ? '' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>

                                        </div>

                                        <p class="mt-3 text-sm leading-6 text-green-900">
                                            {{ $detail->ulasan->ulasan }}
                                        </p>

                                    </div>
                                @else
                                    <div class="mt-7 border-t border-dashed border-[#E8D5C5] pt-6">
                                        
                                        <p class="text-sm font-bold text-[#3B2115]">
                                            Bagaimana kualitas produk ini?
                                        </p>

                                        <input type="hidden"
                                            name="rating[{{ $detail->id }}]"
                                            class="rating-value"
                                            value="{{ old('rating.' . $detail->id, 0) }}">

                                        <div class="mt-4">

                                            <div class="flex gap-2 rounded-2xl border-2 border-transparent p-1 transition"
                                                data-rating-stars>

                                                @for ($i = 1; $i <= 5; $i++)
                                                    <button
                                                        type="button"
                                                        data-rating="{{ $i }}"
                                                        aria-label="Rating {{ $i }} bintang"
                                                        class="rating-star flex h-11 w-11 items-center justify-center rounded-xl bg-[#FFF9F2] text-xl text-[#E8DCCF] transition hover:scale-110 sm:h-12 sm:w-12">

                                                        <i class="fa-solid fa-star"></i>

                                                    </button>
                                                @endfor

                                            </div>

                                            <p class="rating-label mt-3 text-sm font-bold text-[#3B2115]">
                                                Pilih rating produk
                                            </p>

                                            <p class="rating-description mt-1 text-xs text-[#72594B]">
                                                Ketuk salah satu bintang untuk memberikan penilaian.
                                            </p>

                                            <p class="rating-validation-error mt-2 hidden text-xs font-medium text-red-500"></p>

                                        </div>

                                    </div>

                                    <div class="mt-6">

                                        <label class="mb-2 block text-sm font-semibold text-[#3B2115]">
                                            Ceritakan pengalamanmu
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <textarea
                                            name="ulasan[{{ $detail->id }}]"
                                            rows="4"
                                            maxlength="1000"
                                            minlength="10"
                                            required
                                            placeholder="Tuliskan pengalamanmu setelah menerima produk ini..."
                                            class="review-textarea w-full resize-none rounded-2xl border border-[#F1DCC8] bg-[#FFFCF9] px-4 py-4 text-sm leading-7 text-[#3B2115] outline-none transition placeholder:text-[#B7A397] focus:border-[#FF6B00] focus:bg-white focus:ring-2 focus:ring-orange-100"
                                        >{{ old('ulasan.' . $detail->id) }}</textarea>

                                        <div class="mt-2 flex justify-between text-xs text-[#A58C7D]">
                                            <span>Minimal 10 karakter</span>
                                            <span>
                                                <span class="char-count">0</span>/1000
                                            </span>
                                        </div>

                                        <p class="review-validation-error mt-2 hidden text-xs font-medium text-red-500"></p>

                                    </div>

                                    <div class="mt-6">

                                        <p class="mb-3 text-sm font-semibold text-[#3B2115]">
                                            Foto produk
                                            <span class="text-xs font-normal text-[#A58C7D]">(Opsional)</span>
                                        </p>

                                        <input type="file"
                                            name="foto[{{ $detail->id }}][]"
                                            accept="image/jpeg,image/png,image/webp"
                                            multiple
                                            class="review-photo-input hidden">

                                        <div class="photo-preview grid grid-cols-3 gap-3 sm:grid-cols-5">

                                            <button type="button"
                                                    class="upload-photo flex aspect-square flex-col items-center justify-center rounded-2xl border-2 border-dashed border-[#EBCBAF] bg-[#FFFCF9] text-[#FF6B00] transition hover:border-[#FF6B00] hover:bg-orange-50">

                                                <i class="fa-solid fa-plus text-xl"></i>

                                                <span class="mt-2 text-[10px] font-semibold">
                                                    Tambah foto
                                                </span>

                                            </button>

                                        </div>

                                        <p class="mt-3 text-[11px] text-[#A58C7D]">
                                            JPG, PNG, WEBP · Maksimal 5 foto · 5 MB per foto.
                                        </p>

                                        <p class="photo-validation-error mt-2 hidden text-xs font-medium text-red-500"></p>

                                    </div>
                                @endif

                            </div>

                        </section>

                    @empty
                        <div class="rounded-2xl border border-[#F1DCC8] bg-white p-8 text-center">
                            <i class="fa-solid fa-box-open text-4xl text-[#E8C8A9]"></i>
                            <p class="mt-3 font-semibold text-[#3B2115]">
                                Tidak ada produk dalam pesanan ini.
                            </p>
                        </div>
                    @endforelse

                </div>

                <aside class="space-y-5">

                    <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm lg:sticky lg:top-6">

                        <div class="border-b border-[#F3E5D9] bg-[#FFFCF9] p-5">
                            
                            <p class="text-sm font-bold text-[#3B2115]">
                                Informasi Pesanan
                            </p>

                            <p class="mt-1 text-xs text-[#72594B]">
                                Ringkasan pesanan yang kamu nilai.
                            </p>
                            
                        </div>

                        <div class="p-5">
                            
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-3 py-1 text-[10px] font-semibold text-green-700">
                                <i class="fa-solid fa-circle-check"></i>
                                Pesanan diterima
                            </span>

                            <p class="mt-4 text-xs text-[#72594B]">
                                Nomor Pesanan
                            </p>

                            <p class="mt-1 break-all text-sm font-bold text-[#3B2115]">
                                {{ $pesanan->nomor_pesanan }}
                            </p>

                            <p class="mt-4 text-xs text-[#72594B]">
                                Tanggal Pesanan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-[#3B2115]">
                                {{ $pesanan->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </p>

                            <div class="my-5 border-t border-dashed border-[#E8D5C5]"></div>

                            <div class="flex justify-between gap-3 text-sm">
                                <span class="text-[#72594B]">Jumlah produk</span>
                                <span class="font-semibold text-[#3B2115]">
                                    {{ $pesanan->detail->count() }} produk
                                </span>
                            </div>

                            <div class="mt-3 flex justify-between gap-3 text-sm">
                                <span class="text-[#72594B]">Total pembayaran</span>
                                <span class="text-right font-bold text-[#FF6B00]">
                                    Rp{{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                    </section>

                    <div class="rounded-2xl border border-[#F1DCC8] bg-[#FFF3E5] p-4">
                        
                        <div class="flex items-start gap-3">

                            <i class="fa-solid fa-heart mt-1 text-[#FF6B00]"></i>

                            <div>

                                <p class="text-sm font-bold text-[#3B2115]">
                                    Dukung UMKM Lokal
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#72594B]">
                                    Penilaianmu membantu pelaku UMKM meningkatkan kualitas produk dan pelayanan.
                                </p>

                            </div>

                        </div>

                    </div>

                </aside>

            </div>

            @if ($pesanan->detail->contains(fn ($detail) => !$detail->ulasan))
                <div class="mt-8 flex flex-col-reverse gap-3 border-t border-[#F1DCC8] pt-6 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-center text-xs text-[#72594B] sm:text-left">
                        <i class="fa-solid fa-circle-info mr-1 text-[#FF6B00]"></i>
                        Pastikan penilaian sesuai pengalamanmu.
                    </p>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row">
                        
                        <a href="{{ route('cust.pesananSaya') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-[#F1DCC8] bg-white px-6 py-3 text-sm font-semibold text-[#72594B] transition hover:bg-[#FFF3E5]">
                            Nanti Saja
                        </a>

                        <button type="submit"
                                id="submitReviewButton"
                                disabled
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#D9490B] disabled:cursor-not-allowed disabled:opacity-50">

                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim Penilaian

                        </button>

                    </div>

                </div>
            @else
                <div class="mt-8 rounded-2xl border border-green-200 bg-green-50 p-5 text-center">

                    <i class="fa-solid fa-circle-check text-2xl text-green-600"></i>
                    
                    <p class="mt-2 font-bold text-green-800">
                        Semua produk sudah dinilai.
                    </p>

                    <a href="{{ route('cust.pesananSaya') }}"
                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700">
                        Kembali ke Pesanan
                    </a>

                </div>
            @endif

        </form>

    </div>

</main>
@endsection
