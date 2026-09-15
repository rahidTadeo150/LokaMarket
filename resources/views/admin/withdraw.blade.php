
@extends('layouts.admin')

@section('title', 'Withdraw - LokaMarket')

@section('page-heading', 'Withdraw')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-[#3B2115]">
                    Withdraw
                </h1>

                <p class="mt-1 text-sm text-[#8D776A]">
                    Kelola permintaan penarikan dana dari penjual LokaMarket.
                </p>
            </div>

            <button
                type="button"
                class="flex items-center justify-center gap-2 rounded-xl bg-[#FF6B00] px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-[#E85D00]">
                <i class="fa-solid fa-download"></i>
                Export Data
            </button>
        </div>
    </div>


    {{-- STATISTIK WITHDRAW --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL DANA --}}
        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-[#A58E81]">
                        Total Penarikan
                    </p>

                    <h2 class="mt-2 text-xl font-extrabold text-[#3B2115]">
                        Rp12,8 Jt
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-green-600">
                        <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                        Bulan ini
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
            </div>
        </div>


        {{-- PENDING --}}
        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-[#A58E81]">
                        Menunggu
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        8
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-orange-600">
                        <i class="fa-solid fa-clock mr-1"></i>
                        Perlu diproses
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </div>
        </div>


        {{-- DIPROSES --}}
        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-[#A58E81]">
                        Sedang Diproses
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        4
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-blue-600">
                        <i class="fa-solid fa-spinner mr-1"></i>
                        Dalam proses
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-rotate"></i>
                </div>
            </div>
        </div>


        {{-- BERHASIL --}}
        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-[#A58E81]">
                        Berhasil
                    </p>

                    <h2 class="mt-2 text-2xl font-extrabold text-[#3B2115]">
                        142
                    </h2>

                    <p class="mt-2 text-xs font-semibold text-green-600">
                        <i class="fa-solid fa-circle-check mr-1"></i>
                        Penarikan selesai
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-600">
                    <i class="fa-solid fa-check"></i>
                </div>
            </div>
        </div>

    </div>


    {{-- FILTER --}}
    <div class="mt-6 rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- SEARCH --}}
            <div class="relative w-full lg:max-w-sm">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-xs text-[#A58E81]"></i>

                <input
                    type="text"
                    placeholder="Cari penjual atau ID withdraw..."
                    class="w-full rounded-xl border border-orange-100 bg-[#FFF9F4] py-3 pl-10 pr-4 text-xs text-[#3B2115] outline-none transition focus:border-orange-300 focus:ring-2 focus:ring-orange-100">
            </div>


            {{-- FILTER --}}
            <div class="flex flex-wrap gap-2">

                <button
                    class="rounded-lg bg-orange-500 px-4 py-2 text-[10px] font-bold text-white">
                    Semua
                </button>

                <button
                    class="rounded-lg border border-orange-100 px-4 py-2 text-[10px] font-semibold text-[#72594B] hover:bg-orange-50">
                    Menunggu
                </button>

                <button
                    class="rounded-lg border border-orange-100 px-4 py-2 text-[10px] font-semibold text-[#72594B] hover:bg-orange-50">
                    Diproses
                </button>

                <button
                    class="rounded-lg border border-orange-100 px-4 py-2 text-[10px] font-semibold text-[#72594B] hover:bg-orange-50">
                    Berhasil
                </button>

                <button
                    class="rounded-lg border border-orange-100 px-4 py-2 text-[10px] font-semibold text-[#72594B] hover:bg-orange-50">
                    Ditolak
                </button>

            </div>

        </div>
    </div>


    {{-- TABEL WITHDRAW --}}
    <div class="mt-5 overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">

        {{-- TABLE HEADER --}}
        <div class="flex items-center justify-between border-b border-orange-100 px-5 py-4">

            <div>
                <h2 class="text-sm font-bold text-[#3B2115]">
                    Daftar Withdraw
                </h2>

                <p class="mt-1 text-[10px] text-[#A58E81]">
                    Permintaan penarikan dana dari penjual
                </p>
            </div>

            <span class="rounded-full bg-orange-50 px-3 py-1.5 text-[9px] font-bold text-orange-600">
                12 Pengajuan
            </span>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px]">

                <thead class="bg-[#FFF9F4]">

                    <tr class="text-left">

                        <th class="px-5 py-3 text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            ID Withdraw
                        </th>

                        <th class="px-5 py-3 text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            Penjual
                        </th>

                        <th class="px-5 py-3 text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            Nominal
                        </th>

                        <th class="px-5 py-3 text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            Rekening
                        </th>

                        <th class="px-5 py-3 text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            Tanggal
                        </th>

                        <th class="px-5 py-3 text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            Status
                        </th>

                        <th class="px-5 py-3 text-center text-[9px] font-bold uppercase tracking-wide text-[#A58E81]">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-orange-50">


                    {{-- DATA 1 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <p class="text-xs font-bold text-[#3B2115]">
                                #WD-00125
                            </p>
                        </td>


                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-xs"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold text-[#3B2115]">
                                        Geprek WW
                                    </p>

                                    <p class="mt-1 text-[9px] text-[#A58E81]">
                                        Budi Santoso
                                    </p>
                                </div>

                            </div>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-extrabold text-[#3B2115]">
                                Rp300.000
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-semibold text-[#3B2115]">
                                BCA
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                •••• 1234
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-[10px] font-semibold text-[#72594B]">
                                15 Sep 2026
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                10:24 WIB
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-1 text-[8px] font-bold text-yellow-700">
                                Menunggu
                            </span>

                        </td>


                        <td class="px-5 py-4 text-center">

                            <button
                                type="button"
                                class="rounded-lg bg-orange-50 px-3 py-2 text-[9px] font-bold text-orange-600 transition hover:bg-orange-100">
                                Detail
                            </button>

                        </td>

                    </tr>


                    {{-- DATA 2 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <p class="text-xs font-bold text-[#3B2115]">
                                #WD-00124
                            </p>
                        </td>


                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-xs"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold text-[#3B2115]">
                                        Siti Craft
                                    </p>

                                    <p class="mt-1 text-[9px] text-[#A58E81]">
                                        Siti Aminah
                                    </p>
                                </div>

                            </div>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-extrabold text-[#3B2115]">
                                Rp500.000
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-semibold text-[#3B2115]">
                                BRI
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                •••• 5566
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-[10px] font-semibold text-[#72594B]">
                                14 Sep 2026
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                15:42 WIB
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-[8px] font-bold text-blue-700">
                                Diproses
                            </span>

                        </td>


                        <td class="px-5 py-4 text-center">

                            <button
                                type="button"
                                class="rounded-lg bg-orange-50 px-3 py-2 text-[9px] font-bold text-orange-600 transition hover:bg-orange-100">
                                Detail
                            </button>

                        </td>

                    </tr>


                    {{-- DATA 3 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <p class="text-xs font-bold text-[#3B2115]">
                                #WD-00123
                            </p>
                        </td>


                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-xs"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold text-[#3B2115]">
                                        Warung Bu Sri
                                    </p>

                                    <p class="mt-1 text-[9px] text-[#A58E81]">
                                        Sri Wahyuni
                                    </p>
                                </div>

                            </div>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-extrabold text-[#3B2115]">
                                Rp750.000
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-semibold text-[#3B2115]">
                                Mandiri
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                •••• 7821
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-[10px] font-semibold text-[#72594B]">
                                13 Sep 2026
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                09:18 WIB
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-[8px] font-bold text-green-700">
                                Berhasil
                            </span>

                        </td>


                        <td class="px-5 py-4 text-center">

                            <button
                                type="button"
                                class="rounded-lg bg-orange-50 px-3 py-2 text-[9px] font-bold text-orange-600 transition hover:bg-orange-100">
                                Detail
                            </button>

                        </td>

                    </tr>


                    {{-- DATA 4 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <p class="text-xs font-bold text-[#3B2115]">
                                #WD-00122
                            </p>
                        </td>


                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-xs"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold text-[#3B2115]">
                                        Kopi Banyuwangi
                                    </p>

                                    <p class="mt-1 text-[9px] text-[#A58E81]">
                                        Andi Pratama
                                    </p>
                                </div>

                            </div>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-extrabold text-[#3B2115]">
                                Rp250.000
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-xs font-semibold text-[#3B2115]">
                                BNI
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                •••• 9012
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <p class="text-[10px] font-semibold text-[#72594B]">
                                12 Sep 2026
                            </p>

                            <p class="mt-1 text-[9px] text-[#A58E81]">
                                14:05 WIB
                            </p>

                        </td>


                        <td class="px-5 py-4">

                            <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-[8px] font-bold text-red-700">
                                Ditolak
                            </span>

                        </td>


                        <td class="px-5 py-4 text-center">

                            <button
                                type="button"
                                class="rounded-lg bg-orange-50 px-3 py-2 text-[9px] font-bold text-orange-600 transition hover:bg-orange-100">
                                Detail
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="flex items-center justify-between border-t border-orange-100 px-5 py-4">

            <p class="text-[10px] text-[#A58E81]">
                Menampilkan 1–4 dari 12 pengajuan
            </p>

    

        </div>

    </div>

@endsection
