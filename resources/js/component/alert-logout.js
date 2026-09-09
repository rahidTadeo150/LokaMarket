document.addEventListener('DOMContentLoaded', function () {
    const openLogoutModalButton = document.getElementById('openLogoutModal');
    const closeLogoutModalButton = document.getElementById('closeLogoutModal');
    const confirmLogoutButton = document.getElementById('confirmLogout');
    const logoutModal = document.getElementById('logoutModal');
    const logoutModalContent = document.getElementById('logoutModalContent');
    const logoutForm = document.getElementById('logoutForm');

    if ( !openLogoutModalButton || !closeLogoutModalButton || !confirmLogoutButton || !logoutModal || !logoutModalContent || !logoutForm) {
        return;
    }

    openLogoutModalButton.addEventListener('click', function () {

        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        setTimeout(function () {

            logoutModalContent.classList.remove(
                'scale-95',
                'opacity-0'
            );

            logoutModalContent.classList.add(
                'scale-100',
                'opacity-100'
            );

        }, 10);

    });

    function closeLogoutModal() {

        logoutModalContent.classList.remove(
            'scale-100',
            'opacity-100'
        );

        logoutModalContent.classList.add(
            'scale-95',
            'opacity-0'
        );

        setTimeout(function () {

            logoutModal.classList.remove('flex');
            logoutModal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }, 200);

    }

    closeLogoutModalButton.addEventListener(
        'click',
        closeLogoutModal
    );

    logoutModal.addEventListener('click', function (event) {

        if (event.target === logoutModal) {
            closeLogoutModal();
        }

    });

    document.addEventListener('keydown', function (event) {

        if ( event.key === 'Escape' && !logoutModal.classList.contains('hidden')) {
            closeLogoutModal();
        }

    });

    confirmLogoutButton.addEventListener('click', function () {
        confirmLogoutButton.disabled = true;
        confirmLogoutButton.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin mr-1"></i>
            Keluar...
        `;

        logoutForm.submit();

    });

});