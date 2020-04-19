<?php

namespace Chbl\Dice100;

class Player
{
    private $score = 0;
    private $roundScore = 0;
    private $hand = [];
    private $dice = [];

    public function __construct(int $dice = 5)
    {
        for ($i = 0; $i < $dice; $i++) {
            $this->dice[] = new Dice();
        }
    }



    /**
    * Rolls the dices and summs the result, returns score of the round
    */
    public function rollDices()
    {
        $this->hand;

        foreach ($this->dice as $dice) {
            $this->hand = $dice->rollDice();
        }
    $this->roundScore += in_array(1, $this->hand) ? 0 : array_sum($this->hand);
    return $this->roundScore;
    }

    /**
    * When you roll a 1 your turn is over
    */
    public function failedRoll()
    {
        return in_array(1, $this->hand);
    }


    /**
    * current Turn is over and the score for the round resets
    */
    public function turnOver()
    {
        $this->hand += $this->roundScore;
        $this->roundScore = 0;
    }

    /**
    * return the current hand that the player is holding
    */
    public function currentHand()
    {
        return $this->hand;
    }

    /**
    * returns the total score of the player
    */
    public function score()
    {
        return $this->playerScore;
    }

    /**
    * returns the total score of the round
    */
    public function getRoundScore()
    {
        return $this->roundScore;
    }


    /**
    * resets both the current hand as well as score
    */
    public function resetScore()
    {
        $this->hand = 0;
        $this->roundScore = 0;
    }


    /**
    * resets the roundscore
    */
    public function resetRoundScore()
    {
        $this->roundScore = 0;
    }
}
