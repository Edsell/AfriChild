@php
  // $members is grouped by type: [type => collection]
@endphp

@foreach($typeOptions as $typeKey => $typeLabel)
  @php($group = $members->get($typeKey, collect()))

  @if($group->count())
    <section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default" style="padding: 35px 0;">
      <div class="zozo-vc-main-row-inner vc-normal-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12" style="margin-bottom:18px;">
              <h2 style="margin:0 0 6px;">{{ $typeLabel }}</h2>
              <div style="height:3px;width:70px;background:#f89d35;"></div>
            </div>
          </div>

          <div class="row">
            @foreach($group as $person)
              <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom:24px;">
                {{-- Reuse your existing team card markup here --}}
                @include('site.partials.team-card', ['person' => $person])
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  @endif
@endforeach
