<?php

namespace App\Http\Controllers;

use App\Models\foto_return_produk;
use App\Models\pesanan;
use App\Models\return_produk;
use App\Services\SaldoPenjualService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class returnController extends Controller
{

    private function konfigurasiTabReturn(
        array $statistik,
        array $jumlahStatus
    ): array {
        return [
            'semua' => [
                'label' => 'Semua',
                'count' => $statistik['total'] ?? 0,
            ],
            'diajukan' => [
                'label' => 'Menunggu Review',
                'count' => ($jumlahStatus['diajukan'] ?? 0)
                    + ($jumlahStatus['menunggu_review'] ?? 0),
            ],
            'disetujui' => [
                'label' => 'Disetujui',
                'count' => $statistik['disetujui'] ?? 0,
            ],
            'ditolak' => [
                'label' => 'Ditolak',
                'count' => $statistik['ditolak'] ?? 0,
            ],
        ];
    }

    private function konfigurasiLabelStatusReturn(): array
    {
        return [
            'diajukan' => 'Menunggu Review',
            'menunggu_review' => 'Menunggu Review',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
        ];
    }

    private function konfigurasiWarnaStatusReturn(): array
    {
        return [
            'diajukan' => 'bg-amber-50 text-amber-700',
            'menunggu_review' => 'bg-amber-50 text-amber-700',
            'disetujui' => 'bg-emerald-50 text-emerald-700',
            'ditolak' => 'bg-red-50 text-red-700',
        ];
    }


    public function pengajuanReturnPage(Request $request)
    {
        $query = return_produk::with([
            'user',
            'pesanan',
            'fotoReturn',
        ]);

        $status = $request->query('status', 'semua');

        if ($status === 'diajukan') {

            $query->whereIn('status', ['diajukan']);

        } elseif (in_array($status, ['diproses', 'disetujui', 'ditolak', 'selesai'], true)) {

            $query->where('status', $status);

        } else {

            $status = 'semua';

        }

        if ($request->filled('search')) {

            $search = trim($request->query('search'));

            $query->where(function ($q) use ($search) {

                $q->whereHas('pesanan', function ($pesananQuery) use ($search) {

                    $pesananQuery->where('nomor_pesanan', 'like', "%{$search}%");

                })->orWhereHas('user', function ($userQuery) use ($search) {

                    $userQuery->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");

                });

            });

        }

        $pengajuan = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        $statistik = [
            'total' => return_produk::count(),
            'menunggu' => return_produk::whereIn('status', ['diajukan'])->count(),
            'diproses' => return_produk::where('status', 'diproses')->count(),
            'disetujui' => return_produk::where('status', 'disetujui')->count(),
            'ditolak' => return_produk::where('status', 'ditolak')->count(),
            'selesai' => return_produk::where('status', 'selesai')->count(),
        ];

        $jumlahStatus = return_produk::query()->select('status')->selectRaw('COUNT(*) as jumlah')->groupBy('status')->pluck('jumlah', 'status')->toArray();

        $statusAktif = $status;

        $tabs = $this->konfigurasiTabReturn($statistik, $jumlahStatus);
        $statusLabel = $this->konfigurasiLabelStatusReturn();
        $statusClass = $this->konfigurasiWarnaStatusReturn();

        return view('admin.pengajuan-return', compact(
            'pengajuan',
            'statistik',
            'jumlahStatus',
            'statusAktif',
            'tabs',
            'statusLabel',
            'statusClass'
        ));

    }


    public function pengajuanReturn(Request $request, string $nomor_pesanan, SaldoPenjualService $saldoService)
    {

        $validated = $request->validate([
            'alasan_return' => 'required|string|in:produk_tidak_sesuai,produk_rusak,produk_tidak_diterima,produk_salah,lainnya',
            'keterangan_return' => 'required|string|max:1000|min:20',
            'foto_return' => 'required|array|min:1|max:5',
            'foto_return.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'alasan_return.required' => 'Silakan pilih alasan return.',
            'alasan_return.string' => 'Alasan return harus berupa teks.',
            'alasan_return.in' => 'Alasan return tidak valid.',

            'keterangan_return.required' => 'Silakan isi keterangan return.',
            'keterangan_return.string' => 'Keterangan return harus berupa teks.',
            'keterangan_return.max' => 'Keterangan maksimal 1000 karakter.',

            'foto_return.required' => 'Silakan unggah foto bukti return.',
            'foto_return.array' => 'Format foto bukti return tidak valid.',
            'foto_return.min' => 'Unggah minimal 1 foto bukti.',
            'foto_return.max' => 'Maksimal 5 foto bukti.',

            'foto_return.*.required' => 'Setiap foto bukti wajib diisi.',
            'foto_return.*.image' => 'File bukti harus berupa gambar.',
            'foto_return.*.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto_return.*.max' => 'Ukuran setiap foto maksimal 5 MB.',
        ]);

        $user = Auth::user();

        $pesanan = Pesanan::where('nomor_pesanan', $nomor_pesanan)->where('user_id', $user->id)->firstOrFail();

        if (!in_array($pesanan->status, ['dikirim', 'selesai'], true)) {

            throw ValidationException::withMessages([
                'return' => 'Pesanan tidak dapat diajukan return pada status saat ini.',
            ]);

        }

        $sudahAda = return_produk::where('pesanan_id', $pesanan->id)->exists();

        if ($sudahAda) {

            throw ValidationException::withMessages([
                'return' => 'Pengajuan return untuk pesanan ini sudah tersedia.',
            ]);

        }

        $fileTersimpan = [];

        try {

            DB::transaction(function () use ($validated, $pesanan, $user, $request, &$fileTersimpan, $saldoService) {

                $return = return_produk::create([
                    'pesanan_id' => $pesanan->id,
                    'user_id' => $user->id,
                    'alasan' => $validated['alasan_return'],
                    'keterangan' => $validated['keterangan_return'],
                    'status' => 'diajukan',
                ]);

                foreach ($request->file('foto_return') as $foto) {

                    $path = $foto->store('return', 'public');

                    if (!$path) {

                        throw new \RuntimeException(
                            'Gagal menyimpan foto bukti return.'
                        );

                    }

                    $fileTersimpan[] = $path;

                    $return->fotoReturn()->create([
                        'foto_path' => $path,
                    ]);
                }

                $saldoService->bekukanSaldoPesanan($pesanan);

                $pesanan->update([
                    'status' => 'pengajuan_return',
                ]);

            });

        } catch (\Throwable $e) {

            foreach ($fileTersimpan as $path) {

                Storage::disk('public')->delete($path);

            }

            report($e);

            return back()->withInput()
                ->withErrors([
                    'return' => 'Pengajuan return gagal disimpan. Silakan coba kembali.',
                ]);

        }

        return back()->with(
            'success',
            'Pengajuan return berhasil dikirim.'
        );

    }

    public function detailPengajuanReturn(string $id)
    {

        $pengajuan = return_produk::with([
            'user',
            'pesanan',
            'fotoReturn',
        ])->findOrFail($id);

        $pesanan = $pengajuan->pesanan;
        $pengguna = $pengajuan->user;

        $statusClass = [
            'diajukan' => 'bg-amber-100 text-amber-700',
            'menunggu_review' => 'bg-amber-100 text-amber-700',
            'diproses' => 'bg-blue-100 text-blue-700',
            'disetujui' => 'bg-emerald-100 text-emerald-700',
            'ditolak' => 'bg-red-100 text-red-700',
            'selesai' => 'bg-gray-100 text-gray-700',
        ];

        $status = $pengajuan->status;

        $bisaDiproses = in_array($status, ['diajukan', 'menunggu_review'], true);

        return view('admin.detail-pengajuan-return', compact(
            'pengajuan',
            'pesanan',
            'pengguna',
            'statusClass',
            'status',
            'bisaDiproses'
        ));

    }

    public function approveReturn(string $id)
    {

        try {

            DB::transaction(function () use ($id) {

                $pengajuan = return_produk::whereKey($id)->lockForUpdate()->firstOrFail();

                if (!in_array($pengajuan->status, ['diajukan', 'menunggu_review'], true)) {

                    throw ValidationException::withMessages([
                        'return' => 'Pengajuan ini sudah diproses dan tidak dapat disetujui kembali.',
                    ]);

                }

                $pesanan = pesanan::whereKey($pengajuan->pesanan_id)->lockForUpdate()->firstOrFail();

                $pengajuan->update([
                    'status' => 'diproses',
                    'catatan_admin' => null,
                ]);

                $pesanan->update([
                    'status' => 'telah_direturn',
                ]);

            });

            return redirect()->route('admin.pengajuanReturn.detail', ['id' => $id])
                ->with('success', 'Pengajuan return berhasil disetujui dan masuk ke tahap pemrosesan.');

        } catch (ValidationException $e) {

            throw $e;

        } catch (\Throwable $e) {

            report($e);

            return back()->with(
                'error',
                'Pengajuan return gagal diproses. Silakan coba kembali.'
            );

        }

    }

    public function rejectReturn(Request $request, string $id)
    {

        $validated = $request->validate([
            'catatan_admin' => 'required|string|min:10|max:1000',
        ], [
            'catatan_admin.required' => 'Alasan penolakan wajib diisi.',
            'catatan_admin.min' => 'Alasan penolakan minimal 10 karakter.',
            'catatan_admin.max' => 'Alasan penolakan maksimal 1000 karakter.',
        ]);

        try {

            DB::transaction(function () use ($id, $validated, $saldoService) {

                $pengajuan = return_produk::whereKey($id)->lockForUpdate()->firstOrFail();

                if (!in_array($pengajuan->status, ['diajukan', 'menunggu_review'], true)) {

                    throw ValidationException::withMessages([
                        'return' => 'Pengajuan ini sudah diproses dan tidak dapat ditolak kembali.',
                    ]);

                }

                $pesanan = pesanan::whereKey($pengajuan->pesanan_id)->lockForUpdate()->firstOrFail();

                $pengajuan->update([
                    'status' => 'ditolak',
                    'catatan_admin' => $validated['catatan_admin'],
                ]);

                $saldoService->lepaskanSaldoBekuanReturn($pesanan);

                $pesanan->update([
                    'status' => 'return_ditolak',
                ]);

            });

            return redirect()->route('admin.pengajuanReturn.detail', ['id' => $id])
                ->with('success', 'Pengajuan return berhasil ditolak.');

        } catch (ValidationException $e) {

            throw $e;

        } catch (\Throwable $e) {

            report($e);

            return back()->withInput()
                ->with('error', 'Pengajuan return gagal ditolak. Silakan coba kembali.');

        }

    }

}
