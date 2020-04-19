<?php


namespace Chbl\Dice100;

class CPU extends Player
{
    public $counter = 0;
    private $maxCPURolls = 5;

    public function __construct($dice)
    {
        parent::__construct($dice);
        $this->counter = rand(1, $this->maxCPURolls);
    }

    public function newCPURoll()
    {
        if ($this->counter > 0) {
            parent::rollDices();
            $this->counter -= 1;

            return false;
        }
        return true;
    }

    public function newRollCount()
    {
        $this->counter = rand(1, $this->$maxCPURolls);
    }
}
