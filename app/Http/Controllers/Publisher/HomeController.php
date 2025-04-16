<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('publisher.home');
    }
    public function non_active()
    {
        return view('publisher.non_active');
    }
}
