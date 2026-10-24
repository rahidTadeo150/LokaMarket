document.addEventListener('DOMContentLoaded', function () {

    const profileWrapper = document.getElementById('sellerProfileWrapper');
    const profileButton = document.getElementById('sellerProfileButton');
    const profileDropdown = document.getElementById('sellerProfileDropdown');
    const profileChevron = document.getElementById('sellerProfileChevron');

    function openProfileDropdown() {
        if (!profileDropdown || !profileButton) return;

        profileDropdown.classList.remove('hidden');
        profileButton.setAttribute('aria-expanded', 'true');

        if (profileChevron) {
            profileChevron.classList.add('rotate-180');
        }
    }

    function closeProfileDropdown() {
        if (!profileDropdown || !profileButton) return;

        profileDropdown.classList.add('hidden');
        profileButton.setAttribute('aria-expanded', 'false');

        if (profileChevron) {
            profileChevron.classList.remove('rotate-180');
        }
    }

    if (profileWrapper && profileButton && profileDropdown) {

        profileButton.addEventListener('click', function (event) {
            event.stopPropagation();

            const isOpen = !profileDropdown.classList.contains('hidden');

            if (isOpen) {
                closeProfileDropdown();
            } else {
                openProfileDropdown();
            }
        });

        document.addEventListener('click', function (event) {
            if (!profileWrapper.contains(event.target)) {
                closeProfileDropdown();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeProfileDropdown();
            }
        });
    }

    const mobileMenu = document.getElementById('mobileMenu');
    const mobileButton = document.getElementById('sellerMobileMenuButton');

    function openMobileMenu() {
        if (!mobileMenu || !mobileButton) return;

        mobileMenu.classList.remove('hidden');
        mobileButton.setAttribute('aria-expanded', 'true');

        const icon = mobileButton.querySelector('i');

        if (icon) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-xmark');
        }
    }

    function closeMobileMenu() {
        if (!mobileMenu || !mobileButton) return;

        mobileMenu.classList.add('hidden');
        mobileButton.setAttribute('aria-expanded', 'false');

        const icon = mobileButton.querySelector('i');

        if (icon) {
            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');
        }
    }

    if (mobileMenu && mobileButton) {

        mobileButton.addEventListener('click', function () {
            const isOpen = !mobileMenu.classList.contains('hidden');

            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        mobileMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                closeMobileMenu();
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeMobileMenu();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                closeMobileMenu();
            }
        });
    }

    document.querySelectorAll('.openLogoutModal').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            
            const logoutForm = button.closest('form');

            if (!logoutForm) return;

            logoutForm.dispatchEvent(
                new CustomEvent('logout:confirm', {
                    bubbles: true,
                    detail: {
                        form: logoutForm
                    }
                })
            );
        });
    });

});