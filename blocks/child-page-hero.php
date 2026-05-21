<?php
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
	$bith_block_order = 0;
	$is_first_block = true;
} else {
	$bith_block_order++;
	$is_first_block = false;
}
$class_name = 'child-page-hero';

$bg_color = $block['backgroundColor'] ?? 'bith-blue-10'; 
$gradient = $block['gradient'] ?? '';

// Background & Gradient Classes
if (!empty($bg_color)) {
	$class_name .= ' has-' . $bg_color . '-background-color';
}
if (!empty($gradient)) {
	$class_name .= ' has-' . $gradient . '-gradient-background';
}

// Define "Dark" backgrounds that should use White text
$dark_backgrounds = ['bith-onyx', 'bith-slate', 'bith-blue-100', 'bith-green-100', 'bith-blue'];

if ( in_array($bg_color, $dark_backgrounds) || in_array($gradient, $dark_backgrounds) ) {
	$class_name .= ' has-bith-white-color';
} else {
	$class_name .= ' has-bith-onyx-color';
}

// acf fields
$title = get_field('title') ?: get_the_title();
$text = get_field('text') ?? null;
$image = get_field('image') ?? null;

?>

<div class="<?php echo esc_attr($class_name); ?>">
	<?php if ( $is_first_block ): ?>
		<div class="header-spacer"></div>
	<?php endif; ?>

	<div class="grid-container">
		<div class="grid-x grid-padding-x align-bottom align-justify tablet-flex-dir-row-reverse">
			<?php if($image):?>
				<div class="cell small-12 tablet-4">
					<div class="image-wrap">
						<?=wp_get_attachment_image($image['id'], 'large');?>
					</div>
				</div>
			<?php endif;?>
			<div class="text cell small-12 tablet-8 large-7">
				<h1>
					<?=wp_kses_post( $title );?>
				</h1>
				<?php if($text):?>
					<p><?=wp_kses_post($text);?></p>
				<?php endif;?>
			</div>
		</div> <!-- Fixed HTML Typo here: changed </dix> to </div> -->
	</div>
</div>