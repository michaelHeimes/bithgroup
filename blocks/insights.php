<?php
/**
 * Insights posts
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
$className = 'content-section insights';

$sh_heading = get_field('sh_heading') ?? null;
$sh_text = get_field('sh_text') ?? null;
$sh_button_link = get_field('sh_button_link') ?? null;

$insights_to_show = get_field('insights_to_show') ?? null;
$select_insights_to_show = get_field('select_insights_to_show') ?? null;


$insights = [];

if ( $insights_to_show === 'latest' ) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
    );
    $insights = get_posts($args);
} elseif ( $insights_to_show === 'select' && $select_insights_to_show ) {
    // Fixed: used $select_insights_to_show instead of $selected_id
    $insights = $select_insights_to_show;
} 
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if ( $is_first_block ): ?>
        <div class="header-spacer"></div>
    <?php endif; ?>

    <div class="grid-container">
        <?php get_template_part('template-parts/part', 'section-header-h2-text-btn-link',
            array(
                'heading' => $sh_heading,
                'text' => $sh_text,
                'text-color' => 'black',
                'link' => $sh_button_link,
                'btn-classes' => 'blue-100 has-bith-white-color'
            ),
        );?>
        <?php if ( ! empty($insights) ) : ?>
            <div class="swiper swiper-1">
                <div class="wrapper">
                    <?php 
                    global $post;
                    foreach ( $insights as $post ) :
                        setup_postdata($post);
                        $post_id = $post->ID;
                    ?>
                        <?php get_template_part('template-parts/loop', 'insight');?>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
                <div class="swiper-scrollbar hide-for-medium"></div>
            </div>
        <?php endif; ?>
    </div>
</section>
