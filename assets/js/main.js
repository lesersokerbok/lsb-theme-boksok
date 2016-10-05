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

      $('.search-form').each(function() {
        
        var $search_form = $(this);
        var $button_text = $search_form.find('.dropdown-toggle').first().find('span').first();
        var $dropdown_menu = $search_form.find('.dropdown-menu').first();
        var $search_filter = $search_form.find('.search-filter').first();
        algolia.autocomplete.filter = $search_filter.data('tax-term');

        $dropdown_menu.find('a').attr("href", "#");
        $dropdown_menu.find('a').click(function() {
          var filter = $(this).data('tax-term')
          algolia.autocomplete.filter = filter;
          if(filter) {
            $button_text.html(filter.term_label);
            $search_filter.val(filter.term_slug);
            $search_filter.attr('name', filter.taxonomy_name);  
            $search_form.attr('action', filter.url);
          } else {
            $button_text.html($(this).html());
          }
          
        });
      });

      // Hide scroll arrows when not needed
      var toggleScrollButtons = function($bookSectionScroll) {

        var scrollLeftPos = $bookSectionScroll.scrollLeft(),
            scrollWidth = $bookSectionScroll.get(0).scrollWidth,
            width = $bookSectionScroll.width();

        if(scrollLeftPos > 0) {
          $bookSectionScroll.siblings('.book-shelf-left-scroll').show();
        } else {
          $bookSectionScroll.siblings('.book-shelf-left-scroll').hide();
        }

        if(scrollWidth - scrollLeftPos > width) {
          $bookSectionScroll.siblings('.book-shelf-right-scroll').show();
        } else {
          $bookSectionScroll.siblings('.book-shelf-right-scroll').hide();
        }

      };

      $('.book-shelf-scroll').each(function() {
        toggleScrollButtons($(this));
      });

      $('.book-shelf-scroll').scroll(function() {
        toggleScrollButtons($(this));
      });

      // Respond to left scroll button click
      $('.book-shelf .book-shelf-left-scroll').click(function () {
        $(this).siblings('.book-shelf-scroll').animate({
          scrollLeft: "-=500px"
        }, 500);
      });

      // Respond to right scroll button click
      $('.book-shelf .book-shelf-right-scroll').click(function () {
        $(this).siblings('.book-shelf-scroll').animate({
          scrollLeft: "+=500px"
        }, 500);
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
        var $parent = $read_more.parent();
        var $button = $read_more.find('.btn').first();
        var $closed_text = $button.html();
        var $opned_text = $button.data('open-text');
        $button.click(function() {
          $parent.toggleClass('open');
          $read_more.toggleClass('open');
          $button.blur();

          if($parent.hasClass('open')) {
            $button.html($opned_text);
          } else {
            $button.html($closed_text);
          }
        });
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
