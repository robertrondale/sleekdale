import { debounce } from "../util/dom";
import loadImages from "../util/loadImages";

let backgroundSwitch = {};
let isResize = false;

backgroundSwitch.init = function () {
  console.log('backgroundSwitch.init');
  const jsBgSwitch = Array.from(document.querySelectorAll(".js-bg-switch"));
  jsBgSwitch.forEach((section) => {
    backgroundSwitch.switch(section);
  });
};

backgroundSwitch.switch = function (section) {
  let config = {
    breakpoint: 1023.98,
    bgDesktop: section.getAttribute("data-bg-desktop"),
    bgMobile: section.getAttribute("data-bg-mobile"),
  };

  let imageURL = config.bgDesktop;

  if (window.innerWidth <= config.breakpoint) {
    imageURL = config.bgMobile;
  }

  section.setAttribute('data-bg', imageURL);
  section.removeAttribute('data-ll-status', imageURL);
  section.classList.add('js-lazy');
  
  if (isResize) loadImages();
};

window.addEventListener(
  "resize",
  debounce(function () {
    isResize = true
    backgroundSwitch.init();
  }, 200)
);

export { backgroundSwitch };
