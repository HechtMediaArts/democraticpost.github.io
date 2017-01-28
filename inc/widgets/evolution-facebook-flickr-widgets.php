<?php
/*----------------------------------------------------------------------------*/
/*  Evolution Widgets File - Facebook & Flickr */
/*----------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------

=================================
    INDEX:
=================================

1. - Facebook Widget => revo_flb()
2. - Flickr Sidebar Widget => revothemes_flickrWidget()

 -----------------------------------------------------------------------------*/

// 1.0 ========== Facebook widget =========================================== //

/**
* Based on Facebook Like Box
* Author: Marcos Esperon
* Author URI: http://www.dolcebita.com/
* Version: 1.0
*/

$flb_options['widget_fields']['title'] = array('label'=>__('Title', 'revothemes'), 'type'=>'text', 'default'=>'', 'class'=>'widefat', 'size'=>'', 'help'=>'');
$flb_options['widget_fields']['profile_id'] = array('label'=>__('Facebook Page URL:', 'revothemes'), 'type'=>'text', 'default'=>'', 'class'=>'widefat', 'size'=>'', 'help'=>'');
$flb_options['widget_fields']['stream'] = array('type'=>'checkbox', 'label'=>__('Show Stream?', 'revothemes'), 'default'=>true, 'class'=>'', 'size'=>'', 'help'=>'');
$flb_options['widget_fields']['connections'] = array('type'=>'checkbox', 'label'=>__('Show Faces?', 'revothemes'), 'default'=>true, 'class'=>'', 'size'=>'', 'help'=>'');
$flb_options['widget_fields']['header'] = array('type'=>'checkbox', 'label'=>__('Show Header?', 'revothemes'), 'default'=>false, 'class'=>'', 'size'=>'', 'help'=>'');
$flb_options['widget_fields']['width'] = array('label'=>__('Width (max. 270px):', 'revothemes'), 'type'=>'text', 'default'=>'270', 'class'=>'', 'size'=>'3', 'help'=>'(Value in px)');
$flb_options['widget_fields']['height'] = array('label'=>__('Height:', 'revothemes'), 'type'=>'text', 'default'=>'590', 'class'=>'', 'size'=>'3', 'help'=>'(Value in px)');

function facebook_like_box($profile_id, $stream = 1, $connections = 1, $width = 270, $height = 590, $header = 0, $locale = '') {
	$output = '';
  if ($profile_id != '') {
    $stream = ($stream == 1) ? 'true' : 'false';
    $header = ($header == 1) ? 'true' : 'false';
    $connections = ($connections == 1) ? 'true' : 'false';

        $output = '<iframe src="http://www.facebook.com/plugins/likebox.php?href='.$profile_id.'&amp;width='.$width.'&amp;colorscheme=light&amp;show_faces='.$connections.'&amp;border_color&amp;stream='.$stream.'&amp;header='.$header.'&amp;height='.$height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
  }
  echo $output;
}

function widget_revo_flb_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	$check_options = get_option('widget_revo__flb');

	function widget_revo__flb($args) {

		global $flb_options;

    // $args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys. Default tags: li and h2.

		extract($args);

		$options = get_option('widget_revo__flb');

		// fill options with default values if value is not set
		$item = $options;
		foreach($flb_options['widget_fields'] as $key => $field) {
			if (! isset($item[$key])) {
				$item[$key] = $field['default'];
			}
		}

    $title = $item['title'];
    $profile_id = $item['profile_id'];
    $stream = ($item['stream']) ? 1 : 0;
    $connections = ($item['connections']) ? 1 : 0;
    $width = $item['width'];
    $height = $item['height'];
    $header = ($item['header']) ? 1 : 0;

		// These lines generate our output.
    echo $before_widget . $before_title . $title . $after_title;
    facebook_like_box($profile_id, $stream, $connections, $width, $height, $header);
    echo $after_widget;

	}

	// This is the function that outputs the form to let the users edit
	// the widget's title. It's an optional feature that users cry for.
	function widget_revo__flb_control() {

		global $flb_options;

		// Get our options and see if we're handling a form submission.
		$options = get_option('widget_revo__flb');
		if ( isset($_POST['flb-submit']) ) {

			foreach($flb_options['widget_fields'] as $key => $field) {
				$options[$key] = $field['default'];
				$field_name = sprintf('%s', $key);
				if ($field['type'] == 'text') {
					$options[$key] = strip_tags(stripslashes($_POST[$field_name]));
				} elseif ($field['type'] == 'checkbox') {
					$options[$key] = isset($_POST[$field_name]);
				}
			}

			update_option('widget_revo__flb', $options);
		}

		foreach($flb_options['widget_fields'] as $key => $field) {
			$field_name = sprintf('%s', $key);
			$field_checked = '';
			if ($field['type'] == 'text') {
				$field_value = (isset($options[$key])) ? htmlspecialchars($options[$key], ENT_QUOTES) : htmlspecialchars($field['default'], ENT_QUOTES);
			} elseif ($field['type'] == 'checkbox') {
				$field_value = (isset($options[$key])) ? $options[$key] :$field['default'] ;
				if ($field_value == 1) {
					$field_checked = 'checked="checked"';
				}
			}
      $jump = ($field['type'] != 'checkbox') ? '<br />' : '&nbsp;';
      $field_class = $field['class'];
      $field_size = ($field['class'] != '') ? '' : 'size="'.$field['size'].'"';
      $field_help = ($field['help'] == '') ? '' : '<small>'.$field['help'].'</small>';
			printf('<p class="flb_field"><label for="%s">%s</label>%s<input id="%s" name="%s" type="%s" value="%s" class="%s" %s %s /> %s</p>',
		  $field_name, __($field['label']), $jump, $field_name, $field_name, $field['type'], $field_value, $field_class, $field_size, $field_checked, $field_help);
		}

		echo '<input type="hidden" id="flb-submit" name="flb-submit" value="1" />';
	}

	function widget_revo__flb_register() {
    $title = 'Revo-Facebook Like Box';
   // $prefix = 'name-multi';
    // Register widget for use
    wp_register_sidebar_widget( 'widget_revo__flb', 'Evolution Facebook Like Box','widget_revo__flb', array( 'description' => __( 'Facebook (Unternehmens-) Seitenbesitzer können hiermit das Facebook Like Box Social Plugin der Sidebar hinzufügen. Nicht für private Profile geeignet.', 'evolution' ) ));
    // Register settings for use, 300x100 pixel form
    wp_register_widget_control('widget_revo__flb', 'Evolution Facebook Like Box', 'widget_revo__flb_control');
    wp_register_sidebar_widget( 'widget_revo__flb 2', 'Evolution Facebook Like Box','widget_revo__flb', array( 'description' => __( 'Facebook (Unternehmens-) Seitenbesitzer können hiermit das Facebook Like Box Social Plugin der Sidebar hinzufügen. Nicht für private Profile geeignet.', 'evolution' ) ));
    // Register settings for use, 300x100 pixel form
    wp_register_widget_control('widget_revo__flb 2', 'Evolution Facebook Like Box', 'widget_revo__flb_control');
	}

	widget_revo__flb_register();
}

// Run our code later in case this loads prior to any required plugins.
add_action('widgets_init', 'widget_revo_flb_init');


// 2.0 ========== Flickr widget ============================================= //

function revothemes_flickrWidget()
{
	$settings = get_option("widget_revothemes_flickrwidget");
    $flickrnumber = $settings['flickrnumber'];
    $quantity =  $settings['quantity'];

?>

<div class="widget">
<h3 class="flickr"><?php _e('Photos on <span>flick</span><span class="r">r</span>') ?></h3>
<div id="flickr_badge_uber_wrapper">
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $quantity; ?>&amp;display=random&amp;size=s&amp;layout=v&amp;source=user&amp;user=<?php echo $flickrnumber; ?>"></script>
</div>
</div>

<?php
}

function revothemes_flickrWidgetAdmin() {

	$settings = get_option("widget_revothemes_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
	    $settings['flickrnumber'] = strip_tags(stripslashes($_POST['flickrnumber']));
		$settings['quantity'] = strip_tags(stripslashes($_POST['quantity']));

		update_option("widget_revothemes_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickrnumber">Your Flickr Account Number:
			<input id="flickrnumber" name="flickrnumber" type="text" class="widefat" value="'.$settings['flickrnumber'].'" /></label></p>';
    echo '<p>
			<label for="quantity">Number of Photos (1 - 10):
			<input id="quantity" name="quantity" type="text" class="widefat" value="'.$settings['quantity'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

wp_register_sidebar_widget('widget_revothemes_flickrwidget', 'Evolution Flickr', 'revothemes_flickrWidget', array( 'description' => __( 'Fügt 1 bis 10 zufällige Flickr Fotos aus Deinem Flickr-Account der Sidebar oder dem Footer hinzu.', 'evolution' ) ) );
wp_register_widget_control('widget_revothemes_flickrwidget', 'Evolution Flickr', 'revothemes_flickrWidgetAdmin');

?>