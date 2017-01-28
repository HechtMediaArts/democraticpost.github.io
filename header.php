<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the header structure.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

global $options; global $data;

do_action( 'evolution_do_meta' ); 
?>
<body <?php body_class() ?> >

<!--<div id="ad_skyscraper"><a href="https://www.hostnet.de/1237-1-1-6.html" target="_blank" rel="nofollow"><img src="https://www.democraticpost.de/wp-content/uploads/2016/05/333Systeme_160x600_2.png" width="160" height="600" alt="333 Systeme - einfach da!"></a></div>-->

<?php do_action( 'evolution_bg_image' ); ?>

<?php evolution_before_wrap();?>

<?php // do_action( 'evolution_secondary_menu' ); ?>

<div id="wrap">

<?php do_action( 'evolution_secondary_menu' ); ?>

<!-- - - - - - - - - - - - - - - - -  Header & Navigation - - - - - - - - - - - - - - - - - - - - - -  -->

<?php evolution_before_header();?>

<header id="topbereich" itemscope itemtype="http://schema.org/WPHeader">

<div id="header-wrap" class="clearfix">

<?php do_action( 'evolution_header_advertisement' ); ?>


<?php do_action( 'evolution_heading' ); ?>

<?php evolution_before_nav();?>

</div>


<nav id="topnav">
<span class="navdate"><?php echo date_i18n('D, d. M Y')  ?></span>
<?php
    if (has_nav_menu('primary')) {
        
wp_nav_menu( array('menu' => 'primary', 'container' => '', 'menu_class' => 'evolution-nav-menu menu-primary', 'menu_id' => 'mobileselect', 'theme_location' => 'primary', 'depth' => 5 ) );
 
     $mobile_menu_walker = new kopa_mobile_menu();
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => 'div',
        'container_id' => 'mobile-menu',
        'menu_id' => 'toggle-view-menu',
        'items_wrap' => '<span>' . __('Menü', kopa_get_domain()) . '</span><ul id="%1$s">%3$s</ul>',
        'walker' => $mobile_menu_walker
    ));
    } ?>
</nav>

<?php evolution_after_nav();?>