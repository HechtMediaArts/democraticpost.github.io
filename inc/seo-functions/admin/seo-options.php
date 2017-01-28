<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
    
//Access the WordPress Categories via an Array
$of_categories = array();
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->category_nicename;}
$categories_tmp = array_unshift($of_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");

//Testing
$my_options_select = array("one","two","three","four","five");
$showhideselect = array('Show', 'Hide');
$my_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

/*-----------------------------------------------------------------------------------*/
/* TO DO: Add options/functions that use these */
/*-----------------------------------------------------------------------------------*/

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$show_posts = array("Select a number:","1","2","3","4","5","6","7","8","9","10");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Image Alignment radio box
$my_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

// Image Links to Options
$my_options_image_link_to = array("image" => "The Image","post" => "The Post");

//  ========== Stylesheets Reader ===========================================

if (!function_exists('optionsframework_wp_head')) {
        function optionsframework_wp_head() {

        global $data;

//Layouts
//    $layout = $data['layout'];
//            if ($layout == '') {
//            $layout = '2c-r-fixed.css';
//}

//wp_register_style('layout', LAYOUTS . $layout );
//        wp_enqueue_style('layout');

//kills sidebar if single column layout is selected
//if ($layout == '1col-fixed.css'){
//        add_filter('revothemes_sidebar', '__return_false');
//}

//Alt Styles
$alt_style = $data['alt_stylesheet'];
        if ($alt_style == '') {
        $alt_style = 'default.css';
}
wp_register_style('alt_style',STYLES . $alt_style);
        wp_enqueue_style('alt_style');
    }
}

//add_action('wp_print_styles', 'optionsframework_wp_head');

function kill_sidebar() {
    return FALSE;
}


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $my_options;
$my_options = array();

$url =  get_bloginfo('template_directory') . '/administration/images/';

//global $alt_stylesheets;

global $data;


// 2.0 ========== SEO Options ==================================================

$shortname =  "evolution";

$my_options[] = array( "name" => "Seo Options",
                    "class" => "seo",
                    "type" => "heading");

$my_options[] = array( "name" => "Evolution SEO Optionen aktivieren",
                    "type" => "info");

$my_options[] = array( "name" => "Evolution SEO",
                    "desc" => __("Wenn Du ein SEO-Plugin nutzt, musst Du die Evolution SEO Optionen deaktivieren.<br/><strong>Empfohlenes SEO Plugin</strong>:<br/><a target='_blank' href=\"http://clix.superclix.de/cgi-bin/clix.cgi?id=hechtmediaarts&pp=14042&linknr=78945\">wpSEO</a>", 'revothemes'),
                    "id" => $shortname."_seo_enable",
                    "options" => array('Enable', 'Disable'),
                    "std" => "Enable",
                    "type" => "select");

$my_options[] = array( "name" => "Title Tag Struktur <code>&lt;title&gt;</code>",
                    "type" => "info");

$my_options[] = array( "name" => "Startseite",
                    "desc" => __("Wähle aus, wie Du den <code>&lt;title&gt;</code> Tag auf Deiner Startseite anzeigen möchtest.", 'revothemes'),
                    "id" => $shortname."_seo_home_title",
                    "options" => array('Site Title - Site Description','Site Description - Site Title', 'Site Title'),
                    "std" => "Site Title - Site Description",
                    "type" => "select");

$my_options[] = array( "name" => __("Beiträge und Seiten", 'revothemes'),
                    "desc" => __("Wähle das Format, in dem Du den <code>&lt;title&gt;</code> Tag auf Beiträgen und Seiten anzeigen lassen möchtest.", 'revothemes'),
                    "id" => $shortname."_seo_posts_title",
                    "options" => array('Page Title','Page Title - Site Title', 'Site Title - Page Title'),
                    "std" => "Page Title",
                    "type" => "select");

$my_options[] = array( "name" => "Index Seiten (Kategorien/Archive/Tags/Suchresultate)",
                    "desc" => __("Wähle das Format, in dem Du den <code>&lt;title&gt;</code> Tag auf den Index Seiten anzeigen möchtest.", 'revothemes'),
                    "id" => $shortname."_seo_pages_title",
                    "options" => array('Page Title - Site Title','Site Title - Page Title', 'Page Title'),
                    "std" => "Page Title - Site Title",
                    "type" => "select");

$my_options[] = array( "name" => "Separator",
                    "desc" => "Wie soll der Separator aussehen, der den Seitentitel von der Beschreibung trennt? ",
                    "id" => $shortname."_title_separator",
                    "std" => " &mdash; ",
                    "type" => "text");

$my_options[] = array( "name" => "Startseite META <code>&lt;meta&gt;</code> Einträge",
                    "type" => "info");

$my_options[] = array( "name" => __("META Description Tag für die Startseite", 'revothemes'),
                    "desc" => __("Hier kannst Du die META description für Deine Startseite einfügen, dieses wird als Beschreibung in den Suchmaschinen Ergebnissen angezeigt. Auf einzelnen Artikeln <strong><em>Single Posts</em></strong> wird der Excerpt zum generieren der Beschreibung genutzt.", 'revothemes'),
                    "id" => $shortname."_meta_desc",
                    "std" => " ",
                    "type" => "textarea");

$my_options[] = array( "name" => __("META Keywords für die Startseite", 'revothemes'),
                    "desc" => __("Füge hier durch Komma getrennte META-Keywords ein. Grundsätzlich werden META-Keywords aber von Suchmaschinen ignoriert.<br />Auf einzelnen Artikeln <strong><em>Single Posts</em></strong> werden standardmäßig die für den Artikel vergebenen Tags zur Generierung der Keywords genutzt.", 'revothemes'),
                    "id" => $shortname."_meta_key",
                    "std" => " ",
                    "type" => "text");

$my_options[] = array( "name" => __("Suchmaschinen Indexierungs Einstellungen", 'revothemes'),
                    "desc" => __("Diese Optionen werden Dir dabei helfen, Dich vor unerwünscht in den Suchergebnissen auftauchenden Seiten zu schützen, die WordPress automatisch generiert. Das kannst Du durch den <code>&lt;noindex&gt;</code> Tag verhindern.", 'revothemes'),
                    "type" => "info");

$my_options[] = array( "name" => __("Kategorie Archive", 'revothemes'),
                    "id" => $shortname."_index_category",
                    "options" => array('index', 'noindex'),
                    "std" => "index",
                    "type" => "select");

$my_options[] = array( "name" => "Tag Archive",
                    "id" => $shortname."_index_tag",
                    "desc" => " ",
                    "options" => array('index', 'noindex'),
                    "std" => "index",
                    "type" => "select");

$my_options[] = array( "name" => __("Author Archive", 'revothemes'),
                    "id" => $shortname."_index_author",
                    "desc" => " ",
                    "options" => array('index', 'noindex'),
                    "std" => "index",
                    "type" => "select");

$my_options[] = array( "name" => __("Datum Archive", 'revothemes'),
                    "id" => $shortname."_index_date",
                    "desc" => " ",
                    "options" => array('index', 'noindex'),
                    "std" => "index",
                    "type" => "select");

$my_options[] = array( "name" => __("Suchresultate", 'revothemes'),
                    "id" => $shortname."_index_search",
                    "desc" => " ",
                    "options" => array('index', 'noindex'),
                    "std" => "index",
                    "type" => "select");

    
    }
}