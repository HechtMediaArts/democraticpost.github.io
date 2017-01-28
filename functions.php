<?php  
// Democratic Post
// ==========================

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 *
 * @category    Evolution
 * @package     Function
 * @author        Hecht MediaArts
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              http://hechtmediaarts.com/evolution-framework/
 *
 */

// Datenbankanfragen und PHP-Speichernutzung im Quellcode ausgeben
function dp_performance()
{
$stat = sprintf('%d queries in %.3f seconds, using %.2fMB memory', get_num_queries() , timer_stop(0, 3) , memory_get_peak_usage() / 1024 / 1024);
echo $stat;
}
//add_action('wp_footer', 'dp_performance', 20);


/* =============================================================================
 HTTP-Verbindungen komplett blocken
============================================================================= */

//add_filter( 'pre_http_request', '__return_true', 100 );

/**
 *
 * Ein CDN über eine Subdomain definieren
 * 
 */
//update_option('upload_path','/usr/local/www/apache24/noexec/wp-content/uploads',true);
//update_option('upload_url_path','http://www.democraticpost.de/wp-content/uploads',true);

/* =============================================================================
 Jetpack Open Graph Tags abschalten => wpSEO
============================================================================= */
-add_filter('jetpack_enable_opengraph', '__return_false', 99);
+add_filter('jetpack_enable_opengraph', '__return_false');
+add_filter('jetpack_enable_open_graph', '__return_false');

// Keine responsiven Bilder
/**
 * Disable responsive image support (test!)
 */
// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

/* =============================================================================
 Post Thumbnail Groessen
============================================================================= */

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1000, 420, true ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'startseite-thumb', 250, 140, true ); 
	add_image_size( 'startseite-gross', 740, 315, true ); //(cropped)
	add_image_size( 'frontpage-thumb', 300, 180, true ); //(cropped)
    add_image_size( 'article', 670, 320, true ); //(cropped)

}

 /* =============================================================================
 3 - Disable dashicons.css
============================================================================= */
/**
 *
 * Disable dashicons.css file_is_displayable_image
 * 
 */ 
function evolution_deregister_dashicons() {
    if(!is_admin() ) {
wp_deregister_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'evolution_deregister_dashicons', 100);


 /* =============================================================================
 4 - Disable all Jetpack CSS
============================================================================= */

// First, make sure Jetpack doesn't concatenate all its CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

// Then, remove each CSS file, one at a time
function jeherve_remove_all_jp_css() {
  wp_deregister_style( 'AtD_style' ); // After the Deadline
  wp_deregister_style( 'jetpack_likes' ); // Likes
  wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
  wp_deregister_style( 'jetpack-carousel' ); // Carousel
  wp_deregister_style( 'grunion.css' ); // Grunion contact form
  wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
  wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
  wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
  wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
  wp_deregister_style( 'noticons' ); // Notes
  wp_deregister_style( 'post-by-email' ); // Post by Email
  wp_deregister_style( 'publicize' ); // Publicize
  wp_deregister_style( 'sharedaddy' ); // Sharedaddy
  wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
  wp_deregister_style( 'stats_reports_css' ); // Stats
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
  wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
  wp_deregister_style( 'presentations' ); // Presentation shortcode
  wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
  wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
  wp_deregister_style( 'widget-conditions' ); // Widget Visibility
  wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
  wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget 
  wp_deregister_style( 'jetpack-top-posts-widget' ); // Top Posts widget
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'jeherve_remove_all_jp_css' );

 /* =============================================================================
 4 - Remove de:comments stylesheet und mashshare stylesheets - print hard in Footer
============================================================================= */
// Remove de:comments Style - print hard in Footer
add_action('wp_enqueue_scripts', 'mytheme_dequeue_css_from_plugins', 100);
function mytheme_dequeue_css_from_plugins()  {
	wp_dequeue_style( "dpc-professional-breadcrumbs-frontend-css" );
    wp_dequeue_style( "decomments" );
    wp_dequeue_style( "cookie-notice-front" );
    wp_deregister_style( 'jetpack-top-posts-widget' );
    
}

function dp_dequeue_unused_styles() { 
   wp_dequeue_style( "mashsb-styles" ); 
    wp_dequeue_style( "lashare-styles" ); 
    wp_dequeue_style( "mashnet-styles" );
    wp_dequeue_style( "banana_content" );                                 
    wp_dequeue_script( 'wp-mediaelement' );
    wp_dequeue_script( 'mediaelement-and-player.min' );
}
add_action('wp_enqueue_scripts', 'dp_dequeue_unused_styles' );


function dp_dequeue_topposts_styles() {

    wp_dequeue_style( 'jetpack-top-posts-widget' );
    wp_deregister_style( 'jetpack-top-posts-widget' );
    wp_dequeue_style( 'mediaelement' );
    wp_deregister_style( 'mediaelement' );
    wp_dequeue_style( 'wp-mediaelement' );
    wp_deregister_style( 'wp-mediaelement' );
    wp_dequeue_style( "dpc-professional-breadcrumbs-frontend" );
    wp_deregister_style( "dpc-professional-breadcrumbs-frontend" );
}
add_action('wp_print_styles', 'dp_dequeue_topposts_styles' );

 /* =============================================================================
 5 - Remove unnützen Scheiss
============================================================================= */
function democratic_dequeue_script_and_styles() {
    wp_dequeue_script( 'jquery.fitvids' );
    wp_deregister_script('wp-mediaelement');
    wp_dequeue_script( 'wp-mediaelement' );
    wp_deregister_script('mediaelement-and-player');
    wp_dequeue_script( 'mediaelement-and-player' );
    wp_deregister_style('fvp-frontend-css');
    wp_dequeue_style( 'fvp-frontend-css' );
    wp_deregister_style('jetpack-top-posts-widget');
    wp_dequeue_style( 'jetpack-top-posts-widget' );
    //wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'democratic_dequeue_script_and_styles' );

 /* =============================================================================
 6 - Alles in den Footer rein - Desktop und Mobile
============================================================================= */
/**
 * Load Enqueued Scripts in the Footer
 *
 * Automatically move JavaScript code to page footer, speeding up page loading time.
 */
function ah_footer_enqueue_scripts() {
   remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_styles', 1);
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts', 'ah_footer_enqueue_scripts');


function democratic_footer_enqueue_scripts() {
    if ( wp_is_mobile() ) {
   remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_styles');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
    }
}
add_action('wp_enqueue_scripts', 'democratic_footer_enqueue_scripts');

/* =============================================================================
   Dequeue unuetzen Scheiss on Mobile
============================================================================== */

function dp_dequeue_scripts() {
    if( wp_is_mobile() ) {
    wp_dequeue_script( 'gonzales' );
    wp_dequeue_script( 'devicepx' );
    }
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );  

/* =============================================================================
   Script nur anzeigen, wenn Adminbar aktiviert
============================================================================== */

if ( is_admin_bar_showing() ) {
// Register Style
function democratic_admin_bar_css() {
    

	wp_enqueue_style( 'admin-bar.min.css', get_stylesheet_uri() );

}

add_action( 'wp_enqueue_scripts', 'democratic_admin_bar_css' );
}


/**
 *
 * Init the admin part of Evolution Framework
 *
 */

$administration_path = TEMPLATEPATH . '/inc/';

require_once ($administration_path . 'evolution-init.php');





/**
 * Add meta Copyright
 *
 */
function technick_add_meta_copyright() {
?>
<meta name="copyright" content="Andreas Hecht" />
<?php
}
add_action( 'wp_head', 'technick_add_meta_copyright' );


/**
 * Wir benötigen eine eigene Excerpt-Länge
 */
function democratic_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'democratic_excerpt_length', 999 );



function democratic_excerpt_more_link( $more ) {
	return '....  <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'weiter &raquo;', 'your-text-domain' ) . '</a>';
}
add_filter( 'excerpt_more', 'democratic_excerpt_more_link' );


/**
 * Add Post Formats
 *
 */
add_theme_support( 'post-formats', array( 'video', 'gallery' ) );


//emoji aus dem header entfernen
function disable_emoji_dequeue_script() {
    wp_dequeue_script( 'emoji' );
}
add_action( 'wp_print_scripts', 'disable_emoji_dequeue_script', 100 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' );


/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 * Tweaked by Pirenko
 *
 * php 5.2+
 *
 * Usage Sample:
 *
 * <?php
 * $thumb = get_post_thumbnail_id();
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @param bool $retina
 * @return array
 */
if ( ! function_exists( 'vt_resize' ) ) :

    function vt_resize( $attach_id = null, $img_url = null, $width = 0, $height = 0, $crop = false , $retina = false) {
        global  $blog_id;
        $divider=1;
        if ($retina==true)
        {
            $width=$width*2;
            $height=$height*2;
            $divider=2;
        }
        // this is an attachment, so we have the ID
        if ( $attach_id ) {

            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $file_path = get_attached_file( $attach_id );

        // this is not an attachment, let's use the image url
        } else if ( $img_url ) {

            $file_path = parse_url( $img_url );
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

            if (!file_exists($file_path)) {
                // Double check for some kind of virtual path that fails with $_SERVER['DOCUMENT_ROOT']
                $imageParts = explode(site_url(), $img_url, 2);
                if (isset($imageParts[1])) {
                    $file_path = ABSPATH  . $imageParts[1];
                }
                // if not found with the backup path...
                if (!file_exists($file_path)) {
                    // simple fix for direct links to images on multi-site installs
                    if (isset($blog_id) && $blog_id > 0) {
                        // uploaded images to media folders
                        $imageParts = explode('/files/', $img_url, 2);
                        if (isset($imageParts[1])) {
                            $img_url = get_site_url(1) .'/wp-content/blogs.dir/'. $blog_id .'/files/'. $imageParts[1];
                            $file_path = parse_url( $img_url );
                            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
                        }
                        // if not found in media folders check theme folders
                        if (!file_exists($file_path)) {
                            // files in the theme folder
                            $imageParts = explode('THEME_URL', $img_url, 2);
                            if (isset($imageParts[1])) {
                                $file_path = THEME_DIR . $imageParts[1];
                            }
                        }
                    }
                }
            }


            //$file_path = ltrim( $file_path['path'], '/' );
            //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

            if (file_exists($file_path)) {

                $orig_size = getimagesize( $file_path );

                $image_src[0] = $img_url;
                $image_src[1] = $orig_size[0];
                $image_src[2] = $orig_size[1];
                if (0)
                {
                    //ORIGINAL IMAGE IS BIGGER - DO NOTHING
                    $vt_image = array (
                        'url' => $img_url,
                        'width' => $orig_size[0],
                        'height' => $orig_size[1],
                        'not_found' => 'false'
                    );
                    return $vt_image;
                }

            } else {
                // couldn't find the image so set the values back to what was provided and return
                $vt_image = array (
                    'url' => $img_url,
                    'width' => $width,
                    'height' => $height,
                    'not_found' => 'true'
                );

                return $vt_image;
            }
        }

        $file_info = pathinfo($file_path);

        //ID WAS RECEIVED, BUT NO IMAGE WAS FOUND
        if ($file_info['basename']=="") {
            return;
        }

        $extension = '.'. $file_info['extension'];

        //EXCLUDE GIF FILES
        if($extension ==".gif")
        {
            $vt_image = array (
                'url' => $img_url,
                'width' => $width,
                'height' => $height,
                'not_found' => 'false'
            );
            return $vt_image;
        }

        // the image path without the extension
        $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

        $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

        // if no image size was sent... use the original
        if (!$width) $width =  $image_src[1];
        if (!$height) $height =  $image_src[2];

        //FORCE SMALL IMAGES TO APPEAR BIGGER
        if ($image_src[1] < $width)
            $image_src[1]=$width+2;
        if ($image_src[2] < $height )
            $image_src[2] = $height+2;
        if ( $image_src[1] > $width || $image_src[2] > $height ) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if ( file_exists( $cropped_img_path ) ) {

                $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

                $vt_image = array (
                    'url' => $cropped_img_url,
                    'width' => $width/$divider,
                    'height' => $height/$divider,
                    'not_found' => 'false'
                );

                return $vt_image;
            }

            // $crop = false
            if ( $crop == false ) {

                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

                // checking if the file already exists
                if ( file_exists( $resized_img_path ) ) {

                    $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                    $vt_image = array (
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0]/$divider,
                        'height' => $proportional_size[1]/$divider,
                        'not_found' => 'false'
                    );

                    return $vt_image;
                }
            }

            // no cache files - let's finally resize it
            // .............................................................

            // first, make sure the directory is writable.
            if (is_writable($file_info['dirname'].'/')) {
                // it's writable, let's do some resizing!
                //WP 3.5 compatible
                //$new_img_path = image_resize( $file_path, $width, $height, $crop, NULL, NULL, 100 );
                $editor = wp_get_image_editor( $file_path );
                if ( is_wp_error( $editor ) ) {
                    //SOMETHING WENT WRONG. PROBABLY THE GD LIBRARY IS OFF:http://bhoover.com/wp_image_editor_supports-tutorial-example/
                    //LET'S RETURN THE ORIGINAL IMAGE
                    $vt_image = array (
                    'url' => $img_url,
                    'width' => $width,
                    'height' => $height,
                    'not_found' => 'false');
                    return $vt_image;
                }
                $editor->set_quality( 88 );

                $resized = $editor->resize( $width, $height, $crop );

                $dest_file = $editor->generate_filename( NULL, NULL );
                $saved = $editor->save( $dest_file );

                if ( is_wp_error( $saved ) ) {
                    //SOMETHING WENT WRONG. PROBABLY THE GD LIBRARY IS OFF:http://bhoover.com/wp_image_editor_supports-tutorial-example/
                    //LET'S RETURN THE ORIGINAL IMAGE
                    //CHECK IF WE RECEIVED AN ID
                    if ($img_url=="")
                    {
                        $img_url=$image_src[0];
                    }
                    $vt_image = array (
                    'url' => $img_url,
                    'width' => $width,
                    'height' => $height,
                    'not_found' => 'false');
                    return $vt_image;
                }

                $new_img_path=$dest_file;
                //END WP 3.5 compatible
                if (is_string($new_img_path)) {
                    $new_img_size = getimagesize( $new_img_path );
                    $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
                } else {
                    // nope, something is preventing the image from resizing
                    $new_img_size[0] = $width/$divider;
                    $new_img_size[1] = $height/$divider;
                    $new_img = $img_url;
                }

            } else {
                // nope, directory isn't writable. return the original file info
                $new_img_size[0] = $width/$divider;
                $new_img_size[1] = $height/$divider;
                $new_img = $img_url;
            }

            // set image data for output
            $vt_image = array (
                'url' => $new_img,
                'width' => $new_img_size[0]/$divider,
                'height' => $new_img_size[1]/$divider,
                'not_found' => 'false'
            );

            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array (
            'url' => $image_src[0],
            'width' => $image_src[1]/$divider,
            'height' => $image_src[2]/$divider,
            'not_found' => 'false'
        );

        return $vt_image;
    }

endif;

//ALLOW IMAGE ENLARGE - ONLY WHEN CROP IS SET TO TRUE
function image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop){
    if ( !$crop ) return null; // let the wordpress default function handle this

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);

    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}


add_filter('image_resize_dimensions', 'image_crop_dimensions', 10, 6);






/**
 * Fügt jedem Kategorie-Link eine Klasse hinzu.
 * @param  Hierzu wird der Katerorie-Titel genommen.
 * @return [[Type]] [[Description]]
 */
function add_slug_class_wp_list_categories($list) {

    $cats = get_categories('hide_empty=0');
    foreach($cats as $cat) {
        $find = 'cat-item-' . $cat->term_id . '"';
        $replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . '"';
        $list = str_replace( $find, $replace, $list );
        $find = 'cat-item-' . $cat->term_id . ' ';
        $replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . ' ';
        $list = str_replace( $find, $replace, $list );
    }

    return $list;
}
add_filter('wp_list_categories', 'add_slug_class_wp_list_categories');


/**
 * Clean wp-caption Output ohne die 10px, die WordPress hinzufügt
 * 
 */
function cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set up the attributes for the caption <div>. */
	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	/* Open the caption <div>. */
	$output = '<div' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<p class="wp-caption-text"><span class="fa fw fa-camera fa-1x"></span>' . $attr['caption'] . '</p>';

	/* Close the caption </div>. */
	$output .= '</div>';

	/* Return the formatted, clean caption. */
	return $output;
}
add_filter( 'img_caption_shortcode', 'cleaner_caption', 10, 3 );


/**
 * Erzeugt die grossen Artikel-Bilder fuer die Startseite
 */
function democratic_startseite_featured_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 1000, 420, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }

/**
 * Erzeugt die grossen Artikel-Bilder fuer die Startseite
 */
function democratic_startseite_featured_thumbnails_small() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 740, 315, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }


/**
 * Erzeugt die grossen Video-Artikel-Bilder fuer die Startseite
 */
function democratic_startseite_featured_video_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 1000, 420, true );
?>
<a class="thumblink" href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"  alt="<?php the_title(); ?>" /><span class="videobutton"></span></a>
<?php }


/**
 * Erzeugt die grossen Artikel-Bilder fuer die Startseite
 */
function democratic_startseite_video_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 920, 450, true );
?>
<a class="thumblink" href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"  alt="<?php the_title(); ?>" /><span class="videobutton front"></span></a>
<?php }


/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Normale Beitragsbilder für Standard-Posts auf Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 300, 200, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }

/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Normale Beitragsbilder für Standard-Posts auf Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_thumbnails_middle() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 300, 180, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }

/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Beitragsbilder für die Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_thumbnails_small() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 250, 140, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }


/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Beitragsbilder für die Meinungen auf der Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_thumbnails_meinungen() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 125, 125, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }


/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Beitragsbilder für die Videos auf der Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_thumbnails_frontvideo() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 125, 125, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /><span class="overlay play"></span></a>
<?php }



function democratic_post_thumbnails_widget() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 400, 225, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>"  itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }

/**
 *
 * Bilder für die Related Posts
 * @uses vt_resize();
 *
 */
function democratic_related_post_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 200, 134, true );
?>
<a class="related-posts-link" href="<?php the_permalink(); ?>" title="<?php global $post; if (is_single()) { echo strip_tags(get_the_excerpt($post->ID)); } ?>"><img class="wp-post-image" src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /></a>
<?php }

/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Spezielle Beitragsbilder für Video-Posts
 * @uses vt_resize();
 *
 */
function democratic_post_video_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 300, 200, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" /><span class="overlay play"></span></a>
<?php }

/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Video Bilder für die Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_video_thumbnails_small() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 250, 140, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" /><span class="overlay play"></span></a>
<?php }

function democratic_post_video_thumbnails_widget() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 400, 225, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" /><span class="overlay play"></span></a>
<?php }

/**
 * Thumbnails für die Related Posts  -  Video
 */
function democratic_related_video_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 200, 134, true );
?>
<a class="related-posts-link" href="<?php the_permalink(); ?>" title="<?php global $post; if (is_single()) { echo strip_tags(get_the_excerpt($post->ID)); } ?>"><img class="wp-post-image" src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" /><span class="overlay play"></span></a>
<?php }

/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Spezielle Beitragsbilder für Galerie-Posts
 * @uses vt_resize();
 *
 */
function democratic_post_gallery_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 300, 200, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /><span class="overlay gallery"></span></a>
<?php }

/**
 *
 * Beitragsbilder -  auf Maß geschneidert - Startseite
 * @uses vt_resize();
 *
 */
function democratic_post_gallery_thumbnails_small() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 250, 140, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /><span class="overlay gallery"></span></a>
<?php }

function democratic_post_gallery_thumbnails_widget() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 400, 225, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>"  itemprop="image" alt="<?php the_title(); ?>" /><span class="overlay gallery"></span></a>
<?php }

/**
 * Thumbnails für die Related Posts  -  Galerie
 */
function democratic_related_post_gallery_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 200, 134, true );
?>
<a class="related-posts-link" href="<?php the_permalink(); ?>" title="<?php global $post; if (is_single()) { echo strip_tags(get_the_excerpt($post->ID)); } ?>"><img class="wp-post-image" src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" /><span class="overlay gallery"></span></a>
<?php }

/**
 * Beitragsbilder für den ersten "Featured Beitrag" auf der Homepage
 */
function democratic_post_blog_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 670, 380, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
<?php }

/**
 * Beitragsbilder für den Single Post
 */
function democratic_post_single_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 670, 320, true );
?>
<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
<?php }

/**
 * Beitragsbilder für den Bereich Wirtschaft
 */
function democratic_post_big_thumbnails() {

    $thumb = get_post_thumbnail_id();
    $image = vt_resize( $thumb,'' , 350, 200, true );
?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" itemprop="image" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
<?php }



/**
 * Die Subheadline oberhalb der Überschrift
 */
function democratic_add_meta_box() {

	$screens = array( 'post');

	foreach ( $screens as $screen ) {

		add_meta_box(
			'democraticpostheadline',
			'Subheadline',
			'democratic_meta_box_callback',
			$screen,
            'side',
            'high'
		);
	}
}
add_action( 'add_meta_boxes', 'democratic_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function democratic_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'democratic_meta_box', 'democratic_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'democratic_subheadline', true );

	echo '<label for="democratic_new_field">';
	_e( 'Hier Subheadline einfügen. Erscheint oberhalb der Überschrift. Siehe Welt.de und Zeit.de.<br /><br />', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="democratic_new_field" name="democratic_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function democratic_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['democratic_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['democratic_meta_box_nonce'], 'democratic_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['democratic_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['democratic_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'democratic_subheadline', $my_data );
}
add_action( 'save_post', 'democratic_save_meta_box_data' );




/**
 * Die Gastautoren-Box unterhalb des Contents
 */
function democratic_autoren_gesucht() { ?>
   
<div class="zilla-alert grey abstand">  
<h5>Sie möchten für uns schreiben? Gern!</h5>
<p>Die Democratic Post ist eine Debattenplattform für alle - auch kontroversen - Perspektiven aus demokratischer Sichtweise. Sollten Sie eine Beitragsidee zu politischen oder gesellschaftlichen Themen haben, schicken Sie den Artikel bitte an unsere Redaktion unter redaktion (at) democraticpost.de.</p>
 </div>   
<?php }



define('KOPA_DOMAIN', 'democraticpost');


function kopa_get_domain() {
    return constant('KOPA_DOMAIN');
}


/**
 * Nav Menu Dropdown - für die Video Kategorien (Tags)
 *
 * @package      BE_Genesis_Child
 * @since        1.0.0
 * @link         https://github.com/billerickson/BE-Genesis-Child
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
 
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
	}

	function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children closing tag
	}

	/**
	* Start the element output.
	*
	* @param  string $output Passed by reference. Used to append additional content.
	* @param  object $item   Menu item data object.
	* @param  int $depth     Depth of menu item. May be used for padding.
	* @param  array $args    Additional strings.
	* @return void
	*/
	function start_el(&$output, $item, $depth, $args) {
 		$url = '#' !== $item->url ? $item->url : '';
 		$output .= '<option value="' . $url . '">' . $item->title;
	}	

	function end_el(&$output, $item, $depth){
		$output .= "</option>\n"; // replace closing </li> with the option tag
	}
}


function democratic_add_search_box ( $items, $args ) {
       
       // only on secondary menu
       if( 'secondary' === $args -> theme_location )
             $items .= '<li class="menu-item menu-item-search">' . get_search_form( FALSE ) . '</li>';
       
       return $items;
 }
 add_filter( 'wp_nav_menu_items', 'democratic_add_search_box', 10, 2 );


function kopa_search_title(){           // highlight the post title in search pages
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<span class="kopa-search-keyword">\0</span>', $title);
    return $title;
}

/* ==============================================================================
 * Mobile Menu
  ============================================================================= */

class kopa_mobile_menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        
        if ($depth == 0)
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' clearfix"' : 'class="clearfix"';
        else 
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : 'class=""';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        if ($depth == 0) {
            $item_output = $args->before;
            $item_output .= '<a Class="menue"' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<span>+</span><div class='clear'></div><div class='menu-panel clearfix'><ul>";
        } else {
            $output .= '<ul>'; // indent for level 2, 3 ...
        } 
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= '</ul>';
        } 
    }

}


/**
 * Get gallery string ids after getting matched gallery array
 * @return array of attachment ids in gallery
 * @return empty if no gallery were found
 */
function kopa_content_get_gallery_attachment_ids( $content ) {
    $gallery = kopa_content_get_gallery( $content );

    if (isset( $gallery[0] )) {
        $gallery = $gallery[0];
    } else {
        return '';
    } 

    if ( isset($gallery['shortcode']) ) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    } 

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if ( isset( $gallery_string_ids[0][0] ) ) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    } 

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if ( isset( $gallery_ids[0] ) ) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    } 

    return $gallery_ids;
}

function kopa_content_get_gallery($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('gallery'));
}

function kopa_content_get_video($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function kopa_content_get_audio($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function kopa_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}

/**
 * Die Inhaltsbreite definieren
 * 
 */
if ( ! isset( $content_width ) ) {
	$content_width = 670;
}


/**
 * Keine eigenen Pingbacks zulassen
 * 
 */
function democratic_no_self_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}

add_action( 'pre_ping', 'democratic_no_self_ping' );



/**
 * Sorgt für responsive Videos, auch fuer Vimeo
 * 
 * 
 */
function democratic_wrap_oembed( $html ){
  $html = preg_replace( '/(width|height)="\d*"\s/', "", $html ); // Strip width and height #1

  return'<div class="embed-responsive embed-responsive-16by9">'.$html.'</div>'; // Wrap in div element and return #3 and #4

}
add_filter( 'embed_oembed_html','democratic_wrap_oembed',10,1);


/**
 * Entfernen der XML-RPC Schnittstelle aus dem HTML-Header der Website
 */
add_filter( 'wp_headers', 'FastWP_remove_x_pingback' );
 function FastWP_remove_x_pingback( $headers )
 {
 unset( $headers['X-Pingback'] );
 return $headers;
 }

/**
 * Vollständiges Entfernen der XML-RPC Schnittstelle
 * 
 */ 
add_filter( 'xmlrpc_enabled', '__return_false' );



/**
 * Stop Heartbeat Schnittstelle, ausser bei Beiträgen
 */ 
//add_action('init', 'stop_heartbeat', 1);
function stop_heartbeat()
	{
	global $pagenow;
	if ($pagenow != 'post.php' && $pagenow != 'post-new.php') wp_deregister_script('heartbeat');
	}

/**
 * Befreit den Header von unnötigen Einträgen
 */ 
add_action('init', 'remheadlink');
function remheadlink()
	{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'wp_shortlink_header', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	}

/**
 * Die Readability Buttons für Druckansicht usw.
 */
function democratic_print_button() {
?>    
<div class="readability">
<header><span>Druckversion</span></header>
 <a class="drucken" href="javascript:window.print()"> <img src="https://www.democraticpost.de/wp-content/uploads/2015/09/druckversion.png" width="146" height="20" alt="Webseite ausdrucken"> </a> 
</div>
<?php }

/**
 * Zeigt eine Box an, die Spenden mittels PayPal ansammelt
 */
function democratic_spenden_box() {
?>
<!-- Beginn PayPal Spenden-Button  -->
<div class="spenden-box">
<h4>Democratic Post unterstützen</h4>
<p>Wenn Ihnen unser Artikel gefallen hat: Bitte unterstützen Sie diese Form des Journalismus.</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="29GWA9MTFCCNS">
<table>
<tr><td class="spenden-option"><input type="hidden" name="on0" value="Auswaehlen">Bitte wählen Sie:</td>
<td class="spenden-option left">
<select class="option" name="os0">
	<option value="Option 1:">€3,00 EUR</option>
	<option value="Option 2:">€5,00 EUR</option>
	<option value="Option 3:">€10,00 EUR</option>
	<option value="Option 4:">€15,00 EUR</option>
	<option value="Option 5:">€20,00 EUR</option>
	<option value="Option 6:">€30,00 EUR</option>
	<option value="Option 7:">€50,00 EUR</option>
	<option value="Option 8:">€80,00 EUR</option>
	<option value="Option 9:">€100,00 EUR</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.democraticpost.de/wp-content/uploads/2015/12/paypal-btn.png" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal." title="Jetzt einfach, schnell und sicher online spenden – mit PayPal.">
<img alt="" style="border: 0;" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1" class="no">
</form>
</div>
<!-- Ende PayPal Spenden-Button  -->    
<?php }

/**
 * Zeigt eine Einladung zum Kommentieren der Artikel an
 */
function democratic_comment_message() {
?>
<div class="please-comment zilla-alert grey">
        <h4>Wie ist Ihre Meinung zum Thema?</h4>
        <p>Lassen Sie uns an Ihrer Meinung teilhaben und gemeinsam über das Thema diskutieren. Konstruktive Kritik und Ergänzungen sind immer willkommen.</p>
        <p class="commentbutton"><a href="#respond" class="evo-button" title="Beitrag kommentieren">Beitrag kommentieren &raquo;</a></p>
        </div>    
<?php 
}


/**
 *
 * User davon abhalten, ihre Passwörter zu ändern
 * 
 */ 
class Password_Reset_Removed
{

  function __construct() 
  {
    add_filter( 'show_password_fields', array( $this, 'disable' ) );
    add_filter( 'allow_password_reset', array( $this, 'disable' ) );
  }

  function disable() 
  {
    if ( is_admin() ) {
      $userdata = wp_get_current_user();
      $user = new WP_User($userdata->ID);
      if ( !empty( $user->roles ) && is_array( $user->roles ) && $user->roles[0] == 'administrator' )
        return true;
    }
    return false;
  }

}

$pass_reset_removed = new Password_Reset_Removed();


/**
 * Automatische Versionierung der Dateinamen
 * @param  [[Type]] $file [[Description]]
 * @return [[Type]] [[Description]]
 */
function auto_version($file)
{
  if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
    return $file;

  $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
  return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}

 /* =============================================================================
 1 - Videos zuletzt laden wegen der Performance
============================================================================= */
function add_video_load( $content ) { 
    if( is_feed() || is_preview() || ( function_exists( 'is_mobile' ) && is_mobile() ) ) return $content; if ( false !== strpos( $content, 'data-src' ) ) return $content; $placeholder_image = ('data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='); $content = preg_replace( '#<iframe([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<iframe${1}src="%s" data-src="${2}"${3}><noscript><iframe${1}src="${2}"${3}></noscript>', $placeholder_image ), $content ); return $content; } 

add_filter( 'the_content', 'add_video_load' );

/**
 * Defer Loading for Videos - the JavaScript for the Action
 * @param  [[Type]] $content [[Description]]
 * @return [[Type]] [[Description]]
 */  
function democratic_defer_video_load() {
    if ( is_single() ) {
?>

<!-- Defer Videos for Performance -->          
<script>function init(){var videoDefer=document.getElementsByTagName('iframe');for(var i=0;i<videoDefer.length;i++){if(videoDefer[i].getAttribute('data-src')){videoDefer[i].setAttribute('src',videoDefer[i].getAttribute('data-src'));}}}window.onload=init;</script>
<!-- END Defer Videos -->
<?php  
    }
}
add_action( 'wp_footer', 'democratic_defer_video_load');


 /* =============================================================================
 2 - Dynamische Copyright Daten im Footer
============================================================================= */

// Dynamische Copyright Daten im Footer ausgeben. © Von Jahr bis Jahr...
// Im Theme wird die Funktion ausgegeben mit: 
/* <?php echo ah_dynamic_copyright(); ?> - Diesen Tag dorthin einfügen, wo das Copyright erscheinen soll */
function ah_dynamic_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= ' - ' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}

 /* =============================================================================
 3 - Eigenes Logo für den Login-Bereich
============================================================================= */

// CUSTOM ADMIN LOGIN HEADER LOGO
   function my_custom_login_logo() {
    echo '<style type="text/css"> h1 a { background-image:url('.get_bloginfo('template_directory').'/images/facebook-profil-bild.png) !important; } </style>';
   }
   add_action('login_head', 'my_custom_login_logo');

// Die URL des Logos auf die eigene Website zeigen lassen 
function gp_change_login_page_url($login_header_url) {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'gp_change_login_page_url' );

//Den Seitentitel des Logos ändern
function gp_change_login_page_title($login_header_title) {
    return get_bloginfo('title');
}
add_filter( 'login_headertitle', 'gp_change_login_page_title' );



/* =============================================================================
 Google-Werbung nach dem ersten Absatz einfuegen
============================================================================= */

add_filter( 'the_content', 'prefix_insert_post_ads' );

function prefix_insert_post_ads( $content ) {
	
	$ad_code = '<!-- In Content Google Advertisement -->		
<div class="content-ads manuell">
<div class="disclaimer">Anzeige</div>
<!-- Medium Rectangle -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-9032795059293748"
     data-ad-slot="5393668781"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<!-- END In Content Google Advertisement -->';

	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $ad_code, 2, $content );
	}
	
	return $content;
}
 
// Parent Function that makes the magic happen
 
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}
	
	return implode( '', $paragraphs );
}


 /* =============================================================================
 # Werbung - kr_inject_content
============================================================================= */

/**
 * Fügt statische Inhalte (in der Regel Werbung) innerhalb von Artikeln ein,
 * falls sie älter als X Tage sind. Inhalt, Alter und Position werden in der
 * Funktion definiert.
 * @global type $post
 * @param type $content
 * @return string
 */
function kr_inject_content($content) {
	global $post;

	// Inhalt, der eingefügt werden soll;
		$injectedContent = '<!-- In Content Google Advertisement -->		
<div class="content-ads manuell">
<div class="disclaimer">Anzeige</div>    
<!-- Medium Rectangle -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-9032795059293748"
     data-ad-slot="5393668781"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<!-- END In Content Google Advertisement -->';
		$injectedContentEnd = '<!-- In Content Google Advertisement -->		
<div class="content-ads manuell">
<div class="disclaimer">Anzeige</div>    
<!-- Medium Rectangle -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-9032795059293748"
     data-ad-slot="5393668781"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<!-- END In Content Google Advertisement -->';

	// Nur bei Einzelansicht einfügen
	if (!is_single())
		return $content;
	
	$content .= $injectedContentEnd;

	// Nur bei Artikeln ab einem gewissen Alter einfügen
	// Änderung 27.2.2014: Laut Giammarco nicht mehr gewünscht
	/*$date = new DateTime($post->post_date);
	$limit = new DateTime();
	$limit->modify('-15 days');
	if ($date > $limit) {
		return $content;
	}*/

	// Definiert die Positionierung. Schlüssel ist ein String, dessen Vorkommen
	// gezählt werden. Wert ist die Anzahl der Vorkommnisse des Schlüssel, bevor
	// der Inhalt eingefügt wird.
	// z.B. bedeutet <h2> => 2, dass der Inhalt vor der zweiten h2 eingefügt
	// werden würde.
	// Falls nicht genügend Vorkommnisse des Schlüssels gefunden wurden, werden
	// der Reihe nach die anderen Möglichkeiten versucht.
	$positions = array(
		'<h2>' => 2,
		'<h3>' => 2,
		'<p>' => 6
	);

	foreach ($positions as $delimiter => $position) {
		$splitContent = explode($delimiter, $content);
		if (count($splitContent) >= $position+1) {
			$splitContent[$position-1] .= $injectedContent;
			$content = implode($delimiter, $splitContent);
			break;
		}
	}

	return $content;
}
add_filter('the_content', 'kr_inject_content');





/**
 * Nach 12 Monaten die Kommentare ausschalten - Custom Filter
 * @author Andreas Hecht
 * @param  [[Type]] 'wpseo_set_noindex_age' [[Description]]
 * @param  [[Type]] function($months        [[Description]]
 * @return [[Type]] [[Description]]
 */
add_filter(
  'wpseo_set_noindex_age',
  function($months) {
    return 12;
  }
);

/* =============================================================================
 Ein kompaktes Archiv nach Jahr und Monat
============================================================================= */
function compact_archive( $style='initial', $before='<li>', $after='</li>' ) {
 	$result = false;
	// if the Plugin Output Cache is installed we can cheat...
	if (defined('POC_CACHE_4')) {
		$key = 'c_a'.$style.$before.$after;
		poc_cache_timer_start();
		$result = poc_cache_fetch($key);
		if ($result) $cache_time = sprintf('<!-- Compact Archive took %.3f milliseconds from the cache -->', 1000 * poc_cache_timer_start());
	}
	// ... otherwise we do it the hard way
	if (false === $result) {
		$result = utf8_encode(get_compact_archive($style, $before, $after));
		if (defined('POC_CACHE_4')) {
			poc_cache_store($key, $result);
			$cache_time = sprintf('<!-- Compact Archive took %.3f milliseconds -->', 1000 * poc_cache_timer_start());			
		}
	} 

	echo $result;

if (defined('POC_CACHE_4')) echo  $cache_time;

}

/********************************************************************************************************
	Stuff below this point is not meant to be used directly
*********************************************************************************************************/

function get_compact_archive( $style='initial', $before='<li>', $after='</li>' ) {
	global $wpdb, $wp_version;
	setlocale(LC_ALL,WPLANG); // set localization language
	$below21 = version_compare($wp_version, '2.1','<');
	// WP 2.1 changed the way post_status and post_type fields work
	if ($below21) {
		$now = current_time('mysql');
		$results = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month FROM " . $wpdb->posts . " WHERE post_date <'" . $now . "' AND post_status='publish' AND post_password='' ORDER BY year DESC, month DESC");
	} else {
		$results = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month FROM " . $wpdb->posts . " WHERE post_type='post' AND post_status='publish' AND post_password='' ORDER BY year DESC, month DESC");
	}
	if (!$results) {
		return $before.__('Archive is empty').$after;
	}
	$dates = array();
	foreach ($results as $result) {
		$dates[$result->year][$result->month] = 1;
	}
	unset($results);
	$result = '';
	foreach ($dates as $year => $months){
		$result .= $before.'<strong><a href="'.get_year_link($year).'">'.$year.'</a>: </strong> ';
		for ( $month = 1; $month <= 12; $month += 1) {
			$month_has_posts = (isset($months[$month]));
			$dummydate = strtotime("$month/01/2001");
			// get the month name; strftime() localizes
			$month_name = strftime("%B", $dummydate); 
			switch ($style) {
			case 'initial':
				$month_abbrev = $month_name[0]; // the inital of the month
				break;
			case 'block':
				$month_abbrev = strftime("%b", $dummydate); // get the short month name; strftime() localizes
				break;
			case 'numeric':
				$month_abbrev = strftime("%m", $dummydate); // get the month number, e.g., '04'
				break;
			default:
				$month_abbrev = $month_name[0]; // the inital of the month
			}
			if ($month_has_posts) {
				$result .= '<a href="'.get_month_link($year, $month).'" title="'.$month_name.' '.$year.'">'.$month_abbrev.'</a> ';
			} else {
				$result .= '<span class="emptymonth">'.$month_abbrev.'</span> ';
			}
		}
		$result .= $after."\n";
	}
	return $result;
}

// Compact Archive Shortcode 

function compact_archives_shortcode($atts) { 
extract( shortcode_atts( array(
		'style' => 'initial',
		'before' => '<li>',
		'after' => '</li>'
	), $atts ) );
	if ($before == "<li>")	:
		$wrap = "<ul>";
	endif; 

	if ($after == "</li>") :
$wrap_end = "</ul>";
endif;

$string = $wrap . get_compact_archive($style, $before, $after) . $wrap_end;  

return $string;

} 

add_shortcode( 'compact_archive', 'compact_archives_shortcode' );

// Die Autoreninfo-Box auf der Autorenseite NICHT Verwendet!!!
function ah_authorinfo_authorpage() {
?>    
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
<?php }

