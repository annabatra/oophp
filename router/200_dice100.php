<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game and redirect to play the game
 */
$app->router->get("dice100/init", function () use ($app) {
    // init the session for the game.
    session_destroy();
    $app->session->start();
    $app->session->set("dice", new Chbl\Dice100\DiceGame());

    return $app->response->redirect("dice100/play");
});


$app->router->post("dice100/play", function () use ($app) {

    $diceGame = $app->session->get("dice");

    if ($app->request->getPost("roll")) {
        $diceGame->playerRoll();
    } elseif ($app->request->getPost("endTurn")) {
        $diceGame->nextTurn(1);
    } elseif ($app->request->getPost("botRoll")) {
        $diceGame->botRoll();
    }

    // else {
    //     $diceGame->botRoll();
    // }

    return $app->response->redirect("dice100/play");
});

/**
 * Play the game - Dice
 */
$app->router->get("dice100/play", function () use ($app) {

    $title = "Pig Dice game";

    $data = [
        "diceGame" => $app->session->get("dice")
    ];

    $app->page->add("dice100/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
