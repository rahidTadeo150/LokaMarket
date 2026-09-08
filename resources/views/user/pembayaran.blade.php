@extends('layouts.customer')

@section('title', 'Checkout - LokaMarket')

@section('content')

@php
    $invoiceNumber = $invoiceNumber ?? 'INV-2026-10293';
    $totalPayment = $totalPayment ?? 38000;
    $bankAccount = $bankAccount ?? '8801 2345 6789';
    $bankName = $bankName ?? 'Bank BCA';
@endphp



    <main class="mx-auto max-w-6xl px-4 py-7 sm:px-8 sm:py-10">
        @include('components.checkout-progress', ['step' => 3])

        <div class="mx-auto w-full max-w-[760px]">
            <div class="mb-5">
                <h1 class="text-2xl font-extrabold tracking-tight text-[#3d281e] sm:text-3xl">Selesaikan Pembayaran</h1>
                <p class="mt-1 text-[11px] text-[#806e64] sm:text-xs">Pesananmu akan diproses setelah pembayaran diterima.</p>
            </div>

            <section class="overflow-hidden rounded-2xl border border-[#f0dfd1] bg-white shadow-[0_12px_35px_rgba(92,48,20,0.05)]">
                <div class="bg-[#df4d08] px-6 py-5 text-white sm:px-9 sm:py-6">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-clock text-lg"></i>
                        <div class="min-w-0 flex-1">
                            <p class="text-[9px] font-semibold uppercase">Menunggu pembayaran</p>
                            <p class="mt-0.5 text-sm font-extrabold sm:text-base">Selesaikan dalam <span id="paymentTimer">23:59:12</span></p>
                        </div>
                        <span class="rounded-full bg-[#ed681f] px-3 py-2 text-[9px] font-bold">#{{ $invoiceNumber }}</span>
                    </div>
                </div>

                <div class="px-6 py-6 sm:px-10 sm:py-8">
                    <div class="border-b border-[#f1e5dc] pb-5">
                        <div class="flex items-center justify-between">
                            <p class="text-[10px] font-semibold text-[#876f63]">Total Tagihan</p>
                            <button type="button" data-copy="{{ $totalPayment }}" class="copy-payment inline-flex items-center gap-2 rounded-full bg-[#fff8f2] px-3 py-2 text-[9px] font-bold text-[#d94f0b] transition hover:bg-[#fff0e4]">
                                <i class="fa-regular fa-copy"></i> Salin
                            </button>
                        </div>
                        <p class="mt-1 text-2xl font-extrabold text-[#3d2b22] sm:text-3xl">Rp {{ number_format($totalPayment, 0, ',', '.') }}</p>
                    </div>

                    <div class="border-b border-[#f1e5dc] py-5">
                        <p class="mb-3 text-[10px] font-semibold text-[#876f63]">Transfer ke Rekening</p>
                        <div class="flex items-center gap-4 rounded-xl bg-[#fff8f1] px-4 py-4">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#ff8a13] text-white"><i class="fa-solid fa-building-columns text-sm"></i></span>
                            <div class="min-w-0 flex-1 text-[11px]">
                                <p class="font-bold text-[#4b3429]">{{ $bankName }}</p>
                                <p class="text-base font-extrabold tracking-wide text-[#3d2b22]">{{ $bankAccount }}</p>
                                <p class="text-[9px] text-[#9c877c]">a.n. LokaMarket Indonesia</p>
                            </div>
                            <button type="button" data-copy="{{ $bankAccount }}" class="copy-payment inline-flex shrink-0 items-center gap-1.5 rounded-full border border-[#f0dfd1] bg-white px-3 py-2 text-[9px] font-bold text-[#d94f0b] transition hover:border-[#f28a28]">
                                <i class="fa-regular fa-copy"></i> Salin
                            </button>
                        </div>
                    </div>

                    <div class="border-b border-[#f1e5dc] py-5">
                        <p class="text-[11px] font-extrabold text-[#3d2b22]">Atau bayar dengan QRIS</p>
                        <div class="mx-auto mt-4 grid h-[150px] w-[150px] place-items-center border-[8px] border-[#f3f3f3] bg-white p-1 shadow-[inset_0_0_0_1px_#e6e6e6]">
                            <div class="qr-pattern h-full w-full"></div>
                        </div>
                        <p class="mt-3 text-center text-[9px] text-[#9c877c]">Scan dengan GoPay, OVO, DANA, atau m-banking</p>
                    </div>

                    <div class="border-b border-[#f1e5dc] py-5">
                        <p class="text-[11px] font-extrabold text-[#3d2b22]">Cara Pembayaran (m-Banking)</p>
                        <ol class="mt-3 space-y-1.5 text-[9px] leading-4 text-[#765f53]">
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">1</span><span>Buka aplikasi m-Banking BCA di HP kamu.</span></li>
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">2</span><span>Pilih menu Transfer &gt; ke Rekening BCA.</span></li>
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">3</span><span>Masukkan nomor rekening {{ $bankAccount }}.</span></li>
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">4</span><span>Masukkan nominal Rp {{ number_format($totalPayment, 0, ',', '.') }}, lalu konfirmasi.</span></li>
                        </ol>
                    </div>

                    <div class="pt-5">
                        <button type="button" onclick="alert('Konfirmasi pembayaran akan segera diproses.')" class="h-12 w-full rounded-full bg-[#e9520d] text-[11px] font-bold text-white shadow-sm transition hover:bg-[#cf4609]">Saya Sudah Bayar</button>
                        <a href="{{ route('cust.checkout') }}" class="mt-3 flex h-10 w-full items-center justify-center rounded-full border border-[#e9520d] text-[10px] font-bold text-[#d94f0b] transition hover:bg-[#fff6ef]">Batalkan Pesanan</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <style>
        .qr-pattern { background-color: #fff; background-image: linear-gradient(90deg, #222 14%, transparent 14%, transparent 28%, #222 28%, #222 42%, transparent 42%, transparent 57%, #222 57%, #222 74%, transparent 74%), linear-gradient(#222 14%, transparent 14%, transparent 28%, #222 28%, #222 42%, transparent 42%, transparent 57%, #222 57%, #222 74%, transparent 74%); background-size: 17px 17px; }
    </style>
    <script>
        document.querySelectorAll('.copy-payment').forEach((button) => {
            button.addEventListener('click', async () => {
                await navigator.clipboard.writeText(button.dataset.copy);
                const label = button.lastChild;
                if (label) label.textContent = ' Tersalin';
                setTimeout(() => { if (label) label.textContent = ' Salin'; }, 1500);
            });
        });
    </script>
@endsection
