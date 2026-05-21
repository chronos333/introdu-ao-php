<?php

// Inicia a sessão
session_start();

// Verifica o tema do cookie
$tema_class = '';
if (isset($_COOKIE["tema"]) && $_COOKIE["tema"] == "Escuro") {
    $tema_class = 'escuro';
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitiza e guarda o nome digitado na sessão
    $_SESSION["nome"] = htmlspecialchars($_POST["nome"]);

    // Sanitiza e guarda a empresa digitada na sessão
    $_SESSION["empresa"] = htmlspecialchars($_POST["empresa"]);

    // Cria um cookie para salvar o tema escolhido
    // O cookie ficará salvo por 30 dias
    setcookie("tema", $_POST["tema"], time() + (86400 * 30));

    // Salva as informações de cadastro em um arquivo (sanitizadas)
    $nome = htmlspecialchars($_POST["nome"]);
    $empresa = htmlspecialchars($_POST["empresa"]);
    $tema = $_POST["tema"];
    $dados = $nome . "," . $empresa . "," . $tema . "\n";
    file_put_contents("usuarios.txt", $dados, FILE_APPEND);

    // Redireciona para a página home
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
    <!-- Importando o CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo $tema_class; ?>">
    <div class="container">
        <h1>Mini Sistema de salvamento</h1>
        <p>Preencha os dados abaixo:</p>
        <!-- Formulário -->
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