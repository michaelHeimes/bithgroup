<?php
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
	$bith_block_order = 0;
	$is_first_block = true;
} else {
	$bith_block_order++;
	$is_first_block = false;
}
$class_name = 'centered-green-radial-gradient-cta-banner content-section custom-section-pattern has-bith-radial-gradient-background has-bith-onyx-color';

// acf fields
$use_global_values = get_field('use_global_values');
$pulse_eyebrow = get_field($use_global_values ? 'ccrg_pulse_eyebrow' : 'pulse_eyebrow', $use_global_values ? 'option' : null) ?? null;
$eyebrow_tag   = get_field($use_global_values ? 'ccrg_eyebrow_tag'   : 'eyebrow_tag',   $use_global_values ? 'option' : null) ?? null;
$title         = get_field($use_global_values ? 'ccrg_title'         : 'title',         $use_global_values ? 'option' : null) ?? null;
$title_tag     = get_field($use_global_values ? 'ccrg_title_tag'     : 'title_tag',     $use_global_values ? 'option' : null) ?? null;
$button_link   = get_field($use_global_values ? 'ccrg_button_link'   : 'button_link',   $use_global_values ? 'option' : null) ?? null;

get_template_part('template-parts/part', 'centered-green-radial-gradient-cta-banner',
	array(
		'is_first_block' => $is_first_block,
		'class_name' => $class_name,
		'pulse_eyebrow' => $pulse_eyebrow,
		'eyebrow_tag'   => $eyebrow_tag,
		'title'         => $title,
		'title_tag'     => $title_tag,
		'button_link'   => $button_link,
	)
);

?>