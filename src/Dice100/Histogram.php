<?php

namespace Chbl\Dice100;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var array $histogram  the histogram in "array form".
     */
    private $serie = [];
    private $min = 1;
    private $max = 6;
    private $string = "";
    private $histogram;

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->histogram;
    }

        /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $this->string = "";
        $round = $this->serie;
        for ($i = $this->min; $i <= $this->max; $i++) {
            $this->string .= $i . ": ";
            foreach ($round as $dice) {
                if ($dice == $i) {
                    $this->string .= "*";
                }
            }
            $this->string .= "\n";
        }
        return $this->string;
    }

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object, $amount)
    {
        $this->serie[] = $amount;
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }
}
