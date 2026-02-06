{{-- Nav --}}
<script>
(function(){
  const topbar  = document.getElementById('acTopbar');
  const navbar  = document.getElementById('acNavbar');
  const spacer  = document.getElementById('acHeaderSpacer');
  const burger  = document.getElementById('acBurger');
  const menu    = document.getElementById('acNavMenu');

  if(!topbar || !navbar || !spacer) return;

  // Detect actual scrolling element (some themes use wrappers)
  function getScrollHost(){
    const candidates = [
      document.scrollingElement,
      document.documentElement,
      document.body,
      document.getElementById('zozo_wrapper'),
      document.getElementById('wrapper'),
      document.querySelector('.wrapper-class'),
    ].filter(Boolean);

    // pick the first that actually scrolls
    for(const el of candidates){
      try{
        const style = window.getComputedStyle(el);
        const canScroll = (el.scrollHeight > el.clientHeight + 5);
        const overflowY = style.overflowY;
        if(canScroll && overflowY !== 'hidden') return el;
      } catch(e){}
    }
    return window; // default
  }

  const scrollHost = getScrollHost();
  let lastY = 0;
  let ticking = false;

  function getY(){
    if(scrollHost === window) return window.scrollY || 0;
    return scrollHost.scrollTop || 0;
  }

  function setSpacer(){
    // spacer = NAVBAR height only (prevents large blank space)
    const navH = navbar.getBoundingClientRect().height || 0;
    spacer.style.height = navH + 'px';
  }

  function closeMenu(){
    if(menu) menu.classList.remove('is-open');
    if(burger) burger.setAttribute('aria-expanded','false');
  }

  function onScroll(){
    const y = getY();
    const delta = y - lastY;

    // elevate navbar after small scroll
    navbar.classList.toggle('is-elevated', y > 6);

    // hide topbar on scroll down, show on scroll up
    const goingDown = delta > 6;
    const goingUp   = delta < -6;

    if (y < 30){
      topbar.classList.remove('is-hidden');
    } else if (goingDown){
      topbar.classList.add('is-hidden');
      closeMenu();
    } else if (goingUp){
      topbar.classList.remove('is-hidden');
    }

    lastY = y;
    ticking = false;
  }

  function requestTick(){
    if(!ticking){
      requestAnimationFrame(onScroll);
      ticking = true;
    }
  }

  // Burger (mobile)
  if(burger && menu){
    burger.addEventListener('click', function(){
      const open = menu.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    document.addEventListener('click', function(e){
      if(!menu.classList.contains('is-open')) return;
      if(!navbar.contains(e.target)) closeMenu();
    });

    document.addEventListener('keydown', function(e){
      if(e.key === 'Escape') closeMenu();
    });
  }

  // attach scroll listener
  if(scrollHost === window){
    window.addEventListener('scroll', requestTick, { passive:true });
  }else{
    scrollHost.addEventListener('scroll', requestTick, { passive:true });
    // if wrapper scrolls, also listen window in case
    window.addEventListener('scroll', requestTick, { passive:true });
  }

  window.addEventListener('resize', function(){
    setSpacer();
    closeMenu();
  });

  window.addEventListener('load', function(){
    setSpacer();
    lastY = getY();
    onScroll();
  });

  // init
  setSpacer();
  lastY = getY();
  onScroll();
  setTimeout(setSpacer, 250);
  setTimeout(setSpacer, 800);
})();
</script>

{{-- Nav --}}

<script>
(function () {
  const root = document.getElementById('simpleHero');
  if (!root) return;

  const track = root.querySelector('.simple-hero-track');
  const slides = Array.from(track.querySelectorAll('.simple-hero-slide'));
  if (slides.length <= 1) return;

  // Clone first slide for seamless loop
  const firstClone = slides[0].cloneNode(true);
  firstClone.setAttribute('data-clone', '1');
  track.appendChild(firstClone);

  const dots = Array.from(root.querySelectorAll('.simple-hero-dot'));
  let index = 0;                 // 0..slides.length-1 (real slides)
  let isJumping = false;

  function setDots(i) {
    if (!dots.length) return;
    dots.forEach((d, idx) => d.classList.toggle('is-active', idx === i));
  }
  setDots(0);

  function goTo(i) {
    track.style.transition = 'transform 700ms ease';
    track.style.transform = `translateX(-${i * 100}%)`;
  }

  function next() {
    if (isJumping) return;
    index += 1;

    // Move to next position (includes clone as last position)
    goTo(index);

    // If we just moved onto the clone (index === slides.length),
    // after transition ends, jump back to real first slide (index 0) instantly.
    if (index === slides.length) {
      isJumping = true;
      setDots(0);
    } else {
      setDots(index);
    }
  }

  track.addEventListener('transitionend', function () {
    if (!isJumping) return;

    // Jump back without animation
    track.style.transition = 'none';
    track.style.transform = 'translateX(0%)';
    index = 0;

    // Force reflow so the next transition works
    track.offsetHeight; 
    isJumping = false;
  });

  // Auto-rotate
  let timer = setInterval(next, 5000);

  // Pause on hover (desktop)
  root.addEventListener('mouseenter', () => clearInterval(timer));
  root.addEventListener('mouseleave', () => timer = setInterval(next, 5000));
})();
</script>
