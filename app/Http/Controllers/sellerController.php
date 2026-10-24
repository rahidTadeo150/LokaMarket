<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\pesanan;
use App\Models\produk;
use App\Models\provinsi;
use App\Models\RekeningPenjual;
use App\Models\SaldoPenjual;
use App\Models\toko;
use App\Models\TransaksiSaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class sellerController extends Controller
{

    public function dashboardSeller()
    {

        $user = Auth::user();

        $toko = $user->toko;

        if (!$toko) {
            return redirect()->route('cust.statusPengajuan')
                ->with(
                    'error',
                    'Data toko Anda belum tersedia.'
                );
        }

        $produkAktif = produk::where('toko_id', $toko->id)->where('is_active', true)->count();
        $totalProduk = produk::where('toko_id', $toko->id)->count();

        $ratingToko = 0;

        return view('seller.dashboard-seller', compact(
            'user',
            'toko',
            'produkAktif',
            'totalProduk',
            'ratingToko'
        ));
    }

    public function editTokoPage()
    {
        $toko = Toko::where('user_id', Auth::id())->first();

        if (!$toko) {
            return redirect()
                ->route('seller.kelolaToko')
                ->with('error', 'Data toko belum tersedia.');
        }

        $provinsi = provinsi::orderBy('nama')->get();

        return view('seller.edit-profil-toko', compact(
            'toko',
            'provinsi'
        ));
    }

    public function formEditToko()
    {
        return view('seller.form-edit-toko');
    }

    public function produkSeller(Request $request)
    {

        $user = auth()->user();

        $toko = $user->toko;

        if (!$toko) {
            abort(404, 'Toko tidak ditemukan.');
        }

        $query = Produk::with(['kategori', 'thumbnail'])->where('toko_id', $toko->id);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
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

        $kategori = Kategori::orderBy('nama')->get();

        $jumlahSemua = Produk::where('toko_id', $toko->id)->count();
        $jumlahAktif = Produk::where('toko_id', $toko->id)->where('is_active', true)->where('stok', '>', 0)->count();
        $jumlahHabis = Produk::where('toko_id', $toko->id)->where('stok', '<=', 0)->count();
        $jumlahNonaktif = Produk::where('toko_id', $toko->id)->where('is_active', false)->where('stok', '>', 0)->count();

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

    public function daftarPesananPage(Request $request)
    {

        $user = auth()->user();

        $toko = $user->toko;

        if (!$toko) {
            return redirect()->back()->with('error', 'Data toko tidak ditemukan.');
        }

        $statusValid = ['dibayar', 'diproses', 'dikirim'];

        $status = $request->query('status', 'dibayar');

        if (!in_array($status, $statusValid, true)) {
            $status = 'dibayar';
        }

        $query = Pesanan::query()->where('status', $status)->whereHas('detail.produk', function ($q) use ($toko) {
                $q->where('toko_id', $toko->id);
            })->with([
                'user',
                'provinsi',
                'kota',
                'kecamatan',
                'detail.produk.thumbnail',
            ])->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;

                $q->where(function ($subQuery) use ($search) {
                    $subQuery->where('nomor_pesanan', 'like', "%{$search}%")
                        ->orWhere('nama_penerima', 'like', "%{$search}%");
                });
            })->latest();

        $pesanan = $query->paginate(10)->withQueryString();

        $jumlahDibayar = Pesanan::where('status', 'dibayar')->whereHas('detail.produk', fn ($q) => $q->where('toko_id', $toko->id))->count();
        $jumlahDiproses = Pesanan::where('status', 'diproses')->whereHas('detail.produk', fn ($q) => $q->where('toko_id', $toko->id))->count();
        $jumlahDikirim = Pesanan::where('status', 'dikirim')->whereHas('detail.produk', fn ($q) => $q->where('toko_id', $toko->id))->count();

        return view('seller.daftar-pesanan', compact(
            'toko',
            'pesanan',
            'jumlahDibayar',
            'jumlahDiproses',
            'jumlahDikirim',
            'status'
        ));

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

        if (!$toko) {
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
                    $slug = $slugDasar . '-' . $nomor++;
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

            });

        } catch (\Throwable $e) {

            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            if (!empty($previewPaths)) {
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

        $toko = Toko::where('user_id', auth()->id())->firstOrFail();

        $produk = Produk::with([
            'kategori',
            'thumbnail',
            'preview',
        ])->where('slug', $slug)->where('toko_id', $toko->id)->firstOrFail();

        $kategori = Kategori::orderBy('nama')->get();

        return view('seller.edit-produk', compact(
            'produk',
            'kategori'
        ));

    }

    public function createPin()
    {

        $user = auth()->user();

        $toko = $user->toko;

        return view('seller.buat-pin-toko', compact('toko'));

    }

    public function storePin(Request $request)
    {

        $request->validate([
            'pin' => 'required|string|digits:6|confirmed',
        ], [
            'pin.required' => 'PIN toko wajib diisi.',
            'pin.string' => 'PIN toko harus berupa teks.',
            'pin.digits' => 'PIN toko harus terdiri dari 6 angka.',
            'pin.confirmed' => 'Konfirmasi PIN tidak cocok.',
        ]);

        $user = auth()->user();

        $toko = $user;

        $toko->update([
            'pin' => Hash::make($request->pin),
        ]);

        return redirect()->route('seller.dashboard')
            ->with(
                'success',
                'PIN toko berhasil dibuat. Selamat datang di dashboard toko.'
            );
    }

    public function verifyPinPage()
    {
        if (!auth()->user()->pin) {
            return redirect()->route('seller.createPin');
        }

        return view('user.verify-pin');
    }

    public function verifyPin(Request $request)
    {

        $request->validate([
            'pin' => ['required', 'digits:6'],
        ], [
            'pin.required' => 'Masukkan PIN toko.',
            'pin.digits' => 'PIN harus terdiri dari 6 angka.',
        ]);

        $user = $request->user();

        if (!$user->pin || !Hash::check($request->pin, $user->pin)) {
            throw ValidationException::withMessages([
                'pin' => 'PIN toko salah.',
            ]);
        }

        $request->session()->regenerate();

        $request->session()->put([
            'toko_pin_user_id' => $user->id,
            'toko_pin_verified_at' => now()->timestamp,
        ]);

        return redirect()->intended(route('seller.dashboard'));

    }

    public function lockToko(Request $request)
    {

        $request->session()->forget([
            'toko_pin_verified_at',
            'toko_pin_user_id',
        ]);

        return redirect()->route('seller.verifyPin')
            ->with('success', 'Akses toko berhasil dikunci.');

    }

    public function saldoSayaPage(Request $request)
    {

        $toko = Auth::user()->toko;

        abort_if(!$toko, 403, 'Akun ini belum memiliki toko.');

        $saldo = SaldoPenjual::firstOrCreate(['toko_id' => $toko->id], [
                'saldo_pending' => 0,
                'saldo_tersedia' => 0,
                'saldo_ditahan' => 0,
            ]
        );

        $rekening = RekeningPenjual::where('toko_id', $toko->id)->orderByDesc('is_default')->orderByDesc('id')->get();

        $transaksi = TransaksiSaldo::where('saldo_penjual_id', $saldo->id)->latest()->paginate(10);

        return view('seller.saldo-saya', compact(
            'saldo',
            'rekening',
            'transaksi'
        ));

    }

}
