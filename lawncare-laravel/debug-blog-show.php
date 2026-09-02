<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-blog-debug-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$slug = 'how-to-create-a-low-maintenance-garden-that-looks-beautiful-and-stays-healthy-year-round';

try {
    $post = App\Models\BlogPost::query()->where('slug', $slug)->first();

    if (! $post) {
        echo "Post not found in database.\n";
        exit;
    }

    echo "published_at: ".($post->published_at?->format('Y-m-d') ?? 'NULL')."\n";
    echo 'sections type: '.gettype($post->sections)."\n";
    echo 'sections count: '.(is_array($post->sections) ? count($post->sections) : 0)."\n";

    $public = $post->toPublicArray();
    echo "toPublicArray OK\n";

    $view = view('blogs.show', array_merge(App\Support\SiteData::all(), [
        'post' => $public,
        'related_posts' => App\Support\SiteData::relatedBlogPosts($slug),
    ]));

    echo 'view render: '.$view->render() ? 'OK ('.strlen($view->render()).' bytes)' : 'FAIL';
} catch (Throwable $e) {
    echo 'ERROR: '.$e->getMessage()."\n";
    echo $e->getFile().':'.$e->getLine()."\n";
}
