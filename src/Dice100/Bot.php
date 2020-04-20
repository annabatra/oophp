<?php

namespace Chbl\Dice100;

class Bot extends Player
{

    public $rollCount = 0;
    private $maxRoll = 5;


    public function __construct()
    {
        parent::__construct();
        $this->rollCount = rand(1, $this->maxRoll);
    }


    public function botRoll()
    {
        if ($this->rollCount > 0) {
            parent::roll();
            $this->rollCount -= 1;
            return false;
        }
        return true;
    }


    public function newRollCount()
    {
        $this->rollCount = rand(1, $this->maxRoll);
    }
}
