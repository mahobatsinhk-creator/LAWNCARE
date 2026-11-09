<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/', HomeController::class);
Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', ContactController::class)->name('contact');
Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms-and-conditions', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/get-quote', QuoteController::class)->name('quote');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::redirect('/blogs/fall-cleanup-edmonton-prepare-winter', '/blogs/fall-cleanup-edmonton', 301);
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::redirect('/services', '/#services')->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::post('/get-quote', [LeadController::class, 'store'])->name('quote.store');
Route::post('/contact/inquiry', [ContactInquiryController::class, 'store'])->name('contact.inquiry.store');
