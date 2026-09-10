@extends('layouts.seller')

@section('title', 'Kelola Toko - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#faf9f7] text-[#3b2115]">

	<div class="mx-auto max-w-7xl space-y-5 px-5 py-5 lg:px-8 lg:py-6">
		<section class="relative">
			<div class="relative h-28 overflow-hidden rounded-xl bg-gradient-to-r from-[#c94b12] via-[#e95708] to-[#f66b08] shadow-sm sm:h-32">
				<div class="absolute -left-5 -top-16 h-32 w-32 rounded-full bg-white/10"></div>
				<button type="button" class="absolute right-3 top-3 rounded-full bg-white px-4 py-1.5 text-[9px] font-bold text-[#e85d04] transition hover:bg-orange-50">Ganti Sampul</button>
			</div>
			<div class="flex flex-col gap-4 border-b border-orange-100 bg-white px-3 pb-4 pt-3 sm:flex-row sm:items-center sm:justify-between sm:px-5">
				<div class="flex min-w-0 items-center gap-3 sm:gap-4">
				<div class="relative -mt-10 flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 border-white bg-gradient-to-br from-[#ff8a00] to-[#ffae22] text-lg font-extrabold text-white shadow-md sm:-mt-11 sm:h-20 sm:w-20">
					WS
					<button type="button" aria-label="Edit foto profil" class="absolute bottom-0 right-0 flex h-5 w-5 items-center justify-center rounded-full border border-white bg-white text-[9px] text-[#e85d04] shadow-sm"><i class="fa-solid fa-pen"></i></button>
				</div>
				<div class="min-w-0">
					<div class="flex items-center gap-2">
						<h2 class="truncate text-base font-extrabold sm:text-lg">Warung Bu Sri</h2>
						<span class="flex h-4 w-4 items-center justify-center rounded-full bg-green-600 text-[8px] text-white"><i class="fa-solid fa-check"></i></span>
					</div>
					<p class="truncate text-[9px] text-[#8c7467]">Kediri, Jawa Timur · Bergabung Jan 2022</p>
				</div>
			</div>
			<button type="button" class="self-start rounded-full bg-[#ff9d0a] px-4 py-2 text-[10px] font-bold text-white shadow-sm transition hover:bg-[#e85d04] sm:self-auto">Edit Profil Toko</button>
			</div>
		</section>

		<section class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">
			<h2 class="mb-4 text-sm font-bold">Informasi Toko</h2>
			<div class="grid grid-cols-1 gap-x-8 sm:grid-cols-2">
				@foreach ([['Nama Toko', 'Warung Bu Sri'], ['Kategori Utama', 'Makanan & Minuman'], ['No. Telepon', '0812-3456-7890'], ['Email Toko', 'warungbusri@email.com'], ['Alamat', 'Jl. Dhoho No. 45, Kediri'], ['Jam Operasional', '08.00 - 20.00 WIB']] as $detail)
					<div class="border-b border-orange-100 py-3 last:border-b-0 sm:[&:nth-last-child(-n+2)]:border-b-0 {{ $loop->first || $loop->index === 1 ? 'pt-0' : '' }}">
						<p class="text-[9px] font-semibold text-[#a58c7d]">{{ $detail[0] }}</p>
						<p class="mt-1 text-[10px] font-semibold">{{ $detail[1] }}</p>
					</div>
				@endforeach
			</div>
		</section>

		<section class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">
			<div class="flex items-center justify-between gap-4">
				<h2 class="text-sm font-bold">Deskripsi Toko</h2>
				<button type="button" class="text-[10px] font-bold text-[#e85d04] hover:underline">Edit</button>
			</div>
			<p class="mt-3 max-w-2xl text-[10px] leading-relaxed text-[#72594b]">Warung Bu Sri sudah melayani pelanggan sejak 2022, menyajikan masakan khas Kediri dengan resep turun-temurun. Semua produk dibuat fresh setiap hari tanpa bahan pengawet.</p>
		</section>

		<section class="grid grid-cols-1 gap-3 sm:grid-cols-2">
			<div class="flex items-center gap-3 rounded-xl border border-orange-100 bg-white p-4 shadow-sm sm:block">
				<span class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-50 text-[#e85d04]"><i class="fa-solid fa-box text-xs"></i></span>
				<div><p class="text-lg font-extrabold sm:mt-2">86</p><p class="text-[10px] text-[#a58c7d]">Total Produk</p></div>
			</div>
			<div class="flex items-center gap-3 rounded-xl border border-orange-100 bg-white p-4 shadow-sm sm:block">
				<span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-50 text-green-600"><i class="fa-solid fa-check text-xs"></i></span>
				<div><p class="text-lg font-extrabold sm:mt-2">4.9</p><p class="text-[10px] text-[#a58c7d]">Rating Toko</p></div>
			</div>
		</section>
	</div>
</main>
@endsection
