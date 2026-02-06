<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with(['categories:id,name,slug', 'tags:id,name,slug'])
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('sys.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get(['id','name','slug']);
        $tags       = Tag::query()->orderBy('name')->get(['id','name','slug']);

        // IMPORTANT: pass post as null so shared form is safe
        $post = null;

        return view('sys.posts.create', compact('categories', 'tags', 'post'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:posts,slug'],
            'excerpt' => ['nullable','string','max:255'],
            'content' => ['nullable','string'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:6144'],
            'author_name' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_published' => ['nullable','boolean'],
            'published_at' => ['nullable','date'],

            'category_ids' => ['nullable','array'],
            'category_ids.*' => ['integer','exists:categories,id'],

            'tag_ids' => ['nullable','array'],
            'tag_ids.*' => ['integer','exists:tags,id'],

            'tag_names' => ['nullable','array'],
            'tag_names.*' => ['string','max:60'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = (bool) $request->input('is_published', 0);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        }

        // publish rules
        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        // upload
        if ($request->hasFile('image')) {
            File::ensureDirectoryExists(public_path('uploads/blogs'));
            $file = $request->file('image');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $name);
            $data['image'] = 'uploads/blogs/' . $name;
        }

        $categoryIds = $data['category_ids'] ?? [];
        $tagIds      = $data['tag_ids'] ?? [];
        $tagNames    = $data['tag_names'] ?? [];

        unset($data['category_ids'], $data['tag_ids'], $data['tag_names']);

        DB::transaction(function () use ($data, $categoryIds, $tagIds, $tagNames) {
            $post = Post::create($data);

            $post->categories()->sync($categoryIds);

            $finalTagIds = $this->resolveTagIds($tagIds, $tagNames);
            $post->tags()->sync($finalTagIds);
        });

        return redirect()->route('sys.posts.index')->with('success', 'Blog post created.');
    }

    public function edit(Post $post)
    {
        $post->load(['categories:id', 'tags:id']);

        $categories = Category::query()->orderBy('name')->get(['id','name','slug']);
        $tags       = Tag::query()->orderBy('name')->get(['id','name','slug']);

        $selectedCategoryIds = $post->categories->pluck('id')->all();
        $selectedTagIds      = $post->tags->pluck('id')->all();

        return view('sys.posts.edit', compact(
            'post',
            'categories',
            'tags',
            'selectedCategoryIds',
            'selectedTagIds'
        ));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:posts,slug,' . $post->id],
            'excerpt' => ['nullable','string','max:255'],
            'content' => ['nullable','string'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:6144'],
            'remove_image' => ['nullable','boolean'],
            'author_name' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_published' => ['nullable','boolean'],
            'published_at' => ['nullable','date'],

            'category_ids' => ['nullable','array'],
            'category_ids.*' => ['integer','exists:categories,id'],

            'tag_ids' => ['nullable','array'],
            'tag_ids.*' => ['integer','exists:tags,id'],

            'tag_names' => ['nullable','array'],
            'tag_names.*' => ['string','max:60'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = (bool) $request->input('is_published', 0);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        }

        // remove old image
        if ($request->boolean('remove_image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                @unlink(public_path($post->image));
            }
            $data['image'] = null;
        }

        // upload new image
        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                @unlink(public_path($post->image));
            }
            File::ensureDirectoryExists(public_path('uploads/blogs'));
            $file = $request->file('image');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $name);
            $data['image'] = 'uploads/blogs/' . $name;
        }

        // publish rules
        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        $categoryIds = $data['category_ids'] ?? [];
        $tagIds      = $data['tag_ids'] ?? [];
        $tagNames    = $data['tag_names'] ?? [];

        unset($data['category_ids'], $data['tag_ids'], $data['tag_names']);

        DB::transaction(function () use ($post, $data, $categoryIds, $tagIds, $tagNames) {
            $post->update($data);

            $post->categories()->sync($categoryIds);

            $finalTagIds = $this->resolveTagIds($tagIds, $tagNames);
            $post->tags()->sync($finalTagIds);
        });

        return redirect()->route('sys.posts.index')->with('success', 'Blog post updated.');
    }

    public function destroy(Post $post)
    {
        DB::transaction(function () use ($post) {
            $post->categories()->detach();
            $post->tags()->detach();

            if ($post->image && file_exists(public_path($post->image))) {
                @unlink(public_path($post->image));
            }

            $post->delete();
        });

        return redirect()->route('sys.posts.index')->with('success', 'Blog post deleted.');
    }

    private function resolveTagIds(array $tagIds, array $tagNames): array
    {
        $tagIds = array_values(array_unique(array_filter($tagIds)));

        $tagNames = array_values(array_unique(array_filter(array_map(function ($name) {
            return trim((string) $name);
        }, $tagNames))));

        if (empty($tagNames)) {
            return $tagIds;
        }

        $createdOrFound = [];

        foreach ($tagNames as $name) {
            $slug = Str::slug($name);

            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );

            $createdOrFound[] = $tag->id;
        }

        return array_values(array_unique(array_merge($tagIds, $createdOrFound)));
    }
}
