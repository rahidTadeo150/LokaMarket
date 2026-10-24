@extends('layouts.admin')

@section('title', 'Pengajuan Return - LokaMarket')

@section('content')
    @php

        $statusAktif = request('status', 'semua');

        $tabs = [
            'semua' => [
                'label' => 'Semua',
                'count' => $statistik['total'],
            ],
            'diajukan' => [
                'label' => 'Menunggu Review',
                'count' => ($jumlahStatus['diajukan'] ?? 0) + ($jumlahStatus['menunggu_review'] ?? 0),
            ],
            'diproses' => [
                'label' => 'Diproses',
                'count' => $statistik['diproses'],
            ],
            'disetujui' => [
                'label' => 'Disetujui',
                'count' => $statistik['disetujui'],
            ],
            'ditolak' => [
                'label' => 'Ditolak',
                'count' => $statistik['ditolak'],
            ],
            'selesai' => [
                'label' => 'Selesai',
                'count' => $statistik['selesai'],
            ],
        ];

        $statusLabel = [
            'diajukan' => 'Menunggu Review',
            'menunggu_review' => 'Menunggu Review',
            'diproses' => 'Diproses',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
        ];

        $statusClass = [
            'diajukan' => 'bg-amber-50 text-amber-700',
            'menunggu_review' => 'bg-amber-50 text-amber-700',
            'diproses' => 'bg-blue-50 text-blue-700',
            'disetujui' => 'bg-emerald-50 text-emerald-700',
            'ditolak' => 'bg-red-50 text-red-700',
            'selesai' => 'bg-gray-100 text-gray-700',
        ];

    @endphp

    <div class="min-h-screen bg-[#FFF9F2] px-4 py-6 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl space-y-6">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <p class="text-sm font-semibold text-orange-600">
                        Manajemen Pesanan
                    </p>

                    <h1 class="mt-1 text-2xl font-bold text-gray-900 sm:text-3xl">
                        Pengajuan Return
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Kelola dan tinjau permintaan pengembalian barang dari customer.
                    </p>
                </div>

                <button type="button" onclick="window.print()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z" />
                    </svg>
                    Cetak Data
                </button>

            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <p class="text-sm font-medium text-gray-500">
                            Total Pengajuan
                        </p>

                        <span class="rounded-xl bg-orange-50 p-2.5 text-orange-600">
                            <i class="fa-solid fa-box-open"></i>
                        </span>

                    </div>

                    <p class="mt-3 text-3xl font-bold text-gray-900">
                        {{ $statistik['total'] }}
                    </p>

                    <p class="mt-1 text-xs text-gray-400">
                        Semua pengajuan return
                    </p>

                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <p class="text-sm font-medium text-gray-500">
                            Menunggu Review
                        </p>

                        <span class="rounded-xl bg-amber-50 p-2.5 text-amber-600">
                            <i class="fa-regular fa-clock"></i>
                        </span>

                    </div>

                    <p class="mt-3 text-3xl font-bold text-amber-600">
                        {{ $statistik['menunggu'] }}
                    </p>

                    <p class="mt-1 text-xs text-gray-400">
                        Perlu ditinjau
                    </p>

                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500">
                            Disetujui
                        </p>

                        <span class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                    </div>

                    <p class="mt-3 text-3xl font-bold text-emerald-600">
                        {{ $statistik['disetujui'] }}
                    </p>

                    <p class="mt-1 text-xs text-gray-400">
                        Return disetujui
                    </p>

                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <p class="text-sm font-medium text-gray-500">
                            Ditolak
                        </p>

                        <span class="rounded-xl bg-red-50 p-2.5 text-red-600">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </span>

                    </div>

                    <p class="mt-3 text-3xl font-bold text-red-600">
                        {{ $statistik['ditolak'] }}
                    </p>

                    <p class="mt-1 text-xs text-gray-400">
                        Return ditolak
                    </p>

                </div>

            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 p-5 sm:p-6">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                        <div>
                            <P class="text-lg font-bold text-gray-900">
                                Daftar Pengajuan Customer
                            </P>
                            <p class="mt-1 text-xs text-gray-500">
                                Data ditampilkan berdasarkan database.
                            </p>
                        </div>

                        <form id="formSearchReturn" 
                            method="GET" 
                            action="{{ route('admin.pengajuanReturn') }}"
                            class="flex w-full flex-col gap-2 sm:flex-row lg:max-w-xl">
                            @if ($statusAktif !== 'semua')
                                <input type="hidden" name="status" value="{{ $statusAktif }}">
                            @endif

                            <div class="relative w-full">
                                <div class="pointer-events-none absolute left-3 top-1/2 flex h-4 w-4 -translate-y-1/2 items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>

                                <input id="searchReturn" 
                                    type="search" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Cari nomor pesanan, customer, atau alasan..." autocomplete="off"
                                    class="w-full rounded-xl border border-gray-200 py-2.5 pl-10 pr-3 text-sm outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                            </div>

                            <button id="btnSearchReturn"
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-600">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Cari
                            </button>

                            @if (request()->filled('search'))
                                <a id="resetSearchReturn"
                                href="{{ route('admin.pengajuanReturn', $statusAktif === 'semua' ? [] : ['status' => $statusAktif]) }}"
                                    class="rounded-xl border border-gray-200 px-4 py-2.5 text-center text-sm font-semibold text-gray-600 hover:bg-gray-50">
                                    Reset
                                </a>
                            @endif

                        </form>

                    </div>

                </div>

                <div class="mb-5 border-b border-gray-100 px-5 sm:px-6">

                    <div class="-mb-px flex gap-6 overflow-x-auto pb-3">

                        @foreach ($tabs as $key => $tab)
                            <a href="{{ route('admin.pengajuanReturn', array_filter(['status' => $key === 'semua' ? null : $key, 'search' => request('search')], fn($value) => $value !== null && $value !== '')) }}"
                                @class([
                                    'inline-flex items-center gap-1 whitespace-nowrap border-b-2 px-1 py-4 text-sm transition',
                                    'border-orange-500 font-semibold text-orange-600' => $statusAktif === $key,
                                    'border-transparent font-medium text-gray-500 hover:text-orange-600' =>
                                        $statusAktif !== $key,
                                ])>

                                {{ $tab['label'] }}

                                <span @class([
                                    'ml-1 rounded-full px-2 py-0.5 text-xs',
                                    'bg-orange-100 text-orange-700' => $statusAktif === $key,
                                    'bg-gray-100 text-gray-600' => $statusAktif !== $key,
                                ])>
                                    {{ $tab['count'] }}
                                </span>
                            </a>
                        @endforeach

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full min-w-212 text-left text-sm">

                        <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Pengajuan</th>
                                <th class="px-6 py-4 font-semibold">Customer</th>
                                <th class="px-6 py-4 font-semibold">Keterangan</th>
                                <th class="px-6 py-4 font-semibold">Tanggal</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($pengajuan as $item)
                                @php
                                    $statusItem = strtolower($item->status ?? '');
                                    $labelItem =
                                        $statusLabel[$statusItem] ??
                                        ucfirst(str_replace('_', ' ', $statusItem ?: 'Tidak diketahui'));
                                    $classItem = $statusClass[$statusItem] ?? 'bg-gray-100 text-gray-600';
                                @endphp

                                <tr class="transition hover:bg-orange-50/50">
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-800">
                                            {{ $item->nomor_pesanan ?? '-' }}
                                        </p>
                                        <p class="mt-1 max-w-xs text-xs text-gray-500">
                                            {{ $item->alasan ?? '-' }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-800">
                                            {{ $item->user?->name ?? 'Customer tidak ditemukan' }}
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item->user?->email ?? '-' }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="max-w-xs whitespace-normal text-gray-600">
                                            {{ $item->keterangan ?: '-' }}
                                        </p>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-gray-600">
                                        {{ $item->created_at?->format('d M Y') ?? '-' }}
                                        @if ($item->created_at)
                                            <p class="mt-1 text-xs text-gray-400">
                                                {{ $item->created_at->format('H:i') }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold {{ $classItem }}">
                                            {{ $labelItem }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.pengajuanReturn.detail', $item->id) }}"
                                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg bg-orange-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2">
                                            <i class="fa-solid fa-eye"></i>
                                            Detail
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-14 text-center">
                                        <div
                                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                            <i class="fa-solid fa-box-open text-xl"></i>
                                        </div>
                                        <P class="mt-4 font-semibold text-gray-800">
                                            Tidak ada pengajuan return
                                        </P>
                                        <p class="mt-1 text-sm text-gray-500">
                                            @if (request()->filled('search'))
                                                Tidak ditemukan data yang sesuai dengan pencarian.
                                            @else
                                                Belum ada pengajuan pada status ini.
                                            @endif
                                        </p>
                                        @if (request()->filled('search') || $statusAktif !== 'semua')
                                            <a href="{{ route('admin.pengajuanReturn') }}"
                                                class="mt-4 inline-block text-sm font-semibold text-orange-600 hover:text-orange-700">
                                                Tampilkan semua pengajuan
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="flex flex-col gap-3 border-t border-gray-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <p class="text-sm text-gray-500">
                        Menampilkan
                        <span class="font-semibold text-gray-800">
                            {{ $pengajuan->firstItem() ?? 0 }}–{{ $pengajuan->lastItem() ?? 0 }}
                        </span>
                        dari
                        <span class="font-semibold text-gray-800">
                            {{ $pengajuan->total() }}
                        </span>
                        pengajuan
                    </p>

                    <div>
                        {{ $pengajuan->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
