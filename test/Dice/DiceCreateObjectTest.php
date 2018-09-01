<?php

namespace Mahw17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new DiceHistogram2();
        $this->assertInstanceOf("\Mahw17\Dice\DiceHistogram2", $dice);
    }
}
