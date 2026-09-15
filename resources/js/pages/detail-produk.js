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
    const orderSubmitButton = document.getElementById('orderSubmitButton');
    const orderSubmitText = document.getElementById('orderSubmitText');
    const orderSubmitIcon = document.getElementById('orderSubmitIcon');

    const productId = orderSheet.dataset.productId;
    const productPrice = parseFloat(orderSheet.dataset.productPrice) || 0;
    const productStock = parseInt(orderSheet.dataset.productStock) || 0;

    let orderMode = 'cart';


    window.openOrderSheet = function (mode = 'cart') {

        if (productStock <= 0) {
            showOrderToast('Maaf, produk ini sedang habis.');
            return;
        }

        orderMode = mode;


        if (orderQuantity) {
            orderQuantity.value = 1;
        }


        updateOrderTotal();

        if (mode === 'buy') {

            if (orderSubmitText) {
                orderSubmitText.textContent = 'Beli Sekarang';
            }

            if (orderSubmitIcon) {
                orderSubmitIcon.className = 'fa-solid fa-bolt mr-2';
            }

        } else {

            if (orderSubmitText) {
                orderSubmitText.textContent = 'Tambah ke Keranjang';
            }

            if (orderSubmitIcon) {
                orderSubmitIcon.className = 'fa-solid fa-cart-shopping mr-2';
            }

        }

        orderSheet.classList.remove('invisible');

        orderSheet.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(function () {

            if (orderBackdrop) {
                orderBackdrop.classList.remove('opacity-0');
                orderBackdrop.classList.add('opacity-100');
            }

            if (orderPanel) {
                orderPanel.classList.remove('translate-y-full');
                orderPanel.classList.add('translate-y-0');
            }

        });

    };

    window.closeOrderSheet = function () {

        if (orderBackdrop) {
            orderBackdrop.classList.remove('opacity-100');
            orderBackdrop.classList.add('opacity-0');
        }

        if (orderPanel) {
            orderPanel.classList.remove('translate-y-0');
            orderPanel.classList.add('translate-y-full');
        }

        setTimeout(function () {
            orderSheet.classList.add('invisible');

            orderSheet.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove('overflow-hidden');
        }, 300);

    };

    window.orderIncreaseQuantity = function () {
        if (!orderQuantity) {
            return;
        }

        let quantity = parseInt(orderQuantity.value) || 1;

        if (quantity < productStock) {
            quantity++;
            orderQuantity.value = quantity;
            updateOrderTotal();
        }

    };

    window.orderDecreaseQuantity = function () {
        if (!orderQuantity) {
            return;
        }

        let quantity = parseInt(orderQuantity.value) || 1;

        if (quantity > 1) {
            quantity--;
            orderQuantity.value = quantity;
            updateOrderTotal();

        }

    };

    window.validateOrderQuantity = function () {

        if (!orderQuantity) {
            return;
        }

        let quantity = parseInt(orderQuantity.value);

        if (isNaN(quantity)) {
            quantity = 1;
        }

        if (quantity < 1) {
            quantity = 1;
        }

        if (quantity > productStock) {
            quantity = productStock;
        }

        orderQuantity.value = quantity;

        updateOrderTotal();
    };

    function updateOrderTotal() {
        if (!orderQuantity) {
            return;
        }

        const quantity = parseInt(orderQuantity.value) || 1;

        const total = productPrice * quantity;

        if (orderTotal) {
            orderTotal.textContent = 'Rp ' + formatRupiah(total);
        }

        if (orderSummary) {
            orderSummary.textContent = quantity + ' item';
        }

    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    window.submitOrder = function () {
        if (!orderQuantity) {
            return;
        }

        const quantity = parseInt(orderQuantity.value) || 1;

        if (quantity < 1) {
            showOrderToast('Jumlah pesanan tidak valid.');
            return;
        }

        if (quantity > productStock) {
            showOrderToast('Jumlah pesanan melebihi stok yang tersedia.');
            return;
        }

        if (orderMode === 'buy') {
            console.log({
                produk_id: productId,
                quantity: quantity
            });

            closeOrderSheet();

            showOrderToast('Pesanan siap untuk checkout.');

            return;
        }

        if (orderMode !== 'cart') {
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            showOrderToast('CSRF token tidak ditemukan.');
            return;
        }

        if (orderSubmitButton) {
            orderSubmitButton.disabled = true;

            orderSubmitButton.classList.add(
                'opacity-70',
                'cursor-not-allowed'
            );

        }

        if (orderSubmitText) {
            orderSubmitText.textContent = 'Menambahkan...';
        }

        fetch('/keranjang/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
                produk_id: productId,
                quantity: quantity
            })

        }).then(function (response) {

            return response.json().then(function (data) {

                if (!response.ok) {
                    throw new Error(
                        data.message ||
                        'Gagal menambahkan produk.'
                    );

                }

                return data;
            });

        }).then(function (data) {

            if (!data.success) {
                throw new Error(
                    data.message ||
                    'Gagal menambahkan produk.'
                );

            }

            closeOrderSheet();

            showOrderToast(data.message);

            const cartBadges = document.querySelectorAll('[data-cart-count]');

            cartBadges.forEach(function (badge) {
                badge.textContent = data.cart_count;
                });

        }).catch(function (error) {
            console.error('Tambah keranjang:', error);

            showOrderToast( error.message || 'Terjadi kesalahan.');

        }).finally(function () {

            if (orderSubmitButton) {
                orderSubmitButton.disabled = false;

                orderSubmitButton.classList.remove(
                    'opacity-70',
                    'cursor-not-allowed'
                );
            }

            if (orderSubmitText) {
                if (orderMode === 'cart') {
                    orderSubmitText.textContent = 'Tambah ke Keranjang';
                } else {
                    orderSubmitText.textContent = 'Beli Sekarang';
                }
            }

        });

    };

    function showOrderToast(message, type = 'success') {
        const oldToast = document.getElementById('orderToast');

        if (oldToast) {
            oldToast.remove();
        }

        let iconClass = 'fa-solid fa-check';
        let iconBackground = 'bg-green-500';

        if (type === 'error') {
            iconClass = 'fa-solid fa-xmark';
            iconBackground = 'bg-red-500';
        }

        const toast = document.createElement('div');

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
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full ${iconBackground}">
                <i class="${iconClass} text-xs"></i>
            </div>
            <span>${message}</span>
        `;

        document.body.appendChild(toast);

        setTimeout(function () {

            toast.classList.add('opacity-0', 'translate-y-2');

            setTimeout(function () {
                toast.remove();
            }, 300);

        }, 2500);
    }

    document.addEventListener('keydown', function (event) {
        
        if (event.key !== 'Escape') {
            return;
        }

        if (!orderSheet.classList.contains('invisible')) {
            closeOrderSheet();
        }

    });
});