<?php
/*----------------------------------------------------------------------------*/
/*  The Evolution Sidebar Box Widget - 1.0.5 */
/*----------------------------------------------------------------------------*/

/* One Box to rule them all... */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'evolution_load_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function evolution_load_widgets() {
	register_widget( 'Evolution_Widget_Asidebox' );
}

class Evolution_Widget_Asidebox extends WP_Widget {


	function __construct() {
		$widget_ops = array('classname' => 'evolution_widget_asidebox', 'description' => __( 'Zeigt ein cooles jQuery Tab-Widget mit den beliebtesten Beiträgen, den letzten Kommentaren, den neuesten Beiträgen, den Kategorien, einer Tag-Cloud und dem Archiv an.', 'evolution') );
		parent::__construct('evolution_sidebar_box', __('Evolution Sidebar Box'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title'], $instance, $this->id_base);

		echo $before_widget='<div class="widget-box">';
		if ( $title )
			echo $before_title . $title . $after_title;


?>

<div id="sidebarbox">
		<ul id="tabMenu">
			<li class="famous selected" title="<?php  _e(' Famous Posts', 'revothemes');?>">
			</li>
			<li class="commentz" title="<?php  _e(' Last Comments', 'revothemes');?>">
			</li>
			<li class="posts" title="<?php  _e(' Recent Posts', 'revothemes');?>">
			</li>
			<li class="category" title="<?php  _e(' Categories', 'revothemes');?>">
			</li>
			<li class="random" title="<?php  _e(' Tag Cloud', 'revothemes');?>">
			</li>
            <li class="archiveslist" title="<?php  _e(' Archives', 'revothemes');?>">
            </li>
		</ul>
		<div class="boxBody">
	  	<div id="famous" class="show">
				<h5 class="tabmenu_header">
				<?php  _e('Beliebte Beiträge', 'revothemes');?>
				</h5>
				<ul id="popular-comments">
					<?php
							$the_query = new WP_Query('showposts=5&ignore_sticky_posts=1&orderby=comment_count');	
							while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<li>
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php evolution_sidebarbox_images(); ?>
						</a>
						<span>
							<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php the_title();?>
							</a>
						</span>
						<p>
							Geschrieben von
							<strong>
							<?php the_author() ?>
							</strong> am
							<?php the_time('d F Y') ?> mit
							<?php comments_popup_link('Keinen Kommentaren;', '1 Kommentar', '% Kommentaren');?>
						</p>
					</li>
					<?php endwhile;?>
					<?php wp_reset_query(); ?>
				</ul>
			</div>		
<div id="commentzz">
				<h5 class="tabmenu_header">
				<?php  _e(' Letzte Kommentare', 'revothemes');?>
				</h5>
				<ul class="wet_recent_comments">
					<?php evolution_recent_comments();?>
				</ul>
			</div>
		<div id="posts">
				<h5 class="tabmenu_header">
				<?php  _e('Neueste Beiträge', 'revothemes');?>
				</h5>
				<ul class="recent_articles">
					<?php
							$the_query = new WP_Query('showposts=5&ignore_sticky_posts=1');	
							while ($the_query->have_posts()) : $the_query->the_post(); ?>
						<li class="clearfix">
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php evolution_sidebarbox_images(); ?>
						</a>
						<span class="title-link">
							<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<?php the_title();?>
							</a>
						</span>
						<p><?php echo substr(get_the_excerpt(), 0,65); ?></p>
							<?php endwhile;?>
					<?php wp_reset_query(); ?>	
				</li>
				</ul>
			</div>
			<div id="category">
				<h5 class="tabmenu_header">
				<?php  _e('Kategorien', 'revothemes');?>
				</h5>
				<ul class="category_list">
					<?php wp_list_categories('show_count=1&title_li=');?>
				</ul>
			</div>
			<div id="random">
				<h5 class="tabmenu_header">
				<?php  _e('Tag Cloud', 'revothemes');?>
				</h5>
				<?php if (function_exists('wp_tag_cloud')) { ?>
				<span id="sidebar-tagcloud">
					<?php wp_tag_cloud('smallest=10&largest=18');?>
				</span>
				<?php }?>
			</div>
            <div id="archiveslist">
				<h5 class="tabmenu_header">
				<?php  _e('Archive', 'revothemes');?>
				</h5>
            <ul>
            <?php wp_get_archives('monthly&show_post_count=1', '', 'html', '', '', TRUE); ?>
            </ul>
			</div>
		</div><!-- end div.boxBody -->
	</div><!-- end sidebarbox -->
<?php
		echo $after_widget='</div><!-- end .widget-box -->';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}