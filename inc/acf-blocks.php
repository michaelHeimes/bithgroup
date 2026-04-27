<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

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
            'description'     => __('Testimonials block that shows the Testimonial posts.'),
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
            'name'            => 'our-industries',
            'title'           => __('Our Industries'),
            'api_version'     => 2,
            'description'     => __('Our Industries block that shows the Industry Cards.'),
            'render_template' => 'blocks/our-industries.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'our', 'industries', 'bith', 'propr' ),
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
            'name'            => 'insights',
            'title'           => __('Insights'),
            'api_version'     => 2,
            'description'     => __('Insights block that shows the posts.'),
            'render_template' => 'blocks/insights.php',
            'category'        => 'layout',
            'keywords'        => array( 'custom', 'insights', 'bith', 'propr' ),
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

    }
}

