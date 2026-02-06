<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
  public function index()
    {
      $galleries = Gallery::where('is_active', 1)
      ->withCount(['items' => fn($q) => $q->where('is_active', 1)])
      ->orderBy('sort_order')
      ->orderBy('name')
      ->get();

    $items = \App\Models\GalleryItem::where('is_active', 1)
      ->with('gallery:id,name,slug')
      ->whereHas('gallery', fn($q) => $q->where('is_active', 1))
      ->orderBy('sort_order')
      ->orderByDesc('id')
      ->get();

    return view('site.gallery', compact('galleries', 'items'));
  }

  public function show(Gallery $gallery)
  {
    abort_unless($gallery->is_active, 404);

    $galleries = Gallery::where('is_active', 1)
      ->withCount(['items' => fn($q) => $q->where('is_active', 1)])
      ->orderBy('sort_order')
      ->orderBy('name')
      ->get();

    $items = \App\Models\GalleryItem::where('is_active', 1)
      ->with('gallery:id,name,slug')
      ->whereHas('gallery', fn($q) => $q->where('is_active', 1))
      ->orderBy('sort_order')
      ->orderByDesc('id')
      ->get();

    // optional: pre-select a filter tab
    $activeSlug = $gallery->slug;

    return view('site.gallery', compact('galleries', 'items', 'activeSlug'));
  }
}
