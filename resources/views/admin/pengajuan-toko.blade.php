@extends('layouts.admin')

@section('title', 'Pengajuan Toko - LokaMarket')

@section('page-heading', 'Pengajuan Toko')

@section('content')

    <div class="mb-6">
        <p class="text-xs font-medium text-[#A58E81]">
            LokaMarket Admin
        </p>
        <h1 class="mt-1 text-2xl font-extrabold text-[#3B2115]">
            Pengajuan Toko
        </h1>
        <p class="mt-1 text-sm text-[#8D776A]">
            Periksa dan kelola pengajuan toko dari calon penjual.
        </p>
    </div>


    <section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">

        <div class="border-b border-orange-100 px-5 py-5">
            <h2 class="text-base font-bold text-[#3B2115]">
                Daftar Pengajuan Toko
            </h2>
            <p class="mt-1 text-xs text-[#A58E81]">
                Pengajuan toko yang menunggu pemeriksaan admin.
            </p>
        </div>

        <x-alert-session/>

        <div class="overflow-x-auto">

            <table class="w-full min-w-200">

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


                <tbody class="divide-y divide-orange-50">

                    @forelse ($pengajuanToko as $toko)

                        <tr class="transition hover:bg-[#FFF9F4]">

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    @if ($toko->foto_profil)
                                    <img src="{{ asset('storage/' . $toko->foto_profil) }}"
                                        alt="{{ $toko->nama_toko }}"
                                        class="h-10 w-10 shrink-0 rounded-xl object-cover">
                                    @else
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
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
                                <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                    {{ $toko->user?->email ?? '-' }}
                                </p>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="text-xs text-[#72594B]">
                                    {{ $toko->created_at?->format('d M Y') ?? '-' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">

                                @if ($toko->status === 'pending')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-3 py-1.5 text-[10px] font-bold text-yellow-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                    Pending
                                </span>

                                @elseif ($toko->status === 'approved')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-[10px] font-bold text-green-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Approved
                                </span>

                                @elseif ($toko->status === 'rejected')

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 text-[10px] font-bold text-red-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    Rejected
                                </span>

                                @endif

                            </td>

                            <td class="px-5 py-4 text-center">
                                <a href="{{ route('admin.pengajuanToko.detail', $toko->id) }}"
                                class="inline-flex items-center gap-2 rounded-lg bg-orange-50 px-3 py-2 text-[10px] font-bold text-orange-600 transition hover:bg-orange-100">
                                    <i class="fa-solid fa-eye text-[9px]"></i>
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-5 py-14 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-orange-400">
                                        <i class="fa-solid fa-store text-xl"></i>
                                    </div>
                                    <p class="mt-4 text-sm font-bold text-[#3B2115]">
                                        Belum ada pengajuan toko
                                    </p>
                                    <p class="mt-1 text-xs text-[#A58E81]">
                                        Pengajuan toko akan muncul di halaman ini.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($pengajuanToko->hasPages())

            <div class="flex flex-col gap-3 border-t border-orange-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-[11px] text-[#A58E81]">
                    Menampilkan
                    <span class="font-semibold text-[#72594B]">
                        {{ $pengajuanToko->firstItem() }}
                    </span>
                    sampai
                    <span class="font-semibold text-[#72594B]">
                        {{ $pengajuanToko->lastItem() }}
                    </span>
                    dari
                    <span class="font-semibold text-[#72594B]">
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