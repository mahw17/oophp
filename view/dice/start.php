<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

?><h1>Tärningsspelet 100</h1>

<form class="form-dice" action="<?= url("dice/game") ?>" method="post">

    <label>Spelarens namn</label>
    <input type="text" name="player"></input>

    <label>Antal tärningar</label>
    <select name="dices">
        <?php for ($i=1; $i <= $max_dices; $i++) : ?>
            <option value=<?= $i ?>><?= $i ?></option>
        <?php endfor; ?>
    </select>

    <input type="submit" value="Starta spel" />
</form>

<h2>Regler</h2>
    <ul>
        <li>Man kan vara två eller fler spelare. Man kan spela med en eller flera tärningar.</li>
        <li>Alla spelare kastar en tärning och den som får högst börjar spelet med en spelrunda.</li>
        <li>Notera alla spelare på ett papper, protokollet, det gäller att först samla på sig 100 poäng.</li>
    </ul>

<h2>Spelrunda</h2>
    <ul>
        <li>En spelrunda inleds av en spelare genom att den kastar alla tärningar.</li>
        <li>Alla tärningar med ögon 2-6 summeras och adderas till totalen för nuvarande spelrunda. En tvåa är värd 2 poäng och en sexa är värd 6 poäng, och så vidare.</li>
        <li>Spelaren bestämmer om ett nytt kast skall göras inom samma spelrunda för att försöka samla mer poäng. Eller så väljer spelaren att avbryta spelrundan och föra över de insamlade poängen till säkerhet i protokollet.</li>
        <li>Om spelaren kastar en etta så avbryts spelrundan och turen går över till nästa spelare. Nuvarande spelare förlorar alla poäng som samlats in i nuvaranade spelrunda.</li>
    </ul>

<h2>Avgränsingar i denna version</h2>
    <ul>
        <li>Enbart en spelare som möter datorn.</li>
        <li>Spelaren börjar alltid.</li>
        <li>Antalet tärningar (1-6st) kan ej ändras under en startad spelomgång.</li>
        <li>Datorn baserar sitt beslut om hen skall fortsätta kasta eller stanna
            baserat dels på hur stor differens det är mellan spelarna samt sannolikheten att slå en etta.
            Sannolikheten beräknas som om det vor en tärning åt gången som slås enligt formeln (1 - (5/6)^antal slagna tärningar) x 100.
        Datorn blir mer riskbenägen ju mer den ligger under.</li>
    </ul>
