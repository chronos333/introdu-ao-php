<?php

$host   = "localhost";
$dbname = "escola";
$user   = "postgres";
$pass   = "postgres";

try {
    $conexao = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}