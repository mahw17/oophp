<?php
/**
 * Dice game specific routes.
 */



/**
 * Dice game start view.
 */

$app->router->get("dice", function () use ($app) {
    session_name("mahw17_dice");
    session_start();

    $data = [
        "title" => "Tärningsspel",
        "max_dices" => 6, // Maximum number of dices to choose
    ];

    // Destroy current session if exists
    if (isset($_SESSION["game"])) {
        session_destroy();
    }

    $app->view->add("dice/start", $data);
    $app->page->render($data);
});



/**
 * Dice game 'ongoing' view.
 */

$app->router->post("dice/game", function () use ($app) {
    session_name("mahw17_dice");
    session_start();

    $data = [
        "title" => "Tärningsspel",
    ];


    // Start new game if none already initated
    if (!isset($_SESSION["game"])) {
        $player = $_POST["player"] ?? "Spelare 1";
        $dices = $_POST["dices"] ?? 3;
        $_SESSION["game"] = new \Mahw17\Dice\Game($player, $dices);
    }

    // New roll
    if (isset($_POST["roll"])) {
        $_SESSION["game"]->newRound();
    }

    // Next player
    if (isset($_POST["save"])) {
        $_SESSION["game"]->saveScore();

        // If next player is computer a new round will automatically be triggerd.
        if ($_SESSION["game"]->currentPlayer == "Datorn") {
            $_SESSION["game"]->newRound();
        }
    }

    // Store session object as local object
    $game = $_SESSION["game"];

    // if we have a winner render the winner-view
    if ($game->winner) {
        $data["winner"] = $game->winner;
        $_SESSION = [];

        $app->view->add("dice/winner", $data);
        $app->page->render($data);
    // if no winner render the ongoing game-view and add the object data to view
    } else {
        $data["player"] = $game->currentPlayer;
        $data["score"] = $game->score;
        $data["class"] = $game->class;
        $data["sum"] = array_sum($game->res);
        $data["res"] = $game->res;
        $data["totalScore"] = $game->totalScore;
        $data["btnRoll"] = $game->btnRoll;
        $data["btnNext"] = $game->btnNext;
        $data["text"] = $game->text;
        $data["histo"] = $game->histo_as_text;

        $app->view->add("dice/game", $data);
        $app->page->render($data);
    }
});
