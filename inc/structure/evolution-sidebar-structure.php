<?php

/**
 * Layout Structure File.
 *
 * @category    Evolution Framework
 * @package     Admin
 * @subpackage Structure
 * @author        Hecht MediaArts
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              http://www.hechtmediaarts.com/themes/evolution
 */

/**
 * Get template parts (sidebars), if need
 * 
 * @since 2.0.0
 * 
 */ 

function layout_structure_sidebars() {

if ( of_get_option( 'example_images') == 'full-width-content' ) {
				echo '<div class="clearfix"></div>';
				evolution_after_content();
				echo '</div><!-- end #content-sidebar-wrap -->';
}

if ( rwmb_meta( 'Evolution_fullpage' ) == 'full-width-content' ) {

			echo '<div class="clearfix"></div>';
			evolution_after_content();
			echo '</div><!-- end #content-sidebar-wrap -->';

			$site_layout = rwmb_meta( 'Evolution_fullpage' );

			/** Don't load sidebar on pages that don't need it */
			if ( $site_layout == 'full-width-content' )
			return;

			get_sidebar();

}

if ( rwmb_meta( 'Evolution_select' ) == 'full-width-content' ) {
				echo '<div class="clearfix"></div>';
				evolution_after_content();
				echo '</div><!-- end #content-sidebar-wrap -->';
}

	if ( of_get_option( 'example_images') == 'sidebar-content' ) {
 			get_sidebar();
			echo '<div class="clearfix"></div>';
			evolution_after_content();
			echo '</div><!-- end #content-sidebar-wrap -->';
}		

if ( of_get_option( 'example_images') == 'content-sidebar' ) {
		get_sidebar();
		echo '<div class="clearfix"></div>';
		evolution_after_content();
		echo '</div><!-- end #content-sidebar-wrap -->';
}    


if ( of_get_option( 'example_images') == 'sidebar-content-sidebar' ) {
		get_sidebar();
		echo '<div class="clearfix"></div>';
		evolution_after_content();
		echo '</div><!-- end #content-sidebar-wrap -->';
		get_template_part( 'sidebar-small' ); 
} 

if ( of_get_option( 'example_images') == 'sidebar-sidebar-content' ) {
		get_sidebar();
		echo '<div class="clearfix"></div>';
		evolution_after_content();
		echo '</div><!-- end #content-sidebar-wrap -->';
		get_template_part( 'sidebar-small' ); 
}

if ( of_get_option( 'example_images') == 'content-sidebar-sidebar' ) {
		get_sidebar();
		echo '<div class="clearfix"></div>';
		evolution_after_content();
		echo '</div><!-- end #content-sidebar-wrap -->';
		get_template_part( 'sidebar-small' ); 
	}	
}
add_action( 'layout_structure', 'layout_structure_sidebars' );

