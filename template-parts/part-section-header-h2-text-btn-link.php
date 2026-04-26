<?php 
$heading = $args['heading'] ?? null;
$text = $args['text'] ?? null;
$text_color = $args['text-color'] ?? null;

$className = '';
if ( $text_color == 'black' ) { 
	$className .= ' has-bith-onyx-color'; 
} else { 
	$className .= ' has-bith-white-color'; 
}

$link = $args['link'] ?? null;
$btn_classes = $args['btn-classes'] ?? null;
if($heading):?>
	<div class="section-header grid-x grid-padding-x align-middle">
		<?php if($heading || $text ):?>
			<div class="cell auto heading-text <?=$className;?>">
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
				)
			);
		};?>
	</div>
<?php endif;?>