import counterUp from 'counterup2';

const usp = {};

usp.init = () => {
  usp.counter();
};

usp.counter = () => {
  const statistic = document.querySelectorAll('.js-statistic');
  if (!statistic) return;
  
  const callback = entries => {
    entries.forEach(entry => {
      const el = entry.target
      if (entry.isIntersecting && !el.classList.contains('is-visible')) {
        counterUp(el, {
          duration: 1000,
          delay: 20,
        });
        el.classList.add('is-visible')
      }
    });
  };

  const IO = new IntersectionObserver(callback, { threshold: 1 });

  for (let i = 0; i < statistic.length; i++) {
    IO.observe(statistic[i]);
  }
};

window.addEventListener("load", () => {
  usp.init();
});
