<?php 
add_action('init', function() {
	
	register_block_pattern_category(
		'custom-page-templates',
		array( 'label' => __( 'Custom Page Templates', 'trailhead' ) )
	);
	
	register_block_pattern_category(
		'custom-sections',
		array( 'label' => __( 'Custom Sections', 'trailhead' ) )
	);
	
	// blocks

	register_block_pattern( 'trailhead/it-project-cta', array(
		'title'       => __( 'CTA Section', 'my-theme' ),
		'description' => _x( 'A section with a pulse eyebrow, heading, and contact button.', 'Block pattern description', 'my-theme' ),
		'content'     => '<!-- wp:acf/section {"name":"acf/section","data":{"content_maxwidth":"","_content_maxwidth":"field_69ea56ad87a4e","remove_top_padding":"0","_remove_top_padding":"field_69ea75fc11e1b","remove_bottom_padding":"0","_remove_bottom_padding":"field_69ea769a11e1e","extra_top_padding_40px":"1","_extra_top_padding_40px":"field_69efaf2869235","extra_bottom_padding_40px":"1","_extra_bottom_padding_40px":"field_69efaf5e69236"},"mode":"preview","className":"custom-section-pattern","gradient":"bith-radial","metadata":{"categories":["bith-custom"],"patternName":"my-theme/it-project-cta","name":"CTA Section"}} -->
						<!-- wp:acf/pulse-eyebrow {"name":"acf/pulse-eyebrow","data":{"text":"We\'re ready to partner with you","_text":"field_69ef9e1132cda","tag":"span","_tag":"field_69ef9e5970e38"},"mode":"preview"} /-->
						<!-- wp:heading {"textAlign":"center"} -->
						<h2 class="wp-block-heading has-text-align-center">Let’s talk about your next IT project.</h2>
						<!-- /wp:heading -->
						<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
						<div class="wp-block-buttons"><!-- wp:button {"textAlign":"center"} -->
						<div class="wp-block-button"><a class="wp-block-button__link has-text-align-center wp-element-button">Contact Us</a></div>
						<!-- /wp:button --></div>
						<!-- /wp:buttons -->
						<!-- /wp:acf/section -->',
		'categories'  => array( 'cta', 'custom-sections' ),
	) );
	
	
	// page templates
	register_block_pattern( 'trailhead/post-detail-layout', array(
		'title'       => __( 'Post Detail Layout', 'my-theme' ),
		'description' => _x( 'Complete page template for post details including breadcrumbs, title, featured image, related posts, and CTA.', 'Block pattern description', 'my-theme' ),
		'content'     => '<!-- wp:acf/breadcrumbs {"name":"acf/breadcrumbs","data":{},"mode":"preview","backgroundColor":"bith-white"} /-->
	
						<!-- wp:acf/section {"name":"acf/section","data":{"horizontal_alignment":"align-center","_horizontal_alignment":"field_69f278117dac1","content_width":"10-12","_content_width":"field_69f27159d77af","content_width_breakpoint":"large","_content_width_breakpoint":"field_69f353e0fadf0","remove_top_padding":"0","_remove_top_padding":"field_69ea75fc11e1b","remove_bottom_padding":"0","_remove_bottom_padding":"field_69ea769a11e1e","extra_top_padding_40px":"0","_extra_top_padding_40px":"field_69efaf2869235","extra_bottom_padding_40px":"0","_extra_bottom_padding_40px":"field_69efaf5e69236"},"mode":"preview"} -->
						<!-- wp:post-title {"level":1} /-->
						<!-- wp:post-date {"datetime":"2026-04-30T13:17:39.866Z"} /-->
						<!-- wp:paragraph -->
						<p>Optional description lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus.</p>
						<!-- /wp:paragraph -->
						<!-- wp:post-featured-image {"sizeSlug":"full"} /-->
						<!-- wp:heading -->
						<h2 class="wp-block-heading">H2 Lorem Ipsum</h2>
						<!-- /wp:heading -->
						<!-- wp:paragraph -->
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus.</p>
						<!-- /wp:paragraph -->
						<!-- wp:heading {"level":3} -->
						<h3 class="wp-block-heading">H3 Lorem Ipsum</h3>
						<!-- /wp:heading -->
						<!-- wp:paragraph -->
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus.</p>
						<!-- /wp:paragraph -->
						<!-- wp:heading {"level":4} -->
						<h4 class="wp-block-heading">H4 Lorem Ipsum</h4>
						<!-- /wp:heading -->
						<!-- wp:paragraph -->
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus.</p>
						<!-- /wp:paragraph -->
						<!-- /wp:acf/section -->
	
						<!-- wp:acf/explore-more-posts-cards {"name":"acf/explore-more-posts-cards","data":{"sh_heading":"Explore More Insights","_sh_heading":"field_69ee2ff888dd2","sh_text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit.","_sh_text":"field_69ee302c88dd3","sh_button_link":{"title":"Explore More Insights","url":"https://bithgroup.local/insights/","target":""},"_sh_button_link":"field_69ee303d88dd4","section_header_copy":"","_section_header_copy":"field_69f37d45265c8","post_type":"post","_post_type":"field_69f37d45265cd","posts_to_show":"latest","_posts_to_show":"field_69f37d45265cf"},"mode":"preview"} /-->
	
						<!-- wp:acf/section {"name":"acf/section","data":{"content_maxwidth":"","_content_maxwidth":"field_69ea56ad87a4e","remove_top_padding":"0","_remove_top_padding":"field_69ea75fc11e1b","remove_bottom_padding":"0","_remove_bottom_padding":"field_69ea769a11e1e","extra_top_padding_40px":"1","_extra_top_padding_40px":"field_69efaf2869235","extra_bottom_padding_40px":"1","_extra_bottom_padding_40px":"field_69efaf5e69236"},"mode":"preview","className":"custom-section-pattern","gradient":"bith-radial","metadata":{"categories":["custom-sections"],"patternName":"trailhead/it-project-cta","name":"CTA Section"}} -->
						<!-- wp:acf/pulse-eyebrow {"name":"acf/pulse-eyebrow","data":{"text":"We\'re ready to partner with you","_text":"field_69ef9e1132cda","tag":"span","_tag":"field_69ef9e5970e38"},"mode":"preview"} /-->
						<!-- wp:heading {"textAlign":"center"} -->
						<h2 class="wp-block-heading has-text-align-center">Let’s talk about your next IT project.</h2>
						<!-- /wp:heading -->
						<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
						<div class="wp-block-buttons"><!-- wp:button {"textAlign":"center"} -->
						<div class="wp-block-button"><a class="wp-block-button__link has-text-align-center wp-element-button">Contact Us</a></div>
						<!-- /wp:button --></div>
						<!-- /wp:buttons -->
						<!-- /wp:acf/section -->',
		'categories'  => array( 'custom-page-templates' ),
	) );



	
});

