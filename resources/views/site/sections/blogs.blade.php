@php
  use Illuminate\Support\Str;

  $latestPosts = collect($latestPosts ?? []);
  $latestPosts = $latestPosts->filter(fn($p) => ($p->is_published ?? true));

  $postUrl = fn($post) => route('site.blog.show', $post);
  $postImg = fn($post) => !empty($post->image)
    ? asset(ltrim($post->image, '/'))
    : asset('assets/img/placeholder/1200x800.jpg');
@endphp

<style>
  /* ===== Latest News Carousel (Home) ===== */
  .home-latest-wrap { padding: 70px 0; }
  .home-latest-head { display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin-bottom:22px; }
  .home-latest-title { font-weight: 900; letter-spacing: .01em; margin: 0; font-size: 42px; }
  .home-latest-sub { color:#6c757d; margin: 6px 0 0; }

  .hl-nav { display:flex; gap:10px; }
  .hl-btn {
    width: 44px; height: 44px; border-radius: 999px;
    border: 0; background: #51C4C9; color:#fff;
    display:flex; align-items:center; justify-content:center;
    box-shadow: 0 10px 18px rgba(0,0,0,.12);
    cursor:pointer;
    user-select:none;
  }
  .hl-btn:disabled { opacity:.45; cursor:not-allowed; }

  .hl-track { overflow: hidden; }
  .hl-row {
    display:flex;
    gap: 28px;
    transition: transform .45s cubic-bezier(.2,.8,.2,1);
    will-change: transform;
  }

  /* Card (matches your blog grid vibe) */
  .hl-card {
    flex: 0 0 calc(33.333% - 18.666px);
    border: 1px solid rgba(0,0,0,.06);
    border-radius: 14px;
    overflow:hidden;
    background:#fff;
    box-shadow: 0 10px 24px rgba(0,0,0,.06);
  }
  .hl-thumb { position:relative; overflow:hidden; background:#f6f7f9; }
  .hl-thumb img{
    width:100%;
    height: 260px;
    object-fit:cover;
    display:block;
    transform: scale(1);
    transition: transform .35s ease;
  }
  .hl-card:hover .hl-thumb img{ transform: scale(1.04); }

  .hl-date {
    position:absolute;
    left: 16px;
    bottom: 16px;
    background:#fff;
    padding: 8px 12px;
    border-radius: 10px;
    font-weight:700;
    font-size: 13px;
    box-shadow: 0 10px 20px rgba(0,0,0,.12);
  }

  .hl-body { padding: 18px 18px 16px; }
  .hl-title {
    font-weight: 900;
    font-size: 18px;
    line-height: 1.35;
    margin: 0 0 10px;
  }
  .hl-title a{ color: inherit; text-decoration:none; }
  .hl-title a:hover{ text-decoration:underline; }
  .hl-meta { color:#6c757d; font-size: 13px; margin-bottom: 10px; }
  .hl-excerpt { margin:0 0 12px; color:#5b6470; line-height:1.8; }
  .hl-more {
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .08em;
    font-size: 12px;
    color:#51C4C9;
    text-decoration:none;
  }
  .hl-more:hover{ text-decoration:underline; }

  .hl-dots { display:flex; gap:8px; justify-content:center; margin-top: 18px; }
  .hl-dot {
    width: 10px; height: 10px; border-radius:999px;
    border:0;
    background: rgba(0,0,0,.18);
    cursor:pointer;
  }
  .hl-dot.is-active { background: #51C4C9; }

  /* Responsive */
  @media (max-width: 991.98px){
    .home-latest-title { font-size: 34px; }
    .hl-card { flex: 0 0 calc(50% - 14px); }
  }
  @media (max-width: 575.98px){
    .home-latest-title { font-size: 28px; }
    .hl-card { flex: 0 0 100%; }
  }
</style>

<section class="home-latest-wrap">
  <div class="container">
    <div class="home-latest-head">
      <div>
        <h2 class="home-latest-title">Latest News</h2>
        <p class="home-latest-sub mb-0">Read our latest updates and insights.</p>
      </div>

      <div class="hl-nav">
        <button class="hl-btn" type="button" id="hlPrev" aria-label="Previous">‹</button>
        <button class="hl-btn" type="button" id="hlNext" aria-label="Next">›</button>
      </div>
    </div>

    @if($latestPosts->count())
      <div class="hl-track">
        <div class="hl-row" id="hlRow">
          @foreach($latestPosts as $post)
            @php
              $url = $postUrl($post);
              $img = $postImg($post);
              $date = $post->published_at ? optional($post->published_at)->format('M d, Y') : null;
              $excerpt = $post->excerpt ?: Str::limit(strip_tags((string)($post->content ?? '')), 110);
            @endphp

            <article class="hl-card">
              <a class="hl-thumb d-block" href="{{ $url }}" title="{{ $post->title }}">
                <img loading="lazy" decoding="async" src="{{ $img }}" alt="{{ $post->title }}">
                @if($date)
                  <span class="hl-date">{{ $date }}</span>
                @endif
              </a>

              <div class="hl-body">
                <h3 class="hl-title">
                  <a href="{{ $url }}">{{ Str::limit($post->title, 70) }}</a>
                </h3>

                <div class="hl-meta">
                  {{ $post->author_name ?? 'Admin' }}
                  @if($date) <span class="mx-1">•</span> {{ $date }} @endif
                </div>

                <p class="hl-excerpt">{{ $excerpt }}</p>

                <a class="hl-more" href="{{ $url }}">Continue</a>
              </div>
            </article>
          @endforeach
        </div>
      </div>

      {{-- Dots --}}
      <div class="hl-dots" id="hlDots" aria-label="Carousel pagination"></div>

      <script>
        (function () {
          const row  = document.getElementById('hlRow');
          const prev = document.getElementById('hlPrev');
          const next = document.getElementById('hlNext');
          const dotsWrap = document.getElementById('hlDots');
          if (!row || !prev || !next || !dotsWrap) return;

          let index = 0;

          function visibleCount() {
            const w = window.innerWidth;
            if (w < 576) return 1;
            if (w < 992) return 2;
            return 3;
          }

          function maxIndex() {
            const total = row.children.length;
            return Math.max(0, total - visibleCount());
          }

          function stepWidth() {
            const first = row.children[0];
            if (!first) return 0;
            const style = window.getComputedStyle(row);
            const gap = parseFloat(style.columnGap || style.gap || 0);
            return first.getBoundingClientRect().width + gap;
          }

          function buildDots() {
            dotsWrap.innerHTML = '';
            const m = maxIndex();
            const count = m + 1;
            for (let i = 0; i < count; i++) {
              const b = document.createElement('button');
              b.type = 'button';
              b.className = 'hl-dot' + (i === index ? ' is-active' : '');
              b.setAttribute('aria-label', 'Go to slide ' + (i + 1));
              b.addEventListener('click', () => { index = i; render(); });
              dotsWrap.appendChild(b);
            }
          }

          function setActiveDot() {
            [...dotsWrap.children].forEach((d, i) => d.classList.toggle('is-active', i === index));
          }

          function render() {
            const m = maxIndex();
            index = Math.min(Math.max(0, index), m);

            row.style.transform = `translateX(${-index * stepWidth()}px)`;

            prev.disabled = index <= 0;
            next.disabled = index >= m;

            setActiveDot();
          }

          prev.addEventListener('click', () => { index--; render(); });
          next.addEventListener('click', () => { index++; render(); });

          window.addEventListener('resize', () => {
            buildDots();
            render();
          });

          // init
          buildDots();
          render();
        })();
      </script>
    @else
      <div class="py-4 text-center">
        <p class="mb-0">No posts yet.</p>
      </div>
    @endif
  </div>
</section>
