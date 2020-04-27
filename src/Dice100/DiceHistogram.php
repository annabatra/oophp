<?php

namespace Chbl\Dice100;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram implements HistogramInterface
{
    use HistogramTrait;

    private $max = 6;


    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->max;
    }
}
