@extends('layouts.admin')

@section('title', 'Kelola Toko - LokaMarket')

@section('page-heading', 'Kelola Toko')

@section('content')
	@php
		$stores = [
			['name' => 'Toko Barokah', 'owner' => 'Toko Barokah', 'date' => '26/09/2026', 'products' => 274, 'status' => 'Aktif', 'logo' => 'TB', 'color' => 'bg-emerald-100 text-emerald-700'],
			['name' => 'Aneka Rasa', 'owner' => 'Rudi Rasa', 'date' => '25/09/2026', 'products' => 24, 'status' => 'Nonaktif', 'logo' => 'AR', 'color' => 'bg-amber-100 text-amber-700'],
			['name' => 'Fashion Haven', 'owner' => 'Fashion Haven', 'date' => '26/09/2026', 'products' => 186, 'status' => 'Menunggu Verifikasi', 'logo' => 'FH', 'color' => 'bg-slate-100 text-slate-700'],
			['name' => 'Toko Barokah', 'owner' => 'Audi Fitri', 'date' => '02/09/2026', 'products' => 24, 'status' => 'Aktif', 'logo' => 'TB', 'color' => 'bg-neutral-900 text-white'],
			['name' => 'Dapur Cita', 'owner' => 'Citra Lestari', 'date' => '01/09/2026', 'products' => 68, 'status' => 'Menunggu Verifikasi', 'logo' => 'DC', 'color' => 'bg-orange-100 text-orange-700'],
			['name' => 'Rumah Batik', 'owner' => 'Nadia Putri', 'date' => '30/08/2026', 'products' => 92, 'status' => 'Aktif', 'logo' => 'RB', 'color' => 'bg-red-100 text-red-700'],
		];
	@endphp

	<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<p class="text-xs font-medium text-[#A58E81]">LokaMarket Admin</p>
			<h1 class="mt-1 text-2xl font-extrabold text-[#3B2115]">Kelola Daftar Toko LokaMarket</h1>
			<p class="mt-1 text-sm text-[#8D776A]">Kelola toko, pemilik, produk, dan status verifikasi toko.</p>
		</div>
		<button type="button" class="inline-flex w-fit items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-3 text-xs font-bold text-white shadow-md shadow-orange-200 transition hover:-translate-y-0.5 hover:shadow-lg">
			<i class="fa-solid fa-plus"></i>
			Tambah Toko Baru
		</button>
	</div>

	<section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">
		<div class="flex flex-col gap-4 border-b border-orange-100 px-5 py-5 xl:flex-row xl:items-center xl:justify-between">
			<label class="relative block w-full xl:max-w-xs">
				<span class="sr-only">Cari toko</span>
				<i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-[#A58E81]"></i>
				<input type="search" placeholder="Cari Toko..." class="w-full rounded-lg border border-orange-100 py-2.5 pl-9 pr-3 text-xs text-[#3B2115] outline-none placeholder:text-[#A58E81] focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
			</label>

			<div class="flex flex-col gap-3 sm:flex-row sm:items-center">
				<label class="flex items-center gap-2 text-xs text-[#72594B]">
					<span>Status</span>
					<select class="rounded-lg border border-orange-100 bg-white px-3 py-2.5 text-xs text-[#3B2115] outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
						<option>Tampilkan Semua Status</option>
						<option>Aktif</option>
						<option>Nonaktif</option>
						<option>Menunggu Verifikasi</option>
					</select>
				</label>
			</div>
		</div>

		<div class="w-full overflow-hidden">
			<table class="w-full text-left">
				<thead class="bg-[#FFF9F2] text-[10px] font-bold text-[#72594B]">
					<tr>
						<th class="px-5 py-3">Logo Toko</th>
						<th class="px-4 py-3">Nama Toko</th>
						<th class="px-4 py-3">Pemilik Toko</th>
						<th class="px-4 py-3">Tanggal Daftar</th>
						<th class="px-4 py-3">Total Produk</th>
						<th class="px-4 py-3">Status</th>
						<th class="px-5 py-3">Aksi</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-orange-50 text-xs text-[#3B2115]">
					@foreach ($stores as $store)
							<tr class="transition hover:bg-[#FFFDF9]">
								<td class="px-5 py-3.5">
								<span class="flex h-10 w-10 items-center justify-center rounded-xl text-[10px] font-extrabold {{ $store['color'] }}">{{ $store['logo'] }}</span>
							</td>
								<td class="px-4 py-3.5 font-semibold">{{ $store['name'] }}</td>
								<td class="px-4 py-3.5 text-[11px] text-[#72594B]">{{ $store['owner'] }}</td>
								<td class="whitespace-nowrap px-4 py-3.5 text-[11px] text-[#72594B]">{{ $store['date'] }}</td>
								<td class="px-4 py-3.5 font-semibold">{{ $store['products'] }}</td>
								<td class="px-4 py-3.5">
								<span class="whitespace-nowrap rounded-full px-2.5 py-1 text-[10px] font-bold {{ match ($store['status']) {
									'Aktif' => 'bg-green-100 text-green-700',
									'Nonaktif' => 'bg-red-100 text-red-700',
									default => 'bg-yellow-100 text-yellow-700',
								} }}">{{ $store['status'] }}</span>
							</td>
								<td class="px-5 py-3.5">
									<div class="flex items-center gap-3 text-[#72594B]">
										<button type="button" title="Edit toko" class="transition hover:text-orange-500"><i class="fa-solid fa-pen-to-square"></i><span class="sr-only">Edit</span></button>
										<button type="button" title="{{ $store['status'] === 'Nonaktif' ? 'Aktifkan toko' : 'Nonaktifkan toko' }}" class="transition hover:text-red-500"><i class="fa-solid {{ $store['status'] === 'Nonaktif' ? 'fa-toggle-on' : 'fa-ban' }}"></i><span class="sr-only">{{ $store['status'] === 'Nonaktif' ? 'Aktifkan' : 'Nonaktifkan' }}</span></button>
										<button type="button" title="Hapus toko" class="transition hover:text-red-500"><i class="fa-solid fa-trash-can"></i><span class="sr-only">Hapus</span></button>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="flex flex-col gap-3 border-t border-orange-100 px-5 py-4 text-[11px] text-[#A58E81] sm:flex-row sm:items-center sm:justify-between">
			<span>Menampilkan 1 sampai 6 dari 186 toko</span>
		</div>
	</section>
@endsection
