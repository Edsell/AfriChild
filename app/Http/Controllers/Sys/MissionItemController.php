<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\MissionItem;
use App\Models\MissionSection;
use Illuminate\Http\Request;

class MissionItemController extends Controller
{
    public function index(MissionSection $mission)
    {
        $items = $mission->items()->orderBy('column')->orderBy('sort_order')->get();

        return view('sys.mission.items.index', compact('mission', 'items'));
    }

    public function create(MissionSection $mission)
    {
        return view('sys.mission.items.create', compact('mission'));
    }

    public function store(Request $request, MissionSection $mission)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'icon' => ['nullable','string','max:255'],
            'column' => ['required','in:left,right'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);

        $data['mission_section_id'] = $mission->id;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = (bool)($request->input('is_active', 0));

        MissionItem::create($data);

        return redirect()
            ->route('sys.mission.items.index', $mission)
            ->with('success', 'Mission item created.');
    }

    public function edit(MissionSection $mission, MissionItem $item)
    {
        abort_unless($item->mission_section_id === $mission->id, 404);
        return view('sys.mission.items.edit', compact('mission', 'item'));
    }

    public function update(Request $request, MissionSection $mission, MissionItem $item)
    {
        abort_unless($item->mission_section_id === $mission->id, 404);

        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'icon' => ['nullable','string','max:255'],
            'column' => ['required','in:left,right'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = (bool)($request->input('is_active', 0));

        $item->update($data);

        return redirect()
            ->route('sys.mission.items.index', $mission)
            ->with('success', 'Mission item updated.');
    }

    public function destroy(MissionSection $mission, MissionItem $item)
    {
        abort_unless($item->mission_section_id === $mission->id, 404);

        $item->delete();

        return redirect()
            ->route('sys.mission.items.index', $mission)
            ->with('success', 'Mission item deleted.');
    }
}
