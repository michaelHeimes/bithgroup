<?php $post_id = get_the_ID();?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-x grid-padding-x align-middle">
		<?php if ( has_post_thumbnail() ) :?>
		<div class="img-wrap cell small-12 medium-4 large-3">
			<?=get_the_post_thumbnail( $post_id, 'large' );?>
		</div>
		<?php endif;?>
		<div class="cell auto">
			<h3><?php the_title();?></h3>
		</div>
	</div>
	
</article>
