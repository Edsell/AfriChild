<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $items = HomePage::latest()->paginate(20);
        return view('sys.home_pages.index', compact('items'));
    }

    public function create()
    {
        return view('sys.home_pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:home_pages,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_button_text' => 'nullable|string|max:255',
            'hero_button_url' => 'nullable|string|max:255',
            'services_title' => 'nullable|string|max:255',
            'services_subtitle' => 'nullable|string|max:255',
            'services_button_text' => 'nullable|string|max:255',
            'services_button_url' => 'nullable|string|max:255',
            'projects_title' => 'nullable|string|max:255',
            'projects_subtitle' => 'nullable|string|max:255',
            'projects_button_text' => 'nullable|string|max:255',
            'projects_button_url' => 'nullable|string|max:255',
            'show_hero' => 'nullable|boolean',
            'show_services' => 'nullable|boolean',
            'show_projects' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // checkboxes
        $data['show_hero'] = (bool) $request->input('show_hero', false);
        $data['show_services'] = (bool) $request->input('show_services', false);
        $data['show_projects'] = (bool) $request->input('show_projects', false);
        $data['is_active'] = (bool) $request->input('is_active', false);

        HomePage::create($data);

        return redirect()->route('sys.home-pages.index')->with('success', 'Home page settings created.');
    }

    public function edit(HomePage $home_page)
    {
        return view('sys.home_pages.edit', ['item' => $home_page]);
    }

    public function update(Request $request, HomePage $home_page)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:home_pages,slug,' . $home_page->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_button_text' => 'nullable|string|max:255',
            'hero_button_url' => 'nullable|string|max:255',
            'services_title' => 'nullable|string|max:255',
            'services_subtitle' => 'nullable|string|max:255',
            'services_button_text' => 'nullable|string|max:255',
            'services_button_url' => 'nullable|string|max:255',
            'projects_title' => 'nullable|string|max:255',
            'projects_subtitle' => 'nullable|string|max:255',
            'projects_button_text' => 'nullable|string|max:255',
            'projects_button_url' => 'nullable|string|max:255',
            'show_hero' => 'nullable|boolean',
            'show_services' => 'nullable|boolean',
            'show_projects' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data['show_hero'] = (bool) $request->input('show_hero', false);
        $data['show_services'] = (bool) $request->input('show_services', false);
        $data['show_projects'] = (bool) $request->input('show_projects', false);
        $data['is_active'] = (bool) $request->input('is_active', false);

        $home_page->update($data);

        return redirect()->route('sys.home-pages.index')->with('success', 'Home page settings updated.');
    }

    public function destroy(HomePage $home_page)
    {
        $home_page->delete();
        return redirect()->route('sys.home-pages.index')->with('success', 'Deleted.');
    }

    public function show(HomePage $home_page)
    {
        return redirect()->route('sys.home-pages.edit', $home_page);
    }
}
