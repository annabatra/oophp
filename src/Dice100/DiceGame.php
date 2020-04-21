<?php
namespace Chbl\Dice100;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{

    private $playerWins = false;
    private $computerWins = false;
    private $player;
    private $bot;
    public $checkButton = true;
    public $chickenDinner = false;

    public function __construct()
    {
        $this->player = new Player();
        $this->bot = new Bot();
    }


    public function getPlayers()
    {
        return $this->player;
    }

    public function getBot()
    {
        return $this->bot;
    }

    public function playerRoll()
    {
        $playerTrack = 1;
        $this->player->roll();
        $rolledOne = $this->player->hasRolledOne();

        if ($rolledOne) {
            $this->player->resetRoundScore();
            $this->nextTurn($playerTrack);
        }
    }


    public function botRoll()
    {
        $botTrack = 2;
        $totalBot = $this->bot->botRoll();

        if ($totalBot == 0) {
            $this->bot->newRollCount();
            $this->nextTurn($botTrack);
        }
        if (!$totalBot == 0) {
            $this->bot->botEndTurn($totalBot);
            $this->bot->newRollCount();
            $this->nextTurn($botTrack);
        }
    }

    public function checkWhatButton()
    {
        return $this->checkButton;
    }

    public function nextTurn($tracker)
    {
        if ($tracker == 1) {
            $this->player->endTurn();
            if ($this->player->getScore() >= 100) {
                $this->chickenDinner = true;
                $this->playerWins = true;
            } else {
                $this->checkButton = false;
            }
        } elseif ($tracker == 2) {
            if ($this->bot->getScore() >= 100) {
                $this->chickenDinner = true;
                $this->computerWins = true;
            } else {
                $this->checkButton = true;
            }
        }
    }


    public function anyWinner()
    {
        return $this->chickenDinner;
    }

    public function isPlayerWinning()
    {
        return $this->playerWins;
    }

    public function isBotWinning()
    {
        return $this->computerWins;
    }
}
