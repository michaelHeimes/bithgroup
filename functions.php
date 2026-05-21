<?php
/**
* Trailhead functions and definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package trailhead
*/

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/
function trailhead_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Trailhead, use a find and replace
		* to change 'trailhead' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'trailhead', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	
	// Default thumbnail size
	set_post_thumbnail_size(150, 150, true);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'trailhead_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	* Add support for core custom logo.
	*
	* @link https://codex.wordpress.org/Theme_Logo
	*/
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);
}
add_action( 'after_setup_theme', 'trailhead_setup' );

/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*/
function trailhead_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trailhead_content_width', 640 );
}
add_action( 'after_setup_theme', 'trailhead_content_width', 0 );

/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function trailhead_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'trailhead' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'trailhead' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(array(
		'id' => 'offcanvas',
		'name' => __('Offcanvas', 'trailhead'),
		'description' => __('The offcanvas sidebar.', 'trailhead'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	
}
add_action( 'widgets_init', 'trailhead_widgets_init' );


/**
* Enqueue scripts and styles.
*/
function trailhead_scripts() {
	// 1. Enqueue default style.css (standard WP practice)
	wp_enqueue_style('trailhead-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('trailhead-style', 'rtl', 'replace');

	// 2. Locate and check for manifest
	$manifest_path = get_template_directory() . '/dist/manifest.json';
	
	// Only proceed if manifest exists to prevent PHP warnings
	if (!file_exists($manifest_path)) {
		return;
	}

	// 3. Securely decode manifest
	$manifest_content = file_get_contents($manifest_path);
	$manifest = json_decode($manifest_content, true); // decode as associative array

	if (!$manifest) {
		return;
	}

	// 4. Enqueue Compiled Assets
	// Pass 'null' for version because the filename itself is already versioned (e.g., bundle.min.1.0.0.css)
	if (isset($manifest['css'])) {
		wp_enqueue_style(
			'bundle-css', 
			get_template_directory_uri() . '/dist/' . $manifest['css'], 
			[], 
			null 
		);
	}

	if (isset($manifest['js'])) {
		wp_enqueue_script(
			'bundle-js', 
			get_template_directory_uri() . '/dist/' . $manifest['js'], 
			['jquery'], 
			null, 
			true // Load in footer
		);

		// OPTIONAL: Localize script if you need to pass data from PHP to JS
		wp_localize_script('bundle-js', 'trailheadData', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('trailhead_nonce'),
		]);
	}

	// 5. Standard WP functions
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'trailhead_scripts');

add_action('admin_head', function() {
	$screen = get_current_screen();
	if ( $screen && $screen->is_block_editor() ) {
		echo '<style id="bith-pre-editor-reset">
			/* Kill the Core UI button styles before they even load */
			.editor-styles-wrapper .button, .button-primary, .button-secondary {
					all: unset; // Wipes out the 13px font, borders, and line-height
					display: inline-block;
					cursor: pointer;
					box-sizing: border-box;
				}
			

		</style>';
	}
}, 0); // Priority 0 is the absolute earliest


// add_action('admin_head', function() {
	//    ob_start(function($html) {
	// 	   return str_replace('wp-core-ui', '', $html);
	//    });
//  });
//  
//  add_action('admin_footer', function() {
	//    ob_end_flush();
//  });

function trailhead_add_editor_styles() {
	add_theme_support( 'editor-styles' );

	$manifest_path = get_template_directory() . '/dist/manifest.json';
	
	if (file_exists($manifest_path)) {
		$manifest = json_decode(file_get_contents($manifest_path), true);

		if (isset($manifest['css'])) {
			// Note: add_editor_style path is relative to the theme root
			add_editor_style( 'dist/' . $manifest['css'] );
		}
	}
}
add_action( 'after_setup_theme', 'trailhead_add_editor_styles' );

// add_action('enqueue_block_editor_assets', function() {
	//  wp_add_inline_script('wp-blocks', "
	// 	 wp.blocks.registerBlockVariation('acf/section', {
	// 		 name: 'section',
	// 		 title: 'Section wrapper for native blocks',
	// 		 isDefault: true,
	// 		 attributes: {
	// 			 backgroundColor: 'bith-white'
	// 		 }
	// 	 });
	//  ");
// });


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

			/* ==========================================
			   COLUMN REVERSE EXTENSION (EXISTING)
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
			   COLUMNS FRONTEND WRAPPER INJECTION ONLY
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
 * Register custom Gutenberg Block Styles for the Core Button link.
 */
function trailhead_register_button_styles() {
	register_block_style(
		'core/button',
		array(
			'name'         => 'blue-100',
			'label'        => __( 'Blue Accent', 'trailhead' ),
			'is_default'   => true, // Makes this style pre-selected on new buttons
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'         => 'green-100',
			'label'        => __( 'Green Accent', 'trailhead' ),
			'is_default'   => false,
		)
	);
}
add_action( 'init', 'trailhead_register_button_styles' );



/**
 * 2. PHP RENDER FILTER POLYFILL (NEW)
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








/**
* Enqueue Google Fonts.
*/
wp_enqueue_style(
	'trailhead-google-fonts',
	'https://fonts.googleapis.com/css2?family=PT+Serif:ital@0;1&family=Archivo:ital,wght@0,300;0,500;1,300;1,500&family=JetBrains+Mono&display=swap',
	array(),
	null
);

function google_font_loader_tag_filter( $html, $handle ) {
	if ( $handle === 'trailhead-google-fonts' ) {
		$rel_preconnect = "rel='stylesheet preconnect'";
		return str_replace(
			"rel='stylesheet'",
			$rel_preconnect,
			$html
		);
	}
	return $html;
}
add_filter( 'style_loader_tag', 'google_font_loader_tag_filter', 10, 2 );


// Disable Tabelpress Stylesheet
add_filter( 'tablepress_use_default_css', '__return_false' );


/**
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Functions which enhance the theme by hooking into WordPress.
*/
require get_template_directory() . '/inc/template-functions.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
* Load Jetpack compatibility file.
*/
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
* Load WooCommerce compatibility file.
*/
// if ( class_exists( 'WooCommerce' ) ) {
	// require get_template_directory() . '/inc/woocommerce.php';
// }



// Additional Custom Functions

// WP Head and other cleanup functions
require_once(get_template_directory().'/inc/cleanup.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/inc/menu.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/inc/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/inc/page-navi.php'); 

// ACF Options
require_once(get_template_directory().'/inc/acf-json.php');

// ACF Block
require_once(get_template_directory().'/inc/acf-blocks.php');

// ACF PAtterns
require_once(get_template_directory().'/inc/acf-patterns.php');

// ACF Repeater Collapse
// require_once(get_template_directory().'/inc/acf-repeater-collapse.php');

// Gutenberg
require_once(get_template_directory().'/inc/gutenberg.php'); 

// Disable Gutenberg
require_once(get_template_directory().'/inc/disable-gutenberg.php'); 

// Add Page Slug to Body Class
// require_once(get_template_directory().'/inc/page-slug-body-class.php');

// Remove Emoji Support
// require_once(get_template_directory().'/inc/disable-emoji.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/inc/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/inc/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/inc/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/inc/admin.php'); 

// Sitemap Removal
// require_once(get_template_directory().'/inc/sitemap-removal.php');

// Slugify
// require_once(get_template_directory().'/inc/slugify.php');

// Image Sizes
require_once(get_template_directory().'/inc/image-sizes.php');