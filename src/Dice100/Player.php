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
        $this->currentRoll = $this->dice->roll();
        $this->roundScore += $this->currentRoll;
        return $this->roundScore;
    }

    public function hasRolledOne()
    {
        if ($this->currentRoll == 1) {
            return true;
        }
    }

    public function endTurn()
    {
        if ($this->roundScore != 0) {
            $this->playerScore += $this->roundScore;
        }
        $this->roundScore = 0;
    }

    public function botEndTurn($inputScore)
    {
        $this->playerScore += $inputScore;
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
