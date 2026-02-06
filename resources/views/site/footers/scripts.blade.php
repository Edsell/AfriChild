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
