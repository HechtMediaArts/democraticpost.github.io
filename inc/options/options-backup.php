<?php ob_start();
/**
 * Admin Backup File.
 *
 * Backup your "Theme Options" and / or "SEO Options" to a downloadable text file.
 *
 * @category Evolution Framework
 * @package  Administration
 * @author   Hecht MediaArts - Andreas Hecht & Gilles Vauvarin
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.hechtmediaarts.com/themes/evolution
 *
  * This code is a fork from the WooThemes Framework admin-backup.php file.
 */
/*
 * -----------------------------------------------------------------------------------

 TABLE OF CONTENTS

 - var $admin_page
 - var $token
 
 - function OptionsFramework_Backup ()				// Constructor
 - function init () 																// Initialize the class.
 - function register_admin_screen () 						// Register the admin screen within WordPress.
 - function admin_screen () 											// Load the admin screen.
 - function admin_screen_help ()								// Add contextual help to the admin screen.
 - function admin_notices() 											// Display admin notices when performing backup/restore.
 - function admin_screen_logic ()								// The processing code to generate the backup or restore from a previous backup.	
 - function import ()															// Import theme settings from a backup file.
 - function seo_import ()												// Import seo settings from a backup file.
 - function export ()															// Export theme settings to a backup file.
 - function seo_export ()												// Export seo settings to a backup file.
 - function construct_database_query ()					// Constructs the database query based on the export type.
-----------------------------------------------------------------------------------*/

// #################### ToDo: admin_screen_help(); ###############################################################

// Create EvoFramework_Backup Object
class EvoFramework_Backup {
	
	var $admin_page;
	var $token;
	
	function EvoFramework_Backup () {
		$this->admin_page = '';
		$this->token = 'evolution-import-export';
		$seo = "seo";
	} // End Constructor
	
	/**
	 * init()
	 *
	 * Initialize the class.
	 *
	 * @since 2.0.0
	 */

		public function init () {

		if ( is_admin() ) {

			// Register the admin screen.
			add_action( 'admin_menu', array( &$this, 'register_admin_screen' ), 20 );

		}

	} // End init()
	
	/**
	 * register_admin_screen()
	 *
	 * Register the admin screen within WordPress.
	 *
	 * @since 2.0.0
	 */
	
	function register_admin_screen () {
			
		$this->admin_page = add_submenu_page('evolution-options', __( 'Import / Export', 'OptionsFramework' ), __( 'Import / Export', 'OptionsFramework' ), 'edit_theme_options', $this->token, array( &$this, 'admin_screen' ) );

		// Adds actions to hook in the required css and javascript
		add_action("admin_print_styles-$this->admin_page",'optionsframework_load_adminstyles');

		/* Loads the CSS */
		function optionsframework_load_adminstyles() {
			wp_enqueue_style('optionsframework', OPTIONS_FRAMEWORK_DIRECTORY.'css/optionsframework.css');
		}
			
		// Admin screen logic.
		add_action( 'load-' . $this->admin_page, array( &$this, 'admin_screen_logic' ) );
		
		// Add contextual help.
		add_action( 'contextual_help', array( &$this, 'admin_screen_help' ), 10, 3 );
				
		add_action( 'admin_notices', array( &$this, 'admin_notices' ), 10 );
	
	} // End register_admin_screen()

	
	/**
	 * admin_screen()
	 *
	 * Load the admin screen.
	 *
	 * @since 2.0.0
	 */
	
	function admin_screen () {
	
		$export_type = 'all';
		
		if ( isset( $_POST['export-type'] ) ) {
			$export_type = esc_attr( $_POST['export-type'] );
		}
?>
<div class="wrap">
			<?php echo get_screen_icon( 'tools' ); ?>	
		<h2><?php _e( 'Evolution Import / Export Einstellungen' ); ?></h2>
		<div id="optionsframework-metabox" class="metabox-holder">
		<div class="postbox" id="optionsframework">
		<div class="import">
			<h3>Import Theme Einstellungen</h3>
			<div class="section-backup first">
			<p><?php _e( 'Wenn Du Einstellungen in einer Backup-Datei (<code>.json </code>) auf Deinem Computer hast, kann der Import / Export Manager sie in diese Website importieren. Um loszulegen, lade die Backup-Datei hoch, um die Einstellungen zu importieren.' ); ?></p>
				<form enctype="multipart/form-data" method="post" action="<?php echo admin_url( 'admin.php?page=' . $this->token ); ?>">
					<?php wp_nonce_field( 'evolution-backup-import' ); ?>
					<label for="evolution-import-file"><?php printf( __( 'Datei hochladen: (Maximum Size: %s)' ), ini_get( 'post_max_size' ) ); ?></label>
					<input type="file" id="evolution-import-file" name="evolution-import-file" size="25" />
					<input type="hidden" name="evolution-backup-import" value="1" />
					<input type="submit" class="button button-primary" value="<?php _e( 'Hochladen und Importieren' ); ?>" />
				</form>
		</div>
		</div>
		<div class="export">
			<h3><?php _e( 'Export Theme Einstellungen' ); ?></h3>
			<div class="section-backup second">
			<p><?php _e( 'Wenn Du den Button unten anklickst, wird der Backup Manager eine Sicherungsdatei (<code>.json</code> auf Deinem Computer abspeichern.' ); ?></p>
			<p><?php echo sprintf( __( 'Diese Datei kann dazu verwendet werden, Deine Einstellungen hier auf "%s" wiederherzustellen, oder aber eine andere Webseite mit den gleichen Einstellungen einzurichten.' ), get_bloginfo( 'name' ) ); ?></p>
			<form method="post" action="<?php echo admin_url( 'admin.php?page=' . $this->token ); ?>">
				<?php wp_nonce_field( 'evo_backup_export' ); ?>
				<input type="hidden" name="evo_backup_export" value="1" />
				<input type="submit" class="button button-primary" value="<?php _e( 'Download Theme-Export-Datei', 'OptionsFramework' ); ?>" />
			</form>
			</div>
		</div>
<div class="import">
			<h3>Import SEO Einstellungen</h3>
			<div class="section-backup first">
			<p><?php _e( 'Wenn Du Einstellungen in einer Backup-Datei (<code>.json </code>) auf Deinem Computer hast, kann der Import / Export Manager sie in diese Website importieren. Um loszulegen, lade die Backup-Datei hoch, um die Einstellungen zu importieren.' ); ?></p>
				<form enctype="multipart/form-data" method="post" action="<?php echo admin_url( 'admin.php?page=' . $this->token ); ?>">
					<?php wp_nonce_field( 'evolution-seo-import' ); ?>
					<label for="seo-evolution-import-file"><?php printf( __( 'Datei hochladen: (Maximum Size: %s)' ), ini_get( 'post_max_size' ) ); ?></label>
					<input type="file" id="seo-evolution-import-file" name="seo-evolution-import-file" size="25" />
					<input type="hidden" name="evolution-seo-import" value="1" />
					<input type="submit" class="button button-primary" value="<?php _e( 'Hochladen und Importieren' ); ?>" />
				</form>
		</div>
		</div>		
<div class="export">
			<h3><?php _e( 'Export SEO Einstellungen' ); ?></h3>
			<div class="section-backup">
			<p><?php _e( 'Wenn Du den Button unten anklickst, wird der Backup Manager eine Sicherungsdatei (<code>.json</code> auf Deinem Computer abspeichern.' ); ?></p>
			<p><?php echo sprintf( __( 'Diese Datei kann dazu verwendet werden, Deine Einstellungen hier auf "%s" wiederherzustellen, oder aber eine andere Webseite mit den gleichen Einstellungen einzurichten.' ), get_bloginfo( 'name' ) ); ?></p>
			<form method="post" action="<?php echo admin_url( 'admin.php?page='. $this->token ); ?>">
				<?php wp_nonce_field( 'evo_seo_export' ); ?>
				<input type="hidden" name="evo_seo_export" value="1" />
				<input type="submit" class="button button-primary" value="<?php _e( 'Download SEO-Export-Datei', 'OptionsFramework' ); ?>" />
			</form>
			</div>
		</div>
	  </div>	
	  </div>
	</div><!--/.wrap-->
<?php
} // End admin_screen()

	
	/**
	 * admin_screen_help()
	 *
	 * Add contextual help to the admin screen.
	 *
	 * @since 2.0.0
	 */
	
	function admin_screen_help ( $contextual_help, $screen_id, $screen ) {
	
		// $contextual_help .= var_dump($screen); // use this to help determine $screen->id
		
		if ( $this->admin_page == $screen->id ) {
		
		$contextual_help =
		  '<h3>' . __( 'Willkommen zum Evolution Backup Manager.' ) . '</h3>' .
		  '<p>' . __( 'Hier eine kurze Beschreibung, wie dieses Tool zu nutzen ist.' ) . '</p>' .
		  '<p>' . __( 'Dieser Backup Manager erlaubt Dir, Deine "Theme Optionen" und "SEO Optionen" in einer .jason Datei zu exportieren und zu importieren' ) . '</p>' .
		  '<p>' . __( 'Um ein Backup zu generieren, klicke einfach auf den Backup Button (Theme oder SEO Backup). Die Einstellungen werden gesichert und auf Deinen Computer runtergeladen.' ) . '</p>' .
		  '<p>' . __( 'Um Deine Einstellungen aus einer Sicherung wiederherstellen, durchsuche Deinen Computer nach der Datei (unter der "Import Einstellungen" Überschrift) und drücke den "Datei hochladen und Import" Button.  Das stellt die Einstellungen seit dem letzten Backup wieder her.' ) . '</p>' .
		  
		  '<p><strong>' . __( 'Bitte beachte, dass nur gültige Backup-Dateien durch den Evolution Backup Manager importiert werden.' ) . '</strong></p>' .

		  '<p><strong>' . __( 'Du benötigst Hilfe?' ) . '</strong></p>' .
		  '<p>' . sprintf( __( 'Bitte poste Deine Frage im %sEvolution Support Forum%s und wir geben unser Bestes, um Dir helfen zu können.' ), '<a href="http://forum.hechtmediaarts.com/" target="_blank">', '</a>' ) . '</p>';
		
		} // End IF Statement
		
		return $contextual_help;
	
	} // End admin_screen_help()

	
	/**
	 * admin_notices()
	 *
	 * Display admin notices when performing backup/restore.
	 *
	 * @since 2.0.0
	 */
	
	function admin_notices () {
	
		if ( ! isset( $_GET['page'] ) || ( $_GET['page'] != $this->token ) ) { return; }
	
		echo '<div id="import-notice" class="updated"><p>' . sprintf( __( 'Bitte beachte, dass dieser Backup Manager nur Deine Theme Einstellungen und nicht Deinen Inhalt sichert. Um Deinen Inhalt zu sichern, nutze bitte das %sWordPress Export Tool%s.', 'OptionsFramework' ), '<a href="' . admin_url( 'export.php' ) . '">', '</a>' ) . '</p></div><!--/#import-notice .message-->' . "\n";
			
		if ( isset( $_GET['error'] ) && $_GET['error'] == 'true' ) {
			echo '<div id="message" class="error"><p>' . __( 'Es gab ein Problem mit dem Importieren Deiner Einstellungen. Versuche es erneut.' ) . '</p></div>';
		} else if ( isset( $_GET['error-export'] ) && $_GET['error-export'] == 'true' ) {  
			echo '<div id="message" class="error"><p>' . __( 'Es gab ein Problem mit dem Exportieren Deiner Einstellungen. Versuche es erneut.' ) . '</p></div>';
		} else if ( isset( $_GET['invalid'] ) && $_GET['invalid'] == 'true' ) {  
			echo '<div id="message" class="error"><p>' . __( 'Deine Import-Datei ist ungültig. Versuche es erneut.' ) . '</p></div>';
		} else if ( isset( $_GET['imported'] ) && $_GET['imported'] == 'true' ) {  
			echo '<div id="message" class="updated"><p>' . sprintf( __( 'Theme Einstellungen erfolgreich importiert. | Zurück zu den  %sTheme Einstellungen%s', 'OptionsFramework' ), '<a href="' . admin_url( 'admin.php?page=evolution-options' ) . '">', '</a>' ) . '</p></div>';
		} else if ( isset( $_GET['success'] ) && $_GET['success'] == 'true' ) {  
			echo '<div id="message" class="updated"><p>' . sprintf( __( 'SEO Einstellungen erfolgreich importiert. | Zurück zu den %sSEO Optionen%s', 'OptionsFramework' ), '<a href="' . admin_url( 'admin.php?page=seo-options' ) . '">', '</a>' ) . '</p></div>';
		} // End IF Statement
		
	} // End admin_notices()

	
	/**
	 * admin_screen_logic()
	 *
	 * The processing code to generate the backup or restore from a previous backup.
	 *
	 * @since 2.0.0
	 */
	
	public function admin_screen_logic () {
		
		if ( ! isset( $_POST['evo_backup_export'] ) && isset( $_POST['evolution-backup-import'] ) && ( $_POST['evolution-backup-import'] == true ) ) {
			$this->import();
		}

		if ( ! isset( $_POST['evo_seo_export'] ) && isset( $_POST['evolution-seo-import'] ) && ( $_POST['evolution-seo-import'] == true ) ) {
			$this->seo_import();
		}
		
		if ( ! isset( $_POST['evolution-backup-import'] ) && isset( $_POST['evo_backup_export'] ) && ( $_POST['evo_backup_export'] == true ) ) {
			$this->export();
		}

		if ( ! isset( $_POST['evolution-backup-import'] ) && isset( $_POST['evo_seo_export'] ) && ( $_POST['evo_seo_export'] == true ) ) {
			$this->seo_export();
		}

	} // End admin_screen_logic()
	

	/**
	 * import()
	 *
	 * Import settings from a backup file.
	 *
	 * @since 2.0.0
	 */

	function import() {
		check_admin_referer( 'evolution-backup-import' ); // Security check.
		
		if ( ! isset( $_FILES['evolution-import-file'] ) ) { return; } // We can't import the settings without a settings file.
		
		// Extract file contents
		$upload = file_get_contents( $_FILES['evolution-import-file']['tmp_name'] );
		
		// Decode the JSON from the uploaded file
		$datafile = json_decode( $upload, true );
		
		// Check for errors
		if ( ! $datafile || $_FILES['evolution-import-file']['error'] ) {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&error=true' ) );
			exit;
		}
		
		// Make sure this is a valid backup file.
		if ( ! isset( $datafile['evolution-backup-validation'] ) ) {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&invalid=true' ) );
			exit;
		} else {
			unset( $datafile['evolution-backup-validation'] ); // Now that we've checked it, we don't need the field anymore.
		}
	
		// Get the theme name from the database.
		$optionsframework_settings = get_option( 'optionsframework' );
		$option_name = $optionsframework_settings['id'];
		//$optionsframework_name = get_option( $optionsframework_name );
		
		// Update the settings in the database 
		if ( update_option( $option_name,  $datafile ) ) {
		
		// Redirect, add success flag to the URI
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&imported=true' ) );
			exit;
		} else {
		// Errors: update fail
			var_dump($option_name);
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&error=true' ) );
			exit;
		}
		
	} // End import() 


	/**
	 * seo_import()
	 *
	 * Import settings from a backup file.
	 *
	 * @since 2.0.0
	 */

		public function seo_import() {
		check_admin_referer( 'evolution-seo-import' ); // Security check.
		
		if ( ! isset( $_FILES['seo-evolution-import-file'] ) ) { return; } // We can't import the settings without a settings file.
		
		// Extract file contents
		$upload = file_get_contents( $_FILES['seo-evolution-import-file']['tmp_name'] );
		
		// Decode the JSON from the uploaded file
		$options = json_decode( $upload, true );
		
		// Check for errors
		if ( ! $options || $_FILES['seo-evolution-import-file']['error'] ) {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&error=true' ) );
			exit;
		}
		
		// Make sure this is a valid backup file.
		if ( ! isset( $options['evolution-backup-validator'] ) ) {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&invalid=true' ) );
			exit;
		} else {
			unset( $options['evolution-backup-validator'] ); // Now that we've checked it, we don't need the field anymore.
		}
		
		// Make sure the options are saved to the global options collection as well.
		$database_options = get_option('of_options');

		$has_updated = false; // If this is set to true at any stage, we update the main options collection.
		
		// Cycle through data, import settings
		foreach ( (array)$options as $key => $settings ) {
			
			$settings = maybe_unserialize( $settings ); // Unserialize serialized data before inserting it back into the database.
			
			// We can run checks using get_option(), as the options are all cached. See wp-includes/functions.php for more information.
			if ( get_option( $key ) != $settings ) {
				update_option( $key, $settings );
			}
			
			if ( is_array( $database_options ) ) {
				if ( isset( $database_options[$key] ) && $database_options[$key] != $settings ) {
					$database_options[$key] = $settings;
					$has_updated = true;
				}
			}
		}
		
		if ( $has_updated == true ) {
			update_option( 'of_options', $database_options );
		}
		
		// Redirect, add success flag to the URI
		wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&success=true' ) );
		exit;
		
	} // End seo_import()

	
	/**
	 * export()
	 *
	 * Export settings to a backup file.
	 *
	 * @since 2.0.0
	 * @uses global $wpdb
	 */
	 
	function export() {
		global $wpdb;
		check_admin_referer( 'evo_backup_export' ); // Security check.

		$optionsframework_settings = get_option( 'optionsframework' );
		$database_options = get_option( $optionsframework_settings['id'] );
		
		// Error trapping for the export. 
		if ( $database_options == '' )  {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&error-export=true' ) );
			return;
		}
		
		if ( ! $database_options )  { return; } 
	
		// Add our custom marker, to ensure only valid files are imported successfully.
		$database_options['evolution-backup-validation'] = date( 'Y-m-d h:i:s' );
		
		// Generate the export file.
	    $output = json_encode( (array)$database_options );
	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: text/plain' );
	    header( 'Content-Disposition: attachment; filename="' . $this->token . '-' . date( 'Ymd-His' ) . '.json"' );
	    header( 'Content-Length: ' . strlen( $output ) );
	    ob_end_clean();
	    echo $output;
	    exit;
			
	} // End export()


		/**
	 * seo_export()
	 *
	 * Export seo settings to a backup file.
	 *
	 * @since 2.0.0
	 * @uses global $wpdb
	 */
	 
	function seo_export() {
		global $wpdb;
		check_admin_referer( 'evo_seo_export' ); // Security check.

		global $options_machine;
		global $data;

		$options_machine = get_option('of_options');

		$database_options = get_option(OPTIONS);
		
		// Error trapping for the export. 
		if ( $database_options == '' )  {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&error-export=true' ) );
			return;
		}
		
		if ( ! $database_options )  { return; } 
	
		// Add our custom marker, to ensure only valid files are imported successfully.
		$database_options['evolution-backup-validator'] = date( 'Y-m-d h:i:s' );
		
		// Generate the export file.
	    $output = json_encode( (array)$database_options );
	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: text/plain' );
	    header( 'Content-Disposition: attachment; filename="seo-' . $this->token . '-' . date( 'Ymd-His' ) . '.json"' );
	    header( 'Content-Length: ' . strlen( $output ) );
	    ob_end_clean();
	    echo $output;
	    exit;
			
	} // End seo_export()

} // End Class

/**
 * Create EvoFramework_Backup Object.
 *
 * @since 2.0.0
 * @uses EvoFramework_Backup
 */

$of_backup = new EvoFramework_Backup();
$of_backup->init();