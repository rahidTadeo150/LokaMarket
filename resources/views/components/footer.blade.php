<footer class="bg-[#3B2115] text-white">
    <div class="mx-auto max-w-7xl px-6 py-10 lg:px-12">
        <div class="flex flex-col gap-10 md:flex-row md:items-start md:justify-between">
            {{-- Logo --}}
            <div class="flex items-start">
                <a href="/" class="inline-flex">
                    <img
                        src="{{ asset('storage/logo-lokamarket.png') }}"
                        alt="LokaMarket"
                        class="w-40 h-auto"
                    >
                </a>
            </div>

            {{-- Navigation --}}
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 sm:gap-16 lg:gap-24">
                <div>
                    <h3 class="mb-4 text-xs font-bold uppercase text-yellow-400">
                        Perusahaan
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Karier
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Blog
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 text-xs font-bold uppercase text-yellow-400">
                        Untuk Penjual
                    </h3>

                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Cara Jualan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Biaya & Komisi
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Pusat Bantuan
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 text-xs font-bold uppercase text-yellow-400">
                        Untuk Pembeli
                    </h3>

                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Cara Belanja
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                Metode Bayar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-xs text-gray-300 transition hover:text-white">
                                FAQ
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="my-8 h-px bg-[#5A3828]"></div>
        <div>
            <p class="text-[10px] text-gray-400">
                © 2026 LokaMarket. Dibuat dengan bangga untuk UMKM Indonesia.
            </p>
        </div>
    </div>
</footer>