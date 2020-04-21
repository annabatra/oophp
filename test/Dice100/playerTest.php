<?php

namespace Chbl\Dice100;

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{

    /**
     * Test the bool value of rolls on 1
     */
    public function testRolledOne()
    {
        $testPlayer = new Player();
        $this->assertInstanceOf("\Chbl\Dice100\Player", $testPlayer);

        $res = $testPlayer->hasRolledOne();
        $exp = null;

        $this->assertEquals($exp, $res);
    }


    /**
     * Test the return of roll when non is made
     */
    public function testGetRoll()
    {
        $testPlayer = new Player();
        $this->assertInstanceOf("\Chbl\Dice100\Player", $testPlayer);

        $res = $testPlayer->getRoll();
        $exp = null;

        $this->assertEquals($exp, $res);
    }

    public function testGetRollNumber()
    {
        $testPlayer = new Player();
        $this->assertInstanceOf("\Chbl\Dice100\Player", $testPlayer);
        $testPlayer->currentRoll = 4;

        $res = $testPlayer->getRoll();
        $exp = 4;

        $this->assertEquals($exp, $res);
    }
}
