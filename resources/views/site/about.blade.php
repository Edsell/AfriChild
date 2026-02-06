@php
  use App\Models\TeamMember;

  $title = $item?->meta_title ?: ($item?->page_title ?: 'About Us');
  $img = !empty($item?->image) ? asset('storage/' . ltrim($item->image, '/')) : null;

  // Team members: prefer controller-provided, else safe fallback query
  if (!isset($teamMembers)) {
      $teamMembers = TeamMember::where('is_active', 1)->orderBy('sort_order')->get();
  }

  $teamMembers = collect($teamMembers);

  $typeOptions = TeamMember::typeOptions();

  $typeOrder = [
    TeamMember::TYPE_BOARD,
    TeamMember::TYPE_SECRETARIAT,
    TeamMember::TYPE_FOUNDING_MEMBERS,
    TeamMember::TYPE_PROMOTING_PARTNERS,
  ];

  $teamByType = $teamMembers
      ->where('is_active', true)
      ->sortBy('sort_order')
      ->groupBy('type');
@endphp
@php
  $pageTitle = $item?->meta_title ?: ($item?->page_title ?: 'About Us');

  // Breadcrumb label for the page header (use heading/page_title fallback)
  $crumbTitle = $item?->heading ?: ($item?->page_title ?: 'About');

  // Breadcrumb items (expects 'label' key)
  $crumbItems = [
    ['label' => 'Home', 'url' => route('site.home')],
    ['label' => 'About', 'url' => route('site.about')],
  ];

  $img = !empty($item?->image) ? asset('storage/' . ltrim($item->image, '/')) : null;
@endphp

@include('site.headers.head', ['title' => $pageTitle])

{{-- Breadcrumbs (safe include) --}}
@include('site.headers.pg-crumb', [
  'title' => $crumbTitle,
  'items' => $crumbItems,
])


{{-- ABOUT CONTENT --}}
<section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default" style="padding: 50px 0;">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="row align-items-center" style="row-gap: 24px;">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="zozo-parallax-header margin-bottom-0">
            <div class="parallax-header content-style-default">
              <h2 class="parallax-title text-left">
                {{ $item?->heading ?: 'About AfriChild' }}
              </h2>

              <div class="parallax-desc default-style text-left" style="margin-top: 14px;">
                {!! nl2br(e($item?->content ?: '')) !!}
              </div>
            </div>
          </div>

          @if(!empty($item?->cta_text) && !empty($item?->cta_url))
            <div class="vc_btn3-container vc_btn3-left vc_do_btn" style="margin-top: 18px;">
              <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-default vc_btn3-color-primary-bg"
                 href="{{ $item->cta_url }}">
                {{ $item->cta_text }}
              </a>
            </div>
          @endif
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 text-center">
          @if($img)
            <img src="{{ $img }}" alt="{{ $item?->heading ?: 'About' }}"
                 style="max-width: 100%; height: auto; border-radius: 12px;">
          @endif
        </div>

      </div>
    </div>
  </div>
</section>

{{-- TEAM SECTION --}}
@if($teamMembers->count() > 0)
<section id="about-team" class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default" style="padding: 55px 0; background:#fafafa;">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">

      <div class="zozo-parallax-header">
        <div class="parallax-header content-style-default">
          <h2 class="parallax-title">Our Team & Partners</h2>
          <div class="parallax-desc default-style" style="max-width: 820px;">
            Meet the people and organizations supporting AfriChild’s mission.
          </div>
        </div>
      </div>

      @foreach($typeOrder as $typeKey)
        @php
          $group = $teamByType->get($typeKey, collect())->values();
        @endphp

        @if($group->count() > 0)
          <div class="ac-team-group" style="margin-top: 34px;">

            <div class="d-flex align-items-center justify-content-between" style="gap:12px; margin-bottom: 14px;">
              <h3 style="margin:0; font-size: 22px; font-weight: 800;">
                {{ $typeOptions[$typeKey] ?? ucfirst(str_replace('_',' ', $typeKey)) }}
              </h3>
            </div>

            @if($typeKey === TeamMember::TYPE_BOARD || $typeKey === TeamMember::TYPE_SECRETARIAT)
              <div class="row" style="row-gap: 22px;">
                @foreach($group as $m)
                  @php
                    $photoUrl = $m->photo ? asset(ltrim($m->photo,'/')) : null;
                  @endphp

                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <article class="ac-team-card">
                      <div class="ac-team-photo">
                        @if($photoUrl)
                          <img loading="lazy" decoding="async" src="{{ $photoUrl }}" alt="{{ $m->name }}">
                        @endif
                      </div>

                      <div class="ac-team-body">
                        <div class="ac-team-name">{{ $m->name }}</div>

                        @if($m->designation)
                          <div class="ac-team-role">{{ $m->designation }}</div>
                        @endif

                        <div class="ac-team-social">
                          @if($m->facebook)<a href="{{ $m->facebook }}" target="_blank" aria-label="Facebook"><i class="fa fa-facebook"></i></a>@endif
                          @if($m->twitter)<a href="{{ $m->twitter }}" target="_blank" aria-label="X/Twitter"><i class="fa-brands fa-x-twitter"></i></a>@endif
                          @if($m->linkedin)<a href="{{ $m->linkedin }}" target="_blank" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>@endif
                          @if($m->instagram)<a href="{{ $m->instagram }}" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>@endif
                        </div>
                      </div>
                    </article>
                  </div>
                @endforeach
              </div>
            @else
              <div class="row" style="row-gap: 18px;">
                @foreach($group as $m)
                  @php
                    $logoUrl = $m->photo ? asset(ltrim($m->photo,'/')) : null;
                    $link = $m->linkedin ?: ($m->facebook ?: ($m->twitter ?: ($m->instagram ?: null)));
                  @endphp

                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="ac-partner-card">
                      @if($link)
                        <a href="{{ $link }}" target="_blank" class="ac-partner-link" aria-label="{{ $m->name }}">
                      @endif

                      <div class="ac-partner-logo">
                        @if($logoUrl)
                          <img loading="lazy" decoding="async" src="{{ $logoUrl }}" alt="{{ $m->name }}">
                        @else
                          <div class="ac-partner-fallback">{{ $m->name }}</div>
                        @endif
                      </div>

                      <div class="ac-partner-name">{{ $m->name }}</div>

                      @if($link)
                        </a>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            @endif

          </div>
        @endif
      @endforeach

    </div>
  </div>

  <style>
    #about-team .ac-team-card{
      background:#fff;
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 6px 18px rgba(0,0,0,.06);
      height: 100%;
    }
    #about-team .ac-team-photo{
      height: 260px;
      background:#f2f2f2;
      overflow:hidden;
    }
    #about-team .ac-team-photo img{
      width:100%;
      height:100%;
      object-fit:cover;
      display:block;
    }
    #about-team .ac-team-body{
      padding: 14px 12px 16px;
      text-align:center;
      background:#eee;
    }
    #about-team .ac-team-name{ font-weight:800; margin-bottom:6px; }
    #about-team .ac-team-role{ opacity:.8; margin-bottom:12px; }

    #about-team .ac-team-social{
      display:flex; justify-content:center; gap:10px; flex-wrap:wrap;
    }
    #about-team .ac-team-social a{
      width: 40px; height: 40px;
      display:inline-flex; align-items:center; justify-content:center;
      border: 1px solid rgba(0,0,0,.12);
      background: rgba(255,255,255,.3);
      text-decoration:none;
      border-radius: 10px;
    }

    #about-team .ac-partner-card{
      background:#fff;
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 14px;
      padding: 16px 14px;
      box-shadow: 0 6px 18px rgba(0,0,0,.06);
      height: 100%;
      text-align:center;
    }
    #about-team .ac-partner-link{ color:inherit; text-decoration:none; display:block; height:100%; }
    #about-team .ac-partner-logo{
      height: 90px;
      display:flex; align-items:center; justify-content:center;
      background:#f7f7f7;
      border-radius: 12px;
      overflow:hidden;
      margin-bottom:10px;
      padding:8px;
    }
    #about-team .ac-partner-logo img{
      max-height: 74px;
      max-width: 100%;
      object-fit: contain;
      display:block;
    }
    #about-team .ac-partner-fallback{ font-weight:800; padding:8px; }
    #about-team .ac-partner-name{ font-weight:800; margin-top:6px; line-height:1.2; }
  </style>
</section>
@endif

@include('site.footers.foot')
