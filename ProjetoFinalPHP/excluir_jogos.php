<?php
include "conexao.php";

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM jogos WHERE id = $1";
$result = pg_query_params($conn, $sql, [$id]);

if (!$result) {
    echo pg_last_error($conn);
    exit();
}

header("Location: home.php");
exit();
?>