<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CtaSectionController extends Controller
{
    public function index()
    {
        $section = CtaSection::first() ?? CtaSection::create([
            'parallax_speed' => 1.5,
            'is_active' => true,
        ]);

        return redirect()->route('sys.cta.edit', $section);
    }

    public function edit(CtaSection $cta)
    {
        return view('sys.cta.edit', ['section' => $cta]);
    }

    public function update(Request $request, CtaSection $cta)
    {
        $data = $request->validate([
            'parallax_speed' => ['required','numeric','min:0','max:9.9'],
            'is_active' => ['nullable','boolean'],
            'background_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:6144'],
            'remove_background_image' => ['nullable','boolean'],
        ]);

        $cta->parallax_speed = (float)$data['parallax_speed'];
        $cta->is_active = (bool)$request->input('is_active', 0);

        if ($request->boolean('remove_background_image')) {
            if ($cta->background_image && file_exists(public_path($cta->background_image))) {
                @unlink(public_path($cta->background_image));
            }
            $cta->background_image = null;
        }

        if ($request->hasFile('background_image')) {
            if ($cta->background_image && file_exists(public_path($cta->background_image))) {
                @unlink(public_path($cta->background_image));
            }

            $file = $request->file('background_image');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $dir = 'uploads/cta';
            $file->move(public_path($dir), $name);

            $cta->background_image = $dir . '/' . $name;
        }

        $cta->save();

        return redirect()
            ->route('sys.cta.edit', $cta)
            ->with('success', 'CTA section updated successfully.');
    }
}
