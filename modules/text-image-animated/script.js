import lottieWeb from "lottie-web";

const textImageAnimated = {};

textImageAnimated.init = () => {
  const sectionTextImage = Array.from(
    document.querySelectorAll(".section-text-image-animated")
  );

  let options = {
    root: null,
    rootMargin: "0px",
    threshold: window.matchMedia("(max-width: 1023px)").matches ? 0.3 : 0.6,
  };

  const onIntersect = (entries) => {
    let logoColor = window.sitewide_object.assets + "/animation/logo-dark.json";

    if (entries[0].target.classList.contains("bg--dark-teal")) {
      logoColor = window.sitewide_object.assets + "/animation/logo-light.json";
    }

    let logoAnimation = lottieWeb.loadAnimation({
      container: entries[0].target.querySelector("#js-animation-container"),
      path: logoColor,
      renderer: "svg",
      loop: false,
      autoplay: false,
      name: "Logo Animation",
    });
    entries[0].isIntersecting === true ? logoAnimation.play() : "";
  };

  let observer = new IntersectionObserver(onIntersect, options);
  sectionTextImage.forEach((section) => observer.observe(section));
};

window.addEventListener("load", () => {
  textImageAnimated.init();
});
