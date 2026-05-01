<?php
/**
 * Section wrapper with Automatic Text Contrast
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
$className = 'content-section our-industries bg-transition-bith-blue';

$sh_heading = get_field('sh_heading') ?? null;
$sh_text = get_field('sh_text') ?? null;
$sh_button_link = get_field('sh_button_link') ?? null;

$navigation_cards = get_field('navigation_cards') ?? null;

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php if ( $is_first_block ): ?>
		<div class="header-spacer"></div>
	<?php endif; ?>

	<div class="grid-container">
		<?php get_template_part('template-parts/part', 'section-header-h2-text-btn-link',
			array(
				'heading' => $sh_heading,
				'text' => $sh_text,
				'text-color' => 'white',
				'link' => $sh_button_link,
				'btn-classes' => 'green-100 has-bith-onyx-color'
			),
		);?>
		<?php if($navigation_cards):?>
			<div class="industry-cards icon-link-text-card-swiper swiper-2-1-swipe">
				<div class="swiper-wrapper grid-x grid-padding-x small-up-1 medium-up-2 gap-y-32 negative-x">
					<?php foreach($navigation_cards as $navigation_card) {
						$page_link = $navigation_card['card']['page_link'] ?? null;
						$background_color = $navigation_card['card']['background_color'] ?? null;
						$icon = $navigation_card['card']['icon'] ?? null;
						$title = $navigation_card['card']['title'] ?? null;
						$text = $navigation_card['card']['text'] ?? null;
						get_template_part('template-parts/part', 'icon-link-text-card',
							array(
								'layout' => 'flex-dir-row',
								'background_color' => $background_color,
								'page_link' => $page_link,
								'icon' => $icon,
								'title' => $title,
								'text' => $text,
							),
						);
					};?>
				</div>
				<div class="swiper-scrollbar hide-for-medium"></div>
			</div>
		<?php endif;?>
		<?php if($sh_button_link) {
			get_template_part('template-parts/part', 'button-link',
				array(
					'link' => $sh_button_link,
					'container-classes' => 'small-12 medium-shrink hide-for-medium services-mobile-btn-wrap',
					'btn-classes' => 'green-100 has-bith-onyx-color wide-mw-btn',
				)
			);
		};?>
	</div>
</section>
