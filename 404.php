<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * the 404 Error Template - handles the site errors.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

get_header(); 
kopa_get_domain();
?>

</header>

<?php evolution_after_header();?>

<!-- - - - - - - - - - - - - - - - -  Main Content - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<div id="content-sidebar-wrap">

	<?php evolution_before_content();?>


			<div class="content-inner">
				<div class="entry_content">
				
    <section class="error-404 clearfix">
        <div class="left-col">
            <p><?php _e( '404', kopa_get_domain() ); ?></p>
        </div><!--left-col-->
        <div class="right-col">
            <h1><?php _e( 'Seite nicht gefunden...', kopa_get_domain() ); ?></h1>
            <p><?php _e( "Entschuldigen Sie bitte, wir können die Seite nach der Sie suchten leider nicht finden. Haben Sie sich vielleicht vertippt? Versuchen Sie gerne auch eine andere Variante des Suchwortes. Falls der Fehler bei uns lag, werden wir ihn schnellstens beheben. Versuchen Sie in der Zwischenzeit eine der folgenden Optionen:", kopa_get_domain() ); ?></p>
            <ul class="arrow-list">
                <?php if ( isset( $_SERVER['HTTP_REFERER'] ) ) { ?>
                    <li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php _e( 'Zur letzten Seite zurückgehen', kopa_get_domain() ); ?></a></li>
                <?php } ?>
                <li><a href="<?php echo esc_url(home_url()); ?>"><?php _e( 'Gehen Sie zur Startseite', kopa_get_domain() ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/archiv/' ) ); ?>"><?php _e( 'Nutzen Sie unser Nachrichtenarchiv', kopa_get_domain() ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/schlagworte/' ) ); ?>"><?php _e( 'Oder das Schlagwortregister', kopa_get_domain() ); ?></a></li>
            </ul>
            <p>Falls sie unserem Technik-Team eine E-Mail senden möchten, können Sie dieses gerne unter der folgenden E-Mail-Adresse tun: <a href="https://www.democraticpost.de/wp-content/themes/democraticpost-1.3.0/technik-mail.php" rel="nofollow">technik at democraticpost.de</a></p>
        </div><!--right-col-->
    </section><!--error-404-->
				
				
			</div><!-- end div.entry_content -->
      </div><!-- end div .content-inner -->



    <?php evolution_after_content();?>
   
   </div><!-- end #content-sidebar-wrap --> 

<?php get_footer();?>