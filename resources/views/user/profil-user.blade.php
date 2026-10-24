@extends('layouts.customer')

@section('title', 'Profil Saya - LokaMarket')

@section('content')
<main class="bg-[#FFF9F2] px-8 md:px-10 lg:px-20 py-8">

    <div class="mx-auto">

        <div class="mb-10">
            <p class="text-2xl font-bold text-[rgb(61,36,24)]">
                Profil Saya
            </p>
            <p class="text-sm font-light text-gray-500">
                Kelola informasi profile lokamarket Saya
            </p>
            <div class="mt-6 h-0.5 w-full rounded-full bg-orange-500"></div>
        </div>

        <x-alert-session/>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

            <div class="rounded-xl md:rounded-4xl border border-orange-100 bg-white p-10 shadow-sm">
                <div class="flex flex-col items-center text-center">

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
                            @endif
                        </div>

                    </div>

                    <h2 class="mt-3 font-bold text-[#3D2418]">
                        {{ $user->username }}
                    </h2>
                    <p class="mt-1 text-xs font-light text-gray-400">
                        Member sejak {{ $user->created_at->translatedFormat('d F Y') }}
                    </p>

                </div>

                <div class="mt-6 space-y-1">

                    <a href="#"
                        class="flex items-center gap-3 rounded-lg bg-orange-50 px-3 py-2.5 text-sm font-semibold text-orange-600">
                        <i class="fa-solid fa-user"></i>
                        <span>
                            Profil Saya    
                        </span>
                    </a>

                    @if (auth()->user()->role === 'customer')
                    <a href="{{ route('cust.benefitUpgradeAccount') }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                        <i class="fa-solid fa-wrench"></i>
                        <span>
                            Upgrade ke akun toko
                        </span>
                    </a>
                    @endif

                    <a href="{{ route('cust.statusPengajuan') }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                        <i class="fa-regular fa-clock"></i>
                        <span>
                            Status Pengajuan Toko
                        </span>
                    </a>

                    <a href="{{ route('cust.wishlist') }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                        <i class="fa-solid fa-heart"></i>
                        <span>
                            Wishlist
                        </span>
                    </a>

                    <form id="resetPasswordForm"
                        action="{{ route('password.email') }}"
                        method="POST">
                        @csrf

                        <input type="hidden"
                            name="email"
                            value="{{ auth()->user()->email }}">

                        <button type="button"
                                id="openResetPasswordModal"
                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-gray-600 transition hover:bg-orange-50 hover:text-orange-600">
                            <i class="fa-solid fa-lock"></i>
                            <span>Ganti Password</span>
                        </button>
                    </form>

                    <div id="resetPasswordModal"
                        class="fixed inset-0 z-9999 hidden items-center justify-center bg-black/30 px-5 backdrop-blur-sm">
                        <div id="resetPasswordModalContent"
                            class="w-full max-w-sm scale-95 rounded-2xl border border-orange-100 bg-white p-6 opacity-0 shadow-2xl transition-all duration-200">

                            <div class="mb-5 flex justify-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-orange-100 text-orange-500">
                                    <i class="fa-solid fa-lock text-xl"></i>
                                </div>
                            </div>

                            <div class="text-center">
                                <h3 class="text-lg font-bold text-[#3D2418]">
                                    Ganti Password?
                                </h3>
                                <p class="mt-2 text-xs leading-6 text-gray-500">
                                    Kami akan mengirimkan link reset password
                                    ke email akun Anda.
                                </p>
                                <p class="mt-2 py-2 break-all text-sm bg-orange-50 rounded-lg font-semibold text-orange-500">
                                    {{ auth()->user()->email }}
                                </p>

                            </div>

                            <div class="mt-6 flex gap-3">
                                
                                <button type="button"
                                        id="closeResetPasswordModal"
                                        class="flex-1 rounded-full border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                                    Batal
                                </button>
                                <button type="button"
                                        id="confirmResetPassword"
                                        class="flex-1 rounded-full bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-600">
                                    <i class="fa-solid fa-paper-plane mr-1"></i>
                                    Kirim
                                </button>

                            </div>

                        </div>
                    </div>

                    <div class="my-3 border-t border-gray-100"></div>

                    <form id="logoutForm"
                        class="px-1"
                        action="{{ route('auth.logout') }}"
                        method="POST">
                        @csrf

                        <button type="button"
                                class="openLogoutModal flex w-full items-center gap-3 px-3 py-2.5 rounded-xl text-left text-sm text-gray-600 transition hover:bg-red-50 hover:text-red-600">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>
                                Keluar
                            </span>
                        </button>

                    </form>

                </div>
            </div>
            

            <div class="space-y-5 col-span-2">
                <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h2 class="text-xl font-bold text-[#3D2418]">
                                Informasi Akun
                            </h2>
                            <p class="mt-1 text-xs text-gray-400">
                                Informasi pribadi akun Anda
                            </p>
                        </div>
                        <a href="{{ route('cust.editProfile') }}"
                        class="rounded-md bg-orange-500 px-5 py-1.5 text-xs font-semibold text-white transition hover:bg-orange-600">
                            Edit Profil
                        </a>
                    </div>
                    <div class="grid grid-cols-1 gap-x-8 sm:grid-cols-2">
                        <div class="border-b border-gray-100 py-3">
                            <p class="text-[10px] text-gray-400">
                                Username
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                {{ $user->username }}
                            </p>
                        </div>
                        <div class="border-b border-gray-100 py-3">
                            <p class="text-[10px] text-gray-400">
                                Nama lengkap
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                {{ $user->nama }}
                            </p>
                        </div>
                        <div class="border-b border-gray-100 py-3">
                            <p class="text-[10px] text-gray-400">
                                Email
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="border-b border-gray-100 py-3">
                            <p class="text-[10px] text-gray-400">
                                No. Telepon
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                {{ $user->no_telp }}
                            </p>
                        </div>
                        <div class="border-b border-gray-100 py-3">
                            <p class="text-[10px] text-gray-400">
                                Jenis Kelamin
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#3D2418]">
                                {{ $user->jenis_kelamin ?? 'Tidak Ingin Memberi tahukan' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-bag-shopping text-lg"></i>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-[#3D2418]">
                                    24
                                </p>
                                <p class="text-xs text-gray-400">
                                    Total Pesanan
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-check text-lg"></i>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-[#3D2418]">
                                    20
                                </p>
                                <p class="text-xs text-gray-400">
                                    Pesanan Selesai
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-500">
                                <i class="fa-solid fa-heart text-lg"></i>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-[#3D2418]">
                                    12
                                </p>
                                <p class="text-xs text-gray-400">
                                    Produk Wishlist
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">

                    @if ($alamatUtama)

                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0 flex-1">

                                <p class="text-xl font-bold text-[#3D2418]">
                                    Alamat Utama
                                </p>

                                <div class="mt-3 flex gap-5">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-100 text-orange-500">
                                        @if (strtolower($alamatUtama->label) === 'rumah')
                                            <i class="fa-solid fa-house text-xs"></i>
                                        @elseif (strtolower($alamatUtama->label) === 'kantor')
                                            <i class="fa-solid fa-building text-xs"></i>
                                        @elseif (strtolower($alamatUtama->label) === 'kos')
                                            <i class="fa-solid fa-door-open text-xs"></i>
                                        @else
                                            <i class="fa-solid fa-location-dot text-xs"></i>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <p class="text-sm font-bold text-[#3B2115]">
                                            {{ $alamatUtama->label }}
                                        </p>

                                        <div class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1">
                                            <p class="text-sm font-semibold text-[#3B2115]">
                                                {{ $alamatUtama->nama_penerima }}
                                            </p>
                                            <span class="text-xs text-[#D2BFB2]">
                                                •
                                            </span>
                                            <p class="text-xs text-[#72594B]">
                                                {{ $alamatUtama->no_telepon ?? '-' }}
                                            </p>
                                        </div>

                                        <p class="mt-3 text-xs leading-relaxed text-[#72594B] sm:text-sm">
                                            {{ $alamatUtama->kecamatan->nama ?? '-' }},
                                            {{ $alamatUtama->kota->nama ?? '-' }},
                                            {{ $alamatUtama->provinsi->nama ?? '-' }}
                                        </p>

                                        <p class="mt-0.5 text-xs leading-relaxed text-[#72594B]sm:text-sm">
                                            {{ $alamatUtama->alamat_lengkap }}, Kode Pos : {{ $alamatUtama->kode_pos ?? '-' }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                            <span class="shrink-0 rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-bold uppercase text-orange-600">
                                Utama
                            </span>

                        </div>

                        <div class="mt-4 flex justify-end border-t border-gray-200 pt-4">

                            <a href="{{ route('cust.pilihAlamat') }}"
                            class="text-xs px-6 py-2 font-medium text-white bg-orange-500 rounded-lg   transition hover:scale-95">
                                Ubah Alamat
                            </a>

                        </div>


                    @else

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-orange-50 text-orange-400">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div class="flex-1">
                                <p class="text-xl font-bold text-[#3D2418]">
                                    Alamat Utama
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Kamu belum memiliki alamat utama.
                                </p>
                            </div>

                        </div>

                        <div class="mt-4 rounded-lg border border-orange-100 bg-orange-50/70 px-4 py-3">

                            <div class="flex items-center justify-between gap-4">

                                <div class="flex items-center gap-2 text-xs text-orange-700">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>
                                        Pilih alamat utama untuk mempermudah
                                        proses pemesanan.
                                    </span>
                                </div>

                                <a href="{{ route('cust.pilihAlamat') }}"
                                class="shrink-0 rounded-lg bg-orange-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-orange-600">
                                    Pilih Alamat
                                </a>

                            </div>

                        </div>

                    @endif

                </div>
                
            </div>

        </div>

    </div>
    
</main>

@endsection