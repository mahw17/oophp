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
            </li>
            <li><a href="#"><span class=""></span> Spel/Lek</a>
                <ul>
                    <li><a href="<?= url("lek") ?>">Lek</a></li>
                    <li><a href="<?= url("gissa") ?>">Gissa</a></li>
                    <li><a href="<?= url("dice") ?>">Tärningsspel</a></li>
                </ul>
            </li>
            <li><a href="#"><span class=""></span> Movie</a>
                <ul>
                    <li><a href="<?= url("movie") ?>">Show all movies</a></li>
                    <li><a href="<?= url("movie/search-title") ?>">Search title</a></li>
                    <li><a href="<?= url("movie/search-year") ?>">Search year</a></li>
                    <li><a href="<?= url("movie/crud") ?>">CRUD</a></li>
                </ul>
            </li>
            <li><a href="#"><span class=""></span> TextFilter</a>
                <ul>
                    <li><a href="<?= url("textfilter?filter=bbcode") ?>">BBCode</a></li>
                    <li><a href="<?= url("textfilter?filter=clickable") ?>">Clickable</a></li>
                    <li><a href="<?= url("textfilter?filter=markdown") ?>">Markdown</a></li>
                </ul>
            </li>
            <li><a href="#"><span class=""></span> CMS</a>
                <ul>
                    <li><a href="<?= url("cms/show-all") ?>">Show all content</a></li>
                    <li><a href="<?= url("cms/admin") ?>">Admin</a></li>
                    <li><a href="<?= url("cms/create") ?>">Create</a></li>
                    <li><a href="<?= url("cms/pages") ?>">View pages</a></li>
                    <li><a href="<?= url("cms/blog") ?>">View blog</a></li>
                </ul>
            </li>
            <li><a href="<?= url("debug") ?>"><span class=""></span> Debug</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>
</div>
