@props([
    'provinsi' => [],
    'selectedProvinsi' => old('provinsi'),
    'selectedKota' => old('kota'),
    'selectedKecamatan' => old('kecamatan'),
])

<div>

    <label class="mb-2 block text-sm font-bold text-[#3B2115]">
        Lokasi Toko
        <span class="text-red-500">*</span>
    </label>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        <div>

            <label for="provinsi"
                class="mb-2 block text-xs font-semibold text-[#72594B]">
                Provinsi
            </label>

            <div class="relative">
                <i class="fa-solid fa-map absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>

                <select id="provinsi"
                        name="provinsi"
                        class="w-full appearance-none rounded-xl border border-[#EEDDD0] bg-[#FFFCF9] py-3.5 pl-11 pr-10 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100">

                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinsi ?? [] as $item)
                        <option
                            value="{{ $item->id }}"
                            {{ old('provinsi') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach

                </select>

                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#B49D8E]"></i>

            </div>

            <p id="provinsi-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>

        </div>

        <div>

            <label for="kota"
                class="mb-2 block text-xs font-semibold text-[#72594B]">
                Kota / Kabupaten
            </label>

            <div class="relative">

                <i class="fa-solid fa-city absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>

                <select id="kota"
                        name="kota"
                        disabled
                        class="w-full appearance-none rounded-xl border border-[#EEDDD0] bg-[#F8F3EF] py-3.5 pl-11 pr-10 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100 disabled:cursor-not-allowed disabled:text-[#A89588]">
                    <option value="">Pilih Kota / Kabupaten</option>
                </select>

                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#B49D8E]"></i>

            </div>

            <p id="kota-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>

        </div>

        <div>

            <label for="kecamatan"
                class="mb-2 block text-xs font-semibold text-[#72594B]">
                Kecamatan
            </label>

            <div class="relative">
                <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-sm text-[#B49D8E]"></i>

                <select id="kecamatan"
                        name="kecamatan"
                        disabled
                        class="w-full appearance-none rounded-xl border border-[#EEDDD0] bg-[#F8F3EF] py-3.5 pl-11 pr-10 text-sm text-[#3B2115] outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100 disabled:cursor-not-allowed disabled:text-[#A89588]">
                    <option value="">Pilih Kecamatan</option>
                </select>

                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#B49D8E]"></i>

            </div>

            <p id="kecamatan-error" class="mt-2 hidden text-xs font-medium text-red-500"></p>

        </div>

    </div>

</div>