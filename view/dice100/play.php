<?php
namespace Anax\View;

$player = $diceGame->getPlayer();
$bot = $diceGame->getBot();
$checkButton = $diceGame->checkWhatButton();
$playerWin = $diceGame->isPlayerWinning();
$computerWin = $diceGame->isBotWinning();
$gameOver = $diceGame->anyWinner();
?>

<h1>Dice game 100</h1>

<?php if (!$gameOver) : ?>
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
            <p>CPU last roll: <?= $bot->botLastRoll() ?></p>
            <br><br>
        </div>
    </div>
    <form method="post">
        <?php if ($checkButton) : ?>
        <input type="submit" name="roll" value="Roll dice">
        <input type="submit" name="endTurn" value="End turn">
        <?php elseif (!$checkButton) : ?>
        <input type="submit" name="botRoll" value="Roll CPUs">
        <?php endif; ?>
    </form>

<?php else : ?>
    <h2>The Winner is:
    <?php if ($playerWin) : ?>
    YOU!
    <?php elseif ($computerWin) : ?>
    Computer!
    <?php endif; ?></h2>
    <a href="init">Play again?</a>
<?php endif; ?>
