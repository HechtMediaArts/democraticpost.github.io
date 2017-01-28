<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the comments structure.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

	// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'revothemes') ?></p>

	<?php return; } ?>

<!-- You can start editing here. -->

	<?php if ( have_comments() ) : ?>
		<?php if ( !empty($comments_by_type['comment']) ) : ?>

		<div id="comments" class="fix">

			<h3><?php comments_number(__('Keine Kommentare bis jetzt', 'revothemes'), __('<span>Ein</span> Kommentar', 'revothemes'), __('<span>%</span> Kommentare', 'revothemes') );?> </h3>

			<ol class="commentlist">
				<?php wp_list_comments('avatar_size=70&callback=evolution_comments&type=comment'); ?>
			</ol>

			<div class="navigation">
				<div class="fl"><?php previous_comments_link() ?></div>
				<div class="fr"><?php next_comments_link() ?></div>
				<div class="fix"></div>
			</div><!-- /.navigation -->

		</div> <!-- /#comments_wrap -->
		<?php endif; ?>
		<?php if ( !empty($comments_by_type['pings']) ) : ?>

		<div id="pings">

			<h3><?php _e('Trackbacks and Pingbacks', 'revothemes') ?></h3>

			<ol class="pinglist">
				<?php wp_list_comments('type=pings&callback=list_pings'); ?>
			</ol>

		</div><!-- /#pings -->

    	<?php endif; ?>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>
			<!-- If comments are closed. -->

			<div id="comments">

			 <p class="nocomments"><?php  _e('Sorry, die Kommentare sind geschlossen.', 'revothemes') ?></p> 

			</div><!-- /#comments -->

		<?php endif; ?>

	<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

	<h4><em><?php comment_form_title( __('Ihre Meinung zum Thema?', 'revothemes'), __('Ihre Meinungen zu %s', 'revothemes') ); ?></em></h4>
	<p class="respond-text">Wir freuen uns über Leser, die durch nützliche und konstruktive Beiträge zum Thema eine Diskussion anstoßen. Allgemein gilt: Kritische Kommentare und Diskussionen sind willkommen, Beschimpfungen / Beleidigungen hingegen werden entfernt. Zum Kommentar-Fairplay gehört für uns auch, dass Sie als Namen weder eine Domain noch ein spamverdächtiges Wort wählen. Vielen Dank!</p>

		<small><?php cancel_comment_reply_link(); ?></small>

	<?php if ( get_option('comment_registration') && !$user_ID ) : //If registration required & not logged in. ?>

		<p><?php _e('Du musst', 'revothemes') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('eingeloggt sein', 'revothemes') ?></a> <?php _e('um einen Kommentar zu posten.', 'revothemes') ?></p>

	<?php else : //No registration required ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( $user_ID ) : //If user is logged in ?>

			<p><?php _e('Logged in as', 'revothemes') ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'revothemes') ?>"><?php _e('Logout', 'revothemes') ?> &raquo;</a></p>

		<?php else : //If user is not logged in ?>
                <div id="commentfields">
				<div class="cform">
				<label for="comment-author">Name</label>
				<input type="text" name="author" id="comment-author" value="<?php echo '' != esc_attr($comment_author) ? esc_attr($comment_author) : 'Name'; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

			</div>
			<div class="cform">
				<label for="comment-email">E-Mail</label>
				<input type="text" name="email" id="comment-email" value="<?php echo '' != esc_attr($comment_author_email) ? esc_attr($comment_author_email) : 'E-Mail'; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
			</div>
			
			<div class="cform website">
				<label for="comment-url">Webseite</label>
				<input type="text" name="url" id="comment-url" value="<?php echo '' != esc_attr($comment_author_url) ? esc_attr($comment_author_url) : 'Webseite'; ?>" size="22" tabindex="3" />
			</div>
            </div><!-- end #commentfields -->
		<?php endif; // End if logged in ?>
        <div class="clearfix"></div>
        <div class="cform textarea">
        <textarea name="comment" id="comment" cols="22" rows="5" tabindex="4"><?php _e('Kommentar', 'revothemes') ?></textarea>
        </div>
        <?php if ( !$user_ID ) : //If user is logged out ?>
        <p><strong>XHTML:</strong> <?php _e('Diese Tags können Sie nutzen', 'revothemes'); ?>: <code><?php echo allowed_tags(); ?></code></p>
        <?php endif; // End if logged out ?>
        <div class="button">
		<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Kommentar senden', 'revothemes') ?>" />
        </div>
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>

		</form><!-- /#commentform -->

	<?php endif; // If registration required ?>

	<div class="fix"></div>

</div><!-- /#respond -->

<?php endif; // if you delete this we will send our russian killer commando :-) ?>
