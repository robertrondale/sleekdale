let anchorLink = {};

anchorLink.init = function () {
  const links = document.querySelector(".js-anchorLink");
  if (links) {
    links.addEventListener("click", function (e) {
      const targetLink = this.getAttribute("href").replace("#", "");

      if (targetLink) {
        e.preventDefault();
        scrollToSection(targetLink);
        // document.querySelector("#" + targetLink).focus();
      }
    });
  }

  window.addEventListener("load", function () {
    try {
      if (window.location.hash !== null && window.location.hash !== "") {
        let hash = window.location.hash.substring(1);
        let targetLink = document.querySelector(hash);

        if (targetLink.length) {
          scrollToSection(targetLink);
        }
      }
    } catch (error) {
      // Do nothing
    }
  });
};

export const scrollToSection = (targetEl) => {
  let element = document.getElementById(targetEl);
  let navHeight = document.getElementById("js-header").offsetHeight;

  if (!element) return;

  const newScrollPos =
    element.getBoundingClientRect().top + window.scrollY - navHeight;
  window.scroll({
    top: newScrollPos,
    behavior: "smooth",
  });
};

export { anchorLink };
