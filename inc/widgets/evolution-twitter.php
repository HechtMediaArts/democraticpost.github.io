<?php

/**
 * Evolution Twitter Timeline Widget
 * 
 * @package Evolution Framework
 * @subpackage Widgets
 * @version 1.0.1
 * @author Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://hechtmediaarts.com/evolution
 */

// Registers our widget
 register_widget( 'twitter_widget' );


class Twitter_Widget extends WP_Widget {


/**
 * Register widget with WordPress.
 */
    public function __construct() {
		parent::__construct(
	 		'twitter_widget', // Base ID
			'Evolution Twitter Timeline', // Name
			array( 'description' => __( 'Mit diesem Widget erstellst Du eine coole Twitter-Timeline von Deinem Twitter-Account.', 'evolution' ), ) // Args
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
        
		$title 						=	apply_filters('widget_title', $instance['title']);
		$width					=	$instance['width'];
		$height					=	$instance['height'];
		$twitter_name	=	$instance['twitter_name'];
		$widget_id			=	$instance['widget_id'];
		$link_color			=	$instance['link_color'];
		$theme_color	= $instance['theme_color'];
		$bordercolor		= $instance['border_color'];
		
		echo $before_widget;
        if ( $title )
       echo $before_title . $title . $after_title;

 		echo '<a class="twitter-timeline" data-widget-id="'.$widget_id.'" href="https://twitter.com/" '.$twitter_name.' data-border-color="'.$bordercolor.'" width="'.$width.'" height="'.$height.'" data-theme="'.$theme_color.'" data-link-color="'.$link_color.'" >Tweets von @"'.$twitter_name.'"</a>' ;
      
 		echo $after_widget;
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
		$instance['width'] 						= strip_tags( $new_instance['width'] );
		$instance['height'] 						=   strip_tags($new_instance['height'] );
		$instance['twitter_name']		= strip_tags($new_instance['twitter_name'] );
		$instance['widget_id']				= strip_tags($new_instance['widget_id'] );
		$instance['link_color']				= strip_tags($new_instance['link_color'] );
		$instance['theme_color']			= strip_tags($new_instance['theme_color'] );
		$instance['border_color']			= strip_tags($new_instance['border_color'] );

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

    	/**
    	 * Set Default Value for widget form
    	 */   	
    	$default_value	=	array("title"=> "Follow me on Twitter", "width" => "340", "height" => "400", "twitter_name" => "Hecht_MediaArts", "widget_id" => "321899849106735104", "link_color" => "#f96e5b", "border_color" => "#e8e8e8", "theme_color" => "light" );
    	$instance		=	wp_parse_args((array)$instance,$default_value);
        
    		$title						=	esc_attr($instance['title']);
        	$width					=	esc_attr($instance['width']);
        	$height					=	esc_attr($instance['height']);
        	$twitter_name	=	esc_attr($instance['twitter_name']);
        	$widget_id			=	esc_attr($instance['widget_id']);
        	$link_color			=	esc_attr($instance['link_color']);
        	$theme_color	=	esc_attr($instance['theme_color']);
        	$border_color	=	esc_attr($instance['border_color']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		
        <p>
			<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e( 'Wähle die Breite der Timeline:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
		
		 <p>
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e( 'wähle die Höhe der Timeline:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('twitter_name'); ?>"><?php _e('Dein Twitter Name:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo $twitter_name; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('widget_id'); ?>"><?php _e('Deine Twitter Widget ID:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('widget_id'); ?>" name="<?php echo $this->get_field_name('widget_id'); ?>" type="text" value="<?php echo $widget_id; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('link_color'); ?>"><?php _e('Linkfarbe:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link_color'); ?>" name="<?php echo $this->get_field_name('link_color'); ?>" type="text" value="<?php echo $link_color; ?>" />
        </p> 

        <p>
			<label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Rahmenfarbe:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php echo $border_color; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('theme_color'); ?>"><?php _e('Wähle eine Themefarbe (Hell oder Dunkel):'); ?></label>
			<select name="<?php echo $this->get_field_name('theme_color'); ?>" id="<?php echo $this->get_field_id('theme_color'); ?>" class="widefat">
				<option value="light"<?php selected( $instance['theme_color'], 'light' ); ?>><?php _e('Hell'); ?></option>
				<option value="dark"<?php selected( $instance['theme_color'], 'dark' ); ?>><?php _e('Dunkel'); ?></option>
			</select>
        </p> 
		
       <?php
    }

}