<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */
$footer_logo = get_field('footer_logo', 'option') ?? null;
$footer_address = get_field('footer_address', 'option') ?? null;
$contact_methods = get_field('contact_methods', 'option') ?? null;
$copyright_text = get_field('copyright_text', 'option') ?? null;
$subfooter_links = get_field('subfooter_links', 'option') ?? null;
$footer_cta = get_field('footer_cta', 'option') ?? null;

?>

				<footer id="colophon" class="site-footer bg-transition-bith-blue has-bg has-bith-white-color">
					<div class="bg" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/svgs/footer-pattern.svg');"></div>
					<div class="footer-main position-relative">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="cell small-12 medium-8 tablet-6">
									<?php if($footer_logo):?>
										<div class="logo-wrap">
											<?=wp_get_attachment_image( $footer_logo['id'], 'full' );?>
										</div>
									<?php endif;?>
									<?php if($footer_address):?>
										<div class="address">
											<?=wp_kses_post( $footer_address );?>
										</div>
									<?php endif;?>
									<?php if($contact_methods):?>
										<div class="contact-methods">
											<ul class="menu vertical">
												<?php foreach($contact_methods as $contact_method):
													$icon = $contact_method['icon'] ?? null;	
													$text = $contact_method['text'] ?? null;	
													$link = $contact_method['link'] ?? null;	
												?>
													<li class="p-md">
														<?php if($icon):?>
															<span>
																&nbsp;<?=wp_get_attachment_image($icon['id'], 'full');?>
															</span>
														<?php endif;?>
														<?php if($text):?>
															<span>
																&nbsp;<?=wp_kses_post($text);?>
															</span>
														<?php endif;?>
														<?php if($link):
															$link_url = $link['url'];
															$link_title = $link['title'];
															$link_target = $link['target'] ? $link['target'] : '_self';	
														?>
															<span>
																<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>

															</span>
														<?php endif;?>
													</li>
												<?php endforeach;?>
											</ul>
										</div>
									<?php endif;?>
									<?php trailhead_footer_links();?>
								</div>
							</div>
						</div>
					</div>
					<div class="site-info position-relative">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="cell auto p-sm">
									© <?=date("Y");?>
									<?php if($copyright_text):?>
										<?=wp_kses_post($copyright_text);?>
									<?php endif;?>
									<?php if( !empty($subfooter_links) ):
										$count = count($subfooter_links);
									?>
										<ul class="menu horizontal subfooter-links">
											<?php $i = 1; foreach($subfooter_links as $subfooter_link):
												$link = $subfooter_link['link'] ?? null;
												if($link):
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';	
											?>
												<li>
													<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
													<?php if($count !== 1 && $count = $i):?> &nbsp;|&nbsp; <?php endif;?>
												</li>
											<?php endif; $i++; endforeach;?>
										</ul>
									<?php endif;?>
								</div>
							</div>
						</div>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
					
			</div><!-- #page -->
			
		</div>  <!-- end .off-canvas-content -->
							
	</div> <!-- end .off-canvas-wrapper -->
					
<?php wp_footer(); ?>

</body>
</html>
