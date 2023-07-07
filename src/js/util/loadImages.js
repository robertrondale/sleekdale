import LazyLoad from "vanilla-lazyload";

let lazyLoadInstance = null;

const loadImages = () => {
  if (lazyLoadInstance) {
    lazyLoadInstance.update();
  } else {
    lazyLoadInstance = new LazyLoad({
      threshold: 500,
      elements_selector: ".js-lazy",
    });
  }
};

export default loadImages;

window.loadImages = loadImages;
