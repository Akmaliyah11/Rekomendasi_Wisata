document.addEventListener('DOMContentLoaded', function () {
  const slider = document.getElementById('slider');
  const dotsContainer = document.getElementById('dots');
  const slidesCount = slider.children.length;
  let current = 0;

  // Buat dots
  for (let i = 0; i < slidesCount; i++) {
    const dot = document.createElement('div');
    dot.classList.add('w-3', 'h-3', 'rounded-full', 'bg-white', 'opacity-50', 'cursor-pointer');
    if (i === 0) dot.classList.add('opacity-100');
    dot.addEventListener('click', () => {
      current = i;
      updateSlider();
      resetInterval();
    });
    dotsContainer.appendChild(dot);
  }

  const dots = dotsContainer.children;

  function updateSlider() {
    slider.style.transform = `translateX(-${current * 100}%)`;
    for (let i = 0; i < dots.length; i++) {
      dots[i].classList.toggle('opacity-100', i === current);
      dots[i].classList.toggle('opacity-50', i !== current);
    }
  }

  let interval = setInterval(() => {
    current = (current + 1) % slidesCount;
    updateSlider();
  }, 3000); // 2 detik

  function resetInterval() {
    clearInterval(interval);
    interval = setInterval(() => {
      current = (current + 1) % slidesCount;
      updateSlider();
    }, 3000);
  }
});
