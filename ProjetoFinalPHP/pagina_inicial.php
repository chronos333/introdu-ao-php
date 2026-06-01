<?php

    // usuário "fake" para teste (sem banco de dados)
    $usuario_correto = "admin";
    $senha_correta = "1234";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        // validação simples
        if ($nome === $usuario_correto && $senha === $senha_correta) {

            echo "<h1>Bem-vindo ao GameIntel</h1>";
            echo "<p>Login realizado com sucesso!</p>";
            echo "<p>Usuário: " . htmlspecialchars($nome) . "</p>";

        } else {

            echo "<h1 style='color:red;'>Erro no login</h1>";
            echo "<p>Usuário ou senha incorretos!</p>";
            echo "<a href='index.php'>Voltar</a>";
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        echo "<h1>Bem-vindo, " . htmlspecialchars($nome) . "</h1>";
        echo "<p>Login realizado com sucesso!</p>";
    }

?>