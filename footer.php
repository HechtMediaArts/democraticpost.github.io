<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the footer structure.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

 ?>

<?php evolution_before_footer();?>
<div class="clearfix"></div>
<div class="breadcrumb2" typeof="BreadcrumbList" vocab="http://schema.org/">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
<footer class="clearfix" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

<?php do_action( 'evolution_footer_menu' ); ?>

<div class="inner">
<?php do_action( 'evolution_footer' ); ?>
</div>

<p class="footer-impressum"><a href="https://www.democraticpost.de/kontakt/">Kontakt</a>  |  <a href="https://www.democraticpost.de/impressum/">Impressum</a></p>

	<div id="colophon">
    	<p>
        <?php echo ah_dynamic_copyright(); ?> <?php bloginfo();?>. <?php _e('Alle Rechte vorbehalten. | Hergestellt mit <span class="fa fa-heart"></span> und viel Kaffee in Hamburg
        von <a href="http://andreas-hecht.com/">Andreas Hecht</a>', 'revothemes') ?>
			</p>
    </div>
</footer>

<?php evolution_after_footer();?> 

</div><!-- end #wrap -->
<?php if ( is_single() || is_page('neu-hier-lies-mich') ) : ?>
<link rel="stylesheet" href="<?=auto_version('/wp-content/themes/democraticpost-1.3.0/css/mashshare.min.css')?>" type="text/css" media="screen" property='stylesheet' />
<link rel='stylesheet'  href='<?=auto_version('/wp-content/plugins/decomments/templates/decomments/assets/css/decom.css')?>' type='text/css' media='all' property='stylesheet' />
<link rel="stylesheet" href="<?=auto_version('/wp-content/themes/democraticpost-1.3.0/css/print.css')?>" type="text/css" media="print" property='stylesheet' />
<?php endif; ?>
<?php if ( is_single('4368') ) : ?>
<link rel="stylesheet" href="<?=auto_version('/wp-includes/js/mediaelement/mediaelementplayer.min.css')?>" type="text/css" media="screen" />
<?php endif; ?>
<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.5.0/font-awesome.min.css" type='text/css' media='all' property='stylesheet' />
<!-- Google Analytics Code -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-63631951-1', 'auto');
  ga('send', 'pageview');
  setTimeout("ga('send','event','Interessierte Nutzer','Mehr als 30 Sekunden')",30000);
</script>
<!-- END Google Analytics Code -->
<?php wp_footer();?>
</body>
</html>