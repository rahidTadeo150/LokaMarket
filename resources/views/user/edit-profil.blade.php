@extends('layouts.customer')

@section('title', 'Edit Profil - LokaMarket')

@section('content')
    <main class="min-h-screen bg-[#FFF9F2] px-4 py-6 sm:px-6 sm:py-8 lg:px-12">
        <div class="mx-auto max-w-5xl">
            <div class="mb-6 sm:mb-8">
                <h1 class="text-xl font-bold text-[#3D2418] sm:text-2xl">Perbarui Data Pribadi</h1>
                <p class="mt-1 text-sm text-gray-500">Pastikan informasi akun anda selalu terbaru.</p>
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

            <div class="w-full">

                <form action="{{ route('cust.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <section class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-6 lg:p-7">
                        <div class="flex flex-col gap-6 border-b border-gray-100 pb-6 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex w-full flex-col items-center gap-3 sm:w-auto sm:shrink-0">
                                @if ($user->foto_profil)
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto profil" class="h-28 w-28 rounded-full object-cover shadow-sm">
                                @else
                                    <div class="flex h-28 w-28 items-center justify-center rounded-full bg-linear-to-br from-orange-500 to-amber-400 text-2xl font-bold text-white shadow-sm">
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

                        <div class="mt-6 grid min-w-0 grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5">
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

                    <section class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-6 lg:p-7">
                        <h2 class="text-lg font-bold text-[#3D2418]">Lokasi</h2>
                        <p class="mt-1 text-xs text-gray-400">Alamat ini dapat digunakan untuk kebutuhan pesanan.</p>
                        <label for="alamat" class="sr-only">Alamat lengkap</label>
                        <textarea id="alamat" name="alamat" rows="4" placeholder="RT/RW, Dusun, Desa, Kecamatan, Kota, Kabupaten, Provinsi" class="mt-4 w-full resize-none rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100">{{ old('alamat', $user->alamat) }}</textarea>
                        <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('cust.myProfile') }}" class="w-full rounded-full border border-orange-500 px-8 py-3 text-center text-sm font-bold text-orange-600 transition hover:bg-orange-50 sm:w-auto">Batal</a>
                            <button type="submit" class="w-full rounded-full bg-[#C9470D] px-8 py-3 text-sm font-bold text-white transition hover:bg-[#A83A09] sm:w-auto">Simpan Perubahan</button>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </main>
@endsection