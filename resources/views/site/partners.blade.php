@include('site.headers.head', ['title' => 'Partners'])

@include('site.headers.pg-crumb', [
  'title' => 'Partners',
  'items' => [
    ['label' => 'Partners', 'url' => url('/partners')],
  ]
])

@php
  $partners = $partners ?? collect();
  $logo = fn($p) => $p->logo ? asset(ltrim($p->logo, '/')) : asset('assets/img/placeholder/300x160.png');
@endphp

<main id="main" class="site-main">
  <section class="vc_row wpb_row vc_row-fluid vc-zozo-section typo-default ac-partners-page">
    <div class="zozo-vc-main-row-inner vc-normal-section">
      <div class="container">

        {{-- Title like blog pages --}}
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="ac-page-title text-center">
              <h2 class="ac-title">Partners</h2>
              <p class="ac-subtitle mb-0">
                Organizations we collaborate with to advance child protection and wellbeing.
              </p>
            </div>
          </div>
        </div>

        {{-- Grid --}}
        <div class="row g-4 mt-2 ac-partners-grid">
          @forelse($partners as $p)
            <div class="col-12 col-md-6 col-lg-4">
              <div class="ac-partner-card h-100">

                <div class="ac-partner-media">
                  <img src="{{ $logo($p) }}" alt="{{ $p->name }}">
                </div>

                <div class="ac-partner-body">
                  <h5 class="ac-partner-name">{{ $p->name }}</h5>

                  @if(!empty($p->url))
                    <a class="ac-partner-link" href="{{ $p->url }}" target="_blank" rel="noopener">
                      Website <i class="fas fa-external-link-alt"></i>
                    </a>
                  @endif
                </div>

              </div>
            </div>
          @empty
            <div class="col-12">
              <div class="alert alert-light border">No partners available yet.</div>
            </div>
          @endforelse
        </div>

        {{-- Pagination --}}
        @if(method_exists($partners, 'links'))
          <div class="d-flex justify-content-center mt-4">
            {{ $partners->links() }}
          </div>
        @endif

      </div>
    </div>
  </section>
</main>

@include('site.footers.foot')

@push('styles')
<style>
  /* page spacing similar to blog pages */
  .ac-partners-page{
    padding: 40px 0 70px;
    background: #fff;
  }

  .ac-page-title{ margin-bottom: 10px; }
  .ac-title{
    color:#0b4d60;
    font-weight:900;
    letter-spacing:.3px;
    font-size: clamp(28px, 3vw, 44px);
    margin: 0 0 8px;
  }
  .ac-subtitle{
    color: rgba(0,0,0,.62);
    font-size: 15px;
    line-height: 1.6;
  }

  /* If theme overrides bootstrap gutters, enforce spacing */
  .ac-partners-grid{
    row-gap: 24px;
  }

  /* Card (defined border + rounded + shadow) */
  .ac-partner-card{
    background:#fff;
    border:2px solid #0b4d60;
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 14px 28px rgba(0,0,0,.09);
    transition: transform .15s ease, box-shadow .15s ease;
    display:flex;
    flex-direction:column;
    height: 100%;
    min-height: 320px; /* safer baseline */
  }
  .ac-partner-card:hover{
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(0,0,0,.12);
  }

  /* Responsive media area (prevents giant logos) */
  .ac-partner-media{
    height: clamp(150px, 18vw, 210px); /* responsive height */
    display:flex;
    align-items:center;
    justify-content:center;
    padding: 20px 18px 8px;
    background: #fff;
  }

  .ac-partner-media img{
    max-height: 100%;
    max-width: min(75%, 320px);
    width: auto;              /* IMPORTANT: don’t force 100% */
    height: auto;
    object-fit: contain;
    display:block;
  }

  .ac-partner-body{
    text-align:center;
    padding: 14px 22px 22px;
    display:flex;
    flex-direction:column;
    gap: 12px;
    justify-content:space-between;
    flex: 1;
  }

  .ac-partner-name{
    font-weight: 850;
    color:#111;
    line-height: 1.25;
    margin: 0;
    font-size: 18px;
  }

  .ac-partner-link{
    display:inline-flex;
    gap: 8px;
    align-items:center;
    justify-content:center;
    font-weight: 800;
    text-decoration:none;
    color: #b10b6e;
  }
  .ac-partner-link:hover{
    text-decoration: underline;
    color: #8f0858;
  }

  /* Tablet tweaks */
  @media (max-width: 991.98px){
    .ac-partner-media{
      height: clamp(150px, 24vw, 220px);
    }
    .ac-partner-media img{
      max-width: min(78%, 320px);
    }
  }

  /* Mobile tweaks */
  @media (max-width: 576px){
    .ac-partners-page{ padding: 28px 0 6060px; }
    .ac-partner-card{ border-radius: 20px; min-height: 300px; }
    .ac-partner-media{
      height: 150px;
      padding: 18px 14px 6px;
    }
    .ac-partner-media img{
      max-width: 82%;
    }
    .ac-partner-body{ padding: 12px 16px 18px; }
  }
</style>
@endpush
