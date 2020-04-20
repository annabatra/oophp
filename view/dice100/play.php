<?php
namespace Anax\View;

$player = $diceGame->getPlayers();
$bot = $diceGame->getBot();


    var_dump($app->session);
    var_dump($_SESSION);

?>

<h1>Dice game 100</h1>

<div class="dice_game">
    <div class="player_div">
        <h2>Player 1</h2>
        <p>Your total score: <?= $player->getScore() ?></p>
        <p>Your round score: <?= $player->getRoundScore() ?></p>
        <p>Last roll: <?= $player->getRoll() ?></p>
    </div>
    <div class="bot_div">
        <h2>Computer</h2>
        <p>CPU total score: <?= $bot->getScore() ?></p>
        <br><br>
    </div>
</div>
<form method="post">
    <input type="submit" name="roll" value="Roll dice">
    <input type="submit" name="endTurn" value="End turn">
</form>

<h2>The Winner is: </h2>
<a href="init">Play again?</a>
