@php
    $invoiceNumber = $invoiceNumber ?? 'INV-2026-10293';
    $totalPayment = $totalPayment ?? 38000;
    $bankAccount = $bankAccount ?? '8801 2345 6789';
    $bankName = $bankName ?? 'Bank BCA';
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Pembayaran - LokaMarket</title>
</head>
<body class="min-h-screen bg-[#f4f4f3] text-[#3d2b22]">
    <header class="border-b border-[#f0e4da] bg-white">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5 sm:h-[76px] sm:px-8">
            <a href="{{ route('cust.landingPage') }}" class="inline-flex items-center">
                <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="h-9 w-auto sm:h-10">
            </a>
            <a href="{{ route('cust.caraKerja') }}" class="text-[10px] font-medium text-[#765f53] transition hover:text-[#d94f0b] sm:text-xs">
                Butuh bantuan?
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-7 sm:px-8 sm:py-10">
        @include('components.checkout-progress', ['step' => 3])

        <div class="mx-auto w-full max-w-[510px]">
            <div class="mb-5">
                <h1 class="text-xl font-extrabold tracking-tight text-[#3d281e] sm:text-2xl">Selesaikan Pembayaran</h1>
                <p class="mt-1 text-[10px] text-[#806e64] sm:text-[11px]">Pesananmu akan diproses setelah pembayaran diterima.</p>
            </div>

            <section class="overflow-hidden rounded-2xl border border-[#f0dfd1] bg-white shadow-[0_12px_35px_rgba(92,48,20,0.05)]">
                <div class="bg-[#df4d08] px-5 py-4 text-white sm:px-7 sm:py-5">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-clock text-base"></i>
                        <div class="min-w-0 flex-1">
                            <p class="text-[8px] font-semibold uppercase">Menunggu pembayaran</p>
                            <p class="mt-0.5 text-xs font-extrabold sm:text-sm">Selesaikan dalam <span id="paymentTimer">23:59:12</span></p>
                        </div>
                        <span class="rounded-full bg-[#ed681f] px-3 py-1.5 text-[8px] font-bold">#{{ $invoiceNumber }}</span>
                    </div>
                </div>

                <div class="px-5 py-5 sm:px-7 sm:py-6">
                    <div class="border-b border-[#f1e5dc] pb-4">
                        <div class="flex items-center justify-between">
                            <p class="text-[9px] font-semibold text-[#876f63]">Total Tagihan</p>
                            <button type="button" data-copy="{{ $totalPayment }}" class="copy-payment inline-flex items-center gap-2 rounded-full bg-[#fff8f2] px-3 py-1.5 text-[8px] font-bold text-[#d94f0b] transition hover:bg-[#fff0e4]">
                                <i class="fa-regular fa-copy"></i> Salin
                            </button>
                        </div>
                        <p class="mt-1 text-xl font-extrabold text-[#3d2b22]">Rp {{ number_format($totalPayment, 0, ',', '.') }}</p>
                    </div>

                    <div class="border-b border-[#f1e5dc] py-4">
                        <p class="mb-2 text-[9px] font-semibold text-[#876f63]">Transfer ke Rekening</p>
                        <div class="flex items-center gap-3 rounded-xl bg-[#fff8f1] px-3 py-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#ff8a13] text-white"><i class="fa-solid fa-building-columns text-xs"></i></span>
                            <div class="min-w-0 flex-1 text-[10px]">
                                <p class="font-bold text-[#4b3429]">{{ $bankName }}</p>
                                <p class="font-extrabold tracking-wide text-[#3d2b22]">{{ $bankAccount }}</p>
                                <p class="text-[8px] text-[#9c877c]">a.n. LokaMarket Indonesia</p>
                            </div>
                            <button type="button" data-copy="{{ $bankAccount }}" class="copy-payment inline-flex shrink-0 items-center gap-1.5 rounded-full border border-[#f0dfd1] bg-white px-2.5 py-1.5 text-[8px] font-bold text-[#d94f0b] transition hover:border-[#f28a28]">
                                <i class="fa-regular fa-copy"></i> Salin
                            </button>
                        </div>
                    </div>

                    <div class="border-b border-[#f1e5dc] py-4">
                        <p class="text-[10px] font-extrabold text-[#3d2b22]">Atau bayar dengan QRIS</p>
                        <div class="mx-auto mt-3 grid h-[112px] w-[112px] place-items-center border-[7px] border-[#f3f3f3] bg-white p-1 shadow-[inset_0_0_0_1px_#e6e6e6]">
                            <div class="qr-pattern h-full w-full"></div>
                        </div>
                        <p class="mt-2 text-center text-[8px] text-[#9c877c]">Scan dengan GoPay, OVO, DANA, atau m-banking</p>
                    </div>

                    <div class="border-b border-[#f1e5dc] py-4">
                        <p class="text-[10px] font-extrabold text-[#3d2b22]">Cara Pembayaran (m-Banking)</p>
                        <ol class="mt-2 space-y-1 text-[8px] leading-3.5 text-[#765f53]">
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">1</span><span>Buka aplikasi m-Banking BCA di HP kamu.</span></li>
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">2</span><span>Pilih menu Transfer &gt; ke Rekening BCA.</span></li>
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">3</span><span>Masukkan nomor rekening {{ $bankAccount }}.</span></li>
                            <li class="flex gap-2"><span class="font-bold text-[#e9520d]">4</span><span>Masukkan nominal Rp {{ number_format($totalPayment, 0, ',', '.') }}, lalu konfirmasi.</span></li>
                        </ol>
                    </div>

                    <div class="pt-4">
                        <button type="button" onclick="alert('Konfirmasi pembayaran akan segera diproses.')" class="h-10 w-full rounded-full bg-[#e9520d] text-[10px] font-bold text-white shadow-sm transition hover:bg-[#cf4609]">Saya Sudah Bayar</button>
                        <a href="{{ route('cust.checkout') }}" class="mt-2 flex h-8 w-full items-center justify-center rounded-full border border-[#e9520d] text-[9px] font-bold text-[#d94f0b] transition hover:bg-[#fff6ef]">Batalkan Pesanan</a>
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
</body>
</html>