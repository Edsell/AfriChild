<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <span class="text-primary">
         <img
                    src="{{ asset('assets/icon.png') }}"
                    alt="AfriChild Logo"
                    style="width:100%;height:auto"
                    class="rounded" />
        </span>
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
    </a>
  </div>

  <div class="menu-divider mt-0"></div>
  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    {{-- Dashboard --}}
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate">Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">CMS Modules</span>
    </li>

    {{-- Home Page Dropdown --}}
    <li class="menu-item {{ request()->routeIs('sys.home-pages.*','sys.hero-slides.*','sys.services.*','sys.mission.*','sys.cta.*','sys.partners.*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-home"></i>
        <div data-i18n="Home Page">Home Page</div>
      </a>

      <ul class="menu-sub">
        {{-- <li class="menu-item {{ request()->routeIs('sys.home-pages.*') ? 'active' : '' }}">
          <a href="{{ route('sys.home-pages.index') }}" class="menu-link">
            <div data-i18n="Settings">Settings</div>
          </a>
        </li> --}}

        <li class="menu-item {{ request()->routeIs('sys.hero-slides.*') ? 'active' : '' }}">
          <a href="{{ route('sys.hero-slides.index') }}" class="menu-link">
            <div data-i18n="Hero Slides">Hero Slides</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('sys.services.*') ? 'active' : '' }}">
          <a href="{{ route('sys.services.index') }}" class="menu-link">
            <div data-i18n="Services">Services</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('sys.mission.*') ? 'active' : '' }}">
          <a href="{{ route('sys.mission.index') }}" class="menu-link">
            <div data-i18n="Mission">Mission</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('sys.cta.*') ? 'active' : '' }}">
          <a href="{{ route('sys.cta.index') }}" class="menu-link">
            <div data-i18n="CTA">CTA</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('sys.partners.*') ? 'active' : '' }}">
          <a href="{{ route('sys.partners.index') }}" class="menu-link">
            <div data-i18n="Partners">Partners</div>
          </a>
        </li>
      </ul>
    </li>

    {{-- About --}}
    <li class="menu-item {{ request()->routeIs('sys.about.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.about.index') ? route('sys.about.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-info-circle"></i>
        <div class="text-truncate">About</div>
      </a>
    </li>

    {{-- Blog --}}
    <li class="menu-item {{ request()->routeIs('sys.posts.*','sys.categories.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.posts.index') ? route('sys.posts.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-news"></i>
        <div class="text-truncate">Blog</div>
      </a>
    </li>

    {{-- Projects  --}}
    <li class="menu-item {{ request()->routeIs('sys.projects.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.projects.index') ? route('sys.projects.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-grid-alt"></i>
        <div class="text-truncate">Projects</div>
      </a>
    </li>

    {{-- Events --}}
    <li class="menu-item {{ request()->routeIs('sys.events.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.events.index') ? route('sys.events.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar-event"></i>
        <div class="text-truncate">Events</div>
      </a>
    </li>

    {{-- Gallery --}}
    <li class="menu-item {{ request()->routeIs('sys.galleries.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.galleries.index') ? route('sys.galleries.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-images"></i>
        <div class="text-truncate">Gallery</div>
      </a>
    </li>

    {{-- Team --}}
    <li class="menu-item {{ request()->routeIs('sys.team-members.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.team-members.index') ? route('sys.team-members.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate">Team</div>
      </a>
    </li>

    @can('manage-users')
      <li class="menu-item {{ request()->routeIs('sys.users.*') ? 'active open' : '' }}">
        <a href="{{ route('sys.users.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Users">Users</div>
        </a>
      </li>
    @endcan

    {{-- Contact / Messages --}}
    <li class="menu-item {{ request()->routeIs('sys.contact.*') ? 'active open' : '' }}">
      <a href="{{ \Route::has('sys.contact.index') ? route('sys.contact.index') : 'javascript:void(0);' }}"
         class="menu-link">
        <i class="menu-icon tf-icons bx bx-envelope"></i>
        <div class="text-truncate">Messages</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Account</span>
    </li>

    <li class="menu-item {{ request()->routeIs('sys.settings.*') ? 'active open' : '' }}">
      <a href="{{ route('sys.settings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div data-i18n="General Settings">General Settings</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('sys.documentation.*') ? 'active' : '' }}">
  <a href="{{ route('sys.documentation.index') }}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-book-content"></i>
    <div>Documentation</div>
  </a>
</li>

    <li class="menu-item">
      <a href="{{ url('/') }}" target="_blank" class="menu-link">
        <i class="menu-icon tf-icons bx bx-link-external"></i>
        <div class="text-truncate">View Website</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="menu-icon tf-icons bx bx-power-off"></i>
        <div class="text-truncate">Logout</div>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>

  </ul>
</aside>
