<?php

namespace App\Support;

use App\Models\BlogPost;
use App\Models\BlogSetting;
use App\Models\SiteContent;

class SiteData
{
    public static function all(): array
    {
        $site = config('site');

        if (BlogPost::query()->exists()) {
            $site['blog_posts'] = BlogPost::published()
                ->ordered()
                ->get()
                ->map(fn (BlogPost $post) => $post->toPublicArray())
                ->all();
        }

        if (BlogSetting::query()->exists()) {
            $site['blogs_page'] = BlogSetting::current()->toPublicArray();
        }

        foreach (SiteContent::query()->get() as $record) {
            foreach ($record->data ?? [] as $key => $value) {
                $field = SiteContentFields::find($record->section, $key);

                if ($field) {
                    data_set($site, $field['path'], $value);
                }
            }
        }

        return $site;
    }

    public static function findBlogPost(string $slug): ?array
    {
        $post = BlogPost::query()->where('slug', $slug)->first();

        if ($post) {
            $public = $post->toPublicArray();
            $legacy = config('blog_content.'.$slug, []);

            return array_merge($legacy, $public, [
                'sections' => ! empty($public['sections']) ? $public['sections'] : ($legacy['sections'] ?? []),
                'quote' => $public['quote'] ?? ($legacy['quote'] ?? null),
                'author_bio' => $public['author_bio'] ?? ($legacy['author_bio'] ?? null),
                'reading_time' => $public['reading_time'] ?? ($legacy['reading_time'] ?? null),
                'author_avatar' => $public['author_avatar'] ?? ($legacy['author_avatar'] ?? null),
            ]);
        }

        $legacy = collect(config('site.blog_posts', []))->firstWhere('slug', $slug);

        if (! $legacy) {
            return null;
        }

        return array_merge($legacy, config('blog_content.'.$slug, []));
    }

    public static function relatedBlogPosts(string $slug, int $limit = 3): array
    {
        $posts = BlogPost::query()->exists()
            ? BlogPost::published()->ordered()->get()->map->toPublicArray()->all()
            : config('site.blog_posts', []);

        return collect($posts)
            ->where('slug', '!=', $slug)
            ->take($limit)
            ->values()
            ->all();
    }
}
