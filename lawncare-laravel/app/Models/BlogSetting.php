<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSetting extends Model
{
    protected $fillable = [
        'badge',
        'title',
        'hero_image',
    ];

    public static function current(): self
    {
        $setting = static::query()->first();

        if ($setting) {
            return $setting;
        }

        $defaults = config('site.blogs_page', []);

        return static::create([
            'badge' => $defaults['badge'] ?? 'our blogs',
            'title' => $defaults['title'] ?? 'Tips for better garden spaces',
            'hero_image' => $defaults['hero_image'] ?? '/assets/harmone/images/LM0vRNvdYtrVYp26InVBjG2Om38c9a7.png',
        ]);
    }

    public function toPublicArray(): array
    {
        return [
            'badge' => $this->badge,
            'title' => $this->title,
            'hero_image' => $this->hero_image,
        ];
    }
}
