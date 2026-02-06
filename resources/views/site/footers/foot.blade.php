<style>
  /* Footer icon fallback (keeps spacing the same) */
  #footer .features-list-inner{ position:relative; }
  #footer .features-list-inner .afc-fi{
    position:absolute; left:0; top:2px;
    width:24px; text-align:center;
    font-size:18px; line-height:1;
  }
</style>

<div data-wpr-lazyrender="1" id="footer" class="footer-section footer-style-default footer-skin-dark">

  <div id="footer-widgets-container" class="footer-widgets-section">
    <div class="container">
      <div class="zozo-row row">

        {{-- COLUMN 1: ABOUT + CONTACT --}}
        <div id="footer-widgets-1" class="footer-widgets col-md-3 col-sm-6 col-xs-12">
          <div id="text-2" class="widget widget_text">
            <div class="textwidget">

              <p>
                <a href="{{ route('site.home') }}">
                  <img loading="lazy" decoding="async" class="margin-bottom-20"
                       src="{{ asset('assets/logo.png') }}"
                       alt="AfriChild Centre" style="border-radius: 8px"
                       width="195" height="50" />
                </a>
              </p>

              <p>
                The AfriChild Centre is a multi-disciplinary research institution dedicated to improving
                the lives of children across Africa through evidence generation, learning, and policy engagement.
              </p>

              <div class="features-list-inner list-text-default" style="margin-bottom: 13px;">
                <i class="fa fa-map-marker afc-fi" aria-hidden="true"></i>
                <div class="list-desc" style="margin-left: 35px;">
                  <p>{{ $generalSettings?->Address }}</p>
                </div>
              </div>

              <div class="features-list-inner list-text-default" style="margin-bottom: 13px;">
                <i class="fa fa-envelope afc-fi" aria-hidden="true"></i>
                <div class="list-desc" style="margin-left: 35px;">
                  <p>Email: <a href="mailto:{{ $generalSettings?->Email }}">{{ $generalSettings?->Email }}</a></p>
                </div>
              </div>

             <div class="features-list-inner list-text-default" style="margin-bottom: 13px;">
              <i class="fa fa-phone afc-fi" aria-hidden="true"></i>
              <div class="list-desc" style="margin-left: 35px;">
                <p>Phone: {{ $generalSettings?->Code }} {{ $generalSettings?->Phone }}</p>
              </div>
            </div>

            </div>
          </div>
        </div>

        {{-- COLUMN 2: LATEST NEWS --}}
        <div id="footer-widgets-2" class="footer-widgets col-md-3 col-sm-6 col-xs-12">
          <div id="recent-posts-3" class="widget widget_recent_entries">
            <h3 class="widget-title">Latest News</h3>

            <ul>
              {{-- If you already pass $latestPosts to footer, use it.
                   Otherwise, keep these links static. --}}
              @php
                $footerPosts = collect($latestPosts ?? [])->take(6);
              @endphp

              @if($footerPosts->count())
                @foreach($footerPosts as $p)
                  <li>
                    <a href="{{ route('site.blog.show', $p) }}">{{ $p->title }}</a>
                  </li>
                @endforeach
              @else
                <li><a href="{{ route('site.blog') }}">Research & Publications</a></li>
                <li><a href="{{ route('site.blog') }}">Policy Engagement</a></li>
                <li><a href="{{ route('site.blog') }}">Programme Learning</a></li>
                <li><a href="{{ route('site.blog') }}">Partnerships & Collaborations</a></li>
                <li><a href="{{ route('site.blog') }}">Announcements</a></li>
                <li><a href="{{ route('site.blog') }}">Events & Updates</a></li>
              @endif
            </ul>

          </div>
        </div>

        {{-- COLUMN 3: QUICK LINKS --}}
        <div id="footer-widgets-3" class="footer-widgets col-md-3 col-sm-6 col-xs-12">
          <div id="nav_menu-2" class="widget widget_nav_menu">
            <h3 class="widget-title">Quick Links</h3>

            <div class="menu-footer-menu-container">
              <ul id="menu-footer-menu" class="menu">
                <li class="menu-item"><a href="{{-- {{ route('site.about') }} --}}">About Us</a></li>
                <li class="menu-item"><a href="{{ route('site.blog') }}">Blog</a></li>
                <li class="menu-item"><a href="{{ route('site.events.index') }}">Events</a></li>
                <li class="menu-item"><a href="{{ route('site.gallery.index') }}">Gallery</a></li>
                <li class="menu-item"><a href="{{-- {{ route('site.contact') }} --}}">Contact</a></li>
                <li class="menu-item"><a href="{{ route('login') }}">Staff Login</a></li>
              </ul>
            </div>

          </div>
        </div>

        {{-- COLUMN 4: SUBSCRIBE + HOURS --}}
        <div id="footer-widgets-4" class="footer-widgets col-md-3 col-sm-6 col-xs-12">

          <div id="zozo_mailchimp_form_widget-widget-2" class="widget zozo_mailchimp_form_widget">
            <h3 class="widget-title">Subscribe</h3>
            <p class="subscribe-desc">Get research updates, publications, and announcements.</p>

            <div id="mc-subscribe-widget1" class="zozo-mc-form subscribe-form mailchimp-form-wrapper">
              <p class="mailchimp-msg zozo-form-success"></p>

              {{-- This keeps your layout. You can later wire to a real endpoint. --}}
              <form action="{{-- {{ route('site.contact') }} --}}" method="get" id="zozo-mailchimp-form-widget1"
                    name="zozo-mailchimp-form-widget1" class="zozo-mailchimp-form">

                <div class="mailchimp-email zozo-form-group-addon">
                  <div class="input-group form-group">
                    <input type="email" placeholder="you@example.com"
                           class="zozo-subscribe input-email form-control"
                           name="email" id="subscribe_email">

                    <div class="input-group-btn">
                      <button type="submit" id="zozo_mc_form_widget_submit"
                              class="btn mc-subscribe zozo-submit">
                      <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>

              </form>
            </div>
          </div>

          <div id="text-3" class="widget widget_text">
            <h3 class="widget-title">Working Hours</h3>
            <div class="textwidget">
              <p>
                <strong>Monday – Friday:</strong> 8:00am – 5:00pm<br />
                <strong>Saturday – Sunday:</strong> Closed
              </p>
            </div>
          </div>

        </div>

      </div><!-- .row -->
    </div>
  </div><!-- #footer-widgets-container -->


  <div id="footer-copyright-container" class="footer-copyright-section">
    <div class="container">
      <div class="zozo-row row">

        <div class="col col-sm-6 col-md-6 col-xs-12">
          <div id="copyright-text" class="footer-copyright-left">
            <p>&copy; {{ date('Y') }} AfriChild Centre. All rights reserved.</p>
          </div>
        </div>

        <div class="col col-sm-6 col-md-6 col-xs-12">
          <div id="footer-widgets-footer-social-sidebar" class="footer-widgets footer-social-sidebar">
            <div id="zozo_social_link_widget-widget-2" class="widget zozo_social_link_widget">
              <ul class="zozo-social-icons soc-icon-transparent soc-icon-size-normal text-center">

                {{-- Replace # with real links when ready --}}
                <li class="facebook">
                  <a target="_blank" rel="noopener" href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>

                <li class="twitter">
                  <a target="_blank" rel="noopener" href="#">
                    <i class="fa-brands fa-x-twitter"></i>
                  </a>
                </li>

                <li class="linkedin">
                  <a target="_blank" rel="noopener" href="#">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </li>

                <li class="instagram">
                  <a target="_blank" rel="noopener" href="#">
                    <i class="fa fa-instagram"></i>
                  </a>
                </li>

                <li class="youtube">
                  <a target="_blank" rel="noopener" href="#">
                    <i class="fa fa-youtube-play"></i>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div><!-- #footer-copyright-container -->

</div><!-- #footer -->


			</div><!-- .zozo-main-wrapper -->
			</div><!-- #zozo_wrapper -->
		
		@include('site.footers.scripts')
		@include('site.footers.extra_scripts')
