<?php
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
	$bith_block_order = 0;
	$is_first_block = true;
} else {
	$bith_block_order++;
	$is_first_block = false;
}
$className = 'services-page-hero';

$bg_color = $block['backgroundColor'] ?? 'bith-blue-10'; 
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

// acf fields
$pulse_eyebrow = get_field('pulse_eyebrow') ?: get_the_title();
$title = get_field('title') ?: get_the_title();
$text = get_field('text') ?? null;
$image = get_field('image') ?? null;

?>

<div class="services-page-hero has-bith-blue-gradient-background has-bith-white-color has-bg">
	<div class="bg" style="background-image: url('<?=get_template_directory_uri();?>/assets/svgs/service-hero-bg-pattern.svg')"></div>
	<?php if ( $is_first_block ): ?>
		<div class="header-spacer"></div>
	<?php endif; ?>

	<div class="grid-container position-relative z-1">
		<div class="breadcrumbs home-link-only-breadcrumb color-green-60 position-relative z-1">
			<ul class="menu horizontal align-middle p-md">
				<li class="home-link-wrap">
					<a class="color-green-60" href="<?=get_home_url();?>">
						Back to home
					</a>
				</li>
			</ul>
		</div>
		<div class="grid-x grid-padding-x align-bottom align-justify tablet-flex-dir-row-reverse">
			<?php if($image):?>
				<div class="cell small-12 tablet-4">
					<div class="image-wrap">
						<?=wp_get_attachment_image($image['id'], 'large');?>
					</div>
				</div>
			<?php endif;?>
			<div class="text cell small-12 tablet-8 large-7">
				<?php if($pulse_eyebrow):?>
					<div class="eyebrow-wrap">
						<?php get_template_part('template-parts/part', 'pulse-eyebrow',
							array(
								'text' => $pulse_eyebrow,
								'tag' => 'span',
							),
						);?>
					</div>
				<?php endif;?>
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