<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro GameIntel</title>
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