@extends('layouts.customer')

@section('title', 'Pembayaran - LokaMarket')

@section('content')

    <main class="min-h-screen bg-[#FFF9F4]">

        <section class="relative overflow-hidden">

            <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-orange-200/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -left-24 top-32 h-52 w-52 rounded-full bg-orange-100/40 blur-3xl"></div>

            <div class="relative mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

                <a href="{{ url()->previous() }}"
                    class="group mb-5 inline-flex items-center gap-2 text-sm font-medium text-[#72594B] transition hover:text-orange-500">

                    <i class="fa-solid fa-arrow-left text-xs transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Kembali ke Checkout

                </a>

                <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-orange-500 via-orange-500 to-[#D9490B] px-5 py-6 text-white shadow-lg shadow-orange-200/50 md:rounded-3xl">

                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-12 -left-8 h-28 w-28 rounded-full bg-orange-300/20"></div>
                    <div class="absolute right-16 top-8 h-20 w-20 rounded-full bg-white/10 blur-2xl"></div>

                    <div class="relative flex items-center justify-between gap-4">

                        <div class="flex items-center gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 shadow-inner ring-1 ring-white/20 backdrop-blur-sm">
                                <i class="fa-solid fa-credit-card text-xl text-white"></i>
                            </div>

                            <div>

                                <h2 class="mt-0.5 text-xl font-bold tracking-tight sm:text-2xl">
                                    Pembayaran
                                </h2>
                                <p class="mt-1 text-sm text-orange-100">
                                    Selesaikan pembayaran untuk memproses pesananmu.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================
            PAYMENT CONTENT
        ======================================== --}}
        <section class="mx-auto max-w-6xl px-4 pb-12 sm:px-6 lg:px-8">

            {{-- PAYMENT STATUS --}}
            <div class="mb-5 rounded-2xl border border-[#F1DCC8] bg-white p-4 shadow-sm sm:p-5">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#FFF1E5] text-[#FF6B00]">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                        <div>

                            <p class="text-sm font-bold text-[#3B2115]">
                                Menunggu Pembayaran
                            </p>

                            <p class="mt-0.5 text-xs text-[#A58C7D]">
                                Selesaikan pembayaran sebelum waktu habis.
                            </p>

                        </div>

                    </div>

                    <div class="rounded-xl bg-[#FFF7F0] px-4 py-2 text-center sm:text-right">

                        <p class="text-[10px] font-medium uppercase tracking-wide text-[#A58C7D]">
                            Batas Pembayaran
                        </p>

                        <p id="countdown" class="mt-0.5 text-sm font-bold text-[#D9490B]">
                            23:59:59
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 lg:grid-cols-[minmax(0,1fr)_320px]">

                {{-- ========================================
                    PAYMENT METHOD
                ======================================== --}}
                <div class="rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm sm:p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-[#3B2115]">
                            Pilih Metode Pembayaran
                        </h3>

                        <p class="mt-1 text-sm text-[#72594B]">
                            Pilih salah satu metode pembayaran yang tersedia.
                        </p>

                    </div>


                    {{-- VIRTUAL ACCOUNT --}}
                    <div class="mb-5">

                        <p class="mb-3 text-xs font-bold uppercase tracking-wide text-[#A58C7D]">
                            Virtual Account
                        </p>

                        <div class="space-y-2">

                            <label class="relative block cursor-pointer">

                                <input type="radio"
                                    name="payment_method"
                                    value="bca"
                                    class="payment-radio peer sr-only"
                                    checked>

                                <span class="flex items-center gap-3 rounded-xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF7F0]">

                                    <span class="flex h-10 w-14 shrink-0 items-center justify-center rounded-lg bg-[#F1F1F1] text-xs font-bold text-[#3B2115]">
                                        BCA
                                    </span>

                                    <span class="flex-1">

                                        <span class="block text-sm font-semibold text-[#3B2115]">
                                            BCA Virtual Account
                                        </span>

                                        <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                            Pembayaran melalui ATM, mobile banking, atau internet banking
                                        </span>

                                    </span>

                                    <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] text-transparent peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                        <i class="fa-solid fa-check text-[8px]"></i>
                                    </span>

                                </span>

                            </label>


                            <label class="relative block cursor-pointer">

                                <input type="radio"
                                    name="payment_method"
                                    value="bni"
                                    class="payment-radio peer sr-only">

                                <span class="flex items-center gap-3 rounded-xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF7F0]">

                                    <span class="flex h-10 w-14 shrink-0 items-center justify-center rounded-lg bg-[#F1F1F1] text-xs font-bold text-[#3B2115]">
                                        BNI
                                    </span>

                                    <span class="flex-1">

                                        <span class="block text-sm font-semibold text-[#3B2115]">
                                            BNI Virtual Account
                                        </span>

                                        <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                            Pembayaran melalui rekening BNI
                                        </span>

                                    </span>

                                    <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] text-transparent peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                        <i class="fa-solid fa-check text-[8px]"></i>
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- E-WALLET --}}
                    <div class="mb-5">

                        <p class="mb-3 text-xs font-bold uppercase tracking-wide text-[#A58C7D]">
                            E-Wallet & QR
                        </p>

                        <div class="space-y-2">

                            <label class="relative block cursor-pointer">

                                <input type="radio"
                                    name="payment_method"
                                    value="qris"
                                    class="payment-radio peer sr-only">

                                <span class="flex items-center gap-3 rounded-xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF7F0]">

                                    <span class="flex h-10 w-14 shrink-0 items-center justify-center rounded-lg bg-[#F1F1F1] text-xs font-bold text-[#3B2115]">
                                        QRIS
                                    </span>

                                    <span class="flex-1">

                                        <span class="block text-sm font-semibold text-[#3B2115]">
                                            QRIS
                                        </span>

                                        <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                            Scan menggunakan aplikasi pembayaran yang mendukung QRIS
                                        </span>

                                    </span>

                                    <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] text-transparent peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                        <i class="fa-solid fa-check text-[8px]"></i>
                                    </span>

                                </span>

                            </label>


                            <label class="relative block cursor-pointer">

                                <input type="radio"
                                    name="payment_method"
                                    value="gopay"
                                    class="payment-radio peer sr-only">

                                <span class="flex items-center gap-3 rounded-xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF7F0]">

                                    <span class="flex h-10 w-14 shrink-0 items-center justify-center rounded-lg bg-[#F1F1F1] text-xs font-bold text-[#3B2115]">
                                        GoPay
                                    </span>

                                    <span class="flex-1">

                                        <span class="block text-sm font-semibold text-[#3B2115]">
                                            GoPay
                                        </span>

                                        <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                            Bayar menggunakan saldo GoPay
                                        </span>

                                    </span>

                                    <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] text-transparent peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                        <i class="fa-solid fa-check text-[8px]"></i>
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- CARD --}}
                    <div>

                        <p class="mb-3 text-xs font-bold uppercase tracking-wide text-[#A58C7D]">
                            Kartu
                        </p>

                        <label class="relative block cursor-pointer">

                            <input type="radio"
                                name="payment_method"
                                value="card"
                                class="payment-radio peer sr-only">

                            <span class="flex items-center gap-3 rounded-xl border border-[#E9D7C9] bg-white p-4 transition-all peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF7F0]">

                                <span class="flex h-10 w-14 shrink-0 items-center justify-center rounded-lg bg-[#F1F1F1] text-[#3B2115]">
                                    <i class="fa-regular fa-credit-card"></i>
                                </span>

                                <span class="flex-1">

                                    <span class="block text-sm font-semibold text-[#3B2115]">
                                        Kartu Kredit / Debit
                                    </span>

                                    <span class="mt-0.5 block text-xs text-[#A58C7D]">
                                        Visa, Mastercard, dan kartu lainnya
                                    </span>

                                </span>

                                <span class="flex h-5 w-5 items-center justify-center rounded-full border border-[#E9D7C9] text-transparent peer-checked:border-[#FF6B00] peer-checked:bg-[#FF6B00] peer-checked:text-white">
                                    <i class="fa-solid fa-check text-[8px]"></i>
                                </span>

                            </span>

                        </label>

                    </div>

                </div>


                {{-- ========================================
                    ORDER SUMMARY
                ======================================== --}}
                <div>

                    <div class="sticky top-24 rounded-2xl border border-[#F1DCC8] bg-white p-5 shadow-sm">

                        <h3 class="text-lg font-bold text-[#3B2115]">
                            Detail Pembayaran
                        </h3>

                        <p class="mt-1 text-xs text-[#A58C7D]">
                            INV-LKM-20260910-001
                        </p>


                        <div class="my-5 border-t border-[#F1DCC8]"></div>


                        <div class="space-y-4">

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-[#72594B]">
                                    Subtotal
                                </span>

                                <span class="font-medium text-[#3B2115]">
                                    Rp35.000
                                </span>

                            </div>

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-[#72594B]">
                                    Ongkos Kirim
                                </span>

                                <span class="font-medium text-[#3B2115]">
                                    Rp10.000
                                </span>

                            </div>

                            <div class="border-t border-dashed border-[#E9D7C9] pt-4">

                                <div class="flex items-end justify-between gap-3">

                                    <span class="font-bold text-[#3B2115]">
                                        Total Pembayaran
                                    </span>

                                    <span class="text-xl font-bold text-[#FF6B00]">
                                        Rp45.000
                                    </span>

                                </div>

                            </div>

                        </div>


                        <button type="button"
                            id="payButton"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-[#D9490B] px-5 py-3.5 text-sm font-bold text-white shadow-md shadow-orange-200/50 transition hover:-translate-y-0.5 hover:shadow-lg">

                            <i class="fa-solid fa-lock text-xs"></i>

                            Bayar Rp45.000

                        </button>


                        <div class="mt-4 flex items-start gap-2 rounded-xl bg-[#FFF7F0] p-3">

                            <i class="fa-solid fa-shield-halved mt-0.5 text-xs text-[#FF6B00]"></i>

                            <p class="text-[11px] leading-5 text-[#A58C7D]">
                                Transaksi kamu dilindungi dan diproses melalui sistem pembayaran yang aman.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    {{-- ========================================
        PAYMENT MODAL / DUMMY MIDTRANS
    ======================================== --}}
    <div id="paymentModal"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#3B2115]/40 px-4 backdrop-blur-sm">

        <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

            <div class="bg-gradient-to-r from-orange-500 to-[#D9490B] px-5 py-5 text-white">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs text-orange-100">
                            LokaMarket
                        </p>

                        <h3 class="mt-1 text-lg font-bold">
                            Pembayaran
                        </h3>

                    </div>

                    <button type="button"
                        onclick="closePaymentModal()"
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white/15 transition hover:bg-white/25">

                        <i class="fa-solid fa-xmark text-sm"></i>

                    </button>

                </div>

            </div>


            <div class="p-5">

                <div class="rounded-2xl bg-[#FFF7F0] p-4 text-center">

                    <p class="text-xs text-[#A58C7D]">
                        Total Pembayaran
                    </p>

                    <p class="mt-1 text-2xl font-bold text-[#FF6B00]">
                        Rp45.000
                    </p>

                    <p class="mt-1 text-[11px] text-[#A58C7D]">
                        BCA Virtual Account
                    </p>

                </div>


                <div class="mt-5">

                    <p class="text-sm font-bold text-[#3B2115]">
                        Nomor Virtual Account
                    </p>

                    <div class="mt-2 flex items-center justify-between rounded-xl border border-[#E9D7C9] bg-white p-3">

                        <span class="text-lg font-bold tracking-wider text-[#3B2115]">
                            123456789012
                        </span>

                        <button type="button"
                            onclick="copyVA()"
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#FFF1E5] text-[#FF6B00]">

                            <i class="fa-regular fa-copy text-sm"></i>

                        </button>

                    </div>

                </div>


                <div class="mt-5 rounded-xl border border-[#F1DCC8] p-4">

                    <p class="text-xs font-bold text-[#3B2115]">
                        Cara Pembayaran
                    </p>

                    <ol class="mt-3 space-y-2 text-xs leading-5 text-[#72594B]">

                        <li>
                            1. Buka aplikasi mobile banking.
                        </li>

                        <li>
                            2. Pilih menu Transfer → Virtual Account.
                        </li>

                        <li>
                            3. Masukkan nomor Virtual Account.
                        </li>

                        <li>
                            4. Pastikan nominal pembayaran sesuai.
                        </li>

                        <li>
                            5. Konfirmasi pembayaran.
                        </li>

                    </ol>

                </div>


                <button type="button"
                    onclick="closePaymentModal()"
                    class="mt-5 w-full rounded-xl bg-[#FFF1E5] px-5 py-3 text-sm font-bold text-[#FF6B00] transition hover:bg-[#FFE5D2]">

                    Saya Mengerti

                </button>

            </div>

        </div>

    </div>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const payButton = document.getElementById('payButton');
            const paymentModal = document.getElementById('paymentModal');

            if (payButton) {

                payButton.addEventListener('click', function () {

                    paymentModal.classList.remove('hidden');
                    paymentModal.classList.add('flex');

                });

            }


            document.querySelectorAll('.payment-radio').forEach(function (radio) {

                radio.addEventListener('change', function () {

                    const selectedMethod = this.value;

                    const methodNames = {
                        bca: 'BCA Virtual Account',
                        bni: 'BNI Virtual Account',
                        qris: 'QRIS',
                        gopay: 'GoPay',
                        card: 'Kartu Kredit / Debit'
                    };

                    if (payButton && methodNames[selectedMethod]) {

                        payButton.innerHTML = `
                            <i class="fa-solid fa-lock text-xs"></i>
                            Bayar Rp45.000
                        `;

                    }

                });

            });

        });


        function closePaymentModal() {

            const paymentModal = document.getElementById('paymentModal');

            paymentModal.classList.add('hidden');
            paymentModal.classList.remove('flex');

        }


        function copyVA() {

            navigator.clipboard.writeText('123456789012');

            alert('Nomor Virtual Account berhasil disalin.');

        }


        let time = 24 * 60 * 60;

        const countdown = document.getElementById('countdown');

        const timer = setInterval(function () {

            const hours = Math.floor(time / 3600);
            const minutes = Math.floor((time % 3600) / 60);
            const seconds = time % 60;

            countdown.textContent =
                String(hours).padStart(2, '0') + ':' +
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0');

            time--;

            if (time < 0) {

                clearInterval(timer);

                countdown.textContent = 'Waktu habis';

            }

        }, 1000);

    </script>

@endsection
