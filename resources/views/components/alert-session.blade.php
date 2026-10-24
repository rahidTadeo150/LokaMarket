@if (session('success') || session('error'))

@php
    $isSuccess = session('success');
    $message = session('success') ?? session('error');
@endphp

<div id="session-alert"
    class="mb-6 flex items-center gap-3 rounded-xl border px-4 py-3 shadow-sm transition-all duration-300
        {{ $isSuccess ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">

    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $isSuccess ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
        <i class="fa-solid {{ $isSuccess ? 'fa-check' : 'fa-xmark' }} text-sm"></i>
    </div>

    <div class="min-w-0 flex-1">
        <p class="text-sm font-bold {{ $isSuccess ? 'text-green-700' : 'text-red-700' }}">
            {{ $isSuccess ? 'Berhasil' : 'Gagal' }}
        </p>
        <p class="mt-0.5 text-xs {{ $isSuccess ? 'text-green-600' : 'text-red-600' }}">
            {{ $message }}
        </p>
    </div>

    <button type="button"
            id="close-session-alert"
            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full transition
            {{ $isSuccess ? 'text-green-500 hover:bg-green-100 hover:text-green-700' : 'text-red-500 hover:bg-red-100 hover:text-red-700' }}"
            aria-label="Tutup notifikasi">
        <i class="fa-solid fa-xmark text-xs"></i>
    </button>

</div>

@endif