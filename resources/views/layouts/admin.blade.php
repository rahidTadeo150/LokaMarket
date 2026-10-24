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

</body>

</html>