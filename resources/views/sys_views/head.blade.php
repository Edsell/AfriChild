@php
  $title = $title ?? 'Dashboard';
@endphp

<meta charset="utf-8" />
<meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
/>

<title>{{ $generalSettings->CompanyName }} | {{ $title }}</title>
<meta name="description" content="" />

{{-- CSRF (useful for ajax/forms) --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('assets/icon.png') }}" />

{{-- Fonts (optional: can be localized later) --}}
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
/>

<link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/fonts/iconify-icons.css') }}" />

{{-- Core CSS --}}
<link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('bootstrap/assets/css/demo.css') }}" />

{{-- Vendors CSS --}}
<link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

{{-- (Optional) Apex charts css - remove if unused --}}
<link rel="stylesheet" href="{{ asset('bootstrap/assets/vend_or/libs/apex-charts/apex-charts.css') }}" />

{{-- Helpers --}}
<script src="{{ asset('bootstrap/assets/vend_or/js/helpers.js') }}"></script>
<script src="{{ asset('bootstrap/assets/js/config.js') }}"></script>

@stack('styles')
