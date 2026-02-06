{{-- resources/views/site/headers/top.blade.php --}}

@php
  $company = $generalSettings?->CompanyName ?? 'AfriChild Center';
  $address = $generalSettings?->Address ?? 'Kigobe Rd, Kampala, Uganda.';
  $phone   = trim(($generalSettings?->Code ?? '+256') . ' ' . ($generalSettings?->Phone ?? '414 532 482'));
  $email   = $generalSettings?->Email ?? 'info@africhild.or.ug';

  $logo = asset('assets/logo.png');
@endphp

<header class="ac-header" id="acHeader">
  <div class="ac-topbar" id="acTopbar">
    <div class="ac-container ac-topbar-inner">

      <a class="ac-brand" href="{{ url('/') }}" aria-label="AfriChild Home">
        <img src="{{ $logo }}" alt="AfriChild" class="ac-logo">
      </a>

      <div class="ac-infogrid" aria-label="Organization contact information">
        <div class="ac-info">
          <span class="ac-icon" aria-hidden="true"><i class="fa-solid fa-location-dot"></i></span>
          <div class="ac-info-text">
            <div class="ac-info-title">{{ $company }}</div>
            <div class="ac-info-sub">{{ $address }}</div>
          </div>
        </div>

        <div class="ac-info">
          <span class="ac-icon" aria-hidden="true"><i class="fa-regular fa-clock"></i></span>
          <div class="ac-info-text">
            <div class="ac-info-title">Monday–Friday: 9am to 5pm</div>
            <div class="ac-info-sub">Saturday / Sunday: Closed</div>
          </div>
        </div>

        <div class="ac-info">
          <span class="ac-icon" aria-hidden="true"><i class="fa-solid fa-phone"></i></span>
          <div class="ac-info-text">
            <div class="ac-info-title">{{ $phone }}</div>
            <div class="ac-info-sub">
              <a class="ac-link" href="mailto:{{ $email }}">{{ $email }}</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>
