<?php

namespace Chbl\Dice100;

class Player
{
    private $playerScore = 0;
    private $roundScore = 0;
    private $dice = 1;
    private $currentRoll = 0;

    public function __construct()
    {
        $this->dice = new Dice();
    }

    public function roll()
    {
        $this->roundScore = $this->dice->roll();
        $this->currentRoll = $this->roundScore;
        $this->playerScore += $this->roundScore;
        return $this->roundScore;
    }

    public function hasRolledOne()
    {
        if ($this->roundScore == 1) {
            return True;
        }
    }

    public function endTurn()
    {
        $this->roundScore = 0;
    }

    public function getRoll()
    {
        return $this->currentRoll;
    }

    public function resetScore()
    {
        $this->playerScore = 0;
        $this->roundScore = 0;
    }

    public function getScore()
    {
        return $this->playerScore;
    }

    public function getRoundScore()
    {
        return $this->roundScore;
    }

    public function resetRoundScore()
    {
        $this->roundScore = 0;
    }
}
