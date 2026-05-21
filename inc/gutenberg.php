<?php

add_theme_support( 'align-wide' );
//add_theme_support( 'wp-block-styles' );
add_theme_support( 'responsive-embeds' );

function mytheme_setup() {
	// Remove all core WordPress patterns
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );


function trailhead_add_editor_js() {
	$manifest_path = get_template_directory() . '/dist/manifest.json';
	
	if (file_exists($manifest_path)) {
		$manifest = json_decode(file_get_contents($manifest_path), true);
		
		$js_code = "
		(function(wp) {
			if (!wp || !wp.blockEditor) return;

			var el = wp.element.createElement;
			var Fragment = wp.element.Fragment;
			var addFilter = wp.hooks.addFilter;
			var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
			var InspectorControls = wp.blockEditor.InspectorControls;
			var PanelBody = wp.components.PanelBody;
			var ToggleControl = wp.components.ToggleControl;

			/* ==========================================================
			   1. REMOVE NATIVE BUTTON BLOCK STYLES (FILL / OUTLINE)
			   ========================================================== */
			wp.domReady(function() {
				setTimeout(function() {
					wp.blocks.unregisterBlockStyle('core/button', 'fill');
					wp.blocks.unregisterBlockStyle('core/button', 'outline');
				}, 50);
			});

			/* ==========================================================
			   2. STRIP CORES API SIDEBAR PANEL SUPPORT OPTIONS
			   ========================================================== */
			addFilter('blocks.registerBlockType', 'trailhead/restrict-button-controls', function(settings, name) {
				if (name !== 'core/button') return settings;
				
				settings.supports = settings.supports || {};
				
				// A. Disables the drop shadow panel controls
				settings.supports.shadow = false;
				
				// B. Disables layout metric settings extensions
				settings.supports.layout = false;
				
				// C. Disables border settings and border-radii selectors
				settings.supports.__experimentalBorder = false;
				settings.supports.border = {
					radius: false,
					color: false,
					style: false,
					width: false,
					__experimentalSkipSerialization: true
				};

				return settings;
			});

			/* ==========================================
			   3. COLUMN REVERSE EXTENSION (EXISTING)
			   ========================================== */
			addFilter('blocks.registerBlockType', 'bith/column-reverse', function(settings, name) {
				if (name !== 'core/columns') return settings;
				settings.attributes = settings.attributes || {};
				settings.attributes.reverseMobile = { type: 'boolean', default: false };
				return settings;
			});

			var withInspectorControl = createHigherOrderComponent(function(BlockEdit) {
				return function(props) {
					if (props.name !== 'core/columns') return el(BlockEdit, props);
					return el(Fragment, {},
						el(BlockEdit, props),
						el(InspectorControls, {},
							el(PanelBody, { title: 'Mobile Settings' },
								el(ToggleControl, {
									label: 'Reverse Order on Mobile',
									checked: props.attributes.reverseMobile,
									onChange: function(val) { props.setAttributes({ reverseMobile: val }); }
								})
							)
						)
					);
				};
			}, 'withInspectorControl');

			addFilter('editor.BlockEdit', 'bith/column-reverse-control', withInspectorControl);

			/* ==========================================
			   4. COLUMNS FRONTEND WRAPPER INJECTION ONLY
			   ========================================== */
			addFilter('blocks.getSaveContent.extraProps', 'trailhead/shared-class-injection', function(extraProps, blockType, attributes) {
				if (blockType.name === 'core/columns' && attributes.reverseMobile) {
					extraProps.className = (extraProps.className || '') + ' mobile-row-reverse';
				}
				return extraProps;
			});
		})(window.wp);
		";

		wp_add_inline_script('wp-block-editor', $js_code);
	}
}
add_action( 'enqueue_block_editor_assets', 'trailhead_add_editor_js' );



/**
 * Wrap Gutenberg Button text in a span
 */
add_filter('render_block', function($block_content, $block) {
	// Only target the core button block
	if ($block['blockName'] === 'core/button') {
		
		// Find the text between the <a> tags and wrap it in a <span>
		// This targets the inner text of the button link
		$block_content = preg_replace(
			'/(<a.*?>)(.*?)(<\/a>)/is', 
			'$1<span class="position-relative">$2</span>$3', 
			$block_content
		);
	}
	
	return $block_content;
}, 10, 2);

/**
 * Register custom Gutenberg Block Styles for the Core Button link.
 */
function trailhead_register_button_styles() {
	register_block_style(
		'core/button',
		array(
			'name'         => 'blue-100',
			'label'        => __( 'Blue', 'trailhead' ),
			'is_default'   => true,
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'         => 'green-100',
			'label'        => __( 'Green', 'trailhead' ),
			'is_default'   => false,
		)
	);
	
	register_block_style(
		'core/button',
		array(
			'name'         => 'outline-1',
			'label'        => __( 'Outline', 'trailhead' ),
			'is_default'   => false,
		)
	);
	
}
add_action( 'init', 'trailhead_register_button_styles' );

/**
 * Global block supports filter to catch ACF and 3rd party layout definitions.
 */
add_filter( 'block_type_metadata', function( $metadata ) {
	if ( ! isset( $metadata['supports'] ) ) {
		$metadata['supports'] = array();
	}
	$metadata['supports']['anchor'] = true;
	$metadata['supports']['customClassName'] = true;
	return $metadata;
	
	// FORCE DISABLE BUTTON SETTINGS: Strips layout settings & radius from core/button
	if ( isset( $metadata['name'] ) && 'core/button' === $metadata['name'] ) {

		
		// FORCE DISABLE BUTTON SETTINGS
		if ( isset( $metadata['name'] ) && 'core/button' === $metadata['name'] ) {
			// 1. Destroys button width selectors (25%, 50%, 75%, 100%)
			if ( isset( $metadata['supports']['layout'] ) ) {
				unset( $metadata['supports']['layout'] );
			}
			// 2. Destroys the entire border settings panel (Border Radius, styles, width)
			$metadata['supports']['__experimentalBorder'] = false;
			$metadata['supports']['border'] = array(
				'radius'  => false,
				'color'   => false,
				'style'   => false,
				'width'   => false,
				'__experimentalSkipSerialization' => true
			);
			$metadata['supports']['shadow'] = false;
		}
	}
	
}, 999 );




/**
 * PHP RENDER FILTER POLYFILL (NEW)
 * Targets the core/button rendering engine. Bypasses the outer div wrapper 
 * and injects our class explicitly onto the inner <a> anchor tag.
 */
function trailhead_inject_class_to_button_link( $block_content, $block ) {
	// Only execute if processing a core button block and our attribute exists
	if ( 'core/button' === $block['blockName'] && ! empty( $block['attrs']['buttonColorToggle'] ) ) {
		$target_class = esc_attr( $block['attrs']['buttonColorToggle'] );
		
		// Use WordPress's native tag processor to inspect HTML safely
		$tags = new WP_HTML_Tag_Processor( $block_content );
		
		// Move past the outer <div> wrapper and search for the inner <a> anchor tag
		if ( $tags->next_tag( 'a' ) ) {
			$tags->add_class( $target_class );
			$block_content = $tags->get_updated_html();
		}
	}
	return $block_content;
}
add_filter( 'render_block', 'trailhead_inject_class_to_button_link', 10, 2 );


