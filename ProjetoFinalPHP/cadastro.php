<<<<<<< HEAD
<?php session_start(); ?>
=======
>>>>>>> 8e1bc3c7f4cf0b62edd2b895cfd81358095bda44
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro GameIntel</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/logo.png">
</head>
<body class="cadastro-page">
<h1>Criar Conta</h1>
<form method="POST">

    <label>Usuário:</label>
    <input type="text" name="nome" required>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <label>Confirmar Senha:</label>
    <input type="password" name="confirmar_senha" required>

    <button type="submit">Cadastrar</button>
    <div class="col-12">
        <p>Já possui uma conta?
            <a href="index.php">Entre aqui</a>
        </p>
    </div>
</form>

<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome      = trim($_POST['nome']);
    $senha     = $_POST['senha'];
    $confirmar = $_POST['confirmar_senha'];

    if ($senha !== $confirmar) {
        echo "<p class='msg-erro'>As senhas não conferem!</p>";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql       = "INSERT INTO usuarios (nome, senha) VALUES ($1, $2)";
        $result    = pg_query_params($conn, $sql, [$nome, $senhaHash]);

        if ($result) {
            echo "<p class='msg-sucesso'>Conta criada com sucesso! <a href='index.php'>Entrar</a></p>";
        } else {
            echo "<p class='msg-erro'>Erro ao criar conta. Tente outro nome de usuário.</p>";
        }
    }
}
?>
</body>
</html>
=======
</head>
<body>

<h1>Criar Conta</h1>

<form method="POST">

    <label>Usuário:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <label>Confirmar Senha:</label><br>
    <input type="password" name="confirmar_senha" required><br><br>

    <button type="submit">Cadastrar</button>

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar_senha'];

    if ($senha !== $confirmar) {
        echo "<p style='color:red;'>As senhas não conferem!</p>";
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    echo "<p style='color:green;'>Conta criada com sucesso!</p>";
    echo "Usuário: " . htmlspecialchars($nome);
}

?>

</body>
</html>
>>>>>>> 8e1bc3c7f4cf0b62edd2b895cfd81358095bda44
