<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>
        @yield('title')
    </title>
</head>
<body class="bg-white text-gray-800 antialiased">

    

            {{-- Menu Navigasi --}}
            <x-navbar-user></x-navbar-user>

        </div>
    </header>

    {{-- Konten Halaman --}}
    @yield('content')

    {{-- Footer --}}
    <x-footer></x-footer>

</body>
</html>


