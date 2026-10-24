document.addEventListener('DOMContentLoaded', function () {

    // Mencegah event listener dipasang berulang
    if (window.wishlistHandlerInitialized) return;
    window.wishlistHandlerInitialized = true;

    let toastTimer = null;
    let toastRemoveTimer = null;

    function showWishlistToast(message, type = 'success') {
        // Hapus toast sebelumnya
        const oldToast = document.getElementById('wishlistToast');
        if (oldToast) oldToast.remove();

        clearTimeout(toastTimer);
        clearTimeout(toastRemoveTimer);

        const isError = type === 'error';

        const toast = document.createElement('div');
        toast.id = 'wishlistToast';
        toast.setAttribute('role', 'status');
        toast.setAttribute('aria-live', 'polite');

        toast.className =
            'fixed bottom-5 left-1/2 z-[200] ' +
            '-translate-x-1/2 translate-y-2 opacity-0 ' +
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

        // Tampilkan toast setelah masuk DOM
        requestAnimationFrame(function () {
            toast.classList.remove('translate-y-2', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        });

        toastTimer = setTimeout(function () {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-2', 'opacity-0');

            toastRemoveTimer = setTimeout(function () {
                toast.remove();
            }, 300);
        }, 2500);
    }

    function updateWishlistUI(button, isWishlisted) {
        const icon = button.querySelector('i');

        button.dataset.wishlisted = String(isWishlisted);
        button.setAttribute('aria-pressed', String(isWishlisted));

        button.setAttribute(
            'aria-label',
            isWishlisted
                ? 'Hapus dari wishlist'
                : 'Tambah ke wishlist'
        );

        button.classList.toggle('text-orange-500', isWishlisted);
        button.classList.toggle('text-[#DCCBC0]', !isWishlisted);

        if (icon) {
            icon.classList.toggle('fa-solid', isWishlisted);
            icon.classList.toggle('fa-regular', !isWishlisted);
        }
    }

    // Event delegation untuk semua komponen wishlist
    document.addEventListener('submit', async function (event) {
        const form = event.target.closest('.wishlist-form');

        if (!form) return;

        event.preventDefault();

        const button = form.querySelector('.wishlist-button');

        if (!button || button.disabled) return;

        const csrfToken = form.querySelector('input[name="_token"]')?.value;
        const previousState = button.dataset.wishlisted === 'true';

        button.disabled = true;
        button.classList.add('opacity-60');

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(
                    data.message || 'Wishlist gagal diperbarui.'
                );
            }

            updateWishlistUI(button, Boolean(data.wishlisted));

            showWishlistToast(
                data.message || (
                    data.wishlisted
                        ? 'Produk ditambahkan ke wishlist.'
                        : 'Produk dihapus dari wishlist.'
                ),
                'success'
            );

        } catch (error) {
            // Status sebelumnya dipertahankan saat request gagal
            updateWishlistUI(button, previousState);

            showWishlistToast(
                error.message || 'Terjadi kesalahan. Silakan coba lagi.',
                'error'
            );

            console.error('Wishlist error:', error);

        } finally {
            button.disabled = false;
            button.classList.remove('opacity-60');
        }
    });
});