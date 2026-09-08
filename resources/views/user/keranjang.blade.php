<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<title>Keranjang Belanja - LokaMarket</title>
</head>
<body class="min-h-screen bg-[#fffaf5] font-poppins text-[#3f2a20]">
	<header class="border-b border-[#f0dfd1] bg-white">
		<div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:h-[70px] sm:px-8">
			<a href="{{ route('cust.landingPage') }}" aria-label="Kembali ke LokaMarket"><img src="{{ asset('storage/logo-lokamarket.png') }}" alt="LokaMarket" class="h-10 w-auto object-contain sm:h-11"></a>
			<a href="{{ route('cust.caraKerja') }}" class="text-[10px] font-medium text-[#6e5b51] transition hover:text-[#d94d0b] sm:text-[11px]">Butuh bantuan?</a>
		</div>
	</header>

	<main class="mx-auto max-w-6xl px-4 py-7 sm:px-8 sm:py-10">
		<nav aria-label="Progress checkout" class="mx-auto mb-7 flex max-w-[540px] items-center text-[9px] font-semibold sm:text-[10px]">
			<div class="flex items-center gap-2 whitespace-nowrap text-[#3f2a20]"><span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#f36a12] text-white">1</span><span>Keranjang</span></div>
			<span class="mx-3 h-px flex-1 bg-[#f3b27f] sm:mx-5"></span>
			<a href="{{ route('cust.checkout') }}" class="flex items-center gap-2 whitespace-nowrap text-[#9c897d]"><span class="flex h-6 w-6 items-center justify-center rounded-full border border-[#f0daca] bg-white">2</span><span>Checkout</span></a>
			<span class="mx-3 h-px flex-1 bg-[#ead8ca] sm:mx-5"></span>
			<div class="flex items-center gap-2 whitespace-nowrap text-[#9c897d]"><span class="flex h-6 w-6 items-center justify-center rounded-full border border-[#f0daca] bg-white">3</span><span>Pembayaran</span></div>
		</nav>

		<div class="mx-auto max-w-[470px]">
			<div class="mb-4 flex items-end justify-between">
				<div><h1 class="text-2xl font-extrabold tracking-tight text-[#3d281e] sm:text-3xl">Keranjang Belanja</h1><p class="mt-1 text-[10px] text-[#806e64] sm:text-[11px]">Periksa produk pilihanmu sebelum lanjut ke checkout.</p></div>
				<span id="productCount" class="pb-1 text-[10px] text-[#917c70]">3 produk</span>
			</div>

			<section class="rounded-2xl border border-[#f0dfd1] bg-white px-5 py-4 shadow-[0_12px_35px_rgba(92,48,20,0.04)] sm:px-6">
				<div class="flex items-center justify-between border-b border-[#f3e8e0] pb-3 text-[11px]">
					<label class="flex cursor-pointer items-center gap-2 font-bold text-[#493329]"><input id="selectAll" type="checkbox" checked class="cart-check accent-[#cb4b14]"> Pilih Semua</label>
					<button id="removeSelected" type="button" class="text-[#9b8275] transition hover:text-[#d94d0b]">Hapus Terpilih <i class="fa-regular fa-trash-can ml-1"></i></button>
				</div>

				<div class="cart-shop border-b border-[#f3e8e0] py-3" data-shop="Geprek Bu Sri">
					<div class="mb-3 flex items-center gap-2 text-[11px] font-bold"><input type="checkbox" checked class="cart-check shop-check accent-[#cb4b14]"><i class="fa-solid fa-store text-[#846f63]"></i> Warung Bu Sri <i class="fa-solid fa-circle-check text-[10px] text-[#558d58]"></i></div>
					<div class="cart-item flex items-center gap-3 py-1.5" data-price="12000">
						<input type="checkbox" checked class="cart-check item-check accent-[#cb4b14]">
						<div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#ee6d1d] text-xl">🍱</div>
						<div class="min-w-0 flex-1"><p class="truncate text-[10px] font-bold text-[#4b3429]">Geprek Ori</p><p class="text-[9px] text-[#9c877c]">Porsi Sedang</p><p class="text-[10px] font-extrabold text-[#c9470e]">Rp 12.000</p></div>
						<div class="quantity-control flex h-6 items-center overflow-hidden rounded-full border border-[#f0d6c4] text-[10px]" data-quantity="1"><button type="button" class="quantity-minus w-7 text-[#b97b5d]">-</button><span class="quantity-value w-6 text-center font-bold">1</span><button type="button" class="quantity-plus w-7 text-[#c9470e]">+</button></div><button type="button" class="remove-item ml-1 text-[#a38e82] hover:text-[#d94d0b]" aria-label="Hapus Geprek Ori"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
					</div>
					<div class="cart-item flex items-center gap-3 py-1.5" data-price="8000">
						<input type="checkbox" checked class="cart-check item-check accent-[#cb4b14]"><div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#f5eee8] text-xl">🍲</div><div class="min-w-0 flex-1"><p class="truncate text-[10px] font-bold text-[#4b3429]">Es pisang hijau</p><p class="text-[9px] text-[#9c877c]">250 gr</p><p class="text-[10px] font-extrabold text-[#c9470e]">Rp 8.000</p></div><div class="quantity-control flex h-6 items-center overflow-hidden rounded-full border border-[#f0d6c4] text-[10px]" data-quantity="1"><button type="button" class="quantity-minus w-7 text-[#b97b5d]">-</button><span class="quantity-value w-6 text-center font-bold">1</span><button type="button" class="quantity-plus w-7 text-[#c9470e]">+</button></div><button type="button" class="remove-item ml-1 text-[#a38e82] hover:text-[#d94d0b]" aria-label="Hapus Es pisang hijau"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
					</div>
				</div>

				<div class="cart-shop border-b border-[#f3e8e0] py-3" data-shop="Kerajinan Lokal">
					<div class="mb-3 flex items-center gap-2 text-[11px] font-bold"><input type="checkbox" checked class="cart-check shop-check accent-[#cb4b14]"><i class="fa-solid fa-store text-[#846f63]"></i> Kerajinan Lokal <i class="fa-solid fa-circle-check text-[10px] text-[#558d58]"></i></div>
					<div class="cart-item flex items-center gap-3 py-1.5" data-price="45000">
						<input type="checkbox" checked class="cart-check item-check accent-[#cb4b14]"><div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#4d804e] text-xl">🧺</div><div class="min-w-0 flex-1"><p class="truncate text-[10px] font-bold text-[#4b3429]">Tas Anyaman Bambu</p><p class="text-[9px] text-[#9c877c]">Warna Natural</p><p class="text-[10px] font-extrabold text-[#c9470e]">Rp 45.000</p></div><div class="quantity-control flex h-6 items-center overflow-hidden rounded-full border border-[#f0d6c4] text-[10px]" data-quantity="1"><button type="button" class="quantity-minus w-7 text-[#b97b5d]">-</button><span class="quantity-value w-6 text-center font-bold">1</span><button type="button" class="quantity-plus w-7 text-[#c9470e]">+</button></div><button type="button" class="remove-item ml-1 text-[#a38e82] hover:text-[#d94d0b]" aria-label="Hapus Tas Anyaman Bambu"><i class="fa-regular fa-trash-can text-[11px]"></i></button>
					</div>
				</div>

				<div class="pt-3">
					<h2 class="text-[11px] font-extrabold">Ringkasan Belanja</h2>
					<dl class="mt-2 space-y-1 text-[9px] text-[#78655b]"><div class="flex justify-between"><dt>Subtotal (3 produk)</dt><dd id="subtotal" class="font-bold text-[#4b3429]">Rp 65.000</dd></div><div class="flex justify-between"><dt>Ongkos Kirim</dt><dd class="font-bold text-[#4b3429]">Estimasi di checkout</dd></div><div class="flex justify-between"><dt>Diskon Voucher</dt><dd class="font-bold text-[#4b3429]">-Rp 0</dd></div></dl>
					<div class="mt-3 flex items-center gap-2 rounded-lg bg-[#fff8f1] px-3 py-2"><i class="fa-solid fa-ticket text-[10px] text-[#da5a17]"></i><input id="voucher" type="text" placeholder="Masukkan kode voucher" class="min-w-0 flex-1 bg-transparent text-[9px] outline-none placeholder:text-[#a99487]"><button type="button" id="applyVoucher" class="text-[9px] font-bold text-[#d34c10]">Pakai</button></div>
					<div class="mt-3 flex items-center justify-between border-t border-[#f3e8e0] pt-3"><span class="text-[11px] font-extrabold">Total</span><strong id="total" class="text-sm font-extrabold text-[#d94d0b]">Rp 65.000</strong></div>
					<a href="{{ route('cust.checkout') }}" id="checkoutButton" class="mt-4 flex h-9 w-full items-center justify-center rounded-full bg-[#e9520d] text-[10px] font-bold text-white shadow-sm transition hover:bg-[#cf4609]">Lanjut ke Checkout</a>
					<div class="mt-2 text-center text-[9px] text-[#a38e82]">atau</div><a href="{{ route('cust.pilihanProduk') }}" class="mt-1 block text-center text-[9px] font-bold text-[#d94d0b]">Lanjutkan Belanja</a>
				</div>
			</section>
		</div>
	</main>

	<script>
		const money = value => 'Rp ' + value.toLocaleString('id-ID');
		const allChecks = () => [...document.querySelectorAll('.item-check')];
		const updateSummary = () => {
			let subtotal = 0;
			allChecks().forEach(item => { if (item.checked) subtotal += Number(item.closest('.cart-item').dataset.price) * Number(item.closest('.cart-item').querySelector('.quantity-control').dataset.quantity); });
			document.querySelector('#subtotal').textContent = money(subtotal);
			document.querySelector('#total').textContent = money(subtotal);
			document.querySelector('#productCount').textContent = allChecks().filter(item => item.checked).length + ' produk';
			document.querySelector('#selectAll').checked = allChecks().length > 0 && allChecks().every(item => item.checked);
		};
		document.querySelector('#selectAll').addEventListener('change', event => document.querySelectorAll('.cart-check').forEach(check => check.checked = event.target.checked));
		document.querySelectorAll('.shop-check').forEach(shopCheck => shopCheck.addEventListener('change', event => event.target.closest('.cart-shop').querySelectorAll('.item-check').forEach(check => check.checked = event.target.checked)));
		document.querySelectorAll('.item-check').forEach(check => check.addEventListener('change', updateSummary));
		document.querySelectorAll('.quantity-control').forEach(control => control.addEventListener('click', event => { const step = event.target.closest('button'); if (!step) return; let quantity = Number(control.dataset.quantity) + (step.classList.contains('quantity-plus') ? 1 : -1); quantity = Math.max(1, quantity); control.dataset.quantity = quantity; control.querySelector('.quantity-value').textContent = quantity; updateSummary(); }));
		document.querySelectorAll('.remove-item').forEach(button => button.addEventListener('click', () => { button.closest('.cart-item').remove(); updateSummary(); }));
		document.querySelector('#removeSelected').addEventListener('click', () => { document.querySelectorAll('.item-check:checked').forEach(check => check.closest('.cart-item').remove()); updateSummary(); });
		document.querySelector('#applyVoucher').addEventListener('click', event => { const input = document.querySelector('#voucher'); event.target.textContent = input.value.trim() ? 'Terpasang' : 'Pakai'; });
	</script>
</body>
</html>
