<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */
$blog_hero_eyebrow = get_field('blog_hero_eyebrow', 'option') ?? null;
$blog_hero_heading = get_field('blog_hero_heading', 'option') ?? null;
$blog_hero_copy = get_field('blog_hero_copy', 'option') ?? null;

get_header();
?>

	<main id="primary" class="site-main">
		
		<?php if($blog_hero_eyebrow || $blog_hero_heading || $blog_hero_copy):?>
		<section id="<?php echo esc_attr($id); ?>" class="has-bith-white-to-cube-gradient-background has-bith-onyx-color blog-hero">
			<div class="header-spacer"></div>
			<div class="grid-container">
				<div class="breadcrumbs home-link-only-breadcrumb position-relative z-1">
					<ul class="menu horizontal align-middle p-md">
						<li class="home-link-wrap">
							<a href="<?=get_home_url();?>">
								Back to home
							</a>
						</li>
					</ul>
				</div>
				<div class="grid-x grid-padding-x align-center">
					<?php if( $blog_hero_eyebrow ) : ?>
						<div class="cell small-12 tablet-8 large-6">
							<?php get_template_part( 'template-parts/part', 'pulse-eyebrow', [
								'text' => $blog_hero_eyebrow,
								'tag'  => 'span',
							] ); ?>
						</div>
					<?php endif; ?>
		
					<?php if($blog_hero_heading):?>
						<div class="heading cell small-12 large-10 text-center">
							<h1><?=wp_kses_post( $blog_hero_heading );?></h1>
						</div>
					<?php endif;?>
					<?php if($blog_hero_copy):?>
						<div class="copy cell small-12 tablet-8 large-6 text-center">
							<?=wp_kses_post( $blog_hero_copy );?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</section>
		<?php endif;?>
		
		<div class="grid-container">

			<?php
				$current_orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date';
				$current_order   = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'desc';
				$current_sort    = $current_orderby . '-' . $current_order;
				
				$labels = array(
					'date-desc' => 'Newest to oldest',
					'date-asc'  => 'Oldest to newest'
				);
				$active_label = isset($labels[$current_sort]) ? $labels[$current_sort] : 'Newest to oldest';
			?>
			
			<div class="filter-wrap grid-x align-middle align-right">
				<div class="cell shrink filter-label">
					Sort
				</div>
				<div class="cell shrink">
					<button class="dropdown-button weight-300 p-md grid-x align-middle align-justify gap-x" type="button" data-toggle="archive-sort-dropdown" data-v-offset="10">
						<?php echo esc_html($active_label); ?>
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m5 7.5 5 5 5-5" stroke="#184275" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</button>
				</div>
			</div>
			
			<div class="dropdown-pane weight-500" id="archive-sort-dropdown" data-dropdown data-auto-focus="true">
				<ul class="menu vertical p-md">
					<li class="<?php echo $current_sort === 'date-desc' ? 'is-active' : ''; ?>">
						<!-- Stripping query arguments defaults WP back to date DESC automatically -->
						<a href="<?php echo esc_url(remove_query_arg(array('orderby', 'order'))); ?>">
							<span>Newest to oldest</span>
							<span class="icon" style="display: none;">
								<img src="<?=get_template_directory_uri();?>/assets/svgs/blog-filter-check-icon.svg">
							</span>
						</a>
					</li>
					<li class="<?php echo $current_sort === 'date-asc' ? 'is-active' : ''; ?>">
						<!-- Explicitly sets orderby=date and order=asc inside URL params -->
						<a href="<?php echo esc_url(add_query_arg(array('orderby' => 'date', 'order' => 'asc'))); ?>">
							<span>Oldest to newest</span>
							<span class="icon" style="display: none;">
								<img src="<?=get_template_directory_uri();?>/assets/svgs/blog-filter-check-icon.svg">
							</span>
						</a>
					</li>
				</ul>
			</div>

			<?php
			if ( have_posts() ) :
	
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
	
					/*
		 			* Include the Post-Type-specific template for the content.
		 			* If you want to override this in a child theme, then include a file
		 			* called content-___.php (where ___ is the Post Type name) and that will be used instead.
		 			*/
					get_template_part( 'template-parts/loop', 'post-row',
						array(
							'is_slide' => false,
						),	
					);
	
				endwhile;
	
				trailhead_page_navi();
				
				$is_first_block = false;
				$class_name = 'centered-green-radial-gradient-cta-banner content-section custom-section-pattern has-bith-radial-gradient-background has-bith-onyx-color';
				$use_global_values = true;
				$pulse_eyebrow = get_field('ccrg_pulse_eyebrow', 'option') ?? null;
				$eyebrow_tag   = get_field('ccrg_eyebrow_tag', 'option') ?? null;
				$title         = get_field('ccrg_title', 'option') ?? null;
				$title_tag     = get_field('ccrg_title_tag', 'option') ?? null;
				$button_link   = get_field('ccrg_button_link', 'option') ?? null;
					
				get_template_part('template-parts/part', 'centered-green-radial-gradient-cta-banner',
					array(
						'is_first_block' => $is_first_block,
						'class_name' => $class_name,
						'pulse_eyebrow' => $pulse_eyebrow,
						'eyebrow_tag'   => $eyebrow_tag,
						'title'         => $title,
						'title_tag'     => $title_tag,
						'button_link'   => $button_link,
					)
				);
	
			else :
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif;
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
