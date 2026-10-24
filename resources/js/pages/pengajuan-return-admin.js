document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formSearchReturn');
    const input = document.getElementById('searchReturn');
    const button = document.getElementById('btnSearchReturn');

    if (!form || !input) return;

    const scrollKey = 'pengajuanReturnScrollY';
    const restoreKey = 'pengajuanReturnRestoreScroll';
    const searchKey = 'pengajuanReturnLastSearch';

    let debounceTimer;
    let lastSubmittedSearch = input.value.trim();

    try {

        if (sessionStorage.getItem(restoreKey) === '1') {
            const savedScroll = parseInt(
                sessionStorage.getItem(scrollKey) || '0',
                10
            );

            sessionStorage.removeItem(restoreKey);

            requestAnimationFrame(function () {
                window.scrollTo({
                    top: savedScroll,
                    behavior: 'instant'
                });
            });

        }

    } catch (error) {}

    form.addEventListener('submit', function () {

        try {
            sessionStorage.setItem(
                scrollKey,
                String(window.scrollY)
            );

            sessionStorage.setItem(restoreKey, '1');
            sessionStorage.setItem(searchKey, input.value.trim());

        } catch (error) {}

        if (button) {
            button.disabled = true;
            button.classList.add('opacity-70', 'cursor-wait');
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mencari...';
        }

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

            if (button) {
                button.disabled = true;
                button.classList.add('opacity-70', 'cursor-wait');
                button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mencari...';
            }

            form.requestSubmit();
        }, 400);

    });
    
});