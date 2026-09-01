<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'author',
        'published_at',
        'image',
        'reading_time',
        'author_avatar',
        'quote',
        'sections',
        'author_bio',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'quote' => 'array',
            'sections' => 'array',
            'author_bio' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->orderByDesc('id');
    }

    public function toPublicArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'author' => $this->author,
            'date' => $this->published_at?->format('F j, Y') ?? '',
            'image' => $this->image,
            'reading_time' => $this->reading_time,
            'author_avatar' => $this->author_avatar,
            'quote' => $this->quote,
            'sections' => is_array($this->sections) ? $this->sections : [],
            'author_bio' => $this->author_bio,
        ];
    }
}
