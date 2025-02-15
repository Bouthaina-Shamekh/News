<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Ad;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $ads = Ad::get();
        return view('site.home', compact('ads'));
    }

    public function about()
    {
        $abouts = About::first();
        return view('site.about', compact('abouts'));
    }

    public function contact()
    {
        $abouts = About::first();
        return view('site.contact', compact('abouts'));
    }

}

