<div id="alert-success"
    class="fixed bottom-5 right-5 z-50 w-[calc(100%-2rem)] max-w-md rounded-2xl border border-green-200 bg-white p-4 shadow-xl transition-all duration-300">
    <div class="flex items-start gap-3">
        <div
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">
            <i class="fa-solid fa-check"></i>
        </div>
        <div class="flex-1">
            <p class="text-sm font-bold text-[#3B2115]">
                Berhasil!
            </p>
            <p class="mt-1 text-xs leading-5 text-[#72594B]">
                {{ session('success') }}
            </p>
        </div>
        <button type="button"
                onclick="closeAlert('alert-success')"
                class="text-slate-400 transition duration-200 hover:text-slate-600"
                aria-label="Tutup notifikasi">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>