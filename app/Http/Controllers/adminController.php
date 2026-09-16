<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function dashboardAdmin() {
        return view('admin.dashboard-admin');
    }

    public function penggunaAdmin()
    {
        return view('admin.admin-pengguna');
    }

    public function kelolaTokoAdmin()
    {
        return view('admin.admin-kelolatoko');
    }
}
