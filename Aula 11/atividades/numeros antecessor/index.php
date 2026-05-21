<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antecessor e Sucessor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>
        Esse site mostra o antecessor e o sucessor do número digitado
    </h1>

    <form action="processo.php" method="POST">

        <label for="numero">Digite um número:</label>

        <input type="number" id="numero" name="numero" required>

        <button type="submit">
            Enviar
        </button>

    </form>

</body>
</html>