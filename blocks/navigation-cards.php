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
$className = 'content-section navigation-cards';

$bg_color = $block['backgroundColor'] ?? 'bith-slate'; 
$gradient = $block['gradient'] ?? '';

// Background & Gradient Classes
if (!empty($bg_color)) {
	$className .= ' has-' . $bg_color . '-background-color';
}
if (!empty($gradient)) {
	$className .= ' has-' . $gradient . '-gradient-background';
}

// Define "Dark" backgrounds that should use White text
$dark_backgrounds = ['bith-onyx', 'bith-slate', 'bith-blue-100', 'bith-green-100', 'bith-blue'];

if ( in_array($bg_color, $dark_backgrounds) || in_array($gradient, $dark_backgrounds) ) {
	$className .= ' has-bith-white-color';
} else {
	$className .= ' has-bith-onyx-color';
}

$sh_heading = get_field('sh_heading') ?? null;
$sh_text = get_field('sh_text') ?? null;
$sh_button_link = get_field('sh_button_link') ?? null;

if( $sh_heading || $sh_text || $sh_button_link ) {
	$className .= ' has-header';
}

$card_version = get_field('card_version');
$convert_to_slider_on_mobile_devices = get_field('convert_to_slider_on_mobile_devices') ?? null;
$cards = get_field('cards') ?? null;

$grid_class = 'small-up-1 medium-up-2';
if($card_version == 'column-additional-links' ) {
	$grid_class = 'small-up-1 medium-up-3'; 
}

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
		<?php if($cards):?>
			<div class="n-cards icon-link-text-card-swiper<?php if( $convert_to_slider_on_mobile_devices ):?> swiper-2-1-swipe<?php endif;?>">
				<div class="swiper-wrapper grid-x grid-padding-x <?=$grid_class;?> gap-y-32 negative-x">
					<?php foreach($cards as $card) {
						// var_dump($card);
						$page_link = $card['page_link'] ?? null;
						$background_color = $card['background_color'] ?? null;
						$icon = $card['icon'] ?? null;
						$title = $card['title'] ?? null;
						$additional_links = $card['additional_links'] ?? null;
						$text = $card['text'] ?? null;
						get_template_part('template-parts/part', 'icon-link-text-card',
							array(
								'card_version' => $card_version,
								'background_color' => $background_color,
								'page_link' => $page_link,
								'icon' => $icon,
								'title' => $title,
								'additional_links' => $additional_links,
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
					'btn-classes' => 'green-100 has-bith-onyx-color fw-wide-md-btn',
				)
			);
		};?>
	</div>
</section>
