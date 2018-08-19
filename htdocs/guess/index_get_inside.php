<?php

namespace Mahw17\Guess;

/**
 * OOPHP - KMOM01 - Guess my number (GET)
 */
include(__DIR__ . "/config.php");
require __DIR__ . '/../../vendor/autoload.php';
// include(__DIR__ . "/autoload.php");

// For the view
$title = "Guess my number (GET inside)";

// Get incoming
$number = $_GET["number"] ?? -1;
$tries = $_GET["tries"] ?? 6;
$guess = $_GET["guess"] ?? null;

// Start up the game
$game = new Guess($number, $tries);

// Reset the game
if (isset($_GET["reset"])) {
    $game->random();
}

// Do a guess
$res = null;
if (isset($_GET["doGuess"])) {
    if ($tries > 0) {
        $res = $game->makeGuess($guess, $tries);
    } else {
        $res = "You're out of tries, press RESET to reload game.";
    }
}

// Cheat
if (isset($_GET["doCheat"])) {
    $res = "Cheat: ".$game->number();
}
