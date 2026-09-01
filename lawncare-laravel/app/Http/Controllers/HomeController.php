<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', SiteData::all());
    }
}
