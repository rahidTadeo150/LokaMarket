<?php

namespace App\Http\Controllers;

use App\Models\pending_pengajuan_toko;
use App\Models\pengajuan_Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifikasiPengajuanTokoMail;
use Illuminate\Support\Facades\Storage;

class tokoController extends Controller
{

    public function registerToko(Request $request)
    {
            $request->validate([
                'nama_toko' => 'required|string|max:255',
                'deskripsi' => 'required|string|min:10|max:500',
                'foto_profil' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'provinsi' => 'required|exists:provinsi,id',
                'kota' => 'required|exists:kota,id',
                'kecamatan' => 'required|exists:kecamatan,id',
                'kode_pos' => 'required|string|digits:5',
                'alamat_lengkap' => 'required|string|min:10|max:500',
                'no_telepon' => 'required|string|min:10|max:15',
                'foto_ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'persetujuan' => 'required',
            ]);
            
            $pending = pending_pengajuan_toko::where('user_id', Auth::id())->first();

            if ($pending) {
                return back()->withInput()
                    ->with(
                        'error',
                        'Anda sudah memiliki pengajuan yang menunggu verifikasi email.'
                    );
            }

            $pengajuanAktif = pengajuan_toko::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->exists();

            if ($pengajuanAktif) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Anda masih memiliki pengajuan toko yang sedang diproses.'
                    );
            }

            $noTelp = preg_replace('/\D/', '', $request->no_telepon);

            if (str_starts_with($noTelp, '0')) {
                $noTelp = '+62' . substr($noTelp, 1);
            } elseif (str_starts_with($noTelp, '62')) {
                $noTelp = '+' . $noTelp;
            } else {
                $noTelp = '+62' . $noTelp;
            }

            $slug = Str::slug($request->nama_toko);

            $slugAwal = $slug;
            $counter = 1;

            while (
                pengajuan_Toko::where('slug', $slug)->exists() ||
                pending_pengajuan_toko::where('slug', $slug)->exists()
            ) {
                $slug = $slugAwal . '-' . $counter;
                $counter++;
            }

            $fotoProfil = null;

            if ($request->hasFile('foto_profil')) {
                $fotoProfil = $request->file('foto_profil')
                    ->store('pengajuan-toko/profil', 'public');
            }

            $fotoKtp = null;

            if ($request->hasFile('foto_ktp')) {
                $fotoKtp = $request->file('foto_ktp')
                    ->store('pengajuan-toko/ktp', 'public');
            }

            $token = Str::random(64);

            $pending = pending_pengajuan_toko::create([
                'user_id' => Auth::id(),
                'nama_toko' => $request->nama_toko,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
                'foto_profil' => $fotoProfil,
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kota,
                'kecamatan_id' => $request->kecamatan,
                'kode_pos' => $request->kode_pos,
                'alamat_lengkap' => $request->alamat_lengkap,
                'no_telepon' => $noTelp,
                'foto_ktp' => $fotoKtp,
                'token_verifikasi' => $token,
                'token_expired_at' => now()->addMinutes(30),
            ]);

            Mail::to(Auth::user()->email)->send(
                new VerifikasiPengajuanTokoMail($pending)
            );

            return redirect()->route('cust.formDaftarToko.notice')
                ->with(
                    'success',
                    'Data Anda berhasil disimpan sementara. Silakan verifikasi email untuk melanjutkan pengajuan toko.'
                );
    }

    public function VerificationNotice()
    {
        $user = Auth::user();

        return view('user.verify-daftar-toko',
            [
                'email' => $user->email,
            ]
        );
    }

    public function verifikasiEmail(string $token)
    {
        /*
        |--------------------------------------------------------------------------
        | Cari data pending berdasarkan token
        |--------------------------------------------------------------------------
        */

        $pending = pending_pengajuan_toko::where(
            'token_verifikasi',
            $token
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Token tidak ditemukan
        |--------------------------------------------------------------------------
        */

        if (!$pending) {
            return redirect()
                ->route('cust.login')
                ->with(
                    'error',
                    'Link verifikasi tidak valid atau sudah digunakan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek expired
        |--------------------------------------------------------------------------
        */

        if (
            $pending->token_expired_at &&
            $pending->token_expired_at->isPast()
        ) {
            return redirect()
                ->route('cust.formDaftarToko.notice')
                ->with(
                    'error',
                    'Link verifikasi sudah kedaluwarsa. Silakan kirim ulang email verifikasi.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Masukkan data pending ke pengajuan_toko
        |--------------------------------------------------------------------------
        */

        $pengajuan = pengajuan_Toko::create([
            'user_id' => $pending->user_id,
            'nama_toko' => $pending->nama_toko,
            'slug' => $pending->slug,
            'deskripsi' => $pending->deskripsi,
            'foto_profil' => $pending->foto_profil,
            'provinsi_id' => $pending->provinsi_id,
            'kota_id' => $pending->kota_id,
            'kecamatan_id' => $pending->kecamatan_id,
            'kode_pos' => $pending->kode_pos,
            'alamat_lengkap' => $pending->alamat_lengkap,
            'no_telepon' => $pending->no_telepon,
            'foto_ktp' => $pending->foto_ktp,
            'token_verifikasi' => null,
            'token_expired_at' => null,
            'email_verified_at' => now(),
            'status' => 'pending',
        ]);

        $pending->delete();

        return redirect()
            ->route('cust.formDaftarToko')
            ->with(
                'success',
                'Email berhasil diverifikasi. Pengajuan toko Anda sedang menunggu pemeriksaan admin.'
            );
    }

    public function statusPengajuan()
    {
        $pengajuan = pengajuan_toko::with([
            'provinsi',
            'kota',
            'kecamatan',
            'pemeriksa',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        return view(
            'user.status-pengajuan-toko',
            compact('pengajuan')
        );
    }
}