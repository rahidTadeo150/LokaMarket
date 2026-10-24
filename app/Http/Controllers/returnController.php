<?php

namespace App\Http\Controllers;

use App\Models\foto_return_produk;
use App\Models\pesanan;
use App\Models\return_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class returnController extends Controller
{
    public function ajukanReturn(Request $request, string $nomor_pesanan)
    {

        $validated = $request->validate([
            'alasan_return'     => 'required|string|in:produk_tidak_sesuai,produk_rusak,produk_tidak_diterima,produk_salah,lainnya',
            'keterangan_return' => 'nullable|string|max:1000',
            'foto_return'       => 'required|array|min:1|max:5',
            'foto_return.*'     => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'alasan_return.required' => 'Silakan pilih alasan return.',
            'alasan_return.string'   => 'Alasan return harus berupa teks.',
            'alasan_return.in'       => 'Alasan return yang dipilih tidak valid.',

            'keterangan_return.string' => 'Keterangan return harus berupa teks.',
            'keterangan_return.max'    => 'Keterangan maksimal 1000 karakter.',

            'foto_return.required' => 'Foto bukti wajib diunggah.',
            'foto_return.array'    => 'Format foto bukti tidak valid.',
            'foto_return.min'      => 'Unggah minimal 1 foto bukti.',
            'foto_return.max'      => 'Maksimal 5 foto bukti.',

            'foto_return.*.required' => 'Setiap foto bukti wajib diisi.',
            'foto_return.*.image'   => 'File bukti harus berupa gambar.',
            'foto_return.*.mimes'   => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto_return.*.max'     => 'Ukuran setiap foto maksimal 5 MB.',
        ]);

        // Cari pesanan milik customer yang sedang login.
        $pesanan = pesanan::where('nomor_pesanan', $nomor_pesanan)
            ->where('user_id', Auth::id())
            ->first();

        if (!$pesanan) {
            return redirect()->back()->withErrors([
                'return' => 'Pesanan tidak ditemukan atau kamu tidak memiliki akses.',
            ])->withInput();
        }

        // Return hanya dapat diajukan pada status pengiriman yang diizinkan.
        if (!in_array($pesanan->status, ['diantar', 'dikirim'], true)) {
            return redirect()->back()->withErrors([
                'return' => 'Pesanan ini tidak dapat diajukan untuk return karena statusnya tidak sesuai.',
            ])->withInput();
        }

        // Cegah pengajuan return aktif yang berulang.
        $returnAktif = return_produk::where('pesanan_id', $pesanan->id)
            ->whereIn('status', [
                'diajukan',
                'menunggu_review',
                'diproses',
                'disetujui',
            ])
            ->exists();

        if ($returnAktif) {
            return redirect()->back()->withErrors([
                'return' => 'Pesanan ini sudah memiliki pengajuan return yang masih aktif.',
            ])->withInput();
        }

        $fileTersimpan = [];

        try {
            DB::transaction(function () use ($request, $pesanan, &$fileTersimpan) {
                // Buat data pengajuan return.
                $pengajuan = return_produk::create([
                    'user_id' => Auth::id(),
                    'pesanan_id' => $pesanan->id,
                    'alasan' => $request->input('alasan_return'),
                    'keterangan' => $request->input('keterangan_return'),
                    'status' => 'diajukan',
                ]);

                // Simpan seluruh foto bukti.
                foreach ($request->file('foto_return', []) as $foto) {
                    $path = $foto->store('return', 'public');

                    if (!$path) {
                        throw new \RuntimeException(
                            'Foto bukti gagal disimpan.'
                        );
                    }

                    $fileTersimpan[] = $path;

                    foto_return_produk::create([
                        'return_produk_id' => $pengajuan->id,
                        'foto_path' => $path,
                    ]);
                }
            });

            return redirect()
                ->back()
                ->with('success', 'Pengajuan return berhasil dikirim.');
        } catch (Throwable $e) {
            // Hapus file jika transaksi atau penyimpanan gagal.
            if (!empty($fileTersimpan)) {
                Storage::disk('public')->delete($fileTersimpan);
            }

            report($e);

            return redirect()->back()->withErrors([
                'return' => 'Pengajuan return gagal disimpan. Silakan coba kembali.',
            ])->withInput();
        }
    }
    
}
