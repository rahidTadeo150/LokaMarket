@extends('layouts.seller')

@section('title', 'Laporan Toko - LokaMarket')

@section('content')
<main class="min-h-screen bg-[#faf9f7] text-[#3b2115]">
	<section class="border-b border-orange-100 bg-white">
		<div class="mx-auto flex max-w-7xl flex-col gap-4 px-5 py-5 sm:flex-row sm:items-center sm:justify-between lg:px-8">
			<div>
				<h1 class="text-lg font-extrabold tracking-tight text-[#3b2115]">Laporan</h1>
				<p class="mt-0.5 text-[11px] text-[#a58c7d]">Analisis performa tokomu</p>
			</div>
			<label class="flex w-full items-center gap-2 rounded-full bg-[#fff8f0] px-4 py-2 text-[11px] text-[#a58c7d] sm:w-44">
				<i class="fa-solid fa-magnifying-glass text-[10px] text-[#b99d8a]"></i>
				<input type="search" placeholder="Cari..." class="w-full bg-transparent outline-none placeholder:text-[#b99d8a]">
			</label>
		</div>
	</section>

	<div class="mx-auto max-w-7xl space-y-5 px-5 py-5 lg:px-8 lg:py-6">
		<section class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
			<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
				<div class="flex items-start justify-between">
					<div>
						<p class="text-xl font-extrabold tracking-tight">Rp1.250.000</p>
						<p class="mt-0.5 text-[10px] text-[#a58c7d]">Pendapatan Bulan Ini</p>
					</div>
					<span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-50 text-green-600"><i class="fa-solid fa-sack-dollar text-xs"></i></span>
				</div>
			</div>
			<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
				<div class="flex items-start justify-between">
					<div>
						<p class="text-xl font-extrabold tracking-tight">142</p>
						<p class="mt-0.5 text-[10px] text-[#a58c7d]">Total Pesanan</p>
					</div>
					<span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-blue-600"><i class="fa-solid fa-cart-shopping text-xs"></i></span>
				</div>
			</div>
			<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
				<div class="flex items-start justify-between">
					<div>
						<p class="text-xl font-extrabold tracking-tight">+12%</p>
						<p class="mt-0.5 text-[10px] text-[#a58c7d]">Pertumbuhan</p>
					</div>
					<span class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-50 text-[#e85d04]"><i class="fa-solid fa-arrow-trend-up text-xs"></i></span>
				</div>
			</div>
			<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
				<div class="flex items-start justify-between">
					<div>
						<p class="text-xl font-extrabold tracking-tight">340</p>
						<p class="mt-0.5 text-[10px] text-[#a58c7d]">Total Pelanggan</p>
					</div>
					<span class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-50 text-purple-600"><i class="fa-solid fa-users text-xs"></i></span>
				</div>
			</div>
		</section>

		<section class="grid grid-cols-1 gap-5 lg:grid-cols-[1.55fr_1fr]">
			<div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
				<div class="mb-4 flex items-center justify-between">
					<h2 class="text-sm font-bold">Pendapatan 6 Bulan Terakhir</h2>
					<button type="button" class="rounded-full border border-orange-100 px-3 py-1.5 text-[10px] font-semibold text-[#72594b] transition hover:border-[#e85d04] hover:text-[#e85d04]">
						Export CSV
					</button>
				</div>
				<div class="flex h-36 items-end justify-around gap-2 border-b border-orange-100 px-2 sm:gap-4">
					@foreach ([['Apr', '820rb', 'h-20'], ['Mei', '940rb', 'h-24'], ['Jun', '1050rb', 'h-28'], ['Jul', '980rb', 'h-25'], ['Agu', '1180rb', 'h-32'], ['Sep', '1250rb', 'h-34']] as $month)
						<div class="flex h-full flex-1 flex-col items-center justify-end gap-1.5">
							<span class="text-[8px] font-bold text-[#3b2115]">{{ $month[1] }}</span>
							<div class="{{ $month[2] }} w-full max-w-10 rounded-t-md bg-[#f1e4d2] last:bg-gradient-to-t last:from-[#ffb21c] last:to-[#f56a0a]"></div>
							<span class="-mb-5 text-[9px] text-[#8c7467]">{{ $month[0] }}</span>
						</div>
					@endforeach
				</div>
			</div>

			<div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
				<h2 class="mb-4 text-sm font-bold">Produk Terlaris</h2>
				<div class="space-y-4">
					@foreach ([['Nasi Pecel Bu Sri', '85%', 'bg-[#f56a0a]', 'w-[85%]'], ['Es Dawet Kediri', '68%', 'bg-[#5a8b55]', 'w-[68%]'], ['Kopi Tubruk', '54%', 'bg-[#c84b13]', 'w-[54%]'], ['Sambal Pecel', '40%', 'bg-[#58a177]', 'w-[40%]'], ['Rempeyek Kacang', '26%', 'bg-[#9459bd]', 'w-[26%]']] as $product)
						<div>
							<div class="mb-1 flex items-center justify-between text-[9px] font-semibold">
								<span>{{ $product[0] }}</span><span class="text-[#8c7467]">{{ $product[1] }}</span>
							</div>
							<div class="h-1.5 overflow-hidden rounded-full bg-[#f1e4d2]"><div class="h-full rounded-full {{ $product[2] }} {{ $product[3] }}"></div></div>
						</div>
					@endforeach
				</div>
			</div>
		</section>

		<section class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
			<h2 class="mb-4 text-sm font-bold">Pesanan Terbaru</h2>
			<div class="overflow-x-auto">
				<table class="w-full min-w-[620px] text-left">
					<thead class="border-b border-orange-100 text-[9px] font-semibold uppercase text-[#a58c7d]">
						<tr>
							<th class="pb-2 font-semibold">No. Pesanan</th>
							<th class="pb-2 font-semibold">Pembeli</th>
							<th class="pb-2 font-semibold">Total</th>
							<th class="pb-2 font-semibold">Tanggal</th>
							<th class="pb-2 font-semibold">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-orange-50 text-[10px] font-semibold">
						@foreach ([['#ORD-2381', 'Andi Rahman', 'Rp 30.000', '1 Sep 2026, 09:40'], ['#ORD-2380', 'Budi Santoso', 'Rp 35.000', '1 Sep 2026, 08:15'], ['#ORD-2379', 'Sinta Dewi', 'Rp 20.000', '31 Agu 2026, 20:02']] as $order)
							<tr>
								<td class="py-3">{{ $order[0] }}</td>
								<td class="py-3">{{ $order[1] }}</td>
								<td class="py-3">{{ $order[2] }}</td>
								<td class="py-3">{{ $order[3] }}</td>
								<td class="py-3"><span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-[9px] font-semibold text-green-600"><i class="fa-solid fa-circle text-[5px]"></i> Selesai</span></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</section>
	</div>
</main>
@endsection
