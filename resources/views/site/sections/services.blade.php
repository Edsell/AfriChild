<section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="row">
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
          <div class="vc_column-inner">
            <div class="wpb_wrapper">

              <div class="zozo-parallax-header">
                <div class="parallax-header content-style-default">
                  <h2 class="parallax-title">{{ $home->services_title ?? 'Services' }}</h2>
                </div>
              </div>

              <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1499661319201">
                <div class="zozo-vc-row-inner vc-inner-row-section clearfix">

                  @foreach($services as $i => $service)
                    <div class="wpb_column vc_column_inner vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3 typo-default">
                      <div class="vc_column-inner">
                        <div class="wpb_wrapper">

                          <div class="zozo-feature-box feature-box-style style-default-box style-sep-yes clearfix" id="feature-box-{{ $i+1 }}">
                            <div class="grid-item">
                              <div class="grid-box-inner grid-text-center grid-box-medium grid-box-icon-circle grid-icon-shape grid-shape-none">

                                <div class="grid-icon-wrapper icon-hv-bg-icon shape-icon-circle">
                                  <i class="{{ $service->icon_class ?? 'fa fa-leaf' }} grid-icon zozo-icon icon-shape icon-circle icon-skin-default icon-bordered pattern-1 icon-medium"></i>
                                </div>

                                <a href="{{ route('site.services.show', ['service' => $service->id, 'slug' => $service->slug]) }}">
                                  <h4 class="grid-title-below grid-title">{{ $service->title }}</h4>
                                </a>

                                <div class="grid-desc">
                                  <p>{{ $service->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($service->description), 120) }}</p>
                                </div>

                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  @endforeach

                </div>
              </div>

              @if(!empty($home->services_button_url))
                <div class="vc_btn3-container vc_btn3-center vc_do_btn">
                  <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-default vc_btn3-color-primary-bg"
                     href="{{ $home->services_button_url }}">
                    {{ $home->services_button_text ?? 'View All Services' }}
                  </a>
                </div>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
