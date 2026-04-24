<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'            => 'section',
            'title'           => __('Section wrapper for all blocks'),
            'description'     => __('Section wrapper for all blocks.'),
            'render_template' => 'template-parts/blocks/section.php',
            'category'        => 'layout',
            'keywords'        => array( 'section', 'container', 'bith', 'propr' ),
            'supports'        => array(
                'jsx'   => true,
                'color' => array(
                    'background' => true,
                    'text'       => true,
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

    }
}

