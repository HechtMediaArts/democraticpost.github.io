jQuery(document).ready(function($) {

	jQuery(".zilla-tabs").tabs({ fx: { opacity: 'show' } });
	
	jQuery(".zilla-toggle").each( function () {
		if($(this).attr('data-id') == 'closed') {
			jQuery(this).accordion({ header: '.zilla-toggle-title', collapsible: true, active: false  });
		} else {
			jQuery(this).accordion({ header: '.zilla-toggle-title', collapsible: true});
		}
	});
	
	
});