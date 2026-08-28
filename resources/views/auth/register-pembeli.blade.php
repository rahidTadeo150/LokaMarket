<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembeli - LokaMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#FCFAF6] min-h-screen text-slate-800 flex flex-col justify-between">

    <!-- Navbar -->
    <header class="w-full bg-white border-b border-orange-100/60 py-4 px-6 md:px-12 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-[#E05315] rounded-xl flex items-center justify-center text-white text-xl shadow-md shadow-orange-500/20">
                <i class="fa-solid fa-basket-shopping"></i>
            </div>
            <div>
                <h1 class="font-extrabold text-lg text-[#E05315] leading-none">LokaMarket</h1>
                <span class="text-[10px] text-slate-400 font-medium">Pusat UMKM Lokal</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-slate-600 hidden sm:inline">Sudah punya akun?</span>
            <a href="{{ route('cust.login') }}"  class="px-6 py-2 border border-[#D34E0E] text-[#D34E0E] rounded-full text-sm font-semibold hover:bg-orange-50 transition">Masuk</a>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1 flex items-center justify-center p-4 md:p-8">
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            
            <!-- Banner Kiri -->
            <div class="lg:col-span-5 bg-gradient-to-br from-amber-100/80 via-orange-100/50 to-amber-200/60 rounded-3xl p-8 md:p-10 flex flex-col justify-between min-h-[520px] shadow-sm">
                <div>
                    <div class="flex items-center gap-2 mb-10">
                        <div class="w-9 h-9 bg-[#E05315] rounded-xl flex items-center justify-center text-white text-lg shadow-sm">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <div>
                            <span class="font-extrabold text-base text-[#E05315] leading-none block">LokaMarket</span>
                            <span class="text-[9px] text-slate-500 font-medium">Pusat UMKM Lokal</span>
                        </div>
                    </div>

                    <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">Gabung Bersama<br>500+ UMKM Lokal</h2>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">Buat akun gratis dan mulai belanja atau jual produk UMKM favoritmu hari ini.</p>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-[#E05315] text-white flex items-center justify-center text-xs"><i class="fa-solid fa-check"></i></span>
                            <span class="text-xs md:text-sm font-medium text-slate-700">Gratis daftar untuk pembeli & penjual</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-[#E05315] text-white flex items-center justify-center text-xs"><i class="fa-solid fa-check"></i></span>
                            <span class="text-xs md:text-sm font-medium text-slate-700">Pembayaran aman & terverifikasi</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-[#E05315] text-white flex items-center justify-center text-xs"><i class="fa-solid fa-check"></i></span>
                            <span class="text-xs md:text-sm font-medium text-slate-700">Antar produk langsung dari warga lokal</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-[#E05315] text-white flex items-center justify-center text-xs"><i class="fa-solid fa-check"></i></span>
                            <span class="text-xs md:text-sm font-medium text-slate-700">Dukungan pelanggan 24/7</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kanan (Pembeli) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-100 border border-slate-100">
                <div class="mb-6">
                    <h3 class="text-2xl md:text-3xl font-extrabold text-slate-900">Buat Akun Baru</h3>
                    <p class="text-xs md:text-sm text-slate-500 mt-1">Isi data dirimu untuk mulai bergabung.</p>
                </div>

                <!-- Tab Navigasi Link -->
                <div class="bg-stone-100 p-1.5 rounded-full flex gap-1 mb-6">
                    <a href="/register" class="flex-1 py-2 text-center rounded-full text-xs md:text-sm font-bold bg-[#E88C08] text-white shadow-sm">
                        Pembeli
                    </a>
                    <a href="/register-penjual" class="flex-1 py-2 text-center rounded-full text-xs md:text-sm font-semibold text-slate-600 hover:text-slate-900">
                        Penjual (UMKM)
                    </a>
                </div>

                <form action="/register" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="pembeli">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required
                                    class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">No. Telepon</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-solid fa-mobile-screen"></i></span>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx" required
                                    class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1.5">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-regular fa-envelope"></i></span>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">Kata Sandi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" id="password" name="password" placeholder="Buat kata sandi" required
                                    class="w-full pl-10 pr-10 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                                <button type="button" onclick="toggleVisibility('password', 'eye1')" class="absolute inset-y-0 right-0 pr-4 text-slate-400"><i id="eye1" class="fa-regular fa-eye"></i></button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1.5">Konfirmasi Sandi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required
                                    class="w-full pl-10 pr-10 py-2.5 rounded-full border border-slate-300 text-xs md:text-sm focus:outline-none focus:border-orange-500">
                                <button type="button" onclick="toggleVisibility('password_confirmation', 'eye2')" class="absolute inset-y-0 right-0 pr-4 text-slate-400"><i id="eye2" class="fa-regular fa-eye"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" id="terms" name="terms" required class="w-4 h-4 text-orange-600 rounded border-slate-300 accent-orange-600">
                        <label for="terms" class="text-xs text-slate-600">Saya menyetujui <a href="#" class="text-[#D34E0E] font-bold hover:underline">Syarat & Ketentuan</a> serta Kebijakan Privasi</label>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#D34E0E] hover:bg-[#b8430a] text-white font-bold rounded-full transition text-sm shadow-md mt-2">Daftar Sekarang</button>
                </form>

                <div class="relative flex py-4 items-center mt-2">
                    <div class="flex-grow border-t border-slate-200"></div>
                    <span class="flex-shrink mx-4 text-xs text-slate-400">atau daftar dengan</span>
                    <div class="flex-grow border-t border-slate-200"></div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="w-full py-2.5 border border-slate-200 rounded-full flex items-center justify-center gap-2 text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-brands fa-google text-red-500"></i> Google</button>
                    <button type="button" class="w-full py-2.5 border border-slate-200 rounded-full flex items-center justify-center gap-2 text-xs font-semibold text-slate-700 hover:bg-slate-50"><i class="fa-brands fa-facebook text-blue-600"></i> Facebook</button>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-xs text-slate-500">Sudah punya akun? <a href="{{ route('cust.login') }}"  class="text-[#D34E0E] font-bold hover:underline">Masuk di sini</a></p>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-4 text-center text-xs text-slate-400">&copy; 2026 LokaMarket. All rights reserved.</footer>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>
</html>