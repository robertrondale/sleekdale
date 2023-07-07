import { debounce } from "../util/dom";

const header = {};

header.scroll = () => {
  const siteHeader = document.getElementById("js-header");

  const stickyToggle = () => {
    if (window.pageYOffset > siteHeader.clientHeight) {
      siteHeader.classList.add("has-hidden-items");
    } else {
      siteHeader.classList.remove("has-hidden-items");
    }
  };

  stickyToggle();

  window.addEventListener("scroll", function () {
    stickyToggle();
  });
};

header.toggle = () => {
  let sideMenuToggle = document.getElementsByClassName("js-menu-toggle");
  for (let i = 0; i < sideMenuToggle.length; i++) {
    sideMenuToggle[i].onclick = function () {
      document.querySelector("body,html").classList.toggle("sidebar-open");
      document.querySelector(".nav-sidebar").classList.toggle("is-open");
    };
  }

  let linkToggle = document.querySelectorAll(".js-submenu-toggle");
  for (let i = 0; i < linkToggle.length; i++) {
    linkToggle[i].addEventListener("click", function (event) {
      event.preventDefault();

      let currentSubMenu = document.getElementById(this.dataset.toggle);

      if (!currentSubMenu.classList.contains("active")) {
        this.classList.add("active");
        currentSubMenu.classList.add("active");
        currentSubMenu.style.height = "auto";
        let height = currentSubMenu.clientHeight + "px";
        currentSubMenu.style.height = "0px";
        setTimeout(function () {
          currentSubMenu.style.height = height;
        }, 0);
      } else {
        currentSubMenu.style.height = "auto";
        let height = currentSubMenu.clientHeight + "px";
        currentSubMenu.style.height = height;
        setTimeout(function () {
          currentSubMenu.style.height = "0px";
        }, 0);
        this.classList.remove("active");

        currentSubMenu.addEventListener(
          "transitionend",
          function () {
            currentSubMenu.classList.remove("active");
          },
          {
            once: true,
          }
        );
      }
    });
  }
};

window.addEventListener(
  "resize",
  debounce(function () {
    header.scroll();
  }, 100)
);

window.addEventListener("load", () => {
  header.scroll();
  header.toggle();
});
