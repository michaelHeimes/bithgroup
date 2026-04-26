<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
?>

<div class="off-canvas position-top" id="off-canvas" data-off-canvas>
	<div class="header-spacer"></div>
	<div class="inner">
	
		<?php trailhead_top_nav(); ?>
				
	</div>

	<?php if ( is_active_sidebar( 'offcanvas' ) ) : ?>

		<?php dynamic_sidebar( 'offcanvas' ); ?>

	<?php endif; ?>

</div>
