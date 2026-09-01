<?php

namespace App\Models;

use App\Support\SiteContentFields;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = [
        'section',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public static function sectionLabels(): array
    {
        return [
            'global' => 'Global Settings',
            'home' => 'Home Page',
            'about' => 'About Page',
            'services' => 'Services Page',
            'contact' => 'Contact Page',
            'quote' => 'Get Quote Page',
            'footer' => 'Footer',
        ];
    }

    public static function getFormData(string $section): array
    {
        abort_unless(isset(self::sectionLabels()[$section]), 404);

        $record = static::query()->where('section', $section)->first();
        $stored = $record->data ?? [];
        $values = [];

        foreach (SiteContentFields::allFieldsFor($section) as $key => $field) {
            if (array_key_exists($key, $stored)) {
                $values[$key] = $stored[$key];
                continue;
            }

            $values[$key] = data_get(config('site'), $field['path']);
        }

        return $values;
    }

    public static function saveFormData(string $section, array $data): void
    {
        $record = static::query()->where('section', $section)->first();
        $merged = array_merge($record->data ?? [], $data);

        static::query()->updateOrCreate(
            ['section' => $section],
            ['data' => $merged],
        );
    }
}
