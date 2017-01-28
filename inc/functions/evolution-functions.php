<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Admin related functions file.
 * 
 * This file contains all the functions that do not fit in other areas
 *
 * @category Evolution Framework
 * @package  Admin
 * @author   Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.hechtmediaarts.com/themes/evolution
 */


// ========== Beams you up after activation to the admin-framework ========== //

    if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

	    // Redirection => Scotty does not come into the sweat
	    header( 'Location: '.admin_url().'admin.php?page=evolution-options' );
}

/* 
 * Loads the Options Panel and defines the path
 */
 
    define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/inc/options/');
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/inc/options/');

        require_once($administration_path . 'options/options-framework.php');


// Firing up chosen for better <select> design / options page
    function evolution_chosen_admin_files() {

        wp_enqueue_style('chosen', get_bloginfo('template_directory') .'/inc/options/css/chosen.css');
        wp_enqueue_script('chosen.js', get_bloginfo('template_directory') .'/inc/options/js/chosen.jquery.js', array('jquery'));
}  
    add_action('admin_enqueue_scripts', 'evolution_chosen_admin_files');


 // ========== Building the auto framework version ===========================

function evolution_version_init(){
    $evolution_framework_version = ' 2.1.3';
    if ( get_option( 'evolution_framework_version') <> $evolution_framework_version )
    update_option( 'evolution_framework_version ', $evolution_framework_version);
}
add_action( 'init', 'evolution_version_init' );


/**
 * 
 * Release Date on Theme Options Page
 * 
 * @since 2.1.2
 * 
 */

$releasedate = ' 16.08.2013';

//  ========== Meta Generator Output =========================================

function evolution_version() {

    // ATTENTION: WordPress 3.4 deprecates some functions, thatswhy this test
    global $wp_version;
    if ( version_compare( $wp_version, '3.4a', '>=' ) ) {
        $theme_data = wp_get_theme();
    }
    else {
        $theme_data = get_theme_data( get_stylesheet_directory_uri() . '/style.css' );
    }
    $theme_version = $theme_data['Version'];
    $evolution_framework_version = get_option( 'evolution_framework_version' );
    $themename =  $theme_data['Name'];
    echo "<!-- Framework & Child Theme Version -->\n";
    echo '<meta name="generator" content="'. $themename .' '. $theme_version .'" />' ."\n";
    echo '<meta name="generator" content="Evolution Framework' . $evolution_framework_version . '" />' ."\n";
}


//  ========== Add or remove Generator meta tags =============================

if ( get_option( 'framework_evolution_disable_generator') == "true" )
    remove_action( 'wp_head',  'wp_generator' );
else
    add_action( 'wp_head', 'evolution_version' ); 