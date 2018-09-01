<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

?><h1>Grattis <?=$winner?>!</h1>

<form action="<?= url("dice/game") ?>" method="post">
    <input type="submit" value="Spela igen" />
</form>
