// Core
import 'foundation-sites/js/foundation.core.js';

// What Input
import 'what-input';

// Foundation Utilities
import 'foundation-sites/js/foundation.util.box.js';
// import 'foundation-sites/js/foundation.util.imageLoader.js';
import 'foundation-sites/js/foundation.util.keyboard.js';
import 'foundation-sites/js/foundation.util.mediaQuery.js';
// import 'foundation-sites/js/foundation.util.motion.js';
import 'foundation-sites/js/foundation.util.nest.js';
// import 'foundation-sites/js/foundation.util.timer.js';
import 'foundation-sites/js/foundation.util.touch.js';
import 'foundation-sites/js/foundation.util.triggers.js';

// JS Form Validation
// import 'foundation-sites/js/foundation.abide.js';

// Tabs UI
// import 'foundation-sites/js/foundation.tabs.js';

// Accordion
// import 'foundation-sites/js/foundation.accordion.js';
// import 'foundation-sites/js/foundation.accordionMenu.js';
// import 'foundation-sites/js/foundation.responsiveAccordionTabs.js';

// Menu Enhancements
// import 'foundation-sites/js/foundation.drilldown.js';
// import 'foundation-sites/js/foundation.dropdown.js';
// import 'foundation-sites/js/foundation.dropdownMenu.js';
// import 'foundation-sites/js/foundation.responsiveMenu.js';
// import 'foundation-sites/js/foundation.responsiveToggle.js';

// Equalize Heights
// import 'foundation-sites/js/foundation.equalizer.js';

// Responsive Images
// import 'foundation-sites/js/foundation.interchange.js';

// Navigation Widget
// import 'foundation-sites/js/foundation.magellan.js';

// Offcanvas Navigation Option
import 'foundation-sites/js/foundation.offcanvas.js';

// Carousel (don't ever use)
// import 'foundation-sites/js/foundation.orbit.js';

// Modals
// import 'foundation-sites/js/foundation.reveal.js';

// Form UI element
// import 'foundation-sites/js/foundation.slider.js';

// Anchor Link Scrolling
import 'foundation-sites/js/foundation.smoothScroll.js';

// Sticky Elements
// import 'foundation-sites/js/foundation.sticky.js';

// On/Off UI Switching
// import 'foundation-sites/js/foundation.toggler.js';

// Tooltips
// import 'foundation-sites/js/foundation.tooltip.js';

// Swiper
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';


import $ from 'jquery';
import 'foundation-sites';

// Import modules
import foundationInit from './modules/foundation-init.js';
import emptyParentLinks from './modules/empty-parent-links.js';
import fixedNavHack from './modules/fixed-nav-hack.js';
// import displayOnLoad from './modules/display-on-load.js';
// import scrollToAnchor from './modules/scroll-to-anchor.js';
// import mobileTakeoverNav from './modules/mobile-takeover-nav.js';

(function($) {
  'use strict';

  const init = () => {
    foundationInit();
    emptyParentLinks();
    fixedNavHack();
    // displayOnLoad();
    // scrollToAnchor();
    // mobileTakeoverNav(); // Uncomment if used
  };

  $(init);
})(jQuery);