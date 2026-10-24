<?php

namespace App\Http\Controllers;

use App\Models\alamat_pengguna;
use App\Models\kategori;
use App\Models\keranjang;
use App\Models\pengajuan_toko;
use App\Models\pesanan;
use App\Models\produk;
use App\Models\provinsi;
use App\Models\toko;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function landingPage() {
        $produk = produk::with('kategori')->inRandomOrder()->take(4);

        return view('user.landing-page', [
            'produk' => $produk->get(),
        ]);
    }

    public function caraKerjaPage() {
        return view('user.cara-kerja');
    }

    public function tentangKamiPage() {
        return view('user.tentang-kami');
    }
    
    public function myProfilePage() {
        $user = Auth::user(); 
        $alamatUtama = alamat_pengguna::where('user_id', auth()->id())->where('is_default', true)->first();
        
        return view('user.profil-user', compact(
            'user',
            'alamatUtama'
        ));
    }

    public function keranjangPage() {

        $keranjang = keranjang::with([
            'detail.produk.thumbnail',
            'detail.produk.toko',
            'detail.produk.kategori',
        ])->where('user_id', Auth::id())->first();

        $detailKeranjang = $keranjang?->detail ?? collect();

        $subtotal = 0;
        $totalItem = 0;

        foreach ($detailKeranjang as $detail) {
            $detail->subtotal = $detail->produk->harga * $detail->quantity;

            $subtotal += $detail->subtotal;
            $totalItem += $detail->quantity;
        }

        $ongkir = $totalItem > 0 ? 15000 : 0;

        if ($subtotal >= 200000) {
            $ongkir = 0;
        }

        $totalPembayaran = $subtotal + $ongkir;

        $produk = produk::with(['thumbnail', 'toko', 'kategori'])->where('is_active', true)->inRandomOrder()->take(4)->get();

        return view('user.keranjang', compact(
            'keranjang',
            'subtotal',
            'totalItem',
            'ongkir',
            'totalPembayaran',
            'produk'
        ));

    }

    public function checkoutPage() {

        $user = Auth::user();

        $keranjang = keranjang::with([
            'detail.produk.toko',
            'detail.produk.kategori',
            'detail.produk.thumbnail',
        ])->where('user_id', $user->id)->first();

        if (!$keranjang || $keranjang->detail->isEmpty()) {
            return redirect()->route('cust.keranjang')
                ->with(
                    'error',
                    'Keranjang masih kosong. Silakan tambahkan produk terlebih dahulu.'
                );
        }

        $alamat = $user->alamat()->where('is_default', true)->first();

        $subtotal = 0;
        $totalItem = 0;

        foreach ($keranjang->detail as $detail) {
            $subtotal += $detail->produk->harga * $detail->quantity;
            $totalItem += $detail->quantity;
        }

        $ongkir = $subtotal >= 200000 ? 0 : 15000;
        $totalPembayaran = $subtotal + $ongkir;

        return view('user.checkout', compact(
            'keranjang',
            'alamat',
            'subtotal',
            'totalItem',
            'ongkir',
            'totalPembayaran'
        ));

    }

    public function invoicePage() {
        return view('user.invoice');
    }

    public function editProfilePage() {
        $user = Auth::user(); 

        return view('user.edit-profil', compact('user'));
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        if (!$user) { 
            return redirect()->route('cust.login')
                ->with(
                    'error', 
                    'Silakan login terlebih dahulu.'
                ); 
        }
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'nama' => 'required|string|max:255,',
            'no_telp' => 'required|string|max:15|min:10',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan,Tidak ingin memberitahukan',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $noTelp = preg_replace('/\D/', '', $request->no_telp);

        $noTelp = '+62' . $noTelp;

        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'no_telp' => $noTelp,
            'jenis_kelamin' => $request->jenis_kelamin ?? null,
        ]);

        if ($request->hasFile('foto_profil')) {

            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $path = $request->file('foto_profil')
                ->store('profile', 'public');

            $user->foto_profil = $path;
        }

        $user->save();


        return redirect()->route('cust.myProfile')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    public function benefitUpgradeAccount(Request $request) {
        return view('user.benefit-upgrade-account');
    }

    public function formDaftarToko(Request $request) {
        $toko = pengajuan_toko::where('user_id', auth()->id())->first();

        if ($toko) {
            return redirect()->route('cust.statusPengajuan');
        }

        $provinsi = Provinsi::orderBy('nama')->get();

        return view('user.form-daftar-toko', compact('provinsi'));
    }

    public function wishlistProduk(Request $request) {

        $userId = Auth::id();

        $wishlistQuery = wishlist::with([
            'produk.thumbnail',
            'produk.kategori',
            'produk.toko',
        ])->where('user_id', $userId)->whereHas('produk');

        if ($request->filled('kategori')) {
            $wishlistQuery->whereHas('produk.kategori', function ($query) use ($request) {
                $query->where('slug', $request->kategori);
            });
        }

        switch ($request->get('sort', 'terbaru')) {

            case 'harga_terendah':
                $wishlistQuery->orderBy(produk::select('harga')->whereColumn('produk.id', 'wishlist.produk_id'));
                break;

            case 'harga_tertinggi':
                $wishlistQuery->orderByDesc(produk::select('harga')->whereColumn('produk.id', 'wishlist.produk_id'));
                break;

            case 'nama':
                $wishlistQuery->orderBy(produk::select('nama')->whereColumn('produk.id', 'wishlist.produk_id'));
                break;

            default:
                $wishlistQuery->latest();
                break;

        }

        $wishlists = $wishlistQuery->paginate(8)->withQueryString();

        $wishlists->getCollection()->each(function ($item) {

            if ($item->produk) {
                $item->produk->is_wishlisted = true;
            }

        });

        $totalWishlist = wishlist::where('user_id', $userId)->whereHas('produk')->count();
        $totalNilai = wishlist::where('user_id', $userId)->whereHas('produk')->join('produk', 'wishlist.produk_id', '=', 'produk.id')->sum('produk.harga');
        
        $kategoriWishlist = kategori::whereHas('produk', function ($query) use ($userId) {
            $query->whereHas('wishlist', function ($wishlistQuery) use ($userId) {
                $wishlistQuery->where('user_id', $userId);
            });
        })->orderBy('nama')->get();

        return view('user.wishlist', compact(
            'wishlists',
            'totalWishlist',
            'totalNilai',
            'kategoriWishlist'
        ));

    }

    public function pilihAlamat(Request $request) {
        $alamat = alamat_pengguna::where('user_id', auth()->id()) ->with([
            'provinsi',
            'kota', 
            'kecamatan'
        ])->orderByDesc('is_default')->latest()->get();

        return view('user.pilih-alamat', compact(
            'alamat'
        ));
    }

    public function formAlamat(Request $request) {
        
        $provinsi = provinsi::orderBy('nama')->get();

        return view('user.form-tambah-alamat', compact('provinsi'));
    }

    public function formEditAlamat($id) {

        $alamat = Auth::user()->alamat()->with([
                'provinsi',
                'kota',
                'kecamatan'
            ])->findOrFail($id);

        $provinsi = Provinsi::orderBy('nama')->get();

        return view('user.form-edit-alamat', compact(
            'alamat',
            'provinsi'
        ));
    }

    public function statusPengajuan() {

        $user = auth()->user();

        $pengajuan = pengajuan_toko::where('user_id', $user->id)->latest()->first();

        $bisaAjukanKembali = false;
        $cooldownSelesai = null;

        if (!$pengajuan) {
            return view('user.status-pengajuan-toko', compact(
                'pengajuan',
                'bisaAjukanKembali',
                'cooldownSelesai'
            ));
        }

        if ($pengajuan->status === 'rejected') {

            if ($pengajuan->rejected_at) {

                $cooldownSelesai = $pengajuan->rejected_at->copy()->addHours(3);

                $bisaAjukanKembali = now()->greaterThanOrEqualTo(
                    $cooldownSelesai
                );

            }
        }

        return view('user.status-pengajuan-toko', compact(
            'pengajuan',
            'bisaAjukanKembali',
            'cooldownSelesai'
        ));
        
    }

}
