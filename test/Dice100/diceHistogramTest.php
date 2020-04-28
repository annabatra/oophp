<?php

namespace Chbl\Dice100;

use PHPUnit\Framework\TestCase;

class DiceHistogramTest extends TestCase
{

    public function testGetHistogramMax()
    {
        $diceHistogram = new DiceHistogram();
        $this->assertInstanceOf("\Chbl\Dice100\DiceHistogram", $diceHistogram);

        $res = $diceHistogram->getHistogramMax();
        $exp = 6;

        $this->assertEquals($exp, $res);
    }
}
