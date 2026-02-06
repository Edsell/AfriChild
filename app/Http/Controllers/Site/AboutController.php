<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\TeamMember;

class AboutController extends Controller
{
   public function index()
    {
        $item = AboutPage::first(); // adjust to your actual retrieval logic

        $teamMembers = TeamMember::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        // breadcrumb vars if you use them
        $crumbTitle = 'About';
        $crumbItems = [
            ['title' => 'Home', 'url' => route('site.home')],
            ['title' => 'About', 'url' => route('site.about')],
        ];

        return view('site.about', compact('item', 'teamMembers', 'crumbTitle', 'crumbItems'));
    }
}
