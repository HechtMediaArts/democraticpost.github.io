<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part('library/templates/format-single', get_post_format());
        ?>
        <?php if (get_the_terms(get_the_ID(), 'post_tag')) { ?>

            <div class="post-tags">
               <header><span>Themen:</span></header>
                <?php the_tags('', ' ', ''); ?>
            </div><!--tag-box-->
        <?php } // endif ?>
        
        <?php democratic_readability_buttons(); ?>
        
        <div class="startseite">
            <center><a href="http://www.democraticpost.de" title="Zurück zur Startseite gehen">Hier geht es zurück zur Startseite</a></center>
        </div>

        <?php  kopa_get_about_author(); ?>

        <?php // Related Articles werden über Jetpack eingefügt. | kopa_get_related_articles(); ?>
            
        <?php 
        if(comments_open() ){
        comments_template(); 
        }
        ?>

    <?php
    } // endwhile
} // endif


