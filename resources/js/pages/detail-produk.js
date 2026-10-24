document.addEventListener('DOMContentLoaded', function () {

    const orderSheet = document.getElementById('orderSheet');

    if (orderSheet) {

        const orderBackdrop = document.getElementById('orderBackdrop');
        const orderPanel = document.getElementById('orderPanel');
        const orderQuantity = document.getElementById('orderQuantity');
        const orderTotal = document.getElementById('orderTotal');
        const orderSummary = document.getElementById('orderSummary');
        const orderSubmitButton = document.getElementById('orderSubmitButton');
        const orderSubmitText = document.getElementById('orderSubmitText');
        const orderSubmitIcon = document.getElementById('orderSubmitIcon');

        const productId = orderSheet.dataset.productId;
        const productPrice = Number(orderSheet.dataset.productPrice) || 0;
        const productStock = Number.parseInt(orderSheet.dataset.productStock, 10) || 0;

        let orderMode = 'cart';

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function updateOrderTotal() {

            if (!orderQuantity) return;

            let quantity = Number.parseInt(orderQuantity.value, 10);

            if (!Number.isFinite(quantity)) quantity = 1;

            quantity = Math.max(1, Math.min(quantity, productStock));
            orderQuantity.value = quantity;

            if (orderTotal) {
                orderTotal.textContent = 'Rp ' + formatRupiah(productPrice * quantity);
            }

            if (orderSummary) {
                orderSummary.textContent = quantity + ' item';
            }
        }

        window.openOrderSheet = function (mode = 'cart') {

            if (productStock <= 0) {
                showOrderToast('Maaf, produk ini sedang habis.', 'error');
                return;
            }

            orderMode = mode;

            if (orderQuantity) {
                orderQuantity.value = 1;
            }

            updateOrderTotal();

            if (orderSubmitText) {
                orderSubmitText.textContent = mode === 'buy' ? 'Beli Sekarang' : 'Tambah ke Keranjang';
            }

            if (orderSubmitIcon) {
                orderSubmitIcon.className = mode === 'buy' ? 'fa-solid fa-bolt mr-2' : 'fa-solid fa-cart-shopping mr-2';
            }

            orderSheet.classList.remove('invisible');
            orderSheet.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');

            requestAnimationFrame(function () {
                orderBackdrop?.classList.remove('opacity-0');
                orderBackdrop?.classList.add('opacity-100');

                orderPanel?.classList.remove('translate-y-full');
                orderPanel?.classList.add('translate-y-0');
            });
        };

        window.closeOrderSheet = function () {
            orderBackdrop?.classList.remove('opacity-100');
            orderBackdrop?.classList.add('opacity-0');

            orderPanel?.classList.remove('translate-y-0');
            orderPanel?.classList.add('translate-y-full');

            window.setTimeout(function () {
                orderSheet.classList.add('invisible');
                orderSheet.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        };

        window.orderIncreaseQuantity = function () {

            if (!orderQuantity || productStock <= 0) return;

            let quantity = Number.parseInt(orderQuantity.value, 10) || 1;

            if (quantity < productStock) {
                orderQuantity.value = quantity + 1;
                updateOrderTotal();
            }

        };

        window.orderDecreaseQuantity = function () {

            if (!orderQuantity) return;

            let quantity = Number.parseInt(orderQuantity.value, 10) || 1;

            if (quantity > 1) {
                orderQuantity.value = quantity - 1;
                updateOrderTotal();
            }

        };

        window.validateOrderQuantity = function () {

            if (!orderQuantity || productStock <= 0) return;

            let quantity = Number.parseInt(orderQuantity.value, 10);

            if (!Number.isFinite(quantity)) quantity = 1;

            quantity = Math.max(1, Math.min(quantity, productStock));
            orderQuantity.value = quantity;

            updateOrderTotal();

        };

        orderQuantity?.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });

        orderQuantity?.addEventListener('change', function () {
            window.validateOrderQuantity();
        });

        function setSubmitLoading(isLoading, message = '') {

            if (orderSubmitButton) {
                orderSubmitButton.disabled = isLoading;
                orderSubmitButton.classList.toggle('opacity-70', isLoading);
                orderSubmitButton.classList.toggle('cursor-not-allowed', isLoading);
            }

            if (orderSubmitText) {
                orderSubmitText.textContent = isLoading ? message : (orderMode === 'buy' ? 'Beli Sekarang' : 'Tambah ke Keranjang');
            }

        }

        async function postOrder(url, quantity, csrfToken) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    produk_id: productId,
                    quantity: quantity
                })
            });

            let data;

            try {
                data = await response.json();
            } catch {
                throw new Error('Respons server tidak valid');
            }

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Permintaan gagal diproses.');
            }

            return data;
        }

        window.submitOrder = async function () {
            if (!orderQuantity || !productId) {
                showOrderToast('Data produk tidak ditemukan.', 'error');
                return;
            }

            const quantity = Number.parseInt(orderQuantity.value, 10);

            if (!Number.isFinite(quantity) || quantity < 1) {
                showOrderToast('Jumlah pesanan tidak valid.', 'error');
                return;
            }

            if (productStock <= 0 || quantity > productStock) {
                showOrderToast('Jumlah pesanan melebihi stok yang tersedia.', 'error');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            if (!csrfToken) {
                showOrderToast('CSRF token tidak ditemukan.', 'error');
                return;
            }

            setSubmitLoading(true, 'Memproses...');

            try {

                if (orderMode === 'buy') {
                    const data = await postOrder(
                        '/checkout/beli-sekarang',
                        quantity,
                        csrfToken
                    );

                    if (!data.redirect_url) {
                        throw new Error('URL checkout tidak ditemukan pada respons server.');
                    }

                    window.location.href = data.redirect_url;
                    return;
                }

                if (orderMode !== 'cart') {
                    throw new Error('Mode pesanan tidak dikenal.');
                }

                const data = await postOrder(
                    '/keranjang/add-to-cart',
                    quantity,
                    csrfToken
                );

                window.closeOrderSheet();

                showOrderToast(data.message || 'Produk berhasil ditambahkan ke keranjang.');

                if (data.cart_count !== undefined) {
                    document.querySelectorAll('[data-cart-count]').forEach(function (badge) {
                        badge.textContent = data.cart_count;
                    });
                }

            } catch (error) {
                console.error('Proses pesanan:', error);

                showOrderToast(
                    error.message || 'Terjadi kesalahan. Silakan coba lagi.',
                    'error'
                );
            } finally {
                setSubmitLoading(false);
            }
        };

        orderBackdrop?.addEventListener('click', window.closeOrderSheet);

        document.querySelectorAll('[data-order-close]').forEach(function (button) {
            button.addEventListener('click', window.closeOrderSheet);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !orderSheet.classList.contains('invisible')) {
                window.closeOrderSheet();
            }
        });

        updateOrderTotal();
    }

    function showOrderToast(message, type = 'success') {

        const oldToast = document.getElementById('orderToast');

        oldToast?.remove();

        const isError = type === 'error';

        const toast = document.createElement('div');
        toast.id = 'orderToast';
        toast.className =
            'fixed bottom-5 left-1/2 z-[200] ' +
            '-translate-x-1/2 ' +
            'flex max-w-[calc(100%-2rem)] items-center gap-3 ' +
            'rounded-2xl bg-[#3A2115] px-5 py-3 ' +
            'text-sm font-medium text-white shadow-2xl ' +
            'transition-all duration-300';

        const iconWrapper = document.createElement('div');
        iconWrapper.className =
            'flex h-8 w-8 shrink-0 items-center justify-center rounded-full ' +
            (isError ? 'bg-red-500' : 'bg-green-500');

        const icon = document.createElement('i');
        icon.className = isError
            ? 'fa-solid fa-xmark text-xs'
            : 'fa-solid fa-check text-xs';

        iconWrapper.appendChild(icon);

        const text = document.createElement('span');
        text.textContent = message;

        toast.append(iconWrapper, text);
        document.body.appendChild(toast);

        window.setTimeout(function () {
            toast.classList.add('opacity-0', 'translate-y-2');

            window.setTimeout(function () {
                toast.remove();
            }, 300);
        }, 2500);
    }

    const mainProductImage = document.getElementById('mainProductImage');
    const thumbnails = document.querySelectorAll('[data-gallery-index]');
    const nextButton = document.querySelector('[data-gallery-next]');
    const previousButton = document.querySelector('[data-gallery-prev]');

    if (mainProductImage && thumbnails.length) {
        const productImages = Array.from(thumbnails)
            .map(function (thumbnail) {
                const image = thumbnail.querySelector('img');
                return image ? image.src : null;
            })
            .filter(Boolean);

        let currentImage = 0;

        function updateActiveThumbnail() {
            thumbnails.forEach(function (thumbnail, index) {
                thumbnail.classList.remove(
                    'border-orange-500',
                    'ring-1',
                    'ring-orange-500'
                );

                thumbnail.classList.add('border-transparent');

                if (index === currentImage) {
                    thumbnail.classList.remove('border-transparent');
                    thumbnail.classList.add(
                        'border-orange-500',
                        'ring-1',
                        'ring-orange-500'
                    );
                }
            });
        }

        function changeImage(index) {
            if (
                !productImages.length ||
                index < 0 ||
                index >= productImages.length
            ) {
                return;
            }

            currentImage = index;
            mainProductImage.src = productImages[currentImage];

            updateActiveThumbnail();
        }

        function nextImage() {
            if (!productImages.length) return;

            changeImage((currentImage + 1) % productImages.length);
        }

        function previousImage() {
            if (!productImages.length) return;

            changeImage(
                (currentImage - 1 + productImages.length) % productImages.length
            );
        }

        thumbnails.forEach(function (thumbnail) {
            thumbnail.addEventListener('click', function () {
                const index = Number(thumbnail.dataset.galleryIndex);
                changeImage(index);
            });
        });

        nextButton?.addEventListener('click', nextImage);
        previousButton?.addEventListener('click', previousImage);

        changeImage(0);
    }
});