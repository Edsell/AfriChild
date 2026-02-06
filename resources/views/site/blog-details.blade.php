@php
  use Illuminate\Support\Str;

  $item = $item ?? $post ?? null;
  abort_if(!$item, 404);

  $titleText = $item->meta_title ?? $item->title ?? 'Blog';
  $crumbTitle = 'Blog Details';
  $crumbItems = [
    ['label' => 'Blog', 'url' => route('site.blog')],
  ];

  $img = !empty($item->image)
    ? asset(ltrim($item->image, '/'))
    : asset('assets/img/placeholder/1400x900.jpg');

  // Optional sidebar data (pass from controller if you have them)
  $categories = $categories ?? collect(); // expects: name, slug, posts_count
  $tags = $tags ?? collect();             // expects: name, slug

  $date = !empty($item->published_at) ? optional($item->published_at)->format('M d, Y') : null;
  $q = request('q');
@endphp

@include('site.headers.head', ['title' => $titleText])

@include('site.headers.pg-crumb', [
  'title' => $crumbTitle,
  'items' => $crumbItems
])

<style>
  .blog-details-wrap { padding: 60px 0; }
  .post-hero {
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(0,0,0,.08);
    background: #f6f7f9;
  }
  .post-hero img {
    width: 100%;
    height: 520px;
    object-fit: cover;
    display: block;
  }
  .post-content {
    margin-top: 18px;
    font-size: 17px;
    line-height: 1.9;
    color: #2f3742;
  }
  .post-title {
    font-weight: 800;
    letter-spacing: .01em;
    margin: 18px 0 8px;
  }
  .post-meta {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 14px;
  }

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

  /* sticky sidebar like template */
  @media (min-width: 992px) {
    .sidebar-sticky { position: sticky; top: 110px; }
  }
</style>

<section class="blog-details-wrap">
  <div class="container">
    <div class="row g-4">
      {{-- MAIN --}}
      <div class="col-lg-8">
        <div class="post-hero">
          <img src="{{ $img }}" alt="{{ $item->title }}">
        </div>

        <h1 class="post-title">{{ $item->title }}</h1>

        <div class="post-meta">
          {{ $item->author_name ?? 'Admin' }}
          @if($date) <span class="mx-1">•</span> {{ $date }} @endif
        </div>

        <article class="post-content Justly">
          {!! $item->content ?? '' !!}
        </article>
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
