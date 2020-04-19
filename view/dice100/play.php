<?php

namespace Anax\View;

$player = $game->player();
$gameOver = $game->getGameStatus();
?>

<h1>Dice100</h1>

<?php if (!$gameOver) : ?>
    <div class="player_dice">
        <div>
            <h3>Här ska allt finnas sedan</h3>
        </div>
    </div>

<h2>The Winner is: </h2>
<a href="init">Play again?</a>

<?php endif; ?>
