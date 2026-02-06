<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GeneralSettingsController extends Controller
{
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
    if ($request->hasFile('Logo'))  $data['Logo']  = $this->storeFile($request->file('Logo'), 'settings');
    if ($request->hasFile('Crumb')) $data['Crumb'] = $this->storeFile($request->file('Crumb'), 'settings');

    $item = GeneralSettings::create($data);

    return redirect()
      ->route('sys.settings.edit', $item)
      ->with('success', 'Settings created successfully.');
  }

  public function edit(GeneralSettings $setting)
  {
    // keep variable name "setting" in route-model-binding, but use $item in view if you prefer
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
    // delete files if exist
    $this->deleteFileIfExists($setting->Logo);
    $this->deleteFileIfExists($setting->Crumb);

    $setting->delete();

    return redirect()->route('sys.settings.index')->with('success', 'Settings deleted.');
  }

  /**
   * Upload Logo (separate action like your sample: UpdateLogo)
   */
  public function updateLogo(Request $request, GeneralSettings $setting)
  {
    $request->validate([
      'Logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
    ]);

    $this->deleteFileIfExists($setting->Logo);
    $setting->Logo = $this->storeFile($request->file('Logo'), 'settings');
    $setting->save();

    return back()->with('success', 'Logo updated successfully.');
  }

  /**
   * Upload Breadcrumb (Crumb) (separate action like your sample: UpdateCrumb)
   */
  public function updateCrumb(Request $request, GeneralSettings $setting)
  {
    $request->validate([
      'Crumb' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
    ]);

    $this->deleteFileIfExists($setting->Crumb);
    $setting->Crumb = $this->storeFile($request->file('Crumb'), 'settings');
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

  private function storeFile($file, string $dir): string
  {
    // stored in storage/app/public/settings
    $path = $file->store($dir, 'public');
    return 'storage/' . $path; // easy to asset()
  }

  private function deleteFileIfExists(?string $publicPath): void
  {
    if (!$publicPath) return;

    // Convert "storage/xxx" to "xxx" for disk('public')
    $relative = str_starts_with($publicPath, 'storage/')
      ? substr($publicPath, strlen('storage/'))
      : $publicPath;

    if (Storage::disk('public')->exists($relative)) {
      Storage::disk('public')->delete($relative);
    }
  }
}
