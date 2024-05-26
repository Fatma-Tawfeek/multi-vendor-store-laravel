<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with('category')->active()
            ->latest()
            ->limit(8)
            ->get();
        return view('front.home', compact('products'));
    }
}
