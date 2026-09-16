document.addEventListener('DOMContentLoaded', function () {
    const clearCartButton = document.getElementById('clearCartButton');
    const clearCartModal = document.getElementById('clearCartModal');
    const clearCartContent = document.getElementById('clearCartContent');
    const cancelClearCart = document.getElementById('cancelClearCart');
    const confirmClearCart = document.getElementById('confirmClearCart');

    if (!clearCartButton || !clearCartModal || !clearCartContent) {
        return;
    }

    window.openClearCartAlert = function () {
        clearCartModal.classList.remove('hidden');
        clearCartModal.classList.add('flex');

        setTimeout(function () {
            clearCartContent.classList.remove( 'scale-95', 'opacity-0');
            clearCartContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    };

    window.closeClearCartAlert = function () {
        clearCartContent.classList.remove('scale-100', 'opacity-100');
        clearCartContent.classList.add('scale-95', 'opacity-0');

        setTimeout(function () {
            clearCartModal.classList.remove('flex');
            clearCartModal.classList.add('hidden');
        }, 300);
    };


    clearCartButton.addEventListener('click', function () {
        window.openClearCartAlert();
    });

    cancelClearCart.addEventListener('click', function () {
        window.closeClearCartAlert();
    });

    clearCartModal.addEventListener('click', function (event) {
        if (event.target === clearCartModal) {
            window.closeClearCartAlert();
        }
    });

    confirmClearCart.addEventListener('click', function () {
        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');

        if (!csrfTokenElement) {
            console.error('CSRF token tidak ditemukan.');
            return;
        }

        const csrfToken = csrfTokenElement.getAttribute('content');

        confirmClearCart.disabled = true;

        confirmClearCart.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            Menghapus...
        `;

        fetch('/keranjang/clear-all', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        }).then(function (response) {

            return response.json();

        }).then(function (data) {
            if (!data.success) {
                showOrderToast(data.message || 'Gagal mengosongkan keranjang.', 'error');

                confirmClearCart.disabled = false;
                confirmClearCart.innerHTML = 'Ya, Kosongkan';

                return;
            }

            const cartBadges = document.querySelectorAll('[data-cart-count]');

            cartBadges.forEach(function (badge) {
                badge.textContent = '0';
                badge.classList.add('hidden');
            });

            window.closeClearCartAlert();

            showOrderToast(data.message || 'Keranjang berhasil dikosongkan.', 'success');

            setTimeout(function () {
                window.location.reload();
            }, 500);
        }).catch(function (error) {
            console.error('Error mengosongkan keranjang:', error);

            showOrderToast('Terjadi kesalahan saat mengosongkan keranjang.', 'error');

            confirmClearCart.disabled = false;
            confirmClearCart.innerHTML = 'Ya, Kosongkan';
        });

    });

    window.removeItem = function (detailId) {

        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');

        if (!csrfTokenElement) {
            console.error('CSRF token tidak ditemukan.');
            return;
        }

        const csrfToken = csrfTokenElement.getAttribute('content');

        fetch(`/keranjang/${detailId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }

        }).then(function (response) {

            return response.json();

        }).then(function (data) {
                if (!data.success) {
                    showOrderToast(data.message ||'Gagal menghapus produk.', 'error');
                    return;
                }

                const cartBadges = document.querySelectorAll('[data-cart-count]');

                cartBadges.forEach(function (badge) {
                    
                    if (data.cart_count > 0) {
                        badge.textContent = data.cart_count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.textContent = '0';
                        badge.classList.add('hidden');
                    }

                });

                showOrderToast(data.message || 'Produk berhasil dihapus dari keranjang.', 'success');

                setTimeout(function () {
                    window.location.reload();
                }, 500);

            }).catch(function (error) {
                console.error('Error menghapus produk:', error);
                showOrderToast('Terjadi kesalahan saat menghapus produk.', 'error');
            });

    };

    window.showOrderToast = function (message, type = 'success') {
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
            '-translate-x-1/2 flex items-center gap-3 ' +
            'rounded-2xl bg-[#3A2115] px-5 py-3 ' +
            'text-sm font-medium text-white shadow-2xl ' +
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
});