@php
  $members = ($team ?? collect())
      ->where('is_active', true)
      ->where('type', 'secretariat')
      ->sortBy('sort_order')
      ->values();
@endphp

@if($members->count())
<section id="home-team-carousel" class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default">
  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">

      <div class="zozo-parallax-header">
        <div class="parallax-header content-style-default">
          <h2 class="parallax-title">OUR TEAM</h2>
        </div>
      </div>

      <div class="team-wrap">
        <button class="team-nav team-prev" type="button" aria-label="Previous">&#10094;</button>

        <div class="team-viewport" tabindex="0">
          <div class="team-track">
            @foreach($members as $m)
              @php $photoUrl = $m->photo ? asset(ltrim($m->photo,'/')) : null; @endphp
              <article class="team-card">
                <div class="team-img">
                  @if($photoUrl)
                    <img loading="lazy" decoding="async" src="{{ $photoUrl }}" alt="{{ $m->name }}">
                  @endif
                </div>

                <div class="team-body">
                  <h5 class="team-name">{{ $m->name }}</h5>
                  @if($m->designation)
                    <div class="team-role">{{ $m->designation }}</div>
                  @endif

                  <div class="team-social">
                    @if($m->facebook)<a href="{{ $m->facebook }}" target="_blank" aria-label="Facebook"><i class="fa fa-facebook"></i></a>@endif
                    @if($m->twitter)<a href="{{ $m->twitter }}" target="_blank" aria-label="X/Twitter"><i class="fa-brands fa-x-twitter"></i></a>@endif
                    @if($m->linkedin)<a href="{{ $m->linkedin }}" target="_blank" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a>@endif
                    @if($m->instagram)<a href="{{ $m->instagram }}" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>@endif
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        </div>

        <button class="team-nav team-next" type="button" aria-label="Next">&#10095;</button>
      </div>

    </div>
  </div>

  <style>
    /* Scoped styles only for this section */
    #home-team-carousel .team-wrap{
      position: relative;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    #home-team-carousel .team-viewport{
      overflow: hidden;
      width: 100%;
    }

    #home-team-carousel .team-track{
      display: flex;
      gap: 30px;
      transition: transform .45s ease;
      will-change: transform;
    }

    /* Card width per breakpoint: 4 / 3 / 2 / 1 */
    #home-team-carousel .team-card{
      flex: 0 0 calc((100% - 90px)/4);
      background: #fff;
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 6px 18px rgba(0,0,0,.06);
    }

    @media (max-width: 991.98px){
      #home-team-carousel .team-card{ flex-basis: calc((100% - 60px)/3); }
    }
    @media (max-width: 767.98px){
      #home-team-carousel .team-card{ flex-basis: calc((100% - 30px)/2); }
    }
    @media (max-width: 575.98px){
      #home-team-carousel .team-card{ flex-basis: 100%; }
    }

    #home-team-carousel .team-img{
      height: 280px;
      background: #f2f2f2;
      overflow: hidden;
    }
    #home-team-carousel .team-img img{
      width: 100%;
      height: 100%;
      object-fit: cover;
      display:block;
    }

    #home-team-carousel .team-body{
      background: #eee;
      text-align: center;
      padding: 14px 12px 16px;
    }
    #home-team-carousel .team-name{ margin: 0 0 6px; font-weight: 700; }
    #home-team-carousel .team-role{ opacity:.8; margin-bottom: 12px; }

    #home-team-carousel .team-social{
      display:flex;
      justify-content:center;
      gap: 10px;
      flex-wrap: wrap;
    }
    #home-team-carousel .team-social a{
      width: 42px;
      height: 42px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      border: 1px solid rgba(0,0,0,.12);
      background: rgba(255,255,255,.3);
      text-decoration:none;
    }

    #home-team-carousel .team-nav{
      border: 0;
      width: 42px;
      height: 42px;
      border-radius: 12px;
      background: rgba(0,0,0,.06);
      cursor: pointer;
    }
  </style>

  <script>
    (function(){
      const root = document.getElementById('home-team-carousel');
      if (!root) return;

      const track = root.querySelector('.team-track');
      const viewport = root.querySelector('.team-viewport');
      const prevBtn = root.querySelector('.team-prev');
      const nextBtn = root.querySelector('.team-next');
      const cards = Array.from(root.querySelectorAll('.team-card'));

      let index = 0;
      let perView = 4;
      let gap = 30;
      let timer = null;

      function calcPerView(){
        const w = window.innerWidth;
        if (w <= 575.98) return 1;
        if (w <= 767.98) return 2;
        if (w <= 991.98) return 3;
        return 4;
      }

      function cardWidth(){
        const vw = viewport.clientWidth;
        const pv = perView;
        return (vw - gap * (pv - 1)) / pv;
      }

      function maxIndex(){
        return Math.max(0, cards.length - perView);
      }

      function render(){
        perView = calcPerView();
        if (index > maxIndex()) index = 0;

        const cw = cardWidth();
        const x = index * (cw + gap);
        track.style.transform = `translateX(${-x}px)`;
      }

      function next(){
        index = (index >= maxIndex()) ? 0 : index + 1;
        render();
      }
      function prev(){
        index = (index <= 0) ? maxIndex() : index - 1;
        render();
      }

      function startAuto(){
        stopAuto();
        timer = setInterval(next, 5000);
      }
      function stopAuto(){
        if (timer) clearInterval(timer);
        timer = null;
      }

      nextBtn.addEventListener('click', () => { next(); startAuto(); });
      prevBtn.addEventListener('click', () => { prev(); startAuto(); });

      root.addEventListener('mouseenter', stopAuto);
      root.addEventListener('mouseleave', startAuto);

      window.addEventListener('resize', render);

      render();
      startAuto();
    })();
  </script>
</section>
@endif
