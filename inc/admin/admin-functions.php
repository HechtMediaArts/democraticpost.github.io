<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Custom Functions file.
 *
 * @category Evolution Framework
 * @package  Administration
 * @subpackage admin
 * @author   Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.hechtmediaarts.com/themes/evolution
 */

/*------------------------------------------------------------------------------

=================================
    INDEX:
=================================

1.0 - Custom RSS Feed Output => evolution_rss()
2.0 - Remove unnecessary parts from wp_head()
3.0 - Custom Favicon Output => evolution_custom_favicon()
4.0  - Show analytics code in footer => evolution_show_analytics()
5.0  - Output CSS from standarized options => evolution_custom_css()
6.0 - evolution_custom_background()
7.0 - SEO for split comments into multiple pages => evolution_canonical_for_comments()
8.0 - Get first image from a spezific post => evolution_get_first_image()
9.0 - Security => remove_comment_author_class()
10.0 - Building the Recent Comments => evolution_recent_comments()
11.0 - Output post thumbnails => evolution_the_post_thumbnails()
12.0 - Output post thumbnail URL => evolution_post_thumbURL()
13.0 - Gallery Shortcode Output => evolution_gallery()
14.0 - Share this buttons, Twitter, Facebook, Google+ => evolution_share_this()
15.0 - Manage WordPress contact fields
16.0 - Post-thumbnails for feeds => evolution_post_thumbnail_feeds()
17.0 - Remove Magic Quotes => get rid of unnecessary backslashes
18.0 - Canonical Permalink => canonical_request()
19.0 - Prints jQuery in footer on front-end => evolution_print_jquery_in_footer()
20.0 - Defer-Attribut für Skripte => evolution_add_script_defer()
21.0 - Remove WordPress versions totally from source and feed
22.0 - Add dynamic classes to the <body> element
23.0 - Add an rel author link to the wp_head => evolution_author_link();
24.0 - Override the default sanitization filter for textarea in the Options Framework
25.0 - Add an rel publisher link to the wp_head => evolution_publisher_link();
26.0 - Adds the necessary css for the fullpage background image to the wp head => evolution_fullpage_background();

 -----------------------------------------------------------------------------*/


// 1.0 ========== Custom RSS Feed Output =======================================

function evolution_custom_feed() {

		if (of_get_option('rss_feed') != '') {
            echo "<!-- Custom Feed -->\n";
	        echo '<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="'.  of_get_option('rss_feed')  .'" />'."\n";
	    }
		else { ?>
<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="<?php echo home_url();?>/feed/" />
<?php }
}
add_action('wp_head', 'evolution_custom_feed');

// 2.0 ========== Remove unnecessary parts from wp_head() ======================

remove_action( 'wp_head', 'feed_links', 2 );                            							// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' );                                 								// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' );                         					// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' );                           						// index link
remove_action( 'wp_head', 'parent_post_rel_link',10, 0 );               				// prev link
remove_action( 'wp_head', 'start_post_rel_link',10, 0 );                					// start link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );   	// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );              			//Display shortlink


// 3.0 ========== Custom Favicon Output => evolution_custom_favicon() =========

function evolution_custom_favicon() {

		if (of_get_option('custom_favicon') != '') {
            echo "<!-- Custom Favicon -->\n";
	        echo '<link rel="shortcut icon" href="'.  of_get_option('custom_favicon')  .'" type="image/x-icon" />'."\n";
	    }
		else { ?>
<link rel="shortcut icon" href="<?php echo get_bloginfo('template_directory') ?>/images/favicon.ico" type="image/x-icon" />
<?php }
}

//add_action('wp_head', 'evolution_custom_favicon');


// 4.0 ========== Show analytics code in footer => evolution_show_analytics()

function evolution_show_analytics() {

	$output = of_get_option('google_analytics');
	if ( $output <> "" )
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','evolution_show_analytics');


/*-----------------------------------------------------------------------------------*/
/* 5.0 - Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/
// #################### deprecated since 2.0 ####################
function evolution_custom_css() {
		global $data;
		$output = '';
		$custom_css = $data['evolution_custom_css'];

		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}

		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom CSS from Option Panel -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}

}
//add_action('wp_head', 'evolution_custom_css');  //If you need this function, comment it out.


// 6.0 ========== evolution_custom_background() ==============================

function evo_custom_background() {

$output = '';

	$background = of_get_option('background');
	$color = of_get_option('background');
	$padding = " } #wrap {padding: 0 30px 30px 30px; padding: 0 1.875rem 1.875rem 1.875rem; margin: 25px auto; margin: 1.5625rem auto; box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3)";
	if ( ! $background && ! $color )
		return;
    $color = $background['color'];
	$output = $color ? "background-color: ". $background['color'] . $padding . ";" : '';

	if ( $background['image'] ) {
		$background['image'] = " background-image: url(". $background['image'] .");";

		$repeat = $background['repeat'];
		if ( $background['repeat'] )
			$repeat = 'repeat';
		$repeat = " background-repeat: ". $background['repeat'] .";";

		$position = $background['position'];
		if ( $background['position'] )
			$position = 'left';
		$position = " background-position: ". $background['position'] .";";

		$attachment = $background['attachment'];
		if ( $background['attachment'] )
			$attachment = 'scroll';
		$attachment = " background-attachment: ". $background['attachment'] .";";

		$output .= $background['image'] . $repeat . $position . $attachment;
	}


if ($output <> '') {
			$output = "<!-- Evolution Custom Background -->\n<style type=\"text/css\">\n body {" . $output . "}\n </style>\n";
			echo $output;
		}
}

add_action('wp_head', 'evo_custom_background');


// 7.0 ========== SEO for split comments into multiple pages ==================

function evolution_canonical_for_comments() {
	global $cpage, $post;
	if ( $cpage > 1 ) :
		echo "\n";
	  	echo "<link rel='canonical' href='";
	  	echo get_permalink( $post->ID );
	  	echo "' />\n";
	 endif;
}

add_action( 'wp_head', 'evolution_canonical_for_comments' );


// 8.0 ========== Get first image from a specific post ========================

function evolution_get_first_image() {
 global $post, $posts;
 $first_img = '';
 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
 if(isset($matches[1][0])){
 $first_img = $matches [1][0];
 return $first_img;
 }
}

// 9.0 ========== Security => remove_comment_author_class() ===================

// Security: Hide Usernames from Classes
function remove_comment_author_class( $classes ) {
	foreach( $classes as $key => $class ) {
		if(strstr($class, "comment-author-")) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}

add_filter( 'comment_class' , 'remove_comment_author_class' );

// Security: Hide WordPress Version in Sourcecode Head
remove_action('wp_head','wp_generator');


// 10.0 ========== Building the Recent Comments => evolution_recent_comments()

   /* Function for Revolution-Themes Sidebar Box Widget => revo-sidebar-box.php */

function evolution_recent_comments($no_comments = 4, $comment_len = 50) {
    global $wpdb;
    $request = "SELECT * FROM $wpdb->comments";
    $request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
    $request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
    $request .= " ORDER BY comment_date DESC LIMIT $no_comments";
    $comments = $wpdb->get_results($request);
    if ($comments) {
        foreach ($comments as $comment) {
            ob_start();
            ?>
                <li><?php echo get_avatar( $comment, 40 ); ?>
                    <a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><cite><?php echo evolution_get_author($comment); ?></cite></a>
                    <span><?php echo __('vor ', 'evolution'), human_time_diff(get_comment_date('U',$comment->comment_ID), current_time('timestamp')) ; ?>:</span>
                    <span class="which-post"><a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>">(<?php echo get_the_title($comment->comment_post_ID); ?>)</a></span>
                    <p><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>...</p>
                </li>
            <?php
            ob_end_flush();
        }
    } else {
        echo '<li>'.__('No comments yet', 'evolution').'';
    }
}

// Get author for comment
function evolution_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = __('Anonymous', 'evolution');
    else
        $author = $comment->comment_author;
    return $author;
}

// 11.0 ========== evolution_the_post_thumbnails() ============================




// 12.0 ========== evolution_post_thumbURL() ==================================

function evolution_post_thumbURL() {
	global $post, $posts;
	$thumbnail = '';
	ob_start();the_post_thumbnail(180,180,true);$toparse=ob_get_contents();ob_end_clean();
	preg_match_all('/src=("[^"]*")/i', $toparse, $img_src); $thumbnail = str_replace("\"", "", $img_src[1][0]);
	return $thumbnail;
}


function the_excerpt_max_charlength($charlength) {
   $excerpt = get_the_excerpt();
   $charlength++;
   if(strlen($excerpt)>$charlength) {
       $subex = substr($excerpt,0,$charlength-5);
       $exwords = explode(" ",$subex);
       $excut = -(strlen($exwords[count($exwords)-1]));
       if($excut<0) {
            echo substr($subex,0,$excut);
       } else {
       	    echo $subex;
       }
       echo "...";
   } else {
	   echo $excerpt;
   }
}


// 14.0 ========== Share this buttons, Twitter, Facebook, Google+ ==============

function evolution_share_this(){

    $content = '';

    if(!is_feed() ) {

        $content .= '<div class="share-this fix">
        				<p><strong>Dir hat dieser Beitrag gefallen? Dann hilf mir bitte und teile ihn.</strong></p>
                    <a href="http://twitter.com/share"
                    class="twitter-share-button"
                    data-count="horizontal">Tweet</a>
                    <div class="facebook-share-button">
                    <iframe src="http://www.facebook.com/plugins/like.php?href='.
                    urlencode(get_permalink())
                    .'&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=21"
                    style="width:150px; height:21px;"
                    ></iframe>
                    </div>
                    <div class="google-share-button">
                    <g:plusone size="medium"></g:plusone>
                    </div>
                    <div class="fr">
                    <a href="https://getpocket.com/save" class="pocket-btn" data-lang="en"
  							data-save-url="{Permalink}"
  							data-pocket-count="horizontal" 
  							data-pocket-align="left"
  						>Pocket</a>
                    </div>
                </div>';
    }
    return $content;
}


function evolution_share_scripts() {

  if(is_single() ) {	

?>
<!-- Evolution Share this Scripts -->
<script src="http://platform.twitter.com/widgets.js" defer='defer'></script>
<script src="https://apis.google.com/js/plusone.js" defer='defer'></script>
<script type="text/javascript" defer='defer'>!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>

<?php }
}

//add_action('wp_footer', 'evolution_share_scripts');


function evolution_share_this_index(){
	?>

<div class="share-this fix index">
                    <a href="http://twitter.com/share"
                    class="twitter-share-button"
                    data-count="horizontal">Tweet</a>
                    <div class="facebook-share-button">
                    <iframe src="http://www.facebook.com/plugins/like.php?href="<?php urlencode(get_permalink()) ?>"&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=21" style="width:150px; height:21px;"></iframe>
                    </div>
                    <div class="google-share-button">
                    <g:plusone size="medium"></g:plusone>
                    </div>
                    <div class="fr">
                    <a href="https://getpocket.com/save" class="pocket-btn" data-lang="en"
  							data-save-url="{Permalink}"
  							data-pocket-count="horizontal" 
  							data-pocket-align="left"
  						>Pocket</a>
                    </div>
                </div>

<?php }


// 15.0 ========== Manage WordPress contact fields =============================
/**
 * Manage WordPress contact fields.
 * Usage:
*  require './class.TTT_Contactfields.php';
*
*		$TTT_Contactfields = new TTT_Contactfields(
* 		array (
*			'Twitter'
*		,	'Facebook'
*		,	'Xing'
*		,	'Country'
*		,	'City'
*		,	'Latitude'
*		,	'Longitude'
*	)
*);
 * @author "Thomas Scholz" http://toscho.de
 * @version 1.0
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 */

$Evolution_Contactfields = new Evolution_Contactfields(
	array (
		'Feed'
	,	'Twitter'
	,	'Facebook'
	,	'GooglePlus'
	,	'Flickr'
	,	'Github'
	,	'Instagram'
	,	'LinkedIn'
	,	'Pinterest'
	,	'Vimeo'
	,	'Youtube'
    ,	'Autorentitel'
	)
);


class Evolution_Contactfields {
	public
		$new_fields
	,	$active_fields
	,	$replace
	;

	/**
	 * @param array $fields New fields: array ('Twitter', 'Facebook')
	 * @param bool $replace Replace default fields?
	 */
	public function __construct($fields, $replace = TRUE)
	{
		foreach ( $fields as $field )
		{
			$this->new_fields[ mb_strtolower($field, 'utf-8') ] = $field;
		}

		$this->replace = (bool) $replace;

		add_filter('user_contactmethods', array( $this, 'add_fields' ) );
	}

	/**
	 * Changes the contact fields.
	 * @param  $original_fields Original WP fields
	 * @return array
	 */
	public function add_fields($original_fields)
	{
		if ( $this->replace )
		{
			$this->active_fields = $this->new_fields;
			return $this->new_fields;
		}

		$this->active_fields = array_merge($original_fields, $this->new_fields);
		return $this->active_fields;
	}

	/**
	 * Helper function for your theme
	 * @return array The currently active fields.
	 */
	public function get_active_fields()
	{
		return $this->active_fields;
	}
}

// 16.0 ========== Post-thumbnails for feeds => evolution_post_thumbnail_feeds()

function evolution_post_thumbnail_feeds($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<div>' . get_the_post_thumbnail($post->ID) . '</div>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'evolution_post_thumbnail_feeds');
add_filter('the_content_feed', 'evolution_post_thumbnail_feeds');


// 17.0 ========== Remove Magic Quotes =======================================//

/*
Plugin Name: Remove Magic Quotes
Plugin URI: http://toscho.de/2009/php-magic-quotes-entfernen/
Description: Entfernt Backslashes, die von dummen PHP-Einstellungen eingebaut werden.
Version: 0.1
Author: Thomas Scholz
Author URI: http://toscho.de
*/
RMQ::gpc_strip_slashes();

class RMQ {
	static function gpc_strip_slashes()
	{
		if ( get_magic_quotes_gpc() )
		{
			$_REQUEST = RMQ::array_map_recursive('stripslashes', $_REQUEST);
			$_GET     = RMQ::array_map_recursive('stripslashes', $_GET);
			$_POST    = RMQ::array_map_recursive('stripslashes', $_POST);
			$_COOKIE  = RMQ::array_map_recursive('stripslashes', $_COOKIE);
		}

		return;
	}
	/**
	 * Deeper array_map()
	 *
	 * @param string $callback Callback function to map
	 * @param array $array Array to map
	 * @source http://www.sitepoint.com/blog-post-view.php?id=239423
	 * @return array
	 */
	static function array_map_recursive($callback, $array)
	{
		$r = array();

		if ( is_array($array) )
		{
			foreach ( $array as $k => $v )
			{
				$r[$k] = is_scalar($v)
					? $callback($v)
					: RMQ::array_map_recursive($callback, $v);
			}
		}

		return $r;
	}
}

// 18.0 ========== Canonical Permalink => canonical_request() ==================

/*
Plugin Name: Canonical Permalink
Plugin URI: http://toscho.de/2010/wordpress-plugin-canonical-permalink/
Description: Removes illegal numeric suffixes from the request URI.
Version: 0.3
Author: Thomas Scholz
Author URI: http://toscho.de
Created: 04.04.2010
*/

/**
 * WordPress allows URIs with any numeric suffix, e.g.:
 * /canonical-page-or-postname/12345/
 * This functions performs a simple check and redirects
 * to the canonical URI if neccessary.
 *
 * @return void
 */
function canonical_request()
{
	global $page, $post;

	// post, page, attachment, preview
	if ( ! is_singular() or is_preview() )
	{
		return;
	}

	$permalink = get_permalink();

	// We don't have access to the number of sub pages here.
	// So we have to hack.
	$max_pages = substr_count(
		$post->post_content, '<!--nextpage-->') + 1;

	if ( 1 < $page and $page <= $max_pages )
	{
		/*
		 * Handle different permalink settings, eg:
		 * /%year%/%postname%.html or
		 * /%year%/%postname%/
		 */
		$rev_perma_struct = strrev(get_option('permalink_structure'));

		if ( '/' != $rev_perma_struct[0] )
		{
			$permalink .= "/$page";
		}
		else
		{
			$permalink .= "$page/";
		}
	}

	$host_uri       = 'http'
					. ( empty ( $_SERVER['HTTPS'] ) ? '' : 's' )
					. '://' . $_SERVER['HTTP_HOST'];
	$canonical_path = str_replace($host_uri, '', $permalink);

	if ( ! empty ( $_GET ) )
	{
		global $wp;
		// Array
		$allowed = $wp->public_query_vars;

		$out_arr = array();

		foreach ( $_GET as $k => $v )
		{
			if ( in_array($k, $allowed ) )
			{
				$out_arr[] = $k . ( empty ( $v ) ? '' : "=$v" );
			}
		}

		if ( ! empty ( $out_arr ) )
		{
			$canonical_path .= '?' . implode('&', $out_arr);
		}
	}

	if ( $canonical_path == $_SERVER['REQUEST_URI'] )
	{
		return;
	}
	// Debug current result:
	#print '<pre>' . var_export($canonical_path, TRUE) . '</pre>';

	// Change it or return 'false' to stop the redirect.
	$canonical_path = apply_filters(
		'toscho_canonical_path',
		$canonical_path
	);

	if ( FALSE != $canonical_path )
	{
		header('Location: ' . $permalink, true, 301);
		die("<a href='$permalink'>$permalink</a>");
	}

	return;
}
//add_action('wp', 'canonical_request');


// 19.0 ========== Prints jQuery in footer on front-end => evolution_print_jquery_in_footer() ==========

/**
 * Prints jQuery in footer on front-end.
 * 
 * Deprecated since WordPress 3.6
 */

//function ds_print_jquery_in_footer( &$scripts) {
//	if ( ! is_admin() )
//		$scripts->add_data( 'jquery', 'group', 1 );
//}
//add_action( 'wp_default_scripts', 'ds_print_jquery_in_footer' );

/**
 * Prints jQuery in Footer on front-end
 * 
 * @since WordPress 3.6
 * @since 2.1.3
 * 
 */

 function evolution_print_jquery_in_footer() { 

 		if ( ! is_admin() )

	remove_action('wp_head', 'wp_print_scripts'); 
	remove_action('wp_head', 'wp_print_head_scripts', 9); 
	remove_action('wp_head', 'wp_enqueue_scripts', 1); 
} 

// Load jQuery in footer (standard) or in header
if(of_get_option('jquery_footer') == "footer") {

add_action( 'wp_enqueue_scripts', 'evolution_print_jquery_in_footer' );

}	


// 20.0 ========== Defer-Attribut für Skripte => evolution_add_script_defer() ==========
/*
Module Name: Defer-Attribut für Skripte
Description: Fügt jedem JavaScript-Dateiaufruf das Defer-Attribut hinzu. [Frontend]
Author: Sergej Müller
Author URI: http://wpcoder.de 
*/

/* Ab hier kann's los gehen */
function evolution_add_script_defer($file) {
	if ( strpos($file, '.js') !== false ) {
		return sprintf(
			"%s' defer='defer",
			$file
		);
	}

	return $file;
}

// add_filter(	'clean_url',	'evolution_add_script_defer',	99,	1);


// 21.0 ========== Remove WordPress versions totally from source and feed ==========

// remove wp version meta tag and from rss feed
function evolution_remove_wp_version() { 

return ''; 

}
 add_filter('the_generator', 'evolution_remove_wp_version');


 // remove wp version param from any enqueued scripts
function evolution_remove_wp_ver_css_js( $src ) {

    if ( strpos( $src, 'ver=' ) )

        $src = remove_query_arg( 'ver', $src );

    return $src;
}
add_filter( 'style_loader_src', 'evolution_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'evolution_remove_wp_ver_css_js', 9999 );


// 22.0 ========== Add dynamic classes to the <body> element ==========

// Add custom body classes - MAIN LAYOUT ##########################
add_filter( 'body_class', 'evolution_add_body_class' );

function evolution_add_body_class( $classes ) {

		$site_layout = of_get_option('example_images', 'no entry' );

		if ( $site_layout )
		$classes[] = $site_layout;

	return $classes;

}


add_filter( 'body_class', 'evolution_custom_body_class', 15 );
// Custom Body Class - custom field
function evolution_custom_body_class( $classes ) {

	$new_class = is_singular() ? rwmb_meta( 'Evolution_body' ) : null;

	if ( $new_class )
		$classes[] = esc_attr( sanitize_html_class( $new_class ) );

	return $classes;

}


add_filter( 'post_class', 'evolution_custom_post_class', 15 );
// Custom Post Class - custom field
function evolution_custom_post_class( $classes ) {

	$new_class = is_singular() ? rwmb_meta( 'Evolution_post' ) : null;

	if ( $new_class )
		$classes[] = esc_attr( sanitize_html_class( $new_class ) );

	return $classes;

}


function evolution_custom_body_fullpage_class( $classes ) {

	$new_class = is_singular() ? rwmb_meta( 'Evolution_fullpage' ) : null;

	if ( $new_class )
		$classes[] = esc_attr( sanitize_html_class( $new_class ) );

	return $classes;

}
add_filter( 'body_class', 'evolution_custom_body_fullpage_class', 15 );


// 23.0 ========== Add an rel author link to the wp_head => evolution_author_link();  ==========
/**
 * Adds an rel author link to the wp_head 
 */

$administration_path = TEMPLATEPATH . '/inc/'; 
require_once($administration_path . 'options/options-framework.php');

if(of_get_option('googleplus_author') ) {

add_action( 'wp_head', 'evolution_author_link' );

function evolution_author_link() {

echo "<!-- Rel author link for Google+ author profile -->\n";
echo '<link href="'.of_get_option('googleplus_author').'" rel="author" />', "\n";
	}
}


// 24.0 ========== Override the default sanitization filter for textarea in the Options Framework  ==========
/* 
 * Override a default filter => Optionsframework
 * for 'textarea' sanitization and $allowedposttags + embed and script (incl. src & type).
 */
add_action('admin_init','evolution_optionscheck_change_santiziation', 100);
 
function evolution_optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'evolution_sanitize_textarea' );
}
 
function evolution_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array();
      $custom_allowedtags["script"] = array( "src" => array(), "type" => array() );
 
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

// 25.0 ========== Add an rel publisher link to the wp_head => evolution_publisher_link();  ==========
/**
 * Adds an rel publisher link to the wp_head 
 */

$administration_path = TEMPLATEPATH . '/inc/'; 
require_once($administration_path . 'options/options-framework.php');

if(of_get_option('googleplus_id') ) {

add_action( 'wp_head', 'evolution_publisher_link' );

function evolution_publisher_link() {

echo "<!-- Rel publisher link for Google+ Page -->\n";
echo '<link href="https://plus.google.com/'.of_get_option('googleplus_id').'" rel="publisher" />', "\n";
	}
}


// 26.0 ========== Adds the necessary css for the fullpage background image to the wp head => evolution_fullpage_background(); ==========

/**
 * 
 * Adds the necessary css for the fullpage background image to the wp head
 * 
 */

if(of_get_option('example_showhidden') ) {

add_action( 'wp_head', 'evolution_fullpage_background' );

function evolution_fullpage_background() {

echo "<!-- Fullpage Background Image -->\n";
echo '<style type="text/css">', "\n";
echo "#wrap { margin: 32px auto; margin: 2rem auto; max-width: 1080px; overflow: hidden; padding: 0 36px 0 36px; padding: 0 2.25rem 0 2.25rem; }", "\n";
echo '</style>', "\n";

	}
}



