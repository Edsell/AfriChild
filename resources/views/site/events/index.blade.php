@include('site.headers.head', ['title' => 'Events'])

{{-- Breadcrumbs (safe include) --}}
@include('site.headers.pg-crumb', [
  'title' => 'Events',
  'items' => [
    ['label' => 'Events', 'url' => route('site.events.index')],
  ]
])

<section class="section section-lg af-page-gap">
  <div class="container">
    <div class="row af-row-gap">

      @forelse($events as $event)
        <div class="col-md-6">
          <div class="af-card af-card-pad af-event-card">

            <div class="af-event-thumb mb-3">
              <a href="{{ route('site.events.show', $event->slug) }}" title="{{ $event->title }}">
                <img class="img-responsive af-radius" src="{{ $event->image_url }}" alt="{{ $event->title }}" style="width: 100%;height:300px;object-fit:cover">
              </a>
            </div>

            <div class="af-meta mb-2">
              <span><i class="fa fa-calendar"></i> {{ $event->event_date_pretty }}</span>
              @if($event->event_time_pretty)
                <span class="af-dot">•</span>
                <span><i class="fa fa-clock-o"></i> {{ $event->event_time_pretty }}</span>
              @endif
            </div>

            <h4 class="af-title mb-2">
              <a href="{{ route('site.events.show', $event->slug) }}">
                {{ $event->title }}
              </a>
            </h4>

            <p class="af-excerpt mb-3">
              {{ $event->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($event->description), 170) }}
            </p>

            <div class="d-flex align-items-center justify-content-between">
              {{-- <a class="btn btn-default" href="{{ route('site.events.show', $event->slug) }}">Read More</a> --}}

              @if($event->venue || $event->location)
                <small class="text-muted">
                  <i class="fa fa-map-marker"></i>
                  {{ $event->venue ?? $event->location }}
                </small>
              @endif
            </div>

          </div>
        </div>
      @empty
        <div class="col-md-12">
          <div class="af-card af-card-pad">
            <div class="alert alert-info mb-0">No events found.</div>
          </div>
        </div>
      @endforelse

      <div class="col-md-12">
        <div class="af-pagination-wrap">
          {{ $events->links() }}
        </div>
      </div>

    </div>
  </div>
</section>

@include('site.footers.foot')
