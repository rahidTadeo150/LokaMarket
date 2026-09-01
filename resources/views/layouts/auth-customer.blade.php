<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>
        @yield('title')
    </title>
</head>
<body>
    <x-navbar-auth></x-navbar-auth>
    @yield('content')
    <x-footer></x-footer>
</body>
</html>


