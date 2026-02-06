<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function index(Request $request)
    {

    $q = $request->string('q')->toString();
        $cat = $request->string('category')->toString(); // slug or id
        $tag = $request->string('tag')->toString();      // slug or id

        $postsQuery = Post::query()
            ->with(['categories:id,name,slug', 'tags:id,name,slug'])
            ->whereNotNull('published_at')
            ->orderByDesc('published_at');

        if ($q) {
            $postsQuery->where(function ($qq) use ($q) {
            $qq->where('title', 'like', "%{$q}%")
                ->orWhere('excerpt', 'like', "%{$q}%")
                ->orWhere('content', 'like', "%{$q}%");
            });
        }

        if ($cat) {
            $postsQuery->whereHas('categories', function ($qc) use ($cat) {
            $qc->where('slug', $cat)->orWhere('categories.id', $cat);
            });
        }

        if ($tag) {
            $postsQuery->whereHas('tags', function ($qt) use ($tag) {
            $qt->where('slug', $tag)->orWhere('tags.id', $tag);
            });
        }

        $posts = $postsQuery->paginate(9)->withQueryString();

        // Sidebar data
        $categories = Category::query()
            ->withCount(['posts' => fn($q) => $q->whereNotNull('published_at')])
            ->orderBy('name')
            ->get();

        $tags = Tag::query()
            ->orderBy('name')
            ->get();


        // $posts = Post::where('is_published', 1)
        // ->orderByDesc('published_at')
        // ->paginate(9);

        return view('site.blog', compact('posts',  'categories', 'tags'));
    }

    public function show(Post $post)
    {


    $post->load(['categories:id,name,slug', 'tags:id,name,slug']);

        // Sidebar data
        $categories = Category::query()
            ->withCount(['posts' => fn($q) => $q->whereNotNull('published_at')])
            ->orderBy('name')
            ->get();

        $tags = Tag::query()
            ->orderBy('name')
            ->get();

        // Related: prefer same categories/tags, fallback to latest
        $catIds = $post->categories->pluck('id')->all();
        $tagIds = $post->tags->pluck('id')->all();

        $relatedQuery = Post::query()
            ->whereKeyNot($post->id)
            ->whereNotNull('published_at')
            ->with(['categories:id,name,slug', 'tags:id,name,slug']);

        if (!empty($catIds) || !empty($tagIds)) {
            $relatedQuery->where(function ($q) use ($catIds, $tagIds) {
            if (!empty($catIds)) {
                $q->whereHas('categories', fn($qc) => $qc->whereIn('categories.id', $catIds));
            }
            if (!empty($tagIds)) {
                $q->orWhereHas('tags', fn($qt) => $qt->whereIn('tags.id', $tagIds));
            }
            });
        }

        $relatedPosts = $relatedQuery
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        // keep your view variable name compatibility
        $item = $post;


        return view('site.blog-details', compact('item', 'post', 'relatedPosts', 'categories', 'tags'));
    }
}
