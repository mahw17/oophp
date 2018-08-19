<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

?><h1>Tärningsspelet 100</h1>

<form action="<?= url("dice/game") ?>">
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
        <li>3 tärningar används vid varje kast.</li>
        <li>Datorn kastar bara en gång innan den stannar.</li>
    </ul>
