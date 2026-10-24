<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekPinToko {
    public function handle(Request $request, Closure $next): Response
    {
         if (! $request->user()) {
            return redirect()->route('cust.login');
        }

        if (! $request->session()->has('toko_pin_verified_at') || $request->session()->get('toko_pin_user_id') !== $request->user()->id) {
            $request->session()->forget([
                'toko_pin_verified_at',
                'toko_pin_user_id',
            ]);

            return redirect()->route('seller.verifyPin');
        }

        $verifiedAt = $request->session()->get('toko_pin_verified_at');

        if (! is_numeric($verifiedAt) || now()->timestamp - (int) $verifiedAt >= 1800) {
            $request->session()->forget([
                'toko_pin_verified_at',
                'toko_pin_user_id',
            ]);

            return redirect()->route('seller.verifyPin')
                ->with('info', 'Sesi toko berakhir. Masukkan PIN kembali.');
        }

        return $next($request);
    }
}