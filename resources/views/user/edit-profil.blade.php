@extends('layouts.customer')

@section('title', 'Edit Profil - LokaMarket')

@section('content')
    <main class="min-h-screen bg-[#FFF9F2] px-5 py-8 sm:px-8 lg:px-20">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-[#3D2418]">Profil Saya</h1>
                <p class="mt-1 text-sm text-gray-500">Kelola informasi akun dan preferensi Anda.</p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[240px_minmax(0,1fr)]">
                <aside class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
                    <div class="flex flex-col items-center text-center">
                        @if ($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto profil {{ $user->username }}" class="h-20 w-20 rounded-full object-cover shadow-sm">
                        @else
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-linear-to-br from-orange-500 to-amber-400 text-xl font-bold text-white shadow-sm">
                                {{ strtoupper(substr($user->username, 0, 2)) }}
                            </div>
                        @endif
                        <h2 class="mt-3 font-bold text-[#3D2418]">{{ $user->username }}</h2>
                        <p class="mt-1 break-all text-xs text-gray-400">{{ $user->email }}</p>
                    </div>
                    <a href="{{ route('cust.myProfile') }}" class="mt-7 flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali ke Profil
                    </a>
                    <form action="{{ route('auth.logout') }}" method="POST" class="mt-2 border-t border-gray-100 pt-2">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-red-500 transition hover:bg-red-50">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Keluar
                        </button>
                    </form>
                </aside>

                <form action="{{ route('cust.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <section class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-7">
                        <div class="flex flex-col gap-5 border-b border-gray-100 pb-6 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-[#3D2418]">Perbarui Data Pribadi</h2>
                                <p class="mt-1 text-xs text-gray-400">Pastikan informasi akun Anda selalu terbaru.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                @if ($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto profil" class="h-20 w-20 rounded-full object-cover">
                                @else
                                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-linear-to-br from-orange-500 to-amber-400 text-xl font-bold text-white">
                                        {{ strtoupper(substr($user->username, 0, 2)) }}
                                    </div>
                                @endif
                                <label class="cursor-pointer rounded-full border border-orange-500 px-4 py-2 text-xs font-bold text-orange-600 transition hover:bg-orange-50">
                                    <i class="fa-solid fa-upload mr-1"></i>
                                    Ganti Foto Profil
                                    <input type="file" name="foto_profil" accept="image/jpeg,image/png,image/webp" class="sr-only">
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="username" class="mb-2 block text-xs font-bold text-[#5A4032]">Nama Lengkap</label>
                                <input id="username" name="username" value="{{ old('username', $user->username) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                            </div>
                            <div>
                                <label for="email" class="mb-2 block text-xs font-bold text-[#5A4032]">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                            </div>
                            <div>
                                <label for="no_telp" class="mb-2 block text-xs font-bold text-[#5A4032]">No. Telepon</label>
                                <input id="no_telp" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="mb-2 block text-xs font-bold text-[#5A4032]">Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                            </div>
                            <div>
                                <label for="jenis_kelamin" class="mb-2 block text-xs font-bold text-[#5A4032]">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                                    @foreach (['Laki-laki', 'Perempuan', 'Tidak ingin memberitahukan'] as $gender)
                                        <option value="{{ $gender }}" @selected(old('jenis_kelamin', $user->jenis_kelamin) === $gender)>{{ $gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-7">
                        <h2 class="text-lg font-bold text-[#3D2418]">Lokasi</h2>
                        <p class="mt-1 text-xs text-gray-400">Alamat ini dapat digunakan untuk kebutuhan pesanan.</p>
                        <label for="alamat" class="sr-only">Alamat lengkap</label>
                        <textarea id="alamat" name="alamat" rows="4" placeholder="RT/RW, Dusun, Desa, Kecamatan, Kota, Kabupaten, Provinsi" class="mt-4 w-full resize-none rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">{{ old('alamat', $user->alamat) }}</textarea>
                        <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('cust.myProfile') }}" class="rounded-full border border-orange-500 px-8 py-3 text-center text-sm font-bold text-orange-600 transition hover:bg-orange-50">Batal</a>
                            <button type="submit" class="rounded-full bg-[#C9470D] px-8 py-3 text-sm font-bold text-white transition hover:bg-[#A83A09]">Simpan Perubahan</button>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </main>
@endsection