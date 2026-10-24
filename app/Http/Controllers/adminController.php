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

    public function pengajuanReturnPage(Request $request)
    {

        $query = return_produk::with('user');

        $status = $request->query('status', 'semua');

        if ($status === 'diajukan') {

            $query->whereIn('status', [
                'diajukan',
                'menunggu_review',
            ]);

        } elseif (

            in_array($status, [
                'diproses',
                'disetujui',
                'ditolak',
                'selesai',
            ], true)

        ) {
            $query->where('status', $status);
        } else {
            $status = 'semua';
        }

        if ($request->filled('search')) {

            $search = trim($request->query('search'));

            $query->where(function ($q) use ($search) {
                $q->whereHas('pesanan', function ($pesananQuery) use ($search) {
                    $pesananQuery->where(
                        'nomor_pesanan',
                        'like',
                        "%{$search}%"
                    );
                })->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('nama', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });

        }

        $pengajuan = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        $statistik = [

            'total' => return_produk::count(),

            'menunggu' => return_produk::whereIn('status', [
                'diajukan',
                'menunggu_review',
            ])->count(),

            'diproses' => return_produk::where('status', 'diproses')->count(),
            'disetujui' => return_produk::where('status', 'disetujui')->count(),
            'ditolak' => return_produk::where('status', 'ditolak')->count(),
            'selesai' => return_produk::where('status', 'selesai')->count(),

        ];

        $jumlahStatus = return_produk::query()->select('status')->selectRaw('COUNT(*) as jumlah')->groupBy('status')->pluck('jumlah', 'status');

        return view('admin.pengajuan-return', compact(
            'pengajuan',
            'statistik',
            'jumlahStatus'
        ));

    }
}