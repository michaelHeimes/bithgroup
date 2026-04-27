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
                    'gradients'  => array(
                        array( 'name' => 'Bith Radial', 'slug' => 'bith-radial', 'gradient' => 'radial-gradient(50% 50% at 50% 50%, #FFF 0%, #E2F0B9 100%)' ),
                        array( 'name' => 'Cube to White', 'slug' => 'bith-cube-to-white', 'gradient' => 'linear-gradient(180deg, #F4F7E5 0%, #FFF 100%)' ),
                        array( 'name' => 'White to Cube', 'slug' => 'bith-white-to-cube', 'gradient' => 'linear-gradient(180deg, #FFF 0%, #F4F7E5 100%)' ),
                        array( 'name' => 'Blue', 'slug' => 'bith-blue', 'gradient' => 'linear-gradient(180deg, #184275 0%, #1B2634 100%)' ),
                    ),
                    // Optional: restricted palette from before
                    'palette' => array(
                        array( 'slug' => 'bith-slate', 'color' => '#1B2634', 'name' => 'Slate' ),
                        array( 'slug' => 'bith-blue-10', 'color' => '#EAEFF5', 'name' => 'Blue 10' ),
                        array( 'slug' => 'bith-blue-100', 'color' => '#184275', 'name' => 'Blue 100' ),
                        array( 'slug' => 'bith-green-100', 'color' => '#9DC03B', 'name' => 'Green 100' ),
                    ),
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

    }
}

