<?php

$host = "localhost";
$banco = "logixeye";
$usuario = "postgres";
$senha = "postgres";

try{

    $conexao = new PDO(
        "pgsql:host=$host;dbname=$banco",
        $usuario,
        $senha
    );

    $conexao->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

}catch(PDOException $erro){

    echo "Erro na conexão: " . $erro->getMessage();

}
?>