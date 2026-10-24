document.addEventListener('DOMContentLoaded', function () {

    const openLogoutButtons = document.querySelectorAll('.openLogoutModal');
    const closeLogoutModalButton = document.getElementById('closeLogoutModal');
    const confirmLogoutButton = document.getElementById('confirmLogout');
    const logoutModal = document.getElementById('logoutModal');
    const logoutModalContent = document.getElementById('logoutModalContent');
    const logoutForm = document.getElementById('logoutForm');

    openLogoutButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();

            if (!logoutModal || !logoutModalContent) {
                console.error(
                    '❌ #logoutModal atau #logoutModalContent tidak ditemukan'
                );

                return;
            }

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

    });


    // ========================================
    // TUTUP MODAL
    // ========================================

    function closeLogoutModal() {

        if (!logoutModal || !logoutModalContent) {
            return;
        }

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

            document.body.classList.remove(
                'overflow-hidden'
            );

        }, 200);

    }


    // ========================================
    // TOMBOL CLOSE
    // ========================================

    if (closeLogoutModalButton) {

        closeLogoutModalButton.addEventListener(
            'click',
            closeLogoutModal
        );

    }


    // ========================================
    // KLIK BACKDROP
    // ========================================

    if (logoutModal) {

        logoutModal.addEventListener(
            'click',
            function (event) {

                if (event.target === logoutModal) {
                    closeLogoutModal();
                }

            }
        );

    }


    // ========================================
    // ESCAPE
    // ========================================

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                logoutModal &&
                !logoutModal.classList.contains('hidden')
            ) {

                closeLogoutModal();

            }

        }
    );


    // ========================================
    // KONFIRMASI LOGOUT
    // ========================================

    if (confirmLogoutButton) {

        confirmLogoutButton.addEventListener(
            'click',
            function () {

                if (!logoutForm) {

                    console.error(
                        '❌ #logoutForm tidak ditemukan'
                    );

                    return;
                }

                confirmLogoutButton.disabled = true;

                confirmLogoutButton.innerHTML = `
                    <i class="fa-solid fa-spinner fa-spin mr-1"></i>
                    Keluar...
                `;

                logoutForm.submit();

            }
        );

    }

});