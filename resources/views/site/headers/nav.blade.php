<div id="mobile-search-wrapper" class="mobile-search-wrapper mobile-overlay-search">
    <a href="#" target="_self" class="mobile-search-close"><i class="flaticon flaticon-shapes"></i></a>
    <div class="mobile-search-inner">
        <form method="get" action="https://AfriChild.co.ug/" class="search-form"><input type="text" value="" name="s"
                class="form-control" placeholder="Enter text to search" /><button class="btn btn-search"
                type="submit"><i class="simple-icon icon-magnifier"></i></button></form>
    </div>
</div>
<div id="zozo_wrapper" class="wrapper-class zozo-main-wrapper">
    <div data-wpr-lazyrender="1" id="mobile-header"
        class="mobile-header-section header-skin-light header-mobile-left-logo">
        <div id="header-mobile-main" class="header-mobile-main-section navbar">
            <div class="container">
                <div id="zozo-mobile-logo"
                    class="navbar-header nav-respons zozo-mobile-logo logo-left zozo-no-sticky-logo has-img">
                    <a href="/" class="navbar-brand" title="AfriChild - Eco &amp; Nature / Environment WordPress Theme"
                        rel="home">
                        <img class="img-responsive zozo-mobile-standard-logo" src="{{ asset('assets/logo.png') }}"
                            alt="AfriChild" style="width:70%" />
                    </a>
                </div>
                <div class="mobile-header-items-wrap">
                    <div class="mobile-menu-item"><a href="#main-nav-container"
                            class="mobile-menu-nav menu-bars-link"><span class="menu-bars"></span></a></div>
                    <div class="mobile-search-item"><a href="#" class="mobile-menu-search"><i
                                class="simple-icon icon-magnifier"></i></a></div>
                </div>
            </div>
        </div>
    </div><!-- #mobile-header -->
    <div id="header"
        class="header-section type-header-11 header-fullwidth-menu header-menu-skin-default header-layout-fullwidth header-skin-light header-no-transparent header-dropdown-skin-light">
        <div id="header-logo-bar" class="header-logo-section navbar">
            <div class="container">
                <div id="zozo-logo" class="navbar-header nav-respons zozo-logo logo-left zozo-has-sticky-logo has-img">
                    <a href="/" class="navbar-brand" title="AfriChild" rel="home">
                        <img class="img-responsive zozo-standard-logo" src="{{ asset('assets/logo.png') }}"
                            alt="AfriChild" style="width:70%" />
                        <img class="img-responsive zozo-retina-logo" src="{{ asset('assets/logo.png') }}"
                            alt="AfriChild" style="width:70%" />
                        <img class="img-responsive zozo-sticky-logo" src="{{ asset('assets/sticky-logo.png') }}"
                            alt="AfriChild" style="width:70%" />
                        <div class="zozo-text-logo"></div>
                    </a>
                </div>
                <div class="zozo-header-logo-bar">
                    <ul class="nav navbar-nav navbar-right zozo-logo-bar">
                        <li>
                            <div class="logo-bar-item item-address-info">
                                <div class="header-details-box">
                                    <div class="header-details-icon header-address-icon">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </div>
                                    <div class="header-details-info header-address">
                                        <strong>{{ $generalSettings?->CompanyName }}</strong>
                                        <span>{{ $generalSettings?->Address }}</span>
                                    </div>
                                </div>

                                <div class="header-details-box">
                                    <div class="header-details-icon header-business-icon">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="header-details-info header-business-hours">
                                        <strong>Monday-Friday: 9am to 5pm </strong>
                                        <span>Saturday / Sunday: Closed</span>
                                    </div>
                                </div>

                                <div class="header-details-box">
                                    <div class="header-details-icon header-contact-icon">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                    <div class="header-details-info header-contact-details">
                                        <strong>{{ $generalSettings?->Code }} {{ $generalSettings?->Phone }}</strong>
                                        <span>
                                            <a href="mailto:{{ $generalSettings?->Email }}">
                                                <span class="__cf_email__"
                                                    data-cfemail="{{ $generalSettings?->Email }}">{{ $generalSettings?->Email }}</span>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div><!-- .container -->
        </div><!-- .header-logo-section -->
        <div data-wpr-lazyrender="1" id="header-main" class="header-main-section navbar">
            <div class="container">
                <div class="zozo-header-main-bar">
                    <ul class="nav navbar-nav navbar-left zozo-main-bar">
                        <li>
                            <div class="main-bar-item item-main-menu">
                                <div class="main-navigation-wrapper">
                                    <div id="main-nav-container" class="main-nav main-menu-container">
                                        <ul id="main-menu" class="nav navbar-nav navbar-main zozo-main-nav">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-892 dropdown">
                                                <a title="Home" class="" href="/" aria-haspopup="true">Home <span
                                                        class="caret"></span></a>

                                            </li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-900 dropdown">
                                                <a title="About" class="" href="{{ route('site.about') }}"
                                                    aria-haspopup="true">About <span class="caret"></span></a>

                                            </li>

                                            {{-- <li
													class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-900 dropdown">
													<a title="Services" class=""
														href="#" aria-haspopup="true">Services
														<span class="caret"></span></a>
													
												</li> --}}
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-900 dropdown">
                                                <a title="Projects" class="" href="{{ route('site.projects.all') }}"
                                                    aria-haspopup="true">Projects
                                                    <span class="caret"></span></a>

                                            </li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-900 dropdown">
                                                <a title="Events" class="" href="{{ route('site.events.index') }}"
                                                    aria-haspopup="true">Events
                                                    <span class="caret"></span></a>

                                            </li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-911 dropdown">
                                                <a title="Gallery" class="" href="{{ route('site.gallery.index')}}"
                                                    aria-haspopup="true">Gallery <span class="caret"></span></a>

                                            </li>
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-929 dropdown">
                                                <a title="Blog" class="" href="/blog" aria-haspopup="true">Blog <span
                                                        class="caret"></span></a>

                                            </li>

                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-936 dropdown">
                                                <a title="Contact" class="" href="{{ route('site.contact')}}"
                                                    aria-haspopup="true">Contact
                                                    <span class="caret"></span></a>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right zozo-main-bar">
                        <li>

                            <div class="main-bar-item item-cart zozo-woo-cart-info">
                                <div class="">
                                    <a class="btn btn-default ac-hero-btn" href="https://hub.africhild.cloud/">
                                        Knowledge Hub
                                    </a>
                                </div>
                            </div>

                        </li>
                    </ul>

                </div>
            </div><!-- .container -->
        </div><!-- .header-main-section -->
    </div><!-- #header -->