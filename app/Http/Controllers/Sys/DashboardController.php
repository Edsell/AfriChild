<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Later: replace these counts with real Eloquent model counts.
        $stats = [
            'pages'     => 0,
            'blogs'     => 0,
            'events'    => 0,
            'gallery'   => 0,
            'team'      => 0,
            'messages'  => 0, // contact inquiries
        ];

        // Dashboard “modules” (cards)
        $modules = [
            [
                'title' => 'Home',
                'desc'  => 'Manage homepage sections, hero, and highlights.',
                'icon'  => 'bx bx-home-smile',
                'count' => $stats['pages'],
                'badge' => 'Sections',
                'route' => 'sys.home.index', // create later
            ],
            [
                'title' => 'About',
                'desc'  => 'Update mission, vision, and organization story.',
                'icon'  => 'bx bx-info-circle',
                'count' => $stats['pages'],
                'badge' => 'Page',
                'route' => 'sys.about.index', // create later
            ],
            [
                'title' => 'Blog',
                'desc'  => 'Create posts, categories, tags, and media.',
                'icon'  => 'bx bx-news',
                'count' => $stats['blogs'],
                'badge' => 'Posts',
                'route' => 'sys.blog.index', // create later
            ],
            [
                'title' => 'Events',
                'desc'  => 'Publish events, schedules, and registrations.',
                'icon'  => 'bx bx-calendar-event',
                'count' => $stats['events'],
                'badge' => 'Events',
                'route' => 'sys.events.index', // create later
            ],
            [
                'title' => 'Gallery',
                'desc'  => 'Manage photos, albums, and highlights.',
                'icon'  => 'bx bx-images',
                'count' => $stats['gallery'],
                'badge' => 'Items',
                'route' => 'sys.gallery.index', // create later
            ],
            [
                'title' => 'Team',
                'desc'  => 'Manage team profiles and roles.',
                'icon'  => 'bx bx-group',
                'count' => $stats['team'],
                'badge' => 'Members',
                'route' => 'sys.team.index', // create later
            ],
            [
                'title' => 'Contact',
                'desc'  => 'View messages and inquiries.',
                'icon'  => 'bx bx-envelope',
                'count' => $stats['messages'],
                'badge' => 'Inbox',
                'route' => 'sys.contact.index', // create later
            ],
        ];

        return view('sys.dashboard.index', compact('stats', 'modules'));
    }
}
