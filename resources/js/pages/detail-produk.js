/*
|--------------------------------------------------------------------------
| ORDER BOTTOM SHEET
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    const orderSheet = document.getElementById('orderSheet');

    // Jangan jalankan script jika bottom sheet tidak ada
    if (!orderSheet) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const orderBackdrop = document.getElementById('orderBackdrop');
    const orderPanel = document.getElementById('orderPanel');
    const orderQuantity = document.getElementById('orderQuantity');
    const orderTotal = document.getElementById('orderTotal');
    const orderSummary = document.getElementById('orderSummary');

    const orderSubmitButton =
        document.getElementById('orderSubmitButton');

    const orderSubmitText =
        document.getElementById('orderSubmitText');

    const orderSubmitIcon =
        document.getElementById('orderSubmitIcon');


    /*
    |--------------------------------------------------------------------------
    | DATA PRODUK
    |--------------------------------------------------------------------------
    */

    const productId = orderSheet.dataset.productId;

    const productPrice =
        parseFloat(orderSheet.dataset.productPrice) || 0;

    const productStock =
        parseInt(orderSheet.dataset.productStock) || 0;


    /*
    |--------------------------------------------------------------------------
    | MODE PESANAN
    |--------------------------------------------------------------------------
    |
    | cart = Tambah ke Keranjang
    | buy  = Beli Sekarang
    |
    */

    let orderMode = 'cart';


    /*
    |--------------------------------------------------------------------------
    | OPEN ORDER SHEET
    |--------------------------------------------------------------------------
    */

    window.openOrderSheet = function (mode = 'cart') {

        // Cek stok
        if (productStock <= 0) {
            showOrderToast('Maaf, produk ini sedang habis.');
            return;
        }


        // Simpan mode
        orderMode = mode;


        // Reset jumlah menjadi 1
        if (orderQuantity) {
            orderQuantity.value = 1;
        }


        // Update total
        updateOrderTotal();


        /*
        |--------------------------------------------------------------------------
        | Ubah tombol berdasarkan mode
        |--------------------------------------------------------------------------
        */

        if (mode === 'buy') {

            if (orderSubmitText) {
                orderSubmitText.textContent = 'Beli Sekarang';
            }

            if (orderSubmitIcon) {
                orderSubmitIcon.className =
                    'fa-solid fa-bolt mr-2';
            }

        } else {

            if (orderSubmitText) {
                orderSubmitText.textContent =
                    'Tambah ke Keranjang';
            }

            if (orderSubmitIcon) {
                orderSubmitIcon.className =
                    'fa-solid fa-cart-shopping mr-2';
            }

        }


        /*
        |--------------------------------------------------------------------------
        | Tampilkan Bottom Sheet
        |--------------------------------------------------------------------------
        */

        orderSheet.classList.remove('invisible');

        orderSheet.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add('overflow-hidden');


        /*
        |--------------------------------------------------------------------------
        | Jalankan animasi
        |--------------------------------------------------------------------------
        */

        requestAnimationFrame(function () {

            if (orderBackdrop) {

                orderBackdrop.classList.remove(
                    'opacity-0'
                );

                orderBackdrop.classList.add(
                    'opacity-100'
                );
            }


            if (orderPanel) {

                orderPanel.classList.remove(
                    'translate-y-full'
                );

                orderPanel.classList.add(
                    'translate-y-0'
                );
            }

        });

    };


    /*
    |--------------------------------------------------------------------------
    | CLOSE ORDER SHEET
    |--------------------------------------------------------------------------
    */

    window.closeOrderSheet = function () {

        if (orderBackdrop) {

            orderBackdrop.classList.remove(
                'opacity-100'
            );

            orderBackdrop.classList.add(
                'opacity-0'
            );
        }


        if (orderPanel) {

            orderPanel.classList.remove(
                'translate-y-0'
            );

            orderPanel.classList.add(
                'translate-y-full'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Tunggu animasi selesai
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            orderSheet.classList.add(
                'invisible'
            );

            orderSheet.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove(
                'overflow-hidden'
            );

        }, 300);

    };


    /*
    |--------------------------------------------------------------------------
    | TAMBAH JUMLAH
    |--------------------------------------------------------------------------
    */

    window.orderIncreaseQuantity = function () {

        if (!orderQuantity) {
            return;
        }


        let quantity =
            parseInt(orderQuantity.value) || 1;


        if (quantity < productStock) {

            quantity++;

            orderQuantity.value = quantity;

            updateOrderTotal();

        }

    };


    /*
    |--------------------------------------------------------------------------
    | KURANGI JUMLAH
    |--------------------------------------------------------------------------
    */

    window.orderDecreaseQuantity = function () {

        if (!orderQuantity) {
            return;
        }


        let quantity =
            parseInt(orderQuantity.value) || 1;


        if (quantity > 1) {

            quantity--;

            orderQuantity.value = quantity;

            updateOrderTotal();

        }

    };


    /*
    |--------------------------------------------------------------------------
    | VALIDASI INPUT JUMLAH
    |--------------------------------------------------------------------------
    */

    window.validateOrderQuantity = function () {

        if (!orderQuantity) {
            return;
        }


        let quantity =
            parseInt(orderQuantity.value);


        /*
        | Jika input kosong / bukan angka
        */
        if (isNaN(quantity)) {

            quantity = 1;

        }


        /*
        | Minimal 1
        */
        if (quantity < 1) {

            quantity = 1;

        }


        /*
        | Tidak boleh melebihi stok
        */
        if (quantity > productStock) {

            quantity = productStock;

        }


        orderQuantity.value = quantity;

        updateOrderTotal();

    };


    /*
    |--------------------------------------------------------------------------
    | UPDATE TOTAL
    |--------------------------------------------------------------------------
    */

    function updateOrderTotal() {

        if (!orderQuantity) {
            return;
        }


        const quantity =
            parseInt(orderQuantity.value) || 1;


        const total =
            productPrice * quantity;


        /*
        | Format total harga
        */

        if (orderTotal) {

            orderTotal.textContent =
                'Rp ' + formatRupiah(total);

        }


        /*
        | Update jumlah item
        */

        if (orderSummary) {

            orderSummary.textContent =
                quantity + ' item';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

    function formatRupiah(number) {

        return new Intl.NumberFormat(
            'id-ID'
        ).format(number);

    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT ORDER
    |--------------------------------------------------------------------------
    */

    window.submitOrder = function () {

        if (!orderQuantity) {
            return;
        }


        const quantity =
            parseInt(orderQuantity.value) || 1;


        /*
        |--------------------------------------------------------------------------
        | Validasi jumlah
        |--------------------------------------------------------------------------
        */

        if (quantity < 1) {

            showOrderToast(
                'Jumlah pesanan tidak valid.'
            );

            return;

        }


        if (quantity > productStock) {

            showOrderToast(
                'Jumlah pesanan melebihi stok yang tersedia.'
            );

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | TAMBAH KE KERANJANG
        |--------------------------------------------------------------------------
        */

        if (orderMode === 'cart') {

            console.log(
                'Tambah ke keranjang:',
                {
                    produk_id: productId,
                    quantity: quantity
                }
            );


            closeOrderSheet();


            showOrderToast(
                'Produk berhasil ditambahkan ke keranjang.'
            );


            return;

        }


        /*
        |--------------------------------------------------------------------------
        | BELI SEKARANG
        |--------------------------------------------------------------------------
        */

        if (orderMode === 'buy') {

            console.log(
                'Beli sekarang:',
                {
                    produk_id: productId,
                    quantity: quantity
                }
            );


            closeOrderSheet();


            showOrderToast(
                'Pesanan siap untuk checkout.'
            );

        }

    };


    /*
    |--------------------------------------------------------------------------
    | TOAST
    |--------------------------------------------------------------------------
    */

    function showOrderToast(message) {

        /*
        | Hapus toast sebelumnya
        */

        const oldToast =
            document.getElementById('orderToast');


        if (oldToast) {
            oldToast.remove();
        }


        /*
        | Buat toast
        */

        const toast =
            document.createElement('div');


        toast.id = 'orderToast';


        toast.className =
            'fixed bottom-5 left-1/2 z-[200] ' +
            '-translate-x-1/2 ' +
            'flex items-center gap-3 ' +
            'rounded-2xl bg-[#3A2115] ' +
            'px-5 py-3 ' +
            'text-sm font-medium text-white ' +
            'shadow-2xl ' +
            'transition-all duration-300';


        toast.innerHTML = `
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-500">
                <i class="fa-solid fa-check text-xs"></i>
            </div>

            <span>${message}</span>
        `;


        document.body.appendChild(toast);


        /*
        |--------------------------------------------------------------------------
        | Hilangkan toast
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            toast.classList.add(
                'opacity-0',
                'translate-y-2'
            );


            setTimeout(function () {

                toast.remove();

            }, 300);

        }, 2500);

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            if (
                !orderSheet.classList.contains(
                    'invisible'
                )
            ) {

                closeOrderSheet();

            }

        }
    );


});