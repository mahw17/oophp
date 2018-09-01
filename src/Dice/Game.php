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
    public $computerRounds;
    public $dices;
    public $player;
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
    public function __construct($player, $dices)
    {
        $this->dices = $dices;
        $this->btnNext = false;
        $this->btnRoll = true;
        $this->class = [];
        $this->computerRounds = 1;
        $this->computerScore = 0;
        $this->currentPlayer = $player;
        $this->dice = new DiceHistogram2();
        $this->histo_as_text = null;
        $this->histogram = new Histogram();
        $this->player = $player;
        $this->playerScore = 0;
        $this->totalScore = 0;
        $this->res = [];
        $this->score = 0;
        $this->text = null;
        $this->winner = null;
    }

    /**
     * Roll dices.
     * @return void
     */
    public function newRound()
    {
        // Disable buttons
        $this->btnRoll = false;
        $this->btnNext = false;

        // Reset result for each 'hand' of dices
        $this->res = [];
        $this->class = [];

        // Throw hands of dices and store result
        for ($i = 0; $i < $this->dices; $i++) {
            $this->dice->roll();
            $this->res[] = $this->dice->getNumber();
            $this->class[] = $this->dice->graphic();
        }

        // Store results into histogram, the results is for all rounds and
        // will be reset when changing player.
        $this->histogram->injectData($this->dice);
        $this->histo_as_text = $this->histogram->getAsText();

        // Check result
        // If player/computer threw a 1 reset score and make btn 'Next player' visible.
        if (in_array(1, $this->res)) {
            $this->text = $this->currentPlayer == $this->player ? "Tyvärr, du slog en etta!" : "Datorn slog en etta!";
            $this->btnNext = true;
            $this->score = 0;
        // Otherwise for player btn 'Continue' gets visible and computer decides if to proceed
        } else {
            if ($this->currentPlayer == $this->player) {
                $this->text = "Jippie, vill du fortsätta eller stanna??!";
                $this->btnRoll = true;
            } else {
                if ($this->compDecision()) {
                    $this->text = "Datorn vill fortsätta!";
                    $this->btnRoll = true;
                } else {
                    $this->text = "Datorn är klar, din tur!";
                    $this->btnNext = true;
                }
            }

            // Check if we have a winner!
            $this->score = $this->score + array_sum($this->res);
            $this->checkWinner();
        }
    }

    /**
     * Calculate if computer should stay or go.
     *
     * @return boolean
     */
    public function compDecision()
    {
        // Determine risk level
        $diff = $this->totalScore + $this->score - $this->playerScore;

        switch (true) {
            case $diff >50:
                $riskLevel = 0;
                break;
            case $diff >25:
                $riskLevel = 30;
                break;
            case $diff >15:
                $riskLevel = 40;
                break;
            case $diff >=0:
                $riskLevel = 50;
                break;
            case $diff <-50:
                $riskLevel = 85;
                break;
            case $diff <-25:
                $riskLevel = 70;
                break;
            case $diff <0:
                $riskLevel = 60;
                break;
            default:
                $riskLevel = 50;
                break;
        }

        // Calc how many dice that will be thrown if continue
        $threwDice = $this->computerRounds * $this->dices + $this->dices;
        // Calc the prob to get a 1.
        $probOne = (1 - (5/6)**($threwDice)) * 100;


        if ($riskLevel >= $probOne) {
            $this->computerRounds = $this->computerRounds + 1;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Save score and switch user
     *
     * @return void
     */
    public function saveScore()
    {
        if ($this->currentPlayer == $this->player) {
            $this->playerScore = $this->totalScore + $this->score;
            $this->currentPlayer = "Datorn";
            $this->totalScore = $this->computerScore;
        } else {
            $this->computerScore = $this->totalScore + $this->score;
            $this->currentPlayer = $this->player;
            $this->totalScore = $this->playerScore;
        }

        // Reset variables
        $this->btnNext = false;
        $this->btnRoll = true;
        $this->class = [];
        $this->computerRounds = 0;
        $this->dice->resetSerie();
        $this->histo_as_text = null;
        $this->res = [];
        $this->score = 0;
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
