<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\BlogPageAdminController;
use App\Http\Controllers\Admin\BlogPostAdminController;
use App\Http\Controllers\Admin\ContentAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryAdminController;
use App\Http\Controllers\Admin\LeadAdminController;
use App\Http\Controllers\Admin\MediaUploadController;
use App\Http\Controllers\Admin\ServiceAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/services', [ServiceAdminController::class, 'index'])->name('services.index');
    Route::get('/content', [ContentAdminController::class, 'index'])->name('content.index');
    Route::get('/content/{section}', [ContentAdminController::class, 'edit'])->name('content.edit');
    Route::put('/content/{section}', [ContentAdminController::class, 'update'])->name('content.update');
    Route::post('/media/upload', [MediaUploadController::class, 'store'])->name('media.upload');
    Route::get('/leads', [LeadAdminController::class, 'index'])->name('leads.index');
    Route::get('/leads/{lead}', [LeadAdminController::class, 'show'])->name('leads.show');
    Route::patch('/leads/{lead}/status', [LeadAdminController::class, 'updateStatus'])->name('leads.status');
    Route::get('/inquiries', [InquiryAdminController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiryAdminController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}/status', [InquiryAdminController::class, 'updateStatus'])->name('inquiries.status');
    Route::get('/blogs', [BlogAdminController::class, 'index'])->name('blogs.index');
    Route::resource('blogs/posts', BlogPostAdminController::class)
        ->parameters(['posts' => 'post'])
        ->names('blogs.posts')
        ->except(['show']);
    Route::get('/blogs/settings', [BlogPageAdminController::class, 'edit'])->name('blogs.settings.edit');
    Route::put('/blogs/settings', [BlogPageAdminController::class, 'update'])->name('blogs.settings.update');
});
