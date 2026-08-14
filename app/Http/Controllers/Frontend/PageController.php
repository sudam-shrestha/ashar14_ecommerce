<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function policy()
    {
        return view('frontend.policy');
    }
}
