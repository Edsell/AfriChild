@php
  $missionTitle = $mission?->title ?: 'Our Mission';
  $items = $mission?->items?->where('is_active', true) ?? collect();
  $leftItems  = $items->where('column','left')->sortBy('sort_order');
  $rightItems = $items->where('column','right')->sortBy('sort_order');
  $centerImg = $mission?->center_image ? asset($mission->center_image) : null;
@endphp

@if($mission?->is_active)
<section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="row">
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
          <div class="vc_column-inner">
            <div class="wpb_wrapper">

              <div class="zozo-parallax-header spacing-margin-1025">
                <div class="parallax-header content-style-default">
                  <h2 class="parallax-title">{{ $missionTitle }}</h2>
                </div>
              </div>

              <div class="vc_row wpb_row vc_inner vc_row-fluid">
                <div class="zozo-vc-row-inner vc-inner-row-section clearfix">

                  <div class="wpb_column vc_column_inner vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-12 typo-default">
                    <div class="vc_column-inner"><div class="wpb_wrapper">
                      @foreach($leftItems as $item)
                        <div class="zozo-feature-box feature-box-style style-default-box style-sep-yes clearfix mb-3">
                          <div class="grid-item">
                            <div class="grid-box-inner grid-text-right grid-box-medium grid-box-icon-circle grid-icon-shape grid-shape-none">
                              <div class="grid-icon-wrapper icon-hv-bg-icon shape-icon-circle">
                                <i class="{{ $item->icon ?? 'fa fa-star' }} grid-icon zozo-icon icon-shape icon-circle icon-skin-default icon-bordered pattern-1 icon-medium"></i>
                              </div>
                              <div class="grid-content-wrapper">
                                <h4 class="grid-title">{{ $item->title }}</h4>
                                @if($item->description)<div class="grid-desc"><p>{{ $item->description }}</p></div>@endif
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div></div>
                  </div>

                  <div class="wpb_column vc_column_inner vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-12 typo-default">
                    <div class="vc_column-inner"><div class="wpb_wrapper">
                      @if($centerImg)
                        <div class="wpb_single_image wpb_content_element vc_align_center">
                          <figure class="wpb_wrapper vc_figure">
                            <div class="vc_single_image-wrapper vc_box_border_grey">
                              <img loading="lazy" decoding="async" src="{{ $centerImg }}" class="vc_single_image-img" alt="">
                            </div>
                          </figure>
                        </div>
                      @endif
                    </div></div>
                  </div>

                  <div class="wpb_column vc_column_inner vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-12 typo-default">
                    <div class="vc_column-inner"><div class="wpb_wrapper">
                      @foreach($rightItems as $item)
                        <div class="zozo-feature-box feature-box-style style-default-box style-sep-yes clearfix mb-3">
                          <div class="grid-item">
                            <div class="grid-box-inner grid-text-left grid-box-medium grid-box-icon-circle grid-icon-shape grid-shape-none">
                              <div class="grid-icon-wrapper icon-hv-bg-icon shape-icon-circle">
                                <i class="{{ $item->icon ?? 'fa fa-leaf' }} grid-icon zozo-icon icon-shape icon-circle icon-skin-default icon-bordered pattern-1 icon-medium"></i>
                              </div>
                              <div class="grid-content-wrapper">
                                <h4 class="grid-title">{{ $item->title }}</h4>
                                @if($item->description)<div class="grid-desc"><p>{{ $item->description }}</p></div>@endif
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div></div>
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
