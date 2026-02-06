<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\HomePage;

class ProjectPublicController extends Controller
{
     public function index(Request $request)
        {
            $q = trim((string) $request->get('q', ''));

            $projectsQuery = Project::query()
                // If you have is_published / is_active fields, uncomment what applies:
                // ->where('is_published', 1)
                // ->where('is_active', 1)
                ->orderByDesc('published_at')
                ->orderByDesc('id');

            if ($q !== '') {
                $projectsQuery->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('client', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
                });
            }

            $projects = $projectsQuery->paginate(9)->withQueryString();

            // Optional (only if you already use $home for section headings)
            $home = class_exists(HomePage::class) ? HomePage::query()->first() : null;

            return view('site.projects', compact('projects', 'home', 'q'));
        }

        public function show(Request $request, $project, $slug = null)
        {
            $item = Project::with(['galleryImages'])->findOrFail($project);

            // Canonical slug (nice URLs, avoids duplicates)
            if (!empty($item->slug) && $slug !== $item->slug) {
                return redirect()
                    ->route('site.projects.show', ['project' => $item->id, 'slug' => $item->slug])
                    ->setStatusCode(301);
            }

            return view('site.project-details', compact('item'));
        }

        public function ProjectsAll()  {

        $projects = Project::withCount('galleryImages')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9);

            return view('site.projetcs_all', compact('projects'));
            
        }
}
