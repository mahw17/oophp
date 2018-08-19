<?php
/**
 * OOPHP - KMOM01 - Guess my number (GET)
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

// For the view
$title = "Guess my number (GET)";

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

// Include top part of html content
include(__DIR__ . "/view/top-view.php");

?>
                       <h1>Guess (GET)</h1>
                       <ul>
                           <li>Gör en variant där du enbart använder GET gör att spela spelet. Spara koden i index_get.php</li>
                           <li>Gissa numret i ett formulär som postas med GET-metoden.</li>
                           <li>Minns vilket nummer som är det gissade genom att lagra det i ett hidden fält i formuläret.</li>
                           <li>Det skall finnas en länk/knapp som möjliggör omstart. Talet ska då slumpas om och antalet gissningar ska nollställas.</li>
                           <li>Det skall finnas en länk/knapp “Cheat” som skriver ut nuvarande tal, det blir enklare att testa då.</li>
                       </ul>
                   <!-- close div sidebar -->
                   </div>
               <!-- close div sidebar_container -->
               </div>
               <div id="content">
                    <h1>Guess a number between 1 and 100, you have <br><u><strong><?=$game->tries()?> tries</strong></u> left.</h1>
                    <form class="pure-form" action="#" method="get">
                        <input type="hidden" name="number" value=<?=$game->number()?>></input>
                        <input type="hidden" name="tries" value=<?=$game->tries()?>></input>
                        <input type="tel" name="guess"></input>
                        <input type="submit" class="pure-button button-secondary" name="doGuess" value="Make a Guess"></input>
                        <input type="submit" class="pure-button button-error" name="doCheat" value="Cheat"></input>
                    </form>
                    <a href="?reset"><br>Reset game</a>
                    <h2><?=$res?></h2>
<?php
// Include bottom part of html content
include(__DIR__ . "/view/bottom-view.php");
