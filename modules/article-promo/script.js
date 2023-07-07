import { Swiper } from "swiper";
import loadImages from "../../src/js/util/loadImages";

const articlePromo = {};

articlePromo.init = () => {
  articlePromo.swiper();
};

articlePromo.swiper = () => {
  const articlePromoSwiper = document.querySelectorAll(".articles--slider");

  if (!articlePromoSwiper) return;

  articlePromoSwiper.forEach(item => {
    const swiper = new Swiper(item, {
      loop: true,
      centeredSlides: true,
      slidesPerView: "auto",
      loopedSlides: 3,
    });
  });

  articlePromo.reinilizedEl();
};


articlePromo.reinilizedEl = () => {
  // Update lazyload
  loadImages();
},

window.addEventListener("load", () => {
  articlePromo.init();
});
