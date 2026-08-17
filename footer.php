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
$footer_social_links = get_field('footer_social_links', 'option') ?? null;
?>

				<footer id="colophon" class="site-footer bg-transition-bith-blue has-bg has-bith-white-color">
					<div class="bg" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/svgs/footer-pattern.svg');"></div>
					<div class="footer-main position-relative">
						<div class="grid-container">
							<div class="grid-x grid-padding-x tablet-flex-dir-row-reverse">
								<?php if($footer_cta):
									$heading = $footer_cta['heading'] ?? null;
									$copy = $footer_cta['copy'] ?? null;
									$button_link = $footer_cta['button_link'] ?? null;
									if($heading || $copy || $button_link):
								?>
									<div class="footer-cta cell small-12 tablet-6">
										<div class="cta-inner border-white-30 h-100 grid-x flex-dir-column align-justify">
											<div>
												<?php if($heading):?>
													<h2><?=wp_kses_post($heading);?></h2>
												<?php endif;?>
												<?php if($copy):?>
													<h2><?=wp_kses_post($copy);?></h2>
												<?php endif;?>
											</div>
											<?php if($button_link) {
												get_template_part('template-parts/part', 'button-link',
													array(
														'link' => $button_link,
														'container-classes' => 'small-12 medium-shrink is-style-green-100',
														'btn-classes' => 'fw-wide-md-btn',
													)
												);
											};?>
										</div>
									</div>
								<?php endif; endif;?>
								<div class="cell small-12 tablet-6">
									<?php if($footer_logo || $footer_address):?>
										<div class="logo-address-wrap grid-x grid-padding-x flex-dir-column medium-flex-dir-row tablet-flex-dir-column ">
											<div class="cell medium-shrink tablet-12 logo-wrap">
												<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Links to home page">
													<?=wp_get_attachment_image( $footer_logo['id'], 'full' );?>
												</a>
											</div>
											<?php if($footer_address):?>
												<div class="cell medium-auto tablet-12 address">
													<?=wp_kses_post( $footer_address );?>
												</div>
											<?php endif;?>
										</div>
									<?php endif;?>
									<?php if( !empty($contact_methods) ):?>
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
								<div class="copyright cell small-12 medium-auto p-sm">
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
								<?php if( !empty($footer_social_links) ):?>
									<div class="cell small-12 medium-shrink">
										<ul class="menu social-links horizontal no-link-padding">
											<?php foreach($footer_social_links as $footer_social_link):
												$icon = $footer_social_link['icon'] ?? null;	
												$link = $footer_social_link['link'] ?? null;	
												if($link):
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';	
											?>
												<li>
													<a class="align-middle align-center bg-black-30 border-white-30" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
														<span class="show-for-sr">
															<?php echo esc_html( $link_title ); ?>
														</span>
														<?php if($icon):?>
															<div class="icon-wrap grid-x align-middle align-center">
																<?=wp_get_attachment_image($icon['id'], 'full', false, ['class' => 'style-svg']);?>
															</div>
														<?php endif;?>
													</a>
												</li>
											<?php endif; endforeach;?>
										</ul>
									</div>
								<?php endif;?>
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
