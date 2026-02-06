<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->latest('id')->get();
        return view('sys.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('sys.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'url' => ['nullable','string','max:255'],
            'logo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = (bool)$request->input('is_active', 0);

        if ($request->hasFile('logo')) {
            File::ensureDirectoryExists(public_path('uploads/partners'));
            $file = $request->file('logo');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/partners'), $name);
            $data['logo'] = 'uploads/partners/' . $name;
        }

        Partner::create($data);

        return redirect()->route('sys.partners.index')->with('success', 'Partner created.');
    }

    public function edit(Partner $partner)
    {
        return view('sys.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'url' => ['nullable','string','max:255'],
            'logo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'remove_logo' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = (bool)$request->input('is_active', 0);

        if ($request->boolean('remove_logo')) {
            if ($partner->logo && file_exists(public_path($partner->logo))) {
                @unlink(public_path($partner->logo));
            }
            $data['logo'] = null;
        }

        if ($request->hasFile('logo')) {
            if ($partner->logo && file_exists(public_path($partner->logo))) {
                @unlink(public_path($partner->logo));
            }
            File::ensureDirectoryExists(public_path('uploads/partners'));
            $file = $request->file('logo');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/partners'), $name);
            $data['logo'] = 'uploads/partners/' . $name;
        }

        $partner->update($data);

        return redirect()->route('sys.partners.index')->with('success', 'Partner updated.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo && file_exists(public_path($partner->logo))) {
            @unlink(public_path($partner->logo));
        }
        $partner->delete();

        return redirect()->route('sys.partners.index')->with('success', 'Partner deleted.');
    }
}
