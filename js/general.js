/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *  http://www.opensource.org/licenses/mit-license.php
 *  http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
  $.fn.superfish = function(op){

    var sf = $.fn.superfish,
      c = sf.c,
      $arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
      over = function(){
        var $$ = $(this), menu = getMenu($$);
        clearTimeout(menu.sfTimer);
        $$.showSuperfishUl().siblings().hideSuperfishUl();
      },
      out = function(){
        var $$ = $(this), menu = getMenu($$), o = sf.op;
        clearTimeout(menu.sfTimer);
        menu.sfTimer=setTimeout(function(){
          o.retainPath=($.inArray($$[0],o.$path)>-1);
          $$.hideSuperfishUl();
          if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
        },o.delay); 
      },
      getMenu = function($menu){
        var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
        sf.op = sf.o[menu.serial];
        return menu;
      },
      addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };
      
    return this.each(function() {
      var s = this.serial = sf.o.length;
      var o = $.extend({},sf.defaults,op);
      o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
        $(this).addClass([o.hoverClass,c.bcClass].join(' '))
          .filter('li:has(ul)').removeClass(o.pathClass);
      });
      sf.o[s] = sf.op = o;
      
      $('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
        if (o.autoArrows) addArrow( $('>a:first-child',this) );
      })
      .not('.'+c.bcClass)
        .hideSuperfishUl();
      
      var $a = $('a',this);
      $a.each(function(i){
        var $li = $a.eq(i).parents('li');
        $a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
      });
      o.onInit.call(this);
      
    }).each(function() {
      var menuClasses = [c.menuClass];
      if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
      $(this).addClass(menuClasses.join(' '));
    });
  };

  var sf = $.fn.superfish;
  sf.o = [];
  sf.op = {};
  sf.IE7fix = function(){
    var o = sf.op;
    if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
      this.toggleClass(sf.c.shadowClass+'-off');
    };
  sf.c = {
    bcClass     : 'sf-breadcrumb',
    menuClass   : 'sf-js-enabled',
    anchorClass : 'sf-with-ul',
    arrowClass  : 'sf-sub-indicator',
    shadowClass : 'sf-shadow'
  };
  sf.defaults = {
    hoverClass  : 'sfHover',
    pathClass : 'overideThisToUse',
    pathLevels  : 1,
    delay   : 800,
    animation : {opacity:'show'},
    speed   : 'normal',
    autoArrows  : true,
    dropShadows : true,
    disableHI : false,    // true disables hoverIntent detection
    onInit    : function(){}, // callback functions
    onBeforeShow: function(){},
    onShow    : function(){},
    onHide    : function(){}
  };
  $.fn.extend({
    hideSuperfishUl : function(){
      var o = sf.op,
        not = (o.retainPath===true) ? o.$path : '';
      o.retainPath = false;
      var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
          .find('>ul').hide().css('visibility','hidden');
      o.onHide.call($ul);
      return this;
    },
    showSuperfishUl : function(){
      var o = sf.op,
        sh = sf.c.shadowClass+'-off',
        $ul = this.addClass(o.hoverClass)
          .find('>ul:hidden').css('visibility','visible');
      sf.IE7fix.call($ul);
      o.onBeforeShow.call($ul);
      $ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
      return this;
    }
  });

})(jQuery);

jQuery(document).ready(function($) { 
  
  jQuery('.evolution-nav-menu').superfish({
    delay:       100,               // 0.1 second delay on mouseout 
    animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
    dropShadows: false                // disable drop shadows 
  });
  
});

//** jQuery Scroll to Top Control script- (c) I made this script myself (Kyle Monk) and it is hosted on my personal site so would appreciate if you followed my blog at kylemonk.tumblr.com if you use it or for details on how to change the location.
//** Graphic originally from tumbler dashboard, for details on how to change graphic colour, contact me at kylemonk.tumblr.com
//** v1.1 (April 7th, 10'):
//** 1) Adds ability to scroll to an absolute position (from top of page) or specific element on the page instead.
//** 2) Fixes scroll animation not working in Opera. fa fa-arrow-up


var scrolltotop={
  //startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
  //scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
  setting: {startline:100, scrollto: 0, scrollduration:1000, fadeduration:[500, 100]},
  controlHTML: '<span class="up"><div class="fa fa-arrow-up fa-3x" title="Beam me up, Scotty!"></div></span>', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
  controlattrs: {offsetx:40, offsety:120}, //offset of control relative to right/ bottom of window corner
  anchorkeyword: '#top', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links

  state: {isvisible:false, shouldvisible:false},

  scrollup:function(){
    if (!this.cssfixedsupport) //if control is positioned using JavaScript
      this.$control.css({opacity:0}) //hide control immediately after clicking it
    var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
    if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
      dest=jQuery('#'+dest).offset().top
    else
      dest=0
    this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
  },

  keepfixed:function(){
    var $window=jQuery(window)
    var controlx=$window.scrollLeft() + $window.width() - this.$control.width() - this.controlattrs.offsetx
    var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
    this.$control.css({left:controlx+'px', top:controly+'px'})
  },

  togglecontrol:function(){
    var scrolltop=jQuery(window).scrollTop()
    if (!this.cssfixedsupport)
      this.keepfixed()
    this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
    if (this.state.shouldvisible && !this.state.isvisible){
      this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
      this.state.isvisible=true
    }
    else if (this.state.shouldvisible==false && this.state.isvisible){
      this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
      this.state.isvisible=false
    }
  },
  
  init:function(){
    jQuery(document).ready(function($){
      var mainobj=scrolltotop
      var iebrws=document.all
      mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
      mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
      mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
        .css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety, right:mainobj.controlattrs.offsetx, opacity:0, cursor:'pointer'})
        .attr({title:'Back to Top'})
        .click(function(){mainobj.scrollup(); return false})
        .appendTo('body')
      if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='') //loose check for IE6 and below, plus whether control contains any text
        mainobj.$control.css({width:mainobj.$control.width()}) //IE6- seems to require an explicit width on a DIV containing text
      mainobj.togglecontrol()
      $('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
        mainobj.scrollup()
        return false
      })
      $(window).bind('scroll resize', function(e){
        mainobj.togglecontrol()
      })
    })
  }
}

scrolltotop.init();

// ========== Comment form =====================================================

jQuery(document).ready(function() {
	jQuery.noConflict();

function RevoToggle(classname,value) {
	jQuery(classname).focus(function() {
		if (value == jQuery(classname).val()) {
			jQuery(this).val('');
		}
	});
	jQuery(classname).blur(function() {
		if ('' == jQuery(classname).val()) {
			jQuery(this).val(value);
		}
	});
}

RevoToggle('input#comment-author', 'Name');
	RevoToggle('input#comment-email','E-Mail');
	RevoToggle('input#comment-url','Webseite');
	RevoToggle('textarea#comment','Kommentar');

});


/* =========================================================
Mobile menu
============================================================ */
jQuery(document).ready(function () {
     
    jQuery('#mobile-menu > span').click(function () {
 
        var mobile_menu = jQuery('#toggle-view-menu');
 
        if (mobile_menu.is(':hidden')) {
            mobile_menu.slideDown('300');
            jQuery(this).children('span').html('-');    
        } else {
            mobile_menu.slideUp('300');
            jQuery(this).children('span').html('+');    
        }     
         
    });
    
    jQuery('#toggle-view-menu li').click(function () {
 
        var text = jQuery(this).children('div.menu-panel');
 
        if (text.is(':hidden')) {
            text.slideDown('300');
            jQuery(this).children('span').html('-');    
        } else {
            text.slideUp('300');
            jQuery(this).children('span').html('+');    
        }
        
        jQuery(this).toggleClass('active');
         
    });
 
});

/** Add nofollow to De:comments Link */
jQuery(document).ready(function($){
  // add nofollow to comment section
  $("a.decomments-affilate-link").attr("rel", "nofollow");

});