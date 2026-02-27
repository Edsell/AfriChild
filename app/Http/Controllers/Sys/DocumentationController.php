<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{
  public function index(Request $request)
  {
    // Only send menu structure + initial selected key
    $menu = $this->menu();
    $defaultKey = $request->get('k', 'overview');

    // If invalid key, fallback
    if (!$this->isValidKey($defaultKey)) $defaultKey = 'overview';

    return view('sys.documentation.index', compact('menu', 'defaultKey'));
  }

  public function section(string $key)
  {
    if (!$this->isValidKey($key)) abort(404);

    // Each section is a blade partial in resources/views/sys/documentation/sections/{key}.blade.php
    return view('sys.documentation.sections.' . $key);
  }

  private function isValidKey(string $key): bool
  {
    $allowed = collect($this->menu())
      ->flatMap(function ($item) {
        $keys = [$item['key']];
        if (!empty($item['children'])) {
          foreach ($item['children'] as $c) $keys[] = $c['key'];
        }
        return $keys;
      })
      ->unique()
      ->values()
      ->all();

    return in_array($key, $allowed, true);
  }

  private function menu(): array
  {
    // THIS is not “content”, it’s just menu wiring + order.
    // Matches your sidebar order.
    return [
      ['key' => 'overview', 'label' => 'Overview', 'icon' => 'bx bx-home-circle'],

      [
        'key' => 'home', 'label' => 'Home Page', 'icon' => 'bx bx-home',
        'children' => [
          ['key' => 'hero-slides', 'label' => 'Hero Slides', 'icon' => 'bx bx-slideshow'],
          ['key' => 'services', 'label' => 'Services', 'icon' => 'bx bx-list-check'],
          ['key' => 'mission', 'label' => 'Mission', 'icon' => 'bx bx-target-lock'],
          ['key' => 'cta', 'label' => 'CTA', 'icon' => 'bx bx-bullseye'],
          ['key' => 'partners', 'label' => 'Partners', 'icon' => 'bx bx-building-house'],
        ],
      ],

      ['key' => 'about', 'label' => 'About', 'icon' => 'bx bx-info-circle'],
      ['key' => 'blog', 'label' => 'Blog', 'icon' => 'bx bx-news'],
      ['key' => 'projects', 'label' => 'Projects', 'icon' => 'bx bx-briefcase'],
      ['key' => 'events', 'label' => 'Events', 'icon' => 'bx bx-calendar-event'],
      ['key' => 'gallery', 'label' => 'Gallery', 'icon' => 'bx bx-images'],
      ['key' => 'team', 'label' => 'Team', 'icon' => 'bx bx-group'],
      ['key' => 'users', 'label' => 'Users', 'icon' => 'bx bx-user'],
      ['key' => 'messages', 'label' => 'Messages', 'icon' => 'bx bx-envelope'],

      ['key' => 'general-settings', 'label' => 'General Settings', 'icon' => 'bx bx-cog'],
    ];
  }
}