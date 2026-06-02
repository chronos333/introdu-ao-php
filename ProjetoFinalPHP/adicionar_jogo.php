<?php
include "auth_check.php";
requireAdmin();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome   = trim($_POST["nome"]);
    $preco  = $_POST["preco"];
    $genero = trim($_POST["genero"]);
    $imagem = trim($_POST["imagem"]);

    $sql = "INSERT INTO jogos (nome, preco, genero, imagem) VALUES ($1, $2, $3, $4)";
    pg_query_params($conn, $sql, [$nome, $preco, $genero, $imagem]);

    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Adicionar Jogo — GameIntel</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body class="adicionar-jogo-page">

<h1>Novo Jogo</h1>

<form method="POST">
    <label>Nome do Jogo</label>
    <input type="text" name="nome" required>

    <label>Preço</label>
    <input type="number" step="0.01" name="preco" required>

    <label>Gênero</label>
    <input type="text" name="genero" required>

    <label>Imagem (URL)</label>
    <input type="text" name="imagem" placeholder="https://...">

    <button type="submit">Adicionar Jogo</button>

    <div class="col-12">
        <p><a href="home.php">← Voltar para a loja</a></p>
    </div>
</form>

</body>
</html>
