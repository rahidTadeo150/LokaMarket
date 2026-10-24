@extends('layouts.auth-customer')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-[#FFF9F2] px-5 py-10">

        <div
            class="w-full max-w-md rounded-3xl border border-orange-100/70 bg-white p-6 text-center shadow-xl shadow-orange-900/5 sm:p-8">

            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-orange-100">
                <i class="fa-solid fa-envelope text-2xl text-orange-500"></i>
            </div>

            <h1 class="text-2xl font-black tracking-tight text-[#3B2115]">
                Verifikasi Email Anda
            </h1>

            <p class="mt-3 text-sm leading-6 text-[#72594B]">
                Kami telah mengirimkan link verifikasi ke email
                <span class="break-all font-bold text-[#3B2115]">
                    {{ $email }}
                </span>.
            </p>

            <p class="mt-2 text-sm leading-6 text-[#72594B]">
                Silakan buka kotak masuk email Anda dan klik link verifikasi
                untuk mengaktifkan akun LokaMarket.
            </p>

            <x-alert-session/>

            <div class="mt-6 rounded-2xl border border-orange-200 bg-[#FFF7ED] p-4 text-left">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                        <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <p class="text-sm font-extrabold text-[#3B2115]">
                            Email belum masuk?
                        </p>

                        <p class="mt-1 text-xs leading-5 text-[#72594B]">
                            Periksa folder Spam atau Junk pada email Anda. Terkadang email verifikasi masuk ke folder
                            tersebut.
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-2">

                            <span
                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-100 px-3 py-1.5 text-xs font-bold tracking-wider text-red-700 shadow-sm">
                                SPAM
                            </span>

                            <span class="text-xs font-semibold text-[#72594B]">
                                Jangan lupa diperiksa yaa!
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <form action="{{ route('verification.send') }}" method="POST" class="my-6" id="resendVerificationForm">

                @csrf

                <button type="submit" id="resendButton"
                    class="w-full rounded-xl bg-orange-500 px-5 py-3 font-bold text-white shadow-md shadow-orange-200/50 transition hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-70">

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

            <a href="{{ route('cust.login') }}"
                class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-[#72594B] transition hover:text-orange-500">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke halaman daftar
            </a>

            <p class="mt-6 border-t border-orange-50 pt-4 text-[11px] leading-5 text-[#A58E81]">
                Pastikan alamat email yang Anda masukkan sudah benar sebelum meminta pengiriman ulang.
            </p>

        </div>

    </div>
@endsection
