@extends('layouts.seller')

@section('title', 'Laporan Toko - LokaMarket')

@section('content')

	<main class="min-h-screen bg-[#faf9f7] text-[#3b2115]">

		<section class="mt-5 relative isolate overflow-hidden border-b border-orange-100 bg-white">
			
			<div class="pointer-events-none absolute -right-16 -top-24 h-64 w-64 rounded-full bg-orange-100/50 blur-3xl"></div>
			<div class="pointer-events-none absolute right-1/3 top-10 h-32 w-32 rounded-full bg-amber-50 blur-2xl"></div>

			<div class="relative mx-auto max-w-7xl px-5 py-6 lg:px-8">

				<div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

					<div class="flex items-center gap-4">

						<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-[#ff8a00] to-[#e85d04] text-white shadow-lg shadow-orange-200/60">
							<i class="fa-solid fa-chart-line text-lg"></i>
						</div>

						<div>

							<div class="mb-1 flex items-center gap-2">

								<span class="text-[9px] font-bold uppercase tracking-[0.18em] text-[#e85d04]">
									Dashboard Toko
								</span>

								<span class="h-1 w-1 rounded-full bg-orange-300"></span>

								<span class="text-[9px] font-medium text-[#a58c7d]">
									Analytics
								</span>

							</div>

							<h1 class="text-xl font-extrabold tracking-tight text-[#3b2115] sm:text-2xl">
								Laporan Penjualan
							</h1>

							<p class="mt-1 text-[11px] text-[#9b8273]">
								Pantau performa, pendapatan, dan perkembangan tokomu.
							</p>

						</div>

					</div>

					<div class="flex items-center gap-3 rounded-xl border border-orange-100 bg-[#fffaf5] px-4 py-3">

						<div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-100/70 text-[#e85d04]">
							<i class="fa-regular fa-calendar-days text-sm"></i>
						</div>

						<div>
							<p class="text-[9px] font-medium text-[#a58c7d]">
								Periode laporan
							</p>

							<p class="text-[11px] font-bold text-[#3b2115]">
								{{ now()->translatedFormat('F Y') }}
							</p>
						</div>

						<span class="ml-2 h-2 w-2 rounded-full bg-green-500 ring-4 ring-green-100"></span>

					</div>

				</div>

				<div class="mt-10 h-1 w-full overflow-hidden rounded-full bg-orange-50">
					<div class="h-full w-full rounded-full bg-gradient-to-r from-[#ffb21c] to-[#f56a0a]"></div>
				</div>

			</div>

		</section>

		<div class="mx-auto max-w-7xl space-y-5 px-5 py-5 lg:px-8 lg:py-6">

			{{-- RINGKASAN LAPORAN --}}
			<section class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">

				{{-- Pendapatan Bulan Ini --}}
				<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
					<div class="flex items-start justify-between">
						<div>
							<p class="text-xl font-extrabold tracking-tight">
								Rp{{ number_format($pendapatanBulanIni, 0, ',', '.') }}
							</p>
							<p class="mt-0.5 text-[10px] text-[#a58c7d]">
								Pendapatan Bulan Ini
							</p>
						</div>

						<span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-50 text-green-600">
							<i class="fa-solid fa-sack-dollar text-xs"></i>
						</span>
					</div>
				</div>

				{{-- Total Pesanan --}}
				<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
					<div class="flex items-start justify-between">
						<div>
							<p class="text-xl font-extrabold tracking-tight">
								{{ number_format($totalPesanan, 0, ',', '.') }}
							</p>
							<p class="mt-0.5 text-[10px] text-[#a58c7d]">
								Total Pesanan
							</p>
						</div>

						<span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-blue-600">
							<i class="fa-solid fa-cart-shopping text-xs"></i>
						</span>
					</div>
				</div>

				{{-- Pertumbuhan --}}
				<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
					<div class="flex items-start justify-between">
						<div>
							<p class="text-xl font-extrabold tracking-tight {{ $pertumbuhan >= 0 ? 'text-green-600' : 'text-red-600' }}">
								{{ $pertumbuhan > 0 ? '+' : '' }}{{ number_format($pertumbuhan, 1, ',', '.') }}%
							</p>
							<p class="mt-0.5 text-[10px] text-[#a58c7d]">
								Pertumbuhan dari bulan lalu
							</p>
						</div>

						<span class="flex h-8 w-8 items-center justify-center rounded-full {{ $pertumbuhan >= 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
							<i class="fa-solid {{ $pertumbuhan >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} text-xs"></i>
						</span>
					</div>
				</div>

				{{-- Total Pelanggan --}}
				<div class="rounded-xl border border-orange-100 bg-white p-4 shadow-sm">
					<div class="flex items-start justify-between">
						<div>
							<p class="text-xl font-extrabold tracking-tight">
								{{ number_format($totalPelanggan, 0, ',', '.') }}
							</p>
							<p class="mt-0.5 text-[10px] text-[#a58c7d]">
								Total Pelanggan
							</p>
						</div>

						<span class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-50 text-purple-600">
							<i class="fa-solid fa-users text-xs"></i>
						</span>
					</div>
				</div>

			</section>

			{{-- GRAFIK DAN PRODUK TERLARIS --}}
			<section class="grid grid-cols-1 gap-5 lg:grid-cols-[1.55fr_1fr]">

				{{-- Grafik Pendapatan --}}
				<div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
					<div class="mb-4 flex items-center justify-between">
						<div>
							<h2 class="text-sm font-bold">Pendapatan 6 Bulan Terakhir</h2>
							<p class="mt-1 text-[9px] text-[#a58c7d]">
								Berdasarkan pendapatan toko
							</p>
						</div>

						<button
							type="button"
							class="rounded-full border border-orange-100 px-3 py-1.5 text-[10px] font-semibold text-[#72594b] transition hover:border-[#e85d04] hover:text-[#e85d04]"
						>
							Export CSV
						</button>
					</div>

					<div class="flex h-36 items-end justify-around gap-2 border-b border-orange-100 px-2 sm:gap-4">
						<div class="flex h-36 items-end justify-around gap-2 border-b border-orange-100 px-2 sm:gap-4">
							@forelse ($grafikPendapatan as $month)
								<div class="flex h-full min-w-0 flex-1 flex-col items-center justify-end gap-1.5">
									<span class="whitespace-nowrap text-[8px] font-bold text-[#3b2115]">
										{{ $month['label'] }}
									</span>

									<div
										class="w-full max-w-10 rounded-t-md {{ $loop->last ? 'bg-gradient-to-t from-[#ffb21c] to-[#f56a0a]' : 'bg-[#f1e4d2]' }}"
										style="height: {{ $month['tinggi'] }}%"
										title="{{ $month['bulan'] }}: Rp{{ number_format($month['total'], 0, ',', '.') }}"
									></div>

									<span class="-mb-5 text-[9px] text-[#8c7467]">
										{{ $month['bulan'] }}
									</span>
								</div>
							@empty
								<div class="flex w-full items-center justify-center pb-10 text-[11px] text-[#a58c7d]">
									Belum ada data pendapatan.
								</div>
						@endforelse
					</div>
				</div>

				{{-- Produk Terlaris --}}
				<div class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
					<h2 class="mb-1 text-sm font-bold">Produk Terlaris</h2>
					<p class="mb-4 text-[9px] text-[#a58c7d]">
						Berdasarkan jumlah produk terjual
					</p>

					<div class="space-y-4">
						@forelse ($produkTerlaris as $product)
							<div>
								<div class="mb-1 flex items-center justify-between gap-3 text-[9px] font-semibold">
									<span class="truncate">
										{{ $product['nama'] }}
									</span>

									<span class="shrink-0 text-[#8c7467]">
										{{ $product['persentase'] }}%
									</span>
								</div>

								<div class="h-1.5 overflow-hidden rounded-full bg-[#f1e4d2]">
									<div
										class="h-full rounded-full bg-[#f56a0a] transition-all"
										style="width: {{ $product['persentase'] }}%"
									></div>
								</div>

								<p class="mt-1 text-[8px] text-[#a58c7d]">
									{{ number_format($product['total_terjual'], 0, ',', '.') }} produk terjual
								</p>
							</div>
						@empty
							<div class="py-8 text-center text-[11px] text-[#a58c7d]">
								Belum ada produk terjual.
							</div>
						@endforelse
					</div>
				</div>

			</section>

			{{-- PESANAN TERBARU --}}
			<section class="rounded-xl border border-orange-100 bg-white p-5 shadow-sm">
				<div class="mb-4 flex items-center justify-between">
					<div>
						<h2 class="text-sm font-bold">Pesanan Terbaru</h2>
						<p class="mt-1 text-[9px] text-[#a58c7d]">
							Riwayat pesanan yang masuk ke tokomu
						</p>
					</div>
				</div>

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

							@forelse ($pesananTerbaru as $order)
								@php
									$status = $order->status;

									$statusClass = match ($status) {
										'selesai' => 'bg-green-50 text-green-600',
										'dibayar', 'diproses', 'dikirim' => 'bg-blue-50 text-blue-600',
										'menunggu_pembayaran' => 'bg-yellow-50 text-yellow-700',
										'dibatalkan', 'return_ditolak' => 'bg-red-50 text-red-600',
										'pengajuan_return', 'telah_direturn' => 'bg-orange-50 text-orange-600',
										default => 'bg-gray-50 text-gray-600',
									};

									$statusLabel = ucwords(str_replace('_', ' ', $status));
								@endphp

								<tr>
									<td class="py-3">
										{{ $order->pesanan?->nomor_pesanan ?? '#' . $order->pesanan_id }}
									</td>

									<td class="py-3">
										{{ $order->pesanan?->user?->username ?? 'Pelanggan' }}
									</td>

									<td class="py-3 whitespace-nowrap">
										Rp{{ number_format($order->total_penjual, 0, ',', '.') }}
									</td>

									<td class="py-3 whitespace-nowrap text-[#8c7467]">
										{{ $order->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}
									</td>

									<td class="py-3">
										<span class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-[9px] font-semibold {{ $statusClass }}">
											<i class="fa-solid fa-circle text-[5px]"></i>
											{{ $statusLabel }}
										</span>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="py-8 text-center text-[11px] font-medium text-[#a58c7d]">
										Belum ada pesanan untuk tokomu.
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</section>

		</div>
	</main>
@endsection