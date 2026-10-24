@extends('layouts.customer')

@section('title', 'Pesanan Saya - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#FFF9F2] py-8 sm:py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <section class="mb-8">

            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-[#FF6B00]">
                    <i class="fa-solid fa-box-open text-xl"></i>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-[#3B2115] sm:text-3xl">
                        Pesanan Saya
                    </h1>
                    <p class="mt-1 text-sm text-[#72594B]">
                        Pantau status dan riwayat belanja kamu.
                    </p>
                </div>

            </div>

        </section>

        <section class="mb-6 grid grid-cols-2 gap-3 lg:grid-cols-4">

            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">
                <p class="text-sm text-[#72594B]">Semua Pesanan</p>
                <p class="mt-2 text-2xl font-bold text-[#3B2115]">
                    {{ $jumlahPesanan ?? 0 }}
                </p>
            </div>

            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">
                <p class="text-sm text-[#72594B]">Menunggu Pembayaran</p>
                <p class="mt-2 text-2xl font-bold text-amber-600">
                    {{ $jumlahMenunggu ?? 0 }}
                </p>
            </div>

            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">
                <p class="text-sm text-[#72594B]">Sedang Diproses</p>
                <p class="mt-2 text-2xl font-bold text-blue-600">
                    {{ $jumlahDiproses ?? 0 }}
                </p>
            </div>

            <div class="rounded-2xl border border-[#F1DCC8] bg-white p-4">
                <p class="text-sm text-[#72594B]">Selesai</p>
                <p class="mt-2 text-2xl font-bold text-green-600">
                    {{ $jumlahSelesai ?? 0 }}
                </p>
            </div>

        </section>

        <section class="mb-6 rounded-2xl border border-[#F1DCC8] bg-white p-4 sm:p-5">

            <form action="{{ route('cust.pesananSaya') }}" method="GET"
                  class="flex flex-col gap-4 lg:flex-row lg:items-center">

                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-[#A58A79]"></i>
                    <input type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari nomor pesanan atau nama produk..."
                        class="w-full rounded-xl border border-[#E8D5C5] bg-[#FFFCF9] py-3 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#A58A79] focus:border-[#FF6B00] focus:ring-2 focus:ring-orange-100">
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    
                    <select name="status"
                            class="rounded-xl border border-[#E8D5C5] bg-white px-4 py-3 text-sm text-[#3B2115] outline-none focus:border-[#FF6B00]">
                        <option value="">Semua Status</option>
                        <option value="menunggu_pembayaran" @selected(request('status') === 'menunggu_pembayaran')>
                            Menunggu Pembayaran
                        </option>
                        <option value="dibayar" @selected(request('status') === 'dibayar')>
                            Pembayaran Berhasil
                        </option>
                        <option value="diproses" @selected(request('status') === 'diproses')>
                            Diproses
                        </option>
                        <option value="dikirim" @selected(request('status') === 'dikirim')>
                            Dikirim
                        </option>
                        <option value="selesai" @selected(request('status') === 'selesai')>
                            Selesai
                        </option>
                        <option value="dibatalkan" @selected(request('status') === 'dibatalkan')>
                            Dibatalkan
                        </option>
                    </select>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#D9490B]">
                        <i class="fa-solid fa-filter"></i>
                        Terapkan
                    </button>

                </div>

            </form>

        </section>

        <section class="space-y-5">

            @forelse ($pesanan as $item)
            <article class="overflow-hidden rounded-2xl border border-[#F1DCC8] bg-white shadow-sm transition hover:shadow-md">

                <div class="flex flex-col gap-3 border-b border-[#F3E5D9] p-4 sm:flex-row sm:items-center sm:justify-between sm:p-5">
                    
                    <div class="min-w-0">
                        <p class="text-xs text-[#72594B]">Nomor Pesanan</p>
                        <p class="mt-1 break-all font-bold text-[#3B2115]">
                            {{ $item->nomor_pesanan }}
                        </p>
                        <p class="mt-1 text-xs text-[#8B7160]">
                            {{ $item->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit shrink-0 items-center gap-2 rounded-full px-3 py-2 text-xs font-semibold ring-1 {{ $item->status_info['class'] }}">
                        <i class="fa-solid {{ $item->status_info['icon'] }}"></i>
                        {{ $item->status_info['label'] }}
                    </span>

                </div>

                <div class="p-4 sm:p-5">

                    @if ($item->detail_produk)
                    <div class="flex gap-4">

                        <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-[#FFF0E5] sm:h-24 sm:w-24">
                            @if ($item->detail_produk->produk->thumbnail)
                            <img src="{{ asset('storage/' . $item->detail_produk->produk->thumbnail->foto) }}"
                                alt="{{ $item->detail_produk->nama_produk }}"
                                class="h-full w-full object-cover"
                                onerror="this.style.display='none'">
                            @else
                            <div class="flex h-full items-center justify-center text-2xl text-[#FF6B00]">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            @endif
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="font-semibold text-[#3B2115]">
                                {{ $item->detail_produk->nama_produk }}
                            </p>

                            <p class="mt-1 text-sm text-[#72594B]">
                                {{ $item->detail_produk->nama_toko ?? 'Toko UMKM' }}
                            </p>

                            <p class="mt-2 text-sm text-[#72594B]">
                                {{ $item->detail_produk->quantity }} item
                                @if ($item->jumlah_jenis_produk > 1)
                                · dan {{ $item->jumlah_jenis_produk - 1 }} produk lainnya
                                @endif
                            </p>

                            <p class="mt-2 font-semibold text-[#3B2115]">
                                Rp{{ number_format($item->detail_produk->harga, 0, ',', '.') }}
                            </p>

                        </div>
                        
                    </div>
                    @else
                    <p class="text-sm text-[#72594B]">
                        Rincian produk tidak tersedia.
                    </p>
                    @endif

                    <div class="mt-5 flex flex-col gap-4 border-t border-dashed border-[#E8D5C5] pt-4 sm:flex-row sm:items-center sm:justify-between">
                        
                        <div>
                            <p class="text-xs text-[#72594B]">
                                {{ $item->jumlah_jenis_produk }} jenis produk
                                · {{ $item->jumlah_item }} item
                            </p>
                            <p class="mt-1 text-xs text-[#72594B]">
                                Total Pembayaran
                            </p>
                            <p class="mt-1 text-xl font-bold text-[#FF6B00]">
                                Rp{{ number_format($item->total_pembayaran, 0, ',', '.') }}
                            </p>
                        </div>

                        <a href="{{ route('cust.checkout.status', ['nomor_pesanan' => $item->nomor_pesanan]) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#D9490B]">
                            Lihat Detail
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </article>
            @empty
            <div class="rounded-3xl border border-dashed border-[#E8D5C5] bg-white px-5 py-14 text-center">
                
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#FFF0E5] text-[#FF6B00]">
                    <i class="fa-solid fa-bag-shopping text-3xl"></i>
                </div>

                <p class="mt-5 text-xl font-bold text-[#3B2115]">
                    Belum Ada Pesanan
                </p>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#72594B]">
                    @if (request()->filled('q') || request()->filled('status'))
                        Pesanan yang cocok dengan pencarian atau filter kamu tidak ditemukan.
                    @else
                        Kamu belum memiliki pesanan. Yuk, temukan produk UMKM lokal favoritmu!
                    @endif
                </p>

                <a href="{{ route('cust.landingPage') }}"
                class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#D9490B]">
                    <i class="fa-solid fa-store"></i>
                    Jelajahi Produk
                </a>
                
            </div>
            @endforelse

        </section>

        @if ($pesanan->hasPages())
            <div class="mt-8">
                {{ $pesanan->links() }}
            </div>
        @endif

    </div>
    
</main>
@endsection