<?php 
$text = $args['text'] ?? null;
$tag = $args['tag'] ?? null;
if($text):?>
	<<?=esc_attr($tag);?> class="pulse-eyebrow eyebrow display-block text-uppercase font-mono">
		<span class="pulse">
			<span class="pulse-dot"></span>
			<span class="pulse-spread"></span>
		</span>
		<?=wp_kses_post( $text );?>
	</<?=esc_attr($tag);?>>
<?php endif;?>