<?php

namespace App\Http\Controllers;

use App\Models\penarikan_saldo;
use App\Models\Rekening_penjual;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class rekeningSellerController extends Controller
{
    public function storeRekening(Request $request)
    {

        $toko = Auth::user()->toko;

        if (! $toko) {

            return back()->with('error', 'Toko tidak ditemukan.');

        }

        $validated = $request->validate([
            'metode' => 'required|in:bank,ewallet',
            'nama_bank' => 'required|string|max:100',
            'nama_pemilik' => 'required|string|max:100',
            'nomor_rekening' => 'required|string|max:50',
            'is_default' => 'nullable|boolean',
        ], [
            'metode.required' => 'Jenis rekening wajib dipilih.',
            'metode.in' => 'Jenis rekening tidak valid.',
            'nama_bank.required' => 'Nama bank atau penyedia wajib diisi.',
            'nama_bank.max' => 'Nama bank maksimal 100 karakter.',
            'nama_pemilik.required' => 'Nama pemilik rekening wajib diisi.',
            'nama_pemilik.max' => 'Nama pemilik maksimal 100 karakter.',
            'nomor_rekening.required' => 'Nomor rekening wajib diisi.',
            'nomor_rekening.max' => 'Nomor rekening maksimal 50 karakter.',
        ]);

        try {

            DB::transaction(function () use ($validated, $toko) {

                $rekeningToko = Rekening_penjual::where('toko_id', $toko->id)->lockForUpdate()->get();

                $isDefault = $rekeningToko->isEmpty() || $requestIsDefault = false;

                $isDefault = $rekeningToko->isEmpty() || (bool) request()->input('is_default', false);

                if ($isDefault) {

                    Rekening_penjual::where('toko_id', $toko->id)
                        ->update([
                            'is_default' => false,
                        ]);

                }

                Rekening_penjual::create([
                    'toko_id' => $toko->id,
                    'metode' => $validated['metode'],
                    'nama_bank' => $validated['nama_bank'],
                    'nama_pemilik' => $validated['nama_pemilik'],
                    'nomor_rekening' => $validated['nomor_rekening'],
                    'is_default' => $isDefault,
                ]);

            }, 3);

            return redirect()->route('seller.balance')
                ->with('success', 'Rekening pencairan berhasil ditambahkan.');

        } catch (\Throwable $e) {

            report($e);

            return back()->withInput()
                ->with('error', 'Gagal menambahkan rekening. Silakan coba kembali.');

        }

    }

    public function deleteRekening($id)
    {

        $toko = auth()->user()->toko;

        if (! $toko) {
            return back()->with('error', 'Toko tidak ditemukan.');
        }

        try {

            DB::transaction(function () use ($id, $toko) {

                Toko::whereKey($toko->id)->lockForUpdate()->firstOrFail();

                $rekening = Rekening_penjual::where('toko_id', $toko->id)->whereKey($id)->lockForUpdate()->firstOrFail();

                $masihDigunakan = penarikan_saldo::where(
                    'rekening_penjual_id',
                    $rekening->id
                )->exists();

                if ($masihDigunakan) {

                    throw ValidationException::withMessages([
                        'rekening' => 'Rekening tidak dapat dihapus karena sudah digunakan dalam riwayat pencairan saldo.',
                    ]);

                }

                $isDefault = (bool) $rekening->is_default;

                $rekening->delete();

                if ($isDefault) {

                    $rekeningPengganti = Rekening_penjual::where('toko_id', $toko->id)->orderByDesc('created_at')->first();

                    if ($rekeningPengganti) {

                        $rekeningPengganti->update([
                            'is_default' => true,
                        ]);

                    }

                }

            }, 3);

            return back()->with('success', 'Rekening berhasil dihapus.');

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Gagal menghapus rekening. Silakan coba kembali.'
            );
        }

    }

    public function setRekeningUtama($id)
    {
        $toko = auth()->user()->toko;

        if (! $toko) {

            return back()->with('error', 'Toko tidak ditemukan.');

        }

        try {

            DB::transaction(function () use ($id, $toko) {

                Toko::whereKey($toko->id)->lockForUpdate()->firstOrFail();

                $rekening = Rekening_penjual::where('toko_id', $toko->id)->whereKey($id)->lockForUpdate()->firstOrFail();

                if ($rekening->is_default) {

                    return;

                }

                Rekening_penjual::where('toko_id', $toko->id)
                    ->update([
                        'is_default' => false,
                    ]);

                $rekening->update([
                    'is_default' => true,
                ]);

            }, 3);

            return back()->with(
                'success',
                'Rekening utama berhasil diperbarui.'
            );

        } catch (\Throwable $e) {

            report($e);

            return back()->with(
                'error',
                'Gagal mengganti rekening utama. Silakan coba kembali.'
            );

        }

    }
}
