<?php

namespace Chbl\Dice100;

class Dice
{

    private $sides;
    // private $number;

    public function __construct($sides = 6) {
        $this->sides = $sides;
    }

    public function roll() {
        return rand(1, $this->sides);
    }

}
