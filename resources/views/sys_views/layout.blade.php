@include('sys_views.head')
<main class="container-xxl flex-grow-1 container-p-y">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</main>
@include('sys_views.footer')
@include('sys_views.scripts')
