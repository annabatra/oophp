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
        $this->player[$this->turn]->rollDices();
        $failRoll = $this->player[$this->turn]->failedRoll();

        if ($failRoll) {
            $this->player[$this->turn]->resetRoundScore();
            $this->player[$this->turn]->turnOver();
            $this->nextRoll();
        }
    }


    /**
    * rolls the dices for ComPUter but also ends the turn for player if it is a failed roll
    */
    public function rollDicesCPU()
    {
        $doneRolling = $this->player[$this->turn]->rollDicesCPU();
        $failRoll = $this->player[$this->turn]->failedRoll();

        if ($failRoll || $doneRolling) {
            $this->player[$this->turn]->turnOver();
            $this->player[$this->turn]->newCPURoll();
            $this->nextRoll();
        }
    }

    public function nextRoll()
    {
        $this->player[$this->turn]->turnOver();
        $score = $this->player[$this->turn]->score();

        if ($score >= 100) {
            $this->gameOver = true;
        } else {

        }
    }

    public function getGameStatus()
    {
        return $this->gameOver;
    }

}
