<?php

/**
*
* Einbindung von Google Analytics und dem Opt-Aut Code
*
*/ ?>

<?php // include_once( "analyticstracking.php" ) ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-63631951-1', 'auto');
  ga('send', 'pageview');
  setTimeout("ga('send', 'event', 'unbounce', '20_sec')", 20000);
</script>
<!-- Ende Google Analytics Script -->