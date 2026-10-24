<div id="customConfirmModal"
     class="fixed inset-0 z-9999 hidden items-center justify-center p-4">

    <div id="customConfirmBackdrop"
         class="absolute inset-0 bg-[#3B2115]/40 backdrop-blur-sm">
    </div>

    <div id="customConfirmBox"
         class="relative w-full max-w-md scale-95 rounded-3xl bg-white p-6 opacity-0 shadow-2xl transition-all duration-200">

        <div id="customConfirmIcon"
             class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl">
            <i id="customConfirmIconElement"
               class="text-2xl">
            </i>
        </div>

        <div class="mt-5 text-center">

            <p id="customConfirmTitle"
                class="text-lg font-black text-[#3B2115]">
                Konfirmasi
            </p>

            <p id="customConfirmMessage"
               class="mt-2 text-xs leading-5 text-[#8D776A]">
                Apakah kamu yakin ingin melanjutkan?
            </p>

        </div>

        <div class="mt-6 flex gap-3">
            <button type="button"
                    id="customConfirmCancel"
                    class="flex-1 rounded-xl border border-gray-400 bg-white px-4 py-3 text-xs font-bold text-[#8D776A] transition hover:bg-gray-200">
                Batal
            </button>
            <button type="button"
                    id="customConfirmAction"
                    class="flex-1 rounded-xl px-4 py-3 text-xs font-bold text-white shadow-lg transition">
                Ya, Lanjutkan
            </button>
        </div>

    </div>
</div>
