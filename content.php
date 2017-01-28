<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                  
				<div class="post-header">
										
					<?php if (has_category()) : ?>
<?php 
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<span class="post-categories"><a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="Alle Beiträge anschauen in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a></span>';
        $sep = ', ';
    }
?>
					<?php endif; ?>
                    
                    <?php $subheadline = get_post_meta($post->ID, 'democratic_subheadline', true);
                        if ($subheadline) { ?>
                        <span class="subheadline"><?php echo $subheadline; ?></span>
                    <?php } ?>
					
					<?php if ( get_the_title() ) : ?>
						
					    <header>
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                         </header> 
					    
					<?php endif; ?>
					
					<div class="post-meta">
						<span class="resp"><?php _e('Geschrieben','rowling'); ?></span> <span class="post-meta-author"><?php _e('von','rowling'); ?> <a href="<?php echo get_author_posts_url(          get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span> <span class="post-meta-date"><?php _e('am','rowling'); ?> <a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a></span> <?php edit_post_link(__('Edit', 'rowling'), ' &mdash; ') ?>
						<?php if ( comments_open() ) : ?>
							<span class="post-comments">
								<?php 
									comments_popup_link(
										'<span class="fa fw fa-comment"></span>0<span class="resp"> ' . __('Kommentare', 'rowling') . '</span>', 
										'<span class="fa fw fa-comment"></span>1<span class="resp"> ' . __('Kommentar', 'rowling') . '</span>', 
										'<span class="fa fw fa-comment"></span>%<span class="resp"> ' . __('Kommentare', 'rowling') . '</span>'
									); 
								?>
							</span>
						<?php endif; ?>
					</div> <!-- /post-meta -->
					
				</div> <!-- /post-header -->
                      
                        
    <?php if ( has_post_thumbnail() && 'show' == get_option( 'kopa_theme_options_featured_image_status', 'show' ) ) { ?>
        <div class="entry-thumb">
            
        <?php the_post_thumbnail( 'article' ); // 670 x 320 Pixel ?>
          
           <?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
						
							<p class="post-image-caption"><span class="fa fw fa-camera fa-1x"></span><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
														
                    <?php endif; ?>
            
        </div><!-- entry-thumb  -->
       <div class="mashshare-top">
        <?php echo do_shortcode("[mashshare]"); ?> 
        </div>
        <div class="clearfix"></div>
    <?php } ?>

    <div class="elements-box">
       <div class="inhalt">
        <!-- google_ad_section_start -->
        <?php the_content();?>
        <!-- google_ad_section_end -->
        </div>
        <div class="mashshare-bottom">
        <?php  echo do_shortcode("[mashshare]"); ?> 
        </div>
       <?php democratic_spenden_box(); ?>  
        <?php // democratic_comment_message(); ?>
        <?php democratic_related_posts(); ?>
        <?php // if (class_exists('plista')) { echo plista::plista_integration ($content); } ?>
        <?php  evolution_author_box(); ?>
        <?php
 	$defaults = array(
		'before'           => '' ,
		'after'            => '',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page' ),
		'previouspagelink' => __( 'Previous page' ),
		'pagelink'         => '%',
		'echo'             => 1
	);
        wp_link_pages( $defaults );
?>
        <?php democratic_autoren_gesucht(); ?>                     
        

   
   <?php //echo democratic_share_buttons_zaehler(); ?>
    
    
    </div> <!-- elements-box -->
    
</div><!--#post-->