<section class="vc_row wpb_row vc_row-fluid vc_custom_1627397865358 vc_row-has-fill vc-zozo-section typo-light bg-overlay-primary ac-projects-section">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="row">
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
          <div class="vc_column-inner">
            <div class="wpb_wrapper">

              <div class="zozo-parallax-header title-white-bottom">
                <div class="parallax-header content-style-default">
                  <h2 class="parallax-title">{{ $home->projects_title ?? 'Our Current Projects' }}</h2>
                </div>
              </div>

              <div class="ac-projects-grid">
                @forelse($projects as $project)
                  @php
                    $img = $project->cover
                      ? asset('uploads/'.$project->cover)
                      : asset('assets/img/placeholder.jpg');

                    $link = route('site.projects.show', ['project' => $project->id, 'slug' => $project->slug]);

                    $excerpt = $project->excerpt
                      ?: \Illuminate\Support\Str::limit(strip_tags($project->description), 70);
                  @endphp

                  <article class="ac-project-card">
                    <a href="{{ $link }}" class="ac-project-media" aria-label="{{ $project->title }}">
                      <img src="{{ $img }}" alt="{{ $project->title }}">
                      <span class="ac-project-shade"></span>

                      <div class="ac-project-overlay">
                      <h4 class="ac-project-title">{{ $project->title }}</h4>

                      <div class="ac-project-more">
                        @if($excerpt)
                          <p class="ac-project-excerpt">{{ $excerpt }}</p>
                        @endif

                        <div class="ac-project-actions">
                          @if($project->galleryImages?->count())
                            <span class="ac-project-btn">Gallery</span>
                          @endif
                          <span class="ac-project-btn ac-project-btn-primary">Details</span>
                        </div>
                      </div>
                    </div>
                    </a>
                  </article>
                @empty
                  <div class="ac-project-empty">
                    <p>No projects yet. Please add projects from the admin panel.</p>
                  </div>
                @endforelse
              </div>

              @if(!empty($home->projects_button_url))
                <div class="vc_btn3-container vc_btn3-center vc_do_btn mt-4">
                  <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-default vc_btn3-color-primary-bg"
                     href="{{ $home->projects_button_url }}">
                    {{ $home->projects_button_text ?? 'View All Projects' }}
                  </a>
                </div>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
