<?php
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
	$bith_block_order = 0;
	$is_first_block = true;
} else {
	$bith_block_order++;
	$is_first_block = false;
}
$className = 'breadcrumbs';

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



?>

<div class="<?php echo esc_attr($className); ?>">
	<?php if ( $is_first_block ): ?>
		<div class="header-spacer"></div>
	<?php endif; ?>

	<div class="grid-container">
		<ul class="menu horizontal align-middle p-md">
			<li>
				<a class="home-link" href="<?= home_url(); ?>">
					<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path class="bg" d="M0 12C0 5.373 5.373 0 12 0h20c6.627 0 12 5.373 12 12v20c0 6.627-5.373 12-12 12H12C5.373 44 0 38.627 0 32z" fill="#184275"/><path class="house" d="M25 31v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8m-6-11a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 31 20v9a2 2 0 0 1-2 2H15a2 2 0 0 1-2-2z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</a>
			</li>

			<?php 
			$post_id = get_the_ID();
			$post_type = get_post_type($post_id);
			
			// 2nd LI Logic: Archive or Parent Page
			$parent_id = wp_get_post_parent_id($post_id);
			$post_type_obj = get_post_type_object($post_type);
			$has_archive = ($post_type_obj && $post_type_obj->has_archive);

			if ( $parent_id ) : 
				// Case 1: Has a parent page
				$parent_title = get_the_title($parent_id); ?>
				<li><a href="<?= get_permalink($parent_id); ?>"><?= esc_html($parent_title); ?></a></li>

			<?php elseif ( $has_archive || $post_type === 'post' ) : 
				// Case 2: Post type with archive (or default 'post')
				$archive_url = ($post_type === 'post') ? get_post_type_archive_link('post') : get_post_type_archive_link($post_type);
				$archive_title = ($post_type === 'post') ? 'Insights' : $post_type_obj->labels->name;
				
				if ( $archive_url ) : ?>
					<li><a href="<?= esc_url($archive_url); ?>"><?= esc_html($archive_title); ?></a></li>
				<?php endif; 
			endif; ?>

			<?php 
			// 3rd LI Logic: Current Title limited to 3 words
			$current_title = get_the_title($post_id);
			$short_title = wp_trim_words($current_title, 3, '...');
			?>
			<li><span><?= esc_html($short_title); ?></span></li>
		</ul>
	</div>
</div>
