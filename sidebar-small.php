<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the second (alternate) sidebar.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */
?>

<!-- - - - - - - - - - - - - - - - -  Sidebar - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<aside id="sidebar-small" class="sidebar" role="complementary">
		<?php 
			do_action( 'evolution_sidebar_sekundaer' );
		?>
</aside>