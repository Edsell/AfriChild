<!doctype html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
<head>
    @include('sys_views.head', ['title' => $title ?? 'Dashboard'])
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        {{-- Sidebar / Menu --}}
        @include('sys_views.sidebar')

        <div class="layout-page">

            {{-- Top Navbar --}}
            @include('sys_views.navbar')

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>

                @include('sys_views.footer')

                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
</div>

@include('sys_views.scripts')
@stack('scripts')
</body>
</html>
