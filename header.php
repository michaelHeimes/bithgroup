<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */
 
// Define the blocks that trigger the special header class
$forced_dark_blocks = [
    'acf/home-hero-img-services',
    'acf/our-industries',
    'acf/explore-more-posts-cards',
    'acf/services-page-hero',
];

$all_blocks = parse_blocks( get_the_content() );

// Filter out blocks that have no name (usually whitespace/newlines)
$filtered_blocks = array_filter( $all_blocks, function( $block ) {
    return ! empty( $block['blockName'] );
});

// Re-index the array so the first real block is at [0]
$filtered_blocks = array_values( $filtered_blocks );

// Now safely get the first block
$first_block = ! empty( $filtered_blocks ) ? $filtered_blocks[0] : null;

// 2. Define colors/gradients that trigger a white header
$dark_slugs = ['bith-onyx', 'bith-slate', 'bith-blue-100', 'bith-green-100', 'bith-blue'];

$header_class = ' has-bith-blue-color'; // Default

if ( $first_block ) {
    $block_name = $first_block['blockName'];
    $block_bg   = $first_block['attrs']['backgroundColor'] ?? '';
    $block_grad = $first_block['attrs']['gradient'] ?? '';

    // Check Conditions:
    // Is it a forced block? OR Is the background dark? OR Is the gradient dark?
    if ( 
        in_array($block_name, $forced_dark_blocks) || 
        in_array($block_bg, $dark_slugs) || 
        in_array($block_grad, $dark_slugs) 
    ) {
        $header_class = ' has-bith-white-color';
    }
}

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'trailhead' ); ?></a>
	
			<header class="site-header<?=esc_attr( $header_class );?>" role="banner" data-sticky data-margin-top="0" data-sticky-on="small">
				<?php get_template_part( 'template-parts/nav', 'offcanvas-topbar' ); ?>
			</header><!-- #masthead -->
			
			<div class="off-canvas-wrapper">
			
			<!-- Load off-canvas container. Feel free to remove if not using. -->			
			<?php get_template_part( 'template-parts/content', 'offcanvas' ); ?>
			
				<div class="off-canvas-content" data-off-canvas-content>
					<div id="page" class="site">
