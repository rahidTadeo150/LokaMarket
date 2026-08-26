<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function landingPage() {
        return view('user.landing-page');
    }
}
