<?php

namespace Chbl\Dice100;

class Bot extends Player
{

    public $rollCount = 0;
    private $maxRoll = 5;
    private $currRoll;
    private $totalRolled;
    private $lastRoll = 0;


    public function __construct()
    {
        parent::__construct();
        $this->rollCount = rand(1, $this->maxRoll);
    }


    public function botRoll()
    {
        $this->totalRolled = 0;
        while ($this->rollCount > 0) {
            $this->currRoll = rand(1, 6);
            if ($this->currRoll == 1) {
                $this->totalRolled = 0;
            } else {
                $this->totalRolled += $this->currRoll;
                $this->rollCount -= 1;
                $this->lastRoll = $this->currRoll;
            }
        }
        return $this->totalRolled;
    }


    public function botLastRoll()
    {
        return $this->lastRoll;
    }


    public function newRollCount()
    {
        $this->rollCount = rand(1, $this->maxRoll);
    }
}
