<?php

namespace Chbl\Dice100;

use PHPUnit\Framework\TestCase;

class HistogramTest extends TestCase
{

    public function testGetAsText()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Chbl\Dice100\Histogram", $histogram);

        $res = $histogram->getAsText();
        $exp = true;

        $this->assertEquals($exp, is_string($res));
    }


    public function testGetSerie()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Chbl\Dice100\Histogram", $histogram);

        $res = $histogram->getSerie();
        $exp = null;

        $this->assertEquals($exp, $res);
    }
}
