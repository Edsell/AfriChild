<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function edit()
  {
    $page = Page::firstOrCreate(['key' => 'home'], ['title' => 'Home', 'content' => []]);
    return view('sys.home', compact('page'));
  }

  public function update(Request $request)
  {
    $page = Page::firstOrCreate(['key' => 'home'], ['title' => 'Home', 'content' => []]);

    // keep it minimal: store “sections” as JSON
    $data = $request->validate([
      'title' => 'nullable|string|max:255',
      'content' => 'nullable|array',
      'content.hero_title' => 'nullable|string|max:255',
      'content.hero_subtitle' => 'nullable|string|max:255',
      'content.hero_button_text' => 'nullable|string|max:100',
      'content.hero_button_link' => 'nullable|string|max:255',
    ]);

    $page->update([
      'title' => $data['title'] ?? $page->title,
      'content' => $data['content'] ?? $page->content,
    ]);

    return back()->with('success', 'Home updated.');
  }
}
