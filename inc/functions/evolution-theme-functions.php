<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */
 
/**
 * Evolution custom functions part
 * 
 * Contains all the theme functions
 * 
 * @package Evolution Framework
 * @subpackage Theme Functions
 * @author Hecht MediaArts
 * @license http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link http://www.studiopress.com/themes/genesis
 */



// Make theme available for translation
    load_theme_textdomain('evolution', TEMPLATEPATH . '/inc/languages');



// Removing the default gallery styles
add_filter( 'use_default_gallery_style', '__return_false' );


// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
    add_filter( 'gallery_style', 'evolution_remove_gallery_css' );


// Removes the default styles that are packaged with the Recent Comments widget
    function evolution_remove_recent_comments_style() {
        add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
    add_action( 'widgets_init', 'evolution_remove_recent_comments_style' );


// Adding theme support for automatic feed links
    if(function_exists('add_theme_support')) {
        add_theme_support('automatic-feed-links');
    //WP Auto Feed Links
}

// This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

// Adding support for navigation menus
    add_theme_support('nav_menus');
    register_nav_menu('secondary', __('Header Top Navigation Menü', 'revothemes'));
        register_nav_menu('primary', __('Haupt Navigation Menü', 'revothemes'));
        register_nav_menu('footer', __('Footer Navigation Menü', 'revothemes'));
        register_nav_menu('politik', __('Politik Navigation Menü', 'revothemes'));
        register_nav_menu('start', __('Startseite. Alle Artikel usw. Navigation Menü', 'revothemes'));
        register_nav_menu('meinungen', __('Meinungen. Kommentare', 'revothemes'));
        register_nav_menu('videos', __('Videos. Startseite', 'revothemes'));
        register_nav_menu('gesellschaft', __('Gesellschaft. Startseite', 'revothemes'));
        register_nav_menu('feuilletton', __('Feuilletton. Startseite', 'revothemes'));
        register_nav_menu('debatte', __('Debatte. Startseite', 'revothemes'));
        register_nav_menu('unterhaltung', __('Unterhaltung. Startseite', 'revothemes'));
        register_nav_menu('wirtschaft', __('Wirtschaft. Startseite', 'revothemes'));
        register_nav_menu('news', __('Newsthemen unter Hauptnavigation', 'revothemes'));
        register_nav_menu('glueck', __('Navigation für Glück und Erfolg - Startseite', 'revothemes'));


/**
 * Video Menu
 *
 */
function be_mobile_menu() {
	wp_nav_menu( array(
		'theme_location' => 'videos',
		'walker'         => new Walker_Nav_Menu_Dropdown(),
		'items_wrap'     => '<div class="videos-menu"><form><select onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>',
	) );	
}
add_action( 'democratic_video_menu', 'be_mobile_menu' );


/**
 * 
 * Loading the required Scripts correctly and save.
 * 
 * @since WordPress 3.6
 * 
 */

    function revothemes_theme_scripts() {

        if (!is_admin()) { // hiding the script from the admin section

        wp_enqueue_script('jquery');

        wp_register_script(
            'general',
            get_template_directory_uri('template_directory') . '/js/general.js', '', '', true);
        wp_enqueue_script('general');

        }
}
add_action('wp_enqueue_scripts', 'revothemes_theme_scripts');


/**
 * 
 * Gets the first image from a post and adds a thumbnail to the sidebar box widget
 * 
 */
function evolution_sidebarbox_images() {

if(has_post_thumbnail()) {
                $thumb = evolution_post_thumbURL();
                echo '<img src="';
                echo get_bloginfo('template_directory');
                echo '/inc/admin/thumb.php?src=' . $thumb . '&amp;h=48&amp;w=48" alt="';
                the_title();
                echo '" />';

            } else {    

$image = evolution_get_first_image();
                if($image) :
                    echo '<img src="';
                    echo get_bloginfo('template_directory');
                    echo '/inc/admin/thumb.php?src=' . $image . '&amp;h=48&amp;w=48" alt="';
                    the_title();
                    echo '" />';
                    endif;

        }
}

/**
 * Related Articles
 * 
 * Nutzt die Kategorien, um die ähnlichen Artikel anzuzeigen
 */
function democratic_related_posts() {
    
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 6, // Number of related posts that will be shown.
'caller_get_posts'=>1
);
$my_query = new wp_query( $args );
if( $my_query->have_posts() )  {
echo '<div class="related-posts"><h4><em>Weitere interessante Artikel</em></h4><ul class="relatedposts clearfix">';
$c = 0; while( $my_query->have_posts() ) {
$my_query->the_post(); $c++; 
if( $c == 3) {
	$style = 'class="third clearfix"';
	$c = 0;
}
else $style=''; ?>
<li <?php echo $style; ?>>
<article class="entry-item">                                         
<div class="entry-thumb">
                                                  
      <?php if ( has_post_format( 'video' ) ) : ?>
       <?php the_post_thumbnail( 'startseite-thumb' ); ?>                       
         <?php elseif ( has_post_format( 'gallery' ) ) : ?>
         <?php the_post_thumbnail( 'startseite-thumb' ); ?>
         <?php else : ?>       
        <?php the_post_thumbnail( 'startseite-thumb' ); ?>
        <?php endif; ?>           
    </div>                                          
<div class="entry-content">
<?php 
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<span class="post-categories"><a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="Alle Beiträge anschauen in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a></span>';
        $sep = ', ';
    }
?>
                                    <header>
                                    <h4 class="entry-title"><a href="<?php the_permalink($post->ID); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                    </header>
            
                                            </div><!-- entry-content -->
                                        </article><!-- entry-item -->
                                    </li>
<?php
}
echo '</ul></div>';
}
}
$post = $orig_post;
wp_reset_postdata();    
}



function kopa_get_about_author() {
    if ('show' == get_option('kopa_theme_options_post_about_author', 'show')) { ?>

        <div class="about-author clearfix">
            <h3><?php _e( 'Über den Autor', kopa_get_domain() ); ?></h3>

            <div class="about-author-detail clearfix">
                <a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 74 ); ?></a>
                <div class="author-content">
                    <header>                              
                        <a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author_meta('display_name'); ?></a>
                    </header>
                    <p><?php the_author_meta( 'description' ); ?></p>

                    <?php 
                    $author_facebook_url = get_the_author_meta( 'facebook' );
                    $author_twitter_url  = get_the_author_meta( 'twitter' );
                    $author_feed_url     = get_the_author_meta( 'feedurl' );
                    $author_gplus_url    = get_the_author_meta( 'google-plus' );
                    $author_flickr_url   = get_the_author_meta( 'flickr' );

                    if ( $author_facebook_url || $author_twitter_url || $author_feed_url || $author_gplus_url || $author_flickr_url ) {
                    ?>
                    <ul class="social-link clearfix">
                        <!-- facebook -->
                        <?php if ( ! empty( $author_facebook_url ) ) { ?>
                        <li><a href="<?php echo esc_url( $author_facebook_url ); ?>"><?php echo KopaIcon::getIcon('facebook'); ?></a></li>
                        <?php } // endif ?>

                        <!-- twitter -->
                        <?php if ( ! empty( $author_twitter_url ) ) { ?>
                        <li><a href="<?php echo esc_url( $author_twitter_url ); ?>"><?php echo KopaIcon::getIcon('twitter'); ?></a></li>
                        <?php } // endif ?>
                        
                        <!-- feed -->
                        <?php if ( ! empty( $author_feed_url ) ) { ?>
                        <li><a href="<?php echo esc_url( $author_feed_url ); ?>"><?php echo KopaIcon::getIcon('rss'); ?></a></li>
                        <?php } // endif ?>
                        
                        <!-- google plus -->
                        <?php if ( ! empty( $author_gplus_url ) ) { ?>
                        <li><a href="<?php echo esc_url( $author_gplus_url ); ?>"><?php echo KopaIcon::getIcon('google-plus'); ?></a></li>
                        <?php } // endif ?>
                        
                        <!-- flickr -->
                        <?php if ( ! empty( $author_flickr_url ) ) { ?>
                        <li><a href="<?php echo esc_url( $author_flickr_url ); ?>"><?php echo KopaIcon::getIcon('flickr'); ?></a></li>
                        <?php } // endif ?>
                    </ul>
                    <?php } // endif ?>
                    <!-- social-link -->
                </div><!--author-content-->
            </div>
        </div><!--about-author-->

        <?php
    }
}
