<?php
/**
* Guess my number, a POST version.
*/

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

//session_name("chbl19");
session_start();


$guess = $_SESSION["guess"] ?? null;
$doInit = $_SESSION["doInit"] ?? null;
$doGuess = $_SESSION["doGuess"] ?? null;
$doCheat = $_SESSION["doCheat"] ?? null;


if ($doInit || !isset($_SESSION["game"])) {
    session_destroy();
    session_start();
    $_SESSION["game"] = new Guess();
}


$game = $_SESSION["game"];
$_SESSION["tries"] = $game->getTriesLeft();
$_SESSION["number"] = $game->getSecretNumber();

if ($doGuess) {
    try {
        $res = $game->makeGuess((int)$guess);
        $_SESSION["tries"] = $game->getTriesLeft();
    } catch (GuessException $e) {
        $res = " out of bounds...";
    }
} elseif ($doCheat) {
    $number = $game->getSecretNumber();
}

if ($game->getTriesLeft() == 0) {
    echo "Sorry, you ran out of tries but keep guessing, the game has restarted.";
    session_destroy();
}

//Render the page
require __DIR__ . "/view/guess_my_number.php";
require __DIR__ . "/view/debug_session_post_get.php";
