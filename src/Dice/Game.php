<?php

namespace Mahw17\Dice;

/**
 * Class of a dice game
 */
class Game
{
    /**
     * @var boolean  $btnNext, button for next player.
     * @var boolean  $btnRoll, button for roll the dice.
     * @var string $class, array with graphic css-class of the dices.
     * @var int $computerScore, the computers saved score.
     * @var string $currentPlayer, the current player.
     * @var int $playerScore, the player saved score.
     * @var int $res, array with dice values.
     * @var int $score, players unsaved score in current round.
     * @var string $text, information text.
     * @var int $totalScore, current players saved score.
     * @var string $winner, the winner of the game.
     */

    public $btnNext;
    public $btnRoll;
    public $class;
    public $computerScore;
    public $currentPlayer;
    public $playerScore;
    public $res;
    public $score;
    public $text;
    public $totalScore;
    public $winner;

    /**
     * Constructor to create a new Game.
     * @return void
     */
    public function __construct()
    {
        $this->currentPlayer = "Spelare 1";
        $this->res = [];
        $this->class = [];
        $this->playerScore = 0;
        $this->computerScore = 0;
        $this->totalScore = 0;
        $this->score = 0;
        $this->btnNext = false;
        $this->btnRoll = true;
        $this->text = null;
        $this->winner = null;
    }

    /**
     * Roll dices.
     * @return void
     */
    public function newRound()
    {
        $this->btnRoll = false;
        $this->btnNext = false;


        $dice = new DiceGraphic();
        $rolls = 3; // Number of dices
        $res = [];
        $class = [];
        for ($i = 0; $i < $rolls; $i++) {
            $dice->rollDice();
            $res[] = $dice->getNumber();
            $class[] = $dice->graphic();
        }

        if (in_array(1, $res)) {
            $this->text = $this->currentPlayer == "Spelare 1" ? "Tyvärr, du slog en etta!" : "Datorn slog en etta!";
            $this->btnNext = true;
            $this->score = 0;
        } else {
            if ($this->currentPlayer == "Spelare 1") {
                $this->text = "Jippie, vill du fortsätta eller stanna??!";
                $this->btnRoll = true;
            } else {
                $this->text = "Datorn är klar, din tur!";
                $this->btnNext = true;
            }
            $this->score = $this->score + array_sum($res);
            $this->checkWinner();
        }

        $this->res = $res;
        $this->class = $class;
    }

    /**
     * Save score and switch user
     *
     * @return void
     */
    public function saveScore()
    {
        if ($this->currentPlayer == "Spelare 1") {
            $this->playerScore = $this->totalScore + $this->score;
            $this->currentPlayer = "Datorn";
            $this->totalScore = $this->computerScore;
        } else {
            $this->computerScore = $this->totalScore + $this->score;
            $this->currentPlayer = "Spelare 1";
            $this->totalScore = $this->playerScore;
        }

        $this->res = [];
        $this->class = [];
        $this->score = 0;
        $this->btnNext = false;
        $this->btnRoll = true;
        $this->text = null;
    }

    /**
     * Check if currentPlayer wins
     *
     * @return void.
     */
    public function checkWinner()
    {
        if ($this->totalScore + $this->score >= 100) {
            $this->winner = $this->currentPlayer;
        }
    }
}
