import $ from 'jquery';

export default function fixedNavHack() {
	$('.off-canvas').on('opened.zf.offCanvas', function() {
		$('header.site-header').addClass('off-canvas-content is-open-right has-transition-push');
		$('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').addClass('clicked');
	});
	
	$('.off-canvas').on('close.zf.offCanvas', function() {
		$('header.site-header').removeClass('off-canvas-content is-open-right has-transition-push');
		$('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
	});
	
	$(window).on('resize', function() {
		if ($(window).width() > 1023) {
		$('.off-canvas').foundation('close');
		$('header.site-header').removeClass('off-canvas-content has-transition-push');
		$('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
		}
	});
}