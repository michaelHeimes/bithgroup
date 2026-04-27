<?php
/**
 * Home Hero, Image, and Services
 */
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
	$bith_block_order = 0;
	$is_first_block = true;
} else {
	$bith_block_order++;
	$is_first_block = false;
}

$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$className = 'home-hero-img-services';

// ACF Fields
$background_logo = get_field('background_logo') ?? null;
$eyebrow = get_field('eyebrow') ?? null;
$heading = get_field('heading') ?? null;
$copy = get_field('copy') ?? null;
$button_link = get_field('button_link') ?? null;
$image = get_field('image') ?? null;
$service_cards_heading = get_field('sh_heading') ?? null;
$service_cards_text = get_field('sh_text') ?? null;
$service_cards_button_link = get_field('sh_button_link') ?? null;
$service_cards = get_field('service_cards') ?? null;

?>

<section id="<?php echo esc_attr($id); ?>" class="has-bith-white-color <?php echo esc_attr($className); ?>">
	<?php if( $background_logo || $eyebrow || $heading_copy || $button_link ):?>
	<div class="hero bg-bith-blue-100 has-bg">
		<?php if ( $is_first_block ):?>
			<div class="header-spacer"></div>
		<?php endif;?>
		<?php if($background_logo) :?>
			<div class="bg" style="background-image: url(<?=esc_url($background_logo['url']);?>);"></div>
		<?php endif;?>
		<div class="grid-container position-relative z-1">
			<div class="grid-x grid-padding-x align-center">
				<?php if( $eyebrow ) : ?>
					<div class="copy cell small-12 tablet-8 large-6">
						<?php get_template_part( 'template-parts/part', 'pulse-eyebrow', [
							'text' => $eyebrow,
							'tag'  => 'span',
						] ); ?>
					</div>
				<?php endif; ?>

				<?php if($heading):?>
					<div class="heading cell small-12 large-10 text-center">
						<h1><?=wp_kses_post( $heading );?></h1>
					</div>
				<?php endif;?>
				<?php if($copy):?>
					<div class="copy cell small-12 tablet-8 large-6 text-center">
						<?=wp_kses_post( $copy );?>
					</div>
				<?php endif;?>
				<?php if($button_link) {
					get_template_part('template-parts/part', 'button-link',
						array(
							'link' => $button_link,
							'container-classes' => 'small-12 text-center',
							'btn-classes' => 'wide-mw-btn green-100',
						)
					);
				};?>
			</div>
		</div>
	</div>
	<?php endif;?>
	<?php if($image || $service_cards_heading || $service_cards_text || $service_cards_button_link || $service_cards):?>
	<div class="hero-gradient-section position-relative has-bg bg-bith-blue-100">
		<div class="hero-gradient bg"></div>
		<?php if($image):?>
			<div class="image position-relative z-1">
				<div class="grid-container">
					<?=wp_get_attachment_image( $image['id'], 'full' );?>
				</div>
			</div>
		<?php endif;?>
		<?php if($service_cards_heading || $service_cards_text || $service_cards_button_link || $service_cards):?>
			<div class="services grid-container position-relative">
				<?php get_template_part('template-parts/part', 'section-header-h2-text-btn-link',
					array(
						'heading' => $service_cards_heading,
						'text' => $service_cards_text,
						'text-color' => 'black',
						'link' => $service_cards_button_link,
						'btn-classes' => 'has-bith-onyx-color green-100'
					),
				);?>
				<?php if($service_cards):?>
					<div class="services-slider">
						<div class="inner">
							<div class="swiper swiper-3-2-1">
								<div class="swiper-wrapper">
									<?php foreach($service_cards as $service_card):
										$icon = $service_card['icon'] ?? null;
										$service_name = $service_card['service_name'] ?? null;
										$service_description = $service_card['service_description'] ?? null;
										$service_page = $service_card['service_page'] ?? null;
										if($service_page || $service_name):
									?>
										<div class="swiper-slide has-bith-onyx-color d-flex flex-dir-column">
											<a href="<?=esc_url($service_page );?>" class="display-block border-black-30">											</a>
											<?php if($icon):?>
												<div class="icon-wrap grid-x align-middle align-center position-relative overflow-hidden">
													<?=wp_get_attachment_image( $icon['id'], 'full', false, array( 'class' => 'style-svg position-relative z-1' ) );?>
												</div>
											<?php endif;?>
											<?php if($service_name):?>
												<div class="grid-x gap-x position-relative">
													<div class="cell auto">
														<h3 class="weight-500"><?=wp_kses_post($service_name);?></h3>
													</div>
													<div class="cell shrink">
														<img class="service-card-arrow-icon" src="<?=get_template_directory_uri();?>/assets/svgs/service-card-arrow-icon.svg" alt="arrow icon"/>
													</div>
												</div>
											<?php endif;?>
											<?php if($service_description):?>
												<div class="description position-relative">
													<p class="md-p"><?=wp_kses_post($service_description);?></p>
												</div>
											<?php endif;?>
										</div>
									<?php endif; endforeach;?>
								</div>
								<div class="swiper-scrollbar has-overflowing-slides"></div>
							</div>
						</div>
					</div>
				<?php endif;?>
				<?php if($service_cards_button_link) {
					get_template_part('template-parts/part', 'button-link',
						array(
							'link' => $service_cards_button_link,
							'container-classes' => 'small-12 medium-shrink hide-for-medium services-mobile-btn-wrap',
							'btn-classes' => 'has-bith-white-color wide-mw-btn',
						)
					);
				};?>
			</div>
		<?php endif;?>
	</div>
	<?php endif;?>
</section>