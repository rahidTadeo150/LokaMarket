<?php

namespace App\Http\Controllers;

use App\Models\keranjang;
use App\Models\produk;
use App\Models\provinsi;
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
        
        return view('user.profil-user', compact('user'));
    }

    public function keranjangPage()
    {
       $keranjang = keranjang::with(['detail.produk.toko', 'detail.produk.kategori',])->where('user_id', Auth::id())->first();

        $subtotal = 0;
        $totalItem = 0;

        if ($keranjang) {
            foreach ($keranjang->detail as $detail) {
                $subtotal += $detail->produk->harga * $detail->quantity;
                $totalItem += $detail->quantity;
            }
        }

        $ongkir = $totalItem > 0 ? 15000 : 0;

        $totalPembayaran = $subtotal + $ongkir;

        $produk = Produk::with(['toko', 'kategori'])->where('is_active', true)->inRandomOrder()->take(4)->get();

        return view('user.keranjang', compact(
            'keranjang',
            'subtotal',
            'totalItem',
            'ongkir',
            'totalPembayaran',
            'produk'
        ));
    }

    public function checkoutPage()
    {
        $produk = produk::with('toko')
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('user.checkout', [
            'user' => Auth::user(),
            'produk' => $produk,
        ]);
    }

    public function invoicePage()
    {
        return view('user.invoice');
    }

    public function editProfilePage()
    {
        $user = Auth::user(); 

        return view('user.edit-profil', compact('user'));
    }

    public function updateProfile(Request $request)
    {
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
            'tanggal_lahir' => 'nullable|date',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $noTelp = preg_replace('/\D/', '', $request->no_telp);

        $noTelp = '+62' . $noTelp;

        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'no_telp' => $noTelp,
            'jenis_kelamin' => $request->jenis_kelamin ?? null,
            'tanggal_lahir' => $request->tanggal_lahir ?? null,
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

    public function benefitUpgradeAccount(Request $request)
    {
        return view('user.benefit-upgrade-account');
    }

    public function formDaftarToko(Request $request)
    {
        $provinsi = provinsi::orderBy('nama')->get();

        return view('user.form-daftar-toko', compact('provinsi'));
    }

    public function wishlistProduk(Request $request)
    {
        return view('user.wishlist');
    }
}
