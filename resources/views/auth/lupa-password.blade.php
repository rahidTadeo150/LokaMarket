@extends('layouts.auth-customer')

@section('title', 'Lupa Password - LokaMarket')

@section('content')
	<main class="mx-auto flex min-h-screen items-center justify-center bg-[#FFF9F4] px-4 py-28 sm:px-6">
		<section class="w-full max-w-md rounded-[22px] border border-[#F1DCC8] bg-white px-5 py-8 shadow-xl sm:px-10 sm:py-10">
			<div class="mb-8 text-center">
				<div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#FFF0E5] text-[#E95309]">
					<i class="fa-solid fa-key text-xl"></i>
				</div>
				<h1 class="mt-5 text-2xl font-extrabold text-[#3B2115]">Lupa Password?</h1>
				<p class="mt-2 text-sm leading-6 text-[#72594B]">
					Masukkan email yang terdaftar. Kami akan mengirimkan link untuk membuat password baru.
				</p>
			</div>

			@if (session('success'))
				<x-alert-success-relative></x-alert-success-relative>
			@endif

			@if ($errors->any())
				<div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-xs text-red-600">
					{{ $errors->first('email') }}
				</div>
			@endif

			<form action="{{ route('password.email') }}" method="POST" class="space-y-5">
				@csrf
				<div>
					<label for="email" class="mb-2 block text-xs font-bold text-[#5A4032]">Email</label>
					<div class="relative">
						<span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 text-sm">
							<i class="fa-regular fa-envelope"></i>
						</span>
						<input id="email"
							   name="email"
							   type="email"
							   value="{{ old('email') }}"
							   autocomplete="email"
							   placeholder="nama@email.com"
							   required
							   autofocus
							   class="w-full rounded-full border border-slate-300 py-3 pl-10 pr-4 text-sm text-[#3B2115] outline-none placeholder:text-[#A58C7D] focus:border-orange-500 focus:ring-2 focus:ring-[#FFD1AD]">
					</div>
				</div>

				<button type="submit" class="h-11 w-full rounded-full bg-[#E95309] text-sm font-bold text-white shadow-sm transition hover:bg-[#C1440E] hover:shadow-md">
					Kirim Link Reset Password
				</button>
			</form>

			<p class="mt-7 text-center text-xs text-[#72594B]">
				Ingat password Anda?
				<a href="{{ route('cust.login') }}" class="font-bold text-[#C1440E] hover:text-[#9E350B]">Kembali ke login</a>
			</p>
		</section>
	</main>
@endsection
