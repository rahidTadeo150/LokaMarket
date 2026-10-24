document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    if (!searchForm || !searchInput) return;

    let searchTimer;

    const scrollKey = 'lokamarket_search_scroll';

    const savedScroll = sessionStorage.getItem(scrollKey);

    if (savedScroll !== null) {
        window.scrollTo({
            top: parseInt(savedScroll, 10),
            behavior: 'instant'
        });

        sessionStorage.removeItem(scrollKey);
    }

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimer);

        searchTimer = setTimeout(function () {

            sessionStorage.setItem(
                scrollKey,
                window.scrollY.toString()
            );

            searchForm.requestSubmit();
            
        }, 500);
    });

    searchForm.addEventListener('submit', function () {
        clearTimeout(searchTimer);
    });

    window.toggleFilter = function() {
        const panel = document.getElementById('mobileFilter');
        const backdrop = document.getElementById('filterBackdrop');

        if (!panel || !backdrop) return;

        const isOpening = panel.classList.contains('hidden');

        if (isOpening) {
            panel.classList.remove('hidden');
            panel.style.display = 'flex';

            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            requestAnimationFrame(() => {
                panel.style.transform = 'translateY(0)';
            });
        } else {
            panel.style.transform = 'translateY(100%)';
            panel.style.display = 'none';
            panel.classList.add('hidden');

            backdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }
    };
});