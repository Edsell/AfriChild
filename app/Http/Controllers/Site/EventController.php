<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::published()
            ->orderBy('event_date')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('site.events.index', compact('events'));
    }

    public function show(string $slug)
    {
        $event = Event::published()->where('slug', $slug)->firstOrFail();
        return view('site.events.show', compact('event'));
    }
}
