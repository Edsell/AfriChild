<!DOCTYPE html>
<html lang="en">
<head>
  @include('sys_views.head')
</head>
<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    @include('sys_views.sidebar')

    <div class="layout-page">
      @include('sys_views.navbar')

      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
              </ul>
            </div>
          @endif

          @yield('content')
        </div>

        @include('sys_views.footer')
        <div class="content-backdrop fade"></div>
      </div>
    </div>

  </div>
</div>

@include('sys_views.scripts')
</body>
</html>
