<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa XYZ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Seja bem vindo caro cliente</h1>
    <p>Estamos felizes em tê-lo conosco. Por favor, preencha o formulário para te conhecermos melhor.</p>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" id="nome">
        <br><br>
        <label>E-mail:</label>
        <input type="email" name="email" id="email">
        <br><br>
        <label>Como nos conheceu?</label>
        <select name="compartilhamento" id="compartilhamento">
            <option value="">Selecione</option>
            <option value="Amigos">Amigos</option>
            <option value="Anunciantes">Anunciantes</option>
            <option value="Redes Sociais">Redes Sociais</option>
        </select>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    echo "<main>";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $compartilhamento = $_POST["compartilhamento"];

   //Exibindo as informaçoes
    echo "Nome: $nome <br>";
    echo "E-mail: $email <br>";
    echo "Como nos conheceu: $compartilhamento";
    }
    echo "</main>";
    ?>

</body>
</html>