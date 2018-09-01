<?php

namespace Mahw17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceMakeRollTest extends TestCase
{
    /**
     * Construct object and get number, check that the number is a valid one.
     */
    public function testMakeRoll()
    {
        $dice = new Dice();
        $number = $dice->getNumber();
        $this->assertContains($number, [1, 2, 3, 4, 5, 6]);
    }
}
