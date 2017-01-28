<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Admin Custom hooks file.
 *
 * @category Evolution Framework
 * @package  Admin
 * @author   Hecht MediaArts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.hechtmediaarts.com/themes/evolution
 */

add_action( 'before_wrap', 'evolution_before_wrap' );

		function evolution_before_wrap() {

		echo of_get_option( 'before_wrap' );

}


add_action( 'before_header', 'evolution_before_header' );

		function evolution_before_header() {

		echo of_get_option( 'before_header' );

}


add_action( 'after_header', 'evolution_after_header' );

		function evolution_after_header() {

		echo of_get_option( 'after_header' );

}


add_action( 'before_nav', 'evolution_before_nav' );

		function evolution_before_nav() {

		echo of_get_option( 'before_nav' );

}


add_action( 'after_nav', 'evolution_after_nav' );

		function evolution_after_nav() {

		echo of_get_option( 'after_nav' );

}


add_action( 'before_post', 'evolution_before_post' );

		function evolution_before_post() {

		echo of_get_option( 'before_post' );

}

add_action( 'after_posts', 'evolution_after_post' );

		function evolution_after_post() {

		echo of_get_option( 'after_posts' );

}


add_action( 'before_content', 'evolution_before_content' );

	function evolution_before_content() {

		echo of_get_option( 'before_content' );

} 



add_action( 'after_content', 'evolution_after_content' );

	function evolution_after_content() {

		echo of_get_option( 'after_content' );

}


add_action( 'before_comments', 'evolution_before_comments' );

	function evolution_before_comments() {

		echo of_get_option( 'before_comments' );

}


add_action( 'before_sidebar', 'evolution_before_sidebar' );

	function evolution_before_sidebar() {

		echo of_get_option( 'before_sidebar' );

}


add_action( 'after_sidebar', 'evolution_after_sidebar' );

	function evolution_after_sidebar() {

		echo of_get_option( 'after_sidebar' );

}


add_action( 'before_footer', 'evolution_before_footer' );

	function evolution_before_footer() {

		echo of_get_option( 'before_footer' );

}


add_action( 'after_footer', 'evolution_after_footer' );

	function evolution_after_footer() {

		echo of_get_option( 'after_footer' );

}

add_action( 'wp_head', 'evolution_wp_head' );

	function evolution_wp_head() {

		echo of_get_option( 'wp_head' );

}


add_action( 'wp_footer', 'evolution_wp_footer' );

	function evolution_wp_footer() {

		echo of_get_option( 'wp_footer' );

}

/**
 * 
 * Function for per post / page custom scripts meta box
 * 
 */

add_action( 'wp_footer', 'evolution_custom_footer_scripts' );

	function evolution_custom_footer_scripts() {

		echo rwmb_meta( 'Evolution_scripts' );

}

