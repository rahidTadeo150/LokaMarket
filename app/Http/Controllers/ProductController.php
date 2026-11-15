<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use App\Models\produk_foto;
use App\Models\toko;
use App\Models\wishlist;
use App\Notifications\notificationLokaMarket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function pilihanProduk(Request $request)
    {

        $userId = Auth::id();

        $kategori = kategori::orderBy('nama', 'asc')->get();

        $query = produk::with(['kategori', 'toko', 'thumbnail'])->withAvg('ulasan', 'rating')->withCount('ulasan')->where('is_active', true);

        if ($request->filled('search')) {

            $keyword = trim($request->input('search'));

            $query->where(function ($q) use ($keyword) {

                $q->where('nama', 'like', "%{$keyword}%")
                    ->orWhereHas('toko', function ($toko) use ($keyword) {

                        $toko->where('nama_toko', 'like', "%{$keyword}%");

                    })->orWhereHas('kategori', function ($kategori) use ($keyword) {

                        $kategori->where('nama', 'like', "%{$keyword}%");

                    });

            });

        }

        if ($request->filled('kategori')) {

            $slugKategori = $request->input('kategori');

            $query->whereHas('kategori', function ($q) use ($slugKategori) {
                $q->where('slug', $slugKategori);
            });

        }

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

        $produk = $query->paginate(20)->withQueryString();

        $wishlistIds = Auth::check() ? wishlist::where('user_id', $userId)->pluck('produk_id')->toArray() : [];

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

        $produk = produk::with(['kategori', 'toko', 'thumbnail', 'preview'])
            ->withAvg('ulasan', 'rating')
            ->withCount('ulasan')
            ->where('slug', $request->produk)
            ->where('is_active', true)
            ->firstOrFail();

        $ulasan = $produk->ulasan()->with(['user', 'foto'])
            ->latest()
            ->paginate(5, ['*'], 'ulasan_page');

        $anotherProduk = produk::with(['kategori', 'toko', 'thumbnail'])
            ->withAvg('ulasan', 'rating')
            ->withCount('ulasan')
            ->where('toko_id', $produk->toko_id)
            ->where('id', '!=', $produk->id)
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        $jumlahProduk = produk::where('toko_id', $produk->toko_id)
            ->where('is_active', true)
            ->count();

        $isWishlisted = Auth::check() ? wishlist::where('user_id', Auth::id())->where('produk_id', $produk->id)->exists() : false;

        return view('user.detail-produk', compact(
            'produk',
            'ulasan',
            'anotherProduk',
            'jumlahProduk',
            'isWishlisted'
        ));

    }

    public function produkSeller(Request $request)
    {

        $user = auth()->user();

        $toko = $user->toko;

        if (! $toko) {
            abort(404, 'Toko tidak ditemukan.');
        }

        $query = produk::with(['kategori', 'thumbnail'])->where('toko_id', $toko->id);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {

            switch ($request->status) {

                case 'aktif':
                    $query->where('is_active', true)->where('stok', '>', 0);
                    break;

                case 'habis':
                    $query->where('stok', '<=', 0);
                    break;

                case 'nonaktif':
                    $query->where('is_active', false)->where('stok', '>', 0);
                    break;

            }

        }

        $produk = $query->latest()->paginate(10)->withQueryString();

        $kategori = kategori::orderBy('nama')->get();

        $jumlahSemua = produk::where('toko_id', $toko->id)->count();
        $jumlahAktif = produk::where('toko_id', $toko->id)->where('is_active', true)->where('stok', '>', 0)->count();
        $jumlahHabis = produk::where('toko_id', $toko->id)->where('stok', '<=', 0)->count();
        $jumlahNonaktif = produk::where('toko_id', $toko->id)->where('is_active', false)->where('stok', '>', 0)->count();

        return view('seller.produk-seller', compact(
            'produk',
            'kategori',
            'jumlahSemua',
            'jumlahAktif',
            'jumlahHabis',
            'jumlahNonaktif'
        ));

    }

    public function tambahProdukPage()
    {
        $kategori = kategori::orderBy('nama', 'asc')->get();

        return view('seller.form-tambah-produk', compact('kategori'));
    }

    public function storeProduk(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:150',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'deskripsi' => 'required|string|min:10|max:1000',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'preview_photos' => 'nullable|array|max:4',
            'preview_photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|integer|min:1',
            'is_active' => 'required|in:0,1',
        ]);

        $toko = toko::where('user_id', auth()->id())->first();

        if (! $toko) {
            return back()->withInput()
                ->with('error', 'Toko tidak ditemukan. Silakan lengkapi data toko terlebih dahulu.');
        }

        $thumbnailPath = null;
        $previewPaths = [];

        try {

            $thumbnailPath = $request->file('thumbnail')->store('produk/thumbnail', 'public');

            foreach ($request->file('preview_photos', []) as $foto) {
                $previewPaths[] = $foto->store('produk/preview', 'public');
            }

            DB::transaction(function () use ($validated, $toko, $thumbnailPath, $previewPaths) {

                $slugDasar = Str::slug($validated['nama']);
                $slug = $slugDasar;
                $nomor = 1;

                while (produk::where('slug', $slug)->exists()) {
                    $slug = $slugDasar.'-'.$nomor++;
                }

                $produk = produk::create([
                    'nama' => $validated['nama'],
                    'slug' => $slug,
                    'deskripsi' => $validated['deskripsi'],
                    'harga' => $validated['harga'],
                    'stok' => $validated['stok'],
                    'kategori_id' => $validated['kategori_id'],
                    'toko_id' => $toko->id,
                    'is_active' => $validated['is_active'],
                ]);

                $produk->foto()->create([
                    'foto' => $thumbnailPath,
                    'tipe' => 'thumbnail',
                ]);

                foreach ($previewPaths as $path) {
                    $produk->foto()->create([
                        'foto' => $path,
                        'tipe' => 'preview',
                    ]);
                }

                auth()->user()->notify(
                    new notificationLokaMarket(
                        'Produk Berhasil Ditambahkan',
                        'Produk "'.$produk->nama.'" berhasil ditambahkan ke toko kamu.',
                        route('seller.produk'),
                        'fa-box-open'
                    )
                );

            });

        } catch (\Throwable $e) {

            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            if (! empty($previewPaths)) {
                Storage::disk('public')->delete($previewPaths);
            }

            report($e);

            return back()->withInput()
                ->with('error', 'Produk gagal disimpan. Silakan coba kembali.');

        }

        return redirect()->route('seller.produk')
            ->with('success', 'Produk berhasil ditambahkan.');

    }

    public function editProdukPage(string $slug)
    {

        $toko = toko::where('user_id', auth()->id())->firstOrFail();

        $produk = produk::with([
            'kategori',
            'thumbnail',
            'preview',
        ])->where('slug', $slug)->where('toko_id', $toko->id)->firstOrFail();

        $kategori = kategori::orderBy('nama')->get();

        return view('seller.edit-produk', compact(
            'produk',
            'kategori'
        ));

    }

    public function updateProduk(Request $request, string $slug)
    {

        $toko = toko::where('user_id', auth()->id())->firstOrFail();

        $produk = produk::where('slug', $slug)->where('toko_id', $toko->id)->firstOrFail();

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

        $idsHapus = collect($request->input('hapus_foto_ids', []))->map(fn ($id) => (int) $id)->unique()->values();

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

        $fileLama = $fotoDihapus->pluck('foto')->filter()->values()->all();

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

                    $thumbnailBaru = $request->file('thumbnail')->store('produk/thumbnail', 'public');

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

        $produk = produk::where('slug', $slug)->firstOrFail();

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
