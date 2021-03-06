<?php
/**
 * Guess game specific routes.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Guess my number with GET.
 */
$app->router->get("gissa/get", function () use ($app) {
    $data = [
        "title" => "Guess my number (GET)",
    ];

    // Get incoming
    $number = $_GET["number"] ?? -1;
    $tries = $_GET["tries"] ?? 6;
    $guess = $_GET["guess"] ?? null;

    // Start up the game
    $game = new \Mahw17\Guess\Guess($number, $tries);

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

    // Prepare $data
    $data['game'] = $game;
    $data['res'] = $res;

    // Add view and render page
    $app->view->add("guess/get", $data);
    $app->page->render($data);
});


/**
 * Guess my number with POST.
 */
$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $data = [
        "title" => "Guess my number (POST)",
    ];

    // Get incoming
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;

    // Start up the game
    $game = new \Mahw17\Guess\Guess($number, $tries);

    // Reset the game
    if (isset($_POST["reset"])) {
        $game->random();
    }

    // Do a guess
    $res = null;
    if (isset($_POST["doGuess"])) {
        if ($tries > 0) {
            $res = $game->makeGuess($guess, $tries);
        } else {
            $res = "You're out of tries, press RESET to reload game.";
        }
    }

    // Cheat
    if (isset($_POST["doCheat"])) {
        $res = "Cheat: ".$game->number();
    }

    // Prepare $data
    $data['game'] = $game;
    $data['res'] = $res;

    // Add view and render page
    $app->view->add("guess/post", $data);
    $app->page->render($data);
});


/**
 * Guess my number with SESSION.
 */
$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {
    $data = [
        "title" => "Guess my number (SESSION)",
    ];

    session_name("kmom02_guess");
    session_start();

    // Reset the game
    if (isset($_POST["reset"])) {
        $_SESSION = [];
    }

    // Start up the game
    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = new \Mahw17\Guess\Guess();
    }

    // Get incoming guess
    $guess = $_POST["guess"] ?? null;


    // Do a guess
    $res = null;
    if (isset($_POST["doGuess"])) {
        if ($_SESSION["game"]->tries() > 0) {
            $res = $_SESSION["game"]->makeGuess($guess, $_SESSION["game"]->tries());
        } else {
            $res = "You're out of tries, press RESET to reload game.";
        }
    }

    // Cheat
    if (isset($_POST["doCheat"])) {
        $res = "Cheat: ".$_SESSION["game"]->number();
    }


    // Prepare $data
    $data['res'] = $res;

    // Add view and render page
    $app->view->add("guess/session", $data);
    $app->page->render($data);
});
