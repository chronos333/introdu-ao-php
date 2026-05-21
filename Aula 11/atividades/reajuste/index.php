<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reajustador de Preços</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Reajustador de Preços</h1>
        <form method="POST" class="formulario" action="processo.php">
            <label>Preço do Produto:</label>
            <input type="number" name="preco" step="0.01" required
            value="<?= $_POST['preco'] ?? 100 ?>">
            <label>
                Percentual de Reajuste 
                <span id="valorRange">
                    <?= $_POST['reajuste'] ?? 15 ?>%
                </span>
            </label>
            <input type="range" name="reajuste" min="0" max="100" value="<?= $_POST['reajuste'] ?? 15 ?>" oninput="valorRange.innerHTML = this.value + '%'">
            <button type="submit">
                Calcular Reajuste
            </button>
        </form>
    </div>
</div>
</body>
</html>