<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
  public function index()
  {
    $items = Gallery::withCount('items')
      ->orderBy('sort_order')
      ->orderByDesc('id')
      ->paginate(20);

    return view('sys.galleries.index', compact('items'));
  }

  public function create()
  {
    return view('sys.galleries.create');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => ['required','string','max:255'],
      'slug' => ['nullable','string','max:255'],
      'is_active' => ['nullable','boolean'],
      'sort_order' => ['nullable','integer','min:0'],
    ]);

    $data['is_active'] = (bool)($data['is_active'] ?? false);

    $gallery = Gallery::create($data);

    return redirect()->route('sys.galleries.edit', $gallery)->with('success', 'Gallery created.');
  }

  public function edit(Gallery $gallery)
  {
    $gallery->loadCount('items');
    return view('sys.galleries.edit', compact('gallery'));
  }

  public function update(Request $request, Gallery $gallery)
  {
    $data = $request->validate([
      'name' => ['required','string','max:255'],
      'slug' => ['nullable','string','max:255'],
      'is_active' => ['nullable','boolean'],
      'sort_order' => ['nullable','integer','min:0'],
    ]);

    $data['is_active'] = (bool)($data['is_active'] ?? false);

    $gallery->update($data);

    return back()->with('success', 'Gallery updated.');
  }

  public function destroy(Gallery $gallery)
  {
    $gallery->delete();
    return redirect()->route('sys.galleries.index')->with('success', 'Gallery deleted.');
  }
}
