
@extends('layouts.admin')

@section('title', 'Pengajuan Toko - LokaMarket')

@section('page-heading', 'Pengajuan Toko')

@section('content')

    <div class="mb-7">

        <p class="text-xs font-semibold tracking-wide text-[#A58E81]">
            LOKAMARKET ADMIN
        </p>

        <div class="mt-1 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">

            <div>

                <p class="text-2xl font-extrabold text-[#3B2115]">
                    Pengajuan Toko
                </p>

                <p class="mt-1 text-sm text-[#8D776A]">
                    Periksa, tinjau, dan kelola pengajuan toko dari calon penjual.
                </p>

            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-xl border border-orange-100 bg-white px-3 py-2">
                <i class="fa-solid fa-store text-sm text-[#FF6B00]"></i>
                <span class="text-xs font-bold text-[#72594B]">
                    Total {{ $pengajuanToko->total() }} Toko
                </span>
            </div>

        </div>

    </div>

    <x-alert-session />

    <section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">

        <div class="border-b border-orange-100 px-5 py-5 sm:px-6">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-[#FF6B00]">
                    <i class="fa-solid fa-clipboard-list text-lg"></i>
                </div>

                <div>
                    
                    <p class="text-base font-bold text-[#3B2115]">
                        Daftar Pengajuan Toko
                    </p>

                    <p class="mt-0.5 text-xs text-[#A58E81]">
                        Kelola status pengajuan toko calon seller LokaMarket.
                    </p>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-2 gap-3 border-b border-orange-100 bg-[#FFFCF9] p-5 sm:grid-cols-4 sm:px-6">

            <div class="rounded-xl border border-orange-100 bg-white p-3">

                <div class="flex items-center justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-wide text-[#A58E81]">
                        Semua
                    </p>
                    <i class="fa-solid fa-layer-group text-xs text-[#FF6B00]"></i>
                </div>

                <p class="mt-2 text-xl font-extrabold text-[#3B2115]" data-count="all">
                    {{ $jumlahSemua }}
                </p>

            </div>

            <div class="rounded-xl border border-yellow-100 bg-white p-3">
                
                <div class="flex items-center justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-wide text-[#A58E81]">
                        Menunggu
                    </p>
                    <i class="fa-solid fa-clock text-xs text-yellow-500"></i>
                </div>

                <p class="mt-2 text-xl font-extrabold text-yellow-600" data-count="pending">
                    {{ $jumlahPending }}
                </p>

            </div>

            <div class="rounded-xl border border-green-100 bg-white p-3">
                
                <div class="flex items-center justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-wide text-[#A58E81]">
                        Disetujui
                    </p>
                    <i class="fa-solid fa-circle-check text-xs text-green-500"></i>
                </div>

                <p class="mt-2 text-xl font-extrabold text-green-600" data-count="approved">
                    {{ $jumlahApproved }}
                </p>

            </div>

            <div class="rounded-xl border border-red-100 bg-white p-3">
                
                <div class="flex items-center justify-between gap-2">
                    <p class="text-[10px] font-semibold uppercase tracking-wide text-[#A58E81]">
                        Ditolak
                    </p>
                    <i class="fa-solid fa-circle-xmark text-xs text-red-500"></i>
                </div>

                <p class="mt-2 text-xl font-extrabold text-red-600" data-count="rejected">
                    {{ $jumlahRejected }}
                </p>

            </div>

        </div>

        <div class="border-b border-orange-100 px-5 py-4 sm:px-6">

            <div class="flex items-center justify-between gap-3">
                
                <div>

                    <p class="text-xs font-bold text-[#3B2115]">
                        Filter Pengajuan
                    </p>

                    <p class="mt-1 text-[10px] text-[#A58E81]">
                        Pilih status untuk menyaring daftar pengajuan.
                    </p>

                </div>

                <span id="jumlahHasilFilter"
                    class="whitespace-nowrap rounded-lg bg-orange-50 px-2.5 py-1.5 text-[10px] font-bold text-orange-600">
                    {{ $jumlahSemua }} Toko
                </span>

            </div>

            <div class="mt-4 flex gap-2 overflow-x-auto pb-1 hide-scrollbar">

                <button type="button"
                        data-tab="all"
                        aria-pressed="true"
                        class="filter-tab inline-flex shrink-0 items-center gap-2 rounded-xl bg-[#FF6B00] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition">
                    
                    <i class="fa-solid fa-layer-group"></i>
                    Semua

                    <span data-tab-count="all"
                        class="rounded-md bg-white/20 px-1.5 py-0.5 text-[10px]">
                        {{ $jumlahSemua }}
                    </span>

                </button>

                <button type="button"
                        data-tab="pending"
                        aria-pressed="false"
                        class="filter-tab inline-flex shrink-0 items-center gap-2 rounded-xl border border-orange-100 bg-white px-4 py-2.5 text-xs font-bold text-[#8D776A] transition hover:bg-orange-50">
                    
                    <i class="fa-solid fa-clock text-yellow-500"></i>
                    Menunggu

                    <span data-tab-count="pending"
                        class="rounded-md bg-yellow-100 px-1.5 py-0.5 text-[10px] text-yellow-700">
                        {{ $jumlahPending }}
                    </span>

                </button>

                <button type="button"
                        data-tab="approved"
                        aria-pressed="false"
                        class="filter-tab inline-flex shrink-0 items-center gap-2 rounded-xl border border-orange-100 bg-white px-4 py-2.5 text-xs font-bold text-[#8D776A] transition hover:bg-orange-50">
                    
                    <i class="fa-solid fa-circle-check text-green-500"></i>
                    Disetujui

                    <span data-tab-count="approved"
                        class="rounded-md bg-green-100 px-1.5 py-0.5 text-[10px] text-green-700">
                        {{ $jumlahApproved }}
                    </span>

                </button>

                <button type="button"
                        data-tab="rejected"
                        aria-pressed="false"
                        class="filter-tab inline-flex shrink-0 items-center gap-2 rounded-xl border border-orange-100 bg-white px-4 py-2.5 text-xs font-bold text-[#8D776A] transition hover:bg-orange-50">
                    
                    <i class="fa-solid fa-circle-xmark text-red-500"></i>
                    Ditolak

                    <span data-tab-count="rejected"
                        class="rounded-md bg-red-100 px-1.5 py-0.5 text-[10px] text-red-700">
                        {{ $jumlahRejected }}
                    </span>

                </button>

            </div>
            
        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px]">

                <thead>

                    <tr class="border-b border-orange-100 bg-[#FFF9F4]">

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Toko
                        </th>

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Pemilik
                        </th>

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Tanggal Pengajuan
                        </th>

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody id="pengajuanTableBody" class="divide-y divide-orange-50">

                    @foreach ($pengajuanToko as $toko)
                        <tr data-status="{{ $toko->status }}"
                            class="pengajuan-row transition hover:bg-[#FFF9F4]">

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    @if ($toko->foto_profil)
                                        <img src="{{ asset('storage/' . $toko->foto_profil) }}"
                                            alt="{{ $toko->nama_toko }}"
                                            class="h-11 w-11 shrink-0 rounded-xl border border-orange-100 object-cover">
                                    @else
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-[#FF6B00]">
                                            <i class="fa-solid fa-store text-sm"></i>
                                        </div>
                                    @endif

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-bold text-[#3B2115]">
                                            {{ $toko->nama_toko }}
                                        </p>

                                        <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                            Pengajuan toko
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <p class="text-xs font-semibold text-[#3B2115]">
                                    {{ $toko->user?->username ?? '-' }}
                                </p>

                                <p class="mt-1 text-[10px] text-[#A58E81]">
                                    {{ $toko->user?->email ?? '-' }}
                                </p>

                            </td>

                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center gap-2 text-xs text-[#72594B]">
                                    <i class="fa-regular fa-calendar text-[#C5A995]"></i>
                                    {{ $toko->created_at?->format('d M Y') ?? '-' }}
                                </div>

                                <p class="mt-1 text-[10px] text-[#A58E81]">
                                    {{ $toko->created_at?->format('H:i') ?? '' }}
                                </p>

                            </td>

                            <td class="px-5 py-4">

                                @if ($toko->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-50 px-3 py-1.5 text-[10px] font-bold text-yellow-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                        Menunggu
                                    </span>
                                @elseif ($toko->status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-[10px] font-bold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Disetujui
                                    </span>
                                @elseif ($toko->status === 'rejected')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-[10px] font-bold text-red-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-[10px] font-bold text-gray-600">
                                        {{ ucfirst($toko->status) }}
                                    </span>
                                @endif

                            </td>

                            <td class="px-5 py-4 text-center">

                                <a href="{{ route('admin.pengajuanToko.detail', $toko->id) }}"
                                    class="inline-flex items-center gap-2 rounded-xl border border-orange-100 bg-orange-50 px-3.5 py-2.5 text-[10px] font-bold text-orange-600 transition hover:border-orange-200 hover:bg-orange-100">
                                    <i class="fa-solid fa-eye text-[10px]"></i>
                                    Detail
                                </a>

                            </td>

                        </tr>
                    @endforeach

                    <tr id="emptyFilterRow" class="hidden">

                        <td colspan="5" class="px-5 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-orange-400">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>

                                <p id="emptyFilterTitle"
                                    class="mt-4 text-sm font-bold text-[#3B2115]">
                                    Belum ada pengajuan toko
                                </p>

                                <p id="emptyFilterDescription"
                                    class="mt-1 text-xs text-[#A58E81]">
                                    Pengajuan toko akan muncul di halaman ini.
                                </p>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        @if ($pengajuanToko->hasPages())
            <div class="flex flex-col gap-3 border-t border-orange-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <p class="text-[11px] text-[#A58E81]">
                    Menampilkan

                    <span class="font-bold text-[#72594B]">
                        {{ $pengajuanToko->firstItem() }}
                    </span>

                    sampai

                    <span class="font-bold text-[#72594B]">
                        {{ $pengajuanToko->lastItem() }}
                    </span>

                    dari

                    <span class="font-bold text-[#72594B]">
                        {{ $pengajuanToko->total() }}
                    </span>

                    pengajuan
                </p>

                <div>
                    {{ $pengajuanToko->links() }}
                </div>

            </div>
        @endif

    </section>

@endsection
