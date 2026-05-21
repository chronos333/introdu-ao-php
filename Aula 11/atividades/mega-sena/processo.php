<?php

$numeros = [];

if(isset($_POST["sortear"])){

    // Gera 6 números únicos
    while(count($numeros) < 6){

        $numero = rand(1, 60);

        // Evita repetição
        if(!in_array($numero, $numeros)){

            $numeros[] = $numero;

        }
    }

    // Ordena os números
    sort($numeros);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mega Sena</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <h1>🎰 Sorteador Mega Sena</h1>

        <form method="POST">

            <button type="submit" name="sortear">

                Sortear

            </button>

        </form>

        <?php if(!empty($numeros)) { ?>

            <h2>Números sorteados:</h2>

            <div class="resultado">

                <?php

                foreach($numeros as $n){

                    echo "<span class='bola'>$n</span>";

                }

                ?>

            </div>

        <?php } ?>

    </div>

</body>
</html>