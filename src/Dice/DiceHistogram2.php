<?php

namespace Mahw17\Dice;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram2 extends DiceGraphic implements HistogramInterface
{
    use HistogramTrait2;

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->sides;
    }

    /**
     * Reset serie.
     *
     */
    public function resetSerie()
    {
        $this->serie =[];
    }


    /**
     * Roll the dice, remember its value in the serie and return
     * its value.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $this->rollDice();
        $this->serie[] = $this->getNumber(); //Changed mos 'roll()' to my version
        return $this->getNumber(); //Changed mos 'getLastRoll()' to my version
    }
}
