document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    const openButton = document.getElementById('openSidebar');
    const closeButton = document.getElementById('closeSidebar');


    function openSidebar() {

        sidebar.classList.remove('-translate-x-full');

        overlay.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');
    }


    function closeSidebar() {

        sidebar.classList.add('-translate-x-full');

        overlay.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }


    if (openButton) {
        openButton.addEventListener('click', openSidebar);
    }


    if (closeButton) {
        closeButton.addEventListener('click', closeSidebar);
    }


    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }


    window.addEventListener('resize', function () {

        if (window.innerWidth >= 1024) {
            closeSidebar();
        }

    });

});