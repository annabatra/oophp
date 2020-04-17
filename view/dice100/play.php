<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<!-- <header> -->
    <h1>Tärning 100</h1>
<!-- </header> -->
    <h3>...mellan 1-100...</h3>
<p>Din poäng: <?php $playerScore ?></p>
<p>Datorns poäng: <?php $cpuScore ?></p>


<form method="post">
    <input type="submit" name="doRoll" value="Roll">
    <input type="submit" name="doSave" value="Save points">
    <!-- <input type="submit" name="reset" value="Restart"> -->
</form>

<a href="init" class="restart-btn">STARTA OM</a>
