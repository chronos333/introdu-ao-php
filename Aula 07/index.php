<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
        align-items: center;
        margin: auto;
    }
</style>

<body>
    <h1>Lista de Produtos Sol nascente</h1>
    
<!-- começo do php -->
<?php

//array
$funcionarios = [
    ["nomeProduto" => "tesoura",  "preço" => "R$3.50"],

    ["nomeProduto" => "Caderno", "preço" => "R$ 4.00"],

    ["nomeProduto" => "Margarina", "preço" => "R$5.00"],

    ["nomeProduto" => 'Borracha', "preço" =>"R$2.00"]
];

//tabela
echo"<table border='1'>";
    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Preço</th>"; 
    echo "</tr>";
    foreach ($funcionarios as $f) {
        echo "<tr>";
        echo "<td>" . $f["nomeProduto"] . "</td>";
        echo "<td>" . $f["preço"] . "</td>";
        echo "</tr>";
    }
?>
</body>
</html>