<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('author');
            $table->date('published_at');
            $table->string('image');
            $table->string('reading_time')->nullable();
            $table->string('author_avatar')->nullable();
            $table->json('quote')->nullable();
            $table->json('sections')->nullable();
            $table->json('author_bio')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge');
            $table->string('title');
            $table->string('hero_image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_settings');
        Schema::dropIfExists('blog_posts');
    }
};
