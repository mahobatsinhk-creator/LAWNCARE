<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use App\Support\SiteContentFields;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (SiteContent::sectionLabels() as $section => $label) {
            $data = [];

            foreach (SiteContentFields::allFieldsFor($section) as $key => $field) {
                $data[$key] = data_get(config('site'), $field['path']);
            }

            SiteContent::query()->updateOrCreate(
                ['section' => $section],
                ['data' => $data],
            );
        }
    }
}
