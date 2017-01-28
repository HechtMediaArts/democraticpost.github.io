// sticky secondary nav menu
jQuery(function( $ ){
  $(window).scroll(function() {
    var yPos = ( $(window).scrollTop() );
    if(yPos > 200) { // show sticky menu after screen has scrolled down 200px from the top
      $("#top").fadeIn();
    } else {
      $("#top").fadeOut();
    }
  });
    
    
    /* Secondary Navigation ----------- */
#top { background-color: #444; width: 100%; display: none; position: fixed; top: 0; z-index: 999;}
#top p { margin: 0; float: left; max-width: 300px;}
#top p a { margin: 0;}
.menu-top-container { background-color: #444; overflow: hidden; max-width: 1152px; margin: 0 auto; }
#subnav {background-color: #444; width: 1152px; }
.evolution-nav-menu.menu-secondary {margin-top: 0;}
#subnav li:first-child {float: left; }
#subnav li.current-menu-item a:first-child {background: transparent;}
#subnav li {float: right;}
#subnav span.uppercase { margin-right: 6px; margin-right: 0.375rem;}
.subnav-left { float: left; padding: 12px 16px; padding: 0.75rem 1rem; }