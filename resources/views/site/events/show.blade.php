@include('site.headers.head', ['title' => $event->title])

{{-- Breadcrumbs (safe include) --}}
@include('site.headers.pg-crumb', [
  'title' => $event->title,
  'items' => [
    ['label' => 'Events', 'url' => route('site.events.index')],
  ]
])

<section class="section section-lg af-page-gap">
  <div class="container">
    <div class="row af-row-gap">

      {{-- LEFT: Main content --}}
      <div class="col-md-8">
        <div class="af-card af-card-pad">

          @if($event->image_url)
            <div class="af-media mb-4">
              <img class="img-responsive af-radius" src="{{ $event->image_url }}" alt="{{ $event->title }}">
            </div>
          @endif

          @if($event->excerpt)
            <h5 class="af-lead">{{ $event->excerpt }}</h5>
            <hr class="af-divider">
          @endif

          <article class="af-content Justly">
            {!! $event->description !!}
          </article>

          
        </div>
      </div>

      {{-- RIGHT: Event Details --}}
      <div class="col-md-4">
        <div class="af-card af-card-pad af-sticky">
          <h4 class="af-side-title">Event Details</h4>
          <div class="af-side-list">

            <div class="af-side-item">
              <div class="af-ico"><i class="fa fa-calendar"></i></div>
              <div>
                <div class="af-side-label">Date</div>
                <div class="af-side-value">{{ $event->event_date_pretty }}</div>
              </div>
            </div>

            @if($event->event_time_pretty)
              <div class="af-side-item">
                <div class="af-ico"><i class="fa fa-clock-o"></i></div>
                <div>
                  <div class="af-side-label">Time</div>
                  <div class="af-side-value">{{ $event->event_time_pretty }}</div>
                </div>
              </div>
            @endif

            @if($event->venue)
              <div class="af-side-item">
                <div class="af-ico"><i class="fa fa-map-marker"></i></div>
                <div>
                  <div class="af-side-label">Venue</div>
                  <div class="af-side-value">{{ $event->venue }}</div>
                </div>
              </div>
            @endif

            @if($event->location)
              <div class="af-side-item">
                <div class="af-ico"><i class="fa fa-location-arrow"></i></div>
                <div>
                  <div class="af-side-label">Location</div>
                  <div class="af-side-value">{{ $event->location }}</div>
                </div>
              </div>
            @endif

            {{-- Optional: if later you add a phone/contact field in DB --}}
            @if(!empty($event->contact_phone))
              <div class="af-side-item">
                <div class="af-ico"><i class="fa fa-phone"></i></div>
                <div>
                  <div class="af-side-label">Phone</div>
                  <div class="af-side-value">{{ $event->contact_phone }}</div>
                </div>
              </div>
            @endif

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@include('site.footers.foot')
