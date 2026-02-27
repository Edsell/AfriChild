@php
  use App\Models\Event;

  // Pick the next 4 published events (or you can change logic to featured first)
  $events = Event::published()
      ->orderBy('event_date')
      ->orderBy('sort_order')
      ->limit(4)
      ->get();
@endphp

@if($events->count())
<section class="vc_row wpb_row vc_row-fluid vc_custom_1499673787702 vc-zozo-section typo-default mt-5">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
      <div class="vc_column-inner ">
        <div class="wpb_wrapper">
          <div class="zozo-event-grid-wrapper event-columns-2">
            <div class="row event-grid-inner">

              {{-- Render in pairs to keep the “classic-view” row structure --}}
              @foreach($events->chunk(2) as $rowIndex => $pair)
                <div class="row classic-view">
                  @foreach($pair as $i => $event)
                    @php
                      // second row uses push/pull styling in your template
                      $isSecondRow = ($rowIndex % 2) === 1;
                      $imgColClass = $isSecondRow ? 'col-md-3 col-md-push-3' : 'col-md-3';
                      $txtColClass = $isSecondRow ? 'col-md-3 col-md-pull-3' : 'col-md-3';
                    @endphp

                    <div class="{{ $imgColClass }}">
                      <div class="event-item-img">
                        <a href="{{ route('site.events.show', $event->slug) }}" class="event-img-link" title="{{ $event->title }}">
                          <img loading="lazy" decoding="async" class="img-responsive"
                               src="{{ $event->image_url }}" {{-- width="500" height="500"  --}} style="width: 100%;height:200px;object-fit:cover" alt="{{ $event->title }}" />
                        </a>
                      </div>
                    </div>

                    <div class="{{ $txtColClass }}">
                      <div class="event-content-wrapper">
                        <h5 class="grid-event-date">
                          <span class="event-date">
                            <i class="fa fa-calendar"></i> {{ $event->event_date_pretty }}
                          </span>
                          @if($event->event_time_pretty)
                          <span class="event-time">
                            <i class="fa fa-clock-o"></i> {{ $event->event_time_pretty }}
                          </span>
                          @endif
                        </h5>

                        <h4 class="grid-event-title">
                          <a href="{{ route('site.events.show', $event->slug) }}" title="{{ $event->title }}">
                            {{ $event->title }}
                          </a>
                        </h4>

                        <div class="grid-event-excerpts">
                          <p>{{ $event->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($event->description), 160) }}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
