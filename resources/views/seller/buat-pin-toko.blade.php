@extends('layouts.seller')

@section('title', 'Buat PIN Toko - LokaMarket')

@section('content')

<main class="min-h-screen bg-[#FFF9F4]">

    <div class="mx-auto flex min-h-[calc(100vh-80px)] max-w-2xl items-center px-5 py-10">

        <div class="w-full overflow-hidden rounded-3xl border border-[#F1DCC8] bg-white shadow-sm">

            <div class="relative overflow-hidden bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-6 py-8 text-white sm:px-8">

                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-10 -left-10 h-28 w-28 rounded-full bg-orange-300/20"></div>

                <div class="relative">

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 ring-1 ring-white/20 backdrop-blur-sm">
                        <i class="fa-solid fa-lock text-xl"></i>
                    </div>

                    <h1 class="mt-5 text-2xl font-bold">
                        Buat PIN Toko
                    </h1>

                    <p class="mt-2 max-w-md text-sm leading-6 text-orange-100">
                        Buat PIN keamanan untuk melindungi akses
                        ke dashboard dan fitur pengelolaan toko Anda.
                    </p>

                </div>

            </div>

            {{-- CONTENT --}}
            <div class="p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                        <div class="flex gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-red-700">
                                    Periksa kembali data
                                </p>

                                <ul class="mt-1 space-y-1 text-xs text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                    </div>
                @endif

                <div class="mb-6 rounded-2xl border border-orange-100 bg-[#FFF9F4] p-4">

                    <div class="flex gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-[#FF6B00]">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-[#3B2115]">
                                PIN 6 Digit
                            </p>

                            <p class="mt-1 text-xs leading-5 text-[#72594B]">
                                Gunakan PIN yang mudah Anda ingat,
                                tetapi sulit ditebak oleh orang lain.
                            </p>
                        </div>

                    </div>

                </div>

                <form id="pinForm"
                    action="{{ route('seller.storePin') }}"
                    method="POST">
                    
                    @csrf

                    <div>

                        <label for="pin"
                            class="mb-2 block text-sm font-semibold text-[#3B2115]">
                            PIN Toko
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                name="pin"
                                id="pin"
                                inputmode="numeric"
                                maxlength="6"
                                pattern="[0-9]{6}"
                                autocomplete="new-password"
                                placeholder="••••••"
                                class="w-full rounded-2xl border border-[#E9D7C9] bg-[#FFF9F4] px-4 py-3.5 pr-12 text-center text-xl font-bold tracking-[0.5em] text-[#3B2115] outline-none transition focus:border-[#FF6B00] focus:ring-2 focus:ring-orange-100">

                            <button type="button"
                                    data-password-toggle="pin"
                                    aria-label="Tampilkan PIN"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-[#A58C7D] hover:text-[#FF6B00]">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                        </div>

                        <p id="pin-error"
                        class="mt-1.5 hidden text-xs font-medium text-red-500"></p>

                    </div>


                    <div class="mt-5">

                        <label for="pin_confirmation"
                            class="mb-2 block text-sm font-semibold text-[#3B2115]">
                            Konfirmasi PIN
                        </label>

                        <div class="relative">

                            <input type="password"
                                name="pin_confirmation"
                                id="pin_confirmation"
                                inputmode="numeric"
                                maxlength="6"
                                pattern="[0-9]{6}"
                                autocomplete="new-password"
                                placeholder="••••••"
                                class="w-full rounded-2xl border border-[#E9D7C9] bg-[#FFF9F4] px-4 py-3.5 pr-12 text-center text-xl font-bold tracking-[0.5em] text-[#3B2115] outline-none transition focus:border-[#FF6B00] focus:ring-2 focus:ring-orange-100">

                            <button type="button"
                                    data-password-toggle="pin_confirmation"
                                    aria-label="Tampilkan PIN"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-[#A58C7D] hover:text-[#FF6B00]">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                        </div>

                        <p id="pin-confirmation-error"
                        class="mt-1.5 hidden text-xs font-medium text-red-500"></p>

                    </div>


                    <button type="submit"
                            id="submitPinBtn"
                            class="mt-7 flex w-full items-center justify-center gap-2 rounded-2xl bg-[#FF6B00] px-5 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#E85D00] active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50">
                        <i class="fa-solid fa-lock"></i>
                        Simpan PIN
                    </button>

                </form>

            </div>

        </div>

    </div>

</main>

@endsection