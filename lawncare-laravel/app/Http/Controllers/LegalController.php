<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function privacy(): View
    {
        return view('legal.privacy', SiteData::all());
    }

    public function terms(): View
    {
        return view('legal.terms', SiteData::all());
    }
}
