<?php
/**
 * Alle Autoren mit Autorenbox für Autorenübersicht
 * 
 */ 

/**
 * Shortcode für die Listung aller Autorenboxen
 * @author Andreas Hecht
 * => 1, 2, 3  =  Andreas, Nicole, Martin        
 */
function democratic_display_all_autorboxes() { 

return '
<div class="clearfix"></div>
<!-- Andreas Hecht -->
<div class="about-author autorenseite clearfix">
<div class="about-author-detail-autorenseite clearfix">
<a class="avatar-thumb" href="https://www.democraticpost.de/author/andreashecht/"><img alt="" src="https://secure.gravatar.com/avatar/f0aec270bee547ec325e64ee97fe7223?s=300&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f0aec270bee547ec325e64ee97fe7223?s=300&amp;d=mm&amp;r=g 2x" class="avatar avatar-150 photo" height="150" width="150" originals="150" src-orig="https://secure.gravatar.com/avatar/f0aec270bee547ec325e64ee97fe7223?s=150&amp;d=mm&amp;r=g" scale="2"></a>
<div class="author-content">
<header>                              
<h6><a href="https://www.democraticpost.de/author/andreashecht/">Andreas Hecht</a><span>Herausgeber und Redakteur</span></h6>
</header>
<p>geboren 1968 in Bremen. Er gründete im Juli 2015 zusammen mit Nicole Hahn die Democratic Post und ist Mitglied der Redaktion. Journalistische Arbeit u.a. bei "Dr. Web Magazin", "NEOPresse" und "Huffington Post", nebenbei <a href="http://www.amazon.de/-/e/B00OP7X9KM/ref=dp_byline_sr_ebooks_1?ie=UTF8&amp;text=Andreas+Hecht&amp;search-alias=digital-text&amp;field-author=Andreas+Hecht&amp;sort=relevancerank" rel="nofollow">Autor mehrerer E-Books</a> zu den Themen Lebenshilfe, Marketing und WordPress.</p>
<div class="simple-social-icons">
<ul>
<li class="social-rss"><a href="https://www.democraticpost.de/author/andreashecht/feed/" target="_blank"><i class="fa fa-rss"></i></a></li>
<li class="social-twitter"><a href="https://twitter.com/democraticpost" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li class="social-facebook"><a href="https://www.facebook.com/democraticpost" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li class="social-gplus"><a href="https://plus.google.com/+DemocraticpostDeHH/about" target="_blank"><i class="fa fa-google-plus"></i></a></li>															</ul>
</div>
</div>
</div>
</div>

<div class="about-author autorenseite clearfix">
<div class="about-author-detail-autorenseite clearfix">
<a class="avatar-thumb" href="https://www.democraticpost.de/author/nicolehahn/"><img alt="" src="https://secure.gravatar.com/avatar/73cb3b4ffc97a784c0b0bcc39f151a00?s=300&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/73cb3b4ffc97a784c0b0bcc39f151a00?s=300&amp;d=mm&amp;r=g 2x" class="avatar avatar-150 photo" height="150" width="150" originals="150" src-orig="https://secure.gravatar.com/avatar/73cb3b4ffc97a784c0b0bcc39f151a00?s=150&amp;d=mm&amp;r=g" scale="2"></a>
<div class="author-content">
<header>                              
<h6><a href="https://www.democraticpost.de/author/nicolehahn/">Nicole Hahn</a><span>Herausgeberin und Redakteurin</span></h6>
</header>
<p>wurde 1962 in Hamburg geboren.
Sie gründete im Juli 2015 zusammen mit Andreas Hecht die Democratic Post und ist Mitglied der Redaktion.</p>
<div class="simple-social-icons">
<ul>
<li class="social-rss"><a href="https://www.democraticpost.de/author/nicolehahn/feed/" target="_blank"><i class="fa fa-rss"></i></a></li>
<li class="social-twitter"><a href="https://twitter.com/democraticpost" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li class="social-facebook"><a href="https://www.facebook.com/democraticpost" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li class="social-gplus"><a href="https://plus.google.com/+DemocraticpostDeHH/about" target="_blank"><i class="fa fa-google-plus"></i></a></li>															</ul>
</div>
</div>
</div>
</div>

<div class="about-author autorenseite margins clearfix">
<div class="about-author-detail-autorenseite clearfix">
<a class="avatar-thumb" href="https://www.democraticpost.de/author/martin-podlasly/"><img alt="" src="https://secure.gravatar.com/avatar/cd13c59e6eef3e45c305f602da00dc3a?s=300&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/cd13c59e6eef3e45c305f602da00dc3a?s=300&amp;d=mm&amp;r=g 2x" class="avatar avatar-150 photo" height="150" width="150" originals="150" src-orig="https://secure.gravatar.com/avatar/cd13c59e6eef3e45c305f602da00dc3a?s=150&amp;d=mm&amp;r=g" scale="2"></a>
<div class="author-content">
<header>                              
<h6><a href="https://www.democraticpost.de/author/martin-podlasly/">Martin Podlasly</a><span>Freier Autor</span></h6>
</header>
<p>Martin R. Podlasly, geb. 01.03.1966 in Hamburg, ehemaliger Polizeibeamter des Bundes und des Landes Hamburg. 
Veröffentlichungen diverser Publikationen, freier Autor</p>
</div>
</div>
</div>
<div class="clearfix"></div>';
 }
add_shortcode( 'evolution_authors', 'democratic_display_all_autorboxes' );
