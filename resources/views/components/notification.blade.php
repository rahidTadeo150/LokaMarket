
@props([
    'prefix' => 'seller',
    'notifikasi' => null,
    'jumlahBelumDibaca' => 0,
])

@php
    $notifikasi = $notifikasi ?? collect();
@endphp

<div class="relative" id="notificationWrapper">

    <button type="button"
            id="notificationButton"
            aria-expanded="false"
            aria-controls="notificationDropdown"
            class="relative flex h-9 w-9 items-center justify-center rounded-full text-[#72594B] transition hover:bg-[#FFF3E5] hover:text-[#E85D04]">

        <i class="fa-regular fa-bell text-sm"></i>

        @if ($jumlahBelumDibaca > 0)
            <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-[#E85D04] px-1 text-[10px] font-bold leading-none text-white">
                {{ $jumlahBelumDibaca > 99 ? '99+' : $jumlahBelumDibaca }}
            </span>
        @endif

    </button>

    <div id="notificationDropdown"
        class="absolute right-0 top-12 z-50 hidden w-[370px] max-w-[calc(100vw-2rem)] overflow-hidden rounded-2xl border border-[#F1DCC8] bg-white shadow-2xl shadow-[#3B2115]/10">

        <div class="border-b border-[#F5E9DF] bg-gradient-to-r from-[#FFF9F2] to-white px-5 py-4">

            <div class="flex items-center justify-between gap-3">

                <div>

                    <div class="flex items-center gap-2">

                        <h3 class="text-sm font-bold text-[#3B2115]">
                            Notifikasi
                        </h3>

                        @if ($jumlahBelumDibaca > 0)
                            <span class="rounded-full bg-[#FFF0DE] px-2 py-0.5 text-[9px] font-bold text-[#E85D04]">
                                {{ $jumlahBelumDibaca > 99 ? '99+' : $jumlahBelumDibaca }} Baru
                            </span>
                        @endif

                    </div>

                    <p class="mt-1 text-[10px] text-[#A58C7D]">
                        Informasi terbaru aktivitas akun Anda
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFF0DE] text-[#E85D04]">
                    <i class="fa-regular fa-bell text-base"></i>
                </div>

            </div>

            @if ($notifikasi->isNotEmpty())

                <div class="mt-4 flex items-center justify-between gap-2">

                    @if ($jumlahBelumDibaca > 0)

                        <form action="{{ route($prefix . '.notifikasi.readAll') }}"
                            method="POST">

                            @csrf

                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-2 text-[10px] font-bold text-[#E85D04] transition hover:bg-[#FFF0DE]">

                                <i class="fa-solid fa-check-double"></i>
                                Baca semua

                            </button>

                        </form>

                    @else

                        <span class="text-[10px] font-medium text-[#A58C7D]">
                            Semua notifikasi sudah dibaca
                        </span>

                    @endif

                    <form id="deleteAllNotificationsForm"
                        action="{{ route($prefix . '.notifikasi.deleteAll') }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="button"
                                data-confirm
                                data-form="deleteAllNotificationsForm"
                                data-theme="red"
                                data-title="Hapus Semua Notifikasi?"
                                data-message="Semua notifikasi Anda akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan."
                                data-confirm-text="Ya, Hapus Semua"
                                data-icon="fa-solid fa-trash"
                                class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-2 text-[10px] font-bold text-red-500 transition hover:bg-red-50">

                            <i class="fa-regular fa-trash-can"></i>
                            Hapus semua

                        </button>

                    </form>

                </div>

            @endif

        </div>

        <div class="max-h-[390px] overflow-y-auto">

            @forelse ($notifikasi as $item)

                <div class="relative flex gap-3 border-b border-[#F8F0E9] px-5 py-4 transition hover:bg-[#FFFAF5] {{ $item->read_at ? 'bg-white' : 'bg-[#FFF9F2]' }}">

                    <div class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $item->read_at ? 'bg-[#F5F0EC] text-[#967D6D]' : 'bg-[#FFF0DE] text-[#E85D04]' }}">
                        <i class="fa-solid {{ $item->data['icon'] ?? 'fa-bell' }} text-sm"></i>
                    </div>

                    <div class="min-w-0 flex-1">

                        <div class="flex items-start justify-between gap-2">

                            <p class="text-xs font-bold leading-relaxed text-[#3B2115]">
                                {{ $item->data['judul'] ?? 'Notifikasi' }}
                            </p>

                            @if (!$item->read_at)
                                <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-[#E85D04]"></span>
                            @endif

                        </div>

                        <p class="mt-1 text-[11px] leading-relaxed text-[#72594B]">
                            {{ $item->data['pesan'] ?? '' }}
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-1.5 text-[9px] text-[#A58C7D]">

                            <i class="fa-regular fa-clock"></i>

                            <span>
                                {{ $item->created_at->diffForHumans() }}
                            </span>

                            @if (!$item->read_at)
                                <span class="ml-1 rounded-full bg-[#FFF0DE] px-2 py-0.5 font-semibold text-[#E85D04]">
                                    Belum dibaca
                                </span>
                            @else
                                <span class="ml-1 text-[#8A7467]">
                                    Sudah dibaca
                                </span>
                            @endif

                        </div>

                    </div>

                </div>
            @empty
                <div class="px-6 py-12 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FFF5EA]">
                        <i class="fa-regular fa-bell-slash text-2xl text-[#D9BCA5]"></i>
                    </div>

                    <h4 class="mt-4 text-xs font-bold text-[#3B2115]">
                        Belum Ada Notifikasi
                    </h4>

                    <p class="mx-auto mt-1 max-w-[220px] text-[10px] leading-relaxed text-[#A58C7D]">
                        Semua informasi pesanan, ulasan, dan aktivitas akun Anda akan muncul di sini.
                    </p>

                </div>
            @endforelse

        </div>

        @if ($notifikasi->isNotEmpty())
            <div class="border-t border-[#F5E9DF] bg-[#FFFCF9] px-5 py-3">
                <p class="text-center text-[9px] text-[#A58C7D]">
                    Menampilkan {{ $notifikasi->count() }} notifikasi terbaru
                </p>
            </div>
        @endif

    </div>

</div>
