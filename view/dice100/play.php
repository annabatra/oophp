<?php

namespace Anax\View;

$player = $game->player();
$gameOver = $game->getGameStatus();
?>

<h1>Dice100</h1>

<?php if (!$gameOver) : ?>
    <div class="player_dice">
        <div>
            <h2>Player <?= $i + 1 ?></h2>
            <p>Player total score: <?= $player[$i]->score() ?></p>
            <p>Player round score: <?= $player[$i]->getRoundScore() ?></p>
            <p><?= implode(", ", $player[$i]->currentHand()) ?></p>
        </div>
    </div>

<h2>The Winner is: </h2>
<a href="init">Play again?</a>
