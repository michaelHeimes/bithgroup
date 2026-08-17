<?php
$card_version = $args['card_version'] ?? null;
$card_class = '';
if($card_version == 'row') {
	$card_class = ' type-row';
}
if($card_version == 'column-additional-links') {
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
		<div class="inner <?php if($page_link):?> has-link border-white-20<?php endif;?> <?=esc_attr($background_color);?>">
			<?php if($page_link && $card_version == 'row'):?>
				<a class="page-link" href="<?=esc_url($page_link);?>"
					<?php if($title):?>
						aria-label="Links to <?=wp_kses_post( $title );?> page"
					<?php endif;?>
					>
				</a>
			<?php endif;?>
			<?php if( $icon || $title || $additional_links || $text ):?>
				<div class="content has-bith-white-color">
					<div class="grid-container">
						<div class="flex-dir-control<?php if($card_version == 'row'):?> grid-x grid-padding-x<?php endif;?>">
							<?php if( $icon ):?>
								<div class="cell shrink icon">
									<div class="grid-x grid-padding-x align-middle">
										<div class="cell shrink">
											<?=wp_get_attachment_image( $icon['id'], 'full', false, array( 'class' => 'style-svg' ) );?>
										</div>
										
										<?php if($page_link && $card_version == 'row'):?>
											<div class="arrow-wrap cell auto hide-for-large" style="opacity: 0;">
												<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 24h28m0 0L24 10m14 14L24 38" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
											</div>
										<?php endif;?>
									</div>
								</div>
							<?php endif;?>
							<?php if( $title || $additional_links || $text ):?>
								<div class="cell small-12<?php if($card_version == 'row'):?> tablet-auto<?php endif;?> text-links<?php if($background_color == 'transparent') { echo ' has-underline-arrow-link'; };?>">
									<?php if($page_link):?>
										<div class="<?php if($card_version == 'row'):?>grid-x grid-padding-x align-middle<?php endif;?>">
									<?php endif;?>
									
										<?php if($page_link || $title || $text):?>
											<div class="cell<?php if($card_version == 'row'):?> auto<?php endif;?>">
										<?php endif;?>
										
											<?php if($title && $card_version == 'column-additional-links'):?>
												
												<h3 class="color-green-30 has-underline-arrow-link weight-500">
													<?php if($page_link):?>
														<a class="color-green-30" href="<?=esc_url($page_link);?>"
														<?php if($title):?>
											
															aria-label="Links to <?=wp_kses_post( $title );?> page"
														<?php endif;?>
													>
													<?php endif?>
														<?=wp_kses_post( $title );?>
													<?php if($page_link):?>
														</a>
													<?php endif?>
													
												</h3>
												
											<?php elseif( $title ):?>

												<h3 class="color-green-30 weight-500"><u><?=wp_kses_post( $title );?></u></h3>

											<?php endif;?>

											<?php if($additional_links): ?>
												<ul class="additional-links p-md menu vertical">
													<?php foreach($additional_links as $additional_link):
														$link = $additional_link['link'];
														if( $link ): 
															$link_url = $link['url'];
															$link_title = $link['title'];
															$link_target = $link['target'] ? $link['target'] : '_self';	
													?>
														<li class="has-underline-arrow-link">
															<img src="<?=get_template_directory_uri();?>/assets/svgs/additional-link-icon.svg" alt="icon for additional links">
															<a class="color-green-30" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
																<span><?php echo esc_html( $link_title ); ?></span>
															</a>
														</li>
													<?php endif; endforeach;?>
												</ul>
											<?php endif;?>
											

											<?php if($text):?>
												<div class="p-md m-0"><?=wp_kses_post( $text );?></div>
											<?php endif;?>
											
										<?php if($page_link || $title || $text):?>
											</div>
										<?php endif;?>
										
										<?php if($page_link && $card_version == 'row'):?>
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