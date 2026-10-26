@extends('layouts.admin')

@section('title', 'Detail Pengajuan Return - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F2] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">

            <div>

                <a href="{{ route('admin.pengajuanReturn') }}"
                    class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-[#8B6B57] transition hover:text-[#E85D04]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Pengajuan Return
                </a>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-2xl font-bold text-[#3B2115] sm:text-3xl">
                            Detail Pengajuan Return
                        </p>

                        <p class="mt-2 text-sm text-[#8B6B57]">
                            Periksa informasi dan bukti pengajuan sebelum mengambil keputusan.
                        </p>

                    </div>

                    <span
                        class="inline-flex w-fit items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ $statusClass[$status] ?? 'bg-gray-100 text-gray-700' }}">
                        <span class="h-2 w-2 rounded-ful
                        l bg-current"></span>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </span>

                </div>

            </div>

            <x-alert-session />

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                    <p class="mb-2 font-semibold">Terjadi kesalahan:</p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">

                <div class="space-y-6 lg:col-span-2">

                    <section class="overflow-hidden rounded-2xl border border-[#F1DCC8] bg-white shadow-sm">

                        <div class="border-b border-[#F1DCC8] bg-linear-to-r from-[#FFF3E2] to-[#FFF9F4] px-5 py-4 sm:px-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-[#E85D04] shadow-sm">
                                    <i class="fa-solid fa-rotate-left text-lg"></i>
                                </div>

                                <div>
                                    <p class="font-bold text-[#3B2115]">Informasi Pengajuan</p>
                                    <p class="text-xs text-[#8B6B57]">Rincian permintaan return pelanggan</p>
                                </div>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 sm:p-6">

                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-[#9A7A66]">
                                    Nomor Pesanan
                                </p>
                                <p class="mt-2 break-all font-bold text-[#3B2115]">
                                    {{ $pesanan->nomor_pesanan ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-[#9A7A66]">
                                    Tanggal Pengajuan
                                </p>
                                <p class="mt-2 font-semibold text-[#3B2115]">
                                    {{ $pengajuan->created_at?->format('d M Y, H:i') ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-[#9A7A66]">
                                    Alasan Return
                                </p>
                                <p class="mt-2 font-semibold text-[#3B2115]">
                                    {{ ucfirst(str_replace('_', ' ', $pengajuan->alasan ?? '-')) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-[#9A7A66]">
                                    Status Pesanan
                                </p>
                                <p class="mt-2 font-semibold text-[#3B2115]">
                                    {{ ucfirst(str_replace('_', ' ', $pesanan->status ?? '-')) }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium uppercase tracking-wide text-[#9A7A66]">
                                    Keterangan Pelanggan
                                </p>
                                <div class="mt-2 whitespace-pre-line rounded-xl border border-[#F1DCC8] bg-[#FFFCF8] p-4 text-sm leading-7 text-[#5D4334]">
                                    {{ $pengajuan->keterangan ?: 'Tidak ada keterangan.' }}</div>
                            </div>

                            @if ($pengajuan->catatan_admin)
                                <div class="sm:col-span-2">
                                    <p class="text-xs font-medium uppercase tracking-wide text-[#9A7A66]">
                                        Catatan Admin
                                    </p>
                                    <div
                                        class="mt-2 whitespace-pre-line rounded-xl border border-red-100 bg-red-50 p-4 text-sm leading-7 text-red-800">
                                        {{ $pengajuan->catatan_admin }}</div>
                                </div>
                            @endif

                        </div>

                    </section>

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#E85D04]">
                                <i class="fa-solid fa-images text-lg"></i>
                            </div>

                            <div>
                                <p class="font-bold text-[#3B2115]">Foto Bukti Return</p>
                                <p class="text-xs text-[#8B6B57]">
                                    {{ $pengajuan->fotoReturn->count() }} foto bukti
                                </p>
                            </div>

                        </div>

                        @if ($pengajuan->fotoReturn->isNotEmpty())
                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">

                                @foreach ($pengajuan->fotoReturn as $foto)
                                    <a href="{{ asset('storage/' . $foto->foto_path) }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="group relative overflow-hidden rounded-xl border border-[#F1DCC8] bg-[#FFF9F2]">

                                        <img src="{{ asset('storage/' . $foto->foto_path) }}"
                                            alt="Foto bukti return {{ $loop->iteration }}" loading="lazy"
                                            class="aspect-square w-full object-cover transition duration-300 group-hover:scale-105">

                                        <span
                                            class="absolute bottom-2 left-2 rounded-lg bg-black/60 px-2 py-1 text-xs font-medium text-white">
                                            Foto {{ $loop->iteration }}
                                        </span>

                                        <span
                                            class="absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-full bg-white/90 text-[#E85D04] opacity-0 shadow transition group-hover:opacity-100">
                                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                                        </span>

                                    </a>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="rounded-xl border border-dashed border-[#E8CDB6] bg-[#FFFCF8] px-4 py-10 text-center">
                                <i class="fa-regular fa-image text-3xl text-[#C5A58D]"></i>
                                <p class="mt-3 text-sm text-[#8B6B57]">
                                    Tidak ada foto bukti yang tersedia.
                                </p>
                            </div>
                        @endif

                    </section>

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#FFF1E5] text-[#E85D04]">
                                <i class="fa-solid fa-user text-lg"></i>
                            </div>

                            <div>
                                <p class="font-bold text-[#3B2115]">Informasi Pelanggan</p>
                                <p class="text-xs text-[#8B6B57]">Data pemilik pengajuan</p>
                            </div>

                        </div>

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#FFF1E5] text-xl font-bold text-[#E85D04]">

                                @if ($pengguna?->foto_profil)
                                    <img src="{{ asset('storage/' . $pengguna->foto_profil) }}" alt="Foto profil"
                                        class="h-full w-full object-cover">
                                @else
                                    {{ strtoupper(substr($pengguna->nama ?? ($pengguna->username ?? 'P'), 0, 1)) }}
                                @endif

                            </div>

                            <div class="min-w-0">

                                <p class="font-bold text-[#3B2115]">
                                    {{ $pengguna->nama ?? ($pengguna->username ?? 'Pelanggan') }}
                                </p>

                                <p class="mt-1 break-all text-sm text-[#8B6B57]">
                                    {{ $pengguna->email ?? '-' }}
                                </p>

                                <p class="mt-1 text-sm text-[#8B6B57]">
                                    {{ $pengguna->no_telp ?? ($pengguna->no_telepon ?? '-') }}
                                </p>

                            </div>

                        </div>

                    </section>

                </div>

                <aside class="space-y-6 lg:sticky lg:top-6">

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">

                        <p class="font-bold text-[#3B2115]">Tindakan</p>

                        <p class="mt-2 text-sm leading-6 text-[#8B6B57]">
                            Periksa seluruh informasi sebelum menentukan keputusan.
                        </p>

                        @if ($bisaDiproses)
                            <div class="mt-5 space-y-3">

                                <form action="{{ route('admin.pengajuanReturn.approve', ['id' => $pengajuan->id]) }}"
                                    method="POST" id="approveReturn" @csrf @method('PATCH') <button type="button"
                                    data-confirm data-form="approveReturn" data-theme="green"
                                    data-title="Approve Pengajuan Return?"
                                    data-message="Apakah kamu yakin ingin approve pengajuan ini?"
                                    data-confirm-text="Ya, approve" data-icon="fa-solid fa-check-to-slot"
                                    class="cursor-pointer flex w-full items-center justify-center gap-2 rounded-xl bg-green-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                    <i class="fa-solid fa-check"></i>
                                    Approve Pengajuan
                                    </button>

                                </form>

                                <button type="button" id="openRejectModal"
                                    class="cursor-pointer flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-100">
                                    <i class="fa-solid fa-xmark"></i>
                                    Tolak Pengajuan
                                </button>

                            </div>

                            <div class="mt-5 rounded-xl border border-amber-100 bg-amber-50 p-3">
                                <p class="flex gap-2 text-xs leading-5 text-amber-800">
                                    <i class="fa-solid fa-circle-info mt-0.5"></i>
                                    Keputusan akan disimpan dan status pengajuan diperbarui.
                                </p>
                            </div>
                        @else
                            <div class="mt-5 rounded-xl border border-[#F1DCC8] bg-[#FFFCF8] p-4">
                                <p class="flex gap-2 text-sm leading-6 text-[#72594B]">
                                    <i class="fa-solid fa-lock mt-1"></i>
                                    Pengajuan ini sudah diproses. Keputusan tidak dapat diubah melalui halaman ini.
                                </p>
                            </div>
                        @endif

                    </section>

                    <section class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">

                        <p class="font-bold text-[#3B2115]">Ringkasan Pesanan</p>

                        <div class="mt-4 space-y-4">

                            <div>
                                <p class="text-xs text-[#9A7A66]">Nomor Pesanan</p>
                                <p class="mt-1 break-all text-sm font-semibold text-[#3B2115]">
                                    {{ $pesanan->nomor_pesanan ?? '-' }}
                                </p>
                            </div>

                            <div class="border-t border-dashed border-[#E8D6C5] pt-4">
                                <p class="text-xs text-[#9A7A66]">Tanggal Pesanan</p>
                                <p class="mt-1 text-sm font-semibold text-[#3B2115]">
                                    {{ $pesanan?->created_at?->format('d M Y, H:i') ?? '-' }}
                                </p>
                            </div>

                            <div class="border-t border-dashed border-[#E8D6C5] pt-4">
                                <p class="text-xs text-[#9A7A66]">Total Pesanan</p>
                                <p class="mt-1 text-lg font-bold text-[#E85D04]">
                                    Rp{{ number_format((float) ($pesanan->total_harga ?? ($pesanan->total_pembayaran ?? 0)), 0, ',', '.') }}
                                </p>
                            </div>

                        </div>

                    </section>

                </aside>

            </div>

        </div>

        <x-custom-alert-confirmation />

    </main>


    @if ($bisaDiproses)
        <div id="rejectModal"
            class="fixed inset-0 z-100 hidden items-center justify-center overflow-y-auto bg-[#2B170D]/60 p-4 backdrop-blur-sm transition-opacity duration-300"
            role="dialog" 
            aria-modal="true" 
            aria-labelledby="rejectModalTitle">

            <div class="my-auto w-full max-w-lg overflow-hidden rounded-3xl border border-white/70 bg-white shadow-[0_25px_80px_-20px_rgba(43,23,13,0.4)]">

                <div class="relative overflow-hidden border-b border-[#F1DCC8] bg-gradient-to-br from-[#FFF3E2] via-[#FFF9F4] to-[#FFE8D1] px-6 py-6 sm:px-7">
                    <div
                        class="pointer-events-none absolute -right-8 -top-12 h-36 w-36 rounded-full bg-orange-200/30 blur-2xl">
                    </div>
                    <div
                        class="pointer-events-none absolute -bottom-12 left-1/3 h-28 w-28 rounded-full bg-red-200/20 blur-2xl">
                    </div>

                    <div class="relative flex items-start justify-between gap-4">

                        <div class="flex min-w-0 items-start gap-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-red-200/80 bg-white text-red-600 shadow-sm">
                                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                            </div>

                            <div class="min-w-0 pt-0.5">
                                <p class="mb-1 text-[10px] font-bold uppercase tracking-[0.18em] text-red-600">
                                    Konfirmasi Keputusan
                                </p>

                                <h2 id="rejectModalTitle"
                                    class="text-lg font-bold tracking-tight text-[#3B2115] sm:text-xl">
                                    Tolak Pengajuan Return
                                </h2>

                                <p class="mt-1.5 text-sm leading-6 text-[#8B6B57]">
                                    Pastikan alasan penolakan jelas dan sesuai hasil pemeriksaan.
                                </p>
                            </div>

                        </div>

                        <button type="button" id="closeRejectModal" aria-label="Tutup modal"
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-[#F1DCC8] bg-white/80 text-[#8B6B57] transition duration-200 hover:border-red-200 hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-4 focus:ring-red-100">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                </div>

                <form action="{{ route('admin.pengajuanReturn.reject', ['id' => $pengajuan->id]) }}" method="POST"
                    class="p-6 sm:p-7">

                    @csrf
                    @method('PATCH')

                    <div class="mb-5 rounded-2xl border border-amber-200/80 bg-amber-50/70 p-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-amber-900">
                                    Perhatian, Admin
                                </p>
                                <p class="mt-1 text-xs leading-5 text-amber-800">
                                    Catatan ini akan disimpan sebagai alasan penolakan dan dapat dilihat sebagai informasi
                                    pada pengajuan return.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>

                        <div class="mb-2.5 flex items-center justify-between gap-3">

                            <label for="catatan_admin" class="text-sm font-bold text-[#3B2115]">
                                Alasan Penolakan
                                <span class="text-red-500">*</span>
                            </label>

                            <span class="rounded-full bg-red-50 px-2.5 py-1 text-[10px] font-semibold text-red-600">
                                Wajib diisi
                            </span>

                        </div>

                        <div class="relative">
                            <textarea id="catatan_admin" name="catatan_admin" rows="5" minlength="10" maxlength="1000" required
                                placeholder="Contoh: Bukti yang dilampirkan belum menunjukkan kerusakan produk. Mohon periksa kembali ketentuan pengajuan return..."
                                class="w-full resize-y rounded-2xl border border-[#E8D6C5] bg-[#FFFCF8] px-4 py-4 text-sm leading-7 text-[#3B2115] outline-none transition duration-200 placeholder:text-[#B49A87] hover:border-[#D9B99D] focus:border-[#E85D04] focus:bg-white focus:ring-4 focus:ring-orange-100"
                            >{{ old('catatan_admin') }}</textarea>
                        </div>

                        @error('catatan_admin')
                            <div class="mt-2 flex items-start gap-2 rounded-xl border border-red-100 bg-red-50 px-3 py-2.5">
                                <i class="fa-solid fa-circle-exclamation mt-0.5 text-red-500"></i>
                                <p class="text-xs leading-5 text-red-600">{{ $message }}</p>
                            </div>
                        @enderror

                        <div class="mt-3 flex items-center justify-between gap-3">
                            <p class="flex items-center gap-1.5 text-xs text-[#9A7A66]">
                                <i class="fa-solid fa-keyboard"></i>
                                Minimal 10 karakter
                            </p>

                            <span id="rejectCharCount"
                                class="rounded-lg bg-[#FFF1E5] px-2.5 py-1 text-xs font-bold tabular-nums text-[#C1440E]">
                                0/1000
                            </span>

                        </div>

                    </div>

                    <div class="mt-7 flex flex-col-reverse gap-3 border-t border-[#F1DCC8] pt-5 sm:flex-row sm:justify-end">

                        <button type="button" id="cancelRejectModal"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#E8D6C5] bg-white px-5 py-3 text-sm font-semibold text-[#72594B] transition duration-200 hover:border-[#D9B99D] hover:bg-[#FFF9F2] focus:outline-none focus:ring-4 focus:ring-orange-100">
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                            Batal
                        </button>

                        <button type="submit"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-red-600 to-[#D92D20] px-5 py-3 text-sm font-bold text-white shadow-md shadow-red-200/60 transition duration-200 hover:-translate-y-0.5 hover:from-red-700 hover:to-red-700 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-red-100">
                            <i class="fa-solid fa-ban transition-transform duration-200 group-hover:scale-110"></i>
                            Konfirmasi Penolakan
                        </button>

                    </div>

                    <p class="mt-4 text-center text-[11px] leading-5 text-[#A58A76]">
                        <i class="fa-solid fa-shield-halved mr-1"></i>
                        Keputusan akan dicatat pada sistem LokaMarket.
                    </p>

                </form>
            </div>
        </div>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('rejectModal');

            if (!modal) return;

            const openButton = document.getElementById('openRejectModal');
            const closeButton = document.getElementById('closeRejectModal');
            const cancelButton = document.getElementById('cancelRejectModal');
            const textarea = document.getElementById('catatan_admin');
            const charCount = document.getElementById('rejectCharCount');

            let previousOverflow = '';

            function openModal() {
                previousOverflow = document.body.style.overflow;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';

                if (textarea) {
                    setTimeout(() => textarea.focus(), 50);
                }
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = previousOverflow;
            }

            openButton?.addEventListener('click', openModal);
            closeButton?.addEventListener('click', closeModal);
            cancelButton?.addEventListener('click', closeModal);

            modal.addEventListener('click', function(event) {
                if (event.target === modal) closeModal();
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            if (textarea && charCount) {
                function updateCharCount() {
                    charCount.textContent = `${textarea.value.length}/1000`;
                }

                textarea.addEventListener('input', updateCharCount);
                updateCharCount();
            }

            @if ($errors->has('catatan_admin'))
                openModal();
            @endif
        });
    </script>
@endsection
