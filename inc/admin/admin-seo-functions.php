<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Admin seo functions file.
 *
 * @category Evolution Framework
 * @package  Admin
 * @author   Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.hechtmediaarts.com/themes/evolution
 */

/*------------------------------------------------------------------------------

=================================
    INDEX:
=================================

1. - Custom Titles, which kind of title on page, post... => revo_title()
2. - Meta Robots, index or not to index => evolution_index()
3. - Controlling the Meta Keywords
    3.1 - meta_post_keywords()
    3.2 - meta_home_keywords()

 -----------------------------------------------------------------------------*/

// 1. ========== Building the  custom titles => evolution_title() ============

function evolution_title() {

    $output = '';
    global $data;

if($data['evolution_seo_enable'] == 'Enable') {

    // If on the Homepage
	if (is_home() OR is_front_page()) {
	if ($data['evolution_seo_home_title'] == 'Site Title - Site Description')
    $output .= get_bloginfo('name').$data['evolution_title_separator'] .get_bloginfo('description');
	if ( $data['evolution_seo_home_title'] == 'Site Description - Site Title')
    $output .= get_bloginfo('description').$data['evolution_title_separator'] .get_bloginfo('name');
	if ( $data['evolution_seo_home_title'] == 'Site Title')
    $output .= get_bloginfo('name');
 	}

    if ( is_home() && is_paged() && get_query_var('paged') ) {
    global $page, $paged;
    if ( $paged >= 2 || $page >= 2 )
	$output .= $data['evolution_title_separator'] .sprintf( __( 'Page %s', 'evolution' ), max( $paged, $page ) );
}

    // If on a single post page
    if(is_single() || is_page()) {
    if($data['evolution_seo_posts_title'] == 'Site Title - Page Title')
    $output .= get_bloginfo('name') . $data['evolution_title_separator'] . wp_title('', false, '');
    if($data['evolution_seo_posts_title'] == 'Page Title - Site Title')
    $output .= wp_title('', false, '') . $data['evolution_title_separator'] . get_bloginfo('name');
    if($data['evolution_seo_posts_title'] == 'Page Title')
    $output .= wp_title('', false, '');
}

    // If on a error page
    if(is_404()) {
    if($data['evolution_seo_posts_title'] == 'Site Title - Page Title')
    $output .= get_bloginfo('name') . $data['evolution_title_separator'] . wp_title('', false, '');
    if($data['evolution_seo_posts_title'] == 'Page Title - Site Title')
    $output .= wp_title('', false, '') . $data['evolution_title_separator'] . get_bloginfo('name');
    if($data['evolution_seo_posts_title'] == 'Page Title')
    $output .= wp_title('', false, '');
}

    // Displaying the title on category, search and archive
    if(is_category() || is_archive() || is_search()) {
    if($data['evolution_seo_pages_title'] == 'Site Title - Page Title')
    $output .= get_bloginfo('name') . $data['evolution_title_separator'] . wp_title('', false, '');
    if($data['evolution_seo_pages_title'] == 'Page Title - Site Title')
    $output .= wp_title('', false, '') . $data['evolution_title_separator'] . get_bloginfo('name');
    if($data['evolution_seo_pages_title'] == 'Page Title')
    $output .= wp_title('', false, '');
    }
}

else {


    // This else code based on the woo_title() => http://woothemes.com - Thanks for help!

    $sep = ' - ';

	if ( is_home() ) { echo get_bloginfo( 'name') . $sep . get_bloginfo( 'description' ); }
	elseif ( is_search() ) { echo get_bloginfo( 'name') . $sep . __( 'Search Results', 'evolution' );  }
	elseif ( is_author() ) { echo get_bloginfo( 'name') . $sep . __( 'Author Archives', 'evolution' );  }
	elseif ( is_single() ) { echo wp_title($sep,true,true) . get_bloginfo( 'name' );  }
    elseif ( is_404() ) { echo wp_title($sep,true,true) . get_bloginfo( 'name' );  }
	elseif ( is_page() ) {  echo get_bloginfo( 'name' ); wp_title($sep,true,false);  }
	elseif ( is_category() ) { echo get_bloginfo( 'name') . $sep . __( 'Category Archive', 'evolution' ) . $sep . single_cat_title( '',false);  }
	elseif ( is_day() ) { echo get_bloginfo( 'name') . $sep . __( 'Daily Archive', 'evolution' ) . $sep . get_the_time( 'jS F, Y' );  }
	elseif ( is_month() ) { echo get_bloginfo( 'name') . $sep . __( 'Monthly Archive', 'evolution' ) . $sep . get_the_time( 'F' );  }
	elseif ( is_year() ) { echo get_bloginfo( 'name') . $sep . __( 'Yearly Archive', 'evolution' ) . $sep . get_the_time( 'Y' );  }
	elseif ( is_tag() ) {  echo get_bloginfo( 'name') . $sep . __( 'Tag Archive', 'evolution' ) . $sep . single_tag_title( '',false); }

}
// ========== Output styles ====================================================

		if ($output <> '') {
			$output = "" . $output . "";
			echo $output;
		}
}


// 2. =========== Meta Robots, index or not to index ===========================

function evolution_index() {
    global $post;
    global $wpdb;
    global $data;
    if(!empty($post)) {
    $post_id = $post -> ID;
}

    $index = 'index';
    $follow = 'follow';
    if(is_tag() && $data['evolution_index_tag'] != 'index') {
    $index = 'noindex';
}

    elseif(is_search() && $data['evolution_index_search'] != 'index') {
    $index = 'noindex';
}

    elseif(is_author() && $data['evolution_index_author'] != 'index') {
    $index = 'noindex';
}

    elseif(is_date() && $data['evolution_index_date'] != 'index') {
    $index = 'noindex';
}

    elseif(is_category() && $data['evolution_index_category'] != 'index') {
    $index = 'noindex';
}    

    if((is_single() || is_page()) && rwmb_meta( 'Evolution_index') == 'noindex') {
    $index = 'noindex';
}

    if((is_single() || is_page()) && rwmb_meta( 'Evolution_follow') == 'nofollow') {
    $follow = 'nofollow';
}

    echo '<meta name="robots" content="' . $index . ', ' . $follow . '" />' . "\n";
}

// 3. ========== Controlling the Meta Keywords =================================


// 3.1 ======== meta_post_keywords() ===========================================

function meta_post_keywords() {

$meta_post_keywords = "";

    $posttags = get_the_tags();
    if ($posttags) {
    foreach((array)$posttags as $tag) {
    $meta_post_keywords .= $tag->name . ',';
    }
}
    echo '<meta name="keywords" content="' . $meta_post_keywords . '" />' . "\n";

}


// 3.2 ======== meta_home_keywords() ===========================================

function meta_home_keywords() {
    global $evolution_meta_key;
    global $data;

    if(strlen($data['evolution_meta_key']) > 1) {

    echo '<meta name="keywords" content="' . $data['evolution_meta_key'] . '" />' . "\n";
    }
}