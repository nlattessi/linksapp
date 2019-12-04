<?php

$host = 'mysql';
$db   = 'linksapp';
$user = 'root';
$pass = 'rootpassword';
$charset = 'utf8mb4';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset($charset);
} catch (\mysqli_sql_exception $e) {
     throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
}

unset($host, $db, $user, $pass, $charset);

function prepared_query($mysqli, $sql, $params = [], $types = "")
{
    $types = $types ?: str_repeat("s", count($params));
    $stmt = $mysqli->prepare($sql);

    if (count($params) > 0) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt;
}

function fetchAll($mysqli, $sql, $params = [], $types = "")
{
    $stmt = prepared_query($mysqli, $sql, $params, $types);
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $result;
}

function fetchSingle($mysqli, $sql, $params = [], $types = "")
{
    $stmt = prepared_query($mysqli, $sql, $params, $types);
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $result;
}