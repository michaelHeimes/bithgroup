<?php 
$heading = $args['heading'] ?? null;
$text = $args['text'] ?? null;
$text_color = $args['text-color'] ?? null;

$class_name = '';
$btn_style = '';
if ( $text_color == 'black' ) { 
	$class_name .= ' has-bith-onyx-color'; 
	$btn_style .= ' is-style-blue-100';
} else { 
	$class_name .= ' has-bith-white-color'; 
	$btn_style .= ' is-style-green-100';
}

$link = $args['link'] ?? null;
$btn_classes = $args['btn-classes'] ?? null;
if($heading || $text || $link ):?>
	<div class="section-header grid-x position-relative z-1 align-center">
		<div class="small-12 large-10">
			<div class="grid-x grid-padding-x align-middle">
				<?php if($heading || $text ):?>
					<div class="cell auto heading-text <?=$class_name;?>">
						<?php if($heading):?>
							<h2>
								<?=wp_kses_post( $heading );?>
							</h2>
						<?php endif;?>
						<?php if($text):?>
							<p>
								<?=wp_kses_post( $text);?>
							</p>
						<?php endif;?>
					</div>
				<?php endif;?>
				<?php if($link) {
					get_template_part('template-parts/part', 'button-link',
						array(
							'link' => $link,
							'container-classes' => 'small-12 medium-shrink show-for-medium',
							'btn-classes' => $btn_classes,
							'btn-style' => $btn_style,
						)
					);
				};?>
			</div>
		</div>
	</div>
<?php endif;?>