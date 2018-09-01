<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

?><h1><?=$title?></h1>

<form action="<?= url("dice") ?>" method="post">
      <input type="submit" name="reset" value="Reset"></input>
</form>

<h3><?=$player?>:s tur!</h3>

<table>
        <tr>
            <th>Poäng i denna omgång</th>
            <th>Poäng totalt (exkl denna omg.)</th>
            <th>Poäng totalt (inkl denna omg.)</th>
        </tr>
        <tr>
            <td><?=$score?></td>
            <td><?=$totalScore?></td>
            <td><?=$totalScore + $score?></td>
        </tr>
</table>

<hr>

<form action="<?= url("dice/game") ?>" method="post">
    <?php if ($btnRoll && $player != "Datorn") : ?>
    <input type="submit" name="roll" value="Kasta tärningar"></input>
    <?php endif; ?>

    <?php if ($btnRoll && $player == "Datorn") : ?>
    <input type="submit" name="roll" value="Låt datorn kastar"></input>
    <?php endif; ?>

    <?php if ($score > 0 && $btnNext == false && $player != "Datorn") : ?>
    <input type="submit" name="save" value="Stanna"></input>
    <?php endif; ?>

    <?php if ($btnNext) : ?>
    <input type="submit" name="save" value="Nästa spelare"></input>
    <?php endif; ?>

</form>

<p>
<?php foreach ($class as $value) : ?>
    <i class="dice-sprite <?= $value ?>"></i>
<?php endforeach; ?>
</p>

<?php if (array_sum($res) > 0) : ?>
<p>Sum is: <?= array_sum($res) ?>.</p>
<pre><?= $histo ?></pre>
<?php endif; ?>

<h3><?= $text ?></h3>
