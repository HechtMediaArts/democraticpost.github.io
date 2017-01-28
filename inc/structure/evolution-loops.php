<?php

/**
 * The loops for displaying the content
 *
 * @category   		Evolution Framework
 * @package    		Structure
 * @subpackage 	Frontend Functions
 * @author     		Hecht MediaArts
 * @license    		http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       			http://hechtmediaarts.com/evolution
 */


function evolution_singlepost_loop() {
?>

<?php while ( have_posts() ) : the_post();
				?>

				<?php evolution_before_post();?>

				<article id="post-<?php the_ID();?>" <?php post_class();?> role="article" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				
					<h1 class="post-title entry-title" itemprop="name"><?php the_title();?></h1>

					<?php
						if(of_get_option('share_above') == "ja") { echo evolution_share_this();
						} else {
						}
						?>

					<?php if (of_get_option('adsense')) :
					?>
					<div class="in-content-add">
						<?php echo of_get_option('adsense');?>
					</div>
					<?php endif;?>

<div class="exerpt_img">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

				<?php democratic_post_blog_thumbnails(); ?>

           <?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
						
							<p class="post-image-caption"><span class="fa fw fa-camera fa-1x"></span><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
														
                    <?php endif; ?>

			</a>
</div>
		<div class="the-content">
        <!-- google_ad_section_start -->
					<?php the_content();?>
        <!-- google_ad_section_end -->					
		</div>

		<?php // do_action( 'techbrain_frontshare_buttons_counter'); ?>	

					<?php // do_action( 'evolution_second_extendet_author'); ?>

					<?php do_action( 'evolution_affiliate_box' ); ?>

					<?php if(of_get_option('related_display') == "ja") { do_action('related_posts'); } ?>

					<?php evolution_before_comments();?>

					<?php wp_link_pages(array('before' => '<div class="page-link" id="fix">' . __('Pages:', 'revothemes'), 'after' => '</div><!-- end .page-link -->'));?>

					<?php comments_template('', true);?>

					<?php if ( ! comments_open() ) : ?>

					<p class="commentmessage">
						<?php _e('Entschuldigung, die Kommentare sind geschlossen für diesen Beitrag.', 'revothemes') ?>
					</p>

					<?php endif;?>
				</article><!-- end #post -->

				<?php evolution_after_post();?>

				<?php endwhile;?>

<?php } 


/**
 * The main loop on index.php
 *
 * @since 2.0.0
 *
 */
function evolution_index_loop() {

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts("post_type=post&paged=$paged");
				?>
				<?php if (have_posts()) : $count = 0;
				?>
				<?php while (have_posts()) : the_post(); $count++;
				?>

			<?php evolution_before_post();?>

				<article id="post-<?php the_ID();?>" <?php post_class();?> role="article">
					<div class ="index">

						<h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title();?>"> <?php the_title();?></a></h1>
						<div class="pls_note">
								<div class="comments-link">
								<?php comments_popup_link(__('Kommentieren', 'revothemes'), __('1 Kommentar', 'revothemes'), __('% Kommentare'));?>
								</div>
								<span class="date"><?php the_time('d M Y');?>&nbsp;&nbsp;/&nbsp;&nbsp; Kategorie: </span>
								<?php
								echo '<span class="kategorie">';
									the_category(', ');
									the_tags('&nbsp;&nbsp;/&nbsp;&nbsp;Tags: ',' , ','');
									echo '</span>';
								?>
							</div><!-- end .pls_note -->

				<div class="exerpt_img">
							<?php if( is_sticky() ) { ?> <span class="sticky-post"><?php _e('Sticky post', 'hemingway'); ?></span> <?php } ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

					<?php techbrain_post_thumbnails(); ?>

				<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>

					<div class="media-caption-container">

						<p class="media-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>

					</div>

				<?php endif; ?>

			</a>
</div>
					<?php

							the_excerpt();

							?>
<div class="front-share-buttons">
<ul>
<li><a class="tw" title="Bei Twitter empfehlen" href="https://twitter.com/intent/tweet?source=webclient&amp;text=<?php echo rawurlencode(strip_tags(get_the_title())) ?> <?php echo urlencode(get_permalink($post->ID)); ?>" target="blank" rel="nofollow"><span>Twitter</span></a></li>
<li><a class="fb" title="Bei Facebook empfehlen" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;t=<?php echo rawurlencode(strip_tags(get_the_title())) ?>" target="blank" rel="nofollow"><span>Facebook</span></a></li>
<li><a class="gp" title="Bei Google+ empfehlen" href="https://plusone.google.com/_/+1/confirm?hl=de&amp;url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo rawurlencode(strip_tags(get_the_title())) ?>" target="blank" rel="nofollow"><span>Google+</span></a></li>
<li><a class="readmore" href="<?php the_permalink() ?>" rel="bookmark" title="Weiterlesen: <?php the_title();?>"> <?php _e('Weiterlesen »', 'revothemes');?></a></li>
</ul>
</div>

				</div><!-- /index -->
				</article><!-- end #post -->

			<?php evolution_after_post();?>

				<?php endwhile; else:?>
				<p>
					<?php _e('Sorry, no posts matched your criteria.', 'revothemes')
					?>
				</p>
				<?php endif;?>
<?php }

/**
 * The loop for the pages
 *
 * @since 2.0.0
 *
 */
function evolution_page_loop() {

while ( have_posts() ) : the_post();
				?>
				<article id="post-<?php the_ID();?>" <?php post_class();?> role="article">
					<header class="page">
                    <h1 class="entry-title"><?php the_title();?></h1>
                    </header>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('startseite-gross'); ?>
					<?php endif; ?>
					<div class="in-content-add">
						<?php echo of_get_option('adsense');?>
					</div>
					<div class="inhalt">
                    <?php the_content(); ?>
                    </div>

					<?php wp_link_pages(array('before' => '<div class="page-link" id="fix">' . __('Pages:', 'revothemes'), 'after' => '</div><!-- end .page-link -->'));?>
                    
                    <?php if ( is_page( 'neu-hier-lies-mich' ) ) : ?>
					<?php  comments_template('', true);?>
					<?php endif; ?>

				</article><!-- end #post -->
				<?php endwhile;?>
<?php }


/**
 * The loop for the archive pages
 *
 * @since 2.0.0
 *
 */
function evolution_archive_loop() {

if ( have_posts() ) : the_post();
				?>
			<div class="page-title">

			<h3>

				<?php if ( is_day() ) : ?>
					<?php _e('Tag', 'wilson'); ?><span class="name"><?php echo get_the_date(); ?></span>
				<?php elseif ( is_month() ) : ?>
					<?php _e('Monat', 'wilson'); ?><span class="name"><?php echo get_the_date('F Y'); ?></span>
				<?php elseif ( is_year() ) : ?>
					<?php _e('Jahr', 'wilson'); ?><span class="name"><?php echo get_the_date('Y'); ?></span>
				<?php elseif ( is_category() ) : ?>
					<?php _e('Kategorie', 'wilson'); ?><span class="name"><?php echo single_cat_title( '', false ); ?></span>
				<?php elseif ( is_tag() ) : ?>
					<?php _e('Schlüsselwort', 'wilson'); ?><span class="name"><?php echo single_tag_title( '', false ); ?></span>
				<?php elseif ( is_author() ) : ?>
					<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
					<?php _e('Autor', 'wilson'); ?><span class="name"><?php echo ($curauth->display_name); ?></span>
				<?php else : ?>
					<?php _e( 'Archiv', 'wilson' ); ?>
				<?php endif; ?>

			</h3>

			<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', $tag_description );
			?>

		</div> <!-- /page-title -->


				<?php rewind_posts();?>
				
				
				<?php while ( have_posts() ) : the_post();
				?>
				<article id="post-<?php the_ID();?>" <?php post_class();?> role="article">
					<div class ="index">

						<h1 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title();?>"> <?php the_title();?></a></h1>
						<div class="pls_note">
								<div class="comments-link">
								<?php comments_popup_link(__('Kommentieren', 'revothemes'), __('1 Kommentar', 'revothemes'), __('% Kommentare'));?>
								</div>
								<span class="date"><?php the_time('d M Y');?>&nbsp;&nbsp;/&nbsp;&nbsp; Kategorie: </span>
								<?php
								echo '<span class="kategorie">';
									the_category(', ');
									the_tags('&nbsp;&nbsp;/&nbsp;&nbsp;Tags: ',' , ','');
									echo '</span>';
								?>
							</div><!-- end .pls_note -->

				<div class="exerpt_img">
							<?php if( is_sticky() ) { ?> <span class="sticky-post"><?php _e('Sticky post', 'hemingway'); ?></span> <?php } ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

					<?php techbrain_post_thumbnails(); ?>

				<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>

					<div class="media-caption-container">

						<p class="media-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>

					</div>

				<?php endif; ?>

			</a>
</div>
					<?php

							the_excerpt();

							?>
<div class="front-share-buttons">
<ul>
<li><a class="tw" title="Bei Twitter empfehlen" href="https://twitter.com/intent/tweet?source=webclient&amp;text=<?php echo rawurlencode(strip_tags(get_the_title())) ?> <?php echo urlencode(get_permalink($post->ID)); ?>" target="blank" rel="nofollow"><span>Twitter</span></a></li>
<li><a class="fb" title="Bei Facebook empfehlen" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;t=<?php echo rawurlencode(strip_tags(get_the_title())) ?>" target="blank" rel="nofollow"><span>Facebook</span></a></li>
<li><a class="gp" title="Bei Google+ empfehlen" href="https://plusone.google.com/_/+1/confirm?hl=de&amp;url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo rawurlencode(strip_tags(get_the_title())) ?>" target="blank" rel="nofollow"><span>Google+</span></a></li>
<li><a class="readmore" href="<?php the_permalink() ?>" rel="bookmark" title="Weiterlesen: <?php the_title();?>"> <?php _e('Weiterlesen »', 'revothemes');?></a></li>
</ul>
</div>

				</div><!-- /index -->
				</article><!-- end #post -->

			<?php evolution_after_post();?>

				<?php endwhile; else:?>

				<p>
					<?php _e('Sorry, no posts matched your criteria.', 'revothemes')
					?>
				</p>
				<?php endif;?>
<?php }
