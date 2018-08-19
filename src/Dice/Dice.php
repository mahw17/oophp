<?php

namespace Mahw17\Dice;

/**
 * Class of a normal 6 digit dice
 */
class Dice
{
    /**
     * @var integer  $number The number of the dice.
     *@var integer  $sides The number of sides on the dice
     */

    private $number;
    private $sides;

    /**
     * Constructor to create a Dice.
     *
     */
    public function __construct($sides = 6)
    {
        $this->sides = $sides;
        $this->rollDice();
    }


    /**
     * Roll the dice
     *
     * @return void
     */
    public function rollDice()
    {
        $this->number = rand(1, $this->sides);
    }

    /**
     * Get the number of the dice
     *
     * @return int as the number of the dice.
     */
    public function getNumber()
    {
        return $this->number;
    }
}
