<?php
/**
 * Pule Eyebrow block
 */
 
$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$className = 'content-section insights';

$text = get_field('text') ?? null;
$tag = get_field('tag') ?? null;

get_template_part('template-parts/part', 'pulse-eyebrow',
	array(
		'text' => $text,
		'tag' => $tag
	),
);