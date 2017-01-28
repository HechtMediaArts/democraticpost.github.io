<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the single post structure.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

get_header();
global $options;
?>

</header>
<div class="breadcrumb" typeof="BreadcrumbList" vocab="http://schema.org/">
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
				<div class="entry_content entry-content">

				
                    <?php
                        if (have_posts()) {
                        while (have_posts()) {
                        the_post();
                        get_template_part( 'content', get_post_format() );
                        ?>
               
        <?php if (get_the_terms(get_the_ID(), 'post_tag')) { ?>

            <div class="post-tags">
               <header><span>Themen:</span></header>
                <?php the_tags('', ' ', ''); ?>
            </div><!--tag-box-->
        <?php } // endif  ?>
        
        <?php democratic_print_button(); ?>
        
        <div class="startseite" style="text-align: center;">
            <a href="https://www.democraticpost.de" title="Zurück zur Startseite gehen">Hier geht es zurück zur Startseite &raquo;</a>
        </div>

        <?php//  evolution_author_box(); ?>    
            
        <?php  comments_template('', true);?>


    <?php
    } // endwhile
} // endif
?>

			</div><!-- end div.entry_content -->
			</div><!-- end div .content-inner -->
		</div><!-- end div #content -->

		<?php do_action( 'layout_structure' ); ?>

		<?php evolution_after_content();?>
		

<?php get_footer();?>