<?php

/**
 * 
 * Evolution Statistics Widget
 * 
 * @since 2.0.0
 * 
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'evolution_load_statistics_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function evolution_load_statistics_widgets() {
	register_widget( 'Evolution_StatisticsWidget' );
}

class Evolution_StatisticsWidget extends WP_Widget {


	function __construct() {
		$widget_ops = array('classname' => 'evolution_statisticswidget', 'description' => __( 'Fügt statistische Information wie Kommentaranzahl und Blogpost-Anzahl der Sidebar hinzu.', 'revothemes') );
		parent::__construct('revo_statistics', __('Evolution Statistics', 'revothemes'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;


?>

				<ul>
                <li><?php _e('Artikel: '); ?><?php $nr_art = wp_count_posts('post'); $nr_art = $nr_art->publish; echo number_format($nr_art, 0, '', '.'); ?></li>
                <li><?php _e('Seiten: '); ?><?php $nr_page = wp_count_posts('page'); $nr_page = $nr_page->publish; echo number_format($nr_page, 0, '', '.'); ?></li>
                <li><?php _e('Kategorien: '); ?><?php $nr_kat = wp_count_terms('category'); echo number_format($nr_kat); ?></li>
                <li><?php _e('Tags: '); ?><?php $nr_tag = wp_count_terms('post_tag'); echo number_format($nr_tag); ?></li>
                <li><?php _e('Kommentare: '); ?><?php $nr_komm  = get_comment_count(); $nr_komm  = $nr_komm['approved']; echo number_format($nr_komm, 0, '', '.'); ?></li>
             </ul>

<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}