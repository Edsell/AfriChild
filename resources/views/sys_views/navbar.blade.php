<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar"
>
  {{-- Mobile menu toggle --}}
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 d-xl-none">
    <a class="nav-item nav-link px-0" href="javascript:void(0)">
      <i class="icon-base bx bx-menu icon-md"></i>
    </a>
  </div>

  {{-- Left side: Search --}}
  <div class="navbar-nav align-items-center flex-grow-1">
    <div class="nav-item d-flex align-items-center w-100">
      <span class="w-px-22 h-px-22 me-2"><i class="icon-base bx bx-search icon-md"></i></span>
      <input
        type="text"
        class="form-control border-0 shadow-none ps-0 d-md-block d-none"
        placeholder="Search..."
        aria-label="Search..."
      />
    </div>
  </div>

  {{-- Right side: User dropdown --}}
<ul class="navbar-nav flex-row align-items-center ms-auto">
  @php
    $me = auth()->user();
    $avatar = $me?->avatar ? asset($me->avatar) : asset('bootstrap/assets/img/avatars/1.png');
    $profileUrl = \Illuminate\Support\Facades\Route::has('profile.edit')
      ? route('profile.edit')
      : url('/admin');
  @endphp

  <li class="nav-item dropdown dropdown-user">
    <button
      class="nav-link dropdown-toggle hide-arrow p-0 bg-transparent border-0"
      type="button"
      data-bs-toggle="dropdown"
      data-bs-auto-close="outside"
      aria-expanded="false"
    >
      <div class="avatar avatar-online">
        <img
          src="{{ $avatar }}"
          alt="User"
          class="w-px-40 h-px-40 rounded-circle"
          style="object-fit:cover;"
        />
      </div>
    </button>

    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="{{ $profileUrl }}">
          <div class="d-flex">
            <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online">
                <img src="{{ $avatar }}" alt="User" class="w-px-40 h-px-40 rounded-circle" style="object-fit:cover;" />
              </div>
            </div>
            <div class="flex-grow-1">
              <h6 class="mb-0">{{ $me?->name ?? 'Admin' }}</h6>
              <small class="text-body-secondary">{{ $me?->email ?? '' }}</small>
            </div>
          </div>
        </a>
      </li>

      <li><div class="dropdown-divider my-1"></div></li>

      <li>
        <a class="dropdown-item" href="{{ $profileUrl }}">
          <i class="icon-base bx bx-user icon-md me-3"></i><span>Profile</span>
        </a>
      </li>

      <li>
        <a class="dropdown-item" href="{{ $profileUrl }}">
          <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
        </a>
      </li>

      <li><div class="dropdown-divider my-1"></div></li>

      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item">
            <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
          </button>
        </form>
      </li>
    </ul>
  </li>
</ul>

</nav>
