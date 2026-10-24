@extends('layouts.auth-customer')

@section('title', 'Verifikasi PIN Toko - LokaMarket')

@section('content')
<main class="flex min-h-screen items-center justify-center bg-[#FFF9F2] px-10 py-10">
    <div class="w-full max-w-md rounded-3xl border border-[#F1DCC8] bg-white p-6 shadow-xl sm:p-8">
        <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-2xl text-orange-600">
            <i class="fa-solid fa-lock"></i>
        </div>

        <h1 class="text-2xl font-extrabold text-[#3B2115]">Masuk ke Toko</h1>
        <p class="mt-2 text-sm leading-6 text-[#72594B]">
            Masukkan PIN toko kamu untuk melanjutkan ke dashboard LokaMarket.
        </p>

        @if (session('success'))
            <div class="mt-5 rounded-xl bg-green-50 p-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="mt-5 rounded-xl bg-orange-50 p-3 text-sm text-orange-700">
                {{ session('info') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-5 rounded-xl bg-red-50 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('seller.verifyPin.submit') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="pin" class="mb-2 block text-sm font-semibold text-[#3B2115]">
                    PIN Toko
                </label>
                <input
                    id="pin"
                    name="pin"
                    type="password"
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    maxlength="6"
                    autocomplete="off"
                    autofocus
                    required
                    class="w-full rounded-xl border border-[#F1DCC8] px-4 py-3 text-center text-xl tracking-[0.5em] outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-100"
                    placeholder="••••••"
                >
            </div>

            <button type="submit"
                class="w-full rounded-xl bg-[#E85D04] px-5 py-3.5 font-bold text-white transition hover:bg-[#D94F00]">
                <i class="fa-solid fa-unlock-keyhole mr-2"></i>
                Verifikasi dan Masuk
            </button>

            <a href="{{ route('cust.landingPage') }}"
                class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-[#F1DCC8] bg-white px-5 py-3.5 text-sm font-semibold text-[#72594B] transition hover:border-orange-200 hover:bg-orange-50 hover:text-[#C1440E]">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Beranda
            </a>
            
        </form>
    </div>
</main>
@endsection