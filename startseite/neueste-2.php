<div class="outer">


<?php $debatte = new WP_Query( array( 'posts_per_page' => 1, 'offset' =>10  ) );

if ( $debatte->have_posts() ) : while ( $debatte->have_posts() ) : $debatte->the_post(); ?> 
               
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
                          
                          <?php $subheadline = get_post_meta($post->ID, 'democratic_subheadline', true);
                            if ($subheadline) { ?>
                            <a href="<?php the_permalink(); ?>"><span class="subheadline frontpage1"><?php echo $subheadline; ?></span></a>
                        <?php } ?>
                           
                            <h2 class="entry-title meinungen"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? get_the_title(): kopa_search_title();  ?></a></h2>              
</div><!-- end .post-header -->                            
</header><!-- end .post-header -->                  
                       
                       <a href="<?php the_permalink(); ?>">           
                            <?php // the_post_thumbnail( 'startseite-gross' ); ?>
                            <?php the_post_thumbnail(); ?>
                            </a>
                         
                    
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
            
<?php wp_reset_postdata(); ?>
<?php endwhile; ?>
<?php endif; ?>

<div class="zilla-one-fourth">
 <div class="featured-nav meinungen">
<span>Ressorts</span>
</div> 
<?php do_action( 'evolution_politik_menu' ); ?>   
</div>

<div class="zilla-three-fourth zilla-column-last">
 <?php 
// Weitere Artikel im Bereich Meinungen ?>
<div class="oddpost">
<ul class="entry-list isotop-item clearfix">
<?php $debatte1 = new WP_Query( array( 'posts_per_page' => 8, 'offset' =>11  ) );

if ( $debatte1->have_posts() ) : while ( $debatte1->have_posts() ) : $debatte1->the_post(); ?>

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
                    </div><!-- entry-content homeblog -->
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
</div><!-- End oddpost -->
</div><!-- end front-first second -->
</div><!-- end zilla-three-fourth -->
<div class="clearfix"></div>   