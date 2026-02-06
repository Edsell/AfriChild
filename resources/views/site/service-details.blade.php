@include('site.headers.head', ['title' => ($item->meta_title ?? $item->title)])

{{-- Breadcrumbs (safe include) --}}
@include('site.headers.pg-crumb', [
  'title' => $item->title,
  'items' => [
    ['label' => 'Services', 'url' => url('/services')],
  ]
])


<main id="main" class="site-main">
  <section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default">
    <div class="zozo-vc-main-row-inner vc-normal-section">
      <div class="container">
        <div class="row">

          <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
            <div class="vc_column-inner">
              <div class="wpb_wrapper">

                <div class="section-title-wrapper text-center mb-4">
                  <h2 class="section-title">{{ $item->title }}</h2>
                  @if(!empty($item->excerpt))
                    <h4 class="section-sub-title">{{ $item->excerpt }}</h4>
                  @endif
                </div>

                <div class="row g-4 align-items-start">

                  {{-- Image --}}
                  <div class="col-lg-5">
                    @php
                      $img = $item->image
                        ? asset('uploads/'.$item->image)
                        : null;
                    @endphp

                    @if($img)
                      <div class="service-cover mb-3">
                        <img src="{{ $img }}" alt="{{ $item->title }}" class="img-responsive w-100" style="border-radius:10px;">
                      </div>
                    @endif
                  </div>

                  {{-- Content --}}
                  <div class="col-lg-7">
                    <div class="service-content">
                      @if(!empty($item->description))
                        {!! $item->description !!}
                      @else
                        <p class="text-muted">No description has been added for this service yet.</p>
                      @endif
                    </div>

                   
                  </div>

                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>

{{-- Footer/scripts safe includes --}}
@includeIf('site.footers.foot')
