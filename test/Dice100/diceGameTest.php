<?php

namespace Chbl\Dice100;

use PHPUnit\Framework\TestCase;

class DiceGameTest extends TestCase
{

    /**
     * Test to see bool return on winner when there is non
     */
    public function testWinner()
    {
        $testDice = new DiceGame();
        $this->assertInstanceOf("\Chbl\Dice100\DiceGame", $testDice);

        $res = $testDice->anyWinner();
        $exp = false;

        $this->assertEquals($exp, $res);
    }


    /**
     * Test to see bool return on player win when not won
     */
    public function testPlayerWinning()
    {
        $testDice = new DiceGame();
        $this->assertInstanceOf("\Chbl\Dice100\DiceGame", $testDice);

        $res = $testDice->isPlayerWinning();
        $exp = false;

        $this->assertEquals($exp, $res);
    }


    /**
     * Test to see bool return on bot win when not won
     */
    public function testBotWinning()
    {
        $testDice = new DiceGame();
        $this->assertInstanceOf("\Chbl\Dice100\DiceGame", $testDice);

        $res = $testDice->isBotWinning();
        $exp = false;

        $this->assertEquals($exp, $res);
    }


    /**
     * Test to see bool return on what buttons to show on play.html
     */
    public function testButton()
    {
        $testDice = new DiceGame();
        $this->assertInstanceOf("\Chbl\Dice100\DiceGame", $testDice);

        $res = $testDice->checkWhatButton();
        $exp = true;

        $this->assertEquals($exp, $res);
    }
}
