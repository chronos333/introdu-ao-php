<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
</head>
<body>
    <form method="POST">
        <label>Nome: </label>
        <input type="text" name="nome" id="nome">
        <label>E-mail: </label>
        <input type="email" name="email" id="email">
        <label>Mensagem: </label>
        <input type="text" name="msg" id="msg">
        <input type="reset" value="Limpar">
        <input type="submit" value="Enviar">
    </form>
    <h2> Dados recebido: </h2>
    <hr>
    <?php
    //Declarando as variaveis
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $msg = $_POST["msg"];

    //Exibindo as informaçoes
    echo "Nome: $nome <br>";
    echo "E-mail: $email <br>";
    echo "Mensagem: $msg";
    ?>
</body>
</html>