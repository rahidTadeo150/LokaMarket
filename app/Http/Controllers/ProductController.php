<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use App\Models\produk_foto;
use App\Models\toko;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function pilihanProduk(Request $request)
    {

        $userId = Auth::id();

        $kategori = Kategori::orderBy('nama', 'asc')->get();

        $query = Produk::with([
            'kategori',
            'toko',
            'thumbnail',
        ])->where('is_active', true);

        // Pencarian produk, toko, dan kategori
        if ($request->filled('search')) {
            $keyword = trim($request->input('search'));

            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                    ->orWhereHas('toko', function ($toko) use ($keyword) {
                        $toko->where('nama_toko', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('kategori', function ($kategori) use ($keyword) {
                        $kategori->where('nama', 'like', "%{$keyword}%");
                    });
            });
        }

        // Filter berdasarkan slug kategori
        if ($request->filled('kategori')) {
            $slugKategori = $request->input('kategori');

            $query->whereHas('kategori', function ($q) use ($slugKategori) {
                $q->where('slug', $slugKategori);
            });
        }

        // Sorting produk
        switch ($request->input('sort', 'default')) {
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;

            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;

            default:
                $query->latest('created_at');
                break;
        }

        // Pagination tetap mempertahankan parameter filter
        $produk = $query->paginate(20)->withQueryString();

        // Status wishlist pengguna
        $wishlistIds = Auth::check()
            ? wishlist::where('user_id', $userId)
                ->pluck('produk_id')
                ->toArray()
            : [];

        $produk->each(function ($item) use ($wishlistIds) {
            $item->is_wishlisted = in_array(
                $item->id,
                $wishlistIds
            );
        });

        return view('user.pilihan-produk', [
            'produk' => $produk,
            'kategori' => $kategori,
            'selectedKategori' => $request->input('kategori'),
            'sort' => $request->input('sort', 'default'),
            'search' => $request->input('search', ''),
        ]);

    }

    public function detailProdukPage(Request $request)
    {
        $produk = produk::with([
            'kategori',
            'toko',
            'thumbnail',
            'preview',
        ])->where('slug', $request->produk)->where('is_active', true)->firstOrFail();

        $anotherProduk = produk::with([
            'kategori',
            'toko',
            'thumbnail',
        ])->where('toko_id', $produk->toko_id)->where('id', '!=', $produk->id)->where('is_active', true)->latest()->take(4)->get();

        $jumlahProduk = produk::where('toko_id', $produk->toko_id)->where('is_active', true)->count();

        $isWishlisted = Auth::check() ? wishlist::where('user_id', Auth::id())->where('produk_id', $produk->id)->exists() : false;

        return view('user.detail-produk', compact(
            'produk',
            'anotherProduk',
            'jumlahProduk',
            'isWishlisted'
        ));
    }

    public function updateProduk(Request $request, string $slug)
    {

        $toko = toko::where('user_id', auth()->id())->firstOrFail();

        $produk = Produk::where('slug', $slug)->where('toko_id', $toko->id)->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'required|string|max:500',
            'is_active' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_preview' => 'nullable|array',
            'foto_preview.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto_ids' => 'nullable|array',
            'hapus_foto_ids.*' => 'required|integer|distinct',
        ]);

        $idsHapus = collect($request->input('hapus_foto_ids', []))->map(fn($id) => (int) $id)->unique()->values();

        $fotoDihapus = $produk->preview()->whereIn('id', $idsHapus)->get();

        if ($fotoDihapus->count() !== $idsHapus->count()) {
            throw ValidationException::withMessages([
                'hapus_foto_ids' => 'Foto preview yang ingin dihapus tidak valid.',
            ]);
        }

        $fotoBaru = $request->file('foto_preview', []);

        $jumlahPreviewSekarang = $produk->preview()->count();
        $jumlahPreviewAkhir = $jumlahPreviewSekarang
            - $fotoDihapus->count()
            + count($fotoBaru);

        if ($jumlahPreviewAkhir > 4) {
            throw ValidationException::withMessages([
                'foto_preview' => 'Maksimal hanya 4 foto preview.',
            ]);
        }

        $fileLama = $fotoDihapus->pluck('foto')
            ->filter()
            ->values()
            ->all();

        $thumbnailLama = null;
        $thumbnailBaru = null;
        $fileBaru = [];

        try {
            DB::transaction(function () use ($request, $validated, $produk, $fotoDihapus, $fotoBaru, &$thumbnailLama, &$thumbnailBaru, &$fileBaru) {
                $produk->update([
                    'nama' => $validated['nama'],
                    'kategori_id' => $validated['kategori_id'],
                    'harga' => $validated['harga'],
                    'stok' => $validated['stok'],
                    'deskripsi' => $validated['deskripsi'],
                    'is_active' => $request->boolean('is_active'),
                ]);

                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $produk->thumbnail()->first();

                    $thumbnailLama = $thumbnail?->foto;

                    $thumbnailBaru = $request->file('thumbnail')
                        ->store('produk/thumbnail', 'public');

                    $fileBaru[] = $thumbnailBaru;

                    if ($thumbnail) {
                        $thumbnail->update([
                            'foto' => $thumbnailBaru,
                        ]);
                    } else {
                        produk_foto::create([
                            'produk_id' => $produk->id,
                            'foto' => $thumbnailBaru,
                            'tipe' => 'thumbnail',
                            'urutan' => 0,
                        ]);
                    }
                }

                foreach ($fotoDihapus as $foto) {
                    $foto->delete();
                }

                $urutan = (int) $produk->preview()->max('urutan') + 1;

                foreach ($fotoBaru as $file) {
                    $path = $file->store('produk/preview', 'public');

                    $fileBaru[] = $path;

                    produk_foto::create([
                        'produk_id' => $produk->id,
                        'foto' => $path,
                        'tipe' => 'preview',
                        'urutan' => $urutan++,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            foreach ($fileBaru as $path) {
                Storage::disk('public')->delete($path);
            }
            throw $e;
        }

        $semuaFileLama = array_filter([...$fileLama, $thumbnailLama]);

        foreach (array_unique($semuaFileLama) as $path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->route('seller.editProduk', ['slug' => $produk->slug])
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduk(string $slug)
    {

        $produk = Produk::where('slug', $slug)->firstOrFail();

        abort_unless($produk->toko && (int) $produk->toko->user_id === (int) auth()->id(), 403);

        $produk->delete();

        return redirect()->route('seller.produk')
            ->with('success', 'Produk berhasil dihapus.');

    }

    public function detailTokoPage(Request $request)
    {
        return view('user.detail-toko');
    }

    public function kategoriPage(Request $request)
    {
        $kategoriList = kategori::withCount('produk')->orderBy('nama', 'asc')->get();
        return view('user.kategori-produk', compact('kategoriList'));
    }
}
