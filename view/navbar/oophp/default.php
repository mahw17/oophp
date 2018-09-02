<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<div class="wrap">
    <nav>
        <ul class="menu">
            <li><a href="<?= url("") ?>"><span class=""></span> Hem</a></li>
            <li><a href="<?= url("redovisning") ?>"><span class=""></span> Redovisning</a>
                <!-- <ul>
                    <li><a href="#">Company History</a></li>
                    <li><a href="#">Meet the team</a></li>
                </ul> -->
            </li>
            <li><a href="<?= url("om") ?>"><span class=""></span> Om</a>
                <!-- <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">App Development</a></li>
                    <li><a href="#">Email Campaigns</a></li>
                    <li><a href="#">Copyrighting</a></li>
                </ul> -->
            </li>
            <li><a href="#"><span class=""></span> Spel/Lek</a>
                <ul>
                    <li><a href="<?= url("lek") ?>">Lek</a></li>
                    <li><a href="<?= url("gissa") ?>">Gissa</a></li>
                    <li><a href="<?= url("dice") ?>">Tärningsspel</a></li>
                    <!-- <li><a href="#">Web App Four</a></li>
                    <li><a href="#">Crazy Products</a></li>
                    <li><a href="#">iPhone Apps</a></li> --> -->
                </ul>
            </li>
            <li><a href="#"><span class=""></span> Movie</a>
                <ul>
                    <li><a href="<?= url("movie") ?>">Show all movies</a></li>
                    <li><a href="<?= url("movie/search-title") ?>">Search title</a></li>
                    <li><a href="<?= url("movie/search-year") ?>">Search year</a></li>
                    <li><a href="<?= url("movie/crud") ?>">CRUD</a></li>
                    <!-- <li><a href="#">Web App Four</a></li>
                    <li><a href="#">Crazy Products</a></li>
                    <li><a href="#">iPhone Apps</a></li> --> -->
                </ul>
            </li>
            <li><a href="<?= url("debug") ?>"><span class=""></span> Debug</a>
                <!-- <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Directions</a></li>
                </ul> -->
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>
</div>
