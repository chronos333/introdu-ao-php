<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Salário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <h1>💼 Análise de Salário</h1>
    <p>Informe o seu salário para compará-lo com o salário mínimo vigente.</p>

    <form action="processo.php" method="POST">
        <label for="salario">Salário R$:</label>

        <input type="number" name="salario" id="salario" step="0.01" min="0" placeholder=" Ex: 1800.00" required>
        <button type="submit"> Analisar</button>
    </form>

</main>
</body>
</html>