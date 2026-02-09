<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GeneralSettingsController extends Controller
{
  // Module directory (fixed for this controller)
  private const MODULE_DIR = 'settings';

  public function index()
  {
    $items = GeneralSettings::latest()->paginate(10);
    return view('sys.settings.index', compact('items'));
  }

  public function create()
  {
    return view('sys.settings.create');
  }

  public function store(Request $request)
  {
    $data = $this->validatedData($request);

    // Optional: allow logo/crumb on create too
    if ($request->hasFile('Logo')) {
      $data['Logo'] = $this->storeFile($request->file('Logo'));
    }
    if ($request->hasFile('Crumb')) {
      $data['Crumb'] = $this->storeFile($request->file('Crumb'));
    }

    $item = GeneralSettings::create($data);

    return redirect()
      ->route('sys.settings.edit', $item)
      ->with('success', 'Settings created successfully.');
  }

  public function edit(GeneralSettings $setting)
  {
    $item = $setting;
    return view('sys.settings.edit', compact('item'));
  }

  public function update(Request $request, GeneralSettings $setting)
  {
    $data = $this->validatedData($request);

    $setting->update($data);

    return back()->with('success', 'Settings updated successfully.');
  }

  public function destroy(GeneralSettings $setting)
  {
    $this->deleteFileIfExists($setting->Logo);
    $this->deleteFileIfExists($setting->Crumb);

    $setting->delete();

    return redirect()
      ->route('sys.settings.index')
      ->with('success', 'Settings deleted.');
  }

  /**
   * Upload Logo
   */
  public function updateLogo(Request $request, GeneralSettings $setting)
  {
    $request->validate([
      'Logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
    ]);

    $this->deleteFileIfExists($setting->Logo);
    $setting->Logo = $this->storeFile($request->file('Logo'));
    $setting->save();

    return back()->with('success', 'Logo updated successfully.');
  }

  /**
   * Upload Breadcrumb (Crumb)
   */
  public function updateCrumb(Request $request, GeneralSettings $setting)
  {
    $request->validate([
      'Crumb' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
    ]);

    $this->deleteFileIfExists($setting->Crumb);
    $setting->Crumb = $this->storeFile($request->file('Crumb'));
    $setting->save();

    return back()->with('success', 'Breadcrumb image updated successfully.');
  }

  private function validatedData(Request $request): array
  {
    return $request->validate([
      'CompanyName' => ['nullable','string','max:190'],
      'Email'       => ['nullable','email','max:190'],
      'Code'        => ['nullable','string','max:20'],
      'Phone'       => ['nullable','string','max:40'],
      'Phone2'      => ['nullable','string','max:40'],
      'Plot'        => ['nullable','string','max:190'],
      'Address'     => ['nullable','string','max:255'],
      'Country'     => ['nullable','string','max:120'],
      'Currency'    => ['nullable','string','max:40'],
    ]);
  }

  /**
   * Store ONLY in: public/uploads/settings
   * Returns: uploads/settings/xxxx.ext (use with asset())
   */
  private function storeFile($file): string
  {
    $dir = self::MODULE_DIR;

    $destination = public_path("uploads/{$dir}");
    if (!is_dir($destination)) {
      @mkdir($destination, 0755, true);
    }

    $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
    $filename = Str::uuid()->toString() . '.' . $ext;

    $file->move($destination, $filename);

    return "uploads/{$dir}/{$filename}";
  }

  /**
   * Delete ONLY from public/uploads/*
   * If path doesn't start with "uploads/", do nothing.
   */
  private function deleteFileIfExists(?string $path): void
  {
    if (!$path) return;

    $path = ltrim(trim($path), '/');

    // Strict: only touch uploads/
    if (!str_starts_with($path, 'uploads/')) {
      return;
    }

    $fullPath = public_path($path);

    if (is_file($fullPath) && file_exists($fullPath)) {
      @unlink($fullPath);
    }
  }
}
