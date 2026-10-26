<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_toko;
use App\Models\produk;
use App\Models\return_produk;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function profilAdminPage()
    {
        return view('admin.profile-admin');
    }

    public function dashboardAdmin()
    {

        $totalPengguna = User::count();
        $totalToko = toko::count();
        $totalProduk = produk::count();

        $totalPengajuan = pengajuan_toko::where(
            'status',
            'pending'
        )->count();


        $pengajuanToko = pengajuan_toko::with('user')->where('status', 'pending')->latest()->take(5)->get();

        $tokoTerbaru = toko::with('user')->latest()->take(5)->get();

        return view('admin.dashboard-admin', compact(
            'totalPengguna',
            'totalToko',
            'totalProduk',
            'totalPengajuan',
            'pengajuanToko',
            'tokoTerbaru'
        ));
    }

    public function penggunaPage()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(20);

        return view('admin.admin-pengguna', compact(
            'users'
        ));
    }

    public function withdrawPage()
    {
        return view('admin.withdraw');
    }

    public function pengajuanTokoPage(Request $request)
    {
        $pengajuanToko = pengajuan_toko::with('user')->latest()->paginate(10);

        return view('admin.pengajuan-toko', compact(
            'pengajuanToko'
        ));
    }

    public function detailPengajuanPage($id)
    {
        $toko = pengajuan_toko::with('user')->findOrFail($id);

        return view('admin.detail-pengajuan-toko', compact(
            'toko'
        ));

    }

}