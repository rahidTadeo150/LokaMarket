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

    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-[#3B2115]/40 backdrop-blur-sm lg:hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="adminSidebar"
        class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-orange-100 bg-white transition-transform duration-300 lg:translate-x-0">

        <div class="flex h-20 items-center border-b border-orange-100 px-5">

            <div>
                <h1 class="text-lg font-extrabold leading-none text-[#3B2115]">
                    Loka<span class="text-orange-500">Market</span>
                </h1>
                <p class="mt-1 text-[9px] font-semibold uppercase tracking-[0.18em] text-[#A58E81]">
                    Admin Panel
                </p>
            </div>

            <button id="closeSidebar"
                    type="button"
                    class="ml-auto flex h-9 w-9 items-center justify-center rounded-lg text-[#8D776A] hover:bg-orange-50 hover:text-orange-500 lg:hidden">
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        {{-- MENU --}}

        <nav class="flex-1 overflow-y-auto px-4 py-5">

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.16em] text-[#A58E81]">
                Menu Utama
            </p>

            <a href="#"
            class="mb-1 flex items-center gap-3 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-3 py-3 text-sm font-semibold text-white shadow-md shadow-orange-200">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/15">
                    <i class="fa-solid fa-chart-pie text-xs"></i>
                </span>
                <span>Dashboard</span>
            </a>

            <a href="#"
            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-[#72594B] transition hover:bg-orange-50 hover:text-orange-600">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 group-hover:bg-white">
                    <i class="fa-solid fa-users text-xs"></i>
                </span>
                <span>Pengguna</span>
            </a>

            <a href="#"
            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-[#72594B] transition hover:bg-orange-50 hover:text-orange-600">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 group-hover:bg-white">
                    <i class="fa-solid fa-store text-xs"></i>
                </span>
                <span>Kelola Toko</span>
            </a>

            <a href="#"
            class="group mb-1 flex items-center justify-between rounded-xl px-3 py-3 text-sm font-medium text-[#72594B] transition hover:bg-orange-50 hover:text-orange-600">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 group-hover:bg-white">
                        <i class="fa-solid fa-file-circle-check text-xs"></i>
                    </span>
                    <span>Withdraw</span>
                </div>
                <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-100 px-1.5 text-[9px] font-bold text-orange-600">
                    12
                </span>
            </a>

            <a href="#"
            class="group mb-1 flex items-center justify-between rounded-xl px-3 py-3 text-sm font-medium text-[#72594B] transition hover:bg-orange-50 hover:text-orange-600">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 group-hover:bg-white">
                        <i class="fa-solid fa-file-circle-check text-xs"></i>
                    </span>
                    <span>Pengajuan Toko</span>
                </div>
                <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-100 px-1.5 text-[9px] font-bold text-orange-600">
                    12
                </span>
            </a>

            <div class="my-5 border-t border-orange-100"></div>

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.16em] text-[#A58E81]">
                Sistem
            </p>

            <a href="#"
            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-[#72594B] transition hover:bg-orange-50 hover:text-orange-600">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 group-hover:bg-white">
                    <i class="fa-solid fa-gear text-xs"></i>
                </span>
                <span>Pengaturan</span>
            </a>

            <a href="#"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-[#72594B] transition hover:bg-orange-50 hover:text-orange-600">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-50 text-orange-500 group-hover:bg-white">
                    <i class="fa-solid fa-circle-question text-xs"></i>
                </span>
                <span>Bantuan</span>
            </a>

        </nav>

        <div class="shrink-0 border-t border-orange-100 p-4">

            <div class="flex items-center gap-3 rounded-2xl bg-[#FFF9F2] p-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-500 text-sm font-bold text-white">
                    A
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-xs font-bold text-[#3B2115]">
                        Admin LokaMarket
                    </p>
                    <p class="truncate text-[10px] text-[#A58E81]">
                        admin@lokamarket.id
                    </p>
                </div>

                <button type="button"
                        class="flex h-8 w-8 items-center justify-center rounded-lg text-[#8D776A] hover:bg-white hover:text-orange-500">
                    <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                </button>

            </div>

        </div>

    </aside>

    <div class="min-h-screen lg:pl-72">

        {{-- TOP NAVBAR --}}
        <header class="sticky top-0 z-30 h-20 border-b border-orange-100 bg-white/95 backdrop-blur">

            <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">

                    <button id="openSidebar"
                            type="button"
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-[#72594B] transition hover:bg-orange-50 hover:text-orange-500 lg:hidden">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div>
                        <p class="hidden text-[10px] font-medium text-[#A58E81] sm:block">
                            LokaMarket Admin
                        </p>
                        <h2 class="text-base font-bold text-[#3B2115] sm:text-lg">
                            @yield('page-heading', 'Dashboard')
                        </h2>
                    </div>

                </div>


                <div class="flex items-center gap-2">

                    <button type="button"
                            class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-[#72594B] transition hover:bg-orange-50 hover:text-orange-500">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>

                    <div class="mx-1 hidden h-8 w-px bg-orange-100 sm:block"></div>

                    <button type="button"
                            class="flex items-center gap-2 rounded-xl p-1.5 transition hover:bg-orange-50 sm:px-2">

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-100 text-xs font-bold text-orange-600">
                            A
                        </div>

                        <div class="hidden text-left md:block">
                            <p class="text-xs font-bold text-[#3B2115]">
                                Admin
                            </p>
                            <p class="text-[10px] text-[#A58E81]">
                                Administrator
                            </p>
                        </div>

                        <i class="fa-solid fa-chevron-down ml-1 hidden text-[9px] text-[#A58E81] md:block"></i>

                    </button>

                </div>

            </div>

        </header>


        {{-- PAGE CONTENT --}}
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