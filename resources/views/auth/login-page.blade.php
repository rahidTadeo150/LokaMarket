<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Masuk - LokaMarket</title>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#FFF9F4] font-poppins text-[#3B2115]">
    <header class="border-b border-[#F1DCC8] bg-white">
        <div class="mx-auto flex h-16 max-w-[1440px] items-center justify-between gap-3 px-4 sm:h-[76px] sm:px-10 lg:px-14">
            <a href="{{ route('cust.landingPage') }}" aria-label="Kembali ke halaman utama LokaMarket">
                <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="h-10 w-auto sm:h-12">
            </a>
            <div class="flex shrink-0 items-center gap-2 text-[10px] sm:gap-4 sm:text-xs">
                <span class="hidden text-[#72594B] sm:inline">Belum punya akun?</span>
                <a href="{{ route('cust.register') }}" class="rounded-full border border-[#D9490B] px-4 py-2 font-semibold text-[#C1440E] transition hover:bg-[#FFF0E5] sm:px-7 sm:py-2.5">
                    Daftar
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto grid min-h-[calc(100vh-64px)] max-w-[1440px] items-center gap-6 px-4 py-6 sm:min-h-[calc(100vh-76px)] sm:px-10 sm:py-8 lg:grid-cols-[1fr_1fr] lg:gap-10 lg:px-28 lg:py-12">
        <section class="relative hidden min-h-[485px] overflow-hidden rounded-[22px] bg-[#FFE5C5] px-10 py-10 lg:block">
            <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-[#FFD98D] opacity-70 blur-2xl"></div>
            <img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="relative h-12 w-auto">
            <div class="relative mt-9 max-w-[290px]">
                <h1 class="text-[27px] font-extrabold leading-[1.12] text-[#3B2115]">
                    Selamat Datang<br>
                    Kembali di<br>
                    LokaMarket
                </h1>
                <p class="mt-4 text-xs leading-5 text-[#72594B]">
                    Masuk untuk melanjutkan belanja produk UMKM lokal favoritmu dan pantau pesananmu.
                </p>
                <ul class="mt-5 space-y-3 text-xs text-[#4E382C]">
                    <li class="flex items-center gap-2.5"><span class="flex h-[18px] w-[18px] items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Ribuan produk UMKM lokal pilihan</li>
                    <li class="flex items-center gap-2.5"><span class="flex h-[18px] w-[18px] items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Transaksi aman &amp; terpercaya</li>
                    <li class="flex items-center gap-2.5"><span class="flex h-[18px] w-[18px] items-center justify-center rounded-full bg-[#FF8A12] text-[10px] text-white"><i class="fa-solid fa-check"></i></span>Dukung ekonomi warga sekitarmu</li>
                </ul>
            </div>
        </section>

        <section class="mx-auto w-full max-w-[500px] rounded-[18px] border border-[#F1DCC8] bg-white px-4 py-6 sm:rounded-[22px] sm:px-10 sm:py-9 lg:min-h-[485px] lg:px-11">
            <div>
                <h2 class="text-2xl font-extrabold text-[#3B2115] sm:text-[25px]">Masuk ke Akun</h2>
                <p class="mt-0.5 text-xs text-[#72594B]">Senang bertemu lagi! Masukkan detail akunmu.</p>
            </div>

            <div class="my-5 flex items-center gap-3 text-[9px] text-[#A58C7D]">
                <span class="h-px flex-1 bg-[#F1DCC8]"></span>
                atau masuk dengan email
                <span class="h-px flex-1 bg-[#F1DCC8]"></span>
            </div>

            <form action="#" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label for="email" class="mb-1 block text-[10px] font-bold text-[#5A4032]">Email</label>
                    <div class="flex h-10 min-w-0 items-center gap-2 rounded-full border border-[#FFB477] px-3.5 focus-within:ring-2 focus-within:ring-[#FFD1AD] sm:h-9">
                        <i class="fa-regular fa-envelope text-xs text-[#967C6C]"></i>
                        <input id="email" name="email" type="email" autocomplete="email" placeholder="nama@email.com" class="min-w-0 w-full bg-transparent text-xs text-[#3B2115] outline-none placeholder:text-[#A58C7D]">
                    </div>
                </div>
                <div>
                    <label for="password" class="mb-1 block text-[10px] font-bold text-[#5A4032]">Kata Sandi</label>
                    <div class="flex h-10 min-w-0 items-center gap-2 rounded-full border border-[#FFB477] px-3.5 focus-within:ring-2 focus-within:ring-[#FFD1AD] sm:h-9">
                        <i class="fa-solid fa-lock text-xs text-[#967C6C]"></i>
                        <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi" class="min-w-0 w-full bg-transparent text-xs text-[#3B2115] outline-none placeholder:text-[#A58C7D]">
                        <button id="password-toggle" type="button" aria-label="Tampilkan kata sandi" class="text-[#967C6C] transition hover:text-[#C1440E]"><i class="fa-solid fa-eye text-xs"></i></button>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-x-3 gap-y-2 pt-0.5 text-[10px]">
                    <label class="flex items-center gap-2 text-[#72594B]"><input type="checkbox" name="remember" class="h-3.5 w-3.5 accent-[#FF7900]">Ingat saya</label>
                    <a href="#" class="font-bold text-[#C1440E] hover:text-[#9E350B]">Lupa kata sandi?</a>
                </div>
                <button type="submit" class="h-10 w-full rounded-full bg-[#E95309] text-xs font-bold text-white shadow-sm transition hover:bg-[#C1440E] hover:shadow-md">Masuk</button>
            </form>

            <button type="button" class="mt-3 flex h-10 w-full items-center justify-center gap-3 rounded-full border border-[#F1DCC8] text-[10px] font-bold text-[#3B2115] transition hover:bg-[#FFF9F4] sm:h-9">
                <i class="fa-brands fa-google text-lg text-[#D9490B]"></i>Google
            </button>

            <p class="mt-8 text-center text-[10px] text-[#72594B] sm:mt-16">
                Belum punya akun?
                <a href="{{ route('cust.register') }}" class="font-bold text-[#C1440E] hover:text-[#9E350B]">
                    Daftar sekarang
                </a>
            </p>
        </section>
    </main>
    <script>
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        passwordToggle.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            passwordToggle.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            passwordToggle.querySelector('i').classList.toggle('fa-eye', !isPassword);
            passwordToggle.querySelector('i').classList.toggle('fa-eye-slash', isPassword);
        });
    </script>
</body>
</html>