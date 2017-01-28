<div class="page-title">
<?php if( is_category() ) : ?>
    <h1 class="entry-title"><?php _e('Ressort', 'revothemes');?><span class="name"><?php echo single_cat_title();?></span></h1>
    <div class="cat-description"><?php echo category_description(); ?></div>
<?php endif; ?>

<?php if( is_home() ) : ?>
   <h1 class="entry-title"><?php _e('Alle Beiträge', 'revothemes');?><span class="name">Chronologisch gelistet</span></h1>
    <div class="cat-description"><p><?php do_action('wpseo_the_desc') ?></p></div>
<?php endif; ?>

<?php if ( is_tag() ) :?>
    <h1 class="entry-title"><?php _e('Schlagwort', 'revothemes');?><span class="name"><?php echo single_tag_title();?></span></h1>
<?php endif; ?>

<?php if ( is_day() ) : ?>
    <h1 class="entry-title"><?php _e('Tag', 'wilson'); ?><span class="name"><?php echo get_the_date(); ?></span></h1>                       
				
<?php elseif ( is_month() ) :?>
<h1 class="entry-title"><?php _e('Monat', 'wilson'); ?><span class="name"><?php echo get_the_date('F Y'); ?></span></h1>           
            
<?php elseif ( is_year() ) :?>
<h1 class="entry-title"><?php _e('Jahr', 'wilson'); ?><span class="name"><?php echo get_the_date('Y'); ?></span></h1>             
<?php endif; ?>
</div>