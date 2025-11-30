<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil testimoni terbaru (max 6)
        $testimonis = Testimoni::latest()->take(6)->get();

        return view('customer.pages.beranda', compact('testimonis'));
    }
}