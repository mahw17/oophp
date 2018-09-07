<?php
/**
 * Content management system (CMS) specific routes.
 */



/**
 * CMS - show-all view
 */

$app->router->get("cms/show-all", function () use ($app) {

    $data = [
        "title" => "Show all content",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("cms/show-all", $data);
    $app->page->render($data);
});

/**
 * CMS - admin view
 */

$app->router->get("cms/admin", function () use ($app) {

    $data = [
        "title" => "Admin content",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("cms/admin", $data);
    $app->page->render($data);
});

/**
 * CMS - admin=>edit view
 */

$app->router->any(["GET", "POST"], "cms/admin/edit", function () use ($app) {

    $data = [
        "title" => "Edit content",
    ];

    $app->db->connect();

    $contentId = getPost("contentId") ?: getGet("id");
    if (!is_numeric($contentId)) {
        die("Not valid for content id.");
    }

    if (isset($_POST["doDelete"])) {
        header("Location: delete?id=$contentId");
        exit;
    } elseif (isset($_POST["doSave"])) {
        $params = getPost([
            "contentTitle",
            "contentPath",
            "contentSlug",
            "contentData",
            "contentType",
            "contentFilter",
            "contentPublish",
            "contentId"
        ]);

        if (!$params["contentSlug"]) {
            $params["contentSlug"] = slugify($params["contentTitle"]);
        }

        // Check that unique slug
        $sql = "SELECT * FROM content WHERE slug = ?;";
        $slugCheck = $app->db->executeFetch($sql, [$params["contentSlug"]]);

        if ($slugCheck) {
            $data['title'] = "Felaktig SLUG!";
            $data['message'] = "Mer än en blogpost har samma slug, vänligen ändra!";
            $app->view->add("http_status/404", $data);
            $app->page->render($data);
        }

        if (!$params["contentPath"]) {
            $params["contentPath"] = null;
        }

        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $app->db->execute($sql, array_values($params));
        header("Location: ?id=$contentId");
        exit;
    }

    $sql = "SELECT * FROM content WHERE id = ?;";
    $content = $app->db->executeFetch($sql, [$contentId]);

    $data["content"] = $content;

    $app->view->add("cms/edit", $data);
    $app->page->render($data);
});

/**
 * CMS - admin=>delete view
 */

$app->router->any(["GET", "POST"], "cms/admin/delete", function () use ($app) {

    $data = [
        "title" => "Delete content",
    ];

    $app->db->connect();

    $contentId = getPost("contentId") ?: getGet("id");
    if (!is_numeric($contentId)) {
        die("Not valid for content id.");
    }

    if (isset($_POST["doDelete"])) {
        $contentId = getPost("contentId");
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $app->db->execute($sql, [$contentId]);
        header("Location: ./");
        exit;
    }

    $sql = "SELECT id, title FROM content WHERE id = ?;";
    $content = $app->db->executeFetch($sql, [$contentId]);

    $data["content"] = $content;

    $app->view->add("cms/delete", $data);
    $app->page->render($data);
});

/**
 * CMS - create view
 */

$app->router->any(["GET", "POST"], "cms/create", function () use ($app) {

    $data = [
        "title" => "Create content",
    ];

    $app->db->connect();

    if (isset($_POST["doCreate"])) {
        $title = getPost("contentTitle");

        $sql = "INSERT INTO content (title) VALUES (?);";
        $app->db->execute($sql, [$title]);
        $id = $app->db->lastInsertId();
        header("Location: admin/edit?id=$id");
        exit;
    }
    $app->view->add("cms/create", $data);
    $app->page->render($data);
});

/**
 * CMS - view pages
 */

$app->router->get("cms/pages", function () use ($app) {

    $data = [
        "title" => "View pages",
    ];

    $app->db->connect();

    $sql = <<<EOD
SELECT
*,
CASE
    WHEN (deleted <= NOW()) THEN "isDeleted"
    WHEN (published <= NOW()) THEN "isPublished"
    ELSE "notPublished"
END AS status
FROM content
WHERE type=?
;
EOD;

    $res = $app->db->executeFetchAll($sql, ["page"]);

    $data["resultset"] = $res;

    $app->view->add("cms/pages", $data);
    $app->page->render($data);
});

/**
 * CMS - view specific page
 */

$app->router->get("cms/page", function () use ($app) {

    $route = getGet("route");

    $app->db->connect();

    $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

    $content = $app->db->executeFetch($sql, [$route, "page"]);

    if (!$content) {
        if (!$route) {
            $data['title'] = "Sidan du söker saknar en giltig PATH";
            $data['message'] = "Vänligen korrigera i editorn!";
        } else {
            $data['title'] = "Sidan du söker finns ej!";
            $data['message'] = "Försök med en annan sida!";
        }
        $app->view->add("http_status/404", $data);
        $app->page->render($data);
    }

    $filter = new \Mahw17\Filter\Filter();

    $content->data = $filter->parse($content->data, explode(',', $content->filter));

    $data["content"] = $content;
    $data["title"] = $content->title;

    $app->view->add("cms/page", $data);
    $app->page->render($data);
});


/**
 * CMS - view blog
 */

$app->router->get("cms/blog", function () use ($app) {

    $data = [
        "title" => "View blog",
    ];

    $app->db->connect();

    $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;

    $res = $app->db->executeFetchAll($sql, ["post"]);

    $data["resultset"] = $res;

    $app->view->add("cms/blog", $data);
    $app->page->render($data);
});

/**
 * CMS - view specific blogpost
 */

$app->router->get("cms/blogpost", function () use ($app) {

    $route = getGet("route");

    $app->db->connect();

    $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;

    // $slug = substr($route, 5);
    $content = $app->db->executeFetch($sql, [$route, "post"]);

    if (!$content) {
        $data['title'] = "Sidan du söker finns ej!";
        $data['message'] = "Försök med en annan sida!";
        $app->view->add("http_status/404", $data);
        $app->page->render($data);
    }

    $filter = new \Mahw17\Filter\Filter();
    $content->data = $filter->parse($content->data, explode(',', $content->filter));

    $data["content"] = $content;
    $data["title"] = $content->title;

    $app->view->add("cms/blogpost", $data);
    $app->page->render($data);
});
