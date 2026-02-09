@include('site.headers.head', ['title' => ($item->meta_title ?? $item->title)])

@include('site.headers.pg-crumb', [
  'title' => 'Project Details',
  'items' => [
    ['label' => 'Projects', 'url' => url('/projects')],
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

                  {{-- Cover image --}}
                  <div class="col-lg-5">
                    @php
                      $cover = $item->cover ? asset('uploads/'.$item->cover) : null;
                    @endphp

                    @if($cover)
                      <div class="project-cover mb-3">
                        <img src="{{ $cover }}" alt="{{ $item->title }}" class="img-responsive w-100" style="border-radius:10px;">
                      </div>
                    @endif

                    {{-- Optional quick meta --}}
                    <div class="card" style="border-radius:10px;">
                      <div class="card-body">
                        <ul class="list-unstyled mb-0">
                          @if(!empty($item->client))
                            <li class="mb-2"><strong>Client:</strong> {{ $item->client }}</li>
                          @endif
                          @if(!empty($item->location))
                            <li class="mb-2"><strong>Location:</strong> {{ $item->location }}</li>
                          @endif
                          @if(!empty($item->start_date))
                            <li class="mb-2"><strong>Start:</strong> {{ optional($item->start_date)->format('Y-m-d') }}</li>
                          @endif
                          @if(!empty($item->end_date))
                            <li class="mb-2"><strong>End:</strong> {{ optional($item->end_date)->format('Y-m-d') }}</li>
                          @endif
                          @if(!empty($item->published_at))
                            <li class="mb-0"><strong>Published:</strong> {{ optional($item->published_at)->format('Y-m-d') }}</li>
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>

                  {{-- Content --}}
                  <div class="col-lg-7">
                    <div class="project-content" style="text-align: justify">
                      @if(!empty($item->description))
                        {!! $item->description !!}
                      @else
                        <p class="text-muted">No description has been added for this project yet.</p>
                      @endif
                    </div>

                    {{-- Optional lightbox image --}}
                    @if($item->galleryImages && $item->galleryImages->count())
                    <div class="mt-4">
                        {{-- <h4 class="mb-3">Project Gallery</h4> --}}

                        <div class="row g-3">
                        @foreach($item->galleryImages as $img)
                            <div class="col-6 col-md-3">
                            <a href="{{ asset('uploads/'.$img->image) }}" target="_blank" rel="noopener">
                                <img src="{{ asset('uploads/'.$img->image) }}"
                                    alt="{{ $item->title }}"
                                    class="img-responsive w-100"
                                    style="border-radius:10px; width:100%; height:120px; object-fit:cover;">
                            </a>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endif


                    {{-- <div class="mt-4">
                      <a href="{{ url('/') }}" class="btn btn-default">Back to Home</a>
                      <a href="{{ url('/projects') }}" class="btn btn-outline-secondary" style="margin-left:8px;">
                        View Projects
                      </a>
                    </div> --}}
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

@include('site.footers.foot')
