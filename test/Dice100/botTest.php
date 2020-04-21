<?php

namespace Chbl\Dice100;

use PHPUnit\Framework\TestCase;

class BotTest extends TestCase
{


    /**
     * Test that the rollCounter -1 / roll
     */
    public function testRollCounterEachRoll()
    {
        $testBot = new Bot();
        $this->assertInstanceOf("\Chbl\Dice100\bot", $testBot);

        $res = $testBot->botRoll();
        $exp = $testBot->rollCount == 0;


        $this->assertEquals($exp, $res);
    }


    /**
     * Test to see that the rollCounter rolls a new one
     */
    public function testRollCount()
    {
        $testBot = new Bot();
        $this->assertInstanceOf("\Chbl\Dice100\bot", $testBot);

        $track = 0;
        $testBot->rollCount = $track;

        $testBot->newRollCount();
        $fixedCount = $testBot->rollCount;

        $this->assertNotEquals($track, $fixedCount);
    }


    public function testConstruct()
    {
        $testBot = new Bot();
        $this->assertInstanceOf("\Chbl\Dice100\bot", $testBot);

        $res = $testBot->rollCount;
        $exp = $testBot->rollCount = ($testBot->rollCount > 0 && $testBot->rollCount < 6);


        $this->assertEquals($exp, $res);
    }
}
