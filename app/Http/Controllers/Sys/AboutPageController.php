<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AboutPageController extends Controller
{
  public function index()
  {
    $items = AboutPage::orderByDesc('id')->paginate(20);
    return view('sys.about.index', compact('items'));
  }

  public function create()
  {
    $item = new AboutPage(['is_active' => true, 'page_title' => 'About Us']);
    return view('sys.about.form', compact('item'));
  }

  public function store(Request $request)
  {
    $data = $this->validated($request);

    if ($request->hasFile('image_file')) {
      $data['image'] = $request->file('image_file')->store('uploads/about', 'public');
    }

    $item = AboutPage::create($data);

    return redirect()
      ->route('sys.about.index')
      ->with('success', 'About page created.');
  }

  public function edit(AboutPage $about)
  {
    $item = $about;
    return view('sys.about.form', compact('item'));
  }

  public function update(Request $request, AboutPage $about)
  {
    $data = $this->validated($request, $about->id);

    if ($request->hasFile('image_file')) {
      // delete old if it was stored on public disk
      if (!empty($about->image) && Storage::disk('public')->exists($about->image)) {
        Storage::disk('public')->delete($about->image);
      }
      $data['image'] = $request->file('image_file')->store('uploads/about', 'public');
    }

    $about->update($data);

    return redirect()
      ->route('sys.about.index')
      ->with('success', 'About page updated.');
  }

  public function destroy(AboutPage $about)
  {
    if (!empty($about->image) && Storage::disk('public')->exists($about->image)) {
      Storage::disk('public')->delete($about->image);
    }

    $about->delete();

    return redirect()
      ->route('sys.about.index')
      ->with('success', 'About page deleted.');
  }

  private function validated(Request $request, ?int $id = null): array
  {
    return $request->validate([
      'page_title' => ['required','string','max:255'],
      'meta_title' => ['nullable','string','max:255'],
      'meta_description' => ['nullable','string'],

      'heading' => ['nullable','string','max:255'],
      'content' => ['nullable','string'],

      'cta_text' => ['nullable','string','max:255'],
      'cta_url' => ['nullable','string','max:255'],

      'is_active' => ['nullable','boolean'],

      'image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
    ], [
      'image_file.image' => 'The uploaded file must be an image.',
    ]);
  }
}
