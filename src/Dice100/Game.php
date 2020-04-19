<?php

namespace Chbl\Dice100;

class Game
{
    private $player;
    private $cpu;
    private $gameOver = false;
    private $order = [];

    public function __construct($dices = 5)
    {
        $this->player = new Player($dices);
        $this->cpu = new CPU($dices);
    }


    /**
    * return the player
    */
    public function player()
    {
        return $this->player;
    }

    /**
    * rolls the dices for player but also ends the turn for player if it is a failed roll
    */
    public function rollDicesPlayer()
    {
        $playerValue = 1;
        $this->player[$this->turn]->rollDices();
        $failRoll = $this->player[$this->turn]->failedRoll();

        if ($failRoll) {
            $this->player[$this->turn]->resetRoundScore();
            $this->player[$this->turn]->turnOver();
            $this->nextRoll($playerValue);
        }
    }


    /**
    * rolls the dices for ComPUter but also ends the turn for player if it is a failed roll
    */
    public function rollDicesCPU()
    {
        $cpuValue = 2;
        $doneRolling = $this->player[$this->turn]->rollDicesCPU();
        $failRoll = $this->player[$this->turn]->failedRoll();

        if ($failRoll || $doneRolling) {
            $this->player[$this->turn]->turnOver();
            $this->player[$this->turn]->newCPURoll();
            $this->nextRoll($cpuValue);
        }
    }

    public function nextRoll(inputValue)
    {
        $this->player[$this->turn]->turnOver();
        $score = $this->player[$this->turn]->score();

        if ($score >= 100) {
            $this->gameOver = true;
            return inputValue;
        } elseif (inputValue == 1) {
            rollDicesCPU();
        } else {
            rollDicesPlayer();
        }
    }

    public function getGameStatus()
    {
        return $this->gameOver;
    }

}
