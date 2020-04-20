<?php
namespace Chbl\Dice100;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{

    private $finishedGame = false;
    private $players;
    private $bot;

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

        if ($rolledOne) {
            $this->bot->resetRoundScore();
            $this->bot->endTurn();
            $this->bot->newRollCount();
            $this->nextTurn($botTrack);
        } elseif ($isDone) {
            $this->bot->endTurn();
        }
    }


    public function nextTurn($tracker)
    {
        if ($tracker == 1) {
            if ($this->players->getScore() >= 100) {
                $this->finishedGame = true;
            } else {
                $this->players->endTurn();
                // $this->players->resetRoundScore();
                $this->botRoll();
            }
        } elseif ($tracker == 2) {
            if ($this->bot->getScore() >= 100) {
                $this->finishedGame = true;
            } else {
                $this->playerRoll();
            }
        }
    }


    public function getFinishedGame()
    {
        return $this->finishedGame;
    }
}
