<?php

$numero = $_POST["numero"];

/*
    CRIA O COOKIE
*/

setcookie("ultimo_numero", $numero, time() + 3600);

function antecessor($numero) {
    return $numero - 1;
}

function sucessor($numero) {
    return $numero + 1;
}

$antecessor = antecessor($numero);
$sucessor = sucessor($numero);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Resultado</h1>

<table border="1">

    <tr>
        <th>Antecessor</th>
        <th>Número</th>
        <th>Sucessor</th>
    </tr>

    <tr>
        <td><?php echo $antecessor; ?></td>
        <td><?php echo $numero; ?></td>
        <td><?php echo $sucessor; ?></td>
    </tr>

</table>

<br>

<?php

if(isset($_COOKIE["ultimo_numero"])) {

    echo "Último número digitado: " . $_COOKIE["ultimo_numero"];

}

?>

</body>
</html>