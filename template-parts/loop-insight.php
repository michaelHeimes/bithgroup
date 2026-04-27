<?php $post_id = get_the_ID();?>

<article id="post-<?php the_ID(); ?>" <?php post_class('loop-insight slide-1 swiper-slide'); ?>>
	<div class="grid-x grid-padding-x align-middle">
		<?php if ( has_post_thumbnail() ) :?>
		<div class="thumb-wrap cell small-12 medium-3 large-4">
			<div class="img-wrap position-relative">
				<?=get_the_post_thumbnail( $post_id, 'large' );?>
			</div>
		</div>
		<?php endif;?>
		<div class="cell auto">
			<h3 class="weight-500"><?php the_title();?></h3>
			<p class="post-date p-sm"><?php echo get_the_date('F j, Y'); ?></p>
			<p class="p-md"><?php the_excerpt();?></p>
			<a class="display-block p-md underline-arrow-link weight-500" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'trailhead' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				Read More
			</a>
		</div>
	</div>
	
</article>
