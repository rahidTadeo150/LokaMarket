@extends('layouts.customer')

@section('title', 'Keranjang - LokaMarket')

@section('content')

    <main class="mx-auto max-w-6xl px-4 py-7 sm:px-8 sm:py-10">

        
       {{-- Progress Keranjang → Checkout → Pembayaran --}}

       @include('components.checkout-progress', ['step' => 1])


        {{-- Isi utama keranjang --}}
        <div class="mx-auto max-w-[540px]">

            <div class="mb-4 flex items-end justify-between">

                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#3d281e] sm:text-3xl">
                        Keranjang Belanja
                    </h1>

                </div>

                <span id="productCount"
                    class="pb-1 text-[10px] text-[#917c70]">
                    3 produk
                </span>

            </div>


            {{-- Card keranjang --}}
            <section
                class="rounded-2xl border border-[#f0dfd1] bg-white px-5 py-4 shadow-[0_12px_35px_rgba(92,48,20,0.04)] sm:px-6">

                {{-- Pilih semua --}}
                <div class="flex items-center justify-between border-b border-[#f3e8e0] pb-3 text-[11px]">

                    <label class="flex cursor-pointer items-center gap-2 font-bold text-[#493329]">

                        <input
                            id="selectAll"
                            type="checkbox"
                            checked
                            class="cart-check accent-[#cb4b14]"
                        >

                        Pilih Semua

                    </label>

                    <button
                        id="removeSelected"
                        type="button"
                        class="text-[#9b8275] transition hover:text-[#d94d0b]"
                    >
                        Hapus Terpilih
                        <i class="fa-regular fa-trash-can ml-1"></i>
                    </button>

                </div>


                {{-- Produk dan toko --}}
                <div class="cart-shop border-b border-[#f3e8e0] py-3" data-shop="Warung Bu Sri">
                    <div class="mb-3 flex items-center gap-2 text-[11px] font-bold text-[#493329]">
                        <input type="checkbox" checked class="cart-check shop-check accent-[#cb4b14]">
                        <i class="fa-solid fa-store text-[#846f63]"></i>
                        <span>Warung Bu Sri</span>
                        <i class="fa-solid fa-circle-check text-[10px] text-[#558d58]"></i>
                    </div>

                    <div class="cart-item flex items-center gap-3 py-1.5" data-price="12000">
                        <input type="checkbox" checked class="cart-check item-check accent-[#cb4b14]">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-[#ee6d1d]">
                            <span class="text-xl">🍱</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[10px] font-bold text-[#4b3429]">Geprek Ori</p>
                            <p class="text-[9px] text-[#9c877c]">Porsi Sedang</p>
                            <p class="text-[10px] font-extrabold text-[#c9470e]">Rp 12.000</p>
                        </div>
                        <div class="quantity-control flex h-6 items-center overflow-hidden rounded-full border border-[#f0d6c4] text-[10px]" data-quantity="1">
                            <button type="button" class="quantity-minus w-7 text-[#b97b5d]">-</button>
                            <span class="quantity-value w-6 text-center font-bold">1</span>
                            <button type="button" class="quantity-plus w-7 text-[#c9470e]">+</button>
                        </div>
                        <button type="button" class="remove-item ml-1 text-[#a38e82] hover:text-[#d94d0b]" aria-label="Hapus Geprek Ori"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
                    </div>

                    <div class="cart-item flex items-center gap-3 py-1.5" data-price="8000">
                        <input type="checkbox" checked class="cart-check item-check accent-[#cb4b14]">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-[#f5eee8]"><span class="text-xl">🍲</span></div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[10px] font-bold text-[#4b3429]">Es pisang hijau</p>
                            <p class="text-[9px] text-[#9c877c]">250 gr</p>
                            <p class="text-[10px] font-extrabold text-[#c9470e]">Rp 8.000</p>
                        </div>
                        <div class="quantity-control flex h-6 items-center overflow-hidden rounded-full border border-[#f0d6c4] text-[10px]" data-quantity="1">
                            <button type="button" class="quantity-minus w-7 text-[#b97b5d]">-</button>
                            <span class="quantity-value w-6 text-center font-bold">1</span>
                            <button type="button" class="quantity-plus w-7 text-[#c9470e]">+</button>
                        </div>
                        <button type="button" class="remove-item ml-1 text-[#a38e82] hover:text-[#d94d0b]" aria-label="Hapus Es pisang hijau"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
                    </div>
                </div>

                <div class="cart-shop border-b border-[#f3e8e0] py-3" data-shop="Kerajinan Lokal">
                    <div class="mb-3 flex items-center gap-2 text-[11px] font-bold text-[#493329]">
                        <input type="checkbox" checked class="cart-check shop-check accent-[#cb4b14]">
                        <i class="fa-solid fa-store text-[#846f63]"></i>
                        <span>Kerajinan Lokal</span>
                        <i class="fa-solid fa-circle-check text-[10px] text-[#558d58]"></i>
                    </div>

                    <div class="cart-item flex items-center gap-3 py-1.5" data-price="45000">
                        <input type="checkbox" checked class="cart-check item-check accent-[#cb4b14]">
                        <div class="h-11 w-11 shrink-0 rounded-lg bg-[#4d804e]"></div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[10px] font-bold text-[#4b3429]">Tas Anyaman Bambu</p>
                            <p class="text-[9px] text-[#9c877c]">Warna Natural</p>
                            <p class="text-[10px] font-extrabold text-[#c9470e]">Rp 45.000</p>
                        </div>
                        <div class="quantity-control flex h-6 items-center overflow-hidden rounded-full border border-[#f0d6c4] text-[10px]" data-quantity="1">
                            <button type="button" class="quantity-minus w-7 text-[#b97b5d]">-</button>
                            <span class="quantity-value w-6 text-center font-bold">1</span>
                            <button type="button" class="quantity-plus w-7 text-[#c9470e]">+</button>
                        </div>
                        <button type="button" class="remove-item ml-1 text-[#a38e82] hover:text-[#d94d0b]" aria-label="Hapus Tas Anyaman Bambu"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
                    </div>
                </div>


                {{-- Ringkasan --}}
                <div class="pt-3">

                    <h2 class="text-[11px] font-extrabold">
                        Ringkasan Belanja
                    </h2>

                    <dl class="mt-2 space-y-1 text-[9px] text-[#78655b]">

                        <div class="flex justify-between">
                            <dt>Subtotal (3 produk)</dt>

                            <dd
                                id="subtotal"
                                class="font-bold text-[#4b3429]"
                            >
                                Rp 65.000
                            </dd>
                        </div>

                        <div class="flex justify-between">
                            <dt>Ongkos Kirim</dt>

                            <dd class="font-bold text-[#4b3429]">
                                Estimasi di checkout
                            </dd>
                        </div>

                        <div class="flex justify-between">
                            <dt>Diskon Voucher</dt>

                            <dd class="font-bold text-[#4b3429]">
                                -Rp 0
                            </dd>
                        </div>

                    </dl>


                    {{-- Voucher --}}
                    <div class="mt-3 flex items-center gap-2 rounded-lg bg-[#fff8f1] px-3 py-2">

                        <i class="fa-solid fa-ticket text-[10px] text-[#da5a17]"></i>

                        <input
                            id="voucher"
                            type="text"
                            placeholder="Masukkan kode voucher"
                            class="min-w-0 flex-1 bg-transparent text-[9px] outline-none placeholder:text-[#a99487]"
                        >

                        <button
                            type="button"
                            id="applyVoucher"
                            class="text-[9px] font-bold text-[#d34c10]"
                        >
                            Pakai
                        </button>

                    </div>


                    {{-- Total --}}
                    <div class="mt-3 flex items-center justify-between border-t border-[#f3e8e0] pt-3">

                        <span class="text-[11px] font-extrabold">
                            Total
                        </span>

                        <strong
                            id="total"
                            class="text-sm font-extrabold text-[#d94d0b]"
                        >
                            Rp 65.000
                        </strong>

                    </div>


                    {{-- Tombol checkout --}}
                    <a
                        href="{{ route('cust.checkout') }}"
                        id="checkoutButton"
                        class="mt-4 flex h-9 w-full items-center justify-center rounded-full bg-[#e9520d] text-[10px] font-bold text-white shadow-sm transition hover:bg-[#cf4609]"
                    >
                        Lanjut ke Checkout
                    </a>

                    <div class="mt-2 text-center text-[9px] text-[#a38e82]">
                        atau
                    </div>

                    <a
                        href="{{ route('cust.pilihanProduk') }}"
                        class="mt-1 block text-center text-[9px] font-bold text-[#d94d0b]"
                    >
                        Lanjutkan Belanja
                    </a>

                </div>

            </section>

        </div>

    </main>


    {{-- JavaScript --}}
    <script>

        const money = value =>
            'Rp ' + value.toLocaleString('id-ID');


        const allChecks = () => [
            ...document.querySelectorAll('.item-check')
        ];


        const updateSummary = () => {

            let subtotal = 0;

            allChecks().forEach(item => {

                if (item.checked) {

                    subtotal +=
                        Number(item.closest('.cart-item').dataset.price) *
                        Number(
                            item.closest('.cart-item')
                                .querySelector('.quantity-control')
                                .dataset.quantity
                        );

                }

            });


            document.querySelector('#subtotal').textContent =
                money(subtotal);

            document.querySelector('#total').textContent =
                money(subtotal);

            document.querySelector('#productCount').textContent =
                allChecks().filter(item => item.checked).length +
                ' produk';

            document.querySelector('#selectAll').checked =
                allChecks().length > 0 &&
                allChecks().every(item => item.checked);

        };


        // Pilih semua
        document.querySelector('#selectAll').addEventListener(
            'change',
            event => {

                document
                    .querySelectorAll('.cart-check')
                    .forEach(
                        check => check.checked = event.target.checked
                    );

                updateSummary();

            }
        );


        // Pilih produk berdasarkan toko
        document.querySelectorAll('.shop-check').forEach(shopCheck => {

            shopCheck.addEventListener('change', event => {

                event.target
                    .closest('.cart-shop')
                    .querySelectorAll('.item-check')
                    .forEach(
                        check => check.checked = event.target.checked
                    );

                updateSummary();

            });

        });


        // Checkbox produk
        document.querySelectorAll('.item-check').forEach(check => {

            check.addEventListener(
                'change',
                updateSummary
            );

        });


        // Quantity
        document.querySelectorAll('.quantity-control').forEach(control => {

            control.addEventListener('click', event => {

                const step =
                    event.target.closest('button');

                if (!step) return;


                let quantity =
                    Number(control.dataset.quantity) +
                    (
                        step.classList.contains('quantity-plus')
                            ? 1
                            : -1
                    );


                quantity = Math.max(1, quantity);


                control.dataset.quantity = quantity;


                control.querySelector(
                    '.quantity-value'
                ).textContent = quantity;


                updateSummary();

            });

        });


        // Hapus satu produk
        document.querySelectorAll('.remove-item').forEach(button => {

            button.addEventListener('click', () => {

                button.closest('.cart-item').remove();

                updateSummary();

            });

        });


        // Hapus produk terpilih
        document.querySelector('#removeSelected').addEventListener(
            'click',
            () => {

                document
                    .querySelectorAll('.item-check:checked')
                    .forEach(check => {

                        check.closest('.cart-item').remove();

                    });

                updateSummary();

            }
        );


        // Voucher
        document.querySelector('#applyVoucher').addEventListener(
            'click',
            event => {

                const input =
                    document.querySelector('#voucher');

                event.target.textContent =
                    input.value.trim()
                        ? 'Terpasang'
                        : 'Pakai';

            }
        );


        // Perhitungan awal
        updateSummary();

    </script>

@endsection