const root = document.getElementsByTagName("html")[0];

// Polyfills
if (!("remove" in Element.prototype)) {
  Element.prototype.remove = function () {
    if (this.parentNode) {
      this.parentNode.removeChild(this);
    }
  };
}

if (!Element.prototype.matches) {
  Element.prototype.matches =
    Element.prototype.msMatchesSelector ||
    Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
  Element.prototype.closest = (s) => {
    let el = this;

    do {
      if (el.matches(s)) return el;
      el = el.parentElement || el.parentNode;
    } while (el !== null && el.nodeType === 1);
    return null;
  };
}

const touchTest = () => {
  const isTouchDevice =
    "ontouchstart" in window ||
    navigator.maxTouchPoints > 0 ||
    navigator.msMaxTouchPoints > 0;

  if (!isTouchDevice) {
    root.classList.remove("touchevent");
    root.classList.add("no-touchevent");
  } else {
    root.classList.remove("no-touchevent");
    root.classList.add("touchevent");
  }
};

const deviceOrientation = () => {
  const detectOrientation = () => {
    if (window.innerHeight > window.innerWidth) {
      root.classList.remove("is-landscape");
      root.classList.add("is-portrait");
    } else {
      root.classList.remove("is-portrait");
      root.classList.add("is-landscape");
    }
  };

  detectOrientation();

  window.addEventListener(
    "resize",
    debounce(function () {
      detectOrientation();
    }, 1000)
  );
};

const isMobile = () => {
  let result = false;
  ((a) => {
    result =
      /Android|webOS|iPhone|iPad|BlackBerry|Windows Phone|Opera Mini|IEMobile|Mobile/i.test(
        a
      );
  })(navigator.userAgent || navigator.vendor || window.opera);
  return result;
};

const isInView = (el, view) => {
  const rect = el.getBoundingClientRect();
  const html = document.documentElement;

  if (view === "completely") {
    // to check if completely visible
    return (
      rect.top >= 0 && rect.bottom <= (window.innerHeight || html.clientHeight)
    );
  }

  if (view === "partially") {
    // to check if partially visible
    return (
      rect.bottom >= 0 && rect.top < (window.innerHeight || html.clientHeight)
    );
  }

  // if partially visible or above current fold,
  return rect.top < (window.innerHeight || html.clientHeight);
};

const getScript = (source, callback) => {
  const prior = document.getElementsByTagName("script")[0];
  let script = document.createElement("script");
  script.async = 1;

  // eslint-disable-next-line no-multi-assign
  script.onload = script.onreadystatechange = function (_, isAbort) {
    if (
      isAbort ||
      !script.readyState ||
      /loaded|complete/.test(script.readyState)
    ) {
      // eslint-disable-next-line no-multi-assign
      script.onload = script.onreadystatechange = null;
      script = undefined;

      if (!isAbort) {
        if (callback) {
          callback();
        }
      }
    }
  };

  script.src = source;
  prior.parentNode.insertBefore(script, prior);
};

const setCookie = (cookieName, cookieValue = 1, cookieDuration = 365) => {
  const expires = `expires=${new Date(
    Date.now() + cookieDuration * 24 * 60 * 60 * 1000
  )}`;
  const value =
    typeof cookieValue !== "string" ? JSON.stringify(cookieValue) : cookieValue;
  document.cookie = `${cookieName}=${value}; ${expires}; path=/`;
};

const getCookie = (cookieName, parseJSON = false) => {
  let cookieValue = null;
  document.cookie.split(";").forEach((cookie) => {
    if (cookie.indexOf(cookieName) !== -1) {
      cookieValue = cookie.trim().split("=").slice(-1)[0].trim();
    }
  });
  if (parseJSON) {
    return JSON.parse(decodeURIComponent(cookieValue));
  }
  return cookieValue;
};

const deleteCookie = (cookieName) => {
  document.cookie = `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:01 GMT;`;
};

const getQuery = () =>
  window.location.search
    ? window.location.search
        .slice(1)
        .split("&")
        .map((query) =>
          query.split("=").map((p) => window.decodeURIComponent(p).trim())
        )
        .reduce(
          (acc, p) => ({
            ...acc,
            [p[0]]: p[1],
          }),
          {}
        )
    : {};

const documentWidth = () => {
  let e = window;
  let a = "inner";

  if (!("innerWidth" in window)) {
    a = "client";
    e = document.documentElement || document.body;
  }

  return {
    width: e[`${a}Width`],
    height: e[`${a}Height`],
  };
};

const debounce = (func, wait, immediate) => {
  let timeout;

  return () => {
    const context = this,
      args = arguments;
    const later = function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    const callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

export {
  touchTest,
  deviceOrientation,
  isMobile,
  isInView,
  getScript,
  setCookie,
  getCookie,
  deleteCookie,
  getQuery,
  documentWidth,
  debounce,
};
