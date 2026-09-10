<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sellerController extends Controller
{
    public function dashboardSeller() {
        return view('seller.dashboard-seller');
    }
    public function produkSeller()
{
    return view('seller.produk-seller');
}
}
