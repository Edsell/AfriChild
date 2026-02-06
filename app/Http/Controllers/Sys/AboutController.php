<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function edit()
  {
    $page = Page::firstOrCreate(['key' => 'about'], ['title' => 'About', 'content' => []]);
    return view('sys.about', compact('page'));
  }

  public function update(Request $request)
  {
    $page = Page::firstOrCreate(['key' => 'about'], ['title' => 'About', 'content' => []]);

    $data = $request->validate([
      'title' => 'nullable|string|max:255',
      'content' => 'nullable|array',
      'content.heading' => 'nullable|string|max:255',
      'content.body' => 'nullable|string',
    ]);

    $page->update([
      'title' => $data['title'] ?? $page->title,
      'content' => $data['content'] ?? $page->content,
    ]);

    return back()->with('success', 'About updated.');
  }
}
