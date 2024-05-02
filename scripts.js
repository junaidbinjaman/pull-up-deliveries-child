(function ($) {
  'use strict';

  /**
   * All of the code for public-facing JavaScript source
   * should reside in this file.
   *
   * This enables to define handlers, for when the DOM is ready:
   */
  $(function () {
    searchBarToggleHandler($);
  });
})(jQuery);

function searchBarToggleHandler($) {
  var searchBtn = $('.header-action-nav ul > li:nth-child(2)');
  var closeBtn = $('.header-action-nav ul > li:nth-child(3)');
  var searchContainer = $('.search-form-container');

  closeBtn.hide();

  searchBtn.on('click', function () {
    toggleHandler();
    console.log('d')
  });

  closeBtn.on('click', function () {
    toggleHandler();
  });

  function toggleHandler() {
    searchBtn.toggle();
    closeBtn.toggle();
    searchContainer.toggle();
  }
}
