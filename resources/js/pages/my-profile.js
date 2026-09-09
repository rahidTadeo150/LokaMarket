document.addEventListener('DOMContentLoaded', function () {
    const openModalButton = document.getElementById('openResetPasswordModal');
    const closeModalButton = document.getElementById('closeResetPasswordModal');
    const confirmResetButton = document.getElementById('confirmResetPassword');
    const modal = document.getElementById('resetPasswordModal');
    const modalContent = document.getElementById('resetPasswordModalContent');
    const resetPasswordForm = document.getElementById('resetPasswordForm');

    if (!openModalButton || !closeModalButton || !confirmResetButton || !modal || !modalContent || !resetPasswordForm) {
        return;
    }

    openModalButton.addEventListener('click', function () {

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        setTimeout(function () {

            modalContent.classList.remove(
                'scale-95',
                'opacity-0'
            );

            modalContent.classList.add(
                'scale-100',
                'opacity-100'
            );

        }, 10);

    });

    function closeModal() {

        modalContent.classList.remove(
            'scale-100',
            'opacity-100'
        );

        modalContent.classList.add(
            'scale-95',
            'opacity-0'
        );

        setTimeout(function () {

            modal.classList.remove('flex');
            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }, 200);

    }

    closeModalButton.addEventListener('click', function () {
        closeModal();
    });

    modal.addEventListener('click', function (event) {

        if (event.target === modal) {
            closeModal();
        }

    });

    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            !modal.classList.contains('hidden')
        ) {
            closeModal();
        }

    });

    confirmResetButton.addEventListener('click', function () {
        confirmResetButton.disabled = true;
        confirmResetButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin mr-1"></i>
            Mengirim...
        `;

        resetPasswordForm.submit();

    });

});