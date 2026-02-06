<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicePublicController extends Controller
{
    public function show(int $service, string $slug)
    {
        $item = Service::where('id', $service)->where('is_active', 1)->firstOrFail();

        // Optional: enforce correct slug (SEO)
        if ($item->slug !== $slug) {
            return redirect()->route('site.services.show', ['service' => $item->id, 'slug' => $item->slug], 301);
        }

        // Create this view later; for now you can just dd($item) or return a basic template.
        return view('site.service-details', compact('item'));
    }
}
