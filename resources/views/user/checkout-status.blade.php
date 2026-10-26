@extends('layouts.customer')

@section('title', 'Status Pesanan - LokaMarket')

@section('content')
    <main class="min-h-screen bg-[#FFF9F2] py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8">

                <a href="{{ route('cust.pesananSaya') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-[#72594B] transition hover:text-[#FF6B00]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke beranda
                </a>

                <h1 class="mt-5 text-2xl font-bold text-[#3B2115] sm:text-3xl">
                    Status Pesanan
                </h1>

                <p class="mt-2 text-sm text-[#72594B]">
                    Pantau status pesanan dan pembayaran kamu di LokaMarket.
                </p>

            </div>

            <x-alert-session />

            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="mb-2 font-bold">
                        Pengajuan return gagal:
                    </p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

                <div class="border-b border-[#F3E5D9] p-6 sm:p-8">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <span class="text-sm text-[#72594B]">Nomor Pesanan</span>
                            <p class="mt-1 break-all text-lg font-bold text-[#3B2115]">
                                {{ $pesanan->nomor_pesanan }}
                            </p>
                            <p class="mt-2 text-sm text-[#72594B]">
                                Dibuat pada
                                {{ $pesanan->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                            </p>
                        </div>

                        <span
                            class="inline-flex w-fit items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold ring-1 {{ $statusInfo['class'] }}">
                            <i class="fa-solid {{ $statusInfo['icon'] }}"></i>
                            {{ $statusInfo['label'] }}
                        </span>

                    </div>

                    <div class="mt-6 rounded-2xl p-4 {{ $statusInfo['class'] }}">

                        <div class="flex items-start gap-3">
                            <i class="fa-solid {{ $statusInfo['icon'] }} mt-1"></i>
                            <p class="text-sm leading-6">
                                {{ $statusInfo['description'] }}
                            </p>
                        </div>

                    </div>

                    @if ($pesanan->status === 'menunggu_pembayaran')

                        @if ($pesanan->snap_token)
                            <button type="button" id="payAgainButton"
                                class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-5 py-3 font-semibold text-white transition hover:bg-[#D9490B] sm:w-auto"
                                data-snap-token="{{ $pesanan->snap_token }}"
                                data-status-url="{{ route('cust.checkout.status', ['nomor_pesanan' => $pesanan->nomor_pesanan]) }}">
                                <i class="fa-solid fa-credit-card"></i>
                                Lanjutkan Pembayaran
                            </button>
                        @endif

                        <form id="cancelOrderForm"
                            action="{{ route('cust.checkout.cancel', ['nomor_pesanan' => $pesanan->nomor_pesanan]) }}"
                            method="POST" class="mt-3 sm:ml-2 sm:inline-block">

                            @csrf

                            <button type="button" data-confirm data-form="cancelOrderForm" data-theme="red"
                                data-title="Cancel Order?" data-message="Apakah kamu yakin ingin membatalkan pesanan ini?"
                                data-confirm-text="Ya, batal" data-icon="fa-solid fa-file-circle-minus"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-5 py-3 font-semibold text-red-600 transition hover:bg-red-100 disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto">
                                <i class="fa-solid fa-file-circle-minus"></i>
                                Cancel order
                            </button>

                        </form>

                    @endif

                </div>

                <div class="grid gap-8 p-6 sm:p-8 md:grid-cols-2">

                    <div>

                        <p class="flex items-center gap-2 font-bold text-[#3B2115]">
                            <i class="fa-solid fa-location-dot text-[#FF6B00]"></i>
                            Alamat Pengiriman
                        </p>

                        <div class="mt-4 rounded-2xl border border-[#F3E5D9] bg-[#FFFCF9] p-4">

                            <p class="font-semibold text-[#3B2115]">
                                {{ $pesanan->nama_penerima }}
                            </p>

                            <p class="mt-1 text-sm text-[#72594B]">
                                {{ $pesanan->no_telepon }}
                            </p>

                            <p class="mt-3 text-sm leading-6 text-[#72594B]">
                                {{ $pesanan->alamat_lengkap }},
                                {{ $pesanan->kecamatan?->nama }},
                                {{ $pesanan->kota?->nama }},
                                {{ $pesanan->provinsi?->nama }}
                                {{ $pesanan->kode_pos }}
                            </p>

                        </div>

                    </div>

                    <div>

                        <p class="flex items-center gap-2 font-bold text-[#3B2115]">
                            <i class="fa-solid fa-receipt text-[#FF6B00]"></i>
                            Informasi Pembayaran
                        </p>

                        <div class="mt-4 space-y-4 rounded-2xl border border-[#F3E5D9] bg-[#FFFCF9] p-4">

                            <div class="flex items-center justify-between gap-4 text-sm">

                                <span class="text-[#72594B]">Metode Pembayaran</span>

                                <span class="text-right font-semibold text-[#3B2115]">
                                    @switch($pesanan->payment_method)
                                        @case('other_qris')
                                            Other Qris
                                        @break

                                        @case('bank_transfer')
                                            Transfer Bank
                                        @break

                                        @case('ovo_va')
                                            OVO E-wallet
                                        @break

                                        @default
                                            Belum ditentukan
                                    @endswitch
                                </span>

                            </div>

                            <div class="flex items-center justify-between gap-4 text-sm">
                                <span class="text-[#72594B]">Waktu Pembayaran</span>
                                <span class="text-right font-medium text-[#3B2115]">
                                    @if ($pesanan->status === 'dibatalkan')
                                        Canceled
                                    @else
                                        {{ $pesanan->dibayar_at?->translatedFormat('d M Y, H:i') ?? 'Belum Lunas' }}
                                    @endif
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="border-t border-[#F3E5D9] p-6 sm:p-8">

                    <p class="text-lg font-bold text-[#3B2115]">
                        Rincian Produk
                    </p>

                    <div class="mt-5 space-y-4">

                        @forelse ($pesanan->detail as $detail)
                            <div class="flex gap-4 rounded-2xl border border-[#F3E5D9] p-3 sm:p-4">

                                <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-[#FFF0E5]">
                                    @if ($detail->produk->thumbnail->foto)
                                        <img src="{{ asset('storage/' . $detail->produk->thumbnail->foto) }}"
                                            alt="{{ $detail->nama_produk }}" class="h-full w-full object-cover"
                                            onerror="this.style.display='none'">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-2xl text-[#FF6B00]">
                                            <i class="fa-solid fa-box"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="font-semibold text-[#3B2115]">
                                        {{ $detail->nama_produk }}
                                    </p>
                                    <p class="mt-1 text-sm text-[#72594B]">
                                        {{ $detail->nama_toko ?? 'Toko UMKM' }}
                                    </p>
                                    <p class="mt-2 text-sm text-[#72594B]">
                                        {{ $detail->quantity }} ×
                                        Rp{{ number_format($detail->harga, 0, ',', '.') }}
                                    </p>
                                </div>

                                <p class="shrink-0 text-right text-sm font-bold text-[#3B2115]">
                                    Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                                </p>

                            </div>
                        @empty
                            <p class="rounded-xl bg-[#FFF9F2] p-4 text-sm text-[#72594B]">
                                Rincian produk tidak tersedia.
                            </p>
                        @endforelse

                    </div>

                    <div class="ml-auto mt-6 max-w-md space-y-3">

                        <div class="flex justify-between gap-4 text-sm">
                            <span class="text-[#72594B]">Subtotal Produk</span>
                            <span class="font-medium text-[#3B2115]">
                                Rp{{ number_format($pesanan->subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 text-sm">
                            <span class="text-[#72594B]">Ongkos Kirim</span>
                            <span class="font-medium text-[#3B2115]">
                                Rp{{ number_format($pesanan->ongkir, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="border-t border-dashed border-[#E8D5C5] pt-4">

                            <div class="flex items-center justify-between gap-4">
                                <span class="font-bold text-[#3B2115]">Total Pembayaran</span>
                                <span class="text-xl font-bold text-[#FF6B00]">
                                    Rp{{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                    </div>

                    @if ($pesanan->catatan)
                        <div class="mt-6 rounded-2xl bg-[#FFF9F2] p-4">
                            <p class="font-semibold text-[#3B2115]">
                                Catatan Pesanan
                            </p>
                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-[#72594B]">
                                {{ $pesanan->catatan }}
                            </p>
                        </div>
                    @endif
                </div>

            </section>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row">

                @if (in_array($pesanan->status, ['diantar', 'dikirim'], true))
                    <button type="button" 
                            data-return-modal-open
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-6 py-3 font-semibold text-red-600 transition hover:bg-red-100 sm:w-auto">
                        <i class="fa-solid fa-rotate-left"></i>
                        Ajukan return
                    </button>


                    <form action="{{ route('cust.pesanan.selesai', ['nomor_pesanan' => $pesanan->nomor_pesanan]) }}"
                        method="POST" class="w-full sm:w-auto">
                        @csrf

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-6 py-3 font-semibold text-white transition hover:bg-green-700 sm:w-auto">
                            <i class="fa-solid fa-circle-check"></i>
                            Pesanan Selesai
                        </button>

                    </form>
                @endif

            </div>

        </div>

        <div id="returnModal"
            data-has-errors="{{ $errors->has('return') || $errors->has('alasan_return') || $errors->has('keterangan_return') || $errors->has('foto_return') || collect($errors->keys())->contains(fn($key) => str_starts_with($key, 'foto_return.')) ? '1' : '0' }}"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

            <div
                class="max-h-[90vh] w-full max-w-2xl overflow-y-auto hide-scrollbar rounded-2xl bg-white border border-gray-300 p-5 shadow-xl sm:p-7">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="text-xl font-bold text-[#3B2115]">
                            Pengajuan Return
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            Isi alasan return dan unggah foto bukti produk.
                        </p>
                    </div>

                    <button type="button" id="closeReturnModal"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100"
                        aria-label="Tutup modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                </div>

                <form id="returnOrderForm"
                    action="{{ route('cust.pesanan.return', ['nomor_pesanan' => $pesanan->nomor_pesanan]) }}"
                    method="POST" 
                    enctype="multipart/form-data" 
                    class="mt-6 space-y-5">

                    @csrf

                    @if ($errors->has('return'))
                        <div class="rounded-xl bg-red-50 p-3 text-sm text-red-700">
                            {{ $errors->first('return') }}
                        </div>
                    @endif

                    <div>

                        <label for="alasan_return" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                            Alasan Return <span class="text-red-600">*</span>
                        </label>

                        <select id="alasan_return" name="alasan_return" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                            <option value="">-- Pilih alasan return --</option>
                            <option value="produk_tidak_sesuai" @selected(old('alasan_return') === 'produk_tidak_sesuai')>Produk tidak sesuai</option>
                            <option value="produk_rusak" @selected(old('alasan_return') === 'produk_rusak')>Produk rusak atau cacat</option>
                            <option value="produk_salah" @selected(old('alasan_return') === 'produk_salah')>Produk yang diterima salah</option>
                            <option value="lainnya" @selected(old('alasan_return') === 'lainnya')>Alasan lainnya</option>
                        </select>

                        @error('alasan_return')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <div>

                        <label for="keterangan_return" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                            Keterangan
                        </label>

                        <textarea id="keterangan_return" name="keterangan_return" rows="4" maxlength="1000"
                            placeholder="Jelaskan kondisi produk dan alasan pengajuan return..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">{{ old('keterangan_return') }}</textarea>

                        @error('keterangan_return')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <div>

                        <label for="foto_return" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                            Foto Bukti <span class="text-red-600">*</span>
                        </label>

                        <label for="foto_return"
                            class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-orange-200 bg-orange-50/50 p-6 text-center transition hover:border-orange-500">

                            <i class="fa-solid fa-cloud-arrow-up text-3xl text-orange-500"></i>

                            <span class="mt-3 text-sm font-semibold text-[#3B2115]">
                                Klik untuk memilih foto
                            </span>

                            <span class="mt-1 text-xs text-gray-500">
                                JPG, PNG, WEBP · Maksimal 5 foto · Maksimal 5 MB per foto
                            </span>

                            <input id="foto_return" name="foto_return[]" type="file"
                                accept="image/jpeg,image/png,image/webp" multiple required class="sr-only">

                        </label>

                        <p id="namaFotoReturn" class="mt-2 text-sm text-gray-500">
                            Belum ada foto yang dipilih.
                        </p>

                        <div id="previewFotoContainer" class="mt-3 grid hidden grid-cols-2 gap-3 sm:grid-cols-3"></div>

                        @error('foto_return')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @foreach ($errors->get('foto_return.*') as $pesanFoto)
                            @foreach ($pesanFoto as $pesan)
                                <p class="mt-1 text-sm text-red-600">{{ $pesan }}</p>
                            @endforeach
                        @endforeach

                    </div>

                    <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-end">
                        <button type="button" id="cancelReturnModal"
                            class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" id="submitReturnButton"
                            class="rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-60">
                            <i class="fa-solid fa-paper-plane mr-1"></i>
                            Kirim Pengajuan
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <x-custom-alert-confirmation />

    </main>

    @push('scripts')
        @if ($pesanan->status === 'menunggu_pembayaran' && $pesanan->payment_method !== 'cod' && $pesanan->snap_token)
            <script
                src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
                data-client-key="{{ config('services.midtrans.client_key') }}"></script>

            <script>
                document.getElementById('payAgainButton')?.addEventListener('click', function() {
                    const token = this.dataset.snapToken;

                    if (!window.snap || typeof window.snap.pay !== 'function') {
                        alert('Layanan pembayaran belum siap. Silakan muat ulang halaman.');
                        return;
                    }

                    window.snap.pay(token, {
                        onSuccess: function() {
                            window.location.reload();
                        },
                        onPending: function() {
                            window.location.reload();
                        },
                        onError: function() {
                            alert('Pembayaran belum berhasil. Silakan coba kembali.');
                        },
                    });
                });
            </script>
        @endif
    @endpush

@endsection
