<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostAdminController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $posts = BlogPost::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', '%'.Str::slug($search).'%');
                });
            })
            ->ordered()
            ->paginate(12)
            ->withQueryString();

        return view('admin.blogs.posts.index', compact('posts', 'search'));
    }

    public function create(): View
    {
        return view('admin.blogs.posts.create', [
            'post' => new BlogPost([
                'is_published' => true,
                'published_at' => now(),
                'sections' => [],
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedPost($request);
        BlogPost::create($validated);

        return redirect()
            ->route('admin.blogs.posts.index')
            ->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $post): View
    {
        return view('admin.blogs.posts.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $validated = $this->validatedPost($request, $post);
        $post->update($validated);

        return redirect()
            ->route('admin.blogs.posts.index')
            ->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('admin.blogs.posts.index')
            ->with('success', 'Blog post deleted.');
    }

    private function validatedPost(Request $request, ?BlogPost $post = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_posts,slug,'.($post?->id ?? 'NULL')],
            'author' => ['required', 'string', 'max:120'],
            'published_at' => ['required', 'date'],
            'image' => ['required', 'string', 'max:500'],
            'reading_time' => ['nullable', 'string', 'max:40'],
            'author_avatar' => ['nullable', 'string', 'max:500'],
            'quote_text' => ['nullable', 'string', 'max:2000'],
            'quote_author' => ['nullable', 'string', 'max:120'],
            'quote_role' => ['nullable', 'string', 'max:190'],
            'author_bio_name' => ['nullable', 'string', 'max:120'],
            'author_bio_role' => ['nullable', 'string', 'max:120'],
            'author_bio_image' => ['nullable', 'string', 'max:500'],
            'author_bio_text' => ['nullable', 'string', 'max:2000'],
            'sections' => ['nullable', 'array'],
            'sections.*.type' => ['required', 'string', 'in:heading,paragraph,image,cards,list'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $validated['slug'] ?: Str::slug($validated['title']);

        $quote = null;
        if (! empty($validated['quote_text'])) {
            $quote = [
                'text' => $validated['quote_text'],
                'author' => $validated['quote_author'] ?? '',
                'role' => $validated['quote_role'] ?? '',
            ];
        }

        $authorBio = null;
        if (! empty($validated['author_bio_name']) || ! empty($validated['author_bio_text'])) {
            $authorBio = [
                'name' => $validated['author_bio_name'] ?? '',
                'role' => $validated['author_bio_role'] ?? '',
                'image' => $validated['author_bio_image'] ?? '',
                'text' => $validated['author_bio_text'] ?? '',
            ];
        }

        return [
            'slug' => $slug,
            'title' => $validated['title'],
            'author' => $validated['author'],
            'published_at' => $validated['published_at'],
            'image' => $validated['image'],
            'reading_time' => $validated['reading_time'] ?? null,
            'author_avatar' => $validated['author_avatar'] ?? null,
            'quote' => $quote,
            'sections' => $this->normalizeSections($validated['sections'] ?? []),
            'author_bio' => $authorBio,
            'is_published' => $request->boolean('is_published'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ];
    }

    private function normalizeSections(array $blocks): array
    {
        $sections = [];

        foreach ($blocks as $block) {
            $type = $block['type'] ?? null;

            if ($type === 'heading') {
                $text = trim(strip_tags((string) ($block['text'] ?? '')));
                if ($text !== '') {
                    $sections[] = ['type' => 'heading', 'text' => $text];
                }
                continue;
            }

            if ($type === 'paragraph') {
                $text = $this->sanitizeRichText((string) ($block['text'] ?? ''));
                if ($text !== '') {
                    $sections[] = ['type' => 'paragraph', 'text' => $text];
                }
                continue;
            }

            if ($type === 'image') {
                $src = trim((string) ($block['src'] ?? ''));
                if ($src === '') {
                    continue;
                }

                $sections[] = [
                    'type' => 'image',
                    'src' => $src,
                    'alt' => trim(strip_tags((string) ($block['alt'] ?? ''))),
                ];
                continue;
            }

            if ($type === 'cards') {
                $items = [];
                foreach ($block['items'] ?? [] as $item) {
                    $title = trim(strip_tags((string) ($item['title'] ?? '')));
                    $text = trim(strip_tags((string) ($item['text'] ?? '')));
                    if ($title !== '' || $text !== '') {
                        $items[] = ['title' => $title, 'text' => $text];
                    }
                }

                if ($items !== []) {
                    $sections[] = ['type' => 'cards', 'items' => $items];
                }
                continue;
            }

            if ($type === 'list') {
                $items = [];
                foreach ($block['items'] ?? [] as $item) {
                    $title = trim(strip_tags((string) ($item['title'] ?? '')));
                    $body = trim(strip_tags((string) ($item['body'] ?? '')));
                    if ($title !== '' || $body !== '') {
                        $items[] = ['title' => $title, 'body' => $body];
                    }
                }

                if ($items !== []) {
                    $sections[] = [
                        'type' => 'list',
                        'title' => trim(strip_tags((string) ($block['title'] ?? ''))),
                        'items' => $items,
                    ];
                }
            }
        }

        return $sections;
    }

    private function sanitizeRichText(string $html): string
    {
        $allowed = '<p><br><strong><b><em><i><ul><ol><li><a><h3><h4>';
        $clean = strip_tags($html, $allowed);
        $clean = preg_replace('/\s*on\w+\s*=\s*(["\']).*?\1/i', '', $clean) ?? $clean;
        $clean = preg_replace('/javascript:/i', '', $clean) ?? $clean;

        return trim($clean);
    }
}
