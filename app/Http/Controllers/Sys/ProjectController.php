<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base ?: 'project';

        $query = Project::query()->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $i = 2;
        while ($query->exists()) {
            $try = ($base ?: 'project') . '-' . $i;

            $query = Project::query()->where('slug', $try);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            $slug = $try;
            $i++;
        }

        return $slug;
    }

    private function upload(Request $request, string $field, string $dir): ?string
    {
        if (!$request->hasFile($field)) return null;

        $file = $request->file($field);
        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path("uploads/$dir"), $name);

        // store relative path (without "uploads/")
        return "$dir/$name";
    }

    public function index()
    {
        $items = Project::orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('sys.projects.index', compact('items'));
    }

    public function create()
    {
        return view('sys.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'excerpt' => 'nullable|string|max:255',

            'cover' => 'nullable|image|max:4096',
            'gallery_images.*' => 'nullable|image|max:4096', // multiple

            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',

            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',

            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_featured'] = (bool) $request->input('is_featured', false);
        $data['is_active'] = (bool) $request->input('is_active', false);

        // default published_at to today if empty
        if (empty($data['published_at'])) {
            $data['published_at'] = now()->toDateString();
        }

        // Cover upload
        $cover = $this->upload($request, 'cover', 'projects');
        if ($cover) {
            $data['cover'] = $cover;
        }

        // Create project ONCE
        $project = Project::create($data);

        // Multiple gallery images upload
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/projects'), $name);

                $project->galleryImages()->create([
                    'image' => 'projects/' . $name, // stored without "uploads/"
                    'sort_order' => 0,
                ]);
            }
        }

        return redirect()->route('sys.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        $project->load('galleryImages');
        return view('sys.projects.edit', ['item' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'excerpt' => 'nullable|string|max:255',

            'cover' => 'nullable|image|max:4096',
            'gallery_images.*' => 'nullable|image|max:4096', // multiple

            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',

            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',

            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // regenerate slug only if title changed
        if ($project->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $project->id);
        }

        $data['is_featured'] = (bool) $request->input('is_featured', false);
        $data['is_active'] = (bool) $request->input('is_active', false);

        // keep existing published_at if not provided
        if (empty($data['published_at'])) {
            $data['published_at'] = $project->published_at?->toDateString() ?? now()->toDateString();
        }

        // Cover upload (optional replacement)
        $cover = $this->upload($request, 'cover', 'projects');
        if ($cover) {
            $data['cover'] = $cover;
        }

        $project->update($data);

        // Add new gallery images (append)
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/projects'), $name);

                $project->galleryImages()->create([
                    'image' => 'projects/' . $name,
                    'sort_order' => 0,
                ]);
            }
        }

        return redirect()->route('sys.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('sys.projects.index')->with('success', 'Deleted.');
    }

    public function show(Project $project)
    {
        return redirect()->route('sys.projects.edit', $project);
    }
}
