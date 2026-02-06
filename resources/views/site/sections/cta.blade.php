@php
  $bg = $cta?->background_image ? asset($cta->background_image) : null;
  $speed = $cta?->parallax_speed ?? 1.5;
  $items = ($cta?->items ?? collect())->where('is_active', true)->sortBy('sort_order');
@endphp

@if($cta?->is_active)
<section
  class="vc_row wpb_row vc_row-fluid vc_row-has-fill vc_general Afri_parallax vc-zozo-section typo-light bg-overlay-dark"
  data-vc-parallax="{{ $speed }}"
  @if($bg) data-vc-parallax-image="{{ $bg }}" @endif

  {{-- Fallback for non-WPBakery setups (ensures background always displays) --}}
  @if($bg)
    style="
      background-image: url('{{ $bg }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
    "
  @else
    style="position: relative;"
  @endif
>

  {{-- Some themes expect this inner div; harmless if JS isn't present --}}
  @if($bg)
    <div class="vc_parallax-inner"
      style="
        background-image: url('{{ $bg }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position:absolute; top:0; left:0; right:0; bottom:0;
        z-index:0;
        transform: translateZ(0);
      ">
    </div>
  @endif

  {{-- Ensure content sits above background --}}
  <div class="zozo-vc-main-row-inner vc-normal-section" style="position:relative; z-index:2;">
    <div class="container">
      <div class="row">
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
          <div class="vc_column-inner">
            <div class="wpb_wrapper">

              <div class="vc_row wpb_row vc_inner vc_row-fluid">
                <div class="zozo-vc-row-inner vc-inner-row-section clearfix">
                  <div class="wpb_column vc_column_inner vc_column_container vc_col-sm-12 typo-default">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">

                        <div class="zozo-circle-counter-wrapper clearfix">
                          <div class="zozo-circle-counter columns-{{ max(1, min(6, $items->count())) }} clearfix"
                               data-circle="180" data-linewidth="6">

                            @foreach($items as $item)
                              <div class="circle-counter-item">
                                <div class="zozo-piechart"
                                  data-barcolor="#DB1E82"
                                  data-trackcolor="#ffffff"
                                  data-percent="{{ (int)$item->percent }}">
                                  <span style="line-height:180px;"></span>
                                </div>
                                <div class="zozo-piechart-content">
                                  <h4 class="circle-counter-title" style="color:#ffffff;">
                                    {{ $item->title }}
                                  </h4>
                                </div>
                              </div>
                            @endforeach

                          </div>
                        </div>

                      </div>
                    </div>
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
@endif


