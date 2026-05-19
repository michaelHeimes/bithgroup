<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {
        
        acf_register_block_type(array(
            'name'            => 'breadcrumbs',
            'title'           => __('Breadcrumbs'),
            'api_version'     => 2,
            'description'     => __('Breadcrumb navigation.'),
            'render_template' => 'blocks/breadcrumbs.php',
            'category'        => 'layout',
            'mode'            => 'preview', // Forces the block into preview mode immediately
            'keywords'        => array( 'custom', 'breadcrumbs', 'navigation', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode'  => false, 
                'color' => array(
                    'background' => true,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));

        acf_register_block_type(array(
            'name'            => 'section',
            'title'           => __('Section wrapper for native blocks'),
            'api_version'     => 2,
            'description'     => __('Section wrapper for native blocks.'),
            'render_template' => 'blocks/section-block-wrapper.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'section', 'container', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => true,
                'mode' => true,
                'color' => array(
                    'background' => true,
                    'text'       => false,
                    'gradients'  => true,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'child-page-hero',
            'title'           => __('Child Page Hero'),
            'api_version'     => 2,
            'description'     => __('The hero for child pages such as Service Detail and Industry Details pages.'),
            'render_template' => 'blocks/child-page-hero.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'child', 'page', 'banner', 'hero', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode'  => true, 
                'color' => array(
                    'background' => true,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'services-page-hero',
            'title'           => __('Services Page Hero'),
            'api_version'     => 2,
            'description'     => __('The hero for Services Landing Page.'),
            'render_template' => 'blocks/services-page-hero.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'service', 'page', 'banner', 'hero', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode'  => true, 
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'navigation-cards',
            'title'           => __(' Navigation Cards'),
            'api_version'     => 2,
            'description'     => __('Displays the Navigation Cards'),
            'render_template' => 'blocks/navigation-cards.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'sub', 'navigation', 'cards', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode'  => true, 
                'color' => array(
                    'background' => true,
                    'text'       => false,
                    'gradients'  => true,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'home-hero-img-services',
            'title'           => __('Home Hero, Image, and Services'),
            'api_version'     => 2,
            'description'     => __('Home Hero, Image, and Services.'),
            'render_template' => 'blocks/home-hero-img-services.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'home', 'hero', 'banner', 'services', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode' => true,
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'testimonials',
            'title'           => __('Testimonial Slider'),
            'api_version'     => 2,
            'description'     => __('Shows the Testimonial posts.'),
            'render_template' => 'blocks/testimonial-slider.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'testimonial', 'slider', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode' => true,
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'post-rows',
            'title'           => __('Post Rows'),
            'api_version'     => 2,
            'description'     => __('Displays the selected post time in a row format with the featured image.'),
            'render_template' => 'blocks/post-rows.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'insights', 'case', 'studies', 'post', 'rows', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode' => true,
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'explore-more-posts-cards',
            'title'           => __('Explore More Posts Cards'),
            'api_version'     => 2,
            'description'     => __('Shows the selected post time in a card format with the featured image.'),
            'render_template' => 'blocks/explore-more-posts-cards.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'insights', 'case', 'studies', 'post', 'rows', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode' => true,
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'pulse-eyebrow',
            'title'           => __('Pulse Eyebrow'),
            'api_version'     => 2,
            'description'     => __('A Centered Eyebrow Heading with a pulse effect.'),
            'render_template' => 'blocks/pulse-eyebrow.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'pulse', 'header', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode' => true,
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));
        
        acf_register_block_type(array(
            'name'            => 'centered-green-radial-gradient-cta-banner',
            'title'           => __('Centered Green Radial Gradient CTA Banner'),
            'api_version'     => 2,
            'description'     => __('A centered CTA banner with a green radial gradient background.'),
            'render_template' => 'blocks/centered-green-radial-gradient-cta-banner.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'centered', 'green', 'radial', 'gradient', 'cta', 'banner', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => false,
                'mode' => true,
                'color' => array(
                    'background' => false,
                    'text'       => false,
                    'gradients'  => false,
                ),
                'align' => array( 'wide', 'full' ),
            ),
        ));

    }
}

