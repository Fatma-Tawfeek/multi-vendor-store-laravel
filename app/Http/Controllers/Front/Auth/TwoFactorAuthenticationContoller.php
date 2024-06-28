<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorAuthenticationContoller extends Controller
{
    public function index()
    {
        return view('front.auth.two-factor-auth');
    }
}
