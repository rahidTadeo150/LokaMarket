<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LokaMarket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8">
        
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Masuk ke LokaMarket</h1>
            <p class="text-sm text-gray-500 mt-1">Masukkan akun Anda untuk melanjutkan</p>
        </div>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-200 text-red-700 text-sm rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="nama@email.com"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    placeholder="••••••••"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                    Ingat saya
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition duration-150">
                Masuk
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="/register" class="text-blue-600 font-semibold hover:underline">Daftar</a>
        </p>
    </div>

</body>
</html>