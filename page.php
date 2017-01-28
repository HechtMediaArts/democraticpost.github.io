<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the page structure.
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

		<div id="content" role="main">
			<div class="content-inner">
				<div class="entry_content">

					<?php evolution_page_loop() ?>

				</div><!-- end div.entry_content -->
      </div><!-- end div .content-inner -->
    </div><!-- end div #content -->

    <?php do_action( 'layout_structure' ); ?>

    <?php evolution_after_content();?>
    

<?php get_footer();?>