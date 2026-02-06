{{-- resources/views/site/contact.blade.php --}}
@include('site.headers.head', ['title' => 'Contact Us'])

@php
  // You can later make these dynamic from DB/settings if needed.
  $pageTitle  = 'Contact Us';
  $crumbTitle = 'Contact Us';
  $crumbItems = [
    ['label' => 'Home', 'url' => route('site.home')],
    ['label' => 'Contact Us'],
  ];

  $mapEmbedUrl = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7979.486386158986!2d32.61087989051498!3d0.35160944857976273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb134b240889%3A0xfcc7d746758c378e!2sThe%20AfriChild%20Centre!5e0!3m2!1sen!2sug!4v1770387813492!5m2!1sen!2sug';
@endphp

@includeWhen(true, 'site.headers.pg-crumb', [
  'title' => $crumbTitle,
  'items' => $crumbItems,
])

<style>
  /* Blog-like spacing + cards (scoped to contact only) */
  .afc-contact { padding: 50px 0; }
  .afc-contact .afc-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    border: 1px solid rgba(0,0,0,.06);
  }
  .afc-contact .afc-card-pad { padding: 22px 22px; }
  .afc-contact .afc-section-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 14px;
  }
  .afc-contact .afc-muted { color: #6b7280; }
  .afc-contact .afc-stack > * + * { margin-top: 14px; }

  /* Map header (full width like the sample) */
  .afc-contact-map {
    width: 100%;
    height: 410px;
    border: 0;
    display: block;
  }

  /* Info item */
  .afc-contact .afc-info {
    display: flex;
    gap: 14px;
    align-items: flex-start;
  }
  .afc-contact .afc-ico {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,.05);
    flex: 0 0 auto;
  }
  .afc-contact .afc-info h4 {
    font-size: 15px;
    margin: 0 0 4px;
    font-weight: 700;
  }
  .afc-contact .afc-info p { margin: 0; }

  /* Form spacing */
  .afc-contact .form-control {
    height: 46px;
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,.12);
    box-shadow: none;
  }
  .afc-contact textarea.form-control { height: auto; min-height: 140px; }
  .afc-contact .btn-afc {
    border-radius: 10px;
    padding: 12px 18px;
    font-weight: 700;
  }

  /* Mobile spacing */
  @media (max-width: 991px) {
    .afc-contact { padding: 35px 0; }
  }
</style>

<section class="afc-contact vc_row wpb_row vc_row-fluid vc-zozo-section typo-default">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="row" style="row-gap: 20px;">

        {{-- LEFT: Contact info --}}
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 vc_col-md-4 vc_col-lg-4">
          <div class="afc-card afc-card-pad afc-stack">

            <div>
              <div class="afc-section-title">Get in touch</div>
              <div class="afc-muted">We’d love to hear from you. Reach us below.</div>
            </div>

            <div class="afc-card afc-card-pad" style="box-shadow:none;">
              <div class="afc-info">
                <div class="afc-ico"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <div>
                  <h4>Find us</h4>
                  <p class="afc-muted">
                    Plot {{ $generalSettings?->Plot }} {{ $generalSettings?->Address }}
                  </p>
                </div>
              </div>
            </div>

            <div class="afc-card afc-card-pad" style="box-shadow:none;">
              <div class="afc-info">
                <div class="afc-ico"><i class="fa fa-phone" aria-hidden="true"></i></div>
                <div>
                  <h4>Call us</h4>
                  <p class="afc-muted">
                    {{ $generalSettings?->Code }} {{ $generalSettings?->Phone }}<br>
                    {{ $generalSettings?->Code }} {{ $generalSettings?->Phone2 }}
                  </p>
                </div>
              </div>
            </div>

            <div class="afc-card afc-card-pad" style="box-shadow:none;">
              <div class="afc-info">
                <div class="afc-ico"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div>
                  <h4>Email us</h4>
                  <p class="afc-muted">
                    <a href="mailto:{{ $generalSettings?->Email }}">{{ $generalSettings?->Email }}</a><br>
                    {{-- <a href="mailto:research@africhild.org">research@africhild.org</a> --}}
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>

        {{-- RIGHT: Contact form --}}
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 vc_col-md-8 vc_col-lg-8">
          <div class="afc-card afc-card-pad">
            <div class="afc-section-title">Send us a message</div>
            <p class="afc-muted" style="margin-bottom: 18px;">
              Share your inquiry and our team will get back to you as soon as possible.
            </p>

            <form action="{{ route('site.contact.submit') }}" method="POST">
              @csrf

              <div class="row">
                <div class="col-md-6" style="margin-bottom: 12px;">
                  <input class="form-control" type="text" name="name" placeholder="Name" required>
                </div>

                <div class="col-md-6" style="margin-bottom: 12px;">
                  <input class="form-control" type="email" name="email" placeholder="Email" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12" style="margin-bottom: 12px;">
                  <input class="form-control" type="text" name="phone" placeholder="Phone">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12" style="margin-bottom: 12px;">
                  <input class="form-control" type="text" name="subject" placeholder="Subject">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12" style="margin-bottom: 14px;">
                  <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                </div>
              </div>

              <button type="submit" class="btn btn-default btn-afc">
                Send Message
              </button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>

{{-- Full-width map section (last) --}}
@if(!empty($mapEmbedUrl))
  <section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default" style="padding:0;margin:0;">
    <div class="zozo-vc-main-row-inner vc-normal-section" style="padding:0;">
      <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner" style="padding:0;">
          <div class="wpb_wrapper">
            <iframe
              class="afc-contact-map"
              src="{{ $mapEmbedUrl }}"
              allowfullscreen
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="AfriChild Location Map"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif

@include('site.footers.foot')
