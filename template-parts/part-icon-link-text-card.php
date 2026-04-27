<?php
$layout = $args['layout'] ?? null;
$card_class = '';
if($layout == 'flex-dir-row') {
	$card_class = ' type-row';
}
if($layout == 'flex-dir-column') {
	$card_class = ' type-col';
}
$background_color = $args['background_color'] ?? null;
$page_link = $args['page_link'] ?? null;
$icon = $args['icon'] ?? null;
$title = $args['title'] ?? null;
$additional_links = $args['additional_links'] ?? null;
$text = $args['text'] ?? null;

if( $page_link || $icon || $title || $additional_links || $text ):?>
	<div class="cell slide-2-1 icon-link-text-card position-relative<?=$card_class;?>">
		<div class="inner <?php if($page_link):?> has-link<?php endif;?> <?=esc_attr($background_color);?>">
			<?php if($page_link):?>
				<a class="page-link" href="<?=esc_url($page_link);?>"
					<?php if($title):?>
						ara-label="Links to <?=wp_kses_post( $title );?> page"
					<?php endif;?>
					>
				</a>
			<?php endif;?>
			<?php if( $icon || $title || $additional_links || $text ):?>
				<div class="content has-bith-white-color">
					<div class="grid-container">
						<div class="grid-x grid-padding-x <?=esc_html( $layout );?>">
							<?php if( $icon ):?>
								<div class="cell shrink icon">
									<div class="grid-x grid-padding-x align-middle">
										<?php if($page_link):?>
											<div class="cell shrink">
										<?php endif;?>
										<?=wp_get_attachment_image( $icon['id'], 'full', false, array( 'class' => 'style-svg' ) );?>
										<?php if($page_link):?>
											</div>
										<?php endif;?>
										<?php if($page_link):?>
											<div class="arrow-wrap cell auto hide-for-large" style="opacity: 0;">
												<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 24h28m0 0L24 10m14 14L24 38" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</div>
										<?php endif;?>
									</div>
								</div>
							<?php endif;?>
							<?php if( $title || $additional_links || $text ):?>
								<div class="cell small-12 tablet-auto text-links">
									<?php if($page_link):?>
										<div class="grid-x grid-padding-x align-middle">
									<?php endif;?>
										<?php if($page_link || $title || $text):?>
											<div class="cell auto">
										<?php endif;?>
											<?php if($title):?>
												<h3 class="color-green-30"><u><?=wp_kses_post( $title );?></u></h3>
											<?php endif;?>
											<?php if($text):?>
												<div class="p-md m-0"><?=wp_kses_post( $text );?></div>
											<?php endif;?>
										<?php if($page_link || $title || $text):?>
											</div>
										<?php endif;?>
										<?php if($page_link):?>
											<div class="arrow-wrap cell shrink show-for-large" style="opacity: 0;">
												<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 24h28m0 0L24 10m14 14L24 38" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</div>
										<?php endif;?>
									<?php if($page_link):?>
										</div>
									<?php endif;?>
								</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>
<?php endif;?>