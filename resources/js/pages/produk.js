document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchEmpty = document.getElementById('searchEmpty');
    const searchKeyword = document.getElementById('searchKeyword');
    const clearSearch = document.getElementById('clearSearch');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.produk-card');
        let found = 0;

        cards.forEach(function (card) {
            const nameElement = card.querySelector('.nama-produk');
            if (!nameElement) {
                return;
            }

            const productName = nameElement.textContent.toLowerCase().trim();
            const isMatch = productName.includes(keyword);

            if (isMatch) {
                card.style.display = '';
                found++;
            } else {
                card.style.display = 'none';
            }

        });

        if (keyword !== '' && found === 0) {
            searchEmpty.classList.remove('hidden');
            searchKeyword.textContent = this.value;
        } else {
            searchEmpty.classList.add('hidden');
        }
    });

    if (clearSearch) {

        clearSearch.addEventListener('click', function () {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
        });
    }
});