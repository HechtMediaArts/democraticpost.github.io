<?php

/**
 * Template Name: Sitemap
 *
 * The sitemap page template displays a user-friendly overview
 * of the content of your website.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

get_header();
global $data;
?>

</header>
<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
<?php if(function_exists('bcn_display'))
{
bcn_display();
}?>
</div>

<?php evolution_after_header();?>

<!-- - - - - - - - - - - - - - - - -  Main Content - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

	<div id="content-sidebar-wrap">

		<?php evolution_before_content();?>

		<div id="content">
			<div class="content-inner">
				<div class="entry_content">
              <header class="page">
               <h1 class="entry-title">Alle Beiträge und Schlagzeilen</h1>
               </header>
                <?php get_template_part( 'sitemap' ); ?>
			</div><!-- end div.entry_content -->
      </div><!-- end div .content-inner -->
    </div><!-- end div #content -->

    <?php do_action( 'layout_structure' ); ?>

    <?php evolution_after_content();?>
    

<?php get_footer();?>