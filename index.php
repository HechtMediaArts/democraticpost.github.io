<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the index structure - this is the blog template.
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
<div class="breadcrumb">
<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
	                       yoast_breadcrumb();
                    } ?>
</div> 

<?php evolution_after_header();?>

<!-- - - - - - - - - - - - - - - - -  Main Content - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<div id="content-sidebar-wrap">

<?php evolution_before_content();?>

<div id="content" role="main">
	<div class="content-inner">
		<div class="entry_content">

			
<ul class="entry-list isotop-item clearfix">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts("post_type=post&paged=$paged");
				?>
				<?php if (have_posts()) : $count = 0;
				?>
				<?php while (have_posts()) : the_post(); $count++;
				?>

			<?php evolution_before_post();?>
           
            <li class="element">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-item clearfix' ); ?>>
                   
                    <?php if ( has_post_thumbnail() ) { ?>
                       
                        <div class="entry-thumb">
                           <?php if ( has_post_format( 'video' ) ) : ?>
                         <?php the_post_thumbnail( 'frontpage-thumb' ); ?>                         
                            
                             <?php elseif ( has_post_format( 'gallery' ) ) : ?>
                             <?php the_post_thumbnail( 'frontpage-thumb' ); ?>
                             
                             <?php else : ?>  
                                       
                            <?php the_post_thumbnail( 'frontpage-thumb' ); ?>

                                                                         
                             <?php endif; ?>
                                                        
                        </div>
                        <!-- entry-thumb -->
                        
                    <?php } // endif ?>
                    
                    <div class="entry-content homeblog"> 

                        <header>
                                              
<?php 
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<span class="category"><a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="Alle Beiträge anschauen in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a></span>';
        $sep = ', ';
    }
?>
                                                   
                           <?php if ( get_post_meta( get_the_ID(), '_my_meta_value_key', true ) ) : ?>
                            <span class="werbung"><?php echo get_post_meta( $post->ID, '_my_meta_value_key', true ); // Werbung ?></span>
                        <?php endif; ?>
                          
                          <?php $subheadline = get_post_meta($post->ID, 'democratic_subheadline', true);
                            if ($subheadline) { ?>
                            <a href="<?php the_permalink(); ?>" class="sub"><span class="subheadline"><?php echo $subheadline; ?></span></a>
                        <?php } ?>
                           
                            <h2 class="entry-title listing"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? get_the_title(): kopa_search_title();  ?></a></h2>
                            <div class="infos"><span class="the-author">Von <?php the_author(); ?></span><span class="entry-date"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span></div>
                        </header>
                        <?php the_excerpt(); ?>
                    </div>
                    <!-- entry-content -->
                </article>
                <!-- entry-item -->
            </li>

			<?php evolution_after_post();?>

				<?php endwhile; else:?>
				<p>
					<?php _e('Sorry, no posts matched your criteria.', 'revothemes')
					?>
				</p>
				<?php endif;?>

</ul>            

			<?php the_posts_pagination( array( 'type' => 'list', 'prev_text' => '&laquo; Zurück', 'next_text' => 'Weiter &raquo;' ) ); ?>

		</div><!-- end div .entry_content -->
	</div><!-- end div .content-inner -->

</div><!-- end div #content-->

<?php do_action( 'layout_structure' ); ?>

<?php evolution_after_content();?>

<?php get_footer();?>