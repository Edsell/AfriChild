@php
  $bg = $cta?->background_image ? asset($cta->background_image) : null;
  $speed = $cta?->parallax_speed ?? 1.5;
  $items = ($cta?->items ?? collect())->where('is_active', true)->sortBy('sort_order');

  // CTA title from section (admin "Back to Section" / CTA edit)
  $ctaTitle = trim((string)($cta?->title ?? ''));
  $ctaTitle = $ctaTitle !== '' ? $ctaTitle : 'Our Impact';
@endphp

@if($cta?->is_active)
<section
  class="vc_row wpb_row vc_row-fluid vc_row-has-fill vc_general Afri_parallax vc-zozo-section typo-light bg-overlay-dark afri-circle-cta"
  data-vc-parallax="{{ $speed }}"
  @if($bg) data-vc-parallax-image="{{ $bg }}" @endif

  @if($bg)
    style="
      background-image: url('{{ $bg }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
    "
  @else
    style="position: relative;"
  @endif
>
  @if($bg)
    <div class="vc_parallax-inner"
      style="
        background-image: url('{{ $bg }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position:absolute; top:0; left:0; right:0; bottom:0;
        z-index:0;
        transform: translateZ(0);
      ">
    </div>
  @endif

  <div class="zozo-vc-main-row-inner vc-normal-section" style="position:relative; z-index:2;">
    <div class="container">
      <div class="row">
        <div class="wpb_column vc_main_column vc_column_container vc_col-sm-12 typo-default">
          <div class="vc_column-inner">
            <div class="wpb_wrapper">

              {{-- CTA TITLE (ALWAYS) --}}
              <div class="afri-circle-title-wrap text-center">
                <h2 class="afri-circle-title">{{ $ctaTitle }}</h2>
              </div>

              <div class="vc_row wpb_row vc_inner vc_row-fluid">
                <div class="zozo-vc-row-inner vc-inner-row-section clearfix">
                  <div class="wpb_column vc_column_inner vc_column_container vc_col-sm-12 typo-default">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">

                        {{-- CUSTOM OVERRIDE WRAPPER (SINGLE) --}}
                        <div class="afri-circle-counter-wrap">
                          <div class="afri-circle-grid cols-{{ max(1, min(6, $items->count())) }}">

                            @foreach($items as $item)
                              @php
                                $p = max(0, min(100, (int) $item->percent));
                              @endphp

                              <div class="afri-circle-item" data-percent="{{ $p }}">
                                <div class="afri-circle" role="img" aria-label="{{ $item->title }} {{ $p }}">

                                  {{-- SVG ring --}}
                                  <svg class="afri-circle-svg" viewBox="0 0 120 120" width="140" height="140" aria-hidden="true">
                                    <circle class="afri-circle-track"
                                            cx="60" cy="60" r="52"
                                            fill="none"
                                            stroke="rgba(255,255,255,.95)"
                                            stroke-width="6"></circle>

                                    <circle class="afri-circle-progress"
                                            cx="60" cy="60" r="52"
                                            fill="none"
                                            stroke="#E1007A"
                                            stroke-width="6"
                                            stroke-linecap="round"
                                            stroke-dasharray="0 999"
                                            stroke-dashoffset="0"></circle>
                                  </svg>

                                  {{-- RUNNER --}}
                                  <div class="afri-circle-runner" aria-hidden="true">
                                    <span class="afri-runner-dot"></span>
                                  </div>

                                  {{-- value (NUMBERS ONLY) --}}
                                  <div class="afri-circle-text">
                                    <span class="afri-circle-value">0</span>
                                  </div>
                                </div>

                                <div class="afri-circle-label">{{ $item->title }}</div>
                              </div>
                            @endforeach

                          </div>
                        </div>
                        {{-- /CUSTOM OVERRIDE WRAPPER --}}

                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- SELF-CONTAINED CSS --}}
              <style>
                .afri-circle-cta { overflow: hidden; }

                .afri-circle-cta .afri-circle-title-wrap{ padding: 10px 0 10px; }
                .afri-circle-cta .afri-circle-title{
                  color: #fff;
                  font-weight: 800;
                  font-size: 34px;
                  margin: 0 0 10px;
                  text-shadow: 0 2px 10px rgba(0,0,0,.35);
                }
                @media (max-width: 575px){
                  .afri-circle-cta .afri-circle-title{ font-size: 26px; }
                }

                .afri-circle-cta .afri-circle-counter-wrap{ padding: 30px 0 40px; }

                .afri-circle-cta .afri-circle-grid{
                  display: grid;
                  gap: 28px;
                  align-items: center;
                  justify-items: center;
                }

                .afri-circle-cta .afri-circle-grid.cols-1{ grid-template-columns: 1fr; }
                .afri-circle-cta .afri-circle-grid.cols-2{ grid-template-columns: repeat(2, 1fr); }
                .afri-circle-cta .afri-circle-grid.cols-3{ grid-template-columns: repeat(3, 1fr); }
                .afri-circle-cta .afri-circle-grid.cols-4{ grid-template-columns: repeat(4, 1fr); }
                .afri-circle-cta .afri-circle-grid.cols-5{ grid-template-columns: repeat(5, 1fr); }
                .afri-circle-cta .afri-circle-grid.cols-6{ grid-template-columns: repeat(6, 1fr); }

                @media (max-width: 1199px){
                  .afri-circle-cta .afri-circle-grid.cols-5,
                  .afri-circle-cta .afri-circle-grid.cols-6{ grid-template-columns: repeat(4, 1fr); }
                }
                @media (max-width: 991px){
                  .afri-circle-cta .afri-circle-grid{ grid-template-columns: repeat(2, 1fr) !important; }
                }
                @media (max-width: 575px){
                  .afri-circle-cta .afri-circle-grid{ grid-template-columns: 1fr !important; }
                }

                .afri-circle-cta .afri-circle-item{
                  text-align: center;
                  min-width: 160px;
                }

                .afri-circle-cta .afri-circle{
                  position: relative;
                  width: 140px;
                  height: 140px;
                  display: grid;
                  place-items: center;
                }

                .afri-circle-cta .afri-circle-svg{
                  width: 140px;
                  height: 140px;
                  transform: rotate(-90deg);
                  filter: drop-shadow(0 2px 8px rgba(0,0,0,.25));
                  z-index: 1;
                }

                .afri-circle-cta .afri-circle-progress{
                  transition: stroke-dashoffset .12s linear;
                }

                .afri-circle-cta .afri-circle-text{
                  position: absolute;
                  inset: 0;
                  display: grid;
                  place-items: center;
                  z-index: 3;
                  transform: translateY(-1px);
                }

                .afri-circle-cta .afri-circle-value{
                  color: #fff;
                  font-weight: 700;
                  font-size: 30px;
                  letter-spacing: .2px;
                  text-shadow: 0 2px 10px rgba(0,0,0,.35);
                }

                .afri-circle-cta .afri-circle-label{
                  margin-top: 10px;
                  color: rgba(255,255,255,.95) !important;
                  font-weight: 600;
                  font-size: 18px;
                  text-shadow: 0 2px 10px rgba(0,0,0,.35);
                }

                .afri-circle-cta .afri-circle-runner{
                  position: absolute;
                  inset: 10px;
                  border-radius: 999px;
                  transform: rotate(-90deg);
                  z-index: 2;
                  pointer-events: none;
                }

                .afri-circle-cta .afri-runner-dot{
                  position: absolute;
                  top: 50%;
                  left: 100%;
                  transform: translate(-50%, -50%);
                  width: 10px;
                  height: 10px;
                  border-radius: 50%;
                  background: #E1007A;
                  box-shadow: 0 0 0 4px rgba(194, 58, 165, 0.18), 0 4px 12px rgba(0,0,0,.35);
                }
              </style>

              {{-- SELF-CONTAINED JS --}}
              <script>
                (function () {
                  function init() {
                    const root = document.querySelector('.afri-circle-cta');
                    if (!root) return;

                    const items = Array.from(root.querySelectorAll('.afri-circle-item'));
                    if (!items.length) return;

                    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                    function setup(el) {
                      const progress = el.querySelector('.afri-circle-progress');
                      const valueEl = el.querySelector('.afri-circle-value');
                      const runner = el.querySelector('.afri-circle-runner');
                      if (!progress || !valueEl || !runner) return;

                      const percent = Math.max(0, Math.min(100, parseInt(el.dataset.percent || '0', 10)));
                      const r = parseFloat(progress.getAttribute('r')) || 52;
                      const circumference = 2 * Math.PI * r;

                      progress.style.strokeDasharray = circumference + ' ' + circumference;
                      progress.style.strokeDashoffset = String(circumference);

                      el._afri = { percent, r, circumference, progress, valueEl, runner };
                    }

                    function animate(el) {
                      if (!el._afri || el.dataset.animated === '1') return;
                      el.dataset.animated = '1';

                      const { percent, circumference, progress, valueEl, runner } = el._afri;

                      if (prefersReduced) {
                        const off = circumference - (percent / 100) * circumference;
                        progress.style.strokeDashoffset = String(off);
                        valueEl.textContent = String(percent); // numbers only
                        runner.style.transform = 'rotate(' + (-90 + (percent/100)*360) + 'deg)';
                        return;
                      }

                      const duration = 1300;
                      const start = performance.now();
                      const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

                      function frame(now) {
                        const t = Math.min(1, (now - start) / duration);
                        const eased = easeOutCubic(t);
                        const current = Math.round(eased * percent);

                        const off = circumference - (current / 100) * circumference;
                        progress.style.strokeDashoffset = String(off);

                        valueEl.textContent = String(current); // numbers only

                        const angle = -90 + (current / 100) * 360;
                        runner.style.transform = 'rotate(' + angle + 'deg)';

                        if (t < 1) requestAnimationFrame(frame);
                      }

                      requestAnimationFrame(frame);
                    }

                    items.forEach(setup);

                    if ('IntersectionObserver' in window) {
                      const obs = new IntersectionObserver((entries) => {
                        entries.forEach((e) => {
                          if (e.isIntersecting) {
                            animate(e.target);
                            obs.unobserve(e.target);
                          }
                        });
                      }, { threshold: 0.35 });

                      items.forEach((el) => obs.observe(el));
                    } else {
                      items.forEach(animate);
                    }
                  }

                  if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', init);
                  } else {
                    init();
                  }
                })();
              </script>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif