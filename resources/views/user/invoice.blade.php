<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Invoice #INV-2026-10293 - LokaMarket</title>
</head>
<body class="min-h-screen bg-[#f4f4f3] text-[#3d2b22]">
    <header class="border-b border-[#f1dfcf] bg-white print:hidden">
        <div class="mx-auto flex max-w-5xl items-center justify-between gap-4 px-4 py-4 sm:px-8">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#5b463c] transition hover:text-[#d94f0b] sm:text-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Pesanan</span>
            </a>
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 rounded-full border border-[#f1dfcf] bg-white px-3 py-2 text-[11px] font-bold text-[#7a665b] transition hover:border-[#f28a28] hover:text-[#d94f0b] sm:px-4 sm:text-xs">
                    <i class="fa-solid fa-download"></i>
                    <span>Unduh PDF</span>
                </button>
                <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 rounded-full bg-[#f8790a] px-3 py-2 text-[11px] font-bold text-white shadow-sm transition hover:bg-[#db5b05] sm:px-5 sm:text-xs">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak Invoice</span>
                </button>
            </div>
        </div>
    </header>

    <main class="px-3 py-6 sm:px-6 sm:py-8 lg:px-8 lg:py-10">
        <article class="mx-auto max-w-4xl rounded-2xl border border-[#f1dfcf] bg-white px-5 py-6 shadow-sm sm:px-9 sm:py-8 lg:px-10 lg:py-9">
            <div class="flex flex-col gap-6 border-b border-[#f1e5dc] pb-6 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="h-11 w-auto object-contain sm:h-14">
                </div>
                <div class="sm:text-right">
                    <h1 class="text-2xl font-black tracking-tight text-[#3d2b22] sm:text-3xl">INVOICE</h1>
                    <p class="mt-1 text-xs font-medium text-[#9a887d]">#INV-2026-10293</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 py-6 text-xs sm:grid-cols-2 sm:gap-10">
                <section>
                    <p class="text-[9px] font-bold uppercase tracking-wide text-[#9a887d]">Ditagihkan kepada</p>
                    <h2 class="mt-2 text-sm font-black text-[#3d2b22]">Rina Amelia</h2>
                    <p class="mt-1 max-w-xs leading-5 text-[#74645b]">Jl. Merdeka No. 12, RT 03/RW 05,<br>Banyuwangi, Jawa Timur, 68414<br>0812-3456-7890</p>
                </section>
                <section class="sm:text-right">
                    <p class="text-[9px] font-bold uppercase tracking-wide text-[#9a887d]">Informasi pesanan</p>
                    <dl class="mt-2 space-y-1 text-[#74645b] sm:ml-auto sm:max-w-xs">
                        <div class="flex justify-between gap-5"><dt>Tanggal Pesanan</dt><dd class="font-bold text-[#3d2b22]">1 September 2026</dd></div>
                        <div class="flex justify-between gap-5"><dt>Metode Pembayaran</dt><dd class="font-bold text-[#3d2b22]">Transfer Bank (BCA)</dd></div>
                        <div class="flex justify-between gap-5"><dt>Metode Pengiriman</dt><dd class="font-bold text-[#3d2b22]">Reguler (2-3 hari)</dd></div>
                        <div class="flex justify-between gap-5"><dt>No. Resi</dt><dd class="font-bold text-[#3d2b22]">JNE-82813765402</dd></div>
                    </dl>
                </section>
            </div>

            <div class="mb-6 flex items-center gap-3 rounded-xl bg-[#fff7ed] px-4 py-3 text-xs">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-[#e96312] shadow-sm"><i class="fa-solid fa-store"></i></div>
                <div>
                    <p class="font-bold text-[#4a3429]">Dikirim oleh Geprek WW</p>
                    <p class="text-[10px] text-[#9a887d]">Banyuwangi, Jawa Timur</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[560px] border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-[#eadfd7] text-left text-[9px] font-bold uppercase tracking-wide text-[#9a887d]">
                            <th class="pb-3 pr-4">Produk</th>
                            <th class="w-32 pb-3 px-3">Harga Satuan</th>
                            <th class="w-16 pb-3 px-3 text-center">Jumlah</th>
                            <th class="w-28 pb-3 pl-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#66554c]">
                        <tr class="border-b border-[#f1e8e2]"><td class="py-4 pr-4 font-bold text-[#3d2b22]">Nasi Pecel Bu Sri</td><td class="px-3 py-4">Rp 12.000</td><td class="px-3 py-4 text-center">2</td><td class="py-4 pl-3 text-right font-bold text-[#3d2b22]">Rp 24.000</td></tr>
                        <tr class="border-b border-[#f1e8e2]"><td class="py-4 pr-4 font-bold text-[#3d2b22]">Kopi Tubruk Original</td><td class="px-3 py-4">Rp 8.000</td><td class="px-3 py-4 text-center">1</td><td class="py-4 pl-3 text-right font-bold text-[#3d2b22]">Rp 8.000</td></tr>
                        <tr class="border-b border-[#f1e8e2]"><td class="py-4 pr-4 font-bold text-[#3d2b22]">Tas Anyaman Bambu</td><td class="px-3 py-4">Rp 45.000</td><td class="px-3 py-4 text-center">1</td><td class="py-4 pl-3 text-right font-bold text-[#3d2b22]">Rp 45.000</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end border-b border-[#f1e5dc] pb-6">
                <dl class="w-full max-w-xs space-y-2 text-xs text-[#74645b]">
                    <div class="flex justify-between gap-5"><dt>Subtotal Produk</dt><dd class="font-bold text-[#3d2b22]">Rp 77.000</dd></div>
                    <div class="flex justify-between gap-5"><dt>Ongkos Kirim</dt><dd class="font-bold text-[#3d2b22]">Rp 10.000</dd></div>
                    <div class="flex justify-between gap-5"><dt>Biaya Layanan</dt><dd class="font-bold text-[#3d2b22]">Rp 1.000</dd></div>
                    <div class="flex justify-between gap-5"><dt>Diskon Voucher</dt><dd class="font-bold text-[#3d2b22]">-Rp 5.000</dd></div>
                    <div class="mt-4 flex items-center justify-between gap-5 border-t border-[#f1e5dc] pt-4 text-sm font-black text-[#4a3429]"><dt>Total Dibayar</dt><dd class="text-lg text-[#d94f0b]">Rp 83.000</dd></div>
                </dl>
            </div>

            <footer class="pt-5 text-xs">
                <p class="font-bold text-[#4a3429]">Terima kasih telah berbelanja di LokaMarket!</p>
                <p class="mt-1 leading-5 text-[#aa998e]">Invoice ini dibuat otomatis oleh sistem dan sah tanpa tanda tangan.<br>Ada pertanyaan? Hubungi support@lokamarket.id</p>
            </footer>
        </article>
    </main>

    <style>
        @media print {
            @page { margin: 12mm; }
            body { background: #fff; }
            article { border: 0; box-shadow: none; max-width: none; }
            main { padding: 0; }
        }
    </style>
</body>
</html>
