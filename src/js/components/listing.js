/**
 * HOW TO USE:
 *
 * See layout on how to use the listing.js
 *
 * config.container
 * ---config.filterGroup
 * ------config.filterItem[data-name="name"][data-value="value"]
 *
 * ---config.listWrapper
 * ---config.nextButton
 *
 */

import fetchRest from "../util/async";
import loadImages from "../util/loadImages";
import { objectToQueryString, queryStringToObject } from "../util/string";

const hashQueryString = window.location.hash;

const config = {
  container: ".js-listing",
  filterGroup: ".js-filter-group",
  filterItem: ".js-filter-item",
  listWrapper: ".js-list-wrapper",
  nextButton: ".js-load-more",
  totalCount: ".js-list-total-count",
  classes: {
    active: "button--inherit-color-active",
    disabled: "button--inherit-color-disabled",
    loading: "is-loading",
  },
};

const listing = {
  init: () => {
    const container = $(config.container);

    if (!container.length) return;

    container.each((pos, el) => {
      // Get settings from wrapper data
      const wrapper = $(el);
      const data = wrapper.data();
      const target = wrapper.find(config.listWrapper);
      const type = data.type || "post";

      if (hashQueryString != "") {
        listing.setFilterUsingHash();
        listing.filterList(target, type, data, 1);
      }

      listing.setEvents(wrapper, data, target, type);
    });
  },

  setEvents: (wrapper, data, target, postType) => {
    if (!wrapper) return;

    // Filter items click listener
    const filterItems = wrapper.find(config.filterItem);
    if (filterItems.length) {
      filterItems.off("click").on("click", (e) => {
        e.preventDefault();

        const self = $(e.currentTarget);

        if (self.data("value").length == 0) {
          const parentGroup = self.parents(config.filterGroup);
          parentGroup
            .find(config.filterItem)
            .removeClass(config.classes.active);

          self.addClass(config.classes.active);
        } else {
          self.toggleClass(config.classes.active);
          listing.resetFilterGroup(self);
        }

        listing.filterList(target, postType, data, 1);
      });
    }

    // Load more click listener
    const loadMoreBtn = wrapper.find(config.nextButton);
    loadMoreBtn.off("click").on("click", (e) => {
      e.preventDefault();
      const self = $(e.currentTarget);
      const currentPage = parseInt(self[0].dataset.page) + 1;
      self.toggleClass(config.classes.loading);

      setTimeout(() => {
        listing.filterList(target, postType, data, currentPage);
        self.toggleClass(config.classes.loading);
      }, 200);
    });
  },

  filterList: (target, type, data, currentPage) => {
    let filters = new Object();

    const filterItems = $(config.filterItem);
    let filterPostType = type;

    if (filterItems.length) {
      filterItems.each(function (pos, el) {
        let inputName, inputValue;

        inputName = $(el).data("name");
        inputValue = $(el).data("value");

        if ($(el).hasClass(config.classes.active) == false || !inputValue)
          return;

        if (typeof filters[inputName] === "undefined") {
          filters[inputName] = [];
        }

        filters[inputName].push(inputValue);
      });
    }

    let filterUrl = "";
    let dataFilters = new Object();

    if (Object.keys(filters).length) {
      filterUrl = objectToQueryString(filters);

      for (const key in filters) {
        dataFilters[key] = filters[key].join(",");
      }
    }

    // Generate list based on the current page
    listing.load(target, filterPostType, currentPage, {
      ...data,
      ...dataFilters,
    });

    // Update url hash with selected filters
    window.history.pushState("", document.title, "#" + filterUrl);
  },

  load: (wrapper, postType, currentPage, filters = {}) => {
    if (!postType || !wrapper) return;

    // Add current language on filters 
    const lang = "en";
    if (typeof window.rest_object !== "undefined" && window.rest_object.lang) {
      filters.lang = window.rest_object.lang;
    }

    fetchRest(`cpt_paging/${postType}/${currentPage}/`, filters).then(
      (data) => {
        // Update listing
        if (currentPage === 1) {
          wrapper.html(data.html);
        } else {
          wrapper.append(data.html);
        }

        // Update total count
        const totalEl = wrapper
          .parents(config.container)
          .find(config.totalCount);

        const hasTotal = totalEl.length && typeof data.total !== "undefined";

        if (hasTotal) {
          totalEl.html(data.total);
        } else {
          totalEl.html("");
        }

        // Update load more button
        const $loadMoreBtn = wrapper
          .parents(config.container)
          .find(config.nextButton);

        if ($loadMoreBtn.length) {
          $loadMoreBtn.attr("data-page", currentPage);

          if (typeof data.total !== "undefined" && data.limit && currentPage < data.limit) {
            $loadMoreBtn.parent().show();
          } else {
            $loadMoreBtn.parent().hide();
          }
        }

        listing.reinilizedEl();
      }
    );
  },

  setFilterUsingHash: () => {
    let hash = hashQueryString || window.location.hash;
    hash = hash.replace("#", "");

    const hashArr = queryStringToObject(hash);

    if (hashArr.length === 0) return;

    $.each(hashArr, function (inputName, items) {
      if (items.length === 0) return;

      $.each(items, function (pos, item) {
        const inputValue = decodeURIComponent(item);
        let selectedEl = $(
          `${config.filterItem}[data-name="${inputName}"][data-value="${inputValue}"]`
        );

        if (selectedEl.length === 0) {
          return;
        }

        // Add active class on element
        selectedEl.addClass(config.classes.active);
        listing.resetFilterGroup(selectedEl);
      });
    });
  },

  resetFilterGroup: (el) => {
    if (el.length === 0) return;

    const parentGroup = el.parents(config.filterGroup);

    if (parentGroup.length === 0) return;

    // Get ALL element within the group
    const all = parentGroup.find(`${config.filterItem}[data-value='']`);

    // Check if there's a selected item within the group
    const selectedItem = parentGroup.find(
      `${config.filterItem}.${config.classes.active}:not([data-value=''])`
    );

    if (
      all.length &&
      selectedItem.length &&
      all.hasClass(config.classes.active)
    ) {
      // Remove active class on ALL if there's any selected item from the group
      all.removeClass(config.classes.active);
    } else if (all.length && selectedItem.length == 0) {
      // Add active class on ALL if there's no selected item from the group
      all.addClass(config.classes.active);
    }
  },

  reinilizedEl: () => {
    // Update lazyload
    loadImages();
  },
};

listing.init();
