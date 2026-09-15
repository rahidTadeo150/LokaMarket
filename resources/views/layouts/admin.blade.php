<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>
        @yield('title')
    </title>
</head>

<body class="min-h-screen bg-[#FFF9F2] font-[Poppins] text-[#3B2115]">

    <x-sidebar-admin/>

    <div class="min-h-screen lg:pl-72">

        <x-navbar-admin/>

        <main class="min-h-[calc(100vh-80px)] px-4 py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>

    </div>

    <script>
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
    </script>

    @stack('scripts')

</body>

</html>