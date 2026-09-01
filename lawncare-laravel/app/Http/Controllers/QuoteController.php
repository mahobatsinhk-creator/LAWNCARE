<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function __invoke(): View
    {
        return view('quote.index', SiteData::all());
    }
}
