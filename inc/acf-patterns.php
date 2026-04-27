<?php 

add_action('init', function() {
	register_block_pattern(
		'my-theme/it-project-cta',
		array(
			'title'       => __( 'CTA Section', 'trailhead' ),
			'description' => _x( 'A section with a pulse eyebrow, heading, and contact button.', 'Block pattern description', 'my-theme' ),
			'content'     => '<!-- wp:acf/section {"name":"acf/section","data":{"content_maxwidth":"","_content_maxwidth":"field_69ea56ad87a4e","remove_top_padding":"0","_remove_top_padding":"field_69ea75fc11e1b","remove_bottom_padding":"0","_remove_bottom_padding":"field_69ea769a11e1e","extra_top_padding_40px":"1","_extra_top_padding_40px":"field_69efaf2869235","extra_bottom_padding_40px":"1","_extra_bottom_padding_40px":"field_69efaf5e69236"},"mode":"preview","gradient":"bith-radial"} -->
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
			'categories'  => array( 'cta', 'Bith Custom' ),
		)
	);
});
