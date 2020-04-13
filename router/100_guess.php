<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    $_SESSION["game"] = new Chbl\Guess\Guess();
    return $app->response->redirect("guess/play");
});



/**
 * Play the game. - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game!";


    $game = $_SESSION["game"];
    $_SESSION["tries"] = $game->getTriesLeft();
    $_SESSION["number"] = $game->getSecretNumber();

    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;


    if ($game->getTriesLeft() == 0) {
        echo "Sorry, you ran out of tries but keep guessing, the game has restarted.";
        session_destroy();
        session_start();
        $_SESSION["game"] = new Chbl\Guess\Guess();
    }



    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;


    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "number" => $number ?? null,
        "game" => $game
    ];


    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game. - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game!";

    //$game = new Chbl\Guess\Guess();

    $game = $_SESSION["game"];
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $_SESSION["doCheat"] = $doCheat;
    $res = null;


    if ($doGuess) {
        $_SESSION["tries"] = $game->getTriesLeft();
        $_SESSION["guess"] = $guess;
        try {
            $res = $game->makeGuess((int)$guess);
            $tries = $game->getTriesLeft();
        } catch (Chbl\Guess\GuessException $e) {
            $res = " out of bounds...";
        }
        $_SESSION["doGuess"] = null;
        $_SESSION["res"] = $res;
    } elseif ($doCheat) {
        $number = $game->getSecretNumber();
    } elseif ($doInit) {
        session_destroy();
        session_start();
        $_SESSION["game"] = new Chbl\Guess\Guess();
    }


    return $app->response->redirect("guess/play");
});
