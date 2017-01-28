<?php

/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Handles the index structure - this is the blog template.
 *
 * @category 	Evolution
 * @package  	Templates
 * @author   		Hecht MediaArts
 * @license  		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     			http://hechtmediaarts.com/evolution-framework/
 */
?>
<h1 class="suchergebnisse">Keine Suchergebnisse für: <mark><?php printf(the_search_query());?></mark></h1>

<li class="element">

<h3 class="search">Es konnte leider nichts gefunden werden</h3>

<p>Entschuldigung, aber kein Eintrag erfüllt ihre Suchkriterien. Bitte starten Sie eine neue Suche.</p>

<p><strong>Bitte beachten Sie folgende Hinweise, um bessere Suchergebnisse zu bekommen:</strong></p>
<ul class="suchseite">
    <li>Überprüfen Sie die Rechtschreibung.</li>
    <li>Suchen Sie nach ähnliche Suchbegriffe, z.B. Notebook statt Laptop, etc.</li>
    <li>Versuchen Sie mehr als einen Suchbegriff zu verwenden.</li>
</ul>
<div class="suche">
<?php get_search_form(); ?>
</div>
</li>