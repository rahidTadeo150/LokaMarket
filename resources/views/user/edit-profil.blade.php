@extends('layouts.customer')

@section('title', 'Edit Profil - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F2] px-4 py-6 sm:px-6 sm:py-8 lg:px-10">
    <div class="mx-auto max-w-6xl">

        <div class="mb-6 sm:mb-8">
            <p class="text-xl font-bold text-[#3D2418] sm:text-2xl">
                Perbarui Data Pribadi
            </p>
            <p class="mt-1 text-sm text-gray-500">
                Pastikan informasi akun Anda selalu terbaru.
            </p>
        </div>

        <form action="{{ route('cust.updateProfile') }}"
            id="form-edit-profil"
            method="POST"
            enctype="multipart/form-data"\>
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[280px_1fr]">
                <aside class="h-fit lg:sticky lg:top-24">
                    <section class="overflow-hidden rounded-3xl border border-orange-100 bg-white shadow-sm">

                        <div class="relative h-24 bg-linear-to-br from-orange-500 via-orange-500 to-amber-400">
                            <div class="absolute -right-8 -top-8 h-28 w-28 rounded-full bg-white/10"></div>
                            <div class="absolute -bottom-10 -left-6 h-24 w-24 rounded-full bg-white/10"></div>
                        </div>

                        <div class="px-5 pb-6">
                            <div class="-mt-14 flex justify-center">
                                <div class="relative">

                                    <div class="absolute -inset-1 rounded-full bg-linear-to-br from-orange-400 to-amber-300"></div>

                                    <div class="relative h-28 w-28 overflow-hidden rounded-full border-4 border-white bg-orange-50 shadow-lg">
                                        @if ($user->foto_profil)
                                            <img id="profilePreview"
                                                src="{{ asset('storage/' . $user->foto_profil) }}"
                                                alt="Foto profil"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div id="profilePlaceholder"
                                                class="flex h-full w-full items-center justify-center bg-linear-to-br from-orange-500 to-amber-400 text-3xl font-black text-white">
                                                {{ strtoupper(substr($user->username, 0, 2)) }}
                                            </div>
                                            <img id="profilePreview"
                                                src=""
                                                alt="Preview foto profil"
                                                class="hidden h-full w-full object-cover">
                                        @endif
                                    </div>
                                    <label for="foto_profil"
                                        class="absolute bottom-1 right-1 flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border-4 border-white bg-orange-500 text-white shadow-md transition hover:scale-105 hover:bg-orange-600">
                                        <i class="fa-solid fa-camera text-xs"></i>
                                    </label>

                                </div>
                            </div>


                            <div class="mt-4 text-center">
                                <h2 class="text-lg font-black text-[#3D2418]">
                                    {{ $user->username }}
                                </h2>
                                <p class="mt-1 truncate text-xs text-gray-400">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="mt-4 flex justify-center">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-6 py-1.5 text-[10px] font-bold text-green-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Akun Aktif
                                </span>
                            </div>

                            <div class="my-5 border-t border-gray-100"></div>

                            <div class="space-y-4">

                                <div class="flex items-center gap-x-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div class="min-w-0 flex flex-col justify-center gap-y-0.5">
                                        <p class="text-[10px] text-gray-400">
                                            Telah Bergabung
                                        </p>
                                        <p class="text-xs font-bold text-[#3D2418]">
                                            {{ $user->created_at->translatedFormat('F Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-x-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div class="min-w-0 flex flex-col justify-center gap-y-0.5">
                                        <p class="text-[10px] text-gray-400">
                                            Upgrade Toko
                                        </p>
                                        <p class="text-xs font-bold text-red-500">
                                            Belum Upgrade
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <label for="foto_profil"
                                class="mt-6 flex cursor-pointer items-center justify-center gap-2 rounded-xl border border-dashed border-orange-200 bg-orange-50/50 px-4 py-3 text-xs font-bold text-orange-600 transition hover:border-orange-400 hover:bg-orange-50">
                                <i class="fa-solid fa-camera"></i>
                                Ganti Foto Profil
                            </label>

                            <input id="foto_profil"
                                type="file"
                                name="foto_profil"
                                accept="image/jpeg,image/png,image/webp"
                                class="hidden">

                            <p id="foto-profil-error" class="mt-2 text-center text-xs text-red-500 hidden">asdasdasdasdad</p>
                            <p class="mt-2 text-center text-xs text-gray-400">
                                JPG, PNG, WEBP · Maks. 2 MB
                            </p>

                        </div>

                    </section>
                </aside>

                <div class="space-y-6">
                    <section class="rounded-3xl border border-orange-100 bg-white p-5 shadow-sm sm:p-7">

                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-[#3D2418] sm:text-lg">
                                    Informasi Diri
                                </h2>
                                <p class="text-xs text-gray-400">
                                    Perbarui informasi pribadi Anda.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>
                                <label for="username"
                                    class="mb-2 block text-xs font-bold text-[#5A4032]">
                                    Username
                                </label>
                                <div class="relative">
                                    <i class="fa-regular fa-user absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                                    <input id="username"
                                        name="username"
                                        value="{{ old('username', $user->username) }}"
                                        required
                                        autocomplete="off"
                                        class="w-full rounded-xl border border-slate-300 py-3 pl-10 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                </div>

                                <p id="username-error" class="mt-1 hidden text-xs text-red-500"></p>
                                
                            </div>

                            <div>
                                <label for="nama"
                                    class="mb-2 block text-xs font-bold text-[#5A4032]">
                                    Nama Lengkap
                                </label>
                                <div class="relative">
                                    <i class="fa-solid fa-address-card absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                                    <input id="nama"
                                        name="nama"
                                        type="nama"
                                        value="{{ old('nama', $user->nama) }}"
                                        autocomplete="off"
                                        required
                                        class="w-full rounded-xl border border-slate-300 py-3 pl-10 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                </div>

                                <p id="nama-error" class="mt-1 hidden text-xs text-red-500"></p>

                            </div>

                            <div>
                                @php
                                $displayPhone = old('no_telp', $user->no_telp); 

                                if (str_starts_with($displayPhone, '+62')) { 
                                    $displayPhone = substr($displayPhone, 3); 
                                }
                                @endphp
                                <label for="no_telp"
                                    class="mb-2 block text-xs font-bold text-[#5A4032]">
                                    No. Telepon
                                </label>
                                <div class="relative flex items-center">
                                    <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                                    <span class="absolute left-10 z-10 border-r border-slate-400 pr-3 text-sm font-semibold text-gray-600">
                                        +62
                                    </span>
                                    <input id="no_telp"
                                        name="no_telp"
                                        value="{{ $displayPhone }}"
                                        required
                                        inputmode="numeric"
                                        autocomplete="off"
                                        class="w-full rounded-xl border border-slate-300 py-3 pl-22 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                </div>

                                <p id="no-telp-error" class="mt-1 hidden text-xs text-red-500"></p>

                            </div>

                            <div>
                                <label for="tanggal_lahir"
                                    class="mb-2 block text-xs font-bold text-[#5A4032]">
                                    Tanggal Lahir
                                </label>
                                <div class="relative">
                                    <i class="fa-regular fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                                    <input id="tanggal_lahir"
                                        name="tanggal_lahir"
                                        type="date"
                                        value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}"
                                        class="w-full rounded-xl border border-slate-300 py-3 pl-10 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="email"
                                    class="mb-2 block text-xs font-bold text-[#5A4032]">
                                    Email
                                </label>
                                <div class="relative">
                                    <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
                                    <input id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email', $user->email) }}"
                                        disabled
                                        class="w-full rounded-xl bg-slate-100 border border-slate-300 py-3 pl-10 pr-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                </div>

                                <p id="email-error" class="mt-1 hidden text-xs text-red-500"></p>

                            </div>

                            <div class="sm:col-span-2">
                                <label for="jenis_kelamin"
                                    class="mb-2 block text-xs font-bold text-[#5A4032]">
                                    Jenis Kelamin
                                </label>
                                <select id="jenis_kelamin"
                                    name="jenis_kelamin"
                                    required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                    @foreach (['Laki-laki', 'Perempuan', 'Tidak ingin memberitahukan'] as $gender)
                                        <option value="{{ $gender }}"
                                            @selected(old('jenis_kelamin', $user->jenis_kelamin) === $gender)>
                                            {{ $gender }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="mt-6 flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                            <a href="{{ route('cust.myProfile') }}"
                            class="w-full rounded-full border border-orange-500 px-8 py-3 text-center text-sm font-bold text-orange-600 transition hover:bg-orange-50 sm:w-auto">
                                Batal
                            </a>
                            <button type="submit"
                                    id="submitBtn"
                                    class="w-full rounded-full bg-[#C9470D] px-8 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#A83A09] hover:shadow-md sm:w-auto">
                                <i class="fa-solid fa-check mr-1"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </section>

                </div>
            </div>

        </form>

    </div>
</main>
@endsection