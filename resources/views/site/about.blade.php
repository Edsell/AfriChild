@php
  // Normalize content to array when possible
  $contentArr = [];

  if (isset($item->content) && is_array($item->content)) {
      $contentArr = $item->content;
  } elseif (isset($item->content) && is_string($item->content)) {
      $decoded = json_decode($item->content, true);
      if (is_array($decoded)) {
          $contentArr = $decoded;
      }
  }

  // Resolve page title
  $pageTitle = $item->meta_title
      ?? $item->page_title
      ?? $item->title
      ?? 'About Us';

  // Resolve heading
  $heading = $item->heading
      ?? ($contentArr['heading'] ?? null)
      ?? $item->title
      ?? 'About AfriChild';

  // Resolve body
  $body = '';
  if (isset($item->content) && is_string($item->content) && empty($contentArr)) {
      // if content is plain string (not JSON)
      $body = $item->content;
  } else {
      $body = $contentArr['body'] ?? '';
  }

  // Resolve CTA
  $ctaText = $item->cta_text ?? ($contentArr['cta_text'] ?? null);
  $ctaUrl  = $item->cta_url  ?? ($contentArr['cta_url']  ?? null);

  // Resolve image
  $rawImage = $item->image ?? ($contentArr['image'] ?? null);
   $img = null;

  if (!empty($item?->image)) {
      $path = str_replace('\\', '/', ltrim($item->image, '/'));

      // If the DB already contains "storage/..." don't double it
      if (\Illuminate\Support\Str::startsWith($path, 'storage/')) {
          $img = asset($path);
      } else {
          // Standard storage-disk relative (public disk)
          $img = asset('storage/' . $path);
      }
  }

  // Breadcrumbs (your include expects 'label')
  $crumbTitle = $heading;
  $crumbItems = [
    ['label' => 'Home', 'url' => route('site.home')],
    ['label' => 'About', 'url' => route('site.about')],
  ];
@endphp

@include('site.headers.head', ['title' => $pageTitle])

@include('site.headers.pg-crumb', [
  'title' => $crumbTitle,
  'items' => $crumbItems,
])

<section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default" style="padding: 50px 0;">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="row align-items-center" style="row-gap: 24px;">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="zozo-parallax-header margin-bottom-0">
            <div class="parallax-header content-style-default">
              <h2 class="parallax-title text-left">
                {{ $heading }}
              </h2>

              <div class="parallax-desc default-style text-left Justly" style="margin-top: 14px;">
                {!! $body !!}
              </div>
            </div>
          </div>

          @if(!empty($ctaText) && !empty($ctaUrl))
            <div class="vc_btn3-container vc_btn3-left vc_do_btn" style="margin-top: 18px;">
              <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-default vc_btn3-color-primary-bg"
                 href="{{ $ctaUrl }}">
                {{ $ctaText }}
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

{{-- @include('site.sections.cta') --}}

@include('site.footers.foot')