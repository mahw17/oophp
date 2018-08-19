<?php
/**
 * OOPHP - KMOM01 - Guess my number (POST)
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

// For the view
$title = "Guess my number (POST)";

// Get incoming
$number = $_POST["number"] ?? -1;
$tries = $_POST["tries"] ?? 6;
$guess = $_POST["guess"] ?? null;

// Start up the game
$game = new Guess($number, $tries);

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

// Include top part of html content
include(__DIR__ . "/view/top-view.php");

?>
                       <h1>Guess (POST)</h1>
                       <ul>
                           <li>Gör samma sak igen, men använd nu endast POST istället för GET.</li>
                           <li>Spara koden i index_post.php.</li>
                       </ul>
                   <!-- close div sidebar -->
                   </div>
               <!-- close div sidebar_container -->
               </div>
               <div id="content">
                   <h1>Guess a number between 1 and 100, you have <br><u><strong><?=$game->tries()?> tries</strong></u> left.</h1>
                    <form class="pure-form" action="#" method="post">
                        <input type="hidden" name="number" value=<?=$game->number()?>></input>
                        <input type="hidden" name="tries" value=<?=$game->tries()?>></input>
                        <input type="tel" name="guess"></input>
                        <input type="submit" class="pure-button button-secondary" name="doGuess" value="Make a Guess"></input>
                        <input type="submit" class="pure-button button-error" name="doCheat" value="Cheat"></input>
                    </form>
                    <form action="#" method="post">
                        <input type="submit" class="pure-button button-warning" name="reset" value="Reset"></input>
                    </form>
                    <h2><?=$res?></h2>
<?php
// Include bottom part of html content
include(__DIR__ . "/view/bottom-view.php");
