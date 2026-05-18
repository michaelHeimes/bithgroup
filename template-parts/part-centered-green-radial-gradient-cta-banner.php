<?php
$is_first_block = $args['is_first_block'] ?? null;
$class_name = $args['class_name'] ?? null;
$pulse_eyebrow = $args['pulse_eyebrow'] ?? null;
$eyebrow_tag = $args['eyebrow_tag'] ?? null;
$title = $args['title'] ?? null;
$title_tag = $args['title_tag'] ?? 'p';
$button_link = $args['button_link'] ?? null;
if( $pulse_eyebrow || $title || $button_link ):
?>
<section class="<?php echo esc_attr($class_name); ?>">
	<?php if ( $is_first_block ): ?>
		<div class="header-spacer"></div>
	<?php endif; ?>

	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 medium-10 large-8 text-center">
				<?php if($pulse_eyebrow):?>
					<div class="eyebrow-wrap">
						<?php get_template_part('template-parts/part', 'pulse-eyebrow',
							array(
								'text' => $pulse_eyebrow,
								'tag' => $eyebrow_tag,
							),
						);?>
					</div>
				<?php endif;?>
				<div class="text">
					<<?=esc_attr($title_tag);?> class="h2">
						<?=wp_kses_post( $title );?>
					</<?=esc_attr($title_tag);?>>
				</div>
				<?php if($button_link):
					$link = $button_link; 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';	
				?>
					<div class="wp-block-buttons">
						<a class="button position-relative blue-100 has-bith-white-color" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
							<span class="position-relative">
								<?php echo esc_html( $link_title ); ?>
							</span>
						</a>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>

</section>
<?php endif;?>