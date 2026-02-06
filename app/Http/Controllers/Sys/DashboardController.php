<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // ---- Safe helpers (won't crash if model/table doesn't exist) ----
        $countTable = function (?string $table, ?callable $query = null): int {
            if (!$table || !Schema::hasTable($table)) return 0;
            $q = DB::table($table);
            if ($query) $query($q);
            return (int) $q->count();
        };

        $latestFromTable = function (?string $table, int $limit = 5, string $orderCol = 'created_at', array $cols = ['*']) {
            if (!$table || !Schema::hasTable($table)) return collect();
            $orderCol = Schema::hasColumn($table, $orderCol) ? $orderCol : 'id';
            return DB::table($table)->select($cols)->orderByDesc($orderCol)->limit($limit)->get();
        };

        // ---- Tables (adjust if your names differ) ----
        // Common defaults in Laravel projects:
        $tables = [
            'pages'     => Schema::hasTable('pages') ? 'pages' : null,
            'posts'     => Schema::hasTable('posts') ? 'posts' : (Schema::hasTable('blog_posts') ? 'blog_posts' : null),
            'events'    => Schema::hasTable('events') ? 'events' : null,
            'gallery'   => Schema::hasTable('galleries') ? 'galleries' : (Schema::hasTable('gallery_items') ? 'gallery_items' : null),
            'team'      => Schema::hasTable('team_members') ? 'team_members' : (Schema::hasTable('teams') ? 'teams' : null),
            'projects'  => Schema::hasTable('projects') ? 'projects' : null,
            'messages'  => Schema::hasTable('contact_messages') ? 'contact_messages' : (Schema::hasTable('messages') ? 'messages' : null),
        ];

        // ---- Core stats (relevant for org: content + reach) ----
        $stats = [
            'pages'    => $countTable($tables['pages']),
            'blogs'    => $countTable($tables['posts']),
            'events'   => $countTable($tables['events']),
            'projects' => $countTable($tables['projects']),
            'gallery'  => $countTable($tables['gallery']),
            'team'     => $countTable($tables['team']),
            'messages' => $countTable($tables['messages']),
        ];

        // “This month” highlights (nice + meaningful)
        $startOfMonth = Carbon::now()->startOfMonth();

        $messagesThisMonth = $countTable($tables['messages'], function ($q) use ($startOfMonth, $tables) {
            if ($tables['messages'] && Schema::hasColumn($tables['messages'], 'created_at')) {
                $q->where('created_at', '>=', $startOfMonth);
            }
        });

        $postsThisMonth = $countTable($tables['posts'], function ($q) use ($startOfMonth, $tables) {
            if ($tables['posts'] && Schema::hasColumn($tables['posts'], 'created_at')) {
                $q->where('created_at', '>=', $startOfMonth);
            }
        });

        // ---- Recent activity blocks ----
        $recentMessages = $latestFromTable(
            $tables['messages'],
            6,
            'created_at',
            ['id', 'name', 'email', 'subject', 'message', 'created_at']
        );

        $recentPosts = $latestFromTable(
            $tables['posts'],
            6,
            'created_at',
            ['id', 'title', 'slug', 'created_at']
        );

        // Upcoming events: prefer "start_date" or "event_date" if available
        $upcomingEvents = collect();
        if ($tables['events'] && Schema::hasTable($tables['events'])) {
            $dateCol = Schema::hasColumn($tables['events'], 'start_date')
                ? 'start_date'
                : (Schema::hasColumn($tables['events'], 'event_date') ? 'event_date' : null);

            $q = DB::table($tables['events'])->select(['id', 'title', 'slug', 'location', 'created_at']);
            if ($dateCol) {
                $q->addSelect($dateCol);
                $q->whereDate($dateCol, '>=', Carbon::today())
                  ->orderBy($dateCol, 'asc');
            } else {
                $q->orderByDesc('created_at');
            }

            $upcomingEvents = $q->limit(6)->get();
        }

        // ---- Module cards (counts + routes + icons) ----
        // NOTE: keep routes aligned with your existing sys routes.
        // If a route doesn't exist, the Blade already disables the button.
        $modules = [
            [
                'title' => 'Pages',
                'desc'  => 'Manage static pages content.',
                'icon'  => 'bx bx-file',
                'badge' => 'Content',
                'count' => $stats['pages'],
                'route' => 'sys.pages.index', // change if yours differs
            ],
            [
                'title' => 'Blog Posts',
                'desc'  => 'Publish research, news & stories.',
                'icon'  => 'bx bx-news',
                'badge' => 'Content',
                'count' => $stats['blogs'],
                'route' => 'sys.posts.index',
            ],
            [
                'title' => 'Events',
                'desc'  => 'Workshops, forums & engagements.',
                'icon'  => 'bx bx-calendar-event',
                'badge' => 'Programs',
                'count' => $stats['events'],
                'route' => 'sys.events.index',
            ],
            [
                'title' => 'Projects',
                'desc'  => 'Track ongoing initiatives & outcomes.',
                'icon'  => 'bx bx-bulb',
                'badge' => 'Programs',
                'count' => $stats['projects'],
                'route' => 'sys.projects.index',
            ],
            [
                'title' => 'Gallery',
                'desc'  => 'Photos & media highlights.',
                'icon'  => 'bx bx-images',
                'badge' => 'Media',
                'count' => $stats['gallery'],
                'route' => 'sys.galleries.index',
            ],
            [
                'title' => 'Team',
                'desc'  => 'People behind AfriChild.',
                'icon'  => 'bx bx-group',
                'badge' => 'People',
                'count' => $stats['team'],
                'route' => 'sys.team.index',
            ],
            [
                'title' => 'Messages',
                'desc'  => 'Contact form submissions.',
                'icon'  => 'bx bx-envelope',
                'badge' => 'Outreach',
                'count' => $stats['messages'],
                'route' => 'sys.messages.index',
            ],
        ];

        return view('sys.dashboard.index', [
            'stats'            => $stats,
            'modules'          => $modules,
            'messagesThisMonth'=> $messagesThisMonth,
            'postsThisMonth'   => $postsThisMonth,
            'recentMessages'   => $recentMessages,
            'recentPosts'      => $recentPosts,
            'upcomingEvents'   => $upcomingEvents,
        ]);
    }
}
