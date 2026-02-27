<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\TeamMember;
use App\Models\CtaSection;

class AboutController extends Controller
{
    public function index()
    {
        $item = AboutPage::where('is_active', 1)->first();

        $teamMembers = TeamMember::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $cta = CtaSection::where('is_active', 1)
            ->with(['items' => fn ($q) => $q->where('is_active', 1)->orderBy('sort_order')])
            ->first();

        $crumbTitle = $item?->heading ?: ($item?->page_title ?: 'About');
        $crumbItems = [
            ['label' => 'Home', 'url' => route('site.home')],
            ['label' => 'About', 'url' => route('site.about')],
        ];

        return view('site.about', compact('item', 'teamMembers', 'cta', 'crumbTitle', 'crumbItems'));
    }
}