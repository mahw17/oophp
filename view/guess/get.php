<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1><?=$title?></h1>
<h3>Guess a number between 1 and 100, you have <br><u><strong><?=$game->tries()?> tries</strong></u> left.</h3>
<form class="pure-form" action="#" method="get">
    <input type="hidden" name="number" value=<?=$game->number()?>></input>
    <input type="hidden" name="tries" value=<?=$game->tries()?>></input>
    <input type="tel" name="guess"></input>
    <input type="submit" class="pure-button button-secondary" name="doGuess" value="Make a Guess"></input>
    <input type="submit" class="pure-button button-error" name="doCheat" value="Cheat"></input>
</form>
<a href="?reset"><br>Reset game</a>
<h4><?=$res?></h4>
