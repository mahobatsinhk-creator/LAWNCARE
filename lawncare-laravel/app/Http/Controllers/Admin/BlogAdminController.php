<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlogAdminController extends Controller
{
    public function index(): View
    {
        $modules = [
            [
                'title' => 'Blog Posts',
                'description' => 'Create, edit, publish, and delete blog articles.',
                'sections' => \App\Models\BlogPost::count(),
                'icon' => 'file',
                'route' => route('admin.blogs.posts.index'),
            ],
            [
                'title' => 'Blog Page Settings',
                'description' => 'Edit the blogs listing hero badge, title, and image.',
                'sections' => 1,
                'icon' => 'layout',
                'route' => route('admin.blogs.settings.edit'),
            ],
        ];

        return view('admin.blogs.index', compact('modules'));
    }
}
