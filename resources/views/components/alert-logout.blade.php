<div id="logoutModal"
    class="fixed inset-0 z-9999 hidden items-center justify-center bg-black/30 px-5 backdrop-blur-sm">
    <div id="logoutModalContent"
        class="w-full max-w-sm scale-95 rounded-2xl border border-orange-100 bg-white p-6 opacity-0 shadow-2xl transition-all duration-200">
        
        <div class="mb-5 flex justify-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-50 text-red-500">
                <i class="fa-solid fa-right-from-bracket text-xl"></i>
            </div>
        </div>

        <div class="text-center">

            <h3 class="text-lg font-bold text-[#3D2418]">
                Keluar dari Akun?
            </h3>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                Apakah Anda yakin ingin keluar dari akun
                LokaMarket Anda?
            </p>

        </div>


        <div class="mt-6 flex gap-3">

            <button type="button"
                    id="closeLogoutModal"
                    class="flex-1 rounded-full border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                Batal
            </button>
            <button type="button"
                    id="confirmLogout"
                    class="flex-1 rounded-full bg-red-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-600">
                <i class="fa-solid fa-right-from-bracket mr-1"></i>
                Keluar
            </button>

        </div>

    </div>
</div>