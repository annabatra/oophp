<?php
namespace Chbl\Dice100;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Dice
{

    private $sides = null;


    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }


    public function roll()
    {
        return rand(1, $this->sides);
    }
}
