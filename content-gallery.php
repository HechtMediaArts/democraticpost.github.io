<?php 
$gallery = kopa_content_get_gallery( get_the_content() );
if ( isset( $gallery[0] ) ) {
    $gallery = $gallery[0];
} else {
    $gallery = '';
}
?>
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
				
              
        <div class="entry-thumb galerie">
            <?php echo do_shortcode( $gallery['shortcode'] ); ?>               
        </div>

       <div class="mashshare-top">
        <?php  echo do_shortcode("[mashshare]"); ?> 
        </div>
        <div class="clearfix"></div>
    <div class="elements-box">
       <div class="inhalt">
        <?php $content = get_the_content(); 
        $content = preg_replace('/\[gallery.*]/', '', $content);
        $content = apply_filters( 'the_content', $content );
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
        ?>
        </div>
        <div class="mashshare-bottom">
        <?php  echo do_shortcode("[mashshare]"); ?> 
        </div>
       <?php democratic_spenden_box(); ?>  
        <?php // democratic_comment_message(); ?>
        <?php democratic_related_posts(); ?>
        <?php  evolution_author_box(); ?>
        <?php // democratic_moodly(); ?>
        <?php democratic_autoren_gesucht(); ?>

       <?php //  if (class_exists('plista')) { echo plista::plista_integration ($content); } ?>
        
        <?php //echo democratic_share_buttons_zaehler(); ?>  
    </div><!-- elements-box -->
    
</div><!--#post-->