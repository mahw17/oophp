<?php

namespace Mahw17\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }


    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $keyValueArray = array();

        // Parameters min and max populate array with key-values (& no values)
        for ($i = $this->min; $i <= $this->max; $i++) {
            $keyValueArray[$i] = '';
        }

        // Populate array acc to histogram serie
        foreach ($this->serie as $value) {
            $test = isset($keyValueArray[$value]) ? $keyValueArray[$value] : '';
            $keyValueArray[$value] = $test . '*';
        }

        // Sort array
        // ksort($keyValueArray);

        // Create string output
        $output = null;
        foreach ($keyValueArray as $key => $value) {
            $output = $output . $key . ": " . $value . "<br>";
        }

        return $output;
    }
}
