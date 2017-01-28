<?php

/**
 * Controls output elements for frontend displaying
 *
 * @category   		Evolution Framework
 * @package    		Structure
 * @subpackage 	Frontend Functions
 * @author     		Hecht MediaArts
 * @license    		http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       			http://hechtmediaarts.com/evolution
 */

function evolution_meta() {
	global $options; global $data;
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->  <!--<![endif]-->
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset');?>" />
<link rel="dns-prefetch" href="//stats.wp.com" />
<link rel="preconnect" href="//stats.wp.com" />
<link rel="dns-prefetch" href="//s0.wp.com" />
<link rel="preconnect" href="//s0.wp.com" />
<link rel="dns-prefetch" href="//opensource.keycdn.com" />
<link rel="preconnect" href="//opensource.keycdn.com" />
<link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
<link rel="preconnect" href="//cdn.jsdelivr.net" />
<?php if ( is_single() ) : ?>
<link rel="dns-prefetch" href="//fonts.googleapis.com" />
<link rel="preconnect" href="//fonts.googleapis.com" />
<link rel="dns-prefetch" href="//static.plista.com" />
<link rel="preconnect" href="//static.plista.com" />
<link rel="dns-prefetch" href="//farm.plista.com" />
<link rel="preconnect" href="//farm.plista.com" />
<link rel="dns-prefetch" href="//pagead2.googlesyndication.com" />
<link rel="preconnect" href="//pagead2.googlesyndication.com" />
<?php endif; ?>
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--  Mobile viewport scale | Disable user zooming as the layout is optimised -->
<meta content="initial-scale=1.0; maximum-scale=1.0; user-scalable=no" name="viewport"/>
<?php do_action('wpseo_the_meta'); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta name="google-site-verification" content="AqmmcKeB4aKqDWZodenmQupFs_bT8Ejf535SQgF8SUw" />
<link rel="stylesheet" href="<?=auto_version('/wp-content/themes/democraticpost-1.3.0/style.css')?>" type="text/css" media="screen" />
<?php if( is_home() && !is_paged() ) : ?>
<meta name="robots" content="noindex, follow" />
<?php endif; ?>
<?php if( is_front_page() ) : ?>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "name" : "Democratic Post",
  "url" : "http://www.democraticpost.de/",
  "logo" : "https://www.democraticpost.de/wp-content/uploads/2016/05/schema-logo-democratic-post.png",
  "description": "Die Website für kontroverse Meinungen bietet Ihnen kritische Texte zu Themen aus den Bereichen Politik, Wirtschaft, Gesellschaft und Entertainment.",
  "founder": [
    {
      "@type": "Person",
      "name": "Nicole Hahn"
    },
    {
      "@type": "Person",
      "name": "Andreas Hecht"
    }
  ],
  "sameAs" : [
    "https://www.facebook.com/democraticpost",
    "https://twitter.com/democraticpost",
    "https://plus.google.com/+DemocraticpostDeHH/posts"
  ]
}
</script>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "WebSite",
    "name": "Democratic Post",
    "alternateName": "Democratic Post",
    "url": "https://www.democraticpost.de",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "https://www.democraticpost.de/?s={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
<?php endif; ?>
<!-- modernizr library for IE 6-8 -->
<!--[if lt IE 9]><script src="<?php echo get_stylesheet_directory_uri();?>/js/libs/modernizr-2.0.6.min.js"></script><![endif]-->
<!--[if IE 8 ]>
<style type="text/css">
#content img {width: auto;}
</style>
<![endif]-->
<?php wp_head();?>
<?php
if ( is_admin_bar_showing() ) : ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/admin-bar.min.css" type="text/css" media="screen" />
<?php endif; ?>
<?php if ( is_single() ) : ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4412877567706303",
    enable_page_level_ads: true
  });
</script>
<?php endif; ?>
</head>
<?php }
add_action( 'evolution_do_meta', 'evolution_meta' );


/**
 * Displays a text blog heading or a logo image
 *
 * @since 2.0.0
 *
 */
function evolution_blog_heading() {
?>

<div id="title-area">
<a class="header-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Zurück zur Startseite">
<div id="logo"></div>
</a>
<?php if( is_front_page() ) : ?>
<h1 class="title-image"><?php bloginfo('name');?></h1>
<?php else : ?>
<p class="title-image"><?php bloginfo('name');?></p>
<?php endif; ?>
<p class="title-image"><?php bloginfo('description');?></p>
</div><!-- end #title-area -->
<?php
}
add_action( 'evolution_heading', 'evolution_blog_heading' );


/**
 * Displays a fullpage background image, if need
 *
 * @since 2.0.0
 *
 */
function evolution_fullpage_background_image() {

if( of_get_option('example_showhidden') ) { ?>
<div>
<img id="background-img" class="hintergrundbild" src="<?php echo of_get_option('example_upload_hidden');?>" alt="Background" />
</div>
<?php }
}
add_action( 'evolution_bg_image', 'evolution_fullpage_background_image' );



/**
 * Displays the secondary sticky menu, if need
 *
 * Attention: First <li> item floats left, the rest floats right.
 *
 * @since 2.0.0
 *
 */
function evolution_show_secondary_menu() {

	if(function_exists('has_nav_menu') && has_nav_menu('secondary')) {
?>
<nav id="top">
<?php
    wp_nav_menu(array('container' => 'div', 'container_class' => 'menu-top-container', 'menu_class' => 'evolution-nav-secondary', 'menu_id' => 'subnav', 'theme_location' => 'secondary', 'depth' => 4, ));
    echo '</nav><!-- end #top -->';
    }
 }

add_action( 'evolution_secondary_menu', 'evolution_show_secondary_menu' );


function democratic_topmenu_style() {
?>
<style>
.header-link {margin-top: 0px; }
</style>  
    <?php }

    if(function_exists('has_nav_menu') && has_nav_menu('secondary')) {
        
        add_action( 'wp_head', 'democratic_topmenu_style' );
}

/**
 * Menü im Footer
 */
function evolution_show_footer_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('footer')) {

wp_nav_menu( array( 'container_class' => 'menu-footer clearfix', 'theme_location' => 'footer' ) );
    }
}
add_action( 'evolution_footer_menu', 'evolution_show_footer_menu' );


/**
 * Menü auf der Startseite - Bereich Politik
 */
function evolution_show_politik_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('politik')) {

wp_nav_menu( array( 'container_class' => 'menu-politik clearfix', 'theme_location' => 'politik' ) );
    }
}
add_action( 'evolution_politik_menu', 'evolution_show_politik_menu' );


/**
 * Menü auf der Startseite - Bereich Meinungen
 */
function evolution_show_meinungen_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('meinungen')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'meinungen' ) );
    }
}
add_action( 'evolution_meinungen_menu', 'evolution_show_meinungen_menu' );


/**
 * Menü auf der Startseite - Bereich Gesellschaft
 */
function evolution_show_gesellschaft_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('gesellschaft')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'gesellschaft' ) );
    }
}
add_action( 'evolution_gesellschaft_menu', 'evolution_show_gesellschaft_menu' );


/**
 * Menü auf der Startseite - Bereich Feuilletton
 */
function evolution_show_feuilletton_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('feuilletton')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'feuilletton' ) );
    }
}
add_action( 'evolution_feuilletton_menu', 'evolution_show_feuilletton_menu' );


/**
 * Menü auf der Startseite - Bereich Debatte
 */
function evolution_show_debatte_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('debatte')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'debatte' ) );
    }
}
add_action( 'evolution_debatte_menu', 'evolution_show_debatte_menu' );


/**
 * Menü auf der Startseite - Bereich Unterhaltung
 */
function evolution_show_unterhaltung_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('unterhaltung')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'unterhaltung' ) );
    }
}
add_action( 'evolution_unterhaltung_menu', 'evolution_show_unterhaltung_menu' );


/**
 * Menü auf der Startseite - Bereich Wirtschaft
 */
function evolution_show_wirtschaft_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('wirtschaft')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'wirtschaft' ) );
    }
}
add_action( 'evolution_wirtschaft_menu', 'evolution_show_wirtschaft_menu' );

/**
 * Menü auf der Startseite - Bereich Glück und Erfolg
 */
function evolution_show_glueck_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('glueck')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'glueck' ) );
    }
}
add_action( 'evolution_glueck_menu', 'evolution_show_glueck_menu' );


/**
 * Menü auf der Startseite - Bereich News unter der Hauptnavigation
 */
function evolution_show_news_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('news')) {

wp_nav_menu( array( 'container_class' => 'menu-news', 'theme_location' => 'news', 'after'      => '/', ) );
    }
}
add_action( 'evolution_news_menu', 'evolution_show_news_menu' );


/**
 * Menü auf der Startseite - Bereich Videos
 */
function evolution_show_videos_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('videos')) {

wp_nav_menu( array( 'container_class' => 'menu-meinung clearfix', 'theme_location' => 'videos', 'walker' => new Walker_Nav_Menu_Dropdown() ) );
    }
}
add_action( 'evolution_videos_menu', 'evolution_show_videos_menu' );


/**
 * Menü auf der Startseite - Alle Artikel, Schlagwortregister, Nachrichtenarchiv
 */
function evolution_show_start_menu() {

if(function_exists('has_nav_menu') && has_nav_menu('start')) {

wp_nav_menu( array( 'container' => '', 'theme_location' => 'start' ) );
    }
}
add_action( 'evolution_start_menu', 'evolution_show_start_menu' );


/**
 * Displays a 468x60 advertising banner, if need
 *
 * @since 2.0.0
 *
 */
function evolution_header_ad() {
?>

<div id="adcontainer">
  <div id="headerad">
  <!-- Amazon Header Advertisement -->
   <div id="text-16" class="widget widget_text">
   <div class="widget-wrap">
       <div class="textwidget">
       <a href="https://www.hostnet.de/1237-2-1-32.html" target="_blank" rel="nofollow">
       <img src="https://www.democraticpost.de/wp-content/uploads/2016/05/ZahlNur_728x90.png" alt="hostNET Webserver - Zahl nur was Du willst" />
       </a>
       </div>
		</div>
   </div>
<!-- END Amazon Header Advertisement -->
    <?php // dynamic_sidebar( 'header' ); ?>
   </div><!-- end #headerad -->
  </div><!-- end #adcontainer -->
 <?php 
}
add_action( 'evolution_header_advertisement', 'evolution_header_ad' );





/**
 * Displays an author box with contact information under an single post, if need
 *
 * @since 2.0.0
 *
 */
function evolution_author_box() {  
                                                                
?>
                    
                <div class="about-author autorenseite singlepost clearfix">
                <h5>Über den Autor</h5>
					<div class="about-author-detail-autorenseite clearfix">
				<a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></a>
                <div class="author-content">
                    <header>                              
                        <h6><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author_meta('display_name'); ?></a><?php if ( get_the_author_meta( 'autorentitel' ) ) : ?><span><?php the_author_meta('autorentitel');?></span><?php endif;?></h6>
                    </header>

								<p><?php the_author_meta('description'); ?></p>

								<?php
									if(isset($_GET['author_name'])) :
										$curauth = get_userdatabylogin($author_name);
									else :
										$curauth = get_userdata(intval($author));
									endif;
								?>
							<div class="simple-social-icons">
							<ul>
								<?php if ( get_the_author_meta( 'user_url' ) ) :
								?>
									<li class="social-website"><a href="<?php the_author_meta('user_url');?>" target="_blank">&#x77;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'feed' ) ) :
								?>
									<li class="social-rss"><a href="<?php the_author_meta('feed');?>" target="_blank"><i class="fa fa-rss"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'twitter' ) ) :
								?>
									<li class="social-twitter"><a href="<?php the_author_meta('twitter');?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'facebook' ) ) :
								?>
									<li class="social-facebook"><a href="<?php the_author_meta('facebook');?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'googleplus' ) ) :
								?>
									<li class="social-gplus"><a href="<?php the_author_meta('googleplus');?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'flickr' ) ) :
								?>
									<li class="social-flickr"><a href="<?php the_author_meta('flickr');?>" target="_blank">&#xf303;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'github' ) ) :
								?>
									<li class="social-github"><a href="<?php the_author_meta('github');?>" target="_blank">&#xf300;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'instagram' ) ) :
								?>
									<li class="social-instagram"><a href="<?php the_author_meta('instagram');?>" target="_blank">&#xf32d;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'linkedin' ) ) :
								?>
									<li class="social-linkedin"><a href="<?php the_author_meta('linkedin');?>" target="_blank">&#xf318;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'pinterest' ) ) :
								?>
									<li class="social-pinterest"><a href="<?php the_author_meta('pinterest');?>" target="_blank">&#xf312;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'vimeo' ) ) :
								?>
									<li class="social-vimeo"><a href="<?php the_author_meta('vimeo');?>" target="_blank">&#xf306;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'youtube' ) ) :
								?>
									<li class="social-youtube"><a href="<?php the_author_meta('youtube');?>" target="_blank">&#xf313;</a></li>
								<?php endif;?>
							</ul>
							</div>
							</div>
							</div>
							<!-- end authorsites -->
					</div><!-- end post-author-content -->
					<?php

}
add_action( 'evolution_author', 'evolution_author_box' );




/**
 * Handles the pagination on index.php and page.php
 *
 * @since 2.0.0
 *
 */
function evolution_pagination() {

		if ( of_get_option('pagination') == 'numbers') {
				?>
				<?php
				if(function_exists("evolution_paginate")) { evolution_paginate();
				}
				?>
				<?php }?>
				<?php if ( of_get_option('pagination') == 'Next/Previous') {
				?>
				<div class="more_entries">
					<div class="fl">
						<?php next_posts_link(__('&laquo; Ältere Beiträge', 'revothemes'))
						?>
					</div>
					<div class="fr">
						<?php previous_posts_link(__('Neuere Beiträge &raquo;', 'revothemes'))
						?>
					</div>
				</div><!-- end .more_entries -->
				<?php }
}

// Die Autorenbox auf der Autorenseite - diese ist in Verwendung!!!!!
function evolution_author_box_authorsite() {
?>
					<div class="about-author autorenseite clearfix">
					<div class="about-author-detail-autorenseite clearfix">
				<a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></a>
                <div class="author-content">
                    <header>                              
                        <h1><?php the_author_meta('display_name'); ?><span><?php the_author_meta('autorentitel');?></span></h1>
                    </header>

								<p><?php the_author_meta('description'); ?></p>

								<?php
									if(isset($_GET['author_name'])) :
										$curauth = get_userdatabylogin($author_name);
									else :
										$curauth = get_userdata(intval($author));
									endif;
								?>
							<div class="simple-social-icons">
							<ul>
								<?php if ( get_the_author_meta( 'user_url' ) ) :
								?>
									<li class="social-website"><a href="<?php the_author_meta('user_url');?>" target="_blank">&#x77;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'feed' ) ) :
								?>
									<li class="social-rss"><a href="<?php the_author_meta('feed');?>" target="_blank"><i class="fa fa-rss"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'twitter' ) ) :
								?>
									<li class="social-twitter"><a href="<?php the_author_meta('twitter');?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'facebook' ) ) :
								?>
									<li class="social-facebook"><a href="<?php the_author_meta('facebook');?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'googleplus' ) ) :
								?>
									<li class="social-gplus"><a href="<?php the_author_meta('googleplus');?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'flickr' ) ) :
								?>
									<li class="social-flickr"><a href="<?php the_author_meta('flickr');?>" target="_blank">&#xf303;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'github' ) ) :
								?>
									<li class="social-github"><a href="<?php the_author_meta('github');?>" target="_blank">&#xf300;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'instagram' ) ) :
								?>
									<li class="social-instagram"><a href="<?php the_author_meta('instagram');?>" target="_blank">&#xf32d;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'linkedin' ) ) :
								?>
									<li class="social-linkedin"><a href="<?php the_author_meta('linkedin');?>" target="_blank">&#xf318;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'pinterest' ) ) :
								?>
									<li class="social-pinterest"><a href="<?php the_author_meta('pinterest');?>" target="_blank">&#xf312;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'vimeo' ) ) :
								?>
									<li class="social-vimeo"><a href="<?php the_author_meta('vimeo');?>" target="_blank">&#xf306;</a></li>
								<?php endif;?>
								<?php if ( get_the_author_meta( 'youtube' ) ) :
								?>
									<li class="social-youtube"><a href="<?php the_author_meta('youtube');?>" target="_blank">&#xf313;</a></li>
								<?php endif;?>
							</ul>
							</div>
							</div>
							</div>
							<!-- end authorsites -->
					</div><!-- end post-author-content -->
					<?php

}
add_action( 'evolution_author', 'evolution_author_box_authorsite' );