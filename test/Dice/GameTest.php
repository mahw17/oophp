<?php

namespace Mahw17\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify containing methods
     * choosen to validate all methods in same test case, due to the fact
     * that the methods returns void.
     */
    public function testCreateGameObject()
    {
        $game = new Game("Spelare 1", 3);
        $this->assertInstanceOf("\Mahw17\Dice\Game", $game);

        // $game->totalScore = 99;
        //
        for ($i=0; $i < 150; $i++) {
            $game->newRound();
        }
        //
        $game->saveScore();
        //
        for ($i=0; $i < 150; $i++) {
            $game->newRound();
        }
        //
        $game->saveScore();
    }
}
