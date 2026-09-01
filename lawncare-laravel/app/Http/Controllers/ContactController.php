<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __invoke(): View
    {
        return view('contact', SiteData::all());
    }
}
