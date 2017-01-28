<div class="outer">
<div class="zilla-one-fourth">
 <div class="featured-nav meinungen">
<span>Glück &amp; erfolg</span>
</div> 
<?php do_action( 'evolution_glueck_menu' ); ?>   
</div>
<div class="zilla-three-fourth zilla-column-last">

<?php $meinungen = new WP_Query( array( 'posts_per_page' => 1,'offset' =>1, 'category__in' => array( 1016, 1017, 1018,1019,1020,1021 ) ) );

if ( $meinungen->have_posts() ) : while ( $meinungen->have_posts() ) : $meinungen->the_post(); ?> 
         
<article <?php post_class( 'entry-item-featuring-startseite-meinungen clearfix' ); ?>>
<div class="front-first second politik meinungen">                  
<header class="post-header featured-content">                                           
<?php 
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<span class="post-categories"><a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="Alle Beiträge anschauen in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a></span>';
        $sep = ', ';
    }
?>                           
                          
                          <?php $subheadline = get_post_meta($post->ID, 'democratic_subheadline', true);
                            if ($subheadline) { ?>
                            <a href="<?php the_permalink(); ?>"><span class="subheadline frontpage1"><?php echo $subheadline; ?></span></a>
                        <?php } ?>
                           
                            <h2 class="entry-title meinungen"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? get_the_title(): kopa_search_title();  ?></a></h2>                      
 </header>                  
                       
                       <a href="<?php the_permalink(); ?>">           
                            <?php the_post_thumbnail( 'startseite-gross' ); ?>
                            </a>
                         
                    
                    <div class="entry-content featuring"> 
                        
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
                        
                    </div><!-- entry-content featuring -->
                    </div>
                </article>

<?php wp_reset_postdata(); ?>
<?php endwhile; ?>
<?php endif; ?>

 <?php 

// Weitere Artikel im Bereich Meinungen ?>
<div class="oddpost">
<ul class="entry-list isotop-item clearfix">
<?php $meinungen1 = new WP_Query( array( 'posts_per_page' => 2, 'offset' =>2, 'category__in' => array( 1016, 1017, 1018,1019,1020,1021 ) ) );
if ( $meinungen1->have_posts() ) : while ( $meinungen1->have_posts() ) : $meinungen1->the_post(); ?>

			<?php evolution_before_post();?>
           
            <li class="element-front">
                <article <?php post_class( 'entry-item front clearfix' ); ?>>
                       
                        <div class="entry-thumb">
                                       
                            <a href="<?php the_permalink(); ?>">           
                            <?php the_post_thumbnail( 'frontpage-thumb' ); ?>
                            </a>
                                                        
                        </div>
                        <!-- entry-thumb -->
                    
                    <div class="entry-content homeblog"> 

                        <header>
                                              
<?php 
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<span class="category list"><a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="Alle Beiträge anschauen in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a></span>';
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
                </article>
                <!-- entry-item -->
            </li>

			<?php evolution_after_post();?>                   

<?php wp_reset_postdata(); ?>
<?php endwhile; endif; ?>
</ul>
</div><!-- End oddpost -->
</div><!-- end front-first second -->
</div><!-- end zilla-three-fourth -->
<div class="clearfix"></div>   