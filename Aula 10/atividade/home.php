<?php

// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["nome"])) {

    // Se não existir sessão, volta para index
    header("Location: index.php");
    exit();
}

// Verifica o tema do cookie
$tema_class = '';
if (isset($_COOKIE["tema"]) && $_COOKIE["tema"] == "Escuro") {
    $tema_class = 'escuro';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Importando CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo $tema_class; ?>">

    <!-- Incluindo o cabeçalho -->
    <?php include "header.php"; ?>

    <main class="container">
        <h1>Bem-vindo!</h1>

        <!-- Exibe o nome salvo na sessão -->
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION["nome"]); ?></p>

        <!-- Exibe a empresa salva na sessão -->
        <p><strong>Empresa:</strong> <?php echo htmlspecialchars($_SESSION["empresa"]); ?></p>
        <p>Os dados acima estão sendo mantidos usando<strong>SESSION</strong>.</p>
        <p>A preferência de tema foi salva usando <strong>COOKIE</strong>. </p>

        <h2>Cadastros Salvos</h2>
        <?php
        if (file_exists("usuarios.txt")) {
            $linhas = file("usuarios.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!empty($linhas)) {
                echo "<table border='1'>";
                echo "<tr><th>Nome</th><th>Empresa</th><th>Tema</th></tr>";
                foreach ($linhas as $linha) {
                    $dados = explode(",", $linha);
                    if (count($dados) == 3) {
                        $nome = htmlspecialchars(trim($dados[0]));
                        $empresa = htmlspecialchars(trim($dados[1]));
                        $tema = htmlspecialchars(trim($dados[2]));
                        echo "<tr><td>$nome</td><td>$empresa</td><td>$tema</td></tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "<p>Nenhum cadastro salvo ainda.</p>";
            }
        } else {
            echo "<p>Arquivo de cadastros não encontrado.</p>";
        }
        ?>
    </main>
</body>
</html>