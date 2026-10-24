document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterProdukForm');
    const searchProduk = document.getElementById('searchProduk');
    const filterKategori = document.getElementById('filterKategori');
    const statusProduk = document.getElementById('statusProduk');
    const statusTabs = document.querySelectorAll('.status-tab');

    if (!form) return;

    let timerPencarian;
    const scrollKey = 'scrollPosisiKelolaProduk';

    function simpanScroll() {
        sessionStorage.setItem(scrollKey, window.scrollY.toString());
    }

    const posisiTersimpan = sessionStorage.getItem(scrollKey);

    if (posisiTersimpan !== null) {
        sessionStorage.removeItem(scrollKey);

        requestAnimationFrame(function () {
            window.scrollTo({
                top: Number(posisiTersimpan),
                behavior: 'instant'
            });
        });
    }

    function updateTabAktif(tabTerpilih) {

        statusTabs.forEach(function (tab) {

            const aktif = tab === tabTerpilih;

            tab.classList.toggle('bg-orange-500', aktif);
            tab.classList.toggle('text-white', aktif);
            tab.classList.toggle('font-bold', aktif);
            tab.classList.toggle('shadow-md', aktif);
            tab.classList.toggle('shadow-orange-200', aktif);
            tab.classList.toggle('cursor-default', aktif);

            tab.classList.toggle('bg-white', !aktif);
            tab.classList.toggle('text-[#806B5D]', !aktif);
            tab.classList.toggle('font-semibold', !aktif);
            tab.classList.toggle('hover:bg-orange-50', !aktif);
            tab.classList.toggle('hover:text-orange-600', !aktif);
            
        });

    }

    if (searchProduk) {
        searchProduk.addEventListener('input', function () {
            clearTimeout(timerPencarian);

            timerPencarian = setTimeout(function () {
                simpanScroll();
                form.requestSubmit();
            }, 400);
        });
    }

    if (filterKategori) {
        filterKategori.addEventListener('change', function () {
            simpanScroll();
            form.requestSubmit();
        });
    }

    statusTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            
            if (statusProduk) {
                statusProduk.value = tab.dataset.status || 'semua';
            }

            updateTabAktif(tab);
            simpanScroll();
            form.requestSubmit();
        });
    });

    const statusSaatIni = statusProduk ? statusProduk.value : 'semua';

    const tabAktif = document.querySelector('.status-tab[data-status="' + statusSaatIni + '"]');
    const tabSemua = document.querySelector('.status-tab[data-status="semua"]');

    updateTabAktif(tabAktif || tabSemua);
});