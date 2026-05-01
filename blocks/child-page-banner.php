<?php
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
	$bith_block_order = 0;
	$is_first_block = true;
} else {
	$bith_block_order++;
	$is_first_block = false;
}
$className = 'child-page-banner';

// Automatic Text Color Logic
$bg_color = $block['backgroundColor'] ?? '';
$gradient = $block['gradient'] ?? '';

// Background & Gradient Classes
if (!empty($block['backgroundColor'])) {
	$className .= ' has-' . $block['backgroundColor'] . '-background-color';
}
if (!empty($block['gradient'])) {
	$className .= ' has-' . $block['gradient'] . '-gradient-background';
}

// Define "Dark" backgrounds that should use White text
$dark_backgrounds = ['bith-onyx', 'bith-slate', 'bith-blue-100', 'bith-green-100', 'bith-blue'];

if ( in_array($bg_color, $dark_backgrounds) || in_array($gradient, $dark_backgrounds) ) {
	$className .= ' has-bith-white-color';
} else {
	$className .= ' has-bith-onyx-color';
}

// acf fields
$title = get_field('title') ?: get_the_title();
$text = get_field('text') ?? null;
$image = get_field('image') ?? null;

?>

<div class="<?php echo esc_attr($className); ?>">
	<?php if ( $is_first_block ): ?>
		<div class="header-spacer"></div>
	<?php endif; ?>

	<div class="grid-container">
		<dix class="grid-x grid-padding-x align-bottom align-justify tablet-flex-dir-row-reverse">
			<?php if($image):?>
				<div class="cell small-12 tablet-4">
					<div class="image-wrap">
						<?=wp_get_attachment_Image($image['id'], 'large');?>
					</div>
				</div>
			<?php endif;?>
			<div class="text cell small-12 tablet-8 large-7 d">
				<h1>
					<?=wp_kses_post( $title );?>
				</h1>
				<?php if($text):?>
					<p><?=wp_kses_post($text);?></p>
				<?php endif;?>
			</div>
		</dix>
	</div>
</div>
