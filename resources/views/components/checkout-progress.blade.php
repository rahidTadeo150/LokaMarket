<nav class="mx-auto mb-7 flex max-w-[540px] items-center text-[9px] font-semibold sm:text-[10px]">

    {{-- Keranjang --}}
    <a href="{{ route('cust.keranjang') }}"
       class="flex items-center gap-2 whitespace-nowrap
       {{ $step >= 1 ? 'text-[#3f2a20]' : 'text-[#9c897d]' }}">

        <span class="flex h-6 w-6 items-center justify-center rounded-full
            {{ $step >= 1
                ? 'bg-[#f36a12] text-white'
                : 'border border-[#f0daca] bg-white' }}">
            1
        </span>

        <span>Keranjang</span>
    </a>


    <span class="mx-3 h-px flex-1 bg-[#f3b27f] sm:mx-5"></span>


    {{-- Checkout --}}
    <a href="{{ route('cust.checkout') }}"
       class="flex items-center gap-2 whitespace-nowrap
       {{ $step >= 2 ? 'text-[#3f2a20]' : 'text-[#9c897d]' }}">

        <span class="flex h-6 w-6 items-center justify-center rounded-full
            {{ $step >= 2
                ? 'bg-[#f36a12] text-white'
                : 'border border-[#f0daca] bg-white' }}">
            2
        </span>

        <span>Checkout</span>
    </a>


    <span class="mx-3 h-px flex-1 bg-[#ead8ca] sm:mx-5"></span>


    {{-- Pembayaran --}}
    <a href="{{ route('cust.invoice') }}"
       class="flex items-center gap-2 whitespace-nowrap
       {{ $step >= 3 ? 'text-[#3f2a20]' : 'text-[#9c897d]' }}">

        <span class="flex h-6 w-6 items-center justify-center rounded-full
            {{ $step >= 3
                ? 'bg-[#f36a12] text-white'
                : 'border border-[#f0daca] bg-white' }}">
            3
        </span>

        <span>Pembayaran</span>
    </a>

</nav>