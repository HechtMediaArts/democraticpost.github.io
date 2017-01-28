<?php
/**
 * Evolution Google Author Widget
 * 
 * @package Evolution Framework
 * @subpackage Widgets
 * @version 1.0.0
 * @author Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://hechtmediaarts.com/evolution
 */

/**
 * All In One Google Plus Widget Class
 */

class google_plus_widget extends WP_Widget {


/**
 * Register widget with WordPress.
 */
public function __construct() {
		parent::__construct(
	 		'google_plus_widget', // Base ID
			'Evolution Google+ Autor', // Name
			array( 'description' => __( 'Mit diesem Widget verlinkst Du Dein privates Google+ Autoren Profil.', 'text_domain' ), ) // Args
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
    function widget($args, $instance) {  	
    	
    	//global $app_id;
        extract( $args );
        
		$title 								=	apply_filters('widget_title', $instance['title']);
		$data_size					=	$instance['data_size'];
		$data_annotation		=	$instance['data_annotation'];
		$follow_me_title		=	$instance['follow_me_title'];
		$follow_me_width	=	$instance['follow_me_width'];
		$author_url					=	$instance['author_url'];
		$share_title				=	$instance['share_title'];
		$share_url					=	$instance['share_url'];
		$cover							= '<div class="google_widget">';
		$cover_after				= '</div>';
		
		echo $before_widget;
        if ( $title )
        echo $before_title . $title . $after_title . $cover;
        
        
        echo '<div class="g-plusone" data-size='.$data_size.' data-annotation='.$data_annotation.' data-width="300"></div>';
        
        echo '<h3 class="widget-first">'.$follow_me_title.'</h3><div class="g-plus" data-width='.$follow_me_width.' data-height="69" data-href='.$author_url.' data-rel="author"></div>';
        
        echo '<h3 class="widget-title">'.$share_title.'</h3><div class="g-plus" data-action="share" data-width="150" data-href='.$share_url.'></div>';

 		echo $cover_after . $after_widget;
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
    function update($new_instance, $old_instance) {
		
    	$instance	=	$old_instance;
		
    	foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;
		}
		$instance['title']					=	strip_tags($new_instance['title']);
		$instance['data_size'] 				=   strip_tags($new_instance['data_size']);
		$instance['data_annotation'] 		=   strip_tags($new_instance['data_annotation']);
		$instance['follow_me_title'] 		=   strip_tags($new_instance['follow_me_title']);
		$instance['follow_me_width'] 		=   strip_tags($new_instance['follow_me_width']);
		$instance['author_url'] 			=   strip_tags($new_instance['author_url']);
		$instance['share_title'] 			=   strip_tags($new_instance['share_title']);
		$instance['share_url'] 				=   strip_tags($new_instance['share_url']);

		return $instance;
    }


   /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
    function form($instance) {

    	/**
    	 * Set Default Value for widget form
    	 */
    	
    	$default_value	=	array("title"=> "Like this","data_size" => "medium" , "data_annotation" => "bubble","follow_me_title" => "Follow me" , "follow_me_width" => 170, "author_url" => "https://plus.google.com/117059705765759724705","share_title" => "Share This" , "share_url" => "http://hechtmediaarts.com");
    	$instance		=	wp_parse_args((array)$instance,$default_value);
        
    	$title					=	esc_attr($instance['title']);
        $data_size				=	esc_attr($instance['data_size']);
        $data_annotation		=	esc_attr($instance['data_annotation']);
        $follow_me_title		=	esc_attr($instance['follow_me_title']);
        $follow_me_width		=	esc_attr($instance['follow_me_width']);
        $author_url				=	esc_attr($instance['author_url']);
        $share_title			=	esc_attr($instance['share_title']);
        $share_url				=	esc_attr($instance['share_url']);
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		
        <p>
			<label for="<?php echo $this->get_field_id('data_size'); ?>"><?php _e( 'Select Button Size:' ); ?></label>
			<select name="<?php echo $this->get_field_name('data_size'); ?>" id="<?php echo $this->get_field_id('data_size'); ?>" class="widefat">
				<option value="small"<?php selected( $instance['data_size'], 'small' ); ?>><?php _e('Small'); ?></option>
				<option value="medium"<?php selected( $instance['data_size'], 'medium' ); ?>><?php _e('Medium'); ?></option>
				<option value="tall"<?php selected( $instance['data_size'], 'tall' ); ?>><?php _e( 'Tall' ); ?></option>
			</select>
		</p>
		
		 <p>
			<label for="<?php echo $this->get_field_id('data_annotation'); ?>"><?php _e( 'Select Display Type:' ); ?></label>
			<select name="<?php echo $this->get_field_name('data_annotation'); ?>" id="<?php echo $this->get_field_id('data_annotation'); ?>" class="widefat">
				<option value="inline"<?php selected( $instance['data_annotation'], 'inline' ); ?>><?php _e('Inline'); ?></option>
				<option value="bubble"<?php selected( $instance['data_annotation'], 'bubble' ); ?>><?php _e('Bubble'); ?></option>
				<option value="none"<?php selected( $instance['data_annotation'], 'none' ); ?>><?php _e( 'None' ); ?></option>
			</select>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('follow_me_title'); ?>"><?php _e('Follow Me Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('follow_me_title'); ?>" name="<?php echo $this->get_field_name('follow_me_title'); ?>" type="text" value="<?php echo $follow_me_title; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('follow_me_width'); ?>"><?php _e('Follow Me Width:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('follow_me_width'); ?>" name="<?php echo $this->get_field_name('follow_me_width'); ?>" type="text" value="<?php echo $follow_me_width; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('author_url'); ?>"><?php _e('Author Profile URL:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('author_url'); ?>" name="<?php echo $this->get_field_name('author_url'); ?>" type="text" value="<?php echo $author_url; ?>" />
        </p> 
        
        <p>
			<label for="<?php echo $this->get_field_id('share_title'); ?>"><?php _e('Share Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('share_title'); ?>" name="<?php echo $this->get_field_name('share_title'); ?>" type="text" value="<?php echo $share_title; ?>" />
        </p> 
        
        <p>
			<label for="<?php echo $this->get_field_id('share_url'); ?>"><?php _e('Share URL:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('share_url'); ?>" name="<?php echo $this->get_field_name('share_url'); ?>" type="text" value="<?php echo $share_url; ?>" />
        </p>
		
       <?php
    }	
}
add_action('widgets_init', create_function('', 'return register_widget("google_plus_widget");'));
