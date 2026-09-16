@extends('layouts.admin')

@section('title', 'Pengajuan Toko - LokaMarket')

@section('page-heading', 'Pengajuan Toko')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#3B2115]">
            Pengajuan Toko
        </h1>

        <p class="mt-1 text-sm text-[#8D776A]">
            Periksa dan kelola pengajuan toko dari calon penjual.
        </p>
    </div>


    {{-- CARD UTAMA --}}
    <div class="rounded-2xl border border-orange-100 bg-white shadow-sm">

        {{-- SEARCH & FILTER --}}
        <div class="flex flex-col gap-4 border-b border-orange-100 p-5 md:flex-row md:items-center md:justify-between">

            {{-- SEARCH --}}
            <div class="relative w-full md:max-w-md">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#A58E81]">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>

                <input
                    type="text"
                    placeholder="Cari nama toko / pemilik..."
                    class="w-full rounded-xl border border-orange-100 bg-[#FFF9F4] py-3 pl-11 pr-4 text-sm text-[#3B2115] outline-none transition placeholder:text-[#B9A69A] focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                >
            </div>


            {{-- FILTER --}}
            <div class="relative w-full md:w-44">
                <select
                    class="w-full appearance-none rounded-xl border border-orange-100 bg-white px-4 py-3 text-sm font-medium text-[#72594B] outline-none transition focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                >
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>

                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-[#A58E81]">
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </span>
            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px]">

                {{-- TABLE HEADER --}}
                <thead>
                    <tr class="border-b border-orange-100 bg-[#FFF9F4]">

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Toko
                        </th>

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Pemilik
                        </th>

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center text-[10px] font-bold uppercase tracking-wider text-[#8D776A]">
                            Aksi
                        </th>

                    </tr>
                </thead>


                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-orange-50">

                    {{-- DATA 1 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-sm"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Geprek WW
                                    </p>

                                    <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                        Makanan & Minuman
                                    </p>
                                </div>

                            </div>
                        </td>


                        <td class="px-5 py-4">
                            <p class="text-xs font-semibold text-[#3B2115]">
                                Budi Santoso
                            </p>

                            <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                budi@email.com
                            </p>
                        </td>


                        <td class="px-5 py-4">
                            <span class="text-xs text-[#72594B]">
                                15 Sep 2026
                            </span>
                        </td>


                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-3 py-1.5 text-[10px] font-bold text-yellow-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                Pending
                            </span>
                        </td>


                        <td class="px-5 py-4 text-center">
                            <a
                                href="#"
                                class="inline-flex items-center gap-2 rounded-lg bg-orange-50 px-3 py-2 text-[10px] font-bold text-orange-600 transition hover:bg-orange-100"
                            >
                                <i class="fa-solid fa-eye text-[9px]"></i>
                                Detail
                            </a>
                        </td>

                    </tr>


                    {{-- DATA 2 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-sm"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Kopi Banyuwangi
                                    </p>

                                    <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                        Makanan & Minuman
                                    </p>
                                </div>

                            </div>
                        </td>


                        <td class="px-5 py-4">
                            <p class="text-xs font-semibold text-[#3B2115]">
                                Andi Pratama
                            </p>

                            <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                andi@email.com
                            </p>
                        </td>


                        <td class="px-5 py-4">
                            <span class="text-xs text-[#72594B]">
                                14 Sep 2026
                            </span>
                        </td>


                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-3 py-1.5 text-[10px] font-bold text-yellow-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                Pending
                            </span>
                        </td>


                        <td class="px-5 py-4 text-center">
                            <a
                                href="#"
                                class="inline-flex items-center gap-2 rounded-lg bg-orange-50 px-3 py-2 text-[10px] font-bold text-orange-600 transition hover:bg-orange-100"
                            >
                                <i class="fa-solid fa-eye text-[9px]"></i>
                                Detail
                            </a>
                        </td>

                    </tr>


                    {{-- DATA 3 --}}
                    <tr class="transition hover:bg-[#FFF9F4]">

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                    <i class="fa-solid fa-store text-sm"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-[#3B2115]">
                                        Snack Bu Rina
                                    </p>

                                    <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                        Aneka Snack
                                    </p>
                                </div>

                            </div>
                        </td>


                        <td class="px-5 py-4">
                            <p class="text-xs font-semibold text-[#3B2115]">
                                Rina Wulandari
                            </p>

                            <p class="mt-0.5 text-[10px] text-[#A58E81]">
                                rina@email.com
                            </p>
                        </td>


                        <td class="px-5 py-4">
                            <span class="text-xs text-[#72594B]">
                                13 Sep 2026
                            </span>
                        </td>


                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-[10px] font-bold text-green-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                Approved
                            </span>
                        </td>


                        <td class="px-5 py-4 text-center">
                            <a
                                href="#"
                                class="inline-flex items-center gap-2 rounded-lg bg-orange-50 px-3 py-2 text-[10px] font-bold text-orange-600 transition hover:bg-orange-100"
                            >
                                <i class="fa-solid fa-eye text-[9px]"></i>
                                Detail
                            </a>
                        </td>

                    </tr>


                </tbody>

            </table>

        </div>


        {{-- FOOTER TABLE --}}
        <div class="flex flex-col gap-3 border-t border-orange-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            </div>

        </div>

    </div>

@endsection