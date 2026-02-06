<!doctype html>
<html lang="en">
  {{-- Provide a default title if none passed --}}
  @include('site.headers.head', ['title' => $title ?? ($pageTitle ?? 'AfriChild')])
 

  {{-- Dynamic breadcrumb include (your style) --}}
  @includeWhen(
    isset($crumbTitle) || isset($crumbItems) || isset($pageTitle),
    'site.headers.pg-crumb',
    [
      'title' => $crumbTitle ?? ($pageTitle ?? ''),
      'items' => $crumbItems ?? []
    ]
  )

  <main id="main-content">
    @yield('content')
  </main>

  @include('site.footers.foot')
 