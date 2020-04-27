<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><hr>
<pre>
<b>SESSION</b>
<?= var_dump($_SESSION) ?>
<b>POST</b>
<?= var_dump($_POST) ?>
<b>GET</b>
<?= var_dump($_GET) ?>
</pre>
<hr>
