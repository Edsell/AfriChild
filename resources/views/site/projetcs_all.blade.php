{{-- resources/views/site/projetcs_all.blade.php --}}

@include('site.headers.head', ['title' => 'Projects'])

@include('site.headers.pg-crumb', [
  'title' => 'Projects',
  'items' => [
    ['label' => 'Home', 'url' => url('/')],
  ]
])

@php
  use Illuminate\Support\Str;

  // Expect $projects as paginator/collection from controller
  $projects = $projects ?? collect();

  $projectImg = function ($project) {
      if (!empty($project->cover)) return asset('uploads/' . ltrim($project->cover, '/'));
      return asset('assets/img/placeholder.jpg');
  };

  $projectUrl = fn($project) => route('site.projects.show', ['project' => $project->id, 'slug' => $project->slug]);

  $excerptFor = function ($project) {
      if (!empty($project->excerpt)) return $project->excerpt;
      if (!empty($project->description)) return Str::limit(trim(strip_tags($project->description)), 110);
      return null;
  };
@endphp

<main id="main" class="site-main">
  <section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default ac-projects-all">
    <div class="zozo-vc-main-row-inner vc-normal-section">
      <div class="container">
        <div class="row">
          <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
            <div class="vc_column-inner">
              <div class="wpb_wrapper">

                {{-- Page heading --}}
                <div class="section-title-wrapper text-center mb-4">
                  <h2 class="section-title">Our Projects</h2>
                  <div class="title-separator separator-border-theme margin-top-20"></div>
                  <p class="mt-3 text-muted" style="max-width: 860px; margin: 0 auto;">
                    Explore our current and past work focused on improving child wellbeing across Africa.
                  </p>
                </div>

                {{-- Grid --}}
                <div class="ac-projects-grid ac-projects-grid--page">
                  @forelse($projects as $project)
                    @php
                      $img = $projectImg($project);
                      $link = $projectUrl($project);
                      $excerpt = $excerptFor($project);
                    @endphp

                    <article class="ac-project-card">
                      <a href="{{ $link }}" class="ac-project-media" aria-label="{{ $project->title }}">
                        <img src="{{ $img }}" alt="{{ $project->title }}">
                        <span class="ac-project-shade"></span>

                        <div class="ac-project-overlay">
                          <h4 class="ac-project-title">{{ $project->title }}</h4>

                          <div class="ac-project-meta">
                            @if(!empty($project->client))
                              <span class="ac-meta-pill"><i class="fa fa-briefcase"></i> {{ $project->client }}</span>
                            @endif
                            @if(!empty($project->location))
                              <span class="ac-meta-pill"><i class="fa fa-map-marker"></i> {{ $project->location }}</span>
                            @endif
                          </div>

                          <div class="ac-project-more">
                            @if($excerpt)
                              <p class="ac-project-excerpt">{{ $excerpt }}</p>
                            @endif

                            <div class="ac-project-actions">
                              @if($project->galleryImages?->count())
                                <span class="ac-project-btn">Gallery</span>
                              @endif
                              <span class="ac-project-btn ac-project-btn-primary">Read More</span>
                            </div>
                          </div>
                        </div>
                      </a>
                    </article>
                  @empty
                    <div class="ac-project-empty">
                      <p class="mb-1"><strong>No projects found.</strong></p>
                      <p class="text-muted mb-0">Please add projects from the admin panel.</p>
                    </div>
                  @endforelse
                </div>

                {{-- Pagination --}}
                @if($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                  <div class="ac-pagination-wrap">
                    {{ $projects->links('pagination::bootstrap-4') }}
                  </div>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@include('site.footers.foot')

@push('styles')
<style>
  /* Blog-like page spacing */
  .ac-projects-all { padding: 10px 0 30px; }

  /* Responsive grid */
  .ac-projects-grid--page{
    display:grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
  }
  @media (max-width: 991px){
    .ac-projects-grid--page{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }
  @media (max-width: 575px){
    .ac-projects-grid--page{ grid-template-columns: 1fr; }
  }

  /* Card styling */
  .ac-project-card{
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 26px rgba(0,0,0,.08);
    background: #fff;
  }
  .ac-project-media{ display:block; position:relative; }
  .ac-project-media img{
    width:100%;
    height: 260px;
    object-fit:cover;
    display:block;
  }
  .ac-project-shade{
    position:absolute; inset:0;
    background: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.65) 75%);
  }
  .ac-project-overlay{
    position:absolute; inset:0;
    padding: 16px;
    display:flex; flex-direction:column; justify-content:flex-end;
    color:#fff;
  }
  .ac-project-title{
    font-size: 18px;
    line-height: 1.25;
    margin: 0 0 10px;
    font-weight: 700;
  }
  .ac-project-meta{
    display:flex; flex-wrap:wrap; gap:8px;
    margin-bottom: 10px;
  }
  .ac-meta-pill{
    display:inline-flex; align-items:center; gap:6px;
    padding: 6px 10px;
    border-radius: 999px;
    background: rgba(255,255,255,.16);
    font-size: 12px;
    backdrop-filter: blur(6px);
  }
  .ac-project-excerpt{
    margin: 0 0 12px;
    font-size: 13px;
    line-height: 1.5;
    color: rgba(255,255,255,.9);
  }
  .ac-project-actions{ display:flex; gap:8px; flex-wrap:wrap; }
  .ac-project-btn{
    display:inline-flex;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(255,255,255,.16);
    font-size: 12px;
    font-weight: 600;
  }
  .ac-project-btn-primary{ background: rgba(106, 180, 62, .9); }

  .ac-project-empty{
    grid-column: 1 / -1;
    text-align:center;
    background:#f8f9fa;
    border-radius: 14px;
    padding: 22px;
  }

  .ac-pagination-wrap{
    margin-top: 26px;
    display:flex;
    justify-content:center;
  }
  .pagination { margin: 0; }
</style>
@endpush
