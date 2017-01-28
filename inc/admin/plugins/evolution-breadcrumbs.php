<?php

/** HTML - Output:
 * <ul>
 * <li><a href="http://localhost/wordpress">Back Home</a></li>
 * <li><a href="http://localhost/wordpress/category/uncategorized/" title="View all posts in Uncategorized">Uncategorized</a></li>
 * <li class="current">Images Test</li>
 * </ul>
 */

function evolution_breadcrumbs() {
  $name = __('Back Home'); // Text for the Home Icon, only visible in html source code
  $delimiter = ' '; // No need, is added by CSS
  $currentBefore = '<li class="current">';
  $currentAfter = '</li></ul>';


if ( !is_home() && !is_front_page() || is_paged() ) {

    global $post;
    $home = get_bloginfo('url');
    echo '<ul class="crumbs">';
    echo '<li><a href="' . $home . '">' . $name . '</a></li> ' . $delimiter . ' ';


if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);

if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, '  ' . $delimiter . ' '));
      echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;

    }

elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    }

elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    }

elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    }

elseif ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo '<li>' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . '</li>';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    }

elseif ( is_attachment() ) {
      $cat = get_the_category(); $cat = (isset($cat[0]));
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    }

elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    }

elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
      $page = get_page($parent_id);
      $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
      $parent_id  = $page->post_parent;
}

      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    }

elseif ( is_search() ) {
      echo $currentBefore . __('Search results for &#39;', 'evolution') . get_search_query() . '&#39;' . $currentAfter;

    }

elseif ( is_tag() ) {
      echo $currentBefore . __('Posts tagged &#39;', 'evolution');
      single_tag_title();
      echo '&#39;' . $currentAfter;

    }

elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . __('Articles posted by ', 'evolution') . $userdata->display_name . $currentAfter;

    }

elseif ( is_404() ) {
      echo $currentBefore . __('Error 404', 'evolution') . $currentAfter;
    }


if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo $currentBefore .  __('Page') . ' ' . get_query_var('paged') . $currentAfter ;
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  }
}