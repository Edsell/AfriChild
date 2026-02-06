<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GalleryItemController extends Controller
{
  public function index(Gallery $gallery)
  {
    $items = $gallery->items()
      ->orderBy('sort_order')
      ->orderByDesc('id')
      ->paginate(30);

    return view('sys.gallery_items.index', compact('gallery', 'items'));
  }

  public function create(Gallery $gallery)
  {
    return view('sys.gallery_items.create', compact('gallery'));
  }

  /**
   * MULTI-UPLOAD under the same gallery/category
   */
  public function store(Request $request, Gallery $gallery)
  {
    $data = $request->validate([
      'images' => ['required','array','min:1'],
      'images.*' => ['required','image','mimes:jpg,jpeg,png,webp','max:5120'],
      'alt' => ['nullable','string','max:255'],
      'is_active' => ['nullable','boolean'],
      'sort_order' => ['nullable','integer','min:0'],
    ]);

    $isActive = (bool)($data['is_active'] ?? true);
    $sortOrder = (int)($data['sort_order'] ?? 0);
    $alt = $data['alt'] ?? null;

    foreach ($request->file('images', []) as $img) {
      $ext = $img->getClientOriginalExtension();
      $name = now()->format('YmdHis').'-'.Str::random(10).'.'.$ext;

      // store in public/uploads/galleries/{gallery_id}/
      $img->move(public_path('uploads/galleries/'.$gallery->id), $name);

      GalleryItem::create([
        'gallery_id' => $gallery->id,
        'image' => 'uploads/galleries/'.$gallery->id.'/'.$name, // IMPORTANT column name: image
        'alt' => $alt,
        'is_active' => $isActive,
        'sort_order' => $sortOrder,
      ]);
    }

    return redirect()->route('sys.galleries.items.index', $gallery)->with('success', 'Images uploaded.');
  }

  public function edit(Gallery $gallery, GalleryItem $item)
  {
    abort_unless($item->gallery_id === $gallery->id, 404);
    return view('sys.gallery_items.edit', compact('gallery','item'));
  }

  public function update(Request $request, Gallery $gallery, GalleryItem $item)
  {
    abort_unless($item->gallery_id === $gallery->id, 404);

    $data = $request->validate([
      'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
      'alt' => ['nullable','string','max:255'],
      'is_active' => ['nullable','boolean'],
      'sort_order' => ['nullable','integer','min:0'],
    ]);

    $data['is_active'] = (bool)($data['is_active'] ?? false);

    if ($request->hasFile('image')) {
      $img = $request->file('image');
      $ext = $img->getClientOriginalExtension();
      $name = now()->format('YmdHis').'-'.Str::random(10).'.'.$ext;

      $img->move(public_path('uploads/galleries/'.$gallery->id), $name);

      // delete old file if exists
      $old = public_path(ltrim($item->image, '/'));
      if (is_file($old)) @unlink($old);

      $data['image'] = 'uploads/galleries/'.$gallery->id.'/'.$name;
    }

    $item->update($data);

    return back()->with('success', 'Image updated.');
  }

  public function destroy(Gallery $gallery, GalleryItem $item)
  {
    abort_unless($item->gallery_id === $gallery->id, 404);

    $old = public_path(ltrim($item->image, '/'));
    if (is_file($old)) @unlink($old);

    $item->delete();

    return back()->with('success', 'Image deleted.');
  }

 
    public function order(Request $request, Gallery $gallery)
    {
      $data = $request->validate([
        'ids' => ['required','array','min:1'],
        'ids.*' => ['integer'],
      ]);

      $ids = $data['ids'];

      // Ensure all belong to this gallery
      $count = $gallery->items()->whereIn('id', $ids)->count();
      if ($count !== count($ids)) {
        return response()->json(['message' => 'Invalid items.'], 422);
      }

      DB::transaction(function () use ($gallery, $ids) {
        foreach ($ids as $index => $id) {
          $gallery->items()->where('id', $id)->update(['sort_order' => $index]);
        }
      });

      return response()->json(['message' => 'Order updated.']);
    }

    public function updateAlt(Request $request, Gallery $gallery, GalleryItem $item)
    {
      abort_unless($item->gallery_id === $gallery->id, 404);

      $data = $request->validate([
        'alt' => ['nullable','string','max:255'],
      ]);

      $item->update(['alt' => $data['alt'] ?? null]);

      return response()->json(['message' => 'Alt updated.']);
    }


}
