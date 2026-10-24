document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('customConfirmModal');
    const backdrop = document.getElementById('customConfirmBackdrop');
    const box = document.getElementById('customConfirmBox');
    const icon = document.getElementById('customConfirmIcon');
    const iconElement = document.getElementById('customConfirmIconElement');
    const title = document.getElementById('customConfirmTitle');
    const message = document.getElementById('customConfirmMessage');
    const cancelButton = document.getElementById('customConfirmCancel');
    const actionButton = document.getElementById('customConfirmAction');

    let currentForm = null;

    const themes = {

        green: {
            iconBg: 'bg-green-100',
            iconColor: 'text-green-500',
            button: 'bg-green-500',
            hover: 'hover:bg-green-600',
            shadow: 'shadow-green-500/20',
        },

        red: {
            iconBg: 'bg-red-100',
            iconColor: 'text-red-500',
            button: 'bg-red-500',
            hover: 'hover:bg-red-600',
            shadow: 'shadow-red-500/20',
        },

        orange: {
            iconBg: 'bg-orange-100',
            iconColor: 'text-orange-500',
            button: 'bg-orange-500',
            hover: 'hover:bg-orange-600',
            shadow: 'shadow-orange-500/20',
        }

    };

    function openConfirm(button) {

        const themeName = button.dataset.theme || 'orange';
        const selectedTheme = themes[themeName] || themes.orange;
        const modalTitle = button.dataset.title || 'Konfirmasi';
        const modalMessage = button.dataset.message || 'Apakah kamu yakin ingin melanjutkan?';
        const confirmText = button.dataset.confirmText || 'Ya';
        const customIcon = button.dataset.icon || selectedTheme.icon;
        const formId = button.dataset.form;

        currentForm = formId ? document.getElementById(formId) : null;

        title.textContent = modalTitle;

        message.textContent = modalMessage;

        icon.className = `mx-auto flex h-16 w-16 items-center justify-center rounded-2xl ${selectedTheme.iconBg} ${selectedTheme.iconColor}`;

        iconElement.className = `fa-solid ${customIcon} text-2xl`;

        actionButton.className = `flex-1 rounded-xl px-4 py-3 text-xs font-bold text-white shadow-lg transition ${selectedTheme.button} ${selectedTheme.hover} ${selectedTheme.shadow}`;

        actionButton.textContent = confirmText;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');


        setTimeout(function () {

            box.classList.remove(
                'scale-95',
                'opacity-0'
            );

            box.classList.add(
                'scale-100',
                'opacity-100'
            );

        }, 10);

    }

    function closeConfirm() {

        box.classList.remove(
            'scale-100',
            'opacity-100'
        );

        box.classList.add(
            'scale-95',
            'opacity-0'
        );

        setTimeout(function () {

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

            currentForm = null;

        }, 200);

    }

    const confirmButtons = document.querySelectorAll('[data-confirm]');

    confirmButtons.forEach(function (button) {

        button.addEventListener('click', function () {
            openConfirm(button);
        });

    });

    actionButton.addEventListener('click', function () {

        if (!currentForm) {
            closeConfirm();
            return;
        }


        actionButton.disabled = true;

        actionButton.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memproses...';

        currentForm.submit();

    });

    cancelButton.addEventListener('click', function () {
        closeConfirm();
    });

    backdrop.addEventListener('click', function () {
        closeConfirm();
    });

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeConfirm();
        }

    });

});