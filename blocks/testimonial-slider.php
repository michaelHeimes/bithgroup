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
$className = 'page-section testimonial-slider';

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
        <?php if($eyebrow_heading): ?>
            <?php get_template_part( 'template-parts/part', 'pulse-eyebrow', [
                'text' => $eyebrow_heading,
                'tag' => 'h2',
            ]); ?>
        <?php endif; ?>

        <?php if ( ! empty($testimonials) ) : ?>
            <div class="testimonial-slider swiper">
                <div class="swiper-wrapper">
                    <?php 
                    global $post; // 1. Access the global post variable
                    foreach ( $testimonials as $post ) : // 2. Must use $post here
                        setup_postdata($post); // 3. Now this correctly overrides the page context
                    ?>
                        <div class="testimonial-item swiper-slide">
                            <h3><?php the_title(); ?></h3>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); // 4. Restores the page context ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
