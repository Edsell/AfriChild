@php
  $partners = collect($partners ?? [])->where('is_active', true)->values();
@endphp

@if($partners->count())
<section id="home-partners" class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default">
  <style>
    /* Scoped only to this section */
    #home-partners .partners-viewport { overflow: hidden; width: 100%; }
    #home-partners .partners-track {
      display: flex;
      gap: 20px;
      align-items: center;
      transition: transform .45s ease;
      will-change: transform;
    }
    #home-partners .partner-card {
      flex: 0 0 calc((100% - 60px)/4);
      background: #fff;
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 14px;
      padding: 18px;
      display:flex;
      align-items:center;
      justify-content:center;
      height: 110px;
    }
    #home-partners .partner-card img {
      max-height: 70px;
      max-width: 100%;
      object-fit: contain;
      display:block;
    }
    @media (max-width: 991.98px){ #home-partners .partner-card{ flex-basis: calc((100% - 40px)/3);} }
    @media (max-width: 767.98px){ #home-partners .partner-card{ flex-basis: calc((100% - 20px)/2);} }
    @media (max-width: 575.98px){ #home-partners .partner-card{ flex-basis: 100%; } }

    /* Added: bottom button (scoped) */
    #home-partners .partners-cta{
      text-align:center;
      margin-top: 22px;
    }
    #home-partners .partners-cta .btn-partners{
      display:inline-flex;
      align-items:center;
      gap: 10px;
      background:#DF0C81;
      color:#fff;
      font-weight:800;
      border-radius:12px;
      padding:12px 22px;
      text-decoration:none;
      border:0;
      box-shadow:0 12px 24px rgba(0,0,0,.08);
      transition: transform .15s ease, filter .15s ease;
    }
    #home-partners .partners-cta .btn-partners:hover{
      color:#fff;
      filter: brightness(.96);
      transform: translateY(-1px);
    }
  </style>

  <div class="zozo-vc-main-row-inner vc-normal-section">
    <div class="container">
      <div class="zozo-parallax-header">
        <div class="parallax-header content-style-default">
          <h2 class="parallax-title">Our Founding Partners</h2>
        </div>
      </div>

      <div class="partners-viewport" tabindex="0">
        <div class="partners-track">
          @foreach($partners as $p)
            @php $logo = $p->logo ? asset(ltrim($p->logo,'/')) : null; @endphp
            <div class="partner-card">
              @if($p->url)
                <a href="{{ $p->url }}" target="_blank" title="{{ $p->name }}" style="display:block;width:100%;text-align:center;">
                  @if($logo)<img src="{{ $logo }}" alt="{{ $p->name }}">@else {{ $p->name }} @endif
                </a>
              @else
                @if($logo)<img src="{{ $logo }}" alt="{{ $p->name }}">@else {{ $p->name }} @endif
              @endif
            </div>
          @endforeach
        </div>
      </div>

      {{-- Added: button to partners page --}}
      <div class="partners-cta">
        <a class="btn-partners" href="{{ route('site.partners') }}">
          View All Partners <i class="fas fa-arrow-right"></i>
        </a>
      </div>

    </div>
  </div>

  <script>
    (function(){
      const root = document.getElementById('home-partners');
      if (!root) return;

      const viewport = root.querySelector('.partners-viewport');
      const track = root.querySelector('.partners-track');
      const cards = Array.from(root.querySelectorAll('.partner-card'));

      let index = 0;
      let gap = 20;
      let perView = 4;
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
        return (vw - gap * (perView - 1)) / perView;
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

      function start(){
        stop();
        timer = setInterval(next, 3500);
      }
      function stop(){
        if (timer) clearInterval(timer);
        timer = null;
      }

      window.addEventListener('resize', render);
      root.addEventListener('mouseenter', stop);
      root.addEventListener('mouseleave', start);

      render();
      start();
    })();
  </script>
</section>
@endif
