<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function landingPage() {
        return view('user.landing-page');
    }

    public function caraKerja() {
        return view('user.cara-kerja');
    }

    public function loginPage() {
        return view('user.auth.login-page');
    }
}
