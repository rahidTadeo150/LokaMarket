document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('userSearchInput');
    const tableBody = document.getElementById('userTableBody');
    const searchEmpty = document.getElementById('userSearchEmpty');

    if (!searchInput || !tableBody) {
        return;
    }

    const userRows = tableBody.querySelectorAll('.user-row');

    searchInput.addEventListener('input', function () {

        const searchValue = searchInput.value.toLowerCase().trim();

        let visibleRows = 0;

        userRows.forEach(function (row) {
            const searchData = row.getAttribute('data-search').toLowerCase();

            const isMatch = searchData.includes(searchValue);

            row.classList.toggle('hidden', !isMatch);

            if (isMatch) {
                visibleRows++;
            }
        });

        if (searchEmpty) {
            searchEmpty.classList.toggle(
                'hidden',
                visibleRows !== 0 || searchValue === ''
            );
        }

    });

});