<?php

require_once("mysqli.php");
require_once("mappers.php");
require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['name'])) {
        $conn->close();
        die('falta nombre');
    }

    $name = $conn->real_escape_string($_POST['name']);
    $date = Date("Y-m-d H:i:s");

    $stmt = prepared_query($conn, "INSERT INTO categories (name, date) VALUES (?, ?)", [$name, $date]);

    $stmt->close();
    $conn->close();
    header("Location: $HOST", true, 302);
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
            <?php include("includes/agregar-categoria-contents.php");?>
        </div>
    </body>
</html>