<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'Evolution_';

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'layout',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Evolution Layout Optionen',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post', 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'     => 'Layout',
			'id'       => "{$prefix}fullpage",
			'type'     => 'checkbox_list',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'full-width-content' => 'Volle Artikelbreite',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),

		array(
			// Field name - Will be used as label
			'name'  => 'Zusätzliche &lt;body&gt; Klasse',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}body",
			'type'  => 'text',
			// Default value (optional)
			'std'   => '',
		),
		array(
			// Field name - Will be used as label
			'name'  => 'Zusätzliche Post Klasse',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}post",
			'type'  => 'text',
			// Default value (optional)
			'std'   => '',
		),

	),
);


// 2st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'seo',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Evolution SEO Optionen',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post', 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'id'       => "{$prefix}index",
			'type'     => 'checkbox_list',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'noindex' => 'Diesen Post auf "Noindex" setzen',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),

		array(
			'id'       => "{$prefix}follow",
			'type'     => 'checkbox_list',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'nofollow' => 'Diesen Post auf "Nofollow" setzen',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),

	),
);


// 3st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'custom-scripts',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Evolution Custom Post Scripts',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post', 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'desc' => 'Geeignet für individuelle Tracking-, Conversion- oder andere seitenspezifische Scripte. Muss Script Tags enthalten.',
			'id'   => "{$prefix}scripts",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		),

	),
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function Evolution_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'Evolution_register_meta_boxes' );