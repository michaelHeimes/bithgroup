<?php 
$link = $args['link'] ?? null;
$container_classes = $args['container-classes'] ?? null;
$btn_classes = $args['btn-classes'] ?? null;

if($link):
	$link_url = $link['url'];
	$link_title = $link['title'];
	$link_target = $link['target'] ? $link['target'] : '_self';
?>
	<div class="cell <?=$container_classes;?> btn-wrap text-center">
		<a class="button position-relative <?=$btn_classes;?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
			<span class="position-relative z-1"><?php echo esc_html( $link_title ); ?></span>
		</a>
	</div>
<?php endif;?>