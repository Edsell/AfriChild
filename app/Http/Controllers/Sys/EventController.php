<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $q = Event::query();

        if ($request->filled('status')) {
            $q->where('status', $request->string('status'));
        }
        if ($request->filled('search')) {
            $s = $request->string('search');
            $q->where(function ($qq) use ($s) {
                $qq->where('title', 'like', "%{$s}%")
                   ->orWhere('venue', 'like', "%{$s}%")
                   ->orWhere('location', 'like', "%{$s}%");
            });
        }

        $events = $q->orderByDesc('event_date')
                    ->orderBy('sort_order')
                    ->paginate(15)
                    ->withQueryString();

        return view('sys.events.index', compact('events'));
    }

    public function create()
    {
        $event = new Event();
        return view('sys.events.form', compact('event'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->makeUniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request);
        }

        Event::create($data);

        return redirect()->route('sys.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('sys.events.form', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validated($request, $event->id);

        // If title changed and slug left empty in UI, regenerate
        if ($request->boolean('regenerate_slug') === true) {
            $data['slug'] = $this->makeUniqueSlug($data['title'], $event->id);
        }

        if ($request->hasFile('image')) {
            // delete old
            if ($event->image && file_exists(public_path($event->image))) {
                @unlink(public_path($event->image));
            }
            $data['image'] = $this->storeImage($request);
        }

        $event->update($data);

        return redirect()->route('sys.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->image && file_exists(public_path($event->image))) {
            @unlink(public_path($event->image));
        }

        $event->delete();
        return redirect()->route('sys.events.index')->with('success', 'Event deleted successfully.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255', Rule::unique('events','slug')->ignore($ignoreId)],
            'excerpt' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],

            'event_date' => ['required','date'],
            'event_time' => ['nullable','date_format:H:i'],

            'venue' => ['nullable','string','max:255'],
            'location' => ['nullable','string','max:255'],

            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],

            'is_featured' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0','max:999999'],

            'status' => ['required', Rule::in(['draft','published'])],
        ], [
            'event_time.date_format' => 'Event time must be in HH:MM (24-hour) format, e.g. 11:00.'
        ]);
    }

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (Event::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $name = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
        $dir = public_path('uploads/events');

        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $file->move($dir, $name);

        return 'uploads/events/'.$name;
    }
}
