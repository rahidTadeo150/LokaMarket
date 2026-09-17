@extends('layouts.admin')

@section('title', 'Pengaturan - LokaMarket Admin')

@section('content')
<div class="px-6 py-8 md:px-10">
    
    {{-- Header Halaman --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#3B2115]">Pengaturan</h1>
        <p class="mt-1 text-sm text-[#72594B]">Kelola konfigurasi dan preferensi platform LokaMarket.</p>
    </div>

    {{-- Navigasi Tabs --}}
    <div class="mb-6 flex space-x-6 overflow-x-auto whitespace-nowrap border-b border-[#F3E5D9]">
        <button onclick="openTab('umum')" id="btn-umum" class="tab-btn border-b-2 border-orange-500 pb-3 text-sm font-bold text-orange-600 transition">
            Umum
        </button>
        <button onclick="openTab('biaya')" id="btn-biaya" class="tab-btn border-b-2 border-transparent pb-3 text-sm font-medium text-gray-500 transition hover:text-orange-500">
            Biaya & Komisi
        </button>
        <button onclick="openTab('pembayaran')" id="btn-pembayaran" class="tab-btn border-b-2 border-transparent pb-3 text-sm font-medium text-gray-500 transition hover:text-orange-500">
            Pembayaran
        </button>
        <button onclick="openTab('notifikasi')" id="btn-notifikasi" class="tab-btn border-b-2 border-transparent pb-3 text-sm font-medium text-gray-500 transition hover:text-orange-500">
            Notifikasi
        </button>
        <button onclick="openTab('keamanan')" id="btn-keamanan" class="tab-btn border-b-2 border-transparent pb-3 text-sm font-medium text-gray-500 transition hover:text-orange-500">
            Keamanan
        </button>
        <button onclick="openTab('kebijakan')" id="btn-kebijakan" class="tab-btn border-b-2 border-transparent pb-3 text-sm font-medium text-gray-500 transition hover:text-orange-500">
            Kebijakan Halaman
        </button>
    </div>

    {{-- ========================================== --}}
    {{-- TAB 1: UMUM --}}
    {{-- ========================================== --}}
    <div id="tab-umum" class="tab-content block">
        <div class="mb-6 flex items-center justify-between rounded-2xl border border-[#e5d4c3] bg-[#fcf9f5] p-6 shadow-sm">
            <div>
                <h3 class="text-base font-bold text-[#8c5c36]">Mode Pemeliharaan</h3>
                <p class="mt-1 text-sm text-[#a88a73]">Saat aktif, seluruh platform menampilkan halaman maintenance untuk pengguna dan penjual. Admin tetap bisa mengakses dashboard.</p>
            </div>
            <label class="relative inline-flex cursor-pointer items-center shrink-0">
                <input type="checkbox" class="peer sr-only">
                <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
            </label>
        </div>

        <div class="rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Informasi Platform</h3>
            <p class="mt-1 text-sm text-[#72594B]">Detail ini muncul di halaman publik LokaMarket dan email resmi.</p>

            <form action="#" method="POST" class="mt-6">
                <div class="mb-6 flex items-center gap-4 border-b border-dashed border-gray-200 pb-6">
                    <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-[#EA4F0C] text-white">
                        <i class="fa-solid fa-bag-shopping text-2xl"></i>
                    </div>
                    <div>
                        <button type="button" class="rounded-full border border-orange-400 px-4 py-1.5 text-sm font-semibold text-[#EA4F0C] transition hover:bg-orange-50">Ganti Logo</button>
                        <p class="mt-1 text-xs text-gray-400">PNG dengan latar transparan, maksimal 1MB.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Nama Platform</label>
                        <input type="text" value="LokaMarket" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Tagline</label>
                        <input type="text" value="Pusat UMKM Lokal" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Email Kontak</label>
                        <input type="email" value="admin@lokamarket.id" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Nomor Telepon</label>
                        <input type="text" value="021-5550123" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Zona Waktu</label>
                        <select class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                            <option>WIB (GMT+7)</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Mata Uang</label>
                        <select class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                            <option>IDR (Rp)</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Alamat Kantor</label>
                        <textarea rows="3" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">Jl. Dhoho No. 10, Kediri, Jawa Timur 64129</textarea>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4 border-t border-dashed border-gray-200 pt-6">
                    <button type="button" class="text-sm font-bold text-gray-500 hover:text-gray-700">Batalkan</button>
                    <button type="submit" class="rounded-full bg-[#EA4F0C] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#d4470a]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- TAB 2: BIAYA & KOMISI --}}
    {{-- ========================================== --}}
    <div id="tab-biaya" class="tab-content hidden">
        <div class="rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Biaya & Komisi</h3>
            <p class="mt-1 text-sm text-[#72594B]">Atur potongan platform dari setiap transaksi dan aturan pencairan dana penjual.</p>

            <form action="#" method="POST" class="mt-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Komisi per Transaksi (%)</label>
                        <input type="number" value="5" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Biaya Admin Tetap (Rp)</label>
                        <input type="text" value="1.000" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Minimum Penarikan Dana (Rp)</label>
                        <input type="text" value="50.000" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Jadwal Pencairan Otomatis</label>
                        <select class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                            <option>Mingguan</option>
                            <option>Bulanan</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4 border-t border-dashed border-gray-200 pt-6">
                    <button type="button" class="text-sm font-bold text-gray-500 hover:text-gray-700">Batalkan</button>
                    <button type="submit" class="rounded-full bg-[#EA4F0C] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#d4470a]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- TAB 3: PEMBAYARAN --}}
    {{-- ========================================== --}}
    <div id="tab-pembayaran" class="tab-content hidden">
        <div class="rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Metode Pembayaran</h3>
            <p class="mt-1 text-sm text-[#72594B]">Aktifkan atau nonaktifkan channel pembayaran yang tersedia untuk pembeli.</p>

            <div class="mt-6 flex flex-col gap-4">
                {{-- Item 1 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-500">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">Transfer Bank</p>
                            <p class="text-xs text-gray-500">BCA, Mandiri, BRI, BNI</p>
                        </div>
                    </div>
                    <label class="relative inline-flex cursor-pointer items-center shrink-0">
                        <input type="checkbox" class="peer sr-only" checked>
                        <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                {{-- Item 2 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-500">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">GoPay</p>
                            <p class="text-xs text-gray-500">E-wallet</p>
                        </div>
                    </div>
                    <label class="relative inline-flex cursor-pointer items-center shrink-0">
                        <input type="checkbox" class="peer sr-only" checked>
                        <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                {{-- Item 3 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 text-purple-500">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">OVO</p>
                            <p class="text-xs text-gray-500">E-wallet</p>
                        </div>
                    </div>
                    <label class="relative inline-flex cursor-pointer items-center shrink-0">
                        <input type="checkbox" class="peer sr-only" checked>
                        <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                {{-- Item 4 (Disabled) --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50 text-orange-500">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">DANA</p>
                            <p class="text-xs text-gray-500">E-wallet</p>
                        </div>
                    </div>
                    <label class="relative inline-flex cursor-pointer items-center shrink-0">
                        <input type="checkbox" class="peer sr-only">
                        <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                {{-- Item 5 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-500">
                            <i class="fa-solid fa-qrcode"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">QRIS</p>
                            <p class="text-xs text-gray-500">Semua e-wallet & bank pendukung QRIS</p>
                        </div>
                    </div>
                    <label class="relative inline-flex cursor-pointer items-center shrink-0">
                        <input type="checkbox" class="peer sr-only" checked>
                        <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>
                
                <button type="button" class="mt-2 w-full rounded-xl border border-dashed border-gray-300 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-50 hover:text-gray-700">
                    + Tambah Metode Pembayaran
                </button>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- TAB 4: NOTIFIKASI --}}
    {{-- ========================================== --}}
    <div id="tab-notifikasi" class="tab-content hidden">
        <div class="rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Notifikasi Admin</h3>
            <p class="mt-1 text-sm text-[#72594B]">Pilih peristiwa yang perlu langsung diketahui tim admin.</p>

            <form action="#" method="POST" class="mt-6">
                
                {{-- Penjual Section --}}
                <p class="mb-4 text-xs font-bold uppercase tracking-wider text-gray-400">Penjual</p>
                <div class="mb-6 flex flex-col gap-5 border-b border-dashed border-gray-200 pb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-[#3B2115]">Penjual baru mendaftar</p>
                            <p class="text-sm text-gray-500">Notifikasi saat ada toko baru yang mendaftar.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center shrink-0">
                            <input type="checkbox" class="peer sr-only" checked>
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-[#3B2115]">Toko diajukan untuk direview</p>
                            <p class="text-sm text-gray-500">Toko baru menunggu verifikasi sebelum aktif berjualan.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center shrink-0">
                            <input type="checkbox" class="peer sr-only" checked>
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                        </label>
                    </div>
                </div>

                {{-- Produk Section --}}
                <p class="mb-4 text-xs font-bold uppercase tracking-wider text-gray-400">Produk</p>
                <div class="mb-6 flex flex-col gap-5 border-b border-dashed border-gray-200 pb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-[#3B2115]">Produk dilaporkan pengguna</p>
                            <p class="text-sm text-gray-500">Ada laporan produk yang dianggap melanggar aturan.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center shrink-0">
                            <input type="checkbox" class="peer sr-only" checked>
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-[#3B2115]">Stok produk kritis secara massal</p>
                            <p class="text-sm text-gray-500">Banyak produk kehabisan stok dalam waktu bersamaan.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center shrink-0">
                            <input type="checkbox" class="peer sr-only">
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                        </label>
                    </div>
                </div>

                {{-- Transaksi Section --}}
                <p class="mb-4 text-xs font-bold uppercase tracking-wider text-gray-400">Transaksi</p>
                <div class="mb-6 flex flex-col gap-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-[#3B2115]">Pesanan bermasalah / dispute</p>
                            <p class="text-sm text-gray-500">Pembeli dan penjual berselisih soal pesanan.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center shrink-0">
                            <input type="checkbox" class="peer sr-only" checked>
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-[#3B2115]">Permintaan refund diajukan</p>
                            <p class="text-sm text-gray-500">Ada pengajuan pengembalian dana yang perlu ditinjau.</p>
                        </div>
                        <label class="relative inline-flex cursor-pointer items-center shrink-0">
                            <input type="checkbox" class="peer sr-only" checked>
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4 border-t border-dashed border-gray-200 pt-6">
                    <button type="button" class="text-sm font-bold text-gray-500 hover:text-gray-700">Batalkan</button>
                    <button type="submit" class="rounded-full bg-[#EA4F0C] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#d4470a]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- TAB 5: KEAMANAN --}}
    {{-- ========================================== --}}
    <div id="tab-keamanan" class="tab-content hidden">
        
        {{-- Ganti Kata Sandi --}}
        <div class="mb-6 rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Kata Sandi Admin</h3>
            <p class="mt-1 text-sm text-[#72594B]">Gunakan kata sandi yang kuat dan unik untuk akun admin.</p>

            <form action="#" method="POST" class="mt-6">
                <div class="mb-4">
                    <label class="mb-2 block text-sm font-bold text-[#3B2115]">Kata Sandi Saat Ini</label>
                    <div class="relative">
                        <input type="password" value="password123" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 pr-10 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Kata Sandi Baru</label>
                        <div class="relative">
                            <input type="password" placeholder="Minimal 8 karakter" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 pr-10 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#3B2115]">Konfirmasi Kata Sandi Baru</label>
                        <div class="relative">
                            <input type="password" placeholder="Ulangi kata sandi baru" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 pr-10 text-sm text-[#3B2115] outline-none focus:border-[#EA4F0C]">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-4 border-t border-dashed border-gray-200 pt-6">
                    <button type="button" class="text-sm font-bold text-gray-500 hover:text-gray-700">Batalkan</button>
                    <button type="submit" class="rounded-full bg-[#EA4F0C] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#d4470a]">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        {{-- Verifikasi Dua Langkah --}}
        <div class="mb-6 flex items-center justify-between rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <div>
                <h3 class="text-lg font-bold text-[#3B2115]">Verifikasi Dua Langkah</h3>
                <p class="mt-1 text-sm text-[#72594B]">Tambahan keamanan berupa kode OTP saat login dari perangkat baru.</p>
                <div class="mt-4">
                    <p class="font-bold text-[#3B2115]">Aktifkan 2FA untuk akun admin</p>
                    <p class="text-sm text-gray-500">Kode OTP dikirim ke email admin@lokamarket.id.</p>
                </div>
            </div>
            <label class="relative mt-8 inline-flex cursor-pointer items-center shrink-0 self-end">
                <input type="checkbox" class="peer sr-only" checked>
                <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-[#EA4F0C] peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
            </label>
        </div>

        {{-- Log Aktivitas Login --}}
        <div class="rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Log Aktivitas Login</h3>
            <p class="mt-1 mb-4 text-sm text-[#72594B]">Riwayat akses ke dashboard admin dalam 30 hari terakhir.</p>

            <div class="flex flex-col">
                <div class="flex items-start gap-4 border-b border-gray-100 py-4">
                    <i class="fa-solid fa-desktop mt-1 text-gray-400"></i>
                    <div>
                        <p class="font-bold text-[#3B2115]">Login berhasil <span class="font-normal text-gray-400">· Chrome, Windows</span></p>
                        <p class="text-xs text-gray-500">Kediri, Jawa Timur · 5 menit lalu</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 border-b border-gray-100 py-4">
                    <i class="fa-solid fa-mobile-screen mt-1 text-gray-400"></i>
                    <div>
                        <p class="font-bold text-[#3B2115]">Login berhasil <span class="font-normal text-gray-400">· Safari, iPhone</span></p>
                        <p class="text-xs text-gray-500">Surabaya, Jawa Timur · Kemarin, 19:42</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 py-4">
                    <i class="fa-solid fa-desktop mt-1 text-gray-400"></i>
                    <div>
                        <p class="font-bold text-[#3B2115]">Percobaan login gagal</p>
                        <p class="text-xs text-gray-500">IP tidak dikenal · 3 hari lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- TAB 6: KEBIJAKAN HALAMAN --}}
    {{-- ========================================== --}}
    <div id="tab-kebijakan" class="tab-content hidden">
        <div class="rounded-2xl border border-[#F3E5D9] bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#3B2115]">Kebijakan & Halaman Informasi</h3>
            <p class="mt-1 text-sm text-[#72594B]">Kelola konten legal dan panduan yang tampil di platform LokaMarket.</p>

            <div class="mt-6 flex flex-col gap-4">
                {{-- Item 1 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-400">
                            <i class="fa-regular fa-file-lines text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">Syarat & Ketentuan</p>
                            <p class="text-xs text-gray-500">Terakhir diperbarui: 12 Agustus 2026</p>
                        </div>
                    </div>
                    <button class="rounded-full border border-orange-400 px-5 py-1.5 text-sm font-semibold text-orange-500 transition hover:bg-orange-50">
                        Edit
                    </button>
                </div>
                
                {{-- Item 2 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-400">
                            <i class="fa-regular fa-file-lines text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">Kebijakan Privasi</p>
                            <p class="text-xs text-gray-500">Terakhir diperbarui: 12 Agustus 2026</p>
                        </div>
                    </div>
                    <button class="rounded-full border border-orange-400 px-5 py-1.5 text-sm font-semibold text-orange-500 transition hover:bg-orange-50">
                        Edit
                    </button>
                </div>

                {{-- Item 3 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-500">
                            <i class="fa-regular fa-file-lines text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">Panduan Penjual</p>
                            <p class="text-xs text-gray-500">Terakhir diperbarui: 3 Juli 2026</p>
                        </div>
                    </div>
                    <button class="rounded-full border border-orange-400 px-5 py-1.5 text-sm font-semibold text-orange-500 transition hover:bg-orange-50">
                        Edit
                    </button>
                </div>

                {{-- Item 4 --}}
                <div class="flex items-center justify-between rounded-xl border border-gray-100 p-4 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-400">
                            <i class="fa-regular fa-file-lines text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-[#3B2115]">FAQ Umum</p>
                            <p class="text-xs text-gray-500">Terakhir diperbarui: 20 Juni 2026</p>
                        </div>
                    </div>
                    <button class="rounded-full border border-orange-400 px-5 py-1.5 text-sm font-semibold text-orange-500 transition hover:bg-orange-50">
                        Edit
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- SCRIPT UNTUK TAB GANTI HALAMAN --}}
<script>
    function openTab(tabName) {
        // 1. Sembunyikan semua konten tab
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.remove('block');
            content.classList.add('hidden');
        });

        // 2. Reset style semua tombol tab (jadikan abu-abu)
        const buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-orange-500', 'text-orange-600', 'font-bold');
            btn.classList.add('border-transparent', 'text-gray-500', 'font-medium');
        });

        // 3. Tampilkan konten yang dipilih
        document.getElementById('tab-' + tabName).classList.remove('hidden');
        document.getElementById('tab-' + tabName).classList.add('block');

        // 4. Ubah style tombol yang aktif (jadikan oranye)
        const activeBtn = document.getElementById('btn-' + tabName);
        activeBtn.classList.remove('border-transparent', 'text-gray-500', 'font-medium');
        activeBtn.classList.add('border-orange-500', 'text-orange-600', 'font-bold');
    }
</script>
@endsection