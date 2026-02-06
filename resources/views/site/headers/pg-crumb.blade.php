{{-- resources/views/site/headers/pg-crumb.blade.php --}}

@php
  // Expected:
  // $title (required)
  // $homeUrl (optional)
  // $items (optional): array of ['label' => '...', 'url' => '...'] for intermediate crumbs
  $homeUrl = $homeUrl ?? url('/');
  $items   = $items ?? [];

  // Global settings crumb background
  $crumbBg = $generalSettings?->Crumb ? asset($generalSettings->Crumb) : null;

  // Higher = darker overlay (better contrast for white text)
  $overlay = 0.70;
@endphp

<div
  data-zozo-parallax="2"
  data-zozo-parallax-position="left top"
  class="page-title-section page-titletype-default page-titleskin-default page-titlealign-default zozo-parallax afc-crumb"
  @if($crumbBg)
    style="
      background-image: linear-gradient(rgba(0,0,0,{{ $overlay }}), rgba(0,0,0,{{ $overlay }})), url('{{ $crumbBg }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    "
  @endif
>
  <style>
    /* Force white text */
    .afc-crumb,
    .afc-crumb .entry-title,
    .afc-crumb .zozo-breadcrumbs,
    .afc-crumb .zozo-breadcrumbs a,
    .afc-crumb .zozo-breadcrumbs span,
    .afc-crumb .zozo-breadcrumbs .current {
      color: #fff !important;
    }

    /* Readability */
    .afc-crumb .entry-title,
    .afc-crumb .zozo-breadcrumbs {
      text-shadow: 0 2px 10px rgba(0,0,0,.55);
    }

    /* Dash separators (no arrows) */
    .afc-crumb .afc-sep{
      display:inline-block;
      margin: 0 10px;
      color: rgba(255,255,255,.65) !important;
      text-shadow: 0 2px 10px rgba(0,0,0,.55);
    }

    /* Hide any theme separator arrows if they exist */
    .afc-crumb .separator{ display:none !important; }

    .afc-crumb .zozo-breadcrumbs a:hover{
      opacity:.9;
      text-decoration: underline;
    }
  </style>

  <div class="page-title-wrapper clearfix">
    <div class="container">
      <div class="page-title-container">

        <div class="page-title-captions">
          <h1 class="entry-title">{{ $title }}</h1>
        </div>

        <div class="page-title-breadcrumbs">
          <div id="breadcrumb" class="breadcrumb zozo-breadcrumbs">
            <a href="{{ $homeUrl }}">Home</a>

            @foreach($items as $crumb)
              @if(!empty($crumb['label']))
                <span class="afc-sep">—</span>

                @if(!empty($crumb['url']))
                  <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                @else
                  <span>{{ $crumb['label'] }}</span>
                @endif
              @endif
            @endforeach

            <span class="afc-sep">—</span>
            <span class="current">{{ $title }}</span>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
