<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ratingController extends Controller
{
    public function ratingPage($nomorPesanan)
    {

        $pesanan = pesanan::with([
            'detail.produk.thumbnail',
            'detail.produk.toko',
            'detail.ulasan',
        ])
            ->where('nomor_pesanan', $nomorPesanan)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (! in_array($pesanan->status, ['diantar', 'dikirim', 'selesai'], true)) {
            return redirect()->route('cust.pesananSaya')
                ->with('error', 'Pesanan belum dapat diberikan penilaian.');
        }

        return view('user.ratingProduk', compact('pesanan'));

    }

    public function simpanRating(Request $request, $nomorPesanan)
    {

        $pesanan = pesanan::with(['detail.produk', 'detail.ulasan'])->where('nomor_pesanan', $nomorPesanan)->where('user_id', Auth::id())->firstOrFail();

        if (! in_array($pesanan->status, ['diantar', 'dikirim', 'selesai'], true)) {

            return redirect()->route('cust.pesananSaya')
                ->with('error', 'Pesanan belum dapat diberikan penilaian.');

        }

        $detailBelumDinilai = $pesanan->detail->filter(fn ($detail) => ! $detail->ulasan);

        if ($detailBelumDinilai->isEmpty()) {

            return redirect()->route('cust.ratingPesanan', $pesanan->nomor_pesanan)
                ->with('info', 'Semua produk dalam pesanan ini sudah diberikan penilaian.');

        }

        $validated = $request->validate([
            'rating' => 'required|array',
            'rating.*' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|array',
            'ulasan.*' => 'required|string|min:10|max:1000',
            'tag_ulasan' => 'nullable|array',
            'tag_ulasan.*' => 'nullable|array',
            'tag_ulasan.*.*' => 'string|in:Kualitas bagus,Harga terjangkau,Sesuai deskripsi,Kemasan rapi,Pengiriman cepat,Pelayanan baik',
            'foto' => 'nullable|array',
            'foto.*' => 'nullable|array|max:5',
            'foto.*.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $idDetailDiizinkan = $detailBelumDinilai->pluck('id')->map(fn ($id) => (string) $id)->all();

        $idRatingDikirim = array_keys($validated['rating']);
        $idUlasanDikirim = array_keys($validated['ulasan']);

        if (array_diff($idRatingDikirim, $idDetailDiizinkan) || array_diff($idUlasanDikirim, $idDetailDiizinkan)) {

            return back()->withInput()
                ->with('error', 'Data produk yang diberikan tidak valid.');

        }

        foreach ($idDetailDiizinkan as $detailId) {

            if (! array_key_exists($detailId, $validated['rating']) || ! array_key_exists($detailId, $validated['ulasan'])) {

                return back()->withInput()
                    ->with('error', 'Rating dan ulasan wajib diisi untuk setiap produk.');

            }

        }

        $fotoTersimpan = [];

        try {

            DB::transaction(function () use ($validated, $detailBelumDinilai, &$fotoTersimpan) {

                foreach ($detailBelumDinilai as $detail) {

                    $detailId = $detail->id;

                    $tagUlasan = $validated['tag_ulasan'][$detailId] ?? [];

                    $ulasan = $detail->ulasan()->create([
                        'user_id' => Auth::id(),
                        'produk_id' => $detail->produk_id,
                        'detail_pesanan_id' => $detail->id,
                        'rating' => $validated['rating'][$detailId],
                        'ulasan' => $validated['ulasan'][$detailId],
                        'tag_ulasan' => array_values($tagUlasan),
                    ]);

                    $daftarFoto = $validated['foto'][$detailId] ?? [];

                    foreach ($daftarFoto as $foto) {

                        $path = $foto->store('ulasan-produk', 'public');

                        if (! $path) {

                            throw new \RuntimeException(
                                'Gagal menyimpan foto ulasan.'
                            );

                        }

                        $fotoTersimpan[] = $path;

                        $ulasan->foto()->create([
                            'foto' => $path,
                        ]);

                    }

                }

            });

        } catch (Throwable $e) {

            if (! empty($fotoTersimpan)) {

                Storage::disk('public')->delete($fotoTersimpan);

            }

            throw $e;
        }

        return redirect()->route('cust.ratingPesanan', $pesanan->nomor_pesanan)
            ->with('success', 'Terima kasih! Penilaian produk berhasil disimpan.');

    }
}
