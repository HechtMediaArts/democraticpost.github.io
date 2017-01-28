<?php
/**
 * Controls output elements in primary or secondary sidebars and registers the sidebars.
 *
 * @category   		Evolution Framework
 * @package    		Structure
 * @subpackage 	Sidebars / Structure
 * @author     		Hecht MediaArts
 * @license    		http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       			http://hechtmediaarts.com/evolution
 */


// Registers the sidebars
function evolution_register_sidebar( $args ) {

	$defaults = (array) apply_filters(
		'evolution_register_sidebar_defaults',
		array(
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => "</div></div>\n",
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => "</div>\n",
		)
	);

	$args = wp_parse_args( $args, $defaults );

	return register_sidebar( $args );
}


add_action( 'init', 'evolution_register_default_sidebars' );
/**
 * Registers the default evolution widget areas.
 *
 * @since 2.0.0
 *
 * @uses evolution_register_sidebar() Register widget areas
 */
function evolution_register_default_sidebars() {

	evolution_register_sidebar(
		array(
			'id'          => 'primaer',
			'name'        => __( 'Hauptsidebar', 'evolution' ),
			'description' => __( 'Dies ist die primäre Sidebar, wenn Du die zwei oder drei Spalten Seiten-Layout-Option verwendest.', 'evolution' ),
		)
	);

	evolution_register_sidebar(
		array(
			'id'          => 'sekundaer',
			'name'        => __( 'Sekundäre Sidebar', 'evolution' ),
			'description' => __( 'Dies ist die sekundäre Sidebar, wenn Du das dreispaltige Seitenlayout verwendest.', 'evolution' ),
		)
	);

		evolution_register_sidebar(
		array(
			'id'          => 'header',
			'name'        => __( 'Header rechts', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich im Kopf der Seite. Du kannst zum Beispiel eine Suchfunktion oder Social Media Icons einfügen.', 'evolution' ),
		)
	);
    
    		evolution_register_sidebar(
		array(
			'id'          => 'startseite',
			'name'        => __( 'Startseite', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich in der Sidebar der Startseite. Du kannst zum Beispiel eine Suchfunktion oder Social Media Icons einfügen.', 'evolution' ),
		)
	);
    
        		evolution_register_sidebar(
		array(
			'id'          => 'werbung_footer',
			'name'        => __( 'Werbebereich Footer', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich oberhalb des Footers.', 'evolution' ),
		)
	);

		evolution_register_sidebar(
		array(
			'before_widget' => '<div id="%1$s" class="zilla-one-fifth"><div class="widget-wrap">',
			'id'          => 'footer-1',
			'name'        => __( 'Footerbereich Eins', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich für den Fuß der Webseite (Footer). Wenn Du in diesem Bereich Widgets nutzen möchtest, musst Du sie erst auf der Theme Optionen Seite freischalten.', 'evolution' ),
			'after_widget'  => "</div></div>\n",
		)
	);

			evolution_register_sidebar(
		array(
			'id'          => 'footer-2',
			'before_widget' => '<div id="%1$s" class="zilla-one-fifth"><div class="widget-wrap">',
			'name'        => __( 'Footerbereich Zwei', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich für den Fuß der Webseite (Footer). Wenn Du in diesem Bereich Widgets nutzen möchtest, musst Du sie erst auf der Theme Optionen Seite freischalten.', 'evolution' ),
			'after_widget'  => "</div></div>\n",
		)
	);

				evolution_register_sidebar(
		array(
			'id'          => 'footer-3',
			'before_widget' => '<div id="%1$s" class="zilla-one-fifth"><div class="widget-wrap">',
			'name'        => __( 'Footerbereich Drei', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich für den Fuß der Webseite (Footer). Wenn Du in diesem Bereich Widgets nutzen möchtest, musst Du sie erst auf der Theme Optionen Seite freischalten.', 'evolution' ),
			'after_widget'  => "</div></div>\n",
		)
	);
    
    				evolution_register_sidebar(
		array(
			'id'          => 'footer-4',
			'before_widget' => '<div id="%1$s" class="zilla-one-fifth"><div class="widget-wrap">',
			'name'        => __( 'Footerbereich Vier', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich für den Fuß der Webseite (Footer). Wenn Du in diesem Bereich Widgets nutzen möchtest, musst Du sie erst auf der Theme Optionen Seite freischalten.', 'evolution' ),
			'after_widget'  => "</div></div>\n",
		)
	);
    
    				evolution_register_sidebar(
		array(
			'id'          => 'footer-5',
			'before_widget' => '<div id="%1$s" class="zilla-one-fifth zilla-column-last"><div class="widget-wrap">',
			'name'        => __( 'Footerbereich Fünf', 'evolution' ),
			'description' => __( 'Dies ist der Widgetbereich für den Fuß der Webseite (Footer). Wenn Du in diesem Bereich Widgets nutzen möchtest, musst Du sie erst auf der Theme Optionen Seite freischalten.', 'evolution' ),
			'after_widget'  => "</div></div>\n",
		)
	);

}


add_action( 'evolution_sidebar', 'evolution_sidebar_text' );
/**
 * Echo primary sidebar default content.
 *
 * @since 2.0.0
 */
function evolution_sidebar_text() {

	if ( !dynamic_sidebar( 'primaer' ) ) {
		echo '<div class="widget widget_text"><div class="widget-wrap">';
			echo '<div class="widgettitle">';
				_e( 'Widgetbereich primäre Sidebar', 'evolution' );
			echo '</div>';
			echo '<div class="textwidget"><p>';
				printf( __( 'Dies ist der Widgetbereich in der primären Sidebar. Du kannst Inhalte zu diesem Bereich hinzufügen, indem Du zum <a href="%s">Widgets Bereich</a> gehst, und Widgets in diesen Bereich ziehst.', 'evolution' ), admin_url( 'widgets.php' ) );
			echo '</p></div>';
		echo '</div></div>';
	}

}


add_action( 'evolution_sidebar_sekundaer', 'evolution_sidebar_sekundaer_text' );
/**
 * Echo secondary sidebar default content.
 *
 * @since 2.0.0
 */
function evolution_sidebar_sekundaer_text() {

	if ( !dynamic_sidebar( 'sekundaer' ) ) {
		echo '<div class="widget widget_text"><div class="widget-wrap">';
			echo '<div class="widgettitle">';
				_e( 'Widgetbereich sekundäre Sidebar', 'evolution' );
			echo '</div>';
			echo '<div class="textwidget"><p>';
				printf( __( 'Dies ist der Widgetbereich in der primären Sidebar. Du kannst Inhalte zu diesem Bereich hinzufügen, indem Du zum <a href="%s">Widgets Bereich</a> gehst, und Widgets in diesen Bereich ziehst.', 'evolution' ), admin_url( 'widgets.php' ) );
			echo '</p></div>';
		echo '</div></div>';
	}

}


add_action( 'evolution_sidebar_static', 'evolution_sidebar_static_text' );
/**
 * Echo static frontpaget sidebar default content.
 *
 * @since 2.0.0
 */
function evolution_sidebar_static_text() {

	if ( !dynamic_sidebar( 'sidebar-static' ) ) {
		echo '<div class="widget widget_text"><div class="widget-wrap">';
			echo 'widgetbereich Startseite<div class="widgettitle">';
				_e( '', 'evolution' );
			echo '</div>';
			echo '<div class="textwidget"><p>';
				printf( __( 'Dies ist der Widgetbereich in der primären Sidebar. Du kannst Inhalte zu diesem Bereich hinzufügen, indem Du zum <a href="%s">Widgets Bereich</a> gehst, und Widgets in diesen Bereich ziehst.', 'evolution' ), admin_url( 'widgets.php' ) );
			echo '</p></div>';
		echo '</div></div>';
	}

}

/**
 * 
 * TODO: Find a better solution.
 * 
 */

add_action( 'evolution_header', 'evolution_header_text' );


/**
 * Echo footer default content - header.
 *
 * @since 2.0.0
 */
function evolution_header_text() {

	if ( !dynamic_sidebar( 'header' ) ) {
?>        
<div id="adcontainer">
  <div id="headerad">
 <?php dynamic_sidebar( 'header' ); ?>   
</div><!-- end #headerad -->
</div><!-- end #adcontainer -->    

<?php	}

}

add_action( 'evolution_startseite', 'evolution_home_text' );
/**
 * Echo Home default content - Homepage.
 *
 * @since 2.0.0
 */
function evolution_home_text() {

	if ( !dynamic_sidebar( 'startseite' ) ) {

	}

}

add_action( 'evolution_footer', 'evolution_footer_text_eins' );
/**
 * Echo footer default content - left.
 *
 * @since 2.0.0
 */
function evolution_footer_text_eins() {

	if ( !dynamic_sidebar( 'footer-1' ) ) {


	}

}

add_action( 'evolution_footer', 'evolution_footer_text_zwei' );
function evolution_footer_text_zwei() {

	if ( !dynamic_sidebar( 'footer-2' ) ) {


	}

}

add_action( 'evolution_footer', 'evolution_footer_text_drei' );
function evolution_footer_text_drei() {

	if ( !dynamic_sidebar( 'footer-3' ) ) {


	}

}

add_action( 'evolution_footer', 'evolution_footer_text_vier' );
function evolution_footer_text_vier() {

	if ( !dynamic_sidebar( 'footer-4' ) ) {


	}

}
add_action( 'evolution_footer', 'evolution_footer_text_fuenf' );
function evolution_footer_text_fuenf() {

	if ( !dynamic_sidebar( 'footer-5' ) ) {


	}

}



