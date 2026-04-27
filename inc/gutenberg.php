<?php

add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'responsive-embeds' );

function mytheme_setup() {
	// Remove all core WordPress patterns
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );

/**
 * Wrap Gutenberg Button text in a span
 */
add_filter('render_block', function($block_content, $block) {
	// Only target the core button block
	if ($block['blockName'] === 'core/button') {
		
		// Find the text between the <a> tags and wrap it in a <span>
		// This targets the inner text of the button link
		$block_content = preg_replace(
			'/(<a.*?>)(.*?)(<\/a>)/is', 
			'$1<span class="position-relative">$2</span>$3', 
			$block_content
		);
	}
	
	return $block_content;
}, 10, 2);

