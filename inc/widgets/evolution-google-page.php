<?php

/**
 * Evolution Google+ Page Widget
 * 
 * @package Evolution Framework
 * @subpackage Widgets
 * @version 1.0.0
 * @author Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://hechtmediaarts.com/evolution
 */

// Registers our widget
 register_widget( 'evolution_widget_googleplus' );


class Evolution_Widget_Googleplus extends WP_Widget {

/**
 * Register widget with WordPress.
 */
	public function __construct() {
		parent::__construct(
	 		'evolution_widget_googleplus', // Base ID
			'Evolution Google+ Page', // Name
			array( 'description' => __( 'Dieses Widget ist richtig für Dich, wenn Du eine Google+ (Unternehmens-) Seite besitzt.', 'evolution' ), ) // Args
		);
}


 /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {  	
    	
    	//global $app_id;
        extract( $args );

		$title 								=	apply_filters('widget_title', $instance['title']);
		$googleplus_id			=	$instance['googleplus_id'];
		$googleplus_size		=	$instance['googleplus_size'];

		echo $before_widget='<div class="widget">';
		if ( $title )
			echo $before_title . $title . $after_title;


?>
<div class="g-plus" data-href="https://plus.google.com/<?php echo $googleplus_id; ?>/posts" data-size="<?php echo $googleplus_size; ?>"></div>
<?php
		echo $after_widget='</div>';
}	

/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] 							= strip_tags( $new_instance['title'] );
		$instance['googleplus_id'] 		= strip_tags( $new_instance['googleplus_id'] );
		$instance['googleplus_size'] 	= strip_tags($new_instance['googleplus_size'] );

		return $instance;

	}

	    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
    public function form($instance) {

    	 	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'googleplus_id' => '', 'googleplus_size' => '' ) );
        	
        	$title											= $instance[ 'title' ];
    		$googleplus_id						= $instance[ 'googleplus_id' ];
        	$googleplus_size					= $instance[ 'googleplus_size' ];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
			<label for="<?php echo $this->get_field_id('googleplus_id'); ?>"><?php _e('Füge Deine Google+ ID ein<br /> Beispiel: <code>103443335248647770600</code>'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('googleplus_id'); ?>" name="<?php echo $this->get_field_name('googleplus_id'); ?>" type="text" value="<?php echo $googleplus_id; ?>" />
        </p>
		
        <p>
			<label for="<?php echo $this->get_field_id('googleplus_size'); ?>"><?php _e('Wähle die Größe des Widgets:'); ?></label>
			<select name="<?php echo $this->get_field_name('googleplus_size'); ?>" id="<?php echo $this->get_field_id('googleplus_size'); ?>" class="widefat">
				<option value="badge"<?php selected( $instance['googleplus_size'], 'badge' ); ?>><?php _e('Groß'); ?></option>
				<option value="smallbadge"<?php selected( $instance['googleplus_size'], 'smallbadge' ); ?>><?php _e('Klein'); ?></option>
			</select>
        </p> 		
       <?php
    }

}
