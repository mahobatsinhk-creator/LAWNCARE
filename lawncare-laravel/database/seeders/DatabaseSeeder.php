<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()->updateOrCreate(
            ['email' => 'admin@lawncareandsnowremovalexperts.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Admin@12345'),
            ],
        );

        $this->call(BlogSeeder::class);
        $this->call(SiteContentSeeder::class);
    }
}
