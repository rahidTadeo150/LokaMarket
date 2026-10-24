<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_toko;
use App\Models\toko;
use Illuminate\Http\Request;

class pengajuanTokoController extends Controller
{
    public function approvePengajuan($id) {
        $pengajuan = pengajuan_toko::where('id', $id)->firstOrFail();

        $pengajuan->update([
            'status' => 'approved',
            'alasan_penolakan' => null,
        ]);
        
        toko::create([
            'user_id' => $pengajuan->user_id,
            'nama_toko' => $pengajuan->nama_toko,
            'slug' => $pengajuan->slug,
            'deskripsi' => $pengajuan->deskripsi,
            'provinsi_id' => $pengajuan->provinsi_id,
            'kota_id' => $pengajuan->kota_id,
            'kecamatan_id' => $pengajuan->kecamatan_id,
            'kode_pos' => $pengajuan->kode_pos,
            'alamat_lengkap' => $pengajuan->alamat_lengkap,
            'no_telepon' => $pengajuan->no_telepon,
            'foto_profil' => $pengajuan->foto_profil,
        ]);

        $pengajuan->user->update([
            'role' => 'pemilik_toko',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan toko berhasil disetujui dan toko berhasil dibuat.');
    }

    public function rejectPengajuan(Request $request, $id) {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10|max:500',
        ]);

        $toko = pengajuan_toko::where('id', $id)->firstOrFail();

        $toko->update([
            'status' => 'rejected',
            'alasan_reject' => $request->alasan_penolakan,
            'rejected_at' => now(),
        ]);

        $toko->user->update([
            'role' => 'customer',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pengajuan toko berhasil ditolak.');
    }

}
