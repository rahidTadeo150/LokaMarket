@extends('layouts.admin')

@section('title', 'Pengguna - LokaMarket')

@section('page-heading', 'Daftar Pengguna')

@section('content')
	@php
		$users = [
			['name' => 'Andi Pratama', 'email' => 'andipratama@gmail.com', 'date' => '20/09/2026', 'transactions' => 293, 'status' => 'Aktif', 'initials' => 'AP', 'color' => 'bg-sky-100 text-sky-700'],
			['name' => 'Siti Rahma', 'email' => 'sitirahma@gmail.com', 'date' => '20/09/2026', 'transactions' => 206, 'status' => 'Nonaktif', 'initials' => 'SR', 'color' => 'bg-rose-100 text-rose-700'],
			['name' => 'Matt Terinya', 'email' => 'mattterinya@gmail.com', 'date' => '20/09/2026', 'transactions' => 215, 'status' => 'Nonaktif', 'initials' => 'MT', 'color' => 'bg-emerald-100 text-emerald-700'],
			['name' => 'Andi Kesirm', 'email' => 'andikesirm@gmail.com', 'date' => '28/09/2026', 'transactions' => 101, 'status' => 'Aktif', 'initials' => 'AK', 'color' => 'bg-amber-100 text-amber-700'],
			['name' => 'Andi Liura', 'email' => 'andisiura@gmail.com', 'date' => '29/09/2026', 'transactions' => 36, 'status' => 'Nonaktif', 'initials' => 'AL', 'color' => 'bg-violet-100 text-violet-700'],
			['name' => 'Maman dan', 'email' => 'mmadhan@gmail.com', 'date' => '29/09/2026', 'transactions' => 16, 'status' => 'Aktif', 'initials' => 'MD', 'color' => 'bg-orange-100 text-orange-700'],
			['name' => 'Andi Pratama', 'email' => 'sitiiumsno@gmail.com', 'date' => '29/09/2026', 'transactions' => 0, 'status' => 'Nonaktif', 'initials' => 'AP', 'color' => 'bg-cyan-100 text-cyan-700'],
		];
	@endphp

	<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<p class="text-xs font-medium text-[#A58E81]">LokaMarket Admin</p>
			<h1 class="mt-1 text-2xl font-extrabold text-[#3B2115]">Daftar Pengguna</h1>
			<p class="mt-1 text-sm text-[#8D776A]">Lihat dan kelola semua pengguna yang terdaftar di LokaMarket.</p>
		</div>
		<button type="button" class="inline-flex w-fit items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-3 text-xs font-bold text-white shadow-md shadow-orange-200 transition hover:-translate-y-0.5 hover:shadow-lg">
			<i class="fa-solid fa-plus"></i>
			Tambah Pengguna Baru
		</button>
	</div>

	<section class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">
		<div class="flex flex-col gap-4 border-b border-orange-100 px-5 py-5 lg:flex-row lg:items-center lg:justify-between">
			<div>
				<h2 class="text-base font-bold text-[#3B2115]">Daftar Pengguna LokaMarket</h2>
				<p class="mt-1 text-[11px] text-[#A58E81]">Menampilkan 7 dari 1.248 pengguna terdaftar</p>
			</div>
			<label class="relative block w-full lg:max-w-xs">
				<span class="sr-only">Cari pengguna</span>
				<i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-[#A58E81]"></i>
				<input type="search" placeholder="Daftar pengguna or email" class="w-full rounded-lg border border-orange-100 py-2.5 pl-9 pr-3 text-xs text-[#3B2115] outline-none placeholder:text-[#A58E81] focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
			</label>
		</div>

		<div class="flex gap-2 overflow-x-auto border-b border-orange-50 px-5 py-3">
			<button type="button" class="shrink-0 rounded-lg bg-orange-100 px-3 py-2 text-[11px] font-semibold text-orange-700">Semua Status</button>
			<button type="button" class="shrink-0 rounded-lg border border-orange-100 px-3 py-2 text-[11px] font-medium text-[#72594B] transition hover:bg-orange-50">Aktif</button>
			<button type="button" class="shrink-0 rounded-lg border border-orange-100 px-3 py-2 text-[11px] font-medium text-[#72594B] transition hover:bg-orange-50">Nonaktif</button>
			<button type="button" class="shrink-0 rounded-lg border border-orange-100 px-3 py-2 text-[11px] font-medium text-[#72594B] transition hover:bg-orange-50">Admin</button>
			<button type="button" class="shrink-0 rounded-lg border border-orange-100 px-3 py-2 text-[11px] font-medium text-[#72594B] transition hover:bg-orange-50">Penjual</button>
			<button type="button" class="shrink-0 rounded-lg border border-orange-100 px-3 py-2 text-[11px] font-medium text-[#72594B] transition hover:bg-orange-50">Pembeli</button>
		</div>

		<div class="overflow-x-auto">
			<table class="w-full min-w-[850px] text-left">
				<thead class="bg-[#FFF9F2] text-[10px] font-bold text-[#72594B]">
					<tr>
						<th class="px-5 py-3">Nama Pengguna</th>
						<th class="px-4 py-3">Email</th>
						<th class="px-4 py-3">Tanggal Daftar</th>
						<th class="px-4 py-3">Total Transaksi</th>
						<th class="px-4 py-3">Status</th>
						<th class="px-5 py-3">Aksi</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-orange-50 text-xs text-[#3B2115]">
					@foreach ($users as $user)
						<tr class="transition hover:bg-[#FFFDF9]">
							<td class="px-5 py-3.5">
								<div class="flex items-center gap-3">
									<span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-[10px] font-bold {{ $user['color'] }}">{{ $user['initials'] }}</span>
									<span class="font-semibold">{{ $user['name'] }}</span>
								</div>
							</td>
							<td class="px-4 py-3.5 text-[11px] text-[#72594B]">{{ $user['email'] }}</td>
							<td class="whitespace-nowrap px-4 py-3.5 text-[11px] text-[#72594B]">{{ $user['date'] }}</td>
							<td class="px-4 py-3.5 font-semibold">{{ $user['transactions'] }}</td>
							<td class="px-4 py-3.5">
								<span class="rounded-full px-2.5 py-1 text-[10px] font-bold {{ $user['status'] === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $user['status'] }}</span>
							</td>
							<td class="px-5 py-3.5">
								<div class="flex items-center gap-3 text-[#72594B]">
									<button type="button" title="Edit pengguna" class="transition hover:text-orange-500"><i class="fa-solid fa-pen-to-square"></i><span class="sr-only">Edit</span></button>
									<button type="button" title="Blokir pengguna" class="transition hover:text-red-500"><i class="fa-solid fa-trash-can"></i><span class="sr-only">Blokir</span></button>
									<button type="button" title="Lihat detail pengguna" class="transition hover:text-orange-500"><i class="fa-regular fa-eye"></i><span class="sr-only">Detail</span></button>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="flex flex-col gap-3 border-t border-orange-100 px-5 py-4 text-[11px] text-[#A58E81] sm:flex-row sm:items-center sm:justify-between">
			<span>Menampilkan 1 sampai 7 dari 1.248 pengguna</span>
			<div class="flex items-center gap-1">
				<button type="button" title="Halaman sebelumnya" class="flex h-8 w-8 items-center justify-center rounded-lg border border-orange-100 text-[#A58E81]"><i class="fa-solid fa-chevron-left text-[9px]"></i><span class="sr-only">Sebelumnya</span></button>
				<button type="button" class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500 text-xs font-bold text-white">1</button>
				<button type="button" class="flex h-8 w-8 items-center justify-center rounded-lg border border-orange-100 text-[#72594B]">2</button>
				<button type="button" class="flex h-8 w-8 items-center justify-center rounded-lg border border-orange-100 text-[#72594B]">3</button>
				<button type="button" title="Halaman berikutnya" class="flex h-8 w-8 items-center justify-center rounded-lg border border-orange-100 text-[#72594B]"><i class="fa-solid fa-chevron-right text-[9px]"></i><span class="sr-only">Berikutnya</span></button>
			</div>
		</div>
	</section>
@endsection
