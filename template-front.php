<?php

/**
 * Template Name: Frontpage
 *
 * Stellt die Startseite der Democratic Post dar.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

get_header();
?>

</header>
<div class="breadcrumb menu">
<span>Wichtige Themen: </span><?php do_action( 'evolution_news_menu' ); ?>
</div> 

<?php evolution_after_header();?>

<?php // get_template_part( 'startseite/umfrage' ); ?>


<?php get_template_part( 'startseite/neueste-artikel' ); ?>

<?php if ( is_active_sidebar( 'startseite' ) ) : ?>
<?php get_sidebar( 'startseite' ); ?>
<?php endif; ?>
</div><!-- end #content-sidebar-wrap -->

<?php//  get_template_part( 'startseite/neueste-2' ); ?>

<?php get_template_part( 'startseite/debatte' ); ?>

<?php get_template_part( 'startseite/meinungen' ); ?>

<?php // get_template_part( 'startseite/glueck' ); ?>

<?php get_template_part( 'startseite/politik' ); ?>

<?php get_template_part( 'startseite/gesellschaft' ); ?>


<?php // get_template_part( 'startseite/feuilletton' ); ?>

<?php // get_template_part( 'startseite/videos' ); ?>

<?php //  get_template_part( 'startseite/unterhaltung' ); ?>

<?php evolution_after_content(); ?>

<?php get_footer();?>