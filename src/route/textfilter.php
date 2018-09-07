<?php

/**
 * Text filter sample route
 */
$app->router->get("textfilter/bbcode", function () use ($app) {
    $data = [
        "title" => "Show off BBCode",
    ];

    $filter = new \Mahw17\Filter\Filter();

    $data['text'] = file_get_contents("./text/bbcode.txt");
    $data['html'] = $filter->parse($data['text'], ["bbcode"]);

    // Add view and render page
    $app->view->add("textfilter/bbcode", $data);
    $app->page->render($data);
});

$app->router->get("textfilter/clickable", function () use ($app) {
    $data = [
        "title" => "Showing off Clickablee",
    ];

    $filter = new \Mahw17\Filter\Filter();

    $data['text'] = file_get_contents("./text/clickable.txt");
    $data['html'] = $filter->parse($data['text'], ["clickable"]);

    // Add view and render page
    $app->view->add("textfilter/clickable", $data);
    $app->page->render($data);
});

$app->router->get("textfilter", function () use ($app) {
    $getFilter = $_GET['filter'];
    $data = [
        "title" => "Showing off ".$getFilter,
    ];

    $filter = new \Mahw17\Filter\Filter();


    $file = $getFilter == "markdown" ? $getFilter.".md" : $getFilter.".txt";
    $data['text'] = file_get_contents("./text/".$file);
    $data['html'] = $filter->parse($data['text'], [$getFilter]);

    // Add view and render page
    $app->view->add("textfilter/".$getFilter, $data);
    $app->page->render($data);
});
