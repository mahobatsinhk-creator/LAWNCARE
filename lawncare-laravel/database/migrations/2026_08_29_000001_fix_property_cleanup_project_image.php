<?php

use App\Models\SiteContent;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const CLEANUP_IMAGE = '/assets/harmone/images/POlpQUGMrGr1PxBqlnM8DPOCcCQ3b51.png';

    public function up(): void
    {
        $record = SiteContent::query()->where('section', 'home')->first();

        if (! $record || ! is_array($record->data['projects'] ?? null)) {
            return;
        }

        $projects = $record->data['projects'];
        $updated = false;

        foreach ($projects as $index => $project) {
            if (($project['title'] ?? '') !== 'Property cleanup') {
                continue;
            }

            if (($project['image'] ?? '') === self::CLEANUP_IMAGE) {
                return;
            }

            $projects[$index]['image'] = self::CLEANUP_IMAGE;
            $updated = true;
        }

        if ($updated) {
            $data = $record->data;
            $data['projects'] = $projects;
            $record->update(['data' => $data]);
        }
    }

    public function down(): void
    {
        $record = SiteContent::query()->where('section', 'home')->first();

        if (! $record || ! is_array($record->data['projects'] ?? null)) {
            return;
        }

        $projects = $record->data['projects'];

        foreach ($projects as $index => $project) {
            if (($project['title'] ?? '') === 'Property cleanup') {
                $projects[$index]['image'] = 'https://d13cw1lxlociqy.cloudfront.net/blx0cinf9qe5h560puy84ampjpny';
                break;
            }
        }

        $data = $record->data;
        $data['projects'] = $projects;
        $record->update(['data' => $data]);
    }
};
