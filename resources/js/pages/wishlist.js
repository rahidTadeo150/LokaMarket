document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAllWishlist');
    const deleteButton = document.getElementById('deleteSelectedWishlist');
    const selectedCount = document.getElementById('selectedWishlistCount');
    const deleteForm = document.getElementById('deleteWishlistForm');
    const selectedInputs = document.getElementById('selectedWishlistInputs');

    const modal = document.getElementById('customConfirmModal');
    const box = document.getElementById('customConfirmBox');
    const icon = document.getElementById('customConfirmIcon');
    const iconElement = document.getElementById('customConfirmIconElement');
    const title = document.getElementById('customConfirmTitle');
    const message = document.getElementById('customConfirmMessage');
    const cancelButton = document.getElementById('customConfirmCancel');
    const actionButton = document.getElementById('customConfirmAction');
    const backdrop = document.getElementById('customConfirmBackdrop');

    const getCheckboxes = () => Array.from(document.querySelectorAll('.wishlist-checkbox'));

    let selectedWishlistIds = [];
    let isSubmitting = false;

    const themes = {
        red: {
            iconBg: 'bg-red-100',
            iconColor: 'text-red-500',
            button: 'bg-red-500',
            hover: 'hover:bg-red-600',
            shadow: 'shadow-red-500/20'
        },
        orange: {
            iconBg: 'bg-orange-100',
            iconColor: 'text-orange-500',
            button: 'bg-orange-500',
            hover: 'hover:bg-orange-600',
            shadow: 'shadow-orange-500/20'
        }
    };

    function updateSelection() {

        const checkboxes = getCheckboxes();
        const checked = checkboxes.filter(item => item.checked);

        if (selectAll) {
            selectAll.checked =
                checkboxes.length > 0 &&
                checked.length === checkboxes.length;

            selectAll.indeterminate =
                checked.length > 0 &&
                checked.length < checkboxes.length;
        }

        if (deleteButton) {
            deleteButton.disabled = checked.length === 0;
        }

        if (selectedCount) {
            selectedCount.textContent = `(${checked.length})`;
        }
        
    }

    function openDeleteModal(count) {

        if (!modal || !box || !icon || !iconElement || !title || !message || !cancelButton || !actionButton || !backdrop) {
            console.error('Elemen custom confirmation modal tidak lengkap.');
            return;
        }

        const theme = themes.red;

        title.textContent = 'Hapus Produk Wishlist?';
        message.textContent = `Apakah kamu yakin ingin menghapus ${count} produk terpilih dari wishlist?`;
        icon.className = `mx-auto flex h-16 w-16 items-center justify-center rounded-2xl ${theme.iconBg} ${theme.iconColor}`;
        iconElement.className = 'fa-solid fa-trash-can text-2xl';
        actionButton.className = `flex-1 rounded-xl px-4 py-3 text-xs font-bold text-white shadow-lg transition ${theme.button} ${theme.hover} ${theme.shadow}`;
        actionButton.textContent = 'Ya, Hapus';
        actionButton.disabled = false;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        });

    }

    function closeDeleteModal() {

        if (!modal || !box) return;

        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');

        }, 200);

    }

    selectAll?.addEventListener('change', function () {
        
        getCheckboxes().forEach(checkbox => {
            checkbox.checked = this.checked;
        });

        updateSelection();

    });

    document.addEventListener('change', function (event) {
        if (event.target.matches('.wishlist-checkbox')) {
            updateSelection();
        }
    });

    deleteButton?.addEventListener('click', function () {
        const checked = getCheckboxes().filter(item => item.checked);

        if (checked.length === 0) {
            updateSelection();
            return;
        }

        if (!deleteForm || !selectedInputs) {
            console.error('Form penghapusan wishlist tidak ditemukan.');
            return;
        }

        selectedWishlistIds = checked.map(item => item.value);

        openDeleteModal(selectedWishlistIds.length);
    });

    actionButton?.addEventListener('click', function () {

        if (isSubmitting || selectedWishlistIds.length === 0 || !deleteForm || !selectedInputs) {
            return;
        }

        isSubmitting = true;
        selectedInputs.replaceChildren();

        selectedWishlistIds.forEach(id => {

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_wishlist[]';
            input.value = id;

            selectedInputs.appendChild(input);

        });

        actionButton.disabled = true;
        actionButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menghapus...';

        closeDeleteModal();

        deleteForm.requestSubmit();

    });

    cancelButton?.addEventListener('click', closeDeleteModal);
    backdrop?.addEventListener('click', closeDeleteModal);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeDeleteModal();
        }
    });

    updateSelection();

});