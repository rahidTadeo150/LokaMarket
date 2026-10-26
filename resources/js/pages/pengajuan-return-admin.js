document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formSearchReturn');
    const input = document.getElementById('searchReturn');
    const button = document.getElementById('btnSearchReturn');

    const scrollKey = 'pengajuanReturnScrollY';
    const restoreKey = 'pengajuanReturnRestoreScroll';
    const searchKey = 'pengajuanReturnLastSearch';

    let debounceTimer;
    let lastSubmittedSearch = input ? input.value.trim() : '';

    try {

        if (sessionStorage.getItem(restoreKey) === '1') {

            const savedScroll = parseInt(sessionStorage.getItem(scrollKey) || '0', 10);

            sessionStorage.removeItem(restoreKey);

            requestAnimationFrame(function () {

                window.scrollTo({
                    top: savedScroll,
                    behavior: 'instant'
                });

            });

        }

    } catch (error) { }

    function saveScrollPosition() 
    {

        try {

            sessionStorage.setItem(scrollKey, String(window.scrollY));

            sessionStorage.setItem(restoreKey, '1');

        } catch (error) { }

    }

    function setSearchLoading() 
    {
        if (!button) return;

        button.disabled = true;
        button.classList.add('opacity-70', 'cursor-wait');
        button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mencari...';

    }

    if (form && input) {
        
        form.addEventListener('submit', function () {

            saveScrollPosition();

            try {

                sessionStorage.setItem(searchKey, input.value.trim());

            } catch (error) { }

            setSearchLoading();

        });

        input.addEventListener('input', function () {

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function () {

                const currentSearch = input.value.trim();

                if (currentSearch === lastSubmittedSearch) {
                    return;
                }

                lastSubmittedSearch = currentSearch;

                const pageInput = form.querySelector('input[name="page"]');

                if (pageInput) {

                    pageInput.remove();

                }

                saveScrollPosition();
                setSearchLoading();

                form.requestSubmit();

            }, 400);

        });

    }

    const tabLinks = document.querySelectorAll('[data-return-tab]');

    tabLinks.forEach(function (tab) {
        
        tab.addEventListener('click', function () {

            saveScrollPosition();

        });

    });

    const paginationLinks = document.querySelectorAll('.pagination a, nav[aria-label="Pagination"] a');

    paginationLinks.forEach(function (link) {

        link.addEventListener('click', function () {
            saveScrollPosition();
        });

    });

});