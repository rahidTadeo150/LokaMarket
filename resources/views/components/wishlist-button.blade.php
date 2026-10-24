@props([
    'produk',
    'isWishlisted' => false,
])

<div class="absolute right-4 top-4 z-10">
    @auth
        <form action="{{ route('cust.wishlist.toggle', $produk->slug) }}"
            method="POST"
            class="wishlist-form">

            @csrf

            <button type="submit"
                    data-wishlisted="{{ $isWishlisted ? 'true' : 'false' }}"
                    aria-label="{{ $isWishlisted ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}"
                    aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}"
                    class="wishlist-button flex {{ request()->routeIs('cust.detailProduk') ? 'h-11 w-11' : 'h-8 w-8' }} items-center justify-center rounded-full bg-white/95 shadow-md transition-all duration-200 hover:scale-110 hover:bg-orange-50 {{ $isWishlisted ? 'text-orange-500' : 'text-[#DCCBC0]' }}">
                <i class="{{ $isWishlisted ? 'fa-solid' : 'fa-regular' }} fa-heart {{ request()->routeIs('cust.detailProduk') ? 'text-lg' : 'text-sm' }}"></i>
            </button>
        </form>
    @else
        <a href="{{ route('cust.login') }}"
            aria-label="Login untuk menambahkan wishlist"
            class="flex h-11 w-11 items-center justify-center rounded-full bg-white/95 text-[#DCCBC0] shadow-md transition-all duration-200 hover:scale-110 hover:bg-orange-50">
            <i class="fa-regular fa-heart text-lg"></i>
        </a>
    @endauth
</div>