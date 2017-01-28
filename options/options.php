<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Theme Options File.
 *
 * @category    		Evolution Framework
 * @package     	Admin
 * @subpackage 	Theme Options
 * @author        	Hecht MediaArts
 * @license        	http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              	http://www.hechtmediaarts.com/themes/evolution
 */


/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	$jesno = array(
		'ja' => 'Ja',
		'nein' => 'Nein'
	);

	$javascript = array(
		'header' => 'Header',
		'footer' => 'Footer'
	); 

	$badges  = array(
		'badge' => 'Gross',
		'smallbadge' => 'Klein'
	);	
	$pagination = array('numbers' => 'Nummern',  'Next/Previous' => 'Ältere Beiträge / Neuere Beiträge');

	$shortcodes = array('aktiviert' =>'Aktiviert', 'deaktiviert' => 'Deaktiviert' );

	$content_display = array( "excerpt" => "Auszug", "content" => "Inhalt" );	

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

$imagepath =  get_template_directory_uri() . '/inc/options/images/';

	$select_options = array(
			'full-width-content' => $imagepath . '1col.gif',
			'sidebar-content' => $imagepath . '2cl.gif',
			'content-sidebar' => $imagepath . '2cr.gif',
			'sidebar-content-sidebar' => $imagepath . '3col.gif',
			'sidebar-sidebar-content' => $imagepath . '3coll.gif',
			'content-sidebar-sidebar' => $imagepath . '3colr.gif');


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/inc/options/images/';

	global $evolution_framework_version, $releasedate;

	$evolution_framework_version = get_option( 'evolution_framework_version' );

	$options = array();

// 1. ========== Basis Einstellungen ==============================	

	$options[] = array(
		'name' => __('Basis Optionen', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array( "name" => "Framework Informationen",
					"desc" => "<strong>Version:</strong> $evolution_framework_version | <strong>Release Datum:</strong> $releasedate | <a href='http://forum.hechtmediaarts.com/' target='_blank'>Support Forum</a>",
					"type" => "info");

$options[] = array( "name" => "Custom Favicon",
					"desc" => __("Wenn Du ein eigenes Favicon verwenden möchtest, dann kannst Du es hier hochladen.", 'revothemes'),
					"id" => "custom_favicon",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "RSS Feed URL",
					"desc" => __("Wenn Du Feedburner zum Nachverfolgen Deiner RSS-Leser nutzen möchtest, dann füge hier die Feedburner-URL ein. Beispiel: <code>http://feeds.feedburner.com/<br />hechtmediaarts</code>. Wenn Du den Standard WordPress Feed nutzen möchtest, lasse das Feld einfach frei.", 'revothemes'),
					"id" => "rss_feed",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Tracking Code - Google Analytics o.ä.",
					"desc" => __("Kopiere Deinen Google Analytics (oder Code eines anderen Anbieters) hier hinein. Es wird automatisch Dem Footer-Template Deines Themes hinzu gefügt.", 'revothemes'),
					"id" => "google_analytics",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Zusätzlicher Footer Text.",
					"desc" => __("Zusätzlichen Text im Footer eingeben? Wird hinter dem Link zu WordPress angezeigt.", 'revothemes'),
					"id" => "footer_text",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "Anzeigeoptionen Blogübersicht",
					"desc" => "Wähle aus, ob auf der Blogübersichtsseite (<code>index.php</code>) der volle Inhalt,  oder nur ein Auszug gezeigt werden soll.",
					"type" => "info");

$options[] = array( "name" => __("Zeige Content oder Excerpt", 'revothemes'),
						"desc" => __("Wähle, ob Deine Blogübersicht den automatischen Auszug (excerpt) oder den vollen Artikel-Inhalt (Content) anzeigen soll. Wir empfehlen den vollen Inhalt anzuzeigen und mit einem <a target='_blank' href='http://de.support.wordpress.com/splitting-content/more-tag/'>More Tag</a> den Auszug manuell zu definieren.", 'revothemes'),
						"id" => "content_excerpt",
						"std" => "content",
						"type" => "select",
						"options" => $content_display);

$options[] = array( "name" => "Performance Einstellungen",
					"desc" => "<strong>Shortcode-Generator:</strong> Standardmäßig ist für Deine Beiträge und Seiten ein visueller Shortcode-Generator aktiviert, der Dir die Möglichkeit gibt, Deinen Artikeln per Shortcodes Buttons, Farbige Inhaltsboxen, Spalten für mehrspaltigen Inhalt, Tabs und Toggles hinzuzufügen. Allerdings beeinträtigt dieser Komfort die Ladegeschwindigkeit Deiner Webseite durch das Hinzufügen einiger JavaScript-Dateien. <strong>Daher kannst Du ihn hier komplett abschalten</strong>. <br /><br /><strong>jQuery im Footer oder Header laden:</strong> Hier kann eingestellt werden, ob jQuery im Header oder im Footer geladen wird. Aus Gründen der Ladegeschwindigkeit der Webseite wird jQuery standardmäßig im Footer geladen.",
					"type" => "info");

$options[] = array( "name" => __("Shortcode-Generator aktivieren / deaktivieren", 'revothemes'),
						"desc" => __("<code>Deaktiviert</code> schaltet den visuellen Shortcode-Generator komplett ab. Die Evolution Shortcodes können dann nicht mehr verwendet werden. <em>Verwendete Tabs und Toggles werden angezeigt, aber funktionieren nicht mehr.</em>", 'revothemes'),
						"id" => "shortcode_deactivation",
						"std" => "aktiviert",
						"type" => "select",
						"options" => $shortcodes);

$options[] = array( "name" => __("jQuery im Footer oder Header laden", 'revothemes'),
						"desc" => __("jQuery wird von Evolution zusammen mit anderen Scripten im Footer geladen. Wenn es allerdings für Dich nötig ist, das jQuery im Header geladen wird, so kannst Du es hier einstellen.", 'revothemes'),
						"id" => "jquery_footer",
						"std" => "aktiviert",
						"type" => "select",
						"options" => $javascript);

$options[] = array( "name" => "Widgetbereich im Footer nutzen?",
					"desc" => "Wenn Du die drei Widgetbereiche im Seitenfooter nutzen möchtest, dann aktiviere sie bitte hier..",
					"type" => "info");

$options[] = array( "name" => __("Footer Widgetbereich aktivieren", 'revothemes'),
						"desc" => __("Willst Du auch Widgets im Footer (Seitenfuß) nutzen können?", 'revothemes'),
						"id" => "footer_widgets",
						"std" => "nein",
						"type" => "select",
						"options" => $jesno );

// 2. ========== Erweiterte Einstellungen ==============================

	$options[] = array(
		'name' => __('Erweiterte Optionen', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array( "name" => "Teilen (Share This) Buttons - Beiträge",
					"desc" => "Hier kannst Du einstellen, ob Du Buttons zum Teilen der Artikel über Twitter, Facebook und Google+ über / und oder unter dem Artikel-Inhalt anzeigen möchtest.",
					"type" => "info");

$options[] = array( "name" => __("Teilen Buttons - über dem Inhalt.", 'revothemes'),
                    "desc" => __("Willst Du die Teilen-Buttons (share this) über dem Inhalt anzeigen?", 'revothemes'),
                    "id" => "share_above",
                    "std" => "nein",
                    "type" => "select",
                    'options' => $jesno);

$options[] = array( "name" => __("Teilen Buttons - unter dem Inhalt", 'revothemes'),
                    "desc" => __("Willst Du die Teilen-Buttons (share this) unter dem Inhalt anzeigen?", 'revothemes'),
                    "id" => "share_below",
                    "std" => "nein",
                    "type" => "select",
                    'options' => $jesno);

$options[] = array( "name" => "Pagination &amp; Breadcrumbs Navigation",
					"desc" => "Die Einstellungen für die Brotkrumen-Navigation und Einstellungen für die Navigation unter der Bloghauptseite <code>index.php</code>",
					"type" => "info");

$options[] = array( "name" => "Pagination Style",
                    "id" => "pagination",
                    "desc" => __("Welche Art der Navigation möchtest Du auf der Blogübersicht anzeigen?", 'revothemes'),
                    "options" => $pagination,
                    "std" => "Nummern",
                    "type" => "select");

$options[] = array( "name" => __("Breadcrumbs", 'revothemes'),
                    "id" => "breadcrumbs_display",
                    "desc" => 'Möchtest Du die dynamische Brotkrumennavigation auf Beiträgen und Seiten anzeigen lassen?',
                    "options" => $jesno,
                    "std" => "ja",
                    "type" => "select");

$options[] = array( "name" => "Google+ Widget für Unternehmensseiten und private Profile",
                    "desc" => __("Wenn Du eines dieser Widgets nutzen möchtest, gehe zur Theme Optionen Seite und ziehe das gewünschte Widget in die Sidebar. Das Evolution Google+ Autor Widget ist für Dein privates Autorenprofil und das Evolution Google+ Page ist für Unternehmensseiten, wie zum Beispiel die Seite von drWeb.de: <code>https://plus.google.com/103443335248647770600/posts</code>.</p> <p>Die folgenden Einstellungen dienen zum Zufügen eines Autorenlinks in das Header-Template Deines Themes, damit Google Deine Artikel zum Google+ Profil zuordnen kann.", 'revothemes'),
					"type" => "info");

$options[] = array( "name" => "Google+ Autor URL für das Evolution Google+ Autor Widget",
					"desc" => __("Füge hier bitte die komplette URL Deines privaten Google+ Autorenprofils ein. Beispiel: <code>https://plus.google.com/117059705765759724705</code>", 'revothemes'),
					"id" => "googleplus_author",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Google+ Page ID für das Evolution Google+ Page Widget",
					"desc" => __("Füge hier Deine Google+ Page ID ein. Achtung, bitte nur den markierten Teil der URL einfügen: https://plus.google.com/<code>103443335248647770600</code>/posts", 'revothemes'),
					"id" => "googleplus_id",
					"std" => "",
					"type" => "text");

/**
 * 
 * Vorbereitung für ein späteres Affilliate-Programm
 * 

$options[] = array(	"name" => __("Affiliate (Partnerprogramm) Box unter den Artikeln verwenden?", 'revothemes'),
                    "desc" => __("Du kannst Dir ganz leicht Geld dazu verdienen, wenn Du für das Evolution Framework auf Deiner Webseite Werbung machst. Klicke die Box an und Du kannst Deinen Affilliate Link eingeben.</p> <p>Am Ende eines jeden Artikels erscheint dann eine Box mit Deinem Affilliate-Link, und jedesmal, wenn jemand über diesen Link das Evolution Framework kauft, verdienst Du Geld.", 'revothemes'),
					"type" => "info");

$options[] = array(
		'name' => __('Affiliate Box verwenden?', 'options_framework_theme'),
		'desc' => __('Setze einen Haken in die Box und Du kannst Deinen Affiliate-Link eingeben.', 'options_framework_theme'),
		'id' => 'example_showhidden2',
		'type' => 'checkbox');

$options[] = array(
		'name' => __('Affiliate-Link eingeben', 'options_framework_theme'),
		'desc' => __('Deinen persönlichen Affiliate-Link erhälst Du, indem Du Dich bei dem <a href="http://partner.hechtmediaarts.com">Evolution Partnerprogramm</a> anmeldest.', 'options_framework_theme'),
		'id' => 'example_affilliate_hidden',
		'std' => ' ',
		'class' => 'hidden',
		'type' => 'text');

*/		

$options[] = array(	"name" => __("Related Posts", 'revothemes'),
                "desc" => __("Am Ende der Beiträge kannst Du verwandte Beiträge (Related Posts) auf Basis von Kategorien anzeigen lassen.", 'revothemes'),
					"type" => "info");

$options[] = array( "name" => __("Verwandte Beiträge anzeigen", 'revothemes'),
                    "id" => "related_display",
                    "desc" => 'Möchtest Du am Ende der Artikel verwandte Beiträge anzeigen lassen?',
                    "options" => $jesno,
                    "std" => "ja",
                    "type" => "select");

// 3. ========== Advertisement ===============================================

    $options[] = array( "name" => __("Werbebanner", 'revothemes'),
                    "class" => "ads",
					"type" => "heading");

    $options[] = array( "name" => "Werbebanner-Plätze",
					"desc" => "Wenn Du Deine Webseite monetarisieren möchtest, dann bietet Dir das Evolution Framework eine Menge dafür vorbereiteter Plätze an.",
					"type" => "info");

    $options[] = array( "name" => "Google Adsense Code - Werbung im Inhalt der Artikel",
					"desc" =>  __("Füge hier den Google Adsense Code (oder den Code eines anderen Anbieters) ein. Angezeigt wird die Werbeeinblendung dann in den einzelnen Beiträgen unter der Überschrift (single.php).", 'revothemes'),
					"id" => "adsense",
					"std" => "",
					"type" => "textarea");

    $options[] = array(	"name" => __("Header Banner (468x60)", 'revothemes'),
                    "desc" => __("Hier kannst Du einen Werbebanner im Format 468x60 hochladen. Er wird dann im Header (Kopf Deiner Webseite) angezeigt werden. Wenn Du diesen Werbeplatz nutzt, kannst Du den Widgetbereich im Header <strong>nicht</strong> nutzen.", 'revothemes'),
					"type" => "info");

    $options[] = array( "name" => "Header Banner (468x60) Upload",
					"desc" => __("Lade hiermit einen Banner für den 468x60 Werbeplatz im Header hoch.", 'revothemes'),
					"id" => "ad468image",
					"std" => "",
					"type" => "upload");

    $options[] = array( "name" => __("Ziel URL", 'revothemes'),
					"desc" => __("Füge die URL ein, mit der der Banner verlinkt werden soll.", 'revothemes'),
					"id" => "ad468url",
					"std" => "http://hechtmediaarts.com",
					"type" => "text");

    $options[] = array(	"name" => __("Sidebar Banner (300x250)", 'revothemes'),
                    "desc" => __("Hier kannst Du einen Werbebanner im Format 300x250 hochladen. Er wird dann in der Sidebar angezeigt, wenn Du das <strong>Evolution Werbebanner 300x250</strong> Widget nutzt. Gehe zu Design / Widgets und ziehe es in die Sidebar hinein.", 'revothemes'),
					"type" => "info");

    $options[] = array( "name" => "Grafik Banner Upload - 300x250",
					"desc" => __("Lade hiermit einen Banner für den 300x250 Werbeplatz in der Sidebar hoch.", 'revothemes'),
					"id" => "ad300imageresize",
					"std" => "",
					"type" => "upload");

    $options[] = array( "name" => __("Ziel URL", 'revothemes'),
					"desc" => __("Füge die URL ein, mit der der Banner verlinkt werden soll.", 'revothemes'),
					"id" => "ad300url",
					"std" => "http://hechtmediaarts.com",
					"type" => "text");

    $options[] = array(	"name" => __("Sidebar Werbeplätze (125x125)", 'revothemes'),
                    "desc" => __("Zeige bis zu 4 125x125 Werbebanner an. Um diese Werbeplätze zu verwenden, musst Du das <strong>Evolution Werbebanner 125x125</strong> Widget nutzen. Gehe zu Design / Widgets und ziehe es in die Sidebar hinein.", 'revothemes'),
					"type" => "info");

    $options[] = array( "name" => "125x125 Werbebanner #1",
					"desc" => __("Lade hiermit einen Banner für den 125x125 Werbeplatz in der Sidebar hoch.", 'revothemes'),
					"id" => "adimage1",
					"std" => "",
					"type" => "upload");

    $options[] = array(	"name" => __("125x125 Werbebanner #2 - Ziel URL", 'revothemes'),
					"desc" => __("Enter the URL where this banner ad points to.", 'revothemes'),
					"id" => "adurl1",
					"std" => "http://hechtmediaarts.com",
					"type" => "text");

    $options[] = array( "name" => "125x125 Werbebanner #2",
					"desc" => __("Lade hiermit einen Banner für den 125x125 Werbeplatz in der Sidebar hoch.", 'revothemes'),
					"id" => "adimage2",
					"std" => "",
					"type" => "upload");

    $options[] = array(	"name" => __("125x125 Werbebanner #2 - Ziel URL", 'revothemes'),
					"desc" => __("Enter the URL where this banner ad points to.", 'revothemes'),
					"id" => "adurl2",
					"std" => "http://hechtmediaarts.com",
					"type" => "text");

    $options[] = array( "name" => "125x125 Werbebanner #3",
					"desc" => __("Lade hiermit einen Banner für den 125x125 Werbeplatz in der Sidebar hoch.", 'revothemes'),
					"id" => "adimage3",
					"std" => "",
					"type" => "upload");

    $options[] = array(	"name" => __("125x125 Werbebanner #3 - Ziel URL", 'revothemes'),
					"desc" => __("Enter the URL where this banner ad points to.", 'revothemes'),
					"id" => "adurl3",
					"std" => "http://hechtmediaarts.com",
					"type" => "text");

    $options[] = array( "name" => "125x125 Werbebanner #4",
					"desc" => __("Lade hiermit einen Banner für den 125x125 Werbeplatz in der Sidebar hoch.", 'revothemes'),
					"id" => "adimage4",
					"std" => "",
					"type" => "upload");

    $options[] = array(	"name" => __("125x125 Werbebanner #4 - Ziel URL", 'revothemes'),
					"desc" => __("Enter the URL where this banner ad points to.", 'revothemes'),
					"id" => "adurl4",
					"std" => "http://hechtmediaarts.com",
					"type" => "text");

// 4.========== Layout Options ================================================

	$options[] = array(
		'name' => __('Layout', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array( "name" => "Custom Logo",
					"desc" => __("Möchtest Du anstatt der Überschriften eine Logografik verwenden? Dann lade es hier hoch. Maximale Größe: <code>500x100px</code>", 'revothemes'),
					"id" => "custom_logo",
					"std" => "",
					"type" => "upload");

	$options[] = array(
		'name' => __('Vollflächiges Hintergrundbild verwenden', 'options_framework_theme'),
		'desc' => __('Möchtest Du ein vollflächiges Hintergrundbild verwenden? Dann setze einen Haken in die Box und Du kannst ein Hintergrundbild hochladen.', 'options_framework_theme'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');

		$options[] = array(
		'name' => __('Vollflächiges Hintergrundbild hochladen', 'options_framework_theme'),
		'desc' => __('Hier kannst Du ein großflächiges Bild hochladen, um es als vollflächiges Hintergrundbild zu verwenden.', 'options_framework_theme'),
		'id' => 'example_upload_hidden',
		'std' => ' ',
		'class' => 'hidden',
		'type' => 'upload');

    	$options[] = array(
		'name' => "Standard Layout Selektor",
		'id' => "example_images",
		"desc" => __("Wähle die grundsätzliche Layoutstruktur Deiner Webseite aus.", 'revothemes'),
		'std' => "content-sidebar",
		'type' => "images",
		'options' => $select_options,
	);

		$options[] = array( "name" =>  "Hintergrund (Background)",
			"desc" =>  __("Ändere das CSS für den Hintergrund oder wähle eine Hintergrund-Grafik aus. Nach dem Hochladen der Grafik kannst Du das dafür nötige CSS beeinflussen. - <strong>Achtung: Bei der Verwendung eines vollflächigen Hintergrundbildes bitte keine <em>Hintergrundfarbe</em> verwenden!</strong>", 'revothemes'),
			'id' => 'background',
			'std' => $background_defaults,
			'type' => 'background' );

	$options[] = array( "name" =>  __("Größe der Beitragsbilder", 'revothemes'),
						"desc" => 'Dieses beeinflusst die Größe der Beitragsbilder (post thumbnails). Die Bilder werden mittels timthumb.php auf die richtige Größe zugeschnitten, die Größe kann daher jederzeit geändert werden.',
						"type" => "info");

    $options[] = array( "name" => __("Bildbreite", 'revothemes'),
						"desc" => __("Lege die Breite der Beitragsbilder (post thumbnails) fest. <code>Maximale Breite 750px</code>", 'revothemes'),
						"id" => "img_width",
						"std" => "750",
						"class" => "mini",
						"type" => "text");

    $options[] = array( "name" => __("Bildhöhe", 'revothemes'),
						"desc" => __("Lege die Höhe der Beitragsbilder fest.", 'revothemes'),
						"id" => "img_height",
						"std" => "180",
						"class" => "mini",
						"type" => "text");

    $options[] = array( "name" =>  __("Beitragsbilder Optionen (Post Thumbnails)", 'revothemes'),
						"desc" => 'Hier kann gewählt werden, ob die Beitragsbilder auch im Inhalt der einzelnen Beiträge angezeigt werden sollen. (Standardmäßig werden die Beitragsbilder nur auf der Beitragsübersicht angezeigt (index.php)',
						"type" => "info");

    $options[] = array( "name" => __("Beitragsbilder im Inhalt anzeigen?", 'revothemes'),
						"desc" => __("Sollen die Beitragsbilder auch im Inhalt der einzelnen Artikel (single.php) angezeigt werden?.", 'revothemes'),
						"id" => "article_thumbs",
						"std" => "nein",
						"type" => "select",
						"options" => $jesno );


// 5.========== Hook Manager ======================================================

$options[] = array( "name" => __("Hook Manager", 'revothemes'),
					"type" => "heading");

$options[] = array( "name" =>  __("Evolution Framework Hooks", 'revothemes'),
						"desc" => ' WordPress basiert auf dem sogenannten Hook-System. Das Evolution Framework stellt Dir eine Reihe von Hooks zur Verfügung, um eigene Funktionen oder Texte/Banner an bestimmten Stellen auszuführen oder anzuzeigen. Dieses kann evtl. Anpassungen am CSS nach sich ziehen.',
						"type" => "info");

$options[] = array( "name" => "evolution_before_wrap",
					"desc" => __("Wird vor dem öffnenden div <code>#wrap</code> Tag ausgeführt", 'revothemes'),
					"id" => "before_wrap",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_header",
					"desc" => __("Wird vor dem öffnenden <code>&lt;header&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "before_header",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_after_header",
					"desc" => __("Wird nach dem schließenden <code>&lt;/header&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "after_header",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_nav",
					"desc" => __("Wird vor dem öffnenden <code>&lt;nav&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "before_nav",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_after_nav",
					"desc" => __("Wird nach dem schließenden <code>&lt;/nav&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "after_nav",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_content",
					"desc" => __("Wird vor dem öffnenden div <code>#content</code> ausgeführt", 'revothemes'),
					"id" => "before_content",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_after_content",
					"desc" => __("Wird nach dem schließenden div <code>#content</code> ausgeführt", 'revothemes'),
					"id" => "after_content",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_post",
					"desc" => __("Wird vor dem öffnenden div <code>#post</code> ausgeführt", 'revothemes'),
					"id" => "before_post",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_after_post",
					"desc" => __("Wird nach dem schließenden div <code>#post</code> ausgeführt", 'revothemes'),
					"id" => "after_posts",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_comments",
					"desc" => __("Wird direkt vor den Kommentaren ausgeführt. Nur <code>single.php</code>.", 'revothemes'),
					"id" => "before_comments",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_sidebar",
					"desc" => __("Wird vor dem öffnenden <code>&lt;aside&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "before_sidebar",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_after_sidebar",
					"desc" => __("Wird nach dem schließenden <code>&lt;/aside&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "after_sidebar",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_before_footer",
					"desc" => __("Wird vor dem öffnenden <code>&lt;footer&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "before_footer",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_after_footer",
					"desc" => __("Wird nach dem schließenden <code>&lt;/footer&gt;</code> Tag ausgeführt", 'revothemes'),
					"id" => "after_footer",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" =>  __("WordPress Hooks", 'revothemes'),
						"desc" => ' Hier werden die WordPress Hooks <code>wp_head();</code> und <code>wp_footer();</code> angesteuert.',
						"type" => "info");

$options[] = array( "name" => "evolution_wp_head",
					"desc" => __("Wird vor dem schließenden <code>&lt;/head&gt;</code> Tag ausgeführt. Eignet sich auch zum Zufügen von JavaScript.", 'revothemes'),
					"id" => "wp_head",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => "evolution_wp_footer",
					"desc" => __("Wird vor dem schließenden <code>&lt;/body&gt;</code> Tag ausgeführt. Eignet sich auch zum Zufügen von JavaScript.", 'revothemes'),
					"id" => "wp_footer",
					"std" => "",
					"type" => "textarea");

	return $options;
}