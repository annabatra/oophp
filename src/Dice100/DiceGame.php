<?php
namespace Chbl\Dice100;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{

    private $playerTurn = null;
    private $finishedGame = false;
    private $players;
    private $bot;
    private $playerScore  = 0;

    public function __construct()
    {
        $this->players = new Player();
        $this->bot = new Bot();
    }


    public function getPlayers()
    {
        return $this->players;
    }

    public function getBot()
    {
        return $this->bot;
    }

    public function playerRoll()
    {
        $playerTrack = 1;
        $this->players->roll();
        $rolledOne = $this->players->hasRolledOne();

        if ($rolledOne) {
            $this->players->resetRoundScore();
            $this->players->endTurn();
            $this->nextTurn($playerTrack);
        }
    }


    public function botRoll()
    {
        $botTrack = 2;
        $isDone = $this->bot->botRoll();
        $rolledOne = $this->bot->hasRolledOne();

        if ($rolledOne || $isDone) {
            $this->bot->endTurn();
            $this->bot->newRollCount();
            $this->nextTurn($botTrack);
        }
    }


    public function nextTurn($tracker)
    {
        if ($tracker == 1) {
            if ($this->playerScore >= 100) {
                $this->finishedGame = true;
            } else {
                $this->bot->botRoll();
            }
        } elseif ($tracker == 2) {
            if ($botScore >= 100) {
                $this->finishedGame = true;
            } else {
                $this->player->playerRoll();
            }
        }
    }


    public function getFinishedGame()
    {
        return $this->finishedGame;
    }
}
