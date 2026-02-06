@php
  $slides = $heroSlides ?? collect();
@endphp

<div class="simple-hero" id="simpleHero" aria-label="Hero Slider">
  <div class="simple-hero-track">
    @forelse($slides as $slide)
      @php
        $bg = $slide->background
          ? asset('uploads/'.$slide->background)
          : asset('assets/img/placeholder.jpg');
      @endphp

      <section class="simple-hero-slide" style="background-image:url('{{ $bg }}');">
        <div class="simple-hero-overlay"></div>

        <div class="simple-hero-content container">
          @if($slide->kicker)
            <div class="simple-hero-kicker">{{ $slide->kicker }}</div>
          @endif

          @if($slide->title)
            <h1 class="simple-hero-title">{{ $slide->title }}</h1>
          @endif

          @if($slide->subtitle)
            <p class="simple-hero-subtitle">{{ $slide->subtitle }}</p>
          @endif

        @if(!empty($slide->button_text) && !empty($slide->button_url))
        <div class="ac-hero-btn-wrap">
          <a class="btn btn-default ac-hero-btn" href="{{ $slide->button_url }}">
            {{ $slide->button_text }}
          </a>
        </div>
      @endif

        </div>
      </section>
    @empty
      <section class="simple-hero-slide" style="background-image:url('{{ asset('assets/img/placeholder.jpg') }}');">
        <div class="simple-hero-overlay"></div>
        <div class="simple-hero-content container">
          <div class="simple-hero-kicker">Welcome</div>
          <h1 class="simple-hero-title">Your Hero Slider</h1>
          <p class="simple-hero-subtitle">Add slides from Admin → Home Page → Hero Slides</p>
        </div>
      </section>
    @endforelse
  </div>

  {{-- Optional dots (visual only). You can remove if not needed. --}}
  @if($slides->count() > 1)
    <div class="simple-hero-dots" aria-hidden="true">
      @for($d = 0; $d < $slides->count(); $d++)
        <span class="simple-hero-dot"></span>
      @endfor
    </div>
  @endif
</div>
