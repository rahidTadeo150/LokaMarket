document.addEventListener('DOMContentLoaded', function () {
    const adminProfileWrapper = document.getElementById('adminProfileWrapper');
    const adminProfileButton = document.getElementById('adminProfileButton');
    const adminProfileDropdown = document.getElementById('adminProfileDropdown');
    const adminProfileChevron = document.getElementById('adminProfileChevron');

    if ( !adminProfileWrapper || !adminProfileButton || !adminProfileDropdown) {
        return;
    }

    adminProfileButton.addEventListener('click', function (event) {
        event.stopPropagation();

    const isHidden = adminProfileDropdown.classList.contains('hidden');

        if (isHidden) {
            adminProfileDropdown.classList.remove('hidden');
            adminProfileButton.setAttribute('aria-expanded', 'true');

            if (adminProfileChevron) {
                adminProfileChevron.classList.add('rotate-180');
            }

        } else {
            adminProfileDropdown.classList.add('hidden');
            adminProfileButton.setAttribute('aria-expanded', 'false');

            if (adminProfileChevron) {
                adminProfileChevron.classList.remove('rotate-180');
            }

        }

    });


    document.addEventListener('click', function (event) {

        if (!adminProfileWrapper.contains(event.target)) {
            adminProfileDropdown.classList.add('hidden');
            adminProfileButton.setAttribute('aria-expanded', 'false');

            if (adminProfileChevron) {
                adminProfileChevron.classList.remove('rotate-180');
            }

        }

    });

    adminProfileDropdown.addEventListener('click', function (event) {
        event.stopPropagation();
    });

});