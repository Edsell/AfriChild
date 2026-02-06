<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withCount('posts')
            ->orderBy('name')
            ->get();

        return view('sys.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('sys.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:categories,slug'],
            'meta_title' => ['nullable','string','max:255'],
            'meta_description' => ['nullable','string','max:255'],
            'meta_keywords' => ['nullable','string','max:255'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // ensure unique slug if duplicate names exist
        $base = $data['slug'];
        $i = 2;
        while (Category::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i;
            $i++;
        }

        Category::create($data);

        return redirect()->route('sys.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('sys.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:categories,slug,' . $category->id],
            'meta_title' => ['nullable','string','max:255'],
            'meta_description' => ['nullable','string','max:255'],
            'meta_keywords' => ['nullable','string','max:255'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $base = $data['slug'];
        $i = 2;
        while (Category::where('slug', $data['slug'])->where('id', '!=', $category->id)->exists()) {
            $data['slug'] = $base . '-' . $i;
            $i++;
        }

        $category->update($data);

        return redirect()->route('sys.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        // Detach posts first (safe)
        $category->posts()->detach();
        $category->delete();

        return redirect()->route('sys.categories.index')->with('success', 'Category deleted.');
    }
}
