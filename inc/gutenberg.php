<?php

add_theme_support( 'align-wide' );
add_theme_support( 'wp-block-styles' );
add_editor_style( 'style-editor.css' );
add_theme_support( 'responsive-embeds' );

function mytheme_setup() {
	// Remove all core WordPress patterns
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );
