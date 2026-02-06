<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

private function uniqueSlug(string $title, ?int $ignoreId = null): string
{
    $base = \Illuminate\Support\Str::slug($title);
    $slug = $base ?: 'service';

    $q = \App\Models\Service::query()->where('slug', $slug);
    if ($ignoreId) $q->where('id', '!=', $ignoreId);

    $i = 2;
    while ($q->exists()) {
        $slugTry = $base . '-' . $i;
        $q = \App\Models\Service::query()->where('slug', $slugTry);
        if ($ignoreId) $q->where('id', '!=', $ignoreId);
        $slug = $slugTry;
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
        return "$dir/$name";
    }

    public function index()
    {
        $items = Service::with('homePage')->orderBy('sort_order')->paginate(20);
        return view('sys.services.index', compact('items'));
    }

    public function create()
    {
        $homePages = HomePage::orderBy('id')->get();
        return view('sys.services.create', compact('homePages'));
    }

   public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'excerpt' => 'nullable|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_active'] = (bool) $request->input('is_active', false);

        $img = $this->upload($request, 'image', 'services');
        if ($img) $data['image'] = $img;

        Service::create($data);

        return redirect()->route('sys.services.index')->with('success', 'Service created.');
    }


    public function edit(Service $service)
    {
        $homePages = HomePage::orderBy('id')->get();
        return view('sys.services.edit', ['item' => $service, 'homePages' => $homePages]);
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'excerpt' => 'nullable|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // Regenerate slug ONLY if title changed (keeps URLs stable if you prefer)
        if ($service->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $service->id);
        }

        $data['is_active'] = (bool) $request->input('is_active', false);

        $img = $this->upload($request, 'image', 'services');
        if ($img) $data['image'] = $img;

        $service->update($data);

        return redirect()->route('sys.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('sys.services.index')->with('success', 'Deleted.');
    }

    public function show(Service $service)
    {
        return redirect()->route('sys.services.edit', $service);
    }
}
