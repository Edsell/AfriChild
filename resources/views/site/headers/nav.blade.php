{{-- resources/views/site/headers/nav.blade.php --}}

@php
  // Active state (server-side, reliable)
  $isHome     = request()->is('/');
  $isAbout    = request()->routeIs('site.about') || request()->is('about*');
  $isProjects = request()->routeIs('site.projects.all') || request()->is('projects*');
  $isEvents   = request()->routeIs('site.events.*') || request()->is('events*');
  $isGallery  = request()->routeIs('site.gallery.*') || request()->is('gallery*');
  $isBlog     = request()->is('blog*');
  $isContact  = request()->routeIs('site.contact') || request()->is('contact*');
@endphp

<div class="ac-navbar" id="acNavbar">
  <div class="ac-container ac-navbar-inner">

    <button class="ac-burger" id="acBurger" aria-label="Open menu" aria-expanded="false" aria-controls="acNavMenu">
      <span></span><span></span><span></span>
    </button>

    <nav class="ac-nav" aria-label="Primary navigation">
      <ul class="ac-menu" id="acNavMenu">
        <li><a class="ac-menu-link {{ $isHome ? 'is-active' : '' }}" href="{{ url('/') }}">HOME</a></li>


        <li class="ac-has-dropdown">
        <a class="ac-menu-link {{ ($isAbout || request()->routeIs('site.team.*')) ? 'is-active' : '' }}"
            href="{{ route('site.about') }}"
            aria-haspopup="true"
            aria-expanded="false">
            ABOUT
            <span class="ac-dd-caret" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
        </a>

        <ul class="ac-dropdown" aria-label="About submenu">
            <li><a href="{{ route('site.about') }}">Who we are</a></li>
            <li><a href="{{ route('site.team.type', ['type' => 'board']) }}">Board of Directors</a></li>
            <li><a href="{{ route('site.team.type', ['type' => 'secretariat']) }}">Secretariat</a></li>
            <li><a href="{{ route('site.team.type', ['type' => 'founding-members']) }}">Founding Members</a></li>
            <li><a href="{{ route('site.team.type', ['type' => 'promoting-partners']) }}">Promoting Partners</a></li>
        </ul>
        </li>



        <li><a class="ac-menu-link {{ $isProjects ? 'is-active' : '' }}" href="{{ route('site.projects.all') }}">PROJECTS</a></li>
        <li><a class="ac-menu-link {{ $isEvents ? 'is-active' : '' }}" href="{{ route('site.events.index') }}">EVENTS</a></li>
        <li><a class="ac-menu-link {{ $isGallery ? 'is-active' : '' }}" href="{{ route('site.gallery.index') }}">GALLERY</a></li>
        <li><a class="ac-menu-link {{ $isBlog ? 'is-active' : '' }}" href="{{ url('/blog') }}">BLOG</a></li>
        <li><a class="ac-menu-link {{ $isContact ? 'is-active' : '' }}" href="{{ route('site.contact') }}">CONTACT</a></li>
      </ul>
    </nav>

    <div class="ac-cta">
      <a class="ac-btn" href="https://hub.africhild.cloud/">KNOWLEDGE HUB</a>
    </div>

  </div>
</div>


