<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_toko;
use App\Models\toko;
use App\Notifications\notificationLokaMarket;
use Illuminate\Http\Request;

class pengajuanTokoController extends Controller
{
    public function pengajuanTokoPage(Request $request)
    {

        $statusValid = ['pending', 'approved', 'rejected'];

        $status = $request->query('status');

        if (! in_array($status, $statusValid, true)) {
            $status = null;
        }

        $query = pengajuan_toko::with('user')
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $pengajuanToko = $query
            ->paginate(10)
            ->withQueryString();

        $jumlahStatus = pengajuan_toko::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $jumlahSemua = pengajuan_toko::count();

        $jumlahPending = $jumlahStatus->get('pending', 0);
        $jumlahApproved = $jumlahStatus->get('approved', 0);
        $jumlahRejected = $jumlahStatus->get('rejected', 0);

        return view('admin.pengajuan-toko', compact(
            'pengajuanToko',
            'status',
            'jumlahSemua',
            'jumlahPending',
            'jumlahApproved',
            'jumlahRejected'
        ));

    }

    public function approvePengajuan($id)
    {
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

        $customer = $pengajuan->user;

        $customer->update([
            'role' => 'pemilik_toko',
        ]);

        $customer->notify(

            new notificationLokaMarket(
                'Selamat, Anda Telah Menjadi Seller!',
                'Selamat! Pengajuan toko "'.
                $pengajuan->nama_toko.
                '" telah disetujui. Sekarang Anda resmi menjadi seller LokaMarket. Mulai kelola toko dan jual produk Anda!',
                route('seller.dashboard'),
                'fa-store'
            )

        );

        return redirect()
            ->back()
            ->with('success', 'Pengajuan toko berhasil disetujui dan toko berhasil dibuat.');
    }

    public function rejectPengajuan(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10|max:500',
        ]);

        $toko = pengajuan_toko::where('id', $id)->firstOrFail();

        $toko->update([
            'status' => 'rejected',
            'alasan_reject' => $request->alasan_penolakan,
            'rejected_at' => now(),
        ]);

        $customer = $toko->user;

        $customer->update([
            'role' => 'customer',
        ]);

        $customer->notify(

            new notificationLokaMarket(
                'Pengajuan Toko Ditolak',
                'Mohon maaf, pengajuan toko "'.
                $toko->nama_toko.
                '" belum dapat disetujui. Alasan penolakan: '.
                $request->validated['alasan_penolakan'].
                '. Silakan periksa kembali persyaratan pengajuan toko Anda.',
                route('cust.formDaftarToko'),
                'fa-circle-xmark'
            )

        );

        return redirect()
            ->back()
            ->with('success', 'Pengajuan toko berhasil ditolak.');

    }
}
