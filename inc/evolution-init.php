<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Admin Init File.
 *
 * @category    Evolution Framework
 * @package     Admin
 * @author        Hecht MediaArts
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              http://www.hechtmediaarts.com/themes/evolution
 */


/**
 * Defining the Evolution location constants
 *
 * @since 2.0.0
 */
    define( 'PARENT_DIR', get_template_directory() );
    define( 'CHILD_DIR', get_stylesheet_directory() );
    define( 'EVOLUTION_INC_DIR', PARENT_DIR . '/inc' );
    define( 'EVOLUTION_FUNCTIONS_DIR', EVOLUTION_INC_DIR . '/functions' );
    define( 'EVOLUTION_SHORTCODES_DIR', EVOLUTION_INC_DIR . '/admin/shortcodes' );
    define( 'EVOLUTION_ADMIN_DIR', EVOLUTION_INC_DIR . '/admin' );
    define( 'EVOLUTION_OPTIONS_DIR', EVOLUTION_INC_DIR . '/options' );
    define( 'EVOLUTION_PLUGINS_DIR', EVOLUTION_INC_DIR . '/admin/plugins' );
    define( 'EVOLUTION_SEO_DIR', EVOLUTION_INC_DIR . '/seo-functions/admin' );
    define( 'EVOLUTION_WIDGET_DIR', EVOLUTION_INC_DIR . '/widgets' );
    define( 'EVOLUTION_STRUCTURE_DIR', EVOLUTION_INC_DIR . '/structure' );
    define( 'EVOLUTION_STARTSEITE_DIR', EVOLUTION_INC_DIR . '/startseite' );
    define( 'EVOLUTION_METABOX_DIR', EVOLUTION_INC_DIR . '/admin/meta-box' );

    // Define plugin META-BOX URLs, for fast enqueuing scripts and styles
if ( ! defined( 'RWMB_URL' ) )
    define( 'RWMB_URL', get_template_directory_uri() );
    define( 'RWMB_JS_URL',  RWMB_URL . '/inc/admin/meta-box/js/'  );
    define( 'RWMB_CSS_URL', RWMB_URL . '/inc/admin/meta-box/css/' );

// Plugin META-BOX paths, for including files
if ( ! defined( 'RWMB_DIR' ) )
    define( 'RWMB_DIR', get_template_directory(). '/inc/admin/meta-box' );
    define( 'RWMB_INC_DIR',  RWMB_DIR . '/inc/'  );
    define( 'RWMB_FIELDS_DIR', RWMB_INC_DIR . '/fields/'  );
    define( 'RWMB_CLASSES_DIR',  RWMB_INC_DIR . '/classes/' );

// Optimize code for loading plugin files ONLY on admin side
// @see http://www.deluxeblogtips.com/?p=345

// Helper function to retrieve meta value
require_once RWMB_INC_DIR . 'helpers.php';

if ( is_admin() )
{
    require_once RWMB_INC_DIR . 'common.php';

    // Field classes
    foreach ( glob( RWMB_FIELDS_DIR . '*.php' ) as $file )
    {
        require_once $file;
    }

    // Main file
    require_once RWMB_CLASSES_DIR . 'meta-box.php';
}


/*
 WARNING: These files are part of the core Evolution framework. DO NOT edit
 these files under any circumstances. Please do all modifications
 in the form of a child theme.
 */    

/**
 * Loading all parts of the Evolution Framework
 *
 * @since 2.0.0
 */

        // Loads the Theme functions
        require_once( EVOLUTION_FUNCTIONS_DIR . '/evolution-theme-functions.php' );
        // Loads some admin functions
        require_once( EVOLUTION_FUNCTIONS_DIR . '/evolution-functions.php' );

        // Loads the shortcode engine
        //require_once( EVOLUTION_SHORTCODES_DIR . '/evo-shortcodes.php' ); 

        // Loads admin functions and hooks
        require_once (EVOLUTION_ADMIN_DIR . '/admin-functions.php');                         
        require_once (EVOLUTION_ADMIN_DIR . '/admin-seo-functions.php');
        require_once (EVOLUTION_ADMIN_DIR . '/evolution-hooks.php');                              
         
        // Loads all the admin plugins
        //require_once (EVOLUTION_PLUGINS_DIR . '/block-bad-queries.php');
        require_once (EVOLUTION_PLUGINS_DIR . '/evolution-breadcrumbs.php');
        require_once (EVOLUTION_PLUGINS_DIR . '/evolution-pagination.php');             

        // Loads the seo part
        require_once (EVOLUTION_SEO_DIR . '/admin-setup.php');
        require_once (EVOLUTION_SEO_DIR . '/admin-interface.php');
        require_once (EVOLUTION_SEO_DIR . '/seo-options.php');

        // Evolution Widgets
       // require_once (EVOLUTION_WIDGET_DIR . '/evolution-google-page.php');
       // require_once (EVOLUTION_WIDGET_DIR . '/evolution-google-autor.php');
        //require_once (EVOLUTION_WIDGET_DIR . '/evolution-about-widget.php');
        //require_once (EVOLUTION_WIDGET_DIR . '/evolution-twitter.php');
        //require_once (EVOLUTION_WIDGET_DIR . '/evolution-social-icons.php');
       // require_once (EVOLUTION_WIDGET_DIR . '/evolution-sidebar-box.php');
       // require_once (EVOLUTION_WIDGET_DIR . '/evolution-newsletter.php');
       // require_once (EVOLUTION_WIDGET_DIR . '/evolution-ads.php');
        //require_once (EVOLUTION_WIDGET_DIR . '/evolution-facebook-flickr-widgets.php');
        //require_once (EVOLUTION_WIDGET_DIR . '/evolution-statistics.php');
        //require_once (EVOLUTION_WIDGET_DIR . '/evolution-article-list.php');


        // Loads the structure parts 
        require_once (EVOLUTION_STRUCTURE_DIR . '/evolution-sidebar.php');
        require_once (EVOLUTION_STRUCTURE_DIR . '/evolution-comments.php');
        require_once (EVOLUTION_STRUCTURE_DIR . '/evolution-frontend-functions.php');
        require_once (EVOLUTION_STRUCTURE_DIR . '/evolution-sidebar-structure.php');
        require_once (EVOLUTION_STRUCTURE_DIR . '/evolution-loops.php');
        require_once (EVOLUTION_STRUCTURE_DIR . '/about-us-authorboxes.php'); // Alle Autoren für die Übersicht der Autoren auf Über uns

        // laedt die Loops fuer die Startseite
        //require_once (EVOLUTION_STARTSEITE_DIR . '/erster-artikel.php');

        // Include the meta box definition
        require_once( PARENT_DIR . '/options/custom-post-options.php' );

         // Include the meta box script
        require_once EVOLUTION_METABOX_DIR . '/meta-box.php';


