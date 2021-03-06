<h1>Guess the number</h1>

<p>Guess a number between 1 and 100, you have <?= $game->getTriesLeft() ?> try left.</p>

<form method="post" action="guess_process.php">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $game->getSecretNumber() ?>">
    <input type="hidden" name="tries" value="<?= $game->getTriesLeft() ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Correct number is <?= $game->getSecretNumber() ?>.</p>
<?php endif; ?>
