<?php

require_once("mysqli.php");
require_once("mappers.php");

$categorias = fetchAll($conn, "SELECT name FROM categories ORDER BY name ASC");
$categorias = array_map('mapCategorytoHTML', $categorias);

if ($_GET['name']) {
    $selectedName = $conn->real_escape_string($_GET['name']);

    $cid = fetchSingle($conn, "SELECT cid FROM categories WHERE name = ? LIMIT 1", [$selectedName]);
    $links = fetchAll($conn, "SELECT url, title FROM links WHERE cid = ? ORDER BY title ASC", [$cid['cid']]);
    $links = array_map('mapLinktoHTML', $links);
} else {
    $links = fetchAll($conn, "SELECT url, title FROM links ORDER BY title ASC");
    $links = array_map('mapLinktoHTML', $links);
}

$conn->close();
?>

<!doctype html>
<html lang="en">
    <head>
        <?php include("includes/head-tag-contents.php");?>
    </head>
    <body>
        <div class="container">
            <?php include("includes/categorias-contents.php");?>
        </div>
    </body>
</html>
