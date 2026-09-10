@extends('layouts.auth-customer')

@section('content')

<div class="min-h-screen bg-[#FFF9F2] flex items-center justify-center px-5">

    <div class="w-full max-w-md rounded-3xl bg-white p-8 text-center shadow-xl">

        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-orange-100">
            <i class="fa-solid fa-envelope text-2xl text-orange-500"></i>
        </div>

        <h1 class="text-2xl font-black text-[#3B2115]">
            Verifikasi Email Anda
        </h1>

        <p class="mt-3 text-sm leading-6 text-[#72594B]">
            Kami telah mengirimkan link verifikasi ke email
            <span class="font-bold text-[#3B2115]">
                {{ $email }}
            </span>.
        </p>

        <p class="mt-2 text-sm text-[#72594B]">
            Silakan buka email tersebut dan klik tombol verifikasi
            untuk mengaktifkan akun LokaMarket Anda.
        </p>

        @if (session('success'))
            <div class="mt-5 rounded-xl bg-green-50 px-4 py-3 text-sm text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('verification.send') }}"
            method="POST"
            class="my-6"
            id="resendVerificationForm"
        >
            @csrf

            <button type="submit"
                    id="resendButton"
                    class="w-full rounded-xl bg-orange-500 px-5 py-3 font-bold text-white transition hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-70"
            >
                <span id="resendButtonContent" class="flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Kirim Ulang Email</span>
                </span>

                <span id="resendLoading" class="hidden items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                    <span>Mengirim...</span>
                </span>

            </button>
            
        </form>

        <a href="{{ route('cust.register') }}">
            @csrf
            <button
                type="submit"
                class="text-sm font-semibold text-[#72594B] hover:text-orange-500">
                Keluar
            </button>
        </a>

    </div>

</div>
@endsection
