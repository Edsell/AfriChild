{{-- Core JS --}}
<script src="{{ asset('bootstrap/assets/vend_or/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('bootstrap/assets/vend_or/libs/popper/popper.js') }}"></script>
<script src="{{ asset('bootstrap/assets/vend_or/js/bootstrap.js') }}"></script>

<script src="{{ asset('bootstrap/assets/vend_or/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('bootstrap/assets/vend_or/js/menu.js') }}"></script>

{{-- Vendors JS (optional) --}}
<script src="{{ asset('bootstrap/assets/vend_or/libs/apex-charts/apexcharts.js') }}"></script>

{{-- Main JS --}}
<script src="{{ asset('bootstrap/assets/js/main.js') }}"></script>

{{-- Page JS (optional; remove if unused) --}}
<script src="{{ asset('bootstrap/assets/js/dashboards-analytics.js') }}"></script>

@stack('scripts')
