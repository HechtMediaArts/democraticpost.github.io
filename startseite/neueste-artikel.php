<?php // Democratic Post 
// Wir teilen der Loop mit, dass entweder ein Sticky-Post, oder aber ein normaler Post angezeigt wird.
$args = array(
    'category__not_in' => array( ), //exclude Videos
	'posts_per_page'      => 1,
	'post__in'            => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
);

// The Query
$theQuery = new WP_Query( $args );

// Die Loop
while ( $theQuery->have_posts() ) {
	$theQuery->the_post(); $do_not_duplicate = $post->ID; ?>   
         
<article <?php post_class( 'entry-item-featuring-startseite clearfix' ); ?>>
<div class="front-first">                  
<header class="featured-content">
<div class="post-header">                                              
<?php 
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<span class="post-categories"><a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="Alle Beiträge anschauen in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a></span>';
        $sep = ', ';
    }
?>                           
                           <?php if ( get_post_meta( get_the_ID(), '_my_meta_value_key', true ) ) : ?>
                            <span class="werbung"><?php echo get_post_meta( $post->ID, '_my_meta_value_key', true ); // Werbung ?></span>
                        <?php endif; ?>
                          
                          <?php $subheadline = get_post_meta($post->ID, 'democratic_subheadline', true);
                            if ($subheadline) { ?>
                            <a href="<?php the_permalink(); ?>"><span class="subheadline"><?php echo $subheadline; ?></span></a>
                        <?php } ?>
                           
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? get_the_title(): kopa_search_title();  ?></a></h2>
    </div><!-- end .post-header -->                        
 </header>                  
                       <?php if ( has_post_format( 'video' )) : ?>
                       <?php democratic_startseite_featured_video_thumbnails() ?>
                       <?php else: ?>
                       <a href="<?php the_permalink(); ?>">
                       <?php the_post_thumbnail(); ?>
                        </a>
                        <?php endif ?> 
                    
                    <div class="entry-content featuring first"> 
                        
                        <div class="infos"><span class="the-author">Von <?php the_author(); ?></span><span class="entry-date"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span></div>

                        <?php the_excerpt(); ?>
                        <span class="post-comments">
								<?php 
									comments_popup_link(
										'<span class="fa fw fa-comment"></span>0<span class="resp"> ' . __('Kommentare', 'rowling') . '</span>', 
										'<span class="fa fw fa-comment"></span>1<span class="resp"> ' . __('Kommentar', 'rowling') . '</span>', 
										'<span class="fa fw fa-comment"></span>%<span class="resp"> ' . __('Kommentare', 'rowling') . '</span>'
									); 
								?>
							</span>
                        
                    </div>
                    <!-- entry-content -->
                    </div>
                </article>          
<?php } ?>
      

<div id="content-sidebar-wrap" class="frontpage">

<?php evolution_before_content();?>

<div id="content">
	<div class="content-inner">
		<div class="entry_content">

<?php // Die zweite Loop für die weiteren Artikel. Sticky Posts werden nicht angezeigt.
      // Die Blog-Paginierung funktioniert weiterhin, wennn wir der Loop mitteilen, wie viel Artikel angezeigt werden sollen. ?>
<ul class="entry-list isotop-item clearfix">
<?php      
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$exclude_query = new WP_Query( array( 'post__not_in' => get_option( 'sticky_posts' ),'category__not_in' => array(  ), 'posts_per_page' => 10,'paged' => $paged  ) );
if ( $exclude_query->have_posts() ) : while ( $exclude_query->have_posts() ) : $exclude_query->the_post(); if ( $post->ID == $do_not_duplicate ) continue; ?>

			<?php evolution_before_post();?>
           
            <li class="element-front">
                <article <?php post_class( 'entry-item front clearfix' ); ?>>
                   
                    <?php if ( has_post_thumbnail() ) { ?>
                       
                        <div class="entry-thumb front">
                           <?php if ( has_post_format( 'video' ) ) : ?>
                         <?php the_post_thumbnail( 'startseite-thumb' ); ?>                         
                            
                             <?php elseif ( has_post_format( 'gallery' ) ) : ?>
                             <?php echo democratic_post_gallery_thumbnails_small() ?>
                             
                             <?php else : ?>  
                            <a href="<?php the_permalink(); ?>">           
                            <?php the_post_thumbnail( 'startseite-thumb' ); ?>
                            </a>                                           
                             <?php endif; ?>
                                                        
                        </div>
                        <!-- entry-thumb -->
                        
                    <?php } // endif ?>
                    
                    <div class="entry-content home"> 

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
                            
                        </header>
                        <p>
                        <?php the_excerpt_max_charlength(140); ?>
            
							<span class="post-comments">
								<?php 
									comments_popup_link(
										'<span class="fa fw fa-comment"></span>0<span class="resp"> ' . __('Kommentare', 'rowling') . '</span>', 
										'<span class="fa fw fa-comment"></span>1<span class="resp"> ' . __('Kommentar', 'rowling') . '</span>', 
										'<span class="fa fw fa-comment"></span>%<span class="resp"> ' . __('Kommentare', 'rowling') . '</span>'
									); 
								?>
							</span>

                        </p>
                    </div>
                    <!-- entry-content -->
                </article>
                <!-- entry-item -->
            </li>

			<?php evolution_after_post();?>                   

<?php wp_reset_postdata(); ?>
<?php endwhile; endif; ?>
</ul>
<div class="menu-start clearfix">
		<span>Neueste Beiträge: </span><?php do_action( 'evolution_start_menu' ); ?>
</div><!-- End menu-start -->
</div><!-- end div .entry_content -->
</div><!-- end div .content-inner -->
</div><!-- end div #content-->