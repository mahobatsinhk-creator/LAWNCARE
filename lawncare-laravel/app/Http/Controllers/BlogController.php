<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blogs.index', SiteData::all());
    }

    public function show(string $slug): View
    {
        $post = SiteData::findBlogPost($slug);

        abort_unless($post, 404);

        return view('blogs.show', array_merge(SiteData::all(), [
            'post' => $post,
            'related_posts' => SiteData::relatedBlogPosts($slug),
        ]));
    }
}
