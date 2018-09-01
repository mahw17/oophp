<?php

namespace Mahw17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGraphic.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and generate graphic, check that the grapic is a valid one.
     */
    public function testDiceGraphic()
    {
        $diceGraphic = new DiceGraphic();
        $graphic = $diceGraphic->graphic();
        $this->assertContains($graphic, ['dice-1', 'dice-2', 'dice-3', 'dice-4', 'dice-5', 'dice-6']);
    }
}
