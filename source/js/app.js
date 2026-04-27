import $ from 'jquery';
import { Foundation } from 'foundation-sites/js/foundation.core';

// --- Utilities ---
import { Box } from 'foundation-sites/js/foundation.util.box';
import { Keyboard } from 'foundation-sites/js/foundation.util.keyboard';
import { MediaQuery } from 'foundation-sites/js/foundation.util.mediaQuery';
import { Nest } from 'foundation-sites/js/foundation.util.nest';
import { Touch } from 'foundation-sites/js/foundation.util.touch';
import { Triggers } from 'foundation-sites/js/foundation.util.triggers';
// import { ImageLoader } from 'foundation-sites/js/foundation.util.imageLoader';
// import { Motion } from 'foundation-sites/js/foundation.util.motion';
// import { Timer } from 'foundation-sites/js/foundation.util.timer';

// --- Plugins ---
import { OffCanvas } from 'foundation-sites/js/foundation.offcanvas';
import { SmoothScroll } from 'foundation-sites/js/foundation.smoothScroll';
import { DropdownMenu } from 'foundation-sites/js/foundation.dropdownMenu';
import { AccordionMenu } from 'foundation-sites/js/foundation.accordionMenu';
import { ResponsiveMenu } from 'foundation-sites/js/foundation.responsiveMenu';
// import { Abide } from 'foundation-sites/js/foundation.abide';
// import { Accordion } from 'foundation-sites/js/foundation.accordion';
// import { Drilldown } from 'foundation-sites/js/foundation.drilldown';
// import { Dropdown } from 'foundation-sites/js/foundation.dropdown';
// import { Equalizer } from 'foundation-sites/js/foundation.equalizer';
// import { Interchange } from 'foundation-sites/js/foundation.interchange';
// import { Magellan } from 'foundation-sites/js/foundation.magellan';
// import { Orbit } from 'foundation-sites/js/foundation.orbit';
// import { Reveal } from 'foundation-sites/js/foundation.reveal';
// import { Slider } from 'foundation-sites/js/foundation.slider';
// import { Sticky } from 'foundation-sites/js/foundation.sticky';
// import { Tabs } from 'foundation-sites/js/foundation.tabs';
// import { Toggler } from 'foundation-sites/js/foundation.toggler';
// import { Tooltip } from 'foundation-sites/js/foundation.tooltip';
// import { ResponsiveAccordionTabs } from 'foundation-sites/js/foundation.responsiveAccordionTabs';
// import { ResponsiveToggle } from 'foundation-sites/js/foundation.responsiveToggle';

// --- Third Party & Modules ---
import 'what-input';

import hasScrolled from './modules/has-scrolled.js';
import offCanvasModifications from './modules/off-canvas-modifications.js';
import headerHeight from './modules/header-height.js';
import init1Sliders from './modules/swiper-1.js';
import init21Sliders from './modules/swiper-2-1.js';
import init321Sliders from './modules/swiper-3-2-1.js';
import swiperOneArrowDots from './modules/swiper-1-arrow-dots.js';

// ---------------------------------------------------------
// 2. REGISTRATION & GLOBALS
// ---------------------------------------------------------

// Use the existing WordPress jQuery if available, otherwise fallback to the import
const jQueryInstance = window.jQuery || $;

// Attach Foundation to the "Official" jQuery
Foundation.addToJquery(jQueryInstance);

// Add Utilities to Foundation Object
Foundation.Box = Box;
Foundation.Keyboard = Keyboard;
Foundation.MediaQuery = MediaQuery;
Foundation.Nest = Nest;
Foundation.Touch = Touch;
Foundation.Triggers = Triggers;

// Register Active Plugins
Foundation.plugin(OffCanvas, 'OffCanvas');
Foundation.plugin(SmoothScroll, 'SmoothScroll');
Foundation.plugin(DropdownMenu, 'DropdownMenu');
Foundation.plugin(AccordionMenu, 'AccordionMenu');
Foundation.plugin(ResponsiveMenu, 'ResponsiveMenu');

// --- Inactive Plugin Registrations ---
// Foundation.plugin(Abide, 'Abide');
// Foundation.plugin(Accordion, 'Accordion');
// Foundation.plugin(Drilldown, 'Drilldown');
// Foundation.plugin(Dropdown, 'Dropdown');
// Foundation.plugin(Equalizer, 'Equalizer');
// Foundation.plugin(Interchange, 'Interchange');
// Foundation.plugin(Magellan, 'Magellan');
// Foundation.plugin(Orbit, 'Orbit');
// Foundation.plugin(Reveal, 'Reveal');
// Foundation.plugin(Slider, 'Slider');
// Foundation.plugin(Sticky, 'Sticky');
// Foundation.plugin(Tabs, 'Tabs');
// Foundation.plugin(Toggler, 'Toggler');
// Foundation.plugin(Tooltip, 'Tooltip');
// Foundation.plugin(ResponsiveAccordionTabs, 'ResponsiveAccordionTabs');
// Foundation.plugin(ResponsiveToggle, 'ResponsiveToggle');

// ---------------------------------------------------------
// 3. INITIALIZATION
// ---------------------------------------------------------


$(function() {
    'use strict';
        
    MediaQuery._init();
    
    // Check if we are in the WordPress Editor
    const isEditor = $('body').hasClass('block-editor-page') || $('body').hasClass('wp-admin');
    
    if (!isEditor) {
        Triggers.init($, Foundation);
    }
    
    $(document).foundation();    
    hasScrolled();
    offCanvasModifications();
    headerHeight();
    init1Sliders();
    init21Sliders();
    init321Sliders();
    swiperOneArrowDots();
});
