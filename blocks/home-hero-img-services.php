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
$service_cards_heading = get_field('service_cards_heading') ?? null;
$service_cards_text = get_field('service_cards_text') ?? null;
$service_cards_button_link = get_field('service_cards_button_link') ?? null;
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
							'container-classes' => 'small-12',
							'btn-classes' => 'wide-mw-btn',
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
				<div class="section-header grid-x grid-padding-x align-middle">
					<?php if($service_cards_heading || $service_cards_text ):?>
						<div class="cell auto heading-text has-bith-onyx-color">
							<?php if($service_cards_heading):?>
								<h2>
									<?=wp_kses_post( $service_cards_heading );?>
								</h2>
							<?php endif;?>
							<?php if($service_cards_text):?>
								<p>
									<?=wp_kses_post( $service_cards_text);?>
								</p>
							<?php endif;?>
						</div>
					<?php endif;?>
					<?php if($service_cards_button_link) {
						get_template_part('template-parts/part', 'button-link',
							array(
								'link' => $service_cards_button_link,
								'container-classes' => 'small-12 medium-shrink show-for-medium',
								'btn-classes' => 'blue-100 has-bith-white-color',
							)
						);
					};?>
				</div>
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
										<div class="swiper-slide">
											<a href="<?=esc_url($service_page );?>" class="has-bith-onyx-color">
												<?php if($icon):?>
													<div class="icon-wrap text-center">
														<?=wp_get_attachment_image( $icon['id'], 'full' );?>
													</div>
												<?php endif;?>
												<?php if($service_name):?>
													<div class="grid-x gap-x">
														<div class="cell auto">
															<h3><?=wp_kses_post($service_name);?></h3>
														</div>
														<div class="cell shrink">
															<img src="<?=get_template_directory_uri();?>/assets/svgs/service-card-arrow-icon.svg"/>
														</div>
													</div>
												<?php endif;?>
												<?php if($service_description):?>
													<div class="description">
														<p class="md-p"><?=wp_kses_post($service_description);?></p>
													</div>
												<?php endif;?>
											</a>
										</div>
									<?php endif; endforeach;?>
								</div>
								<div class="swiper-scrollbar"></div>

							</div>
						</div>
					</div>
				<?php endif;?>
				<?php if($service_cards_button_link) {
					get_template_part('template-parts/part', 'button-link',
						array(
							'link' => $service_cards_button_link,
							'container-classes' => 'small-12 medium-shrink hide-for-medium services-mobile-btn-wrap',
							'btn-classes' => 'blue-100 has-bith-white-color wide-mw-btn',
						)
					);
				};?>
			</div>
		<?php endif;?>
	</div>
	<?php endif;?>
</section>