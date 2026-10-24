@extends('layouts.seller')

@section('title', 'Saldo Penjual - LokaMarket')

@section('content')

    <div class="min-h-screen bg-[#FFF9F4] px-4 py-6 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl space-y-6">

            <x-alert-session/>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange-500">
                        Keuangan Toko
                    </p>
                    <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-[#3B2115] sm:text-3xl">
                        Saldo Penjual
                    </h1>
                    <p class="mt-2 text-sm text-[#8A7264]">
                        Pantau pendapatan dan kelola pencairan dana toko kamu.
                    </p>
                </div>

                <button type="button" onclick="openRekeningModal()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#F97316] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-orange-200/60 transition hover:bg-[#D9490B]">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Rekening
                </button>

            </div>

            <section class="relative overflow-hidden rounded-3xl bg-linear-to-br from-[#F97316] via-[#F56713] to-[#C1440E] p-6 text-white shadow-xl shadow-orange-200/50 sm:p-8">

                <div class="pointer-events-none absolute -right-12 -top-16 h-64 w-64 rounded-full border-35 border-white/10"></div>
                <div class="pointer-events-none absolute -bottom-24 right-32 h-48 w-48 rounded-full bg-white/5"></div>

                <div class="relative grid gap-8 lg:grid-cols-[1.3fr_1fr] lg:items-end">

                    <div>

                        <div class="flex items-center gap-2 text-sm text-orange-50">
                            <i class="fa-solid fa-wallet"></i>
                            Total saldo tersedia
                        </div>

                        <p class="mt-4 text-3xl font-extrabold tracking-tight sm:text-4xl">
                            Rp {{ number_format($saldo->saldo_tersedia, 0, ',', '.') }}
                        </p>

                        <p class="mt-3 max-w-md text-xs leading-5 text-orange-50">
                            Dana yang dapat digunakan untuk mengajukan pencairan ke rekening terdaftar.
                        </p>

                        <button type="button" onclick="openWithdrawModal()" @disabled($rekening->isEmpty())
                            class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-extrabold text-[#D9490B] shadow-sm transition hover:bg-orange-50 disabled:cursor-not-allowed disabled:opacity-60">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            Tarik Saldo
                        </button>

                        @if ($rekening->isEmpty())
                            <p class="mt-2 text-xs text-orange-50">
                                Tambahkan rekening terlebih dahulu untuk melakukan pencairan.
                            </p>
                        @endif

                    </div>

                    <div class="grid grid-cols-2 gap-3">

                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur-sm">

                            <div class="flex items-center gap-2 text-xs text-orange-50">
                                <i class="fa-regular fa-clock"></i>
                                Saldo pending
                            </div>

                            <p class="mt-3 text-xl font-extrabold">
                                Rp {{ number_format($saldo->saldo_pending, 0, ',', '.') }}
                            </p>

                            <p class="mt-2 text-[10px] leading-4 text-orange-100">
                                Menunggu pesanan selesai
                            </p>

                        </div>

                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur-sm">
                            
                            <div class="flex items-center gap-2 text-xs text-orange-50">
                                <i class="fa-solid fa-lock"></i>
                                Saldo ditahan
                            </div>

                            <p class="mt-3 text-xl font-extrabold">
                                Rp {{ number_format($saldo->saldo_ditahan, 0, ',', '.') }}
                            </p>

                            <p class="mt-2 text-[10px] leading-4 text-orange-100">
                                Dalam proses pencairan
                            </p>

                        </div>

                    </div>

                </div>

            </section>

            <div class="grid gap-4 md:grid-cols-3">
                
                <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
                    
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            <i class="fa-solid fa-percent"></i>
                        </div>

                        <div>
                            <p class="text-xs text-[#8A7264]">Komisi marketplace</p>
                            <p class="mt-1 text-lg font-extrabold text-[#3B2115]">3%</p>
                        </div>

                    </div>

                </div>

                <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
                    
                    <div class="flex items-center gap-3">
                        
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[#8A7264]">Minimum withdraw</p>
                            <p class="mt-1 text-lg font-extrabold text-[#3B2115]">Rp10.000</p>
                        </div>

                    </div>

                </div>

                <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
                    
                    <div class="flex items-center gap-3">
                        
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <div>
                            <p class="text-xs text-[#8A7264]">Keamanan saldo</p>
                            <p class="mt-1 text-sm font-extrabold text-[#3B2115]">Transaksi tercatat</p>
                        </div>

                    </div>

                </div>

            </div>

            <section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">
                
                <div class="flex flex-col gap-3 border-b border-orange-50 p-5 sm:flex-row sm:items-center sm:justify-between">
                    
                    <div>
                        <p class="text-lg font-extrabold text-[#3B2115]">
                            Rekening Pencairan
                        </p>
                        <p class="mt-1 text-xs text-[#8A7264]">
                            Rekening yang terdaftar untuk menerima pencairan saldo.
                        </p>
                    </div>

                    <button type="button" onclick="openRekeningModal()"
                        class="inline-flex items-center gap-2 self-start rounded-lg border border-orange-200 px-3 py-2 text-xs font-bold text-orange-600 transition hover:bg-orange-50 sm:self-auto">
                        <i class="fa-solid fa-plus"></i>
                        Tambah rekening
                    </button>

                </div>

                <div class="space-y-3 p-5">

                    @forelse ($rekening as $item)
                        <div class="flex items-start gap-3 rounded-2xl border border-orange-100 p-4 transition hover:border-orange-300 hover:bg-orange-50/40">
                            
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                                <i class="{{ $item->metode === 'bank' ? 'fa-solid fa-building-columns' : 'fa-solid fa-mobile-screen-button' }}"></i>
                            </span>

                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <p class="text-sm font-extrabold text-[#3B2115]">
                                        {{ $item->nama_bank }}
                                    </p>

                                    @if ($item->is_default)
                                        <span
                                            class="rounded-full bg-green-50 px-2 py-1 text-[9px] font-bold text-green-600">
                                            <i class="fa-solid fa-check mr-1"></i>Utama
                                        </span>
                                    @endif

                                </div>

                                <p class="mt-1 text-xs text-[#72594B]">
                                    {{ $item->nama_pemilik }}
                                </p>

                                <p class="mt-1 break-all text-sm font-semibold tracking-wide text-[#3B2115]">
                                    {{ $item->nomor_rekening }}
                                </p>

                                <p class="mt-1 text-[10px] uppercase text-[#A58E81]">
                                    {{ $item->metode === 'bank' ? 'Transfer bank' : 'E-wallet' }}
                                </p>

                            </div>

                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-orange-200 bg-[#FFFCF9] px-5 py-10 text-center">
                            
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-building-columns text-xl"></i>
                            </div>

                            <p class="mt-4 text-sm font-extrabold text-[#3B2115]">
                                Belum ada rekening
                            </p>

                            <p class="mx-auto mt-2 max-w-sm text-xs leading-5 text-[#8A7264]">
                                Tambahkan rekening bank atau e-wallet untuk menerima pencairan saldo.
                            </p>

                            <button type="button" onclick="openRekeningModal()"
                                class="mt-5 rounded-xl bg-orange-500 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-orange-600">
                                Tambah rekening pertama
                            </button>

                        </div>
                    @endforelse

                </div>

            </section>

            <section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">
                
                <div class="border-b border-orange-50 p-5">
                    <p class="text-lg font-extrabold text-[#3B2115]">
                        Riwayat Saldo
                    </p>
                    <p class="mt-1 text-xs text-[#8A7264]">
                        Catatan pendapatan, pelepasan saldo, dan pencairan.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full min-w-190 text-left">
                        
                        <thead class="bg-[#FFFCF9] text-[11px] uppercase tracking-wide text-[#8A7264]">
                            <tr>
                                <th class="px-5 py-4 font-bold">Transaksi</th>
                                <th class="px-5 py-4 font-bold">Referensi</th>
                                <th class="px-5 py-4 font-bold">Tanggal</th>
                                <th class="px-5 py-4 font-bold">Status</th>
                                <th class="px-5 py-4 text-right font-bold">Jumlah</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-orange-50">

                            @forelse ($transaksi as $item)
                                @php
                                    $warnaStatus = match (strtolower($item->status)) {
                                        'success', 'berhasil', 'selesai' => 'bg-green-50 text-green-600',
                                        'pending', 'menunggu' => 'bg-amber-50 text-amber-600',
                                        'ditolak', 'gagal', 'failed' => 'bg-red-50 text-red-600',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp

                                <tr class="transition hover:bg-orange-50/30">
                                    
                                    <td class="px-5 py-4">
                                        <p class="text-xs font-bold text-[#3B2115]">
                                            {{ ucfirst(str_replace('_', ' ', $item->jenis)) }}
                                        </p>
                                        <p class="mt-1 max-w-[220px] truncate text-[10px] text-[#A58E81]">
                                            {{ $item->keterangan ?: 'Tidak ada keterangan' }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4 text-xs text-[#72594B]">
                                        {{ $item->referensi }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-xs text-[#72594B]">
                                        {{ $item->created_at?->format('d M Y, H:i') ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-[10px] font-bold {{ $warnaStatus }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-right text-xs font-extrabold text-[#3B2115]">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center">
                                        <i class="fa-solid fa-receipt text-2xl text-orange-200"></i>
                                        <p class="mt-3 text-sm font-bold text-[#3B2115]">
                                            Belum ada transaksi saldo
                                        </p>
                                        <p class="mt-1 text-xs text-[#A58E81]">
                                            Riwayat akan muncul setelah ada transaksi.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if ($transaksi->hasPages())
                    <div class="border-t border-orange-50 p-5">
                        {{ $transaksi->links() }}
                    </div>
                @endif
                
            </section>

        </div>

    </div>

    <div id="rekeningModal"
        class="fixed inset-0 z-100 hidden items-center justify-center overflow-y-auto bg-[#24150F]/50 p-4 backdrop-blur-sm">

        <div class="my-auto w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl">
            
            <div class="flex items-center justify-between border-b border-orange-50 p-5">

                <div>
                    <h2 class="text-lg font-extrabold text-[#3B2115]">Tambah Rekening</h2>
                    <p class="mt-1 text-xs text-[#8A7264]">Masukkan data rekening pencairan kamu.</p>
                </div>

                <button type="button" onclick="closeRekeningModal()"
                    class="flex h-9 w-9 items-center justify-center rounded-xl text-[#8A7264] transition hover:bg-orange-50 hover:text-orange-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

            <form id="rekeningForm" 
                action="" 
                method="POST"
                class="space-y-4 p-5">

                @csrf

                <div>

                    <label for="metode" class="mb-2 block text-xs font-bold text-[#3B2115]">
                        Jenis rekening
                    </label>

                    <select id="metode" name="metode" required
                        class="w-full rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                        <option value="">Pilih jenis rekening</option>
                        <option value="bank" @selected(old('metode') === 'bank')>Bank</option>
                        <option value="ewallet" @selected(old('metode') === 'ewallet')>E-Wallet</option>
                    </select>

                </div>

                <div>

                    <label for="nama_bank" class="mb-2 block text-xs font-bold text-[#3B2115]">
                        Nama bank / penyedia
                    </label>

                    <input id="nama_bank" name="nama_bank" type="text" maxlength="100"
                        value="{{ old('nama_bank') }}" required placeholder="Contoh: BCA, BRI, DANA"
                        class="w-full rounded-xl border border-orange-100 px-4 py-3 text-sm outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                
                </div>

                <div>

                    <label for="nama_pemilik" class="mb-2 block text-xs font-bold text-[#3B2115]">
                        Nama pemilik rekening
                    </label>

                    <input id="nama_pemilik" name="nama_pemilik" type="text" maxlength="100"
                        value="{{ old('nama_pemilik') }}" required placeholder="Nama sesuai rekening"
                        class="w-full rounded-xl border border-orange-100 px-4 py-3 text-sm outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                
                </div>

                <div>

                    <label for="nomor_rekening" class="mb-2 block text-xs font-bold text-[#3B2115]">
                        Nomor rekening / nomor e-wallet
                    </label>

                    <input id="nomor_rekening" name="nomor_rekening" type="text" maxlength="50"
                        value="{{ old('nomor_rekening') }}" required placeholder="Masukkan nomor rekening"
                        class="w-full rounded-xl border border-orange-100 px-4 py-3 text-sm outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                
                </div>

                <label class="flex cursor-pointer items-start gap-3 rounded-xl bg-orange-50/70 p-3">
                    
                    <input name="is_default" value="1" type="checkbox" @checked(old('is_default'))
                        class="mt-0.5 h-4 w-4 accent-orange-600">
                    
                    <span>
                        <span class="block text-xs font-bold text-[#3B2115]">Jadikan rekening utama</span>
                        <span class="mt-1 block text-[10px] leading-4 text-[#8A7264]">
                            Rekening ini akan dipilih secara default.
                        </span>
                    </span>

                </label>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeRekeningModal()"
                        class="flex-1 rounded-xl border border-orange-100 px-4 py-3 text-xs font-bold text-[#72594B] transition hover:bg-orange-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 rounded-xl bg-orange-500 px-4 py-3 text-xs font-bold text-white transition hover:bg-orange-600">
                        Simpan Rekening
                    </button>
                </div>

            </form>

        </div>

    </div>

    <div id="withdrawModal"
        class="fixed inset-0 z-100 hidden items-center justify-center overflow-y-auto bg-[#24150F]/50 p-4 backdrop-blur-sm">

        <div class="my-auto w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

            <div class="flex items-center justify-between border-b border-orange-50 p-5">
                <div>
                    <h2 class="text-lg font-extrabold text-[#3B2115]">Tarik Saldo</h2>
                    <p class="mt-1 text-xs text-[#8A7264]">Ajukan pencairan saldo toko kamu.</p>
                </div>
                <button type="button" onclick="closeWithdrawModal()"
                    class="flex h-9 w-9 items-center justify-center rounded-xl text-[#8A7264] transition hover:bg-orange-50 hover:text-orange-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="withdrawForm" 
                action="" 
                method="POST" 
                class="space-y-5 p-5">

                @csrf

                <div class="rounded-2xl bg-gradient-to-br from-orange-50 to-[#FFF8F1] p-4">
                    <p class="text-xs text-[#8A7264]">Saldo tersedia</p>
                    <p class="mt-2 text-2xl font-extrabold text-[#D9490B]">
                        Rp {{ number_format($saldo->saldo_tersedia, 0, ',', '.') }}
                    </p>
                    <p class="mt-2 text-[10px] text-[#8A7264]">
                        Minimum pencairan Rp10.000.
                    </p>
                </div>

                <div>

                    <label for="rekening_withdraw" class="mb-2 block text-xs font-bold text-[#3B2115]">
                        Rekening tujuan
                    </label>

                    <select id="rekening_withdraw" 
                            name="rekening_penjual_id" 
                            required
                            class="w-full rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100">
                        <option value="">Pilih rekening</option>
                        @foreach ($rekening as $item)
                            <option value="{{ $item->id }}" @selected(old('rekening_penjual_id') == $item->id || (!old('rekening_penjual_id') && $item->is_default))>
                                {{ $item->nama_bank }} — {{ $item->nama_pemilik }}
                                ({{ $item->nomor_rekening }})
                            </option>
                        @endforeach
                    </select>

                </div>

                <div>

                    <label for="jumlah_withdraw" class="mb-2 block text-xs font-bold text-[#3B2115]">
                        Nominal pencairan
                    </label>
                    
                    <div class="flex overflow-hidden rounded-xl border border-orange-100 focus-within:border-orange-400 focus-within:ring-4 focus-within:ring-orange-100">
                        <span
                            class="flex items-center border-r border-orange-100 bg-orange-50 px-4 text-sm font-bold text-orange-700">
                            Rp
                        </span>
                        <input id="jumlah_withdraw" name="jumlah" type="number" min="10000"
                            max="{{ (int) $saldo->saldo_tersedia }}" step="1" value="{{ old('jumlah') }}"
                            required placeholder="Minimal 10000" class="w-full min-w-0 px-4 py-3 text-sm outline-none">
                    </div>

                </div>

                <div class="rounded-xl border border-amber-100 bg-amber-50 p-3">
                    <p class="text-[11px] leading-5 text-amber-800">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Pengajuan akan berstatus pending. Saldo ditahan sampai admin menyelesaikan atau menolak pencairan.
                    </p>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeWithdrawModal()"
                        class="flex-1 rounded-xl border border-orange-100 px-4 py-3 text-xs font-bold text-[#72594B] transition hover:bg-orange-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 rounded-xl bg-orange-500 px-4 py-3 text-xs font-bold text-white transition hover:bg-orange-600">
                        Ajukan Withdraw
                    </button>
                </div>

            </form>

        </div>

    </div>

    <script>
        function openModal(id) 
        {
            const modal = document.getElementById(id);
            if (!modal) return;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) 
        {
            const modal = document.getElementById(id);
            if (!modal) return;

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            const rekeningOpen = !document.getElementById('rekeningModal').classList.contains('hidden');
            const withdrawOpen = !document.getElementById('withdrawModal').classList.contains('hidden');

            if (!rekeningOpen && !withdrawOpen) {
                document.body.classList.remove('overflow-hidden');
            }
        }

        function openRekeningModal() {
            openModal('rekeningModal');
        }

        function closeRekeningModal() {
            closeModal('rekeningModal');
        }

        function openWithdrawModal() {
            openModal('withdrawModal');
        }

        function closeWithdrawModal() {
            closeModal('withdrawModal');
        }

        document.querySelectorAll('#rekeningModal, #withdrawModal').forEach(function(modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeRekeningModal();
                closeWithdrawModal();
            }
        });

        document.getElementById('metode').addEventListener('change', function() {
            const label = document.querySelector('label[for="nama_bank"]');

            label.textContent = this.value === 'ewallet' ?
                'Nama e-wallet / penyedia' :
                'Nama bank / penyedia';
        });

        @if ($errors->has('metode') || $errors->has('nama_bank') || $errors->has('nama_pemilik') || $errors->has('nomor_rekening') || $errors->has('is_default'))
            openRekeningModal();
        @elseif ($errors->has('rekening_penjual_id') || $errors->has('jumlah'))
            openWithdrawModal();
        @endif
    </script>

@endsection
