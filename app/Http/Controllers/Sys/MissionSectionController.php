<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\MissionSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MissionSectionController extends Controller
{
    public function index()
    {
        // Single-section pattern: ensure one record exists
        $section = MissionSection::first() ?? MissionSection::create([
            'title' => 'Our Mission',
            'is_active' => true,
        ]);

        return redirect()->route('sys.mission.edit', $section);
    }

    public function edit(MissionSection $mission)
    {
        return view('sys.mission.edit', [
            'section' => $mission,
        ]);
    }

    public function update(Request $request, MissionSection $mission)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'is_active' => ['nullable','boolean'],
            'center_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'remove_center_image' => ['nullable','boolean'],
        ]);

        $mission->title = $data['title'] ?? $mission->title;
        $mission->is_active = (bool)($request->input('is_active', 0));

        if ($request->boolean('remove_center_image')) {
            // delete old file if exists
            if ($mission->center_image && file_exists(public_path($mission->center_image))) {
                @unlink(public_path($mission->center_image));
            }
            $mission->center_image = null;
        }

        if ($request->hasFile('center_image')) {
            // delete old file
            if ($mission->center_image && file_exists(public_path($mission->center_image))) {
                @unlink(public_path($mission->center_image));
            }

            $file = $request->file('center_image');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $dir = 'uploads/mission';
            $file->move(public_path($dir), $name);

            $mission->center_image = $dir . '/' . $name;
        }

        $mission->save();

        return redirect()
            ->route('sys.mission.edit', $mission)
            ->with('success', 'Mission section updated successfully.');
    }
}
