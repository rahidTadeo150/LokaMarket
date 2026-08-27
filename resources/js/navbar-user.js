    const sidebar = document.getElementById('sidebarOverlay');
    const backdrop = document.getElementById('sidebarBackdrop');

    window.openSidebar = function() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');

        backdrop.classList.remove('hidden');

        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
        }, 10);
        document.body.classList.add('overflow-hidden');
    }

    window.closeSidebar = function() {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');

        setTimeout(() => {
            backdrop.classList.add('hidden');
        }, 300);
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeSidebar();
        }
    });