<?php
/**
 * Post Rows
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
$className = 'content-section explore-more-posts-cards bg-transition-bith-blue has-bith-white-color';

$sh_heading = get_field('sh_heading') ?? null;
$sh_text = get_field('sh_text') ?? null;
$sh_button_link = get_field('sh_button_link') ?? null;

$post_type = get_field('post_type');

$posts_to_show = get_field('posts_to_show') ?? null;

$select_insights_to_show = get_field('select_insights_to_show') ?? null;
$select_case_studies_to_show = get_field('select_case_studies_to_show') ?? null;

$posts = [];

if ( $posts_to_show === 'latest' ) {
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => 3,
        'post_status'    => 'publish',
    );
    $posts = get_posts($args);
} 
elseif ( $posts_to_show === 'select' ) {
    if ( $post_type === 'post' ) {
        $posts = get_field('select_insights_to_show');
    } elseif ( $post_type === 'case-studies' ) {
        $posts = get_field('select_case_studies_to_show');
    }
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
                'text-color' => 'white',
                'link' => $sh_button_link,
                'btn-classes' => 'green-100 has-bith-onyx-color'
            ),
        );?>
        <?php if ( ! empty($posts) ) : ?>
            <div class="swiper swiper-3-2-swipe-1-swipe overflow-visible">
                <div class="swiper-wrapper">
                    <?php 
                    global $post;
                    foreach ( $posts as $post ) :
                        setup_postdata($post);
                        $post_id = $post->ID;
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('loop-post-card slide-1 swiper-slide'); ?>>
                            <a class="has-bith-white-color border-white-30 bg-black-30 br-48 overflow-hidden h-100" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'trailhead' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                <?php if ( has_post_thumbnail() ) :?>
                                <div class="thumb-wrap cell small-12 tablet-5 large-4">
                                    <div class="img-wrap position-relative">
                                        <?= get_the_post_thumbnail( $post_id, 'large', array('class' => 'br-32') ); ?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div>
                                    <h3 class="weight-500"><?php the_title();?></h3>
                                    <p class="post-date p-sm"><?php echo get_the_date('F j, Y'); ?></p>
                                    <div class="p-md"><?php the_excerpt();?></div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
                <div class="swiper-scrollbar hide-for-large"></div>
            </div>
        <?php endif; ?>
        <?php if($sh_button_link) {
            get_template_part('template-parts/part', 'button-link',
                array(
                    'link' => $sh_button_link,
                    'container-classes' => 'small-12 medium-shrink hide-for-medium',
                    'btn-classes' => 'green-100 has-bith-onyx-color fw-wide-md-btn',
                )
            );
        };?>
    </div>
</section>
