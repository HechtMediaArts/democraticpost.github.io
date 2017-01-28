<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * the search form.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */

?>
<form action="<?php echo home_url();?>" method="get" role="search">
	<div class="search-container">
		<input type="text" class="navsearch" id="s" size="15" name="s" onblur="if(this.value=='') this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue) this.value='';" value="<?php _e('Suchwort eingeben', 'revothemes');?>" />
		<input type="submit" value="&#xf002;" class="fa fa-search" title="<?php _e('Suche abschicken', 'revothemes');?>" />
	</div>
</form>