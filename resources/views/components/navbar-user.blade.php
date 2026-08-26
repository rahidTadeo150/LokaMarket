<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-4">
        <div class="flex items-center justify-between h-20 md:h-16">
            <div class="flex items-center">
                {{-- Hamburger --}}
                <div class="text-xl md:hidden">
                    <i class="fa-solid fa-bars"></i>
                </div>

                {{-- Logo --}}
                <a href=""
                    class="inline-flex">
                    <img src="{{ asset('storage\logo-lokamarket.png') }}" 
                        alt=""
                        class="w-44">
                </a>
            </div>

            <div class="flex items-center gap-x-10">
                {{-- Menu --}}
                <div class="hidden md:flex items-center gap-5 text-gray-600 font-medium text-sm">
                    <a href="">
                        Kategori
                    </a>
                    <a href="">
                        Pilihan Produk
                    </a>
                    <a href="">
                        Cara Kerja
                    </a>
                    <a href="">
                        Tentang Kami
                    </a>
                </div>

                {{-- Tombol Daftar --}}
                <a href=""
                    class="rounded-full bg-linear-to-br from-[#F2600C] to-[#FDB813] px-4 py-2 font-semibold text-sm text-white shadow-sm transition-all duration-200 hover:translate-y-0.5 hover:bg-blue-700 hover:shadow-md">
                    Daftar Customer
                </a>
            </div>

        </div>
    </div>
</nav>