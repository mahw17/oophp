<?php
/**
 * OOPHP - KMOM01 - Guess my number (SESSION)
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

session_name("kmom01_guess");
session_start();

// For the view
$title = "Guess my number (SESSION)";

// Reset the game
if (isset($_POST["reset"])) {
    $_SESSION = [];
}

// Start up the game
if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
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

// Include top part of html content
include(__DIR__ . "/view/top-view.php");

?>
<h1>Guess (SESSION)</h1>
<ul>
    <li>Gör samma sak igen, men använd nu SESSION för att minnas spelets ställning.</li>
    <li>Spara koden i index_session.php.</li>
    <li>Till formuläret använder du POST.</li>
    <li>Välj om du vill spara hela objektet, eller bara de viktiga delarna, i sessionen.</li>
</ul>
<!-- close div sidebar -->
</div>
<!-- close div sidebar_container -->
</div>
<div id="content">
<h1>Guess a number between 1 and 100, you have <br><u><strong><?=$_SESSION["game"]->tries()?> tries</strong></u> left.</h1>
      <form class="pure-form" action="#" method="post">
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
