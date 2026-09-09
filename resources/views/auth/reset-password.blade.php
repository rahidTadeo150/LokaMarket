@extends('layouts.auth-customer')

@section('title', 'Buat Password Baru - LokaMarket')

@section('content')
    <main class="mx-auto flex min-h-screen items-center justify-center bg-[#FFF9F4] px-4 py-28 sm:px-6">
        <section class="w-full max-w-md rounded-[22px] border border-[#F1DCC8] bg-white px-5 py-8 shadow-xl sm:px-10 sm:py-10">
            <div class="mb-8 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF0E5] text-[#E95309]">
                    <i class="fa-solid fa-lock text-xl"></i>
                </div>
                <h1 class="mt-5 text-2xl font-extrabold text-[#3B2115]">Buat Password Baru</h1>
                <p class="mt-2 text-sm leading-6 text-[#72594B]">
                    Gunakan password baru yang kuat untuk mengamankan akun Anda.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-xs text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <input id="email" name="email" type="hidden" value="{{ old('email', $email) }}" required autocomplete="email"
                           class="w-full rounded-full border border-slate-300 px-4 py-3 text-sm text-[#3B2115] outline-none focus:border-orange-500 focus:ring-2 focus:ring-[#FFD1AD]">
                </div>

                <div>
                    <label for="password" class="mb-2 block text-xs font-bold text-[#5A4032]">Password Baru</label>
                    <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password"
                           class="w-full rounded-full border border-slate-300 px-4 py-3 text-sm text-[#3B2115] outline-none focus:border-orange-500 focus:ring-2 focus:ring-[#FFD1AD]">
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-xs font-bold text-[#5A4032]">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password"
                           class="w-full rounded-full border border-slate-300 px-4 py-3 text-sm text-[#3B2115] outline-none focus:border-orange-500 focus:ring-2 focus:ring-[#FFD1AD]">
                </div>

                <button type="submit" class="h-11 w-full rounded-full bg-[#E95309] text-sm font-bold text-white shadow-sm transition hover:bg-[#C1440E] hover:shadow-md">
                    Simpan Password Baru
                </button>
            </form>
        </section>
    </main>
@endsection