<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * 
 * Template Name: Contact form
 * 
 * Handles the contact form.
 *
 * @category  Evolution
 * @package   Templates
 * @author      Hecht MediaArts
 * @license      http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link           http://hechtmediaarts.com/evolution-framework/
 */

get_header(); global $data; ?></header>

<?php evolution_after_header();?>

<!-- - - - - - - - - - - - - - - - -  Main Content - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<div id="content-sidebar-wrap">
<div id="content">
  <div class="content-inner">
    <div class="entry_content">

      <?php while ( have_posts() ) : the_post(); ?>

      <div id="post-<?php the_ID();?>"<?php post_class();?>>

        <h1 class="post-title"><?php the_title();?></h1>

        <?php the_content();?>

        <?php $include_path = TEMPLATEPATH . '/inc/includes/'; require ($include_path . 'contact-form.php'); ?></div>
      <!-- end #post -->

      <?php endwhile;?>
    </div><!-- end div.entry_content --> 
  </div><!-- end div .content-inner -->
</div><!-- end div #content -->

<?php do_action( 'layout_structure' ); ?>

<?php evolution_after_content();?>

<?php get_footer();?>