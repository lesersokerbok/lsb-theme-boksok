/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
      // Toggle archive description visibility
      $('.page-header button').click(function () {
        $(this).closest('.page-header').find('.description')
          .toggleClass('sr-only');
      });
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },

	// Books
  single_lsb_book: {

    init: function() {
      // JavaScript to be fired on a book page

      $('.read-more').each(function() {
        var $read_more= $(this);
        var $container = $read_more.parent();
        var $content = $container.find('.lsb-book-content').first();
        var $button = $read_more.find('.btn').first();
        var $closed_text = $button.html();
        var $opned_text = $button.data('open-text');
        $button.click(function() {
          $container.toggleClass('open');
          $read_more.toggleClass('open');
          $button.blur();

          if($container.hasClass('open')) {
            $button.html($opned_text);
          } else {
            $button.html($closed_text);
          }
        });

        if($container.height() >= $content.height() + $read_more.height()) {
          $button.addClass('hidden');
        }

      });

      $('.lsb-library-status').each(function() {
        $library_status = $(this);
        $library_select = $library_status.find('select').first();

        $library_select.change(function() {
          var selectedCounty = $(this).val();
          console.log("Selected", selectedCounty);
          if(selectedCounty == 'none') {
            $library_status.removeClass('open');
            $library_status.find('.lsb-county').removeClass('selected');
          } else {
            $library_status.addClass('open');
            $library_status.find('.lsb-county').removeClass('selected');
            $library_status.find('.lsb-county.' + selectedCounty).addClass('selected');
          }
        }); 

      });
    }
  },

  search: {
    init: function() {
      $('.lsb-facets-toggle').each(function() {
        var $button = $(this);
        var $facets = $('.lsb-facets').first();
        var $closed_text = $button.html();
        var $opned_text = $button.data('open-text');
        $button.click(function() {
          $facets.toggleClass('open');
          $button.blur();

          if($facets.hasClass('open')) {
            $button.html($opned_text);
          } else {
            $button.html($closed_text);
          }
        });
      });
    }
  },

  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
