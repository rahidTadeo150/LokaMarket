<?php

namespace App\Http\Controllers;

use App\Models\alamat_pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class alamatController extends Controller
{

    public function storeAlamat(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'nama_penerima' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15|min:10',
            'provinsi' => 'required|exists:provinsi,id',
            'kota' => 'required|exists:kota,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'kode_pos' => 'required|digits:5',
            'alamat_lengkap' => 'required|string|min:10|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        $user = Auth::user();

        $isDefault = $request->boolean('is_default');

        if (!$user->alamat()->exists()) {
            $isDefault = true;
        }

        if ($isDefault) {
            $user->alamat()->where('is_default', true)
                ->update([
                    'is_default' => false
                ]);
        }

        $noTelp = preg_replace('/\D/', '', $request->no_telepon);
        $noTelp = '+62' . $noTelp;

        $user->alamat()->create([
            'label' => $request->label,
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $noTelp,
            'provinsi_id' => $request->provinsi,
            'kota_id' => $request->kota,
            'kecamatan_id' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'alamat_lengkap' => Str::title($request->alamat_lengkap),
            'is_default' => $isDefault,
        ]);

        return redirect()->route('cust.pilihAlamat')
            ->with(
                'success',
                'Alamat berhasil ditambahkan.'
            );
    }

    public function hapusAlamat($id)
    {
        $user = Auth::user();

        $alamat = $user->alamat()->findOrFail($id);

        $isDefault = $alamat->is_default;

        $alamat->delete();

        if ($isDefault) {

            $alamatBaru = $user->alamat()->orderBy('id', 'asc')->first();

            if ($alamatBaru) {

                $alamatBaru->update([
                    'is_default' => true,
                ]);

            }
        }

        return redirect()->route('cust.pilihAlamat')->with('success', 'Alamat berhasil dihapus.');
        
    }

    public function updateAlamat(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'nama_penerima' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15|min:10',
            'provinsi' => 'required|exists:provinsi,id',
            'kota' => 'required|exists:kota,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'kode_pos' => 'required|digits:5',
            'alamat_lengkap' => 'required|string|min:10|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        $user = Auth::user();

        $alamat = $user->alamat()->findOrFail($id);

        $isDefault = $request->boolean('is_default');

        if ($isDefault) {
            $user->alamat()->where('id', '!=', $alamat->id)
                ->update([
                    'is_default' => false
                ]);
        }

        $alamat->update([
            'label' => $request->label,
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => '+62' . $request->no_telepon,
            'provinsi_id' => $request->provinsi,
            'kota_id' => $request->kota,
            'kecamatan_id' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'alamat_lengkap' => Str::title($request->alamat_lengkap),
            'is_default' => $isDefault,
        ]);

        return redirect()->route('cust.pilihAlamat')
            ->with('success', 'Alamat berhasil diperbarui!');
    }

    public function setDefault(Request $request, $id)
    {
        $user = auth()->user();

        $alamat = alamat_pengguna::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        alamat_pengguna::where('user_id', $user->id)
            ->update([
                'is_default' => false,
            ]);

        $alamat->update([
            'is_default' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Alamat utama berhasil diperbarui.',
            'alamat' => $alamat->id,
        ]);
    }
}