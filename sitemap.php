<div class="elements-box">
<div id="post-<?php the_ID();?>" <?php post_class();?>>
<div class="inhalt">                
<div class="sitemap">
<p class="note">Hier finden Sie alle Nachrichten, Schlagzeilen und Beiträge des Tages. Weiterhin alle Seiten, die Feed-Adressen, sowie die Archive nach Monat. Wir listen hier ebenfalls alle Ressorts mit RSS-Feed und die vergebenen Schlagworte auf.
</p>


<?php   
$day = date('j');
query_posts('day='.$day); 
if (have_posts()) : the_post();
?>
<div class="artikel-0f-Day">
<h4>Unsere Beiträge vom <?php echo get_the_date(); ?></h4>                      
<ul class="none"> 
<?php endif; ?>
<?php 
// Limit query posts to the current day
$args = array(
    'year' => (int) date( 'Y' ),    
    'monthnum' => (int) date( 'n' ),    
    'day' => (int) date( 'j' ), 
);

$query1 = new WP_Query( $args );

// The Loop
while ( $query1->have_posts() ) :
    $query1->the_post();
?>
<li><span class="cat"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="Beitrag ansehen: <?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
<?php wp_reset_query() ?>
</ul><!-- Ende neueste Artikel des Tages -->
</div>

<h4>Archiv nach Jahr und Monat</h4>
<ul class="archivliste">  
<?php compact_archive($style='block', $before='<li>', $after='</li>'); ?>
</ul>
<div class="clearfix"></div> 



                                                                                                                                                                                                                                
<div class="evo-half">
   <h4>Alle Autoren</h4>
    <ul class="author">
    <?php
    wp_list_authors(
      array(
        'exclude_admin' => false,
      )
    );
    ?>
    </ul>
<div class="clearfix"></div>
       
    <h4>Alle Seiten</h4>
    <ul>
        <?php wp_list_pages("title_li=");?>
    </ul>
    </div>    

   
<div class="evo-half evo-last">
<h4>Archiv nach Ressort</h4>
<ul>
<?php wp_list_categories('orderby=name&show_count=1&feed=RSS&hierarchical=1'); ?>
</ul>
    </div>
    <div class="clearfix"></div>
    <h4>Themen (vergebene Schlagworte)</h4>
    <?php if (function_exists('wp_tag_cloud')) { ?>
        <div class="tagcloud">
        <?php wp_tag_cloud('smallest=10&largest=18&number=0');?>
    </div>                                                                                  

    <?php }?>
                        
    
    </div><!-- end sitemap-archiv -->
    </div><!-- End inhalt -->
</div><!-- end #post -->
</div><!-- end .elements-box -->            
				