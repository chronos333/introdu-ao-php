<?php

$salario = $_POST["salario"] ?? 0;

$salario_minimo = 1518;

// Quantidade de salários mínimos
$multiplos = floor($salario / $salario_minimo);

// Valor que sobra
$sobra = $salario % $salario_minimo;

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
<main>
    <h1>💼 Resultado da Análise</h1>
    <div class="resultado">
        <p>
            Quem recebe
            <strong>
                R$ <?= number_format($salario, 2, ',', '.') ?>
            </strong>
            ganha aproximadamente
            <strong>
                <?= $multiplos ?>
            </strong>
            salário(s) mínimo(s).
        </p>
        <p>
            E sobra
            <strong>
                R$ <?= number_format($sobra, 2, ',', '.') ?>
            </strong>
        </p>
    </div>
    <a href="index.php">
        <button>
            ⬅ Voltar
        </button>
    </a>
</main>
</body>
</html>