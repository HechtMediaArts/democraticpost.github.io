<?php
/**
 * Genesis eNews Extended
 *
 * @package   BJGK\Genesis_enews_extended
 * @version   1.2.0
 * @author    Brandon Kraft <public@brandonkraft.com>
 * @link      http://www.brandonkraft.com/contrib/plugins/genesis-enews-extended/
 * @copyright Copyright (c) 2012, Brandon Kraft
 * @license   GPL-2.0+
 */

/**
 * Register widget.
 *
 * @since 0.1.0
 */
function bjgk_genesis_enews_load_widgets() {
	register_widget( 'BJGK_Genesis_eNews_Extended' );
}
add_action( 'widgets_init', 'bjgk_genesis_enews_load_widgets' );

/**
 * Main plugin class.
 *
 * @package BJGK\Genesis_enews_extended
 * @author Brandon Kraft <public@brandonkraft.com>
 */
class BJGK_Genesis_eNews_Extended extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.0
	 */
	function __construct() {
		$this->defaults = array(
			'title'				=> '',
			'text'				=> '',
			'after_text'		=> '',
			'hidden_fields'		=> '',
			'open_same_window'	=> 0,
			'fname-field'		=> '',
			'lname-field'		=> '',
			'input_text'		=> '',
			'fname_text'		=> '',
			'lname_text'		=> '',
			'button_text'		=> '',
			'id'				=> '',
			'email-field'		=> '',
			'action'			=> '',
		);

		$widget_ops = array(
			'classname'   => 'enews-widget',
			'description' => __( 'Zeigt ein Formular zum Abonnieren von Newslettern diverser Anbieter an.', 'genesis-enews-extended' ),
		);

		parent::__construct( 'enews-ext', __( 'Evolution Newsletter', 'genesis-enews-extended' ), $widget_ops );
	}

	/**
	 * Echo the widget content.
	 *
	 * @since 0.1.0
	 *
	 * @param array $args     Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget . '<div class="enews">';

	 	// Set default fname_text, lname_text for backwards compat for installs upgraded from 0.1.6+ to 0.3.0+
		if (empty($instance['fname_text'])) {
			$instance['fname_text'] = "First Name";
		}
		if (empty($instance['lname_text'])) {
			$instance['lname_text'] = "Last Name";
		}

			if ( ! empty( $instance['title'] ) )
				echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;

			echo wpautop( $instance['text'] ); // We run KSES on update

			if ( ! empty( $instance['id'] ) ) : ?>
			<form id="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open( 'http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_js( $instance['id'] ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" name="<?php echo esc_attr( $instance['title'] ); ?>">
				<label for="subbox" class="screenread"><?php echo esc_attr( $instance['input_text'] ); ?></label><input type="text" value="<?php echo esc_attr( $instance['input_text'] ); ?>" id="subbox" onfocus="if ( this.value == '<?php echo esc_js( $instance['input_text'] ); ?>') { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php echo esc_js( $instance['input_text'] ); ?>'; }" name="email" />
				<input type="hidden" name="uri" value="<?php echo esc_attr( $instance['id'] ); ?>" />
				<input type="hidden" name="loc" value="<?php echo esc_attr( get_locale() ); ?>" />
				<input type="submit" value="<?php echo esc_attr( $instance['button_text'] ); ?>" id="subbutton" />
			</form>
			<?php elseif ( ! empty( $instance['action'] ) ) : ?>
			<form id="subscribe" action="<?php echo esc_attr( $instance['action'] ); ?>" method="post" <?php if ($instance['open_same_window'] == 0 ) : ?> target="_blank"<?php endif; ?> onsubmit="if ( subbox1.value == '<?php echo esc_js( $instance['fname_text'] ); ?>') { subbox1.value = ''; } if ( subbox2.value == '<?php echo esc_js( $instance['lname_text'] ); ?>') { subbox2.value = ''; }" name="<?php echo esc_attr( $instance['title'] ); ?>">
				<?php if ( ! empty($instance['fname-field'] ) ) : ?><label for="subbox1" class="screenread"><?php echo esc_attr( $instance['fname_text'] ); ?></label><input type="text" id="subbox1" class="enews-subbox" value="<?php echo esc_attr( $instance['fname_text'] ); ?>" onfocus="if ( this.value == '<?php echo esc_js( $instance['fname_text'] ); ?>') { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php echo esc_js( $instance['fname_text'] ); ?>'; }" name="<?php echo esc_attr( $instance['fname-field'] ); ?>" /><?php endif ?>
				<?php if ( ! empty($instance['lname-field'] ) ) : ?><label for="subbox2" class="screenread"><?php echo esc_attr( $instance['lname_text'] ); ?></label><input type="text" id="subbox2" class="enews-subbox" value="<?php echo esc_attr( $instance['lname_text'] ); ?>" onfocus="if ( this.value == '<?php echo esc_js( $instance['lname_text'] ); ?>') { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php echo esc_js( $instance['lname_text'] ); ?>'; }" name="<?php echo esc_attr( $instance['lname-field'] ); ?>" /><?php endif ?>
				<label for="subbox" class="screenread"><?php echo esc_attr( $instance['input_text'] ); ?></label><input type="text" value="<?php echo esc_attr( $instance['input_text'] ); ?>" id="subbox" onfocus="if ( this.value == '<?php echo esc_js( $instance['input_text'] ); ?>') { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php echo esc_js( $instance['input_text'] ); ?>'; }" name="<?php echo esc_js( $instance['email-field'] ); ?>" />
				<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    			<div style="position: absolute; left: -5000px;">
    			<input type="text" name="<?php echo $instance['hidden_fields']; ?>" tabindex="-1" value="">
    		</div>
				<input type="submit" value="<?php echo esc_attr( $instance['button_text'] ); ?>" id="subbutton" />
			</form>
			<?php endif;
			echo wpautop( $instance['after_text'] ); // We run KSES on update

		echo '</div>' . $after_widget;
	}

	/**
	 * Update a particular instance. 
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If false is returned, the instance won't be saved / updated.
	 *
	 * @since 0.1.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$new_instance['title']         = strip_tags( $new_instance['title'] );
		$new_instance['text']          = wp_kses_post( $new_instance['text']);
		$new_instance['hidden_fields'] = strip_tags( $new_instance['hidden_fields'], "<input>, <div>, <label>" );
		$new_instance['after_text']    = wp_kses_post( $new_instance['after_text']);
		return $new_instance;
	}

	/**
	 * Echo the settings update form.
	 *
	 * @since 0.1.0
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Titel', 'evolution' ); ?>:</label><br />
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text oberhalb des Formulars', 'evolution' ); ?>:</label><br />
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" class="widefat" rows="6" cols="4"><?php echo htmlspecialchars( $instance['text'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'after_text' ) ); ?>"><?php _e( 'Text unter dem Formular', 'evolution' ); ?>:</label><br />
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'after_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'after_text' ) ); ?>" class="widefat" rows="6" cols="4"><?php echo htmlspecialchars( $instance['after_text'] ); ?></textarea>
		</p>
		<hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;">
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php _e( 'Google/Feedburner ID', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>" value="<?php echo esc_attr( $instance['id'] ); ?>" class="widefat" /><br />
			<small><?php _e( 'Das Eingeben einer Feedburner ID macht die Felder unterhalb unwirksam', 'evolution' ); ?></small>
		</p>
		<hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;">
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'action' ) ); ?>"><?php _e( 'Form Action', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'action' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'action' ) ); ?>" value="<?php echo esc_attr( $instance['action'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email-field' ) ); ?>"><?php _e( 'E-Mail Feld', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'email-field' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email-field' ) ); ?>" value="<?php echo esc_attr( $instance['email-field'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fname-field' ) ); ?>"><?php _e( 'Vornamen Feld', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'fname-field' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fname-field' ) ); ?>" value="<?php echo esc_attr( $instance['fname-field'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lname-field' ) ); ?>"><?php _e( 'Nachnamen Feld', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'lname-field' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lname-field' ) ); ?>" value="<?php echo esc_attr( $instance['lname-field'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hidden_fields' ) ); ?>"><?php _e( 'Versteckte Felder', 'evolution' ); ?>:</label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'hidden_fields' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hidden_fields' ) ); ?>" class="widefat"><?php echo esc_attr( $instance['hidden_fields'] ); ?></textarea>
			<br><small><?php _e( 'Nicht alle Anbieter nutzen versteckte Felder.', 'evolution'); ?></small>
		</p>

		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'open_same_window' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'open_same_window' ) ); ?>" value="1" <?php checked( $instance['open_same_window'] ); ?>/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'open_same_window' ) ); ?>"><?php _e( 'Bestätigungsseite im selben Fenster öffnen?', 'evolution' ); ?></label>
		</p>
		<hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;">
		<p>
			<?php $fname_text = empty( $instance['fname_text'] ) ? __( 'Vorname...', 'evolution' ) : $instance['fname_text']; ?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fname_text' ) ); ?>"><?php _e( 'Vorname', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'fname_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fname_text' ) ); ?>" value="<?php echo esc_attr( $fname_text ); ?>" class="widefat" />
		</p>
		<p>
			<?php $lname_text = empty( $instance['lname_text'] ) ? __( 'Nachname...', 'evolution' ) : $instance['lname_text']; ?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lname_text' ) ); ?>"><?php _e( 'Nachname', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'lname_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lname_text' ) ); ?>" value="<?php echo esc_attr( $lname_text ); ?>" class="widefat" />
		</p>
		<p>
			<?php $input_text = empty( $instance['input_text'] ) ? __( 'Deine E-Mail Adresse eingeben...', 'evolution' ) : $instance['input_text']; ?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'input_text' ) ); ?>"><?php _e( 'E-Mail eingeben', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'input_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'input_text' ) ); ?>" value="<?php echo esc_attr( $input_text ); ?>" class="widefat" />
		</p>

		<p>
			<?php $button_text = empty( $instance['button_text'] ) ? __( 'Abonnieren', 'evolution' ) : $instance['button_text']; ?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php _e( 'Button Text', 'evolution' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" value="<?php echo esc_attr( $button_text ); ?>" class="widefat" />
		</p>

	<?php
	}

}
