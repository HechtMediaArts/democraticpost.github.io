<?php

/**
 * 
 * Evolution Advertisement Widget - 300 x 250px
 * 
 * @since 2.0.0
 * 
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'evolution_load_ad300_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function evolution_load_ad300_widgets() {
	register_widget( 'Evolution_ads300Widget' );
}

class Evolution_ads300Widget extends WP_Widget {


	function __construct() {
		$widget_ops = array('classname' => 'evolution_ads300widget', 'description' => __( 'Fügt einen 300 x 250px Werbeplatz für eine Bannerwerbung Deiner Sidebar hinzu. Auf der Theme-Optionen Seite kannst Du den Banner hochladen.', 'evolution') );
		parent::__construct('revo_ads300', __('Evolution Ad 300', 'evolution'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title'], $instance, $this->id_base);

		echo $before_widget='<div class="widget-ad">';
		if ( $title )
			echo $before_title . $title . $after_title;


?>

<?php if (of_get_option('ad300imageresize')) { $image = of_get_option('ad300imageresize'); if($image) : echo '<a target="_blank" href="'; echo of_get_option('ad300url'); echo '"><img src="'. $image .'" /></a>' ."\n"; endif;} ?>

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

/**
 * 
 * Evolution Advertisement Widget 125 x 125px
 * 
 * @since 2.0.0
 * 
 */

function evolution_adsWidget()
{
$settings = get_option("widget_evolution_adswidget");
$number = $settings['number'];
if ($number == 0) $number = 1;
$img_url = array();
$dest_url = array();

$numbers = range(1,$number);
$counter = 0;

?>
<div class="widget-ad125">

<?php
	foreach ($numbers as $number) {
		$counter++;
		$img_url[$counter] = of_get_option('adimage'.$number);
		$dest_url[$counter] = of_get_option('adurl'.$number);

?>
        <a href="<?php echo "$dest_url[$counter]"; ?>"><img src="<?php echo "$img_url[$counter]"; ?>" alt="Ad" /></a>

<?php } ?>

</div>

<?php

}

function evolution_adsWidgetAdmin() {

	$settings = get_option("widget_evolution_adswidget");

	// check if anything's been sent
	if (isset($_POST['update_ads'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['ads_number']));

		update_option("widget_evolution_adswidget",$settings);
	}

	echo '<p>
			<label for="ads_number">Number of ads (1-4):
			<input id="ads_number" name="ads_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_ads" name="update_ads" value="1" />';

}
wp_register_sidebar_widget('evolution_adswidget', 'Evolution Ads 125x125', 'evolution_adsWidget', array( 'description' => __( 'Fügt bis zu 4 125 x 125px Werbeplätze Deiner Sidebar hinzu. Auf der Theme-Optionen Seite kannst Du die Banner hochladen.', 'evolution' ) ) );
wp_register_widget_control('evolution_adswidget', 'Evolution Ads 125x125', 'evolution_adsWidgetAdmin');