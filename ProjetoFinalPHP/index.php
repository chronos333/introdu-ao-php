<?php
session_start();
include "conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = trim($_POST['nome']);
    $senha = $_POST['senha'];

    $sql    = "SELECT * FROM usuarios WHERE nome = $1";
    $result = pg_query_params($conn, $sql, [$nome]);

    if ($result && pg_num_rows($result) > 0) {
        $usuario = pg_fetch_assoc($result);

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['is_admin']     = $usuario['is_admin'] === 't'; // PostgreSQL retorna 't'/'f'

            header("Location: home.php");
            exit();
        }
    }

    $erro = "Usuário ou senha inválidos.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameIntel</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/logo.png">
</head>
<body class="login-page">
    <h1>Seja bem-vindo à GameIntel</h1>

    <?php if ($erro): ?>
        <p class="msg-erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome de usuário</label>
        <input type="text" name="nome" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>

        <div class="col-12">
            <p>Não possui uma conta?
                <a href="cadastro.php">Cadastre-se aqui</a>
            </p>
        </div>
    </form>
</body>
</html>
