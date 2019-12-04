<?php

require_once("mysqli.php");
require_once("mappers.php");
require_once("config.php");

$categorias = fetchAll($conn, "SELECT name FROM categories ORDER BY name ASC");
$categorias = array_map('mapCategoryToSelectOption', $categorias);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['url'])) {
        $conn->close();
        die('falta url');
    }
    if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
        $conn->close();
        die("La url ingresada no es una url válida");
    }
    
    $title = $_POST['title'] ?? null;
    
    $category = $_POST['category'] ?? null;
    if (empty($_POST['category'])) {
        $conn->close();
        die('falta categoria');
    }

    $category = $conn->real_escape_string($_POST['category']);
    $cid = fetchSingle($conn, "SELECT cid FROM categories WHERE name = ? LIMIT 1", [$category]);
    if (empty($cid)) {
        $conn->close();
        die("Categoria $category no válida");
    }

    $url = $conn->real_escape_string($_POST['url']);
    $title = $conn->real_escape_string($_POST['title']);
    $date = Date("Y-m-d H:i:s");

    $stmt = prepared_query($conn, "INSERT INTO links (url, title, cid, date) VALUES (?, ?, ?, ?)", [$url, $title, $cid['cid'], $date]);

    $stmt->close();
    $conn->close();
    header('Location: ' . "$HOST", true, 302);
    exit();
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
            <?php include("includes/agregar-link-contents.php");?>
        </div>
    </body>
</html>
