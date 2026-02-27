@include('site.headers.head', ['title' => $home->title ?? 'Home'])
@include('site.sections.hero')
<div class="zozo-main-wrapper">
    <div id="main" class="main-section">


        <div id="fullwidth" class="main-fullwidth main-col-full">
            <div class="wpb-content-wrapper">

               @include('site.sections.services')
               @include('site.sections.projects')
               @include('site.sections.mission')
               @include('site.sections.cta')
               {{-- @include('site.sections.team') --}}
               {{-- @include('site.sections.events') --}}
               @include('site.sections.blogs')
               {{-- @include('site.sections.testimonials') --}}
               @include('site.sections.partners')



            </div>
        </div><!-- #fullwidth -->
    </div><!-- #main -->

  </div>


    @include('site.footers.foot')