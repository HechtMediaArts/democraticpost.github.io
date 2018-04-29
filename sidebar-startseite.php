<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the main sidebar.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */
?>

<!-- - - - - - - - - - - - - - - - -  Sidebar - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

<?php evolution_before_sidebar();?>

<aside id="sidebar" class="sidebar">
<div class="aside-inner">
<!-- Social Networks -->      
<div id="democratic_social_follow-2" class="widget democratic_social_follow_widget">
 <div class="widget-wrap">
  <div class="widgettitle">Soziale Netzwerke</div>
   <div class="social-buttons">
                <ul>
                    <li class="social-facebook"><a href="https://www.facebook.com/democraticpost" target="_blank" title="Unsere Facebook Seite liken"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-twitter"><a href="https://twitter.com/democraticpost" target="_blank" title="Folgen Sie uns auf Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-gplus"><a href="https://plus.google.com/+DemocraticpostDeHH/posts" target="_blank" title="Folgen Sie uns auf Google+"><i class="fa fa-google-plus"></i></a></li>
                    <li class="social-rss"><a href="http://feeds.feedburner.com/democraticpost" target="_blank" title="Abonnieren Sie unseren RSS-Feed"><i class="fa fa-rss"></i></a></li>
               </ul>
    </div>
</div>
</div>
<!-- END Social Networks -->    
<?php dynamic_sidebar( 'startseite' ); ?>
<!-- Buch Werbung -->
<!--<div id="text-buch" class="widget widget_text">
<div class="widget-wrap">
<div class="widgettitle">Unsere E-Books für Sie</div>
<div class="textwidget">
<a href="http://amzn.to/1Qs9IWX" target="_blank" rel="nofollow">
<img src="https://www.democraticpost.de/wp-content/uploads/2016/04/cover.jpg" alt="Werbung eBook" width="300" height="479" />
</a>
<p><a class="evo-button" href="http://amzn.to/1Qs9IWX" target="_blank" rel="nofollow">Bei Amazon für nur 3,99 € kaufen »</a></p>
</div>
</div>
</div>-->
<!-- END Buch Werbung -->
<!-- Buch Werbung -->
<!--<div id="text-buch-2" class="widget widget_text">
<div class="widget-wrap">
<div class="widgettitle">E-Book Internet-Marketing</div> 
<div class="textwidget">
<a href="http://amzn.to/1W2Ra1F" target="_blank" rel="nofollow">
<img src="https://www.democraticpost.de/wp-content/uploads/2016/04/cover-1.jpg" alt="Werbung eBook" width="300" height="479" />
</a>
<p><a class="evo-button" href="http://amzn.to/1W2Ra1F" target="_blank" rel="nofollow">Bei Amazon für nur 3,49 € kaufen »</a></p>
</div>
</div>
</div>-->
<!-- END Buch Werbung -->
</div><!-- end div .aside-inner -->
</aside><!-- end aside -->

<?php evolution_after_sidebar();?>