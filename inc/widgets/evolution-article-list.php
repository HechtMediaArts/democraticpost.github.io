<?php
/**
 * Small Articles List Widget Class
 * @since FastNews 1.0
 */
class Kopa_Widget_Small_Articles_List extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kp-small-list-widget', 'description' => __('Display Latest Articles Widget', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_small_articles_list', __('Kopa Small Articles List', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $query_args = array();
		$query_args['categories'] = empty($instance['categories']) ? array() : $instance['categories'] ;
		$query_args['relation'] = isset($instance['relation']) ? $instance['relation'] : 'OR' ;
        $query_args['tags'] = empty($instance['tags']) ? array() : $instance['tags'] ;
        $query_args['posts_per_page'] = isset($instance['number_of_article']) ? $instance['number_of_article'] : -1 ;
        $query_args['orderby'] = isset($instance['orderby']) ? $instance['orderby'] : 'latest' ;
		if (isset($instance['kopa_timestamp'])){
			$query_args['date_query'] = $instance['kopa_timestamp'];
		}
        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        $posts = kopa_widget_posttype_build_query( $query_args );
        ?>

        <?php if ( $posts->have_posts() ) {
            $post_index = 1; ?>

            <ul class="clearfix">
            
            <?php while ( $posts->have_posts() ) { 
                $posts->the_post();
                ?>

                <li>
                    <article class="entry-item">

                       
                        <div class="entry-thumb videolist">
                           <?php if ( has_post_format( 'video' ) ) : ?>

                           <?php echo democratic_post_video_thumbnails_widget() ?>                         
                            
                             <?php elseif ( has_post_format( 'gallery' ) ) : ?>
                             <?php echo democratic_post_gallery_thumbnails_widget() ?>
                             <?php else : ?>  
                                       
                            <?php echo democratic_post_thumbnails_widget() ?>
                                                                         
                             <?php endif; ?>
                                                        
                        </div>
                        <!-- entry-thumb -->
                        

                        <div class="entry-content">
                            <h4 class="entry-title-sidebar"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                            <?php // the_excerpt(); ?>
                        </div>
                    </article>
                </li>

                <?php
                if ( $post_index % 2 == 0 ) {
                    echo '<div class="clear"></div>';
                }

                // increases post index by 1
                $post_index++;
                ?>

            <?php } // endwhile ?>

            </ul>
            
        <?php } // endif ?>

        <?php
        wp_reset_postdata();

        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title'             => '',
            'categories'        => array(),
            'relation'          => 'OR',
            'tags'              => array(),
            'number_of_article' => 3,
            'orderby'           => 'latest',
			'kopa_timestamp' => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
		$form['kopa_timestamp'] = $instance['kopa_timestamp'];

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'AND' => __('And', kopa_get_domain()),
                    'OR' => __('Or', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'latest' => __('Latest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain()),
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
		<?php 
		kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']);?>

        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];
        // validate number of article
        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 3;
        }
        $instance['orderby'] = $new_instance['orderby'];
		$instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        return $instance;
    }
}

function kopa_widgets_init() {

    register_widget('Kopa_Widget_Small_Articles_List');
    
}
add_action('widgets_init', 'kopa_widgets_init');





function kopa_widget_article_build_query($query_args = array()) {
    $args = array(
        'post_type' => array('post'),
        'posts_per_page' => $query_args['number_of_article']
    );

    $tax_query = array();

    if ($query_args['categories']) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $query_args['categories']
        );
    }
    if ($query_args['tags']) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $query_args['tags']
        );
    }
    if ($query_args['relation'] && count($tax_query) == 2) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ($tax_query) {
        $args['tax_query'] = $tax_query;
    }

    switch ($query_args['orderby']) {
        case 'popular':
            $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
            $args['orderby'] = 'meta_value_num';
            break;
        case 'most_comment':
            $args['orderby'] = 'comment_count';
            break;
        case 'random':
            $args['orderby'] = 'rand';
            break;
        default:
            $args['orderby'] = 'date';
            break;
    }
    if (isset($query_args['post__not_in']) && $query_args['post__not_in']) {
        $args['post__not_in'] = $query_args['post__not_in'];
    }
    return new WP_Query($args);
}

function kopa_widget_posttype_build_query( $query_args = array() ) {
    $default_query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post__not_in'   => array(),
        'ignore_sticky_posts' => 1,
        'categories'     => array(),
        'tags'           => array(),
        'relation'       => 'OR',
        'orderby'        => 'latest',
        'cat_name'       => 'category',
        'tag_name'       => 'post_tag'
    );

    $query_args = wp_parse_args( $query_args, $default_query_args );

    $args = array(
        'post_type'           => $query_args['post_type'],
        'posts_per_page'      => $query_args['posts_per_page'],
        'post__not_in'        => $query_args['post__not_in'],
        'ignore_sticky_posts' => $query_args['ignore_sticky_posts']
    );

    $tax_query = array();

    if ( $query_args['categories'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['cat_name'],
            'field'    => 'id',
            'terms'    => $query_args['categories']
        );
    }
    if ( $query_args['tags'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['tag_name'],
            'field'    => 'id',
            'terms'    => $query_args['tags']
        );
    }
    if ( $query_args['relation'] && count( $tax_query ) == 2 ) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ( $tax_query ) {
        $args['tax_query'] = $tax_query;
    }

    switch ( $query_args['orderby'] ) {
    case 'popular':
        $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
        $args['orderby'] = 'meta_value_num';
        break;
    case 'most_comment':
        $args['orderby'] = 'comment_count';
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    default:
        $args['orderby'] = 'date';
        break;
    }
	
	if ( isset($query_args['date_query']) && $query_args['date_query'] ){
        global $wp_version;
        $timestamp =  $query_args['date_query'];
        if (version_compare($wp_version, '3.7.0', '>=')) {
            if (isset($timestamp) && !empty($timestamp)) {
                $y = date('Y', strtotime($timestamp));
                $m = date('m', strtotime($timestamp));
                $d = date('d', strtotime($timestamp));
                $args['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }
    }
	
    return new WP_Query( $args );
}


/*
 * Kopa get time ago
 */
function kopa_print_timeago($field_id, $field_name, $selected_timeago, $is_admin = false){
    $timeago = array(
        'label' => __('Timestamp (ago)', kopa_get_domain()),
        'options' => array(
            '' => __('-- Select --', kopa_get_domain()),
            '-1 week' => __('1 week', kopa_get_domain()),
            '-2 week' => __('2 weeks', kopa_get_domain()),
            '-3 week' => __('3 weeks', kopa_get_domain()),
            '-1 month' => __('1 months', kopa_get_domain()),
            '-2 month' => __('2 months', kopa_get_domain()),
            '-3 month' => __('3 months', kopa_get_domain()),
            '-4 month' => __('4 months', kopa_get_domain()),
            '-5 month' => __('5 months', kopa_get_domain()),
            '-6 month' => __('6 months', kopa_get_domain()),
            '-7 month' => __('7 months', kopa_get_domain()),
            '-8 month' => __('8 months', kopa_get_domain()),
            '-9 month' => __('9 months', kopa_get_domain()),
            '-10 month' => __('10 months', kopa_get_domain()),
            '-11 month' => __('11 months', kopa_get_domain()),
            '-1 year' => __('1 year', kopa_get_domain()),
            '-2 year' => __('2 years', kopa_get_domain()),
            '-3 year' => __('3 years', kopa_get_domain()),
            '-4 year' => __('4 years', kopa_get_domain()),
            '-5 year' => __('5 years', kopa_get_domain()),
            '-6 year' => __('6 years', kopa_get_domain()),
            '-7 year' => __('7 years', kopa_get_domain()),
            '-8 year' => __('8 years', kopa_get_domain()),
            '-9 year' => __('9 years', kopa_get_domain()),
            '-10 year' => __('10 years', kopa_get_domain()),
        )
    );
    if ($is_admin) {
        $str_ret = '';
        $str_ret .= '<span class="kopa-component-title">'. __($timeago['label'], kopa_get_domain()) . '</span>';
        $str_ret .= '<select class="widefat" name="' . $field_name . '" id="' . $field_id . '" class="kopa-ui-taxonomy kopa-ui-select form-control">';
        foreach ($timeago['options'] as $k => $v){
            if ($selected_timeago === $k){
                $str_ret .= '<option value="' . $k . '" selected>' . $v . '</option>';
            } else {
                $str_ret .= '<option value="' . $k . '">' . $v . '</option>';
            }

        }
        $str_ret .= '</select>';
    } else {
        $str_ret = '<p>';
        $str_ret .= '<label for="'.$field_id.'">'. __($timeago['label'], kopa_get_domain()) . '</label>';
        $str_ret .= '<select class="widefat" name="' . $field_name . '" id="' . $field_id . '">';
        foreach ($timeago['options'] as $k => $v){
            if ($selected_timeago === $k){
                $str_ret .= '<option value="' . $k . '" selected>' . $v . '</option>';
            } else {
                $str_ret .= '<option value="' . $k . '">' . $v . '</option>';
            }

        }
        $str_ret .= '</select>';
        $str_ret .= '</p>';
    }

    echo $str_ret;
}
