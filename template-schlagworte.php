<?php
/**
* Template Name: Schlagwortregister
*
*/

get_header();
?>

</header>
<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
<?php if(function_exists('bcn_display'))
{
bcn_display();
}?>
</div>  

<?php evolution_after_header();?>

<!-- - - - - - - - - - - - - - - - -  Main Content - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<div id="content-sidebar-wrap">

	<?php evolution_before_content();?>

		<div id="content" role="main">
			<div class="content-inner">
				<div class="entry_content">

					<?php if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

    <div id="page-<?php the_ID(); ?>" <?php post_class( 'elements-box-page' ); ?>>
       
       <header class="page">
        <h1 class="entry-title">Schlagwortregister</h1>
        </header>
<?php if ( has_post_thumbnail() ) : ?>        

        <div class="entry-thumb">

            <?php the_post_thumbnail( 'thumbnail' ); ?>
               
        </div><!-- entry-thumb  -->
        <div class="clearfix"></div>  
             
     <?php endif; ?>       
        
<div class="elements-box">
<p class="note">Hier finden Sie alle vergebenen Schlagworte in alphabetischer Ordnung vor.
</p> 

<?php

     $list = '';
	$tags = get_terms('post_tag' );
	$groups = array();
	if( $tags && is_array( $tags ) ) {
		foreach( $tags as $tag ) {
			$first_letter = strtoupper( $tag->name[0] );
			$groups[ $first_letter ][] = $tag;
		}
			if( !empty( $groups ) ) {{
          	$index_row .='<ul class="topindex">';
         foreach ($groups as $letter => $tags) {
           	$index_row .= '<li><h4 class="tagindex"><a href="#' . $letter . '" title="' . $letter . '">' . apply_filters( 'the_title', $letter ) . '</a></h4></li>';
		}
				$index_row .='</ul><br class="clear" />';} 

				 $list .= '<ul class="index">';
			 foreach( $groups as $letter => $tags ) {
            $list .= '<li><a name="' . $letter . '"></a><h5><a href="#tags_top" title="back to top">' . apply_filters( 'the_title', $letter ) . '</a></h5>';
				$list .= '<ul class="links">';
				foreach( $tags as $tag ) {
               $url = attribute_escape( get_tag_link( $tag->term_id ) );
					$name = apply_filters( 'the_title', $tag->name );
               $list .= '<li><a title="' . $name . '" href="' . $url . '">' . $name . '</a></li>';

	} 		 $list .= '</ul></li>';
			} 	$list .= '</ul>';
		}
	}else $list .= '<p>Sorry, but no tags were found</p>';

	?>
<a name="tags_top"></a>
<?php print $index_row; ?>
<div id="columns">
<?php print $list; ?>
</div>                                     
                  
</div><!-- elements-box -->
</div><!-- page -->

<?php } // endwhile
} // endif
?>

				</div><!-- end div.entry_content -->
      </div><!-- end div .content-inner -->
    </div><!-- end div #content -->

    <?php do_action( 'layout_structure' ); ?>

    <?php evolution_after_content();?>
    

<?php get_footer();?>