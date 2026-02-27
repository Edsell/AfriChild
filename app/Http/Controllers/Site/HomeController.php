<?php


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\HomePage;      // or Page/Home depending on your CRUD
use App\Models\HeroSlide;
use App\Models\Service;
use App\Models\Project;
use App\Models\MissionSection;
use App\Models\CtaSection;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $home = HomePage::query()->first(); // or Page::whereSlug('home')->first();

        $heroSlides = HeroSlide::where('is_active', 1)
        ->orderByDesc('id')
        ->get();

        $services = Service::query()
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $projects = Project::query()
            ->where('is_active', 1)
            ->orderByDesc('published_at') // or sort_order
            ->take(8)
            ->get();

        $mission = MissionSection::query()
            ->where('is_active', 1)
            ->with(['items' => fn($q) => $q->where('is_active', 1)->orderBy('sort_order')])
            ->first();

        $cta = CtaSection::query()
            ->where('is_active', 1)
            ->with(['items' => fn($q) => $q->where('is_active', 1)->orderBy('sort_order')])
            ->first();

        $team = TeamMember::query()
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $partners = Partner::query()
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $latestPosts = Post::where('is_published', 1)
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        return view('site.home', compact('home', 'heroSlides', 'services', 'projects', 'mission', 'cta', 'team', 'partners', 'latestPosts'));
    }

    public function partners()
{
    $partners = Partner::query()
        // ->where('is_active', true)
        ->orderBy('sort_order')
        ->paginate(12);

    return view('site.partners', compact('partners'));
}
}
