<?php
/**
 * Section wrapper with Automatic Text Contrast
 */
 
global $bith_block_order;
 
 if ( ! isset( $bith_block_order ) ) {
     $bith_block_order = 0;
     $is_first_block = true;
 } else {
     $bith_block_order++;
     $is_first_block = false;
 }
 
$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$className = 'content-section testimonial-slider';

$eyebrow_heading = get_field('eyebrow_heading') ?? null;
$testimonials_to_show = get_field('testimonials_to_show') ?? null;
$maximum_testimonials_to_show = get_field('maximum_testimonials_to_show') ?? null;
$select_testimonials_to_show = get_field('select_testimonials_to_show') ?? null;


$testimonials = [];

if ( $testimonials_to_show === 'all' ) {
    $args = array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $maximum_testimonials_to_show ?: -1,
        'post_status'    => 'publish',
    );
    $testimonials = get_posts($args);
} elseif ( $testimonials_to_show === 'select' && $select_testimonials_to_show ) {
    // Fixed: used $select_testimonials_to_show instead of $selected_id
    $testimonials = $select_testimonials_to_show;
} 
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if ( $is_first_block ): ?>
        <div class="header-spacer"></div>
    <?php endif; ?>

    <div class="grid-container">
        <div class="inner position-relative">
            <?php if($eyebrow_heading): ?>
                <?php get_template_part( 'template-parts/part', 'pulse-eyebrow', [
                    'text' => $eyebrow_heading,
                    'tag' => 'h2',
                ]); ?>
            <?php endif; ?>
    
            <?php if ( ! empty($testimonials) ) : ?>
                <div class="swiper swiper-1-arrow-dots">
                    <div class="swiper-wrapper">
                        <?php 
                        global $post;
                        foreach ( $testimonials as $post ) :
                            setup_postdata($post);
                            $post_id = $post->ID;
                            $quote = get_field('quote', $post_id) ?? null;
                            $name = get_field('name', $post_id) ?? null;
                            $photo = get_field('photo', $post_id) ?? null;
                            $title_company = get_field('title_company', $post_id) ?? null;
                            if($quote || $name || $title_company ):
                        ?>
                            <div class="testimonial-item swiper-slide">
                                <div class="bg-bith-blue-10">
                                    <div class="icon">
                                        <img src="<?=get_template_directory_uri();?>/assets/svgs/testimonial-quote-icon.svg" alt="quote icon"/>
                                    </div>
                                    <?php if($quote):?>
                                        <div class="quote text-center">
                                            <?=wp_kses_post( $quote );?>
                                        </div>
                                    <?php endif;?>
                                    <?php if($photo || $name || $title_company ):?>
                                        <div class="grid-x align-center">
                                            <div class="cell shrink">
                                                <div class="grid-x gap-x-24 align-center align-middle text-left">
                                                    <?php if($photo):?>
                                                        <div class="cell shrink photo-wrap">
                                                            <div class="photo-inner overflow-hidden">
                                                                <?=wp_get_attachment_image( $photo['id'], 'medium' );?>
                                                            </div>
                                                        </div>
                                                    <?php endif;?>
                                                    <?php if($photo || $name || $title_company ):?>
                                                        <div class="cell auto">
                                                            <?php if($name):?>
                                                                <div class="p weight-500">
                                                                    <?=wp_kses_post($name);?>
                                                                </div>
                                                            <?php endif;?>
                                                            <?php if($title_company):?>
                                                                <div class="p-md">
                                                                    <?=wp_kses_post($title_company);?>
                                                                </div>
                                                            <?php endif;?>
                                                        </div>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        <?php endif; endforeach; wp_reset_postdata(); ?>
                    </div>
                    <div class="swiper-scrollbar"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-btn swiper-button-prev">
                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 12C0 5.373 5.373 0 12 0h20c6.627 0 12 5.373 12 12v20c0 6.627-5.373 12-12 12H12C5.373 44 0 38.627 0 32z" fill="#184275"/><path d="m22 29-7-7m0 0 7-7m-7 7h14" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="swiper-btn swiper-button-next">
                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 12C0 5.373 5.373 0 12 0h20c6.627 0 12 5.373 12 12v20c0 6.627-5.373 12-12 12H12C5.373 44 0 38.627 0 32z" fill="#184275"/><path d="M15 22h14m0 0-7-7m7 7-7 7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
