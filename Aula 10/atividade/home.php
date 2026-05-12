<?php
session_start();

// Verifica se existe sessão
if (!isset($_SESSION["nome"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include "header.php"; ?>

    <main class="container">

        <h1>Bem-vindo!</h1>

        <p><strong>Nome:</strong> <?php echo $_SESSION["nome"]; ?></p>

        <p><strong>Empresa:</strong> <?php echo $_SESSION["empresa"]; ?></p>

        <p>
            Os dados acima estão sendo mantidos usando
            <strong>SESSION</strong>.
        </p>

        <p>
            A preferência de tema foi salva usando
            <strong>COOKIE</strong>.
        </p>

    </main>

</body>
</html>