<?php
// Borrowed with love from FoundationPress
function trailhead_page_navi() {
	global $wp_query;
	$big = 999999999;
	
	$current_page = max( 1, get_query_var( 'paged' ) );
	$total_pages  = $wp_query->max_num_pages;

	// If there is only 1 page total, set total pages to 1 so navigation still renders
	$total_pages = $total_pages > 0 ? $total_pages : 1;

	// Fetch links as a flat array instead of a broken nested list
	$page_array = paginate_links( array(
		'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
		'current'   => $current_page,
		'total'     => $total_pages,
		'mid_size'  => 2,
		'prev_next' => false, // Handled manually below
		'type'      => 'array',
	) );

	// 1. Build manual Previous link
	if ( $current_page > 1 ) {
		$prev_url  = esc_url( get_pagenum_link( $current_page - 1 ) );
		$prev_link = '<li class="cell small-6 medium-shrink"><a href="' . $prev_url . '" class="prev weight-500" aria-label="Previous Page"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 1 1 8l7 7M1 8h14" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Previous</a></li>';
	} else {
		$prev_link = '<li class="disabled cell small-6 medium-shrink"><span class="prev weight-500" aria-disabled="true"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 1 1 8l7 7M1 8h14" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Previous</span></li>';
	}

	// 2. Build manual Next link (Fixed: URLs and aria-labels corrected)
	if ( $current_page < $total_pages ) {
		$next_url  = esc_url( get_pagenum_link( $current_page + 1 ) );
		$next_link = '<li class="next-wrap cell small-6 medium-shrink"><a href="' . $next_url . '" class="next weight-500" aria-label="Next Page">Next <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 8h14m-7 7 7-7-7-7" stroke="#eaf3d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a></li>';
	} else {
		$next_link = '<li class="next-wrap disabled cell small-6 medium-shrink"><span class="next weight-500" aria-disabled="true">Next <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 8h14m-7 7 7-7-7-7" stroke="#eaf3d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span></li>';
	}

	// 3. Construct the clean layout wrapper
	echo '<ul class="page-navigation p-md menu grid-x grid-padding-x align-bottom align-justify">';
	// Output the Left Anchor (Prev)
	echo $prev_link;
	
	echo '<li class="pagination-wrap cell small-12 medium-auto"><ul class="pagination p-md menu horizontal align-center">';

	// 4. Output standard numerical pages cleanly formatted as list items
	if ( ! empty( $page_array ) ) {
		foreach ( $page_array as $page_link ) {
			// Check if this item is the active page block
			if ( strpos( $page_link, 'current' ) !== false ) {
				// Strip WordPress classes and wrap natively for Foundation
				$clean_link = strip_tags( $page_link );
				echo '<li class="current"><span>' . $clean_link . '</span></li>';
			} elseif ( strpos( $page_link, 'dots' ) !== false ) {
				// Handle the ellipse breaks cleanly
				echo '<li class="dots grid-x align-bottom"><span class="dots">&hellip;</span></li>';
			} else {
				// Remove native WordPress classes from standard links
				$clean_link = preg_replace( '/\s*page-numbers/', '', $page_link );
				echo '<li>' . $clean_link . '</li>';
			}
		}
	} else {
		// Safe fallback for single page outputs
		echo '<li class="current">1</li>';
	}

	echo '</ul></li>';
	
	// Output the Right Anchor (Next)
	echo $next_link;
	
	echo '</div><!--// end .pagination -->';
}
