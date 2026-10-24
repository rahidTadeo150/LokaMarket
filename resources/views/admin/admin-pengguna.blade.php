@extends('layouts.admin')

@section('title', 'Pengguna - LokaMarket')

@section('page-heading', 'Daftar Pengguna')

@section('content')
    <div class="mb-6 flex flex-col gap-4">
        <div>
            <p class="text-xs font-medium text-[#A58E81]">
                LokaMarket Admin
            </p>
            <h1 class="mt-1 text-2xl font-extrabold text-[#3B2115]">
                Daftar Pengguna
            </h1>
            <p class="mt-1 text-sm text-[#8D776A]">
                Lihat dan kelola semua pengguna yang terdaftar di LokaMarket.
            </p>
        </div>
    </div>

    <section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">

        <div class="flex flex-col gap-4 border-b border-orange-100 px-5 py-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h2 class="text-base font-bold text-[#3B2115]">
                    Daftar Pengguna LokaMarket
                </h2>

                <p class="mt-1 text-xs text-[#A58E81]">
                    Pengguna selain administrator
                </p>
                
            </div>

            <label class="relative block w-full lg:max-w-xs">
                <span class="sr-only">
                    Cari pengguna
                </span>
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-[#A58E81]"></i>
                <input type="search"
                    id="userSearchInput"
                    placeholder="Cari pengguna atau email"
                    class="w-full rounded-lg border border-orange-100 py-2.5 pl-9 pr-3 text-xs text-[#3B2115] outline-none placeholder:text-[#A58E81] focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
            </label>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-212 text-left">

                <thead class="bg-[#FFF9F2] text-[10px] font-bold text-[#72594B]">
                    <tr>
                        <th class="px-5 py-3">
                            Nama Pengguna
                        </th>
                        <th class="px-4 py-3">
                            Email
                        </th>
                        <th class="px-4 py-3">
                            Tanggal Daftar
                        </th>
                        <th class="px-4 py-3">
                            Jenis Account
                        </th>
                        <th class="px-4 py-3">
                            Status
                        </th>
                        <th class="px-5 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>


                <tbody id="userTableBody"
                    class="divide-y divide-orange-50 text-xs text-[#3B2115]">

                    @foreach ($users as $user)

                    <tr class="user-row transition hover:bg-[#FFFDF9]"
                        data-search="{{ strtolower($user->username . ' ' . $user->email) }}">

                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                @if ($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}"
                                        alt="{{ $user->username }}"
                                        class="h-8 w-8 shrink-0 rounded-full object-cover">
                                @else
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-orange-100 text-[10px] font-bold text-orange-700">
                                        {{ strtoupper(substr($user->username, 0, 2)) }}
                                    </span>
                                @endif
                                <div class="min-w-0">
                                    <p class="truncate font-semibold">
                                        {{ $user->username }}
                                    </p>
                                </div>
                            </div>
                        </td>


                        <td class="px-4 py-3.5 text-[11px] text-[#72594B]">
                            {{ $user->email }}
                        </td>

                        <td class="whitespace-nowrap px-4 py-3.5 text-[11px] text-[#72594B]">
                            {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                        </td>

                        <td class="px-4 py-3.5">
                            @if ($user->role === 'pemilik_toko')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-100 px-2.5 py-1 text-[10px] font-bold text-orange-700">
                                    <i class="fa-solid fa-store text-[9px]"></i>
                                    Pemilik Toko
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-sky-100 px-2.5 py-1 text-[10px] font-bold text-sky-700">
                                    <i class="fa-solid fa-user text-[9px]"></i>
                                    Customer
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3.5">
                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-[10px] font-bold text-green-700">
                                Aktif
                            </span>
                        </td>

                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3 text-[#72594B]">

                                <button type="button"
                                        title="Edit pengguna"
                                        class="transition hover:text-orange-500">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span class="sr-only">
                                        Edit
                                    </span>
                                </button>

                                <button type="button"
                                        title="Blokir pengguna"
                                        class="transition hover:text-red-500">
                                    <i class="fa-solid fa-trash-can"></i>
                                    <span class="sr-only">
                                        Deactive
                                    </span>
                                </button>

                                <button type="button"
                                        title="Lihat detail pengguna"
                                        class="transition hover:text-orange-500">
                                    <i class="fa-regular fa-eye"></i>
                                    <span class="sr-only">
                                        Detail
                                    </span>
                                </button>

                            </div>
                        </td>

                    </tr>

                    @endforeach

                    <tr id="userSearchEmpty" class="hidden">
                        <td colspan="6" class="px-5 py-12 text-center">
                            <div class="flex flex-col items-center">

                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-50 text-orange-400">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>

                                <p class="mt-3 text-sm font-semibold text-[#3B2115]">
                                    Pengguna tidak ditemukan
                                </p>

                                <p class="mt-1 text-xs text-[#A58E81]">
                                    Coba gunakan nama
                                </p>

                            </div>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        @if ($users->hasPages() || $users->total() > 0)
            <div class="flex flex-col gap-3 border-t border-orange-100 px-5 py-4 text-[11px] text-[#A58E81] sm:flex-row sm:items-center sm:justify-between">
                <span>
					Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} pengguna
                </span>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        @endif

    </section>
@endsection