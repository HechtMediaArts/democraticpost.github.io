<div class="videobg up">
<div id="front-videos">
<div class="featured-nav meinungen video">
<span>Videos</span>    
<div class="videolink"><a href="http://www.democraticpost.de/video/">Alle Videos &raquo;</a></div>  
</div>

<?php $query = new WP_Query( array( 'posts_per_page' => 1, 'category__in' => array( 11, 601, 602, 600, 603 ) ) );

if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?> 
         
 <div class="front-video">        
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-item-featuring-startseite-meinungen clearfix' ); ?>>                 
<header class="featured-content">
<h4 class="video-title"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? get_the_title(): kopa_search_title();  ?></a></h4>                        
 </header>
 <div class="entry-thumb">                                   
<?php democratic_startseite_video_thumbnails() ?>
</div>
<div class="video-excerpt">
<?php the_excerpt(); ?>
</div> 
</article>
</div>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>
<?php endwhile; ?>
<?php endif; ?>      
    </div>
</div>