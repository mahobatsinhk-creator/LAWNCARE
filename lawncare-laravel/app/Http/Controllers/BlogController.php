<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blogs.index', config('site'));
    }

    public function show(string $slug): View
    {
        $post = collect(config('site.blog_posts'))->firstWhere('slug', $slug);

        abort_unless($post, 404);

        $content = config("blog_content.{$slug}", []);
        $post = array_merge($post, $content);

        $relatedPosts = collect(config('site.blog_posts'))
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values();

        return view('blogs.show', array_merge(config('site'), [
            'post' => $post,
            'related_posts' => $relatedPosts,
        ]));
    }
}
