<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\CtaItem;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class CtaItemController extends Controller
{
    public function index(CtaSection $cta)
    {
        $items = $cta->items()->orderBy('sort_order')->get();
        return view('sys.cta.items.index', compact('cta', 'items'));
    }

    public function create(CtaSection $cta)
    {
        return view('sys.cta.items.create', compact('cta'));
    }

    public function store(Request $request, CtaSection $cta)
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'percent'    => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'is_active'  => ['sometimes', 'nullable', 'boolean'],
        ]);

        $data['cta_section_id'] = $cta->id;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // checkbox-safe: present => true, absent => false
        $data['is_active'] = $request->has('is_active');

        CtaItem::create($data);

        return redirect()
            ->route('sys.cta.items.index', $cta)
            ->with('success', 'CTA item created.');
    }

    public function edit(CtaSection $cta, CtaItem $item)
    {
        abort_unless($item->cta_section_id === $cta->id, 404);
        return view('sys.cta.items.edit', compact('cta', 'item'));
    }

    public function update(Request $request, CtaSection $cta, CtaItem $item)
    {
        abort_unless($item->cta_section_id === $cta->id, 404);

        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'percent'    => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'is_active'  => ['sometimes', 'nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->has('is_active');

        $item->update($data);

        return redirect()
            ->route('sys.cta.items.index', $cta)
            ->with('success', 'CTA item updated.');
    }

    public function destroy(CtaSection $cta, CtaItem $item)
    {
        abort_unless($item->cta_section_id === $cta->id, 404);

        $item->delete();

        return redirect()
            ->route('sys.cta.items.index', $cta)
            ->with('success', 'CTA item deleted.');
    }
}