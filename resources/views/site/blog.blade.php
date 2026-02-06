@include('site.headers.head', ['title' => 'Blogs'])

{{-- Breadcrumbs (safe include) --}}
@include('site.headers.pg-crumb', [
  'title' => 'Blog Grid',
  'items' => [
    ['label' => 'Blogs', 'url' => url('/blog')],
  ]
])

@php
  use Illuminate\Support\Str;

  $posts = $posts ?? collect();
  $postImg = fn($post) => $post->image ? asset(ltrim($post->image, '/')) : asset('assets/img/placeholder/1200x800.jpg');

  // Optional sidebar data (pass from controller if you have them)
  $categories = $categories ?? collect(); // expects: name, slug, posts_count
  $tags = $tags ?? collect();             // expects: name, slug
  $q = request('q');
@endphp

<style>
  .blog-grid-wrap { padding: 60px 0; }
  .blog-card {
    border: 1px solid rgba(0,0,0,.06);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(0,0,0,.06);
    background: #fff;
    height: 100%;
  }
  .blog-card .thumb {
    position: relative;
    overflow: hidden;
    background: #f6f7f9;
  }
  .blog-card .thumb img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transform: scale(1);
    transition: transform .35s ease;
    display: block;
  }
  .blog-card:hover .thumb img { transform: scale(1.04); }

  .blog-card .date-badge {
    position: absolute;
    left: 18px;
    bottom: 18px;
    background: #fff;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(0,0,0,.12);
  }
  .blog-card .content { padding: 22px 22px 18px; }
  .blog-card .title a {
    color: inherit;
    text-decoration: none;
  }
  .blog-card .title a:hover { text-decoration: underline; }
  .blog-card .meta {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 10px;
  }
  .blog-card .excerpt { color: #5b6470; margin: 0; }

  .sidebar-card {
    border: 1px solid rgba(0,0,0,.06);
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 10px 24px rgba(0,0,0,.06);
    padding: 18px;
    margin-bottom: 18px;
  }
  .sidebar-title {
    font-weight: 800;
    letter-spacing: .02em;
    text-transform: uppercase;
    font-size: 16px;
    margin: 0 0 14px;
  }
  .sidebar-list a {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    padding: 10px 0;
    color: #3f4854;
    text-decoration: none;
    border-bottom: 1px solid rgba(0,0,0,.06);
  }
  .sidebar-list a:hover { text-decoration: underline; }
  .sidebar-list a:last-child { border-bottom: 0; }

  .tag-pill {
    display: inline-block;
    padding: 7px 12px;
    border-radius: 999px;
    background: #eef3f1;
    color: #2f3a45;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    margin: 0 8px 10px 0;
  }
  .tag-pill:hover { text-decoration: underline; }

  /* Make sidebar feel like screenshot spacing */
  @media (min-width: 992px) {
    .sidebar-sticky { position: sticky; top: 110px; }
  }
</style>

<section class="blog-grid-wrap">
  <div class="container">
    <div class="row g-4">
      {{-- MAIN GRID --}}
      <div class="col-lg-8">
        <div class="row g-4">
          @forelse($posts as $post)
            @php
              $img = $postImg($post);
              $date = $post->published_at ? optional($post->published_at)->format('M d, Y') : null;
              $excerpt = $post->excerpt ?: Str::limit(strip_tags((string)($post->content ?? '')), 120);
            @endphp

            <div class="col-md-6">
              <article class="blog-card">
                <a class="thumb d-block" href="{{ route('site.blog.show', $post) }}">
                  <img src="{{ $img }}" alt="{{ $post->title }}">
                  @if($date)
                    <span class="date-badge">{{ $date }}</span>
                  @endif
                </a>

                <div class="content">
                  <h4 class="title mb-2">
                    <a href="{{ route('site.blog.show', $post) }}">
                      {{ Str::limit($post->title, 70) }}
                    </a>
                  </h4>

                  <div class="meta">
                    {{ $post->author_name ?? 'Admin' }}
                    @if($date) <span class="mx-1">•</span> {{ $date }} @endif
                  </div>

                  <p class="excerpt">{{ $excerpt }}</p>
                </div>
              </article>
            </div>
          @empty
            <div class="col-12">
              <div class="alert alert-info mb-0">No posts yet.</div>
            </div>
          @endforelse
        </div>

        {{-- Pagination --}}
        @if(method_exists($posts, 'links'))
          <div class="mt-4">
            {{ $posts->withQueryString()->links() }}
          </div>
        @endif
      </div>

      {{-- SIDEBAR --}}
      <div class="col-lg-4">
        <div class="sidebar-sticky">
          {{-- Search --}}
          <div class="sidebar-card">
            <form method="GET" action="{{ url('/blog') }}" class="d-flex gap-2">
              <input
                type="text"
                name="q"
                value="{{ $q }}"
                class="form-control form-control-lg"
                placeholder="Search.."
                aria-label="Search blog posts"
              >
              <button class="btn btn-secondary btn-lg px-4" type="submit">GO</button>
            </form>
          </div>

          {{-- Categories --}}
          <div class="sidebar-card">
            <h5 class="sidebar-title">Categories</h5>

            <div class="sidebar-list">
              @forelse($categories as $cat)
                <a href="{{ url('/blog?category=' . ($cat->slug ?? $cat->id)) }}">
                  <span>{{ $cat->name }}</span>
                  <span class="text-muted">({{ $cat->posts_count ?? 0 }})</span>
                </a>
              @empty
                <div class="text-muted small">No categories yet.</div>
              @endforelse
            </div>
          </div>

          {{-- Tags --}}
          <div class="sidebar-card">
            <h5 class="sidebar-title">Tags</h5>

            @forelse($tags as $tag)
              <a class="tag-pill" href="{{ url('/blog?tag=' . ($tag->slug ?? $tag->id)) }}">
                {{ $tag->name }}
              </a>
            @empty
              <div class="text-muted small">No tags yet.</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('site.footers.foot')
