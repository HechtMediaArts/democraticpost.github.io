<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function of_head() { do_action( 'of_head' ); }


/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','of_option_setup');
}

/* set options=defaults if DB entry does not exist, else update defaults only */
function of_option_setup(){
global $options_machine;
		
	if (!get_option(OPTIONS)){
		//doesnt exist in db
		update_option(OPTIONS, $options_machine->Defaults);	
		
	} else {
	    //exists in db- so preserve existing options
	}
		
	
	
}


// This path is set for use in a child theme.  The code could be updated in a few places
// to TEMPLATEPATH if this was being used in a parent theme.

//define some constant paths
define('ADMIN_PATH', STYLESHEETPATH . '/inc/seo-functions/admin/');
define('FUNCTIONS_PATH', STYLESHEETPATH . '/functions/');

//define some constants
define('CHILDTHEME', get_bloginfo('stylesheet_directory') . '/');
define('ADMIN', CHILDTHEME . 'inc/admin/');
define('FUNCTIONS', CHILDTHEME . 'functions/');
define('LAYOUTS', CHILDTHEME . 'layouts/');
define('STYLES', STYLESHEETPATH . '/styles/');

// You can mess with these 2 if you wish.
$themedata = wp_get_theme(STYLESHEETPATH . '/style.css');
define('THEMENAME', $themedata['Name']);
define('OPTIONS', 'of_options'); //name of entry into database - will break DB if this has spaces!