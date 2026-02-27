<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $generalSettings->CompanyName }} | {{ $title }}</title>

  {{-- Keep your template CSS links exactly, but point to /assets --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="description" content="" />
  <meta name="robots" content="index, follow" />

  <!-- Favicon (copy favicon files into /public/assets/img/favicon/) -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icon.png') }}" />
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon.png') }}" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icon.png') }}" />
  <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon/mstile-270x270.png') }}" />

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/svg.min.css" integrity="sha512-st1GzIoIPUBkxblWvRRTd+MkVD9R7hJpZ8Ea1er9AuDVRtFQjhtDtnGwoFXTQYfS1KoXy2QfQmCQicMxVLwzog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 

  <link href="https://fonts.googleapis.com/css?family=Poppins%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CManjari%3A100%2C400%2C700%7COpen%20Sans%3A300%2C400%2C500%2C600%2C700%2C800%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%7CPoppins%3A700%2C400%2C600%7CRoboto%3A400&#038;display=swap" rel="preload">
  <link href="https://fonts.googleapis.com/css?family=Poppins%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CManjari%3A100%2C400%2C700%7COpen%20Sans%3A300%2C400%2C500%2C600%2C700%2C800%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%7CPoppins%3A700%2C400%2C600%7CRoboto%3A400&#038;display=swap" media="print" onload="this.media=&#039;all&#039;" rel="stylesheet">

 
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

  <link rel="stylesheet" href="{{ asset('assets/css/wc-blocks.css') }}" />

  <link rel="stylesheet" href="{{ asset('assets/css/charitable.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/buttons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/dashicons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/js_composer.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/gosolar-main-min.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/gosolar-theme.css') }}" /> --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/theme_3.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/extendify-utilities.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/shortcodes.css') }}" />

  	<script>
		function setREVStartSize(e) {
			//window.requestAnimationFrame(function() {
			window.RSIW = window.RSIW === undefined ? window.innerWidth : window.RSIW;
			window.RSIH = window.RSIH === undefined ? window.innerHeight : window.RSIH;
			try {
				var pw = document.getElementById(e.c).parentNode.offsetWidth,
					newh;
				pw = pw === 0 || isNaN(pw) || (e.l == "fullwidth" || e.layout == "fullwidth") ? window.RSIW : pw;
				e.tabw = e.tabw === undefined ? 0 : parseInt(e.tabw);
				e.thumbw = e.thumbw === undefined ? 0 : parseInt(e.thumbw);
				e.tabh = e.tabh === undefined ? 0 : parseInt(e.tabh);
				e.thumbh = e.thumbh === undefined ? 0 : parseInt(e.thumbh);
				e.tabhide = e.tabhide === undefined ? 0 : parseInt(e.tabhide);
				e.thumbhide = e.thumbhide === undefined ? 0 : parseInt(e.thumbhide);
				e.mh = e.mh === undefined || e.mh == "" || e.mh === "auto" ? 0 : parseInt(e.mh, 0);
				if (e.layout === "fullscreen" || e.l === "fullscreen")
					newh = Math.max(e.mh, window.RSIH);
				else {
					e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
					for (var i in e.rl)
						if (e.gw[i] === undefined || e.gw[i] === 0) e.gw[i] = e.gw[i - 1];
					e.gh = e.el === undefined || e.el === "" || (Array.isArray(e.el) && e.el.length == 0) ? e.gh : e.el;
					e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
					for (var i in e.rl)
						if (e.gh[i] === undefined || e.gh[i] === 0) e.gh[i] = e.gh[i - 1];

					var nl = new Array(e.rl.length),
						ix = 0,
						sl;
					e.tabw = e.tabhide >= pw ? 0 : e.tabw;
					e.thumbw = e.thumbhide >= pw ? 0 : e.thumbw;
					e.tabh = e.tabhide >= pw ? 0 : e.tabh;
					e.thumbh = e.thumbhide >= pw ? 0 : e.thumbh;
					for (var i in e.rl) nl[i] = e.rl[i] < window.RSIW ? 0 : e.rl[i];
					sl = nl[0];
					for (var i in nl)
						if (sl > nl[i] && nl[i] > 0) {
							sl = nl[i];
							ix = i;
						}
					var m = pw > (e.gw[ix] + e.tabw + e.thumbw) ? 1 : (pw - (e.tabw + e.thumbw)) / (e.gw[ix]);
					newh = (e.gh[ix] * m) + (e.tabh + e.thumbh);
				}
				var el = document.getElementById(e.c);
				if (el !== null && el) el.style.height = newh + "px";
				el = document.getElementById(e.c + "_wrapper");
				if (el !== null && el) {
					el.style.height = newh + "px";
					el.style.display = "block";
				}
			} catch (e) {
				console.log("Failure at Presize of Slider:" + e)
			}
			//});
		};
	</script>
 

</head>


<body class="wp-singular page-template page-template-template-fullwidth page-template-template-fullwidth-php page page-id-226 wp-embed-responsive wp-theme-gosolar theme-gosolar woocommerce-no-js fullwidth hide-title-bar-yes htype-header-11 footer-default theme-skin-light footer-scroll-bar header-is-sticky mhv-tablet-land header-mobile-is-sticky rev-position-header-below trans-h-no-transparent  one-col wpb-js-composer js-comp-ver-8.7.2 vc_responsive">
	@include('site.headers.top')
	@include('site.headers.nav')

  	<div id="section-top" class="zozo-top-anchor"></div>
