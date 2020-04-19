<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("dice100/init", function () use ($app) {
    // init the sesson for the gamestart";
    $title = "Spela spelet";
    session_destroy();
    $app->session->start();

    return $app->response->redirect("dice100/play");
});


/**
 * Play the game
 */
$app->router->get("dice100/play", function () use ($app) {
    $title = "Spela spelet";

    $game = new Chbl\Dice100\Game();





    $data = [
        "game" => $game
    ];

    $app->page->add("dice100/play", $data);
    $app->page->add("dice100/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
