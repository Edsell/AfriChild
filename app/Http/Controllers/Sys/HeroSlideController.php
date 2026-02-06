<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{

   private function safeRoute(string $name, array $params = [], ?string $fallback = null): string
    {
        try {
            return route($name, $params);
        } catch (\Throwable $e) {
            return $fallback ?? '#';
        }
    }

    private function linkOptions(): array
    {
        return [
            '' => '-- Select a page --',

            url('/') => 'Home',

            url('/projects') => 'Projects',
            url('/services') => 'Services',
            url('/blog') => 'Blog',
            url('/events') => 'Events',

            // Static pages
            url('/about') => 'About',
            url('/contact') => 'Contact',

        ];
    }



    private function upload(Request $request, string $field, string $dir): ?string
    {
        if (!$request->hasFile($field)) return null;
        $file = $request->file($field);
        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("uploads/$dir"), $name);
        return "$dir/$name"; // relative path stored in DB
    }

    public function index()
    {
       $items = HeroSlide::whereIn('is_active', [0, 1])
    ->orderByDesc('id')
    ->paginate(20);
        return view('sys.hero_slides.index', compact('items'));
    }

    public function create()
    {

        $links = $this->linkOptions();
        $homePages = HomePage::orderBy('id')->get();
        return view('sys.hero_slides.create', compact('homePages','links'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kicker' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background' => 'nullable|image|max:4096',
            'thumb' => 'nullable|image|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'button_bg' => 'nullable|string|max:20',
            'duration_ms' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $bg = $this->upload($request, 'background', 'hero');
        $th = $this->upload($request, 'thumb', 'hero');

        if ($bg) $data['background'] = $bg;
        if ($th) $data['thumb'] = $th;

        $data['is_active'] = (bool) $request->input('is_active', false);

        HeroSlide::create($data);

        return redirect()->route('sys.hero-slides.index')->with('success', 'Slide created.');
    }

    public function edit(HeroSlide $hero_slide)
    {
        $links = $this->linkOptions();
        $homePages = HomePage::orderBy('id')->get();
        return view('sys.hero_slides.edit', ['item' => $hero_slide, 'homePages' => $homePages, 'links' => $links]);
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $data = $request->validate([
            'kicker' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background' => 'nullable|image|max:4096',
            'thumb' => 'nullable|image|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'button_bg' => 'nullable|string|max:20',
            'duration_ms' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $bg = $this->upload($request, 'background', 'hero');
        $th = $this->upload($request, 'thumb', 'hero');

        if ($bg) $data['background'] = $bg;
        if ($th) $data['thumb'] = $th;

        $data['is_active'] = (bool) $request->input('is_active', false);

        $hero_slide->update($data);

        return redirect()->route('sys.hero-slides.index')->with('success', 'Slide updated.');
    }

    public function destroy(HeroSlide $hero_slide)
    {
        $hero_slide->delete();
        return redirect()->route('sys.hero-slides.index')->with('success', 'Deleted.');
    }

    public function show(HeroSlide $hero_slide)
    {
        return redirect()->route('sys.hero-slides.edit', $hero_slide);
    }
}
