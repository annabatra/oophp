<?php
/**
 * Dice controller
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "Dice Controller.",
            "mount" => "dice1",
            "handler" => "\Chbl\Dice100\DiceController",
        ]
    ]
];
