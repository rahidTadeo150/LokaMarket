@props([
    'selectedCategory' => null,
    'sort' => 'default'
])

<form
    method="GET"
    action="{{ route('cust.pilihanProduk') }}"
    class="space-y-6"
>

    {{-- Kategori --}}
    <div>

        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">
            Kategori
        </h4>

        <div class="flex flex-wrap items-center gap-2.5">

            {{-- Makanan --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Makanan"
                    @checked($selectedCategory === 'Makanan')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Makanan
                </span>
            </label>


            {{-- Minuman --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Minuman"
                    @checked($selectedCategory === 'Minuman')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Minuman
                </span>
            </label>


            {{-- Fashion --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Fashion"
                    @checked($selectedCategory === 'Fashion')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Fashion
                </span>
            </label>


            {{-- Kerajinan --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Kerajinan"
                    @checked($selectedCategory === 'Kerajinan')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Kerajinan
                </span>
            </label>


            {{-- Sembako --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Sembako"
                    @checked($selectedCategory === 'Sembako')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Sembako
                </span>
            </label>


            {{-- Hasil Bumi --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Hasil Bumi"
                    @checked($selectedCategory === 'Hasil Bumi')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Hasil Bumi
                </span>
            </label>


            {{-- Peternakan --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Peternakan"
                    @checked($selectedCategory === 'Peternakan')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Peternakan
                </span>
            </label>


            {{-- Perikanan --}}
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="category"
                    value="Perikanan"
                    @checked($selectedCategory === 'Perikanan')
                    class="peer sr-only"
                >

                <span
                    class="inline-flex min-h-[36px] items-center justify-center rounded-full border border-[#E9D7C9] bg-white px-3 py-2 text-xs font-semibold text-[#3B2115] shadow-sm transition duration-200 hover:border-[#FFB778] peer-checked:border-[#FF6B00] peer-checked:bg-[#FFF1E5] peer-checked:text-[#C1440E] peer-checked:shadow-md"
                >
                    Perikanan
                </span>
            </label>

        </div>
    </div>


    {{-- Divider --}}
    <div class="border-t border-[#F1DCC8]"></div>


    {{-- Urutkan --}}
    <div>

        <h4 class="mb-3 text-sm font-bold text-[#3B2115]">
            Urutkan
        </h4>

        <select
            name="sort"
            class="w-full rounded-full border border-[#F1DCC8] bg-white px-4 py-3 text-sm text-[#72594B] transition focus:border-[#FF6B00] focus:outline-none focus:ring-2 focus:ring-[#FFD1AD]"
        >

            <option
                value="default"
                @selected($sort === 'default')
            >
                Terbaru
            </option>

            <option
                value="price_low"
                @selected($sort === 'price_low')
            >
                Harga: Terendah
            </option>

            <option
                value="price_high"
                @selected($sort === 'price_high')
            >
                Harga: Tertinggi
            </option>

        </select>

    </div>


    {{-- Button --}}
    <div class="flex gap-2 pt-4">

        <a
            href="{{ route('cust.pilihanProduk') }}"
            class="flex-1 rounded-full border border-[#F1DCC8] bg-white px-3 py-3 text-center text-sm font-semibold text-[#72594B] transition hover:bg-[#FFF0E5]"
        >
            Reset Filter
        </a>

        <button
            type="submit"
            class="flex-1 rounded-full bg-[#FF6B00] px-3 py-3 text-sm font-semibold text-white transition hover:bg-[#E85D00]"
        >
            Terapkan
        </button>

    </div>

</form>