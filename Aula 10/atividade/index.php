<?php
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Guardando dados na sessão
    $_SESSION["nome"] = $_POST["nome"];
    $_SESSION["empresa"] = $_POST["empresa"];

    // Guardando preferência de tema no cookie
    setcookie("tema", $_POST["tema"], time() + (86400 * 30));

    // Redireciona para home
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Sistema</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <h1>Mini Sistema PHP</h1>

        <p>Preencha os dados abaixo:</p>

        <form method="POST">

            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Empresa:</label>
            <input type="text" name="empresa" required>

            <label>Tema:</label>
            <select name="tema">
                <option value="Claro">Claro</option>
                <option value="Escuro">Escuro</option>
            </select>

            <input type="submit" value="Entrar">

        </form>

    </div>

</body>
</html>