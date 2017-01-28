<?php

/**
 * Comments File.
 *
 * @category    Evolution Framework
 * @package     Frontend
 * @subpackage Template
 * @author        Hecht MediaArts
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              http://www.hechtmediaarts.com/themes/evolution
 */

if ( ! function_exists( 'evolution_comments' ) ) :

function evolution_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	
<?php
$isByAuthor = false;
if($comment->comment_author_email == get_the_author_email()) {
$isByAuthor = true;
}
?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="kommentar">
		<div class="kommentar-meta">
		<div class="comment-author vcard">
			<a href="<?php echo get_comment_link(); ?>" title="<?php _e('Direct link to this comment', 'revothemes'); ?>"><?php echo get_avatar( $comment, 70 ); ?></a>
			 <?php printf( __( '%s <span class="schrieb">schrieb :</span>', 'revothemes' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> <?php if($isByAuthor ) { echo '<span class="der-autor">Autor</span>';} ?>
		</div><!-- .comment-author .vcard -->

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Der erste Kommentar wird immer moderiert, sorry...', 'revothemes' ); ?></em>

		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"></a>
			<?php
				/* translators: 1: date, 2: time */
				printf( __( 'am %1$s um %2$s', 'revothemes' ), get_comment_date(),  get_comment_time( 'H:i' )  );?><?php edit_comment_link( __( '(Edit)', 'revothemes' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->
        </div><!-- end .kommentar-meta -->
		<div class="comment-body"><?php comment_text(); ?>

		<div class="reply">
			<p><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>
		</div><!-- .reply -->
		</div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'revothemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'revothemes' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
		 // PINGBACK / TRACKBACK OUTPUT
			function list_pings($comment, $args, $depth) {
      		$GLOBALS['comment'] = $comment; ?>

			<li id="comment-<?php comment_ID(); ?>">
				<span class="author"><?php comment_author_link(); ?></span>
				<span class="date"><?php printf( __( '%1$s am %2$s', 'revothemes' ),  get_comment_date(),  get_comment_time( 'H:i' ) ); ?></span>
				<span class="pingcontent"><?php comment_text() ?></span>

		<?php }
endif;
?>
