<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function myProfilePage() {
        $user = Auth::user(); 
        
        return view('user.profil-user', compact('user'));
    }

    public function editProfilePage()
    {
        return view('user.edit-profil', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'no_telp' => ['required', 'string', 'max:20', Rule::unique('users', 'no_telp')->ignore($user->id)],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan', 'Tidak ingin memberitahukan'])],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('profil', 'public');
        }

        $user->update($validated);

        return redirect()->route('cust.myProfile')->with('success', 'Profil berhasil diperbarui.');
    }
    
    public function landingPage() {
        return view('user.landing-page');
    }

    public function caraKerjaPage() {
        return view('user.cara-kerja');
    }

    public function tentangKamiPage() {
        return view('user.tentang-kami');
    }

}
