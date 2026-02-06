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

              <div class="parallax-desc default-style text-left Justly" style="margin-top: 14px;">
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



@include('site.footers.foot')
