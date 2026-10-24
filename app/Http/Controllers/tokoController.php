<?php

namespace App\Http\Controllers;

use App\Models\kecamatan;
use App\Models\pending_pengajuan_toko;
use App\Models\pengajuan_Toko;
use App\Models\toko;
use App\Models\User;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifikasiPengajuanTokoMail;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class tokoController extends Controller
{

    public function pilihanKodePos(
        kecamatan $kecamatan,
        RajaOngkirService $locationService
    ) {
        try {
            $lokasi = $locationService->search($kecamatan);

            return response()->json([
                'success' => true,
                'data' => $lokasi,
            ]);
        } catch (RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Pencarian lokasi Komerce gagal.', [
                'kecamatan_id' => $kecamatan->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari lokasi.',
                'data' => [],
            ], 500);
        }
    }

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

            if ($pending->token_expired_at && $pending->token_expired_at->isFuture()) {

                return back()->withInput()
                    ->with(
                        'error',
                        'Anda sudah memiliki pengajuan yang menunggu verifikasi email. Silakan cek email Anda untuk melakukan verifikasi.'
                    );

            }

            if (!$pending->token_expired_at || $pending->token_expired_at->isPast()) {

                if ($pending->foto_profil && Storage::disk('public')->exists($pending->foto_profil)) {
                    Storage::disk('public')->delete(
                        $pending->foto_profil
                    );
                }

                if ($pending->foto_ktp && Storage::disk('public')->exists($pending->foto_ktp)) {
                    Storage::disk('public')->delete(
                        $pending->foto_ktp
                    );
                }

                $pending->delete();

            }
        }

        $pengajuanAktif = pengajuan_toko::where('user_id', Auth::id())->where('status', 'pending')->exists();

        if ($pengajuanAktif) {

            return back()->withInput()
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
            'alamat_lengkap' =>  Str::title($pending->alamat_lengkap),
            'no_telepon' => $noTelp,
            'foto_ktp' => $fotoKtp,
            'token_verifikasi' => $token,
            'token_expired_at' => now()->addMinutes(30),
        ]);

        Mail::to(Auth::user()->email)->send(
            new VerifikasiPengajuanTokoMail($pending)
        );

        return redirect()->route('cust.formDaftarToko.notice', ['email' => Auth::user()->email])
            ->with(
                'success',
                'Data Anda berhasil disimpan sementara. Silakan verifikasi email untuk melanjutkan pengajuan toko.'
            );
    }

    public function VerificationNotice(string $email)
    {
        return view('user.verify-daftar-toko', [
            'email' => $email,
        ]);
    }

    public function verifikasiEmail(string $token)
    {

        $pending = pending_pengajuan_toko::where(
            'token_verifikasi',
            $token
        )->first();

        if (!$pending) {

            return redirect()->route('cust.login')
                ->with(
                    'error',
                    'Link verifikasi tidak valid atau sudah digunakan.'
                );
                
        }

        if ($pending->token_expired_at && $pending->token_expired_at->isPast()) {

            $pending->update([
                'token_verifikasi' => null,
            ]);

            return redirect()->route('cust.formDaftarToko.notice')
                ->with(
                    'error',
                    'Link verifikasi sudah kedaluwarsa. Silakan kirim ulang email verifikasi.'
                );

        }

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

    public function resendVerifikasi(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with(
                'error',
                'Email tidak ditemukan.'
            );
        }

        $pending = pending_pengajuan_toko::where('user_id', $user->id)->latest()->first();

        if (!$pending) {
            return back()->with(
                'error',
                'Data pengajuan toko tidak ditemukan.'
            );
        }

        $token = Str::random(64);

        $pending->update([
            'token' => $token,
            'expires_at' => now()->addMinutes(30),
        ]);

        Mail::to($user->email)->send(
            new VerifikasiPengajuanTokoMail($pending)
        );

        return back()->with(
            'success',
            'Email verifikasi berhasil dikirim ulang. Link verifikasi berlaku selama 30 menit.'
        );

    }

    public function pengajuanUlang()
    {

        $user = auth()->user();

        $pengajuanTerakhir = pengajuan_toko::where('user_id', $user->id)->latest()->first();

        if (!$pengajuanTerakhir) {
            return redirect()->route('cust.formDaftarToko')
                ->with(
                    'error',
                    'Anda belum memiliki pengajuan toko.'
                );
        }

        if ($pengajuanTerakhir->status === 'pending') {
            return redirect()
                ->route('cust.statusPengajuan')
                ->with(
                    'error',
                    'Pengajuan toko Anda masih sedang diperiksa oleh admin.'
                );
        }

        if ($pengajuanTerakhir->status === 'approved') {
            return redirect()
                ->route('seller.dashboard')
                ->with(
                    'error',
                    'Pengajuan toko Anda sudah disetujui.'
                );
        }

        if ($pengajuanTerakhir->status === 'rejected') {

            if (!$pengajuanTerakhir->rejected_at) {
                return redirect()
                    ->route('cust.statusPengajuan')
                    ->with(
                        'error',
                        'Data waktu penolakan pengajuan tidak ditemukan.'
                    );
            }

            $cooldownSelesai = $pengajuanTerakhir->rejected_at
                ->copy()
                ->addHours(3);

            if (now()->lessThan($cooldownSelesai)) {

                $tersisa = now()->diffInMinutes($cooldownSelesai);

                return redirect()
                    ->route('cust.statusPengajuan')
                    ->with(
                        'error',
                        "Anda belum dapat mengajukan kembali. Silakan tunggu sekitar {$tersisa} menit."
                    );
            }

            $pengajuanTerakhir->delete();

            return redirect()
                ->route('cust.formDaftarToko')
                ->with(
                    'success',
                    'Silahkan isi Lagi Pengajuan Toko Dengan Teliti'
                );
        }

        return redirect()
            ->route('cust.statusPengajuan')
            ->with(
                'error',
                'Status pengajuan toko tidak valid.'
            );
    }

    public function updateToko(Request $request)
    {

        $request->validate([
            'nama_toko' => 'required|string|min:3|max:100',
            'deskripsi' => 'required|string|min:10|max:500',
            'no_telepon' => 'required|string|max:15|min:10',
            'provinsi' => 'required|exists:provinsi,id',
            'kota' => 'required|exists:kota,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'alamat' => 'required|string|min:10|max:500',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $toko = toko::where('user_id', Auth::id())->firstOrFail();

        $fotoLama = $toko->foto_profil;
        $fotoBaru = null;

        try {

            if ($request->hasFile('foto_profil')) {
                $fotoBaru = $request->file('foto_profil')
                    ->store('toko', 'public');
            }

            $noTelepon = $request->no_telepon;

            if ($noTelepon !== $toko->no_telepon) {
                if (!str_starts_with($noTelepon, '+62')) {
                    $noTelepon = '+62' . $noTelepon;
                }
            } else {
                $noTelepon = $toko->no_telepon;
            }

            $toko->update([
                'nama_toko' => $request->nama_toko,
                'deskripsi' => $request->deskripsi,
                'no_telepon' => $noTelepon,
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kota,
                'kecamatan_id' => $request->kecamatan,
                'alamat' => $request->alamat,
                'foto_profil' => $fotoBaru ?? $fotoLama,
            ]);

            if ($fotoBaru && $fotoLama) {
                Storage::disk('public')->delete($fotoLama);
            }

            return redirect()->back()
                ->with('success', 'Profil toko berhasil diperbarui.');

        } catch (\Throwable $e) {

            if ($fotoBaru) {
                Storage::disk('public')->delete($fotoBaru);
            }

            report($e);

            return redirect()->back()->withInput()
                ->with('error', 'Gagal memperbarui profil toko. Silakan coba kembali.');
        }
    }
}